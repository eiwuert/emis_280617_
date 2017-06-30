<?php
class Secure_area extends CI_Controller
{
	var $module_id;

	/*
	Controllers that are considered secure extend Secure_area, optionally a $module_id can
	be set to also check if a user can access a particular module in the system.
	*/
	function __construct($module_id=null)
	{
		parent::__construct();
		$this->module_id = $module_id;
		$this->load->model('Employee');
		$this->load->model('Location');
		if(!$this->Employee->is_logged_in())
		{
			redirect('login');
		}

		if(!$this->Employee->has_module_permission($this->module_id,$this->Employee->get_logged_in_employee_info()->person_id))
		{
			redirect('no_access/'.$this->module_id);
		}

		//load up global data
		$logged_in_employee_info=$this->Employee->get_logged_in_employee_info();
		$data['allowed_modules']=$this->Module->get_allowed_modules($logged_in_employee_info->person_id);
		$data['user_info']=$logged_in_employee_info;
		$locations_list=$this->Location->get_all();
		$authenticated_locations = $this->Employee->get_authenticated_location_ids($logged_in_employee_info->person_id);
		$locations = array();
		foreach($locations_list->result() as $row)
		{
			if(in_array($row->location_id, $authenticated_locations))
			{
				$locations[$row->location_id] =$row->name;
			}
		}

		$data['authenticated_locations'] = $locations;
		$this->load->vars($data);
	}

	function check_action_permission($action_id)
	{
		if (!$this->Employee->has_module_action_permission($this->module_id, $action_id, $this->Employee->get_logged_in_employee_info()->person_id))
		{
			redirect('no_access/'.$this->module_id);
		}
	}

	function inputPost($val){
		return $this->input->post($val);
	}

	/*******************/
	/* Function helper */
	/*******************/
	function base_css_parth(){
		return '../../';
	}
	/*******************/
	/* OPT SELECT */
	/*******************/
	function opt_employee(){
		$emp = $this->Employee->get_all()->result();
		$emp_temp = ['' => '-- Select --'];
		foreach ($emp as $key => $val) {
			$emp_temp[$val->id] = $val->last_name.' '.$val->first_name;
		}
		return $emp_temp;
	}
	function opt_professor(){
		$prof = $this->Professor->get_all()->result();
		$professor_temp = ['' => '-- Select --'];
		foreach ($prof as $key => $val) {
			$professor_temp[$val->id] = $val->last_name.' '.$val->first_name;
		}
		return $professor_temp;
	}
	function opt_employee_professor(){
		$emp = $this->Employee->get_all_employee_professor()->result();
		$emp_temp = ['' => '-- Select --'];
		foreach ($emp as $key => $val) {
			$emp_temp[$val->id] = $val->last_name.' '.$val->first_name;
		}
		return $emp_temp;
	}
	function opt_selection_major(){
		$major = $this->Major_model->get_all()->result();
		$major_temp = ["" => '-- Select Major --'];
		foreach($major as $key => $row) {
			$major_temp[$row->skill_id] =  $row->skill_name;
		}
		return $major_temp;
	}
	function opt_selection_faculty(){
		$faculty = $this->Universities->get_all()->result();
		$faculty_temp = ["" => '-- Select University --'];
		foreach($faculty as $key => $row) {
			$faculty_temp[$row->university_id] =  $row->university_name;
		}
		return $faculty_temp;
	}
	function opt_degrees(){
			$degrees = $this->Student_list_views->get_all_degree();
			$degrees_temp = ["" => '--Select Degree--'];
			foreach($degrees as $key => $dg) {
				$degrees_temp[$dg->level_id] =  $dg->level_name.' ('.$dg->level_name_kh.')';
			}
			return $degrees_temp;
	}
	function opt_table_type(){
			return array('table_list' => 'Table List View', 'table_summery' => 'Table Summery');
	}

	function opt_section(){
			$section = $this->Section->get_all()->result();
			$section_temp = ["" => '--Select seciton--'];
			foreach($section as $key => $val) {
				$section_temp[$val->section_id] =  $val->section_name;
			}
			return $section_temp;
	}


