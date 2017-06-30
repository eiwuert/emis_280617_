<?php
require_once ("secure_area.php");
class Student_information extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students/student_information/manage_student_info',$data);
	}

	function form_student_info() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students/student_information/form_student_info',$data);
	}

	function view() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students/student_information/view_student_info',$data);
	}
}