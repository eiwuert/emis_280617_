<?php

require_once ("secure_area.php");
class Score extends Secure_area
{
	function index($offset=0) {
		$data['controller_name']=strtolower(get_class());
		$this->check_action_permission('view');
			$params = $this->session->userdata('stu_score_search_data') ? $this->session->userdata('stu_score_search_data') : array('offset' => 0, 'order_col' => 'stu_master_id', 'order_dir' => 'desc', 'search' => FALSE);
			if ($offset!=$params['offset'])
			{
			   redirect('score/index/'.$params['offset']);
			}
			$config['base_url'] = site_url('score/sorting');
			$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
			$data['per_page'] = $config['per_page'];
			$config['total_rows'] = $this->Score_model->count_all();
			$table_data = $this->Score_model->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
			$data['total_rows'] = $config['total_rows'];
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$data['order_col'] = $params['order_col'];
			$data['order_dir'] = $params['order_dir'];
			$data['manage_table']=get_score_manage_table($table_data,$this);

			$data['major'] = $this->opt_selection_major();
			$data['degree'] = $this->opt_degrees();
			$data['batches'] = $this->opt_batches();
			$data['period'] = $this->opt_grade();
			$data['semester'] = $this->opt_semester();
			$data['schedule'] = $this->opt_schedule();
			$data['room'] = $this->opt_room();
			$data['year'] = $this->opt_section();
		$this->load->view('score/manage',$data);
	}


	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page= $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';
		$stu_score_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("stu_score_search_data",$stu_score_search_data);
		$config['total_rows'] = $this->Score_model->count_all();
		$table_data = $this->Score_model->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		$config['base_url'] = site_url('score/sorting');
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_score_manage_table($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search_student($offset=0){
			$data['controller_name']=strtolower(get_class());
			$search = ($this->input->post('search'))? $this->input->post('search'): '' ;
			if($this->input->post('submit')){
				$this->session->unset_userdata('major_id');
				$this->session->unset_userdata('batch');
				$this->session->unset_userdata('year');
				$this->session->unset_userdata('period');
				$this->session->unset_userdata('degree');
				$this->session->unset_userdata('semester');
				$this->session->unset_userdata('room');
			}

			$data['major'] = $this->opt_selection_major();
			$data['degree'] = $this->opt_degrees();
			$data['batches'] = $this->opt_batches();
			$data['period'] = $this->opt_grade();
			$data['semester'] = $this->opt_semester();
			$data['schedule'] = $this->opt_schedule();
			$data['room'] = $this->opt_room();
			$data['year'] = $this->opt_section();

			$major_id = ($this->session->userdata('major_id'))? $this->session->userdata('major_id') : $this->input->post('major_name');
			$batch = ($this->session->userdata('batch'))? $this->session->userdata('batch') : $this->input->post('batch');
			$year = ($this->session->userdata('year'))? $this->session->userdata('year') : $this->input->post('year');
			$period = ($this->session->userdata('period'))? $this->session->userdata('period') : $this->input->post('period');
			$degree_id = ($this->session->userdata('degree'))? $this->session->userdata('degree') : $this->input->post('degree');
			$semester = ($this->session->userdata('semester'))? $this->session->userdata('semester') : $this->input->post('semester');
			$schedule = ($this->session->userdata('schedule'))? $this->session->userdata('schedule') : $this->input->post('schedule');
			$room = ($this->session->userdata('room'))? $this->session->userdata('room') : $this->input->post('room');

			$this->session->set_userdata('major_id', $major_id);
			$this->session->set_userdata('batch', $batch);
			$this->session->set_userdata('year', $year);
			$this->session->set_userdata('period', $period);
			$this->session->set_userdata('degree', $degree_id);
			$this->session->set_userdata('semester', $semester);
			$this->session->set_userdata('schedule', $schedule);
			$this->session->set_userdata('room', $room);

			$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
			$data['per_page'] = $config['per_page'];

			$q_search_stu = $this->Score_model->get_search_students($major_id, $batch, $year, $period, $degree_id, $semester, $schedule, $room, $search);
			$data['manage_table'] = get_score_manage_table($q_search_stu,$this);
			$this->load->view('score/manage',$data);
	}
	/* Gives search suggestions based on what is being searched for */
	function suggest()
	{
		$sug_data = array('major_id' => $this->session->userdata('major_id'),
							'batch' => $this->session->userdata('batch'),
							'year' => $this->session->userdata('year'),
							'period' => $this->session->userdata('period'),
							'degree_id' => $this->session->userdata('degree'));
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Score_model->suggestions_score_stu_search($this->input->get('term'),100,$sug_data);
		echo json_encode($suggestions);
	}

	/*==============*/
	/* Do scroe */
	/*==============*/
	function form($id_stu_acad,$eid){
		$data['controller_name']=strtolower(get_class());
		$get_info_stu_final = $this->Score_model->get_all_info_stu_by_id($id_stu_acad);
		$data['input_skill_id'] = $get_info_stu_final->row()->skill_id;
		$data['input_grade'] = $get_info_stu_final->row()->grade_id;
		$data['student_room'] = $get_info_stu_final->row()->room_id;
		$data['result_final_byid'] = $this->Score_model->get_all_result_final_byid($eid);

		$data['subjects'] = $this->opt_subject();
		$data['semester'] = $this->opt_semester();

		$data['stu_id'] = $get_info_stu_final->row()->stu_info_id;
		$data['skill_id'] = $get_info_stu_final->row()->skill_id;
		$data['level_year'] = $get_info_stu_final->row()->section_id;

		$get_result_final1 = $this->Score_model->get_all_result_final1($get_info_stu_final->row()->stu_info_id);
		$get_result_final2 = $this->Score_model->get_all_result_final2($get_info_stu_final->row()->stu_info_id);

		$get_result_re_final1 = $this->Score_model->get_all_result_re_final1($get_info_stu_final->row()->stu_info_id);
		$get_result_re_final2 = $this->Score_model->get_all_result_re_final2($get_info_stu_final->row()->stu_info_id);

		$data['stu_info'] = $get_info_stu_final;

		$data['manage_student_info'] = get_score_manage_table_info($get_info_stu_final,$this);
		$data['manage_result_sco_final1'] = manage_table_result_sco_final1($get_result_final1,$this);
		$data['manage_result_sco_final2'] = manage_table_result_sco_final2($get_result_final2,$this);

		$data['manage_result_sco_re_final1'] = manage_table_result_sco_re_final1($get_result_re_final1,$this);
		$data['manage_result_sco_re_final2'] = manage_table_result_sco_re_final2($get_result_re_final2,$this);

		$this->load->view('score/form',$data);
	}

	function add_final($stu_id,$id){
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$post = $this->input->post();
		$final = array('student_final_acad_id' => $post['student_acad_id'],
						'subject_id' => $post['subject'],
						'student_id' => $stu_id,
						'semester' => $post['semester'],
						'student_skill_id' => $post['student_skill_id'],
						'student_grade' => $post['student_grade'],
						'student_room' => $post['student_room'],
						'attendance_score' => $post['attendance'],
						'midterm_group_discussion_score' => $post['group_discusion'],
						'midterm_quiz_score' => $post['quize'],
						'midterm_assignment_score' => $post['assignment'],
						'midterm_exam_score' => $post['exam'],
						'final_score' => $post['final'],
						'ch_re_exam' => ($post['re_exam'])? $post['re_exam'] : 0,
						'ch_score_other_school' => ($post['score_other_school'])? $post['score_other_school'] : 0,
						);
		if ($id == -1) {
			$final['created_by'] = $logged_in_employee_id;
			$final['created_at'] = date('Y-m-d H:i:s');
		}else{
			$final['updated_by'] = $logged_in_employee_id;
			$final['updated_at'] = date('Y-m-d H:i:s');
		}
		if($this->Score_model->save_score_final($final,$id)){
			//New section
			if($id == -1) {
				$message = lang('score_successful_add').' '.$final['final'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$final['id']));
			} else { //previous section
				$message = lang('score_successful_update').' '.$final['final'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		}else{
			echo json_encode(array('success'=>false,'message'=>lang('score_successful_add').' '.
			$final['final'],'id'=>-1));
		}
	}
	function nas($id_stu_acad,$eid){
		$data['controller_name']=strtolower(get_class());
		$get_info_stu_nas = $this->Score_model->get_all_info_stu_by_id($id_stu_acad);
		$data['stu_acad_id'] = $get_info_stu_nas->row()->stu_acad_id;
		$data['stu_info'] = $get_info_stu_nas;

		$data['input_skill_id'] = $get_info_stu_nas->row()->skill_id;
		$data['input_grade'] = $get_info_stu_nas->row()->grade_id;
		$data['student_room'] = $get_info_stu_nas->row()->room_id;

		$data['semester'] = $this->opt_semester();

		$get_nas_final1 = $this->Score_model->get_nas_final1($get_info_stu_nas->row()->stu_info_id);
		$get_nas_final2 = $this->Score_model->get_nas_final2($get_info_stu_nas->row()->stu_info_id);

		$data['result_nas_byid'] = $this->Score_model->get_nas_byid($eid);
		$data['manage_student_info'] = get_score_manage_table_info($get_info_stu_nas,$this);
		$data['manage_result_sco_final1'] = manage_table_nas_final1($get_nas_final1,$this);
		$data['manage_result_sco_final2'] = manage_table_nas_final2($get_nas_final2,$this);
		$this->load->view('score/nas',$data);
	}
	function add_nas($stu_id,$id){
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$post = $this->input->post();
		$nas_data = array('student_id' => $stu_id,
						'nas' => $post['nas'],
						'semester' => $post['semester'],
						'student_skill_id' => $post['student_skill_id'],
						'student_grade' => $post['student_grade'],
						'student_room' => $post['student_room']	,
						'student_nas_acad_id' => $post['student_acad_id']
						);
		if ($id == -1) {
			$nas_data['created_by'] = $logged_in_employee_id;
			$nas_data['created_at'] = date('Y-m-d H:i:s');
		}else{
			$nas_data['updated_by'] = $logged_in_employee_id;
			$nas_data['updated_at'] = date('Y-m-d H:i:s');
		}
		if($this->Score_model->save_nas($nas_data,$id)){
			//New section
			if($id == -1) {
				$message = lang('score_successful_add').' '.$nas_data['nas'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$nas_data['id']));
			} else { //previous section
				$message = lang('score_successful_update').' '.$nas_data['nas'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		}else{
			echo json_encode(array('success'=>false,'message'=>lang('score_successful_add').' '.
			$nas_data['nas'],'id'=>-1));
		}
	}
	function pre_exam($id_stu_acad,$eid){
		$data['controller_name']=strtolower(get_class());
		$get_info_stu_pre = $this->Score_model->get_all_info_stu_by_id($id_stu_acad);
		$data['stu_acad_id'] = $get_info_stu_pre->row()->stu_acad_id;
		$data['input_skill_id'] = $get_info_stu_pre->row()->skill_id;
		$data['input_grade'] = $get_info_stu_pre->row()->students_grade;
		$data['student_room'] = $get_info_stu_pre->row()->stu_master_stu_room;

		$get_result_pre = $this->Score_model->get_all_result_pre($get_info_stu_pre->row()->stu_info_id);
		$data['result_pre_byid'] = $this->Score_model->get_all_result_pre_byid($eid);
		$semester_id = $get_info_stu_pre->row()->course_schedule_semester;
		$skill_id = $get_info_stu_pre->row()->skill_id;
		$level_year = $get_info_stu_pre->row()->section_id;
		// in model get_all_subjects()
		$subject = $this->Score_model->suggest_subject_score($semester_id, $skill_id, $level_year)->result();
		$subject_temp = ["" => lang('--Select Subject--')];
		foreach($subject as $key => $sj) {
			$subject_temp[$sj->sub_id] =  $sj->subject_name.' ('.$sj->subject_name_kh.')';
		}
		$data['subjects'] = $subject_temp;
		$data['stu_info'] = $get_info_stu_pre;

		$data['manage_student_info'] = get_score_manage_table_info($get_info_stu_pre,$this);
		$data['manage_result_sco_pre'] = manage_table_result_sco_pre($get_result_pre,$this);
		$this->load->view('score/form_pre',$data);
	}

	function add_subj_score($stu_id,$id){
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$post = $this->input->post();
		$score_pre = array('student_skill_id' => $post['student_skill_id'],
						'student_grade' => $post['student_grade'],
						'student_room' => $post['student_room'],
						'score' => $post['score_pre'],
						'subject_id' => $post['subject'],
						'student_id' => $stu_id,
						'student_pre_acad_id' => $post['student_acad_id']
						);
		if ($id == -1) {
			$score_pre['created_by'] = $logged_in_employee_id;
			$score_pre['created_at'] = date('Y-m-d H:i:s');
		}else{
			$score_pre['updated_by'] = $logged_in_employee_id;
			$score_pre['updated_at'] = date('Y-m-d H:i:s');
		}
		if($this->Score_model->save_score_pre($score_pre,$id)){
			//New section
			if($id == -1) {
				$message = lang('score_successful_add').' '.$score_pre['score'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$score_pre['id']));
			} else { //previous section
				$message = lang('score_successful_update').' '.$score_pre['score'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		}else{
			echo json_encode(array('success'=>false,'message'=>lang('score_error_adding_updating').' '.
			$score_pre['score'],'id'=>-1));
		}
	}
	function state_exam($id_stu_acad,$eid){
		$data['controller_name']=strtolower(get_class());
		$get_info_stu_state = $this->Score_model->get_all_info_stu_by_id($id_stu_acad);
		$data['stu_acad_id'] = $get_info_stu_state->row()->stu_acad_id;
		$data['input_skill_id'] = $get_info_stu_state->row()->skill_id;
		$data['input_grade'] = $get_info_stu_state->row()->grade_id;
		$data['student_room'] = $get_info_stu_state->row()->room_id;
		$get_result_state = $this->Score_model->get_all_result_state($get_info_stu_state->row()->stu_info_id);
		$data['result_state_byid'] = $this->Score_model->get_all_result_state_byid($eid);

		$semester_id = $get_info_stu_state->row()->course_schedule_semester;
		$skill_id = $get_info_stu_state->row()->skill_id;
		$level_yar = $get_info_stu_state->row()->section_id;

		$subject = $this->Score_model->suggest_subject_score($semester_id, $skill_id, $level_yar)->result();
		$subject_temp = ["" => lang('--Select Subject--')];
		foreach($subject as $key => $sj) {
			$subject_temp[$sj->sub_id] =  $sj->subject_name.' ('.$sj->subject_name_kh.')';
		}
		$data['subjects'] = $subject_temp;
		$data['stu_info'] = $get_info_stu_state->row();

		$data['manage_student_info'] = get_score_manage_table_info($get_info_stu_state,$this);
		$data['manage_result_sco_state'] = manage_table_result_sco_state($get_result_state,$this);
		$this->load->view('score/form_state',$data);
	}

	function add_subj_state_exam($stu_id,$id){
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$post = $this->input->post();
		$score_state = array('student_skill_id' => $post['student_skill_id'],
							'student_grade' => $post['student_grade'],
							'student_room' => $post['student_room'],
							'subject_id' =>$post['subject'],
							 'score' =>$post['score'],
							'student_id' => $stu_id,
							'student_state_acad_id' => $post['student_acad_id'] );
		if ($id == -1) {
			$score_state['created_by'] = $logged_in_employee_id;
			$score_state['created_at'] = date('Y-m-d H:i:s');
		}else{
			$score_state['updated_by'] = $logged_in_employee_id;
			$score_state['updated_at'] = date('Y-m-d H:i:s');
		}
		if($this->Score_model->save_score_state($score_state,$id)){
			//New section
			if($id == -1) {
				$message = lang('score_successful_add').' '.$score_state['student_id'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$score_state['id']));
			} else { //previous section
				$message = lang('score_successful_update').' '.$score_state['student_id'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		}else{
			echo json_encode(array('success'=>false,'message'=>lang('score_error_adding_updating').' '.
			$score_state['subject_id'],'id'=>-1));
		}
	}

	function thesis($id_stu_acad,$eid){
		$data['controller_name']=strtolower(get_class());
		$get_info_stu_thesis = $this->Score_model->get_all_info_stu_by_id($id_stu_acad);
		$data['stu_acad_id'] = $get_info_stu_thesis->row()->stu_acad_id;
		$data['input_skill_id'] = $get_info_stu_thesis->row()->skill_id;
		$data['input_grade'] = $get_info_stu_thesis->row()->grade_id;
		$data['student_room'] = $get_info_stu_thesis->row()->room_id;
		$get_result_thesis = $this->Score_model->get_all_result_thesis($get_info_stu_thesis->row()->stu_info_id);
		$data['result_state_byid'] = $this->Score_model->get_all_result_thesis_byid($eid);
		$data['stu_info'] = $get_info_stu_thesis;
		$data['manage_student_info'] = get_score_manage_table_info($get_info_stu_thesis,$this);
		$data['manage_result_sco_thesis'] = manage_table_result_sco_thesis($get_result_thesis,$this);
		$this->load->view('score/form_thesis',$data);
	}
	function add_thesis($stu_id,$id){
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$post = $this->input->post();
		$score_thesis = array('student_skill_id' => $post['student_skill_id'],
							'student_grade' => $post['student_grade'],
							'student_room' => $post['student_room'],
							'thesis_written_score' => $post['written'],
							'thesis_defence_date' => date('Y-m-d',strtotime($post['defence'])),
							'student_id' => $stu_id,
							'student_thesis_acad_id' => $post['student_acad_id']
							);
		if ($id == -1) {
			$score_thesis['created_by'] = $logged_in_employee_id;
			$score_thesis['created_at'] = date('Y-m-d H:i:s');
		}else{
			$score_thesis['updated_by'] = $logged_in_employee_id;
			$score_thesis['updated_at'] = date('Y-m-d H:i:s');
		}

		if($this->Score_model->save_score_thesis($score_thesis,$id)){
			//New section
			if($id == -1) {
				$message = lang('score_successful_add').' '.$score_thesis['student_id'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$score_thesis['id']));
			} else { //previous section
				$message = lang('score_successful_update').' '.$score_thesis['student_id'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		}else{
			echo json_encode(array('success'=>false,'message'=>lang('score_error_adding_updating').' '.
			$score_thesis['student_id'],'id'=>-1));
		}
	}
	function suggest_code_major(){
		//allow parallel searchs to improve performance.
		session_write_close();
		$view_suggestions = $this->Score_model->get_code_major_suggestions($this->input->get('term'),100);
		echo json_encode($view_suggestions);
	}
	function get(){
		$get_id = $_POST["id"];
		$q_skill = $this->Score_model->get_skill_by_id($get_id);
		echo $q_skill->row()->skill_major_code;
	}
	function delete_pre_exam($stu_id,$id){
		if($this->Score_model->del_pre_exam($id) == 1){
			redirect(site_url("score/pre_exam/$stu_id"));
		}
	}
	function delete_state_exam($stu_id,$eid){
		if($this->Score_model->del_state_exam($eid) == 1){
			redirect(site_url("score/state_exam/$stu_id"));
		}
	}
	function delete_thesis($stu_id,$eid){
		if($this->Score_model->del_thesis($eid) == 1){
			redirect(site_url("score/thesis/$stu_id"));
		}
	}
	function delete_final_form($stu_id,$eid){
		if($this->Score_model->del_final_from($eid) == 1){
			redirect(site_url("score/form/$stu_id"));
		}
	}
	function delete_nas_form($stu_id,$eid){
		if($this->Score_model->del_nas_from($eid) == 1){
			redirect(site_url("score/nas/$stu_id"));
		}
	}
	function clear_state()
	{
		$this->session->unset_userdata('major_id');
		$this->session->unset_userdata('batch');
		$this->session->unset_userdata('year');
		$this->session->unset_userdata('period');
		$this->session->unset_userdata('degree');
		redirect('score');
	}
	function print_list(){
		$stu_print = $this->input->post('stu_print');
		if(empty($stu_print)){
			redirect(site_url('score'));
		}
		// student (1)
		$data['get_stu']= $this->Score_model->get_stu_score($stu_print);
		$skill = $data['get_stu']->row()->skill_id;
		$semester = $data['get_stu']->row()->course_schedule_semester;
		$level_yar = $data['get_stu']->row()->course_schedule_year;
		//(2)
		$data['subject'] = $this->Score_model->get_row_subjects($skill, $semester, $level_yar);
		// RANK
		$this->load->view('score/print_list',$data);
	}
	function suggest_subject(){
		$semester_id = $this->input->post('semester_id');
		$skill_id = $this->input->post('skill_id');
		$level_yar = $this->input->post('level_yar');
		$query = array();
        $query = $this->Score_model->suggest_subject_score($semester_id, $skill_id, $level_yar)->result();
        echo json_encode($query);
	}
}
