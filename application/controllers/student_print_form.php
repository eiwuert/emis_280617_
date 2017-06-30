<?php
require_once ("secure_area.php");
class Student_print_form extends Secure_area
{
	function index() {

		$data['controller_name']=strtolower(get_class());

			$data['major'] = $this->opt_selection_major();
			$data['degree'] = $this->opt_degrees();
			$data['batches'] = $this->opt_batches();
			$data['period'] = $this->opt_grade();
			$data['semester'] = $this->opt_semester();
			$data['schedule'] = $this->opt_schedule();
			$data['room'] = $this->opt_room();
			$data['year'] = $this->opt_section();

		$this->load->view('students/print_card/manage_search_card',$data);
	}

	function search_student(){
		$data['controller_name']=strtolower(get_class());
		$search = ($this->input->post('search'))? $this->input->post('search') : '' ;
		if($this->input->post('submit')){
			$this->session->unset_userdata('major_id');
			$this->session->unset_userdata('batch');
			$this->session->unset_userdata('period');
			$this->session->unset_userdata('year');
			$this->session->unset_userdata('degree');
			$this->session->unset_userdata('semester');
			$this->session->unset_userdata('schedule');
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

		$q_search_stu = $this->Student_card_model->get_search_students($major_id, $batch, $year, $period, $degree_id, $semester, $schedule, $room, $search);

		$data['manage_student'] = get_card_manage_table($q_search_stu,$this);
		$this->load->view('students/print_card/manage_search_card',$data);
	}

	function get(){
		$get_id = $_POST["id"];
		$q_skill = $this->Student_card_model->get_skill_by_id($get_id);
		echo $q_skill->row()->skill_major_code;
	}

	function clear_state()
	{
		$this->session->unset_userdata('major_id');
		$this->session->unset_userdata('batch');
		$this->session->unset_userdata('year');
		$this->session->unset_userdata('period');
		$this->session->unset_userdata('degree');
		$this->session->unset_userdata('semester');
		$this->session->unset_userdata('schedule');
		$this->session->unset_userdata('room');
		redirect('student_print_form');
	}

	function suggest_code_major(){
		//allow parallel searchs to improve performance.
		session_write_close();
		$view_suggestions = $this->Student_card_model->get_code_major_suggestions($this->input->get('term'),100);
		echo json_encode($view_suggestions);
	}
	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		$sug_data = array('major_id' => $this->session->userdata('major_id'),
							'batch' => $this->session->userdata('batch'),
							'year' => $this->session->userdata('year'),
							'period' => $this->session->userdata('period'),
							'degree_id' => $this->session->userdata('degree'));

		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Student_card_model->suggestions_score_stu_search($this->input->get('term'),100,$sug_data);
		echo json_encode($suggestions);
	}

	function add_card(){
		$data['controller_name']=strtolower(get_class());
		$data['base_css_parth'] = $this->base_css_parth();
		$id = $this->input->post('id_stu');
		if(empty($id)){
			redirect('student_print_form');
		}
		$data['get_query'] = $this->Student_card_model->query_student_card($id);
		$this->load->view('students/print_card/manage_stu_card',$data);
	}

