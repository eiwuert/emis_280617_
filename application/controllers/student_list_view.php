<?php
require_once ("secure_area.php");
class Student_list_view extends Secure_area 
{

	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->check_action_permission('search');			
			$data['major'] = $this->opt_skill();			
			$data['degree'] = $this->opt_degrees();			
			$data['batches'] = $this->opt_batch();
			$data['period'] = $this->opt_period();			
			$data['semester'] = $this->opt_semester();
			$data['schedule'] = $this->opt_schedule();
			$data['room'] = $this->opt_room();
			$data['year'] = $this->opt_year();
			$data['selection_print'] = $this->opt_selection_print();
		$this->load->view('students/stu_list_view/manage',$data);
	}

	function search_student($offset=0){
		$data['controller_name']=strtolower(get_class());	
		$this->check_action_permission('search');

		$post = $this->input->post();
		$this->session->set_userdata('ss_student_list_view', $post);

		// function 
		$data['major'] = $this->opt_skill();			
		$data['degree'] = $this->opt_degrees();			
		$data['batches'] = $this->opt_batch();
		$data['period'] = $this->opt_period();			
		$data['semester'] = $this->opt_semester();
		$data['schedule'] = $this->opt_schedule();
		$data['room'] = $this->opt_room();
		$data['year'] = $this->opt_year();
		$data['selection_print'] = $this->opt_selection_print();
		$print_type = array('0' => 'Print Paper', '1'=>'Print Excell' );
		// end blog functon
		$data['post'] = $post;	
		$params = array('offset' => $offset, 'order_col' => 'stu_master_id', 'order_dir' => 'desc');
		$config['base_url'] = site_url('student_list_view/search_student');
		$config['per_page'] = 3;
		$data['per_page'] = $config['per_page'];
		$config['total_rows'] = $this->Student_list_views->count_search_students($post,$search);
		$q_search_stu = $this->Student_list_views->get_search_students($post, $search, $data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		$data['type_p'] = $selection_print;

		// pagination
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();		
		$data['manage_table'] = get_stu_list_manage($q_search_stu,$this, $selection_print);
		$data['manage_table_action'] = get_stu_list_manage2($selection_print, $print_type);		
		$this->load->view('students/stu_list_view/manage',$data);
	}
	function search()
	{
		$print_type = array('0' => 'Print Paper', '1'=>'Print Excell' );
		$search = $this->input->post('search');
     	$post = $this->session->userdata('ss_student_list_view');	

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'ASC';

		$student_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("student_search_data",$student_search_data);
		$per_page = 20;
		$search_data = $this->Student_list_views->get_search_students($post, $search, $per_page, $offset, $order_col, $order_dir);
		$config['total_rows'] = $this->Student_list_views->count_search_students($post, $search);

		$config['base_url'] = site_url('student_list_view/search_student');	
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $config['total_rows'];
		$data['manage_table'] = get_stu_list_manage_data_rows($search_data,$this, $selection_print);
		$data['manage_table_action'] = get_stu_list_manage2($selection_print, $print_type);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function print_search($selection_print){
		$print_type = $this->input->post('print_type');
		$data['table_number'] = $this->input->post('table_number');
		$post = $this->session->userdata('ss_student_list_view');
		$q_search_stu = $this->Student_list_views->get_search_students($post, $selection_print, $search);

		$data['get_subj'] = $this->Student_list_views->get_subj_by_skill($post['major_name']);

		$data['section_name'] = $q_search_stu->row()->section_name;
		$data['batch_name'] = $q_search_stu->row()->batch_name;
		$data['grade_name'] = $q_search_stu->row()->grade_name;
		$data['course_schedule_semester'] = $q_search_stu->row()->course_schedule_semester;
		$data['university_name'] = $q_search_stu->row()->university_name;
		$data['university_name_kh'] = $q_search_stu->row()->university_name_kh;
		$data['skill_name_kh'] = $q_search_stu->row()->skill_name_kh;
		$data['level_name_kh'] = $q_search_stu->row()->level_name_kh;
		$data['stu_acad_schedule_id'] = $q_search_stu->row()->stu_acad_schedule_id;
		$data['room_name'] = $q_search_stu->row()->room_name;
		$data['type_p'] = $selection_print;

		$data['get_stu_info'] = $q_search_stu;
		if($post['selection_print'] == 0){
			if($print_type == 0){
				$this->load->view('students/stu_list_view/print_info',$data);
			}else{
				$this->load->view('students/stu_list_view/print_info_exc',$data);
			}
		}elseif($post['selection_print'] == 1){
			if($print_type == 0){
				$this->load->view('students/stu_list_view/print_info_exam',$data);
			}else{
				$this->load->view('students/stu_list_view/print_info_exam_exc',$data);
			}
		}
	}
	
	function suggest()
	{
     	$post = $this->session->userdata('ss_student_list_view');
		session_write_close();
		$suggestions = $this->Student_list_views->get_search_suggestions($this->input->get('term'),100, $post);
		echo json_encode($suggestions);
	}

	function clear_state()
	{
		$this->session->unset_userdata('ss_student_list_view');
		redirect('student_list_view');
	}

	function opt_skill(){
			$skills = $this->Student_list_views->get_all_skills();
			$skills_temp = ["" => '-- Select Major --'];
			foreach($skills as $key => $skill) {
				$skills_temp[$skill->skill_id] =  $skill->skill_name.' ('.$skill->skill_name_kh.')';
			}
			return $skills_temp;
		}
		function opt_degrees(){
			$degrees = $this->Student_list_views->get_all_degree();
			$degrees_temp = ["" => '--Select Degree--'];
			foreach($degrees as $key => $dg) {
				$degrees_temp[$dg->level_id] =  $dg->level_name.' ('.$dg->level_name_kh.')';
			}
			return $degrees_temp;
		}

		function opt_batch(){
			$batchs = $this->Student_list_views->get_all_batch();
			$batchs_temp = ["" => '--Select Batch--'];
			foreach($batchs as $key => $batch) {
				$batchs_temp[$batch->batch_id] =  $batch->batch_name;
			}
			return $batchs_temp;
		}

		function opt_period(){
			$period = array(''=> '--No field select--',
								1 => '1',
								2 => '2',
								3 => '3',
								4 => '4',
								5 => '5');
			return $period;
		}
		function opt_semester(){
			$semester = array(''=> '-- --',
								1 => '1',
								2 => '2');
			return $semester;
		}
		function opt_schedule(){
			$schedule = array(''=> '-- --',
								1 => 'Mon-Fri',
								2 => 'Sat-Sun');
			return $schedule;
		}
		function opt_room(){
			$room = $this->Student_list_views->get_all_room();
			$room_temp = ["" => '--Select Room--'];
			foreach($room as $key => $cl) {
				$room_temp[$cl->room_id] =  $cl->room_name;
			}
			return $room_temp;
		}
		function opt_selection_print(){
			return $selection_p = array('0'=>'Print Information', '1'=>'Print Exam');
		}
		function opt_year(){
			$years = $this->Student_list_views->get_all_section();
			$year_temp = ["" => '--Select Year--'];
			foreach($years as $key => $year) {
				$year_temp[$year->section_id] =  $year->section_name;
			}
			return $year_temp;
		}
}
