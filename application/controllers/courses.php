<?php
require_once ("secure_area.php");
class Courses extends Secure_area
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$data['controller_name'] = strtolower(get_class());
		$data['total_rows'] = 2;
		$this->load->view('courses/manage', $data);
	}

	function view($course_id=-1)
	{
		$data['controller_name'] = strtolower(get_class());
		$this->load->view('courses/form', $data);
	}
}