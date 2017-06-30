<?php
require_once ("secure_area.php");
class Score_management extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/manage',$data);
	}

	function form() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/form',$data);
	}


	// semester 1

	function semester_i(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/manage_semester_i',$data);
	}
	function form_semester_i(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/form_semester_i',$data);
	}
	function score_semester_i(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/add_score_semester_i',$data);
	}


	// semester 2

	function semester_ii(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/manage_semester_ii',$data);
	}
	function form_semester_ii(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/form_semester_ii',$data);
	}
	function score_semester_ii(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/add_score_semester_ii',$data);
	}


	// final exam


	function final_exam(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/manage_final_exam',$data);
	}
	function form_final_exam(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/form_final_exam',$data);
	}
	function score_final_exam(){
		$data['controller_name']=strtolower(get_class());
		$this->load->view('score_management/add_score_final_exam',$data);
	}


}