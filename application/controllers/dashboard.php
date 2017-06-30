<?php
require_once ("secure_area.php");
class Dashboard extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('dashboard/manage',$data);
	}

	// message

	function message() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('dashboard/list_message',$data);
	}

	function create_message() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('dashboard/add_message',$data);
	}

	function message_pdf() {
		print_r('Hi PDF');
	}

	function message_excel() {
		print_r('Hi Excel');
	}

	// notice 
	
	function notice() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('dashboard/list_notice',$data);
	}

	function create_notice() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('dashboard/add_notice',$data);
	}

	function notice_pdf() {
		print_r('Hi PDF notice');
	}

	function notice_excel() {
		print_r('Hi Excel notice');
	}

	// event

	function event() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('dashboard/list_event',$data);
	}
}