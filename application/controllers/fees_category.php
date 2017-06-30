<?php
require_once ("secure_area.php");
class Fees_category extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('fees/fee_category/manage',$data);
	}

	function view(){

		$data['controller_name']=strtolower(get_class());
		$this->load->view('fees/fee_category/form',$data);

	}

	function view_fee($category_id){		

		$data['controller_name']=strtolower(get_class());
		$this->load->view('fees/fee_category/form_fee',$data);
	}

	function detail($category_id){

		$data['controller_name']=strtolower(get_class());
		$this->load->view('fees/fee_category/detail',$data);

	}


}