	function opt_class(){
			$class = $this->School_class_model->get_all()->result();
			$class_temp = ["" => '--Select Class--'];
			foreach($class as $key => $val) {
				$class_temp[$val->school_class_id] =  $val->school_class_name;
			}
			return $class_temp;
	}
	function opt_room(){
			$room = $this->Rooms->get_all()->result();
			$room_temp = ["" => '--Select Room--'];
			foreach($room as $key => $val) {
				$room_temp[$val->room_id] =  $val->room_name;
			}
			return $room_temp;
	}
	function opt_scholarship(){
			$scholarship = $this->Scholarships->get_all()->result();
			$scho_temp = [ 0 => '--Select None--'];
			foreach($scholarship as $key => $val) {
				$scho_temp[$val->scho_id] =  $val->scholarship_from;
			}
			return $scho_temp;
	}
	function opt_scholarship_search(){
			$scholarship = $this->Scholarships->get_all()->result();
			$scho_temp = [ '-1' => '-- All Scholarship --', 0 => 'No Scholarship'];
			foreach($scholarship as $key => $val) {
				$scho_temp[$val->scho_id] =  $val->scholarship_from;
			}
			return $scho_temp;
	}
	function opt_grade(){
		$grade = $this->Grades->get_all()->result();
		$grade_temp = ["" => lang('common_select')];
		foreach($grade as $key => $row_grade) {
			$grade_temp[$row_grade->grade_id] =  $row_grade->grade_name;
		}
		return $grade_temp;
	}
	function opt_status(){
		$stu_status = $this->Student_status->get_all()->result();
		$stu_status_temp = ["0" => lang('students_default_student_status')];
		foreach($stu_status as $key => $row) {
			$stu_status_temp[$row->stu_status_id] =  $row->stu_status_name;
		}
		return $stu_status_temp;
	}
	function opt_nationality(){
		$nationality = $this->Nationality->get_all()->result();
		$nationality_temp = ["" => lang('common_select')];
		foreach($nationality as $key => $row) {
			$nationality_temp[$row->nationality_id] =  $row->nationality_name;
		}
		return $nationality_temp;
	}
	function opt_batches(){
		$batch = $this->Batch->get_all()->result();
		$batch_temp = ["" => lang('common_select')];
		foreach($batch as $key => $val) {
			$batch_temp[$val->batch_id] =  $val->batch_name;
		}
		return $batch_temp;
	}
	function opt_courses(){
		$courses = $this->Course->get_all()->result();
		$courses_temp = ["" => lang('students_select_course')];
		foreach($courses as $key => $course) {
			$courses_temp[$course->course_id] =  $course->course_name;
		}
		return $courses_temp;
	}
	function opt_admission_categories(){
		$stu_categories = $this->Admission_category->get_all()->result();
		$admission_categories = ["" => lang('students_select_admission_category')];
		foreach($stu_categories as $key => $category) {
			$admission_categories[$category->stu_category_id] =  $category->stu_category_name;
		}
		return $admission_categories;
	}
	function opt_designation(){
		$designation = $this->Designation_model->get_all()->result();
		$designation_temp = ["" => lang('common_select')];
		foreach($designation as $key => $val) {
			$designation_temp[$val->designation_id] =  $val->designation_name;
		}
		return $designation_temp;
	}
	function opt_province(){
		$province = $this->db->where('deleted',0)->get('provinces')->result();
		$province_temp = ["" => lang('common_select')];
		foreach($province as $key => $val) {
			$province_temp[$val->province_id] =  $val->province_name.' ('.$val->province_name_kh.')';
		}
		return $province_temp;
	}
	function opt_subject(){
		$subject = $this->Subject->get_all()->result();
		$subject_temp = ["" => lang('common_select')];
		foreach($subject as $key => $val) {
			$subject_temp[$val->sub_id] =  $val->subject_name.' ('.$val->subject_name_kh.')';
		}
		return $subject_temp;
	}
	function opt_department_type(){
		$dept = $this->Dept->get_all()->result();
		$temp = ["" => lang('common_select')];
		foreach($dept as $key => $val) {
			$temp[$val->dept_id] =  $val->dept_title.' ('.$val->dept_title_kh.')';
		}
		return $temp;
	}
	function opt_iqa_types(){
		$dept = $this->Iqa_model->get_all()->result();
		$temp = ["" => lang('common_select')];
		foreach($dept as $key => $val) {
			$temp[$val->id] =  $val->name_eng;
		}
		return $temp;
	}
	function opt_during(){
		return array(''=> '-- --','m'=>'Morning' ,'a'=> 'Afternoon','e'=> 'Evening');
	}
	function opt_gender(){
		return array("" => lang('common_select'), "Male" => lang('common_male'), "Female" => lang('common_female'),
						);
	}
	function opt_gender2(){
		return array("" => lang('common_select'),
					"M" => lang('common_male'),
					"F" => lang('common_female'));
	}
	function opt_titles(){
		return array("" => lang('common_select_title'),
							"Mr." => lang('common_mr'),
							"Mrs." => lang('common_mrs'),
							"Ms." => lang('common_ms'));
	}
	function opt_titles2(){
		return array("" => lang('common_select_title'),
					"Mr." => lang('common_mr'),
					"Mrs." => lang('common_mrs'),
					"Ms." => lang('common_ms'),
					"Prof." => lang('common_prof'),
					"Dr." => lang('common_dr'));
	}
	function opt_monthly_payment(){
		return array('' => ' -- -- ',
					'full_paid' => 'Full Paid',
					'percent'=> "as a percentage");
	}
	function opt_emp_maritalstatus(){
		return array("" => lang('common_select'),
					"UNMARRIED" => lang('common_unmarried'),
					"MARRIED" => lang('common_married'),
					"DIVORCED" => lang('common_divorced'));
	}
	function opt_currency(){
		return array('USD' => 'USD',
								'Riel'=> "Riel",
								'Baht'=> "Baht");
	}
	function opt_payment_method(){
		return array('Cash' => 'Cash', 'Check'=> "Check");
	}
	function opt_time_schedule(){
		$time_sche = $this->Schedule->get_all()->result();
		$time_sche_temp = ["" => lang('common_select')];
		foreach($time_sche as $key => $val) {
			$time_sche_temp[$val->id] =  $val->time;
		}
		return $time_sche_temp;
	}
	function opt_time_schedule2(){

		$time_schedule2 = $this->Category->get_all();
		$time_schedule2_temp = ["" => lang('common_select')];
		foreach($time_schedule2 as $key => $val) {
			$time_schedule2_temp[$val->emp_category_id] =  $val->emp_category_name;
		}
		return $time_schedule2_temp;
	}
	function opt_schedule(){
		return array("" => 'Schedule',"1" => 'Mon-fri',"2" => 'Sat-Sun');
	}
	function opt_schedule2(){
		return array('Mon-Fri' => 'Mon-Fri',
									'Sat-Sun'=> "Sat-Sun");
	}
	function opt_bloodgroups(){
		return array("Unknown" => lang('common_unknown'),
					"A+" => lang('common_mr'),
					"A-" => lang('common_aminus'),
					"B+" => lang('common_bplus'),
					"B-" => lang('common_bminus'),
					"AB+" => lang('common_abplus'),
					"AB-" => lang('common_abminus'),
					"O+" => lang('common_oplus'),
					"O-" => lang('common_ominus'));
	}
	function opt_scholarship_percent(){
		return array('0' => '0%',
					'10' => '10%',
					'20'=> "20%",
					'30' => '30%',
					'40' => '40%',
					'50' => '50%',
					'60' => '60%',
					'70' => '70%',
					'80' => '80%',
					'90' => '90%',
					'100' => '100%');
	}
	function opt_health_status(){
		return array("" => lang('common_select'),
							"normal" => lang('students_normal'),
							"injury" => lang('students_injury'),
							"death" => lang('students_death'));
	}
	function opt_work_match(){
		return array("" => lang('common_select'),
						"Same Major" => lang('students_same_major'),
						"Different Major" => lang('students_different_major'),
						"Own Business" => lang('students_own_business'));
	}
	function opt_is_graduated(){
		return array("" => lang('common_select'),
						"0" => lang('students_under_graduated'),
						"1" => lang('students_graduated'),
						"2" => lang('students_dropped'));
	}
	function opt_is_scholarship(){
		return array("" => lang('common_select'),
						"0" => lang('students_full_pay'),
						"1" => lang('students_scholarship'));
	}
	function opt_color_type(){
		return array('' => '-- Please Select Card Color --',
					'1' => 'Orange',
					'2' => 'Green',
					'3' => 'Green Light',
					'4' => 'Blue');
	}
	function opt_select_type(){
		return array('0'=>'Student Info', '1'=>'Payment');
	}
	function opt_semester(){
		return array('' => ' -- Select -- ', '1' => '1', '2' => '2');
	}
	function selection_month(){
		return array('1' => 'January','2' => 'Febuary','3' => 'March','4' => 'April','5' => 'May','6' => 'June','7' => 'July','8' => 'August','9' => 'September','10' => 'October','11' => 'November','12' => 'December');
	}

	function getConvIntLangKh($data){
			$softConv = array (0=>'០',1=>'១',2=>'២',3=>'៣',4=>'៤',5=>'៥',6=>'៦',7=>'៧',8=>'៨',9=>'៩');
			return $softConv[(int)$data];
	}
	function getConvMonthLangKh($data){
			$softConv = array (1=>'មករា',2=>'កុម្ភះ',3=>'មីនា',4=>'មេសា',5=>'ឧសភា',6=>'មិថុនា',7=>'កក្ដា',8=>'សីហា',9=>'កញ្ញា',10=>'តុលា',11=>'វិច្ឆិកា',12=>'ធ្នូរ');
			return $softConv[(int)$data];
	}
	/*******************/
	/* Suggestion */
	/*******************/
	function convertDate_FY($date)
    {
        return date('F Y', strtotime($date));
    }
}
?>
