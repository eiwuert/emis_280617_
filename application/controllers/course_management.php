<?php
require_once ("secure_area.php");
class Course_management extends Secure_area 
{
	function __construct()
	{
		parent::__construct('course_management');
	}

	function index($offset = 0)
	{
		$params = $this->session->userdata('course_search_data') ? $this->session->userdata('course_search_data') : array('offset' => 0, 'order_col' => 'course_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('course_management/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('course_management/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Course->search_count_all($data['search']);
			$table_data = $this->Course->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Course->count_all();
			$table_data = $this->Course->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_course_manage_table($table_data,$this);

		$this->load->view('faculty/course/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'course_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$course_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("course_search_data",$course_search_data);

		if ($search) {
			$config['total_rows'] = $this->Course->search_count_all($search);
			$table_data = $this->Course->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'course_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Course->count_all();
			$table_data = $this->Course->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'course_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('course_management/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_course_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'course_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$course_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("course_search_data",$course_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Course->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('course_management/search');
		$config['total_rows'] = $this->Course->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Course->search_count_all($search);
		$data['manage_table']= get_course_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Course->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($course_id = -1) {
		$data['controller_name']=strtolower(get_class());
		$data['course_info'] = $this->Course->get_info($course_id);

		$data['academic_year'] = $this->opt_section();
		$data['coordinators'] = $this->opt_professor();
		$data['degree'] = $this->opt_degrees();
		$data['faculty'] = $this->opt_selection_faculty();

		$faculty_id = $data['course_info']->university_id;
		$degree_id = $data['course_info']->level_id;
		
		$skills = $this->Course->suggest_major($faculty_id, $degree_id)->result();
		$skills_temp = ["" => lang('students_select_skill')];
		foreach($skills as $key => $skill) {
			$skills_temp[$skill->skill_id] =  $skill->skill_name.' ('.$skill->skill_name_kh.')';
		}
		$data['major'] = $skills_temp;

		$batch = $this->Course->suggest_batch($faculty_id, $degree_id)->result();
		$batch_temp = ["" => ' -- -- '];
		foreach($batch as $key => $val) {
			$batch_temp[$val->batch_id] =  $val->batch_name;
		}
		$data['batch'] = $batch_temp;

		$data['year'] = $this->opt_grade();
		$data['semester'] = $this->opt_semester();
		$data['room'] = $this->opt_room();
		$this->load->view('faculty/course/form',$data);
	}

	/*
	Inserts/updates an course
	*/
	function save($course_id = -1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$course_data = array(
			'course_code'=>$this->input->post('course_code'),
			'course_name'=>$this->input->post('course_name'),
			'course_name_kh'=>$this->input->post('course_name_kh'),
			'skill_major_id'=>$this->input->post('major'),
			'level_id'=>$this->input->post('degree'),
			'university_id'=>$this->input->post('faculty'),
			'credit'=>$this->input->post('credit'),
			'course_coordinator_id'=>$this->input->post('course_coordinator'),
			'academic_year_id'=>$this->input->post('academic_year'),
			'course_subject_name'=>$this->input->post('course_subject_name'),
			'duration'=>$this->input->post('duration'),
			'room_id'=>$this->input->post('room'),

			'course_schedule_year'=>$this->input->post('course_schedule_year'),
			'course_schedule_semester'=>$this->input->post('course_schedule_semester'),
			'course_schedule_promote'=>$this->input->post('course_schedule_promote'),
			'course_schedule_date_today'=>date_format(date_create($this->input->post('course_schedule_date_today')),"Y-m-d"),
			'course_schedule_adjust_date'=>date_format(date_create($this->input->post('course_schedule_adjust_date')),"Y-m-d"),
			'course_schedule_midterm'=>date_format(date_create($this->input->post('course_schedule_midterm')),"Y-m-d"),
			'course_schedule_enddate'=>date_format(date_create($this->input->post('course_schedule_enddate')),"Y-m-d"),
			'course_schedule_final_from'=>date_format(date_create($this->input->post('course_schedule_final_from')),"Y-m-d"),
			'course_schedule_final_to'=>date_format(date_create($this->input->post('course_schedule_final_to')),"Y-m-d"),
			'course_faculty_date'=>date_format(date_create($this->input->post('course_faculty_date')),"Y-m-d")
		);
		
		if ($course_id != -1) {
			$course_data['updated_by'] = $logged_in_employee_id;
			$course_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$course_data['created_by'] = $logged_in_employee_id;
			$course_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Course->save($course_data, $course_id)) {
			//New course
			if($course_id==-1) {
				$message = lang('course_successful_adding').' '.$course_data['course_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'course_id'=>$course_data['course_id']));
			} else { //previous course
				$message = lang('course_successful_updating').' '.$course_data['course_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'course_id'=>$course_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('course_error_adding_updating').' '.
			$course_data['course_name'],'course_id'=>-1));
		}
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Course->check_duplicate($this->input->post('term'))));
	}

	function code_exists()
	{
		if($this->Course->code_exists($this->input->post('course_code')))
			echo 'false';
		else
			echo 'true';
	}

	function autocomplete_room()
	{
		$term =  $this->input->post('term');
		$data['success'] = false;
		$query = $this->Rooms->autocomplete_room(trim($term));
		if($query->num_rows() > 0){
			$data['success'] = true; //Set response
			$data['record'] = array(); //Create array
			foreach($query->result() as $row){
				$data['record'][] = array('label'=> $row->room_name, 'value'=> $row->room_name, 'item_id'=> $row->room_id); //Add a row to array
			}
		}
		echo json_encode($data);
	}

	function view_schedule($course_id='',$id='') {
		$data['controller_name']=strtolower(get_class());
		$data['course_id']=$course_id;
		$m = 'morning';
		$a = 'afternoon';
		$e = 'evening';
		$data['get_view_schedule_m'] = $this->Course->view_get_schedule($course_id, $m);
		$data['get_view_schedule_a'] = $this->Course->view_get_schedule($course_id, $a);
		$data['get_view_schedule_e'] = $this->Course->view_get_schedule($course_id, $e);
		$data['get_edit'] = $this->Course->get_schedule_edit($course_id, $id)->row();
		$get_courses_info = $this->Course->get_courses_info($course_id)->row();
		$get_cou_info_semester = $get_courses_info->course_schedule_semester;
		$get_cou_info_level_year = $get_courses_info->course_schedule_year;
		$get_cou_info_skill = $get_courses_info->skill_major_id;

		$data['class'] = $this->opt_class();
		$data['time'] = $this->opt_time_schedule();

		$data['times_schedule'] = $this->opt_during();
		$data['employee'] = $this->opt_employee();

		$subject = $this->Course->suggest_subject($get_cou_info_semester, $get_cou_info_level_year, $get_cou_info_skill)->result();
		$subject_temp = ["" => '-- Select Subject --'];
		foreach($subject as $key => $val) {
			$subject_temp[$val->sub_id] =  $val->subject_name.' ('.$val->subject_name_kh.')';
		}
		$data['subjects'] = $subject_temp;
		$this->load->view('faculty/course/view',$data);
	}

	function view_schedule2($course_id='',$id='') {
		$data['controller_name']=strtolower(get_class());
		$data['course_id']=$course_id;
		$m = 'morning';
		$a = 'afternoon';
		$e = 'evening';
		$data['get_view_schedule_m'] = $this->Course->view_get_schedule2($course_id, $m);
		$data['get_view_schedule_a'] = $this->Course->view_get_schedule2($course_id, $a);
		$data['get_view_schedule_e'] = $this->Course->view_get_schedule2($course_id, $e);

		$data['get_edit'] = $this->Course->get_schedule_edit2($course_id, $id)->row();

		$get_courses_info = $this->Course->get_courses_info($course_id)->row();
		$get_cou_info_semester = $get_courses_info->course_schedule_semester;
		$get_cou_info_level_year = $get_courses_info->course_schedule_year;
		$get_cou_info_skill = $get_courses_info->skill_major_id;

		

		$data['class'] = $this->opt_class();
		$data['room'] = $this->opt_room();
		$data['time'] = $this->opt_time_schedule();
		$data['times_schedule'] = $this->opt_during();
		$data['employee'] = $this->opt_employee();

		$subject = $this->Course->suggest_subject($get_cou_info_semester, $get_cou_info_level_year, $get_cou_info_skill)->result();
		$subject_temp = ["" => '-- Select Subject --'];
		foreach($subject as $key => $val) {
			$subject_temp[$val->sub_id] =  $val->subject_name.' ('.$val->subject_name_kh.')';
		}
		$data['subjects'] = $subject_temp;

		$this->load->view('faculty/course/view2',$data);
	}

	function delete_schedule($course_id, $form_type,$id='') {
		$this->check_action_permission('delete');

		$course_to_delete=$this->input->post('ids');
		$is_deleted = $this->Course->delete_schedule($form_type,$id);
		$get_view = ($form_type == 1)? 'view_schedule' : 'view_schedule2';
		redirect(site_url("course_management/$get_view/$course_id"));
	}
	function save_schedule($course_id,$id)
	{
		$post = $this->input->post();
		$data_schedule = array('class' => $post['class'],
							'time_id' => $post['time'],
							'time_schedule' => $post['times_schedule'],
							'room' => $post['room'],
							'form_type' => $post['form_type']);
		if($id == 0){
			$data_schedule['course_id'] = $course_id;
		}

		if($data_schedule['form_type'] == 'form1'){

			$data_schedule['mon_sub'] = $post['mon_sub'];
			$data_schedule['mon_prof'] = $post['mon_prof'];
			$data_schedule['tue_sub'] = $post['tue_sub'];
			$data_schedule['tue_prof'] = $post['tue_prof'];
			$data_schedule['wed_sub'] = $post['wed_sub'];
			$data_schedule['wed_prof'] = $post['wed_prof'];
			$data_schedule['thu_sub'] = $post['thu_sub'];
			$data_schedule['thu_prof'] = $post['thu_prof'];
			$data_schedule['fri_sub'] = $post['fri_sub'];
			$data_schedule['fri_prof'] = $post['fri_prof'];
			$save = $this->Course->add_schedule1($data_schedule, $course_id, $id);
		}else{

			$data_schedule['sat_sub'] = $post['sat_sub'];
			$data_schedule['sat_prof'] = $post['sat_prof'];
			$data_schedule['sun_sub'] = $post['sun_sub'];
			$data_schedule['sun_prof'] = $post['sun_prof'];
			$save = $this->Course->add_schedule2($data_schedule, $course_id, $id);			
		}
		if($save) {
				$message = lang('course_successful_adding_schedule');
				echo json_encode(array('success'=>true,'message'=>$message,'course_id'=>$course_id));
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('course_error_adding_updating_schedule').' '.
			$course_data['course_name'],'course_id'=>-1));
		}
	}


	/*
	This deletes course
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$course_to_delete=$this->input->post('ids');

		if ($this->Course->delete_list($course_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('course_successful_deleted').' '.
			count($course_to_delete).' '.lang('course_one_or_multiple')));
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('course_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('course_search_data');
		redirect('course_management');
	}

	function suggest_major(){
		$faculty_id = $this->input->post('faculty_id');	
		$query = array();
        $query = $this->Course->suggest_major($faculty_id)->result();
        echo json_encode($query);
	}

	// print course schedule
	function print_schedule($course_id, $id){
		$data['controller_name']=strtolower(get_class());
		$data['head_view_schedule'] = $this->Course->get_head_view_schedule($course_id);
		$m = 'morning';
		$a = 'afternoon';
		$e = 'evening';
		if($id == 1){
			$data['get_view_schedule_m'] = $this->Course->view_get_schedule($course_id, $m);
			$data['get_view_schedule_a'] = $this->Course->view_get_schedule($course_id, $a);
			$data['get_view_schedule_e'] = $this->Course->view_get_schedule($course_id, $e);
		}else{
			$data['get_view_schedule_m'] = $this->Course->view_get_schedule2($course_id, $m);
			$data['get_view_schedule_a'] = $this->Course->view_get_schedule2($course_id, $a);
			$data['get_view_schedule_e'] = $this->Course->view_get_schedule2($course_id, $e);
		}
		$this->load->view('faculty/course/print_course',$data);
	}

	
}