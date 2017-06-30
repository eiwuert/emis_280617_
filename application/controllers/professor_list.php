<?php
require_once ("secure_area.php");
class Professor_list extends Secure_area 
{

	// college
	function index() {
		$data['controller_name']=strtolower(get_class());

		$data['options'] = array('all'         => 'All',
						        'faculty'      => 'Department',
						        'major'        => 'Major');

		$this->load->view('professor_list/manage',$data);
	}
	

	function pdf() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('professor_list/pdf',$data);
	}

}