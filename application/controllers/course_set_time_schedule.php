<?php
require_once ("secure_area.php");
class Course_set_time_schedule extends Secure_area 
{
	function __construct()
	{
		parent::__construct('course_set_time_schedule');
	}

	function index() {		

		$data['controller_name']=strtolower(get_class());
		$table_data = $this->Schedule->get_all()->result();

		$data['manage_table'] = get_table_schedule($table_data,$this);
	
		$this->load->view('faculty/course/time_schedule/manage',$data);
	}

	function view($id = '') {		
		$data['controller_name']=strtolower(get_class());		
		$data['get_time'] = $this->db->where('id',$id)->get('edu_course_schedule_times')->row();

		$this->load->view('faculty/course/time_schedule/form',$data);
	}

	function save($id=''){
		$controller_name =strtolower(get_class());
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$datapost = array('time' => $this->input->post('schedule'));

		if ($id > 0) {
			$datapost['updated_by'] = $logged_in_employee_id;
			$datapost['updated_at'] = date('Y-m-d H:i:s');
		}
		
		$this->Schedule->save($datapost, $id);
		redirect($controller_name);
	}

}