<?php
require_once ("secure_area.php");
class Department_management extends Secure_area 
{
	function index()
	{
		echo "string";
	}

	// faculty
	function faculty() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('department_management/faculty',$data);
	}

	function form_faculty() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('department_management/form_faculty',$data);
	}

	// department
	function department() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('department_management/department',$data);
	}

	function form_department() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('department_management/form_department',$data);
	}	


	// major
	function major() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('department_management/major',$data);
	}

	function form_major() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('department_management/form_major',$data);
	}


}