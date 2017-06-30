<?php
require_once ("secure_area.php");
class Grade extends Secure_area 
{
	function __construct()
	{
		parent::__construct('grade');
	}

	function index($offset = 0) {
		$params = $this->session->userdata('grade_search_data') ? $this->session->userdata('grade_search_data') : array('offset' => 0, 'order_col' => 'grade_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('grade/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('grade/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Grades->search_count_all($data['search']);
			$table_data = $this->Grades->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Grades->count_all();
			$table_data = $this->Grades->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_grade_manage_table($table_data,$this);
		
		$this->load->view('grade/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'grade_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$grade_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("grade_search_data",$grade_search_data);

		if ($search) {
			$config['total_rows'] = $this->Grades->search_count_all($search);
			$table_data = $this->Grades->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'grade_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Grades->count_all();
			$table_data = $this->Grades->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'grade_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('grade/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_grade_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'grade_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$grade_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("grade_search_data",$grade_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Grades->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('grade/search');
		$config['total_rows'] = $this->Grades->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Grades->search_count_all($search);
		$data['manage_table']= get_grade_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Inserts/updates an grade
	*/
	function save($grade_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$grade_data = array(
			'grade_name'=>$this->input->post('grade_name'),
			'grade_note'=>$this->input->post('grade_note')
		);

		if ($grade_id != -1) {
			$grade_data['updated_by'] = $logged_in_employee_id;
			$grade_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$grade_data['created_by'] = $logged_in_employee_id;
			$grade_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Grades->save($grade_data, $grade_id)) {			
			//New grade
			if($grade_id==-1) {
				$message = lang('grade_successful_adding').' '.$grade_data['grade_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'grade_id'=>$grade_data['grade_id']));
			} else { //previous grade
				$message = lang('grade_successful_updating').' '.$grade_data['grade_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'grade_id'=>$grade_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('grade_error_adding_updating').' '.
			$grade_data['grade_name'],'grade_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Grades->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($grade_id = -1) {

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['grade_info'] = $this->Grades->get_info($grade_id);
		$this->load->view('grade/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Grades->check_duplicate($this->input->post('term'))));
	}

	function grade_exists()
	{
		if($this->Grades->grade_exists($this->input->post('grade_name')))
			echo 'false';
		else
			echo 'true';
	}

	/*
	This deletes grade from the grade table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$grade_to_delete=$this->input->post('ids');
		
		if ($this->Grades->delete_list($grade_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('grade_successful_deleted').' '.
			count($grade_to_delete).' '.lang('grade_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('grade_cannot_be_deleted')));
		}
	}

	function detail($grade_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['grade_info'] = $this->Grades->get_detail($grade_id);
		$this->load->view('grade/detail',$data);
	}

	function delete_by_id($grade_id=-1) {
		$this->check_action_permission('delete');
		if ($grade_id && $this->Grades->delete($grade_id)) {
			echo json_encode(array('success'=>true, 'message'=>lang('grade_successful_deleted'), 'grade_id'=>$grade_id));
		} else {
			echo json_encode(array('success'=>false, 'message'=>lang('grade_error_delete'), 'grade_id'=>$grade_id));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('grade_search_data');
		redirect('grade');
	}

}