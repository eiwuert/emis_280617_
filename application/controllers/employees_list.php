<?php
require_once ("secure_area.php");
class Employees_list extends Secure_area 
{

	// college
	function index() {
		$data['controller_name']=strtolower(get_class());

		$this->load->view('employees_list/manage',$data);
	}
	

	function pdf() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('employees_list/pdf',$data);
	}

}