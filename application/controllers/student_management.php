<?php
require_once ("secure_area.php");
class Student_management extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students/student_management/manage',$data);
	}

	function form() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students/student_management/form_student',$data);
	}

	function view() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students/student_management/view_student',$data);
	}

}