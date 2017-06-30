<?php
require_once ("secure_area.php");
class School_fee_payment extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());

		$this->load->view('faculty/fee_payment/manage',$data);
	}

	function form() {
		$data['controller_name']=strtolower(get_class());
		
			$data['course'] = array(	'Auto'	=> 'Auto',
						        'Introduction to Political Science'	=> 'Introduction to Political Science',
						        'Cultural Anthropology'	=> 'Cultural Anthropology'
			);
		$this->load->view('faculty/fee_payment/form',$data);
	}

	


}