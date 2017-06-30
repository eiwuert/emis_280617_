<?php
require_once ("secure_area.php");
class School_class extends Secure_area 
{
	function __construct()
	{
		parent::__construct('school_class');
	}

	function index($offset = 0) {

		$params = $this->session->userdata('school_class_search_data') ? $this->session->userdata('school_class_search_data') : array('offset' => 0, 'order_col' => 'school_class_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('school_class/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('school_class/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->School_class_model->search_count_all($data['search']);
			$table_data = $this->School_class_model->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->School_class_model->count_all();
			$table_data = $this->School_class_model->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_school_class_manage_table($table_data,$this);
		$this->load->view('school_class/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'school_class_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$school_class_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("school_class_search_data",$school_class_search_data);

		if ($search) {
			$config['total_rows'] = $this->School_class_model->search_count_all($search);
			$table_data = $this->School_class_model->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'school_class_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->School_class_model->count_all();
			$table_data = $this->School_class_model->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'school_class_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('school_class/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_school_class_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'school_class_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$school_class_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("school_class_search_data",$school_class_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->School_class_model->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('school_class/search');
		$config['total_rows'] = $this->School_class_model->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->School_class_model->search_count_all($search);
		$data['manage_table']= get_school_class_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Inserts/updates an school_class
	*/
	function save($school_class_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$school_class_data = array(
			'school_class_name'=>$this->input->post('school_class_name'),
			'school_class_note'=>$this->input->post('school_class_note')
		);

		if ($school_class_id != -1) {
			$school_class_data['updated_by'] = $logged_in_employee_id;
			$school_class_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$school_class_data['created_by'] = $logged_in_employee_id;
			$school_class_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->School_class_model->save($school_class_data, $school_class_id)) {			
			//New school_class
			if($school_class_id==-1) {
				$message = lang('school_class_successful_adding').' '.$school_class_data['school_class_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'school_class_id'=>$school_class_data['school_class_id']));
			} else { //previous school_class
				$message = lang('school_class_successful_updating').' '.$school_class_data['school_class_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'school_class_id'=>$school_class_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('school_class_error_adding_updating').' '.
			$school_class_data['school_class_name'],'school_class_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->School_class_model->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($school_class_id = -1) {

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['school_class_info'] = $this->School_class_model->get_info($school_class_id);
		$this->load->view('school_class/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->School_class_model->check_duplicate($this->input->post('term'))));
	}

	function school_class_exists()
	{
		if($this->School_class_model->school_class_exists($this->input->post('school_class_name')))
			echo 'false';
		else
			echo 'true';
	}

	/*
	This deletes school_class from the school_class table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$school_class_to_delete=$this->input->post('ids');
		
		if ($this->School_class_model->delete_list($school_class_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('school_class_successful_deleted').' '.
			count($school_class_to_delete).' '.lang('school_class_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('school_class_cannot_be_deleted')));
		}
	}

	function detail($school_class_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['school_class_info'] = $this->School_class_model->get_detail($school_class_id);
		$this->load->view('school_class/detail',$data);
	}

	function delete_by_id($school_class_id=-1) {
		$this->check_action_permission('delete');
		if ($school_class_id && $this->School_class_model->delete($school_class_id)) {
			echo json_encode(array('success'=>true, 'message'=>lang('school_class_successful_deleted'), 'school_class_id'=>$school_class_id));
		} else {
			echo json_encode(array('success'=>false, 'message'=>lang('school_class_error_delete'), 'school_class_id'=>$school_class_id));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('school_class_search_data');
		redirect('school_class');
	}

}