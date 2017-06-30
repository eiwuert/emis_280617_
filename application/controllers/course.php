<?php
require_once ("secure_area.php");
class Course extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());

		$this->load->view('faculty/course/manage',$data);
	}

	function form() {
		$data['controller_name']=strtolower(get_class());
	
		$data['faculty'] = array(
							        'auto fill'	=> 'auto fill'
							     
		);

		$data['major'] = array(
							        'Management'	=> 'Management',
							        'Accounting'	=> 'Accounting',
							        'Banking and Finance'	=> 'Banking and Finance',
							        'Marketing'	=> 'Marketing',
							        'English'	=> 'English',
							        'Law'	=> 'Law',
							        'Economic'	=> 'Economic',
		);

		$data['degree'] = array(
									'auto fill'	=> 'auto fill'
		);

		$data['course_coordinator'] = array(
							        'Name 1'	=> 'Name 1',
							        'Name 2'	=> 'Name 2'
		);

		$data['set_time'] = array(
							        ''	=> '',
							        '7:00-8:00'	=> '7:00-8:00',
							        '8:00-9:00'	=> '8:00-9:00',
							        '9:00-10:00'	=> '9:00-10:00',
							        '10:00-11:00'	=> '10:00-11:00',
							        '11:00-12:00'	=> '11:00-12:00',
							        '12:00-13:00'	=> '12:00-13:00',
							        '13:00-14:00'	=> '13:00-14:00',
							        '14:00-15:00'	=> '14:00-15:00',
							        '15:00-16:00'	=> '15:00-16:00',
							        '16:00-17:00'	=> '16:00-17:00'
		);

		$this->load->view('faculty/course/form',$data);
	}
	function view() {
		$data['controller_name']=strtolower(get_class());
	

		$this->load->view('faculty/course/view',$data);
	}

	


}