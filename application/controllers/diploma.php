<?php
require_once ("secure_area.php");
class Diploma extends Secure_area 
{

	// college
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('diploma/manage_diploma',$data);
	}

	function form_diploma() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('diploma/form_diploma',$data);
	}



}