	function add_diploma(){
		$data['controller_name']=strtolower(get_class());
		$data['base_css_parth'] = $this->base_css_parth();
		$id = $this->input->post('id_stu');
		$data['id_diploma'] = $this->input->post('id_diploma');
		$aproved_date = $this->input->post('aproved_date');
		$date_out_president = $this->input->post('date_out_president');
		$data['date_out_chairman_of_the_board'] = date_format(date_create($this->input->post('date_out_chairman_of_the_board')),"F j, Y");

				$py= date_format(date_create($date_out_president),"Y");
						$py1 = $this->getConvIntLangKh(substr($py,0,1));
						$py2 = $this->getConvIntLangKh(substr($py,1,1));
						$py3 = $this->getConvIntLangKh(substr($py,2,1));
						$py4 = $this->getConvIntLangKh(substr($py,3,1));
						$data['py'] = $py1.$py2.$py3.$py4;
				$pm = date_format(date_create($date_out_president),"m");
						$data['pm'] = $this->getConvMonthLangKh(substr($pm,1,1));
				$pd = date_format(date_create($date_out_president),"d");
						$pd1 = $this->getConvIntLangKh(substr($pd,0,1));
						$pd2 = $this->getConvIntLangKh(substr($pd,1,1));
				$data['pd']= $pd1.$pd2;

		$get_aproved_kh = '';
		$get_aproved = '';
		if($aproved_date !== ''){
					$y= date_format(date_create($aproved_date),"Y");
					$m= date_format(date_create($aproved_date),"m");
					$d= date_format(date_create($aproved_date),"d");
					$d1 = $this->getConvIntLangKh(substr($d,0,1));
					$d2 = $this->getConvIntLangKh(substr($d,1,1));
				 	$y1 = $this->getConvIntLangKh(substr($y,0,1));
				 	$y2 = $this->getConvIntLangKh(substr($y,1,1));
				 	$y3 = $this->getConvIntLangKh(substr($y,2,1));
				 	$y4 = $this->getConvIntLangKh(substr($y,3,1));
					$get_month = $this->getConvMonthLangKh(substr($m,1,1));
					$get_aproved_kh .= $d1.$d2.'&nbsp;'.$get_month.',&nbsp;'.$y1.$y2.$y3.$y4;
			$get_aproved .= date_format(date_create($aproved_date),"F j, Y");
		}
		$data['aproved_date_kh'] = $get_aproved_kh;
		$data['aproved_date'] = $get_aproved;
		if(empty($id)){
			redirect('student_print_form');
		}

		$data['get_query'] = $this->Student_card_model->query_student_card($id);
		$this->load->view('students/print_card/manage_diploma',$data);
	}
// 999999999999999999999999999999999999999999
	function teporaty_certificte(){
		$data['controller_name']=strtolower(get_class());
		$data['base_css_parth'] = $this->base_css_parth();
		$id = $this->input->post('id_stu');
		$date_exam = $this->input->post('date_exam');
		$date_out_teporaty_certificte = $this->input->post('date_out_teporaty_certificte');
		$data['id_temporaty_certificate'] = $this->input->post('id_temporaty_certificate');

		$get_date_exam_kh = '';
		$get_date_exam = '';
		if($date_exam !== ''){

				$y= date_format(date_create($date_exam),"Y");
				$m= date_format(date_create($date_exam),"m");
				$d= date_format(date_create($date_exam),"d");
				$d1 = $this->getConvIntLangKh(substr($d,0,1));
				$d2 = $this->getConvIntLangKh(substr($d,1,1));
				$y1 = $this->getConvIntLangKh(substr($y,0,1));
				$y2 = $this->getConvIntLangKh(substr($y,1,1));
				$y3 = $this->getConvIntLangKh(substr($y,2,1));
				$y4 = $this->getConvIntLangKh(substr($y,3,1));
				$get_month = $this->getConvMonthLangKh(substr($m,1,1));
				$get_date_exam_kh .= 'ថ្ងៃ'.$d1.$d2.'&nbsp;ខែ'.$get_month.'&nbsp;ឆ្នាំ'.$y1.$y2.$y3.$y4;
				$get_date_exam .= date_format(date_create($date_exam),"F j, Y");
		}
		$get_date_out = '';
		if($date_exam !== ''){
				$y= date_format(date_create($date_out_teporaty_certificte),"Y");
				$m= date_format(date_create($date_out_teporaty_certificte),"m");
				$d= date_format(date_create($date_out_teporaty_certificte),"d");
				$d1 = $this->getConvIntLangKh(substr($d,0,1));
				$d2 = $this->getConvIntLangKh(substr($d,1,1));
				$y1 = $this->getConvIntLangKh(substr($y,0,1));
				$y2 = $this->getConvIntLangKh(substr($y,1,1));
				$y3 = $this->getConvIntLangKh(substr($y,2,1));
				$y4 = $this->getConvIntLangKh(substr($y,3,1));
				$get_month = $this->getConvMonthLangKh(substr($m,1,1));
				$get_date_exam_kh .= 'ថ្ងៃ'.$d1.$d2.'&nbsp;ខែ'.$get_month.'&nbsp;ឆ្នាំ'.$y1.$y2.$y3.$y4;

				$data['get_month_date_out'] = $get_month;
				$data['get_date'] = $d1.$d2;
				$data['get_year'] = $y1.$y2.$y3.$y4;
		}

		$data['date_exam_kh'] = $get_date_exam_kh;
		$data['date_exam'] = $get_date_exam;

		if(empty($id)){
			redirect('student_print_form');
		}
		$data['get_query'] = $this->Student_card_model->query_student_card($id);

		$this->load->view('students/print_card/teporaty_certificte',$data);

	}

