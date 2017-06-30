<?php
require_once ("secure_area.php");
class Subjects extends Secure_area 
{
	function __construct()
	{
		parent::__construct('subjects');
	}

	function index() {
		$this->session->unset_userdata('subjects_search_data');
		$params = $this->session->userdata('subjects_search_data') ? $this->session->userdata('subjects_search_data') : array('offset' => 0, 'order_col' => 'sub_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('subjects/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('subjects/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Subject->search_count_all($data['search']);
			$table_data = $this->Subject->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Subject->count_all();
			$table_data = $this->Subject->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$major = $this->Subject->get_all_major();
		$major_temp = array();
		foreach($major as $key => $val) {
			$major_temp[$val->skill_id] =  $val->skill_name;
		}
		$data['major'] = $major_temp;

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_subjects_manage_table($table_data,$this);
		$this->load->view('faculty/subjects/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'sub_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$subjects_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("subjects_search_data",$subjects_search_data);

		if ($search) {
			$config['total_rows'] = $this->Subject->search_count_all($search);
			$table_data = $this->Subject->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'sub_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Subject->count_all();
			$table_data = $this->Subject->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'sub_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('subjects/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_subjects_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'sub_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$subjects_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("subjects_search_data",$subjects_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Subject->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('subjects/search');
		$config['total_rows'] = $this->Subject->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Subject->search_count_all($search);
		$data['manage_table']= get_subjects_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Inserts/updates an subject
	*/
	function save($sub_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$subject_major_id = $this->input->post('group_major');
		$subject_level_year = $this->input->post('subject_level_year');
		$subject_semester = $this->input->post('subject_semester');
		$subject_professors = $this->input->post('professors');
		$subject_data = array(
			'subject_name'=>$this->input->post('subject_name'),
			'subject_name_kh'=>$this->input->post('subject_name_kh'),
			'subjects_short_name'=>$this->input->post('subjects_short_name'),
			'subject_other'=>$this->input->post('subject_other'),
			'subject_credit'=>$this->input->post('subject_credit')
		);

		if ($sub_id != -1) {
			$subject_data['updated_by'] = $logged_in_employee_id;
			$subject_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$subject_data['created_by'] = $logged_in_employee_id;
			$subject_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Subject->save($subject_data, $subject_major_id, $subject_semester, $subject_level_year, $subject_professors, $sub_id)) {	
			//New subject
			if($sub_id==-1) {
				$message = lang('subject_successful_adding').' '.$subject_data['subject_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'sub_id'=>$subject_data['sub_id']));

			} else {
				$message = lang('subject_successful_updating').' '.$subject_data['subject_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'sub_id'=>$sub_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('subject_error_adding_updating').' '.
			$subject_data['subject_name'],'sub_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Subject->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Subject->check_duplicate($this->input->post('term'))));
	}

	function subjects_exists()
	{
		if($this->Subject->subjects_exists($this->input->post('subject_name')))
			echo 'false';
		else
			echo 'true';	
	}

	/*
	This deletes subject from the subject table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$subject_to_delete=$this->input->post('ids');
		
		if ($this->Subject->delete_list($subject_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('subject_successful_deleted').' '.
			count($subject_to_delete).' '.lang('subject_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('subject_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('subjects_search_data');
		redirect('subjects');
	}

	function view($sub_id) {
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['subject_info'] = $this->Subject->get_info($sub_id);
		$re_subj_major = $this->Subject->re_subj_major($data['subject_info']->sub_id);
		$re_subj_level_year = $this->Subject->re_subj_level_year($data['subject_info']->sub_id);
		$sem1 = 1;
		$sem2 = 2;
		$data['re_subj_semester1'] = $this->Subject->re_subj_semester($data['subject_info']->sub_id, $sem1);
		$data['re_subj_semester2'] = $this->Subject->re_subj_semester($data['subject_info']->sub_id, $sem2);

		$get_university_id = $data['subject_info']->subject_university_id;
		$e_major = array();
		foreach($re_subj_major as $key => $row){
			$e_major[] = $row->major_id;
		} 
		$data['edit_major'] = $e_major;

		$e_level_year = array();
		foreach($re_subj_level_year as $key => $row){
			$e_level_year[] = $row->level_year;
		} 
		$data['edit_level_year'] = $e_level_year;

		$major = $this->Subject->get_all_major();
		$major_temp = array();
		foreach($major as $key => $val) {
			$major_temp[$val->skill_id] =  $val->skill_name;
		}
		$data['major'] = $major_temp;

		$id_professor_by_subj = $this->Subject->get_view_prof_by_subj($sub_id)->result();
		$e_professor = array();
		foreach($id_professor_by_subj as $key => $row){
			$e_professor[] = $row->person_id;
		} 
		$data['edit_professor'] = $e_professor;

		$professors = $this->Subject->get_prof_drop_down($sub_id)->result();
		$professors_temp = array();
		foreach($professors as $key => $prof) {
			$professors_temp[$prof->person_id] =  $prof->first_name.' '.$prof->last_name;
		}
		$data['professors'] = $professors_temp;

		$data['subject_level_year'] = array('1' => 1,'2' => 2,'3' => 3,'4' => 4,'5' => 5,'6' => 6,'7' => 7,'8' => 8);
		$this->load->view('faculty/subjects/form',$data);
	}

	function print_subject(){
		$data['controller_name']=strtolower(get_class());		
		$major_id = $this->input->post('major');
		$data['subject_year'] = $this->Subject->get_subject_year($major_id);
		$data['major_name'] = $this->Subject->get_all_major_byid($major_id)->row()->skill_name;
		$this->load->view('faculty/subjects/print_subject_view',$data);
	}

	function suggestion_prof(){
		$id_prof = $_POST['id_prof'];
		$query = array();
		if($id_prof){
			$query = $this->Subject->get_prof_by_id($id_prof)->result();
		}
		echo json_encode($query);
	}
}