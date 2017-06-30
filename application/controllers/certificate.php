<?php
require_once ("secure_area.php");
class Certificate extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/display',$data);
	}
	function bachelor_degree() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/bachelor_degree',$data);
	}
	function master() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/master',$data);
	}
	function student_card(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/student_card',$data);
	}
	function student_card_economic(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/student_card_economic',$data);
	}
	
	function student_card_english(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/student_card_english',$data);
	}
	function student_card_law(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/student_card_law',$data);
	}
	function transcript_eng(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/transcript_eng',$data);
	}
	function academic_confirmation(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/academic_confirmation',$data);
	}
	function fdy_eng_pxi(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/fdy_eng_pxi',$data);
	}
	function fdy_eng_pxi2(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/fdy_eng_pxi2',$data);
	}
	function general_english(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/general_english',$data);
	}
	function teporaty_certificte(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('certificate/teporaty_certificte',$data);
	}
}