	function general_english_certify(){
		$data['controller_name']=strtolower(get_class());
		$data['base_css_parth'] = $this->base_css_parth();
		$id = $this->input->post('id_stu');
		$data['english_level'] = $this->input->post('english_level');
		$data['year_to_year'] = $this->input->post('year_to_year');
		$english_certify_date = $this->input->post('english_certify_date');
		$data['english_certify_date'] = date_format(date_create($english_certify_date),"F j, Y");
		if(empty($id)){
			redirect('student_print_form');
		}
		$data['get_query'] = $this->Student_card_model->query_student_card($id);
		// if($data['get_query']->row()->university_id == 3){
			$this->load->view('students/print_card/general_english',$data);
		// }else{
		// 	redirect('student_print_form');
		// }

	}
// 8888888888888888888888888888888888888888888888
	function foundation_year(){
		$data['controller_name']=strtolower(get_class());
		$data['base_css_parth'] = $this->base_css_parth();
		$id = $this->input->post('id_stu');
		$data['year_to_year'] = $this->input->post('year_to_year');
		$data['year_to_year_kh'] = $this->input->post('year_to_year_kh');
		$year = date_format(date_create(date("Y/m/d")),"Y");
				$y1 = $this->getConvIntLangKh(substr($year,0,1));
				$y2 = $this->getConvIntLangKh(substr($year,1,1));
				$y3 = $this->getConvIntLangKh(substr($year,2,1));
				$y4 = $this->getConvIntLangKh(substr($year,3,1));
				$data['year_kh'] =$y1.$y2.$y3.$y4;
				$data['year'] =$year;
		if(empty($id)){
			redirect('student_print_form');
		}
		$data['get_query'] = $this->Student_card_model->query_student_card($id);
		$this->load->view('students/print_card/foundation_year',$data);

	}
	// 7777777777777777777777777777777777777777777777
	function academic_confirmation(){
		$data['controller_name']=strtolower(get_class());
		$data['base_css_parth'] = $this->base_css_parth();
		$id = $this->input->post('id_stu');
		$data['year_to_year'] = $this->input->post('year_to_year');
		$data['year_to_year_kh'] = $this->input->post('year_to_year_kh');
		$date_out_academic_confirmation = $this->input->post('date_out_academic_confirmation');
		$data['id_academic_confirm'] = $this->input->post('id_academic_confirm');

		$y = date_format(date_create($date_out_academic_confirmation),"Y");
		$m = date_format(date_create($date_out_academic_confirmation),"m");
		$d = date_format(date_create($date_out_academic_confirmation),"d");
				$d1 = $this->getConvIntLangKh(substr($d,0,1));
				$d2 = $this->getConvIntLangKh(substr($d,1,1));
				$data['d']= $d1.$d2;

				$data['month'] = $this->getConvMonthLangKh(substr($m,1,1));

				$y1 = $this->getConvIntLangKh(substr($y,0,1));
				$y2 = $this->getConvIntLangKh(substr($y,1,1));
				$y3 = $this->getConvIntLangKh(substr($y,2,1));
				$y4 = $this->getConvIntLangKh(substr($y,3,1));
				$data['y']= $y1.$y2.$y3.$y4;

		$data['date_eng'] = date_format(date_create($date_out_academic_confirmation),"d-F-Y");
		$data['date_out_academic_confirmation'] = $date_out_academic_confirmation;
		if(empty($id)){
			redirect('student_print_form');
		}
		$data['get_query'] = $this->Student_card_model->query_student_card($id);
		$this->load->view('students/print_card/academic_confirmation',$data);

	}

 	function transcript_eng(){
 		$data['controller_name']=strtolower(get_class());
		$data['base_css_parth'] = $this->base_css_parth();
		$id = $this->input->post('id_stu');
		$data['id_transcript'] = $this->input->post('id_transcript');
		$transcript_on_date = $this->input->post('transcript_on_date');
		$data['tdate']= date_format(date_create($transcript_on_date),"j");
		$data['tmonth']= date_format(date_create($transcript_on_date),"F");
		$data['tyear']= date_format(date_create($transcript_on_date),"Y");
		if(empty($id)){
			redirect('student_print_form');
		}
		$data['get_query'] = $this->Student_card_model->query_student_card($id);
		$this->load->view('students/print_card/transcript_eng',$data);
	}
}
