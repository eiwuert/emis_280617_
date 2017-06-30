<?php
require_once ("secure_area.php");
class Category_products extends Secure_area 
{
	function __construct()
	{
		parent::__construct('category_products');
	}

	function index($offset = 0) {
		$params = $this->session->userdata('category_products_search_data') ? $this->session->userdata('category_products_search_data') : array('offset' => 0, 'order_col' => 'item_category_id', 'order_dir' => 'asc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('category_products/index/'.$params['offset']);
		}
		$this->check_action_permission('search');

		$config['base_url'] = site_url('category_products/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search']) {
			$config['total_rows'] = $this->Category_products_model->search_count_all($data['search']);
			$table_data = $this->Category_products_model->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {	
			$config['total_rows'] = $this->Category_products_model->count_all();
			$table_data = $this->Category_products_model->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_category_products_manage_table($table_data,$this);
		$this->load->view('category_products/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'item_category_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$category_products_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("category_products_search_data",$category_products_search_data);

		if ($search) {
			$config['total_rows'] = $this->Category_products_model->search_count_all($search);
			$table_data = $this->Category_products_model->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'item_category_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		} else {
			$config['total_rows'] = $this->Category_products_model->count_all();
			$table_data = $this->Category_products_model->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'item_category_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		}
		$config['base_url'] = site_url('category_products/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_category_products_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'item_category_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$category_products_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("category_products_search_data",$category_products_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Category_products_model->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('category_products/search');
		$config['total_rows'] = $this->Category_products_model->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Category_products_model->search_count_all($search);
		$data['manage_table']= get_category_products_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Inserts/updates an category_products
	*/
	function save($item_category_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$cate_prod_data = array(
			'name'=>$this->input->post('name'),
			'description'=>$this->input->post('description')
		);

		if($this->Category_products_model->save($cate_prod_data, $item_category_id)) {	
			//New category_products
			if($item_category_id==-1) {
				$message = lang('category_products_successful_adding').' '.$cate_prod_data['category_products_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'item_category_id'=>$cate_prod_data['item_category_id']));
			} else { //previous category_products
				$message = lang('category_products_successful_updating').' '.$cate_prod_data['category_products_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'item_category_id'=>$item_category_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('category_products_error_adding_updating').' '.
			$cate_prod_data['category_products_name'],'item_category_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Category_products_model->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($item_category_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['cate_prod_info'] = $this->Category_products_model->get_info($item_category_id);
		$this->load->view('category_products/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Category_products_model->check_duplicate($this->input->post('term'))));
	}

	function category_products_exists()
	{
		if($this->Category_products_model->category_products_exists($this->input->post('name')))
			echo 'false';
		else
			echo 'true';
	}

	/*
	This deletes category_products from the category_products table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$category_products_to_delete=$this->input->post('ids');
		
		if ($this->Category_products_model->delete_list($category_products_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('category_products_successful_deleted').' '.
			count($category_products_to_delete).' '.lang('category_products_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('category_products_cannot_be_deleted')));
		}
	}

	// function detail($item_category_id = -1) {
	// 	$this->check_action_permission('add_update');
	// 	$data['controller_name'] = strtolower(get_class());
	// 	$data['category_products_info'] = $this->category_products_model->get_detail($item_category_id);
	// 	$this->load->view('category_products/detail',$data);
	// }

	// function delete_by_id($item_category_id=-1) {
	// 	$this->check_action_permission('delete');
	// 	if ($item_category_id && $this->category_products_model->delete($item_category_id)) {
	// 		echo json_encode(array('success'=>true, 'message'=>lang('category_products_successful_deleted'), 'item_category_id'=>$item_category_id));
	// 	} else {
	// 		echo json_encode(array('success'=>false, 'message'=>lang('category_products_error_delete'), 'item_category_id'=>$item_category_id));
	// 	}
	// }

	function clear_state()
	{
		$this->session->unset_userdata('category_products_search_data');
		redirect('category_products');
	}

}