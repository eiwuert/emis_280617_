<?php
require_once ("secure_area.php");
class Students_by_major extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->load->view('students_by_major/manage',$data);
	}
}