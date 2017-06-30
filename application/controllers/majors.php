<?php
require_once ("secure_area.php");
class Majors extends Secure_area
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['controller_name'] = strtolower(get_class());
		$data['total_rows'] = 2;
		$this->load->view('majors/manage', $data);
	}
}