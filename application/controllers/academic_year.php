<?php
require_once ("secure_area.php");
class Academic_year extends Secure_area 
{
	function __construct()
	{
		parent::__construct('academic_year');
	}

	function index() {
		$params = $this->session->userdata('academic_search_data') ? $this->session->userdata('academic_search_data') : array('offset' => 0, 'order_col' => 'section_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('academic_year/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('academic_year/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Section->search_count_all($data['search']);
			$table_data = $this->Section->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Section->count_all();
			$table_data = $this->Section->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_academic_manage_table($table_data,$this);
		
		$this->load->view('academic_year/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'section_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$academic_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("academic_search_data",$academic_search_data);

		if ($search) {
			$config['total_rows'] = $this->Section->search_count_all($search);
			$table_data = $this->Section->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'section_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Section->count_all();
			$table_data = $this->Section->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'section_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('academic_year/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_academic_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'section_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$academic_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("academic_search_data",$academic_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Section->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('academic_year/search');
		$config['total_rows'] = $this->Section->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Section->search_count_all($search);
		$data['manage_table']= get_academic_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Inserts/updates an section
	*/
	function save($section_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$section_data = array(
			'section_name'=>$this->input->post('section_name'),
		);

		if ($section_id != -1) {
			$section_data['updated_by'] = $logged_in_employee_id;
			$section_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$section_data['created_by'] = $logged_in_employee_id;
			$section_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Section->save($section_data, $section_id)) {			
			//New section
			if($section_id==-1) {
				$message = lang('section_successful_adding').' '.$section_data['section_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'section_id'=>$section_data['section_id']));
			} else { //previous section
				$message = lang('section_successful_updating').' '.$section_data['section_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'section_id'=>$section_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('section_error_adding_updating').' '.
			$section_data['section_name'],'section_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Section->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($section_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['section_info'] = $this->Section->get_info($section_id);
		$this->load->view('academic_year/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Section->check_duplicate($this->input->post('term'))));
	}

	function section_exists()
	{
		if($this->Section->section_exists($this->input->post('section_name')))
			echo 'false';
		else
			echo 'true';
	}

	/*
	This deletes section from the section table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$section_to_delete=$this->input->post('ids');
		
		if ($this->Section->delete_list($section_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('section_successful_deleted').' '.
			count($section_to_delete).' '.lang('section_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('section_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('academic_search_data');
		redirect('academic_year');
	}

}