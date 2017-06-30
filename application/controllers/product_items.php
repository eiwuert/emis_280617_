<?php
require_once ("secure_area.php");
class Product_items extends Secure_area 
{
	function index($offset=0){		
		$data['controller_name']=strtolower(get_class());
		$params = $this->session->userdata('item_search_data') ? $this->session->userdata('item_search_data') : array('offset' => 0, 'order_col' => 'item_unique_id', 'order_dir' => 'asc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('items/index/'.$params['offset']);
		}

		$this->check_action_permission('search');
		$config['base_url'] = site_url('items/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		
		if ($data['search'])
		{
			$config['total_rows'] = $this->Item_products->search_count_all($data['search']);
			$table_data = $this->Item_products->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);

		}else{

			$config['total_rows'] = $this->Item_products->count_all();
			$table_data = $this->Item_products->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$unitType = $this->Item_products->get_unitType()->result();
		$data['unitType'] = ['' => '-- Please Select --'];
		foreach ($unitType as $key => $val) {
			$data['unitType'][$val->unit_id] = $val->unit_name;
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];

		$data['manage_table']=get_items_manage_table($table_data,$this,$current);
		$data['categories'][''] = '--'.lang('items_select_category_or_all').'--';
		foreach($this->Item_products->get_all_categories()->result() as $category)
		{
			$data['categories'][$category->item_category_id] = $category->name;
		}
		$this->load->view('items/product_items/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";

		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'item_unique_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$item_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("item_search_data",$item_search_data);
		if ($search)
		{
			$config['total_rows'] = $this->Item_products->search_count_all($search);
			$table_data = $this->Item_products->search($search, $per_page, $offset, $order_col, $order_dir);
		}
		else
		{
			$config['total_rows'] = $this->Item_products->count_all();
			$table_data = $this->Item_products->get_all($per_page, $offset, $order_col, $order_dir);
		}
		$config['base_url'] = site_url('items/sorting');
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_items_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Item_products->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}
	function search()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search');
		$category = $this->input->post('category');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'item_unique_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$item_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search,  'category' => $category);
		$this->session->set_userdata("item_search_data",$item_search_data);
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data=$this->Item_products->search($search, $per_page, $offset, $order_col, $order_dir);
		$config['base_url'] = site_url('items/search');
		$config['total_rows'] = $this->Item_products->search_count_all($search, $category);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_items_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$items_to_delete=$this->input->post('ids');

		if ($this->Item_products->delete_list($items_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('course_successful_deleted').' '.
			count($items_to_delete).' '.lang('course_one_or_multiple')));
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('course_cannot_be_deleted')));
		}
	}
	function view($item_id=-1,$redirect=0) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['item_info'] = $this->Item_products->get_info($item_id);
		$data['sell_unit_info'] = $this->Item_products->get_sell_unit_info($item_id)->result();
		
		$get_average_cost = $this->Item_products->get_average_cost($item_id)->row();
		$data['average_cost'] = round(floatval($get_average_cost->item_total_d / $get_average_cost->item_all_qty),3);
		
		$data_category = array();
		$get_item_cate = $this->Item_products->get_all_categories()->result();
		$data_category = ["" => '-- --'];
		foreach($get_item_cate as $key => $val) {
			$data_category[$val->item_category_id] =  $val->name;
		}
		$data['category'] = $data_category;

		$select = $this->Item_products->get_item_cate_unit()->result();
		$data['unit_items'] = $select;

		if ($item_id == -1) {
			$data['item_unique_id'] = $this->last_running_number();
		}
		$this->load->view('items/product_items/view',$data);
	}
	function last_running_number()
	{
		$last_running_number = $this->Item_products->get_last_running_number();
		$running_number = $last_running_number + 1;
		if (strlen($running_number) < 6) {
			$running_number = str_pad($running_number, 6, '0', STR_PAD_LEFT);
		}
		return $running_number;
	}
	function save($item_id=-1)
	{
		$this->check_action_permission('add_update');
		$employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		$datas = $this->input->post();
		$item_sell_unit_old = array(
			'autoid' => $datas['autoid'],
			'sell_cate'=>$datas['sell_cate_old'],
			'sell_qty'=>$datas['sell_qty_old'],
			'sell_price'=>$datas['sell_price_old'],
			'discount'=>$datas['discount_old'],
		);
		$item_sell_unit = array(
			'sell_cate'=>$datas['sell_cate'],
			'sell_qty'=>$datas['sell_qty'],
			'sell_price'=>$datas['sell_price'],
			'discount'=>$datas['discount'],
		);
		$item_data = array(
			'item_name'=>$datas['item_name'],
			'item_name_kh'=>$datas['item_name_kh'],
			'item_unique_id'=>$datas['item_unique_id']=='' ? null:$datas['item_unique_id'],
			'model'=>$datas['model'],
			'category_id'=>$datas['category_id']=='' ? null:$datas['category_id'],
		);

		$redirect=$this->input->post('redirect');

		if($this->Item_products->save($item_data,$item_id,$item_sell_unit, $item_sell_unit_old))
		{
			//New category_products
			if($item_id==-1) {
				$message = lang('items_successful_adding').' '.$item_data['item_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'item_id'=>$item_data['item_id']));
			} else { //previous category_products
				$message = lang('items_successful_updating').' '.$item_data['item_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'item_id'=>$item_id));
			}
		}
		else //failure
		{
			echo json_encode(array('success'=>false,'message'=>lang('items_error_adding_updating').' '.
			$item_data['name'],'item_id'=>-1));
		}

	}
	function clear_state()
	{
		$this->session->unset_userdata('item_search_data');
		redirect('product_items');
	}
	function remove_unit(){
		$id = $_POST['id'];
		echo $this->Item_products->remove_unit($id);
	}

	function search_typeUnit(){
		$id = $_POST['id'];
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'item_unique_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$item_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => '',  'category' => '');
		$this->session->set_userdata("item_search_data",$item_search_data);
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$query = $this->Item_products->getUnitItem($id, $per_page, $offset, $order_col, $order_dir);

		$config['base_url'] = site_url('items/search');
		$config['total_rows'] = $this->Item_products->getUnitItem_count_all($id);
		$config['per_page'] = $per_page ;

		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_items_manage_table_data_rows($query,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

				function sssearch()
				{
					$this->check_action_permission('search');
					$search=$this->input->post('search');
					$category = $this->input->post('category');
					$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
					$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'item_unique_id';
					$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

					$item_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search,  'category' => $category);
					$this->session->set_userdata("item_search_data",$item_search_data);
					$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
					$search_data=$this->Item_products->search($search, $per_page, $offset, $order_col, $order_dir);
					$config['base_url'] = site_url('items/search');
					$config['total_rows'] = $this->Item_products->search_count_all($search, $category);
					$config['per_page'] = $per_page ;
					$this->pagination->initialize($config);
					$data['pagination'] = $this->pagination->create_links();
					$data['manage_table']=get_items_manage_table_data_rows($search_data,$this);
					echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
				}

	function discount_unit(){
		$row_ids = $_POST['row_ids'];
		$searchUnitType = $_POST['searchUnitType'];
		$disocunt = $_POST['disocunt'];
		$query = $this->Item_products->update_discount($searchUnitType, $row_ids, $disocunt);
		if($query == 1){
			echo json_encode(array('success'=>true,'message'=>lang('items_success_discount_all')));
		}else{
			echo json_encode(array('success'=>false,'message'=>lang('items_not_success_discount_all')));
		}
	}

}