<?php
require_once ("secure_area.php");
class Po extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('items/po/manage',$data);
	}

	function view() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('items/po/view',$data);
	}
}