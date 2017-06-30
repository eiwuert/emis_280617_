<?php
require_once ("secure_area.php");
class Print_transcription extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('transcription/view',$data);
	}

}