<?php
require_once ("secure_area.php");
class Students_list_by_form extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students_list_by_form/manage',$data);
	}
	function detail_student_payment(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students_list_by_form/detail_student_payment',$data);
	}
}