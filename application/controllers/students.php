<?php
require_once ("person_controller.php");
class Students extends Person_controller
{
	function __construct()
	{
		parent::__construct('students');
	}
	
	function index($offset=0)
	{		
		$this->check_action_permission('search');
		$params = $this->session->userdata('student_search_data') ? $this->session->userdata('student_search_data') : array('offset' => 0, 'order_col' => 'stu_master_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
		   redirect('students/index/'.$params['offset']);
		}
		$config['base_url'] = site_url('students/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search'])
		{
			$config['total_rows'] = $this->Student->search_count_all($data['search']);
			$table_data = $this->Student->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Student->count_all();
			$table_data = $this->Student->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}		
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table']=get_students_manage_table($table_data,$this);
		$this->load->view('students/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$student_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("student_search_data",$student_search_data);
		
		if ($search)
		{
			$config['total_rows'] = $this->Student->search_count_all($search);
			$table_data = $this->Student->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		else
		{
			$config['total_rows'] = $this->Student->count_all();
			$table_data = $this->Student->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('students/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_students_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));	
	}
	
	/*
	Returns customer table data rows. This will be called with AJAX.
	*/
	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';
		$student_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("student_search_data",$student_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Student->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('students/search');
		$config['total_rows'] = $this->Student->search_count_all($search);
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Student->search_count_all($search);
		$data['manage_table']= get_students_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	
	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Student->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}
	
	/*
	Loads the student edit form
	*/
	function view($student_id=-1,$redirect_code=0)
	{
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['person_info'] = $this->Student->get_info($student_id);
		$data['stu_prefix'] = 'STU';
		if ($student_id == -1) {
			$data['stu_unique_id'] = $this->last_running_number();
		}
		
		$data['admission_categories'] = $this->opt_admission_categories();
		$data['titles'] = $this->opt_titles();
		$data['genders'] = $this->opt_gender();
		$data['stu_schedule'] = $this->opt_schedule();
		$data['universities'] = $this->Student->get_all_universities();	
				
		$data['skills'] = $this->opt_selection_major();
		$data['courses'] = $this->opt_courses();
		$data['batches'] = $this->Student->get_all_batches();		
		$data['section'] = $this->opt_section();
		$data['nationality'] = $this->opt_nationality();		
		$data['stu_status'] = $this->opt_status();		
		$data['levels'] = $this->opt_degrees();
		$data['stu_grade'] = $this->opt_grade();
		$data['stu_room'] = $this->opt_room();
		$data['stu_class'] = $this->opt_class();
		$data['stu_scholarship'] = $this->opt_scholarship();

		$data['redirect_code']=$redirect_code;
		$this->load->view("students/form",$data);
	}
	function clear_state()
	{
		$this->session->unset_userdata('student_search_data');
		redirect('students');
	}
	/*
	Inserts/updates a student
	*/
	function save($stu_info_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$person_info = $this->Student->get_info($stu_info_id);
		$employee_id = false;
		$stu_address_id = false;
		if ($person_info->employee_id!="") {
			$employee_id = $person_info->employee_id;
			$stu_address_id = $person_info->stu_address_id;
		}
		$form_data = $this->input->post();
		$stu_info_data = array(
			'stu_unique_id' => $form_data['stu_unique_id'],
			'stu_unique_id_written' => $form_data['stu_unique_id_written'],
			'stu_unique_auto_num' => $form_data['stu_auto_unique_id'],
			'stu_title' => $form_data['stu_title'],
			'stu_first_name'=>$form_data['stu_first_name'],
			'stu_last_name'=>$form_data['stu_last_name'],
			'stu_first_name_kh'=>$form_data['stu_first_name_kh'],
	        'stu_last_name_kh'=>$form_data['stu_last_name_kh'],
			'stu_gender'=>$form_data['stu_gender'],
			'stu_dob' => date('Y-m-d', strtotime($form_data['stu_dob'])),
			'stu_email_id' => $form_data['stu_email_id'],
			'stu_mobile_no' => $form_data['stu_mobile_no'],
			'stu_nationality_id' => $form_data['stu_nationality_id'],
			'is_refer_in' => $form_data['is_refer_in'],
			'refer_in_from' => $form_data['refer_in_from'],
			'stu_category_id' => $form_data['stu_category_id'],
			'stu_high_school' => $form_data['stu_high_school'],
			'stu_exam_hschool' => $form_data['stu_exam_hschool'],
			'stu_certificate_id_hschool' => $form_data['stu_certificate_id_hschool']
		);
		$stu_acad_data = array(
			'stu_acad_stu_acad_card' => $form_data['stu_unique_id'],
			'stu_acad_stu_acad_unique' => $form_data['stu_unique_id'].'-1',
			'stu_acad_course_detail_id' => $form_data['stu_acad_course_id'],
		    'stu_acad_batch_id' => $form_data['stu_acad_batch_id'],
		    'stu_acad_section_id' => $form_data['stu_acad_section_id'],
		    'stu_acad_status' => $form_data['stu_acad_stu_status_id'],
		    'stu_acad_university_id' => $form_data['stu_acad_university_id'],
		    'stu_acad_skill_id' => $form_data['stu_acad_skill_id'],
		    'stu_acad_level_id' => $form_data['stu_acad_level_id'],
		    'stu_acad_grade' => $form_data['stu_acad_grade'],
		    'stu_acad_schedule_id'=> $form_data['stu_acad_stu_schedule'],
		    'stu_acad_scholarship_id'=> $form_data['stu_acad_stu_scholarship'],
		    'stu_acad_admission_date' => date('Y-m-d', strtotime($form_data['stu_admission_date'])),
			'stu_acad_stu_room' => $form_data['stu_acad_stu_room'],
			'stu_acad_stu_class' => $form_data['stu_acad_stu_class'],
			'stu_acad_register' => 1
		);
		if ($stu_info_id == -1) {
			$stu_acad_data['created_at'] = date('Y-m-d H:i:s');
			$stu_acad_data['created_by'] = $logged_in_info->person_id;
		} else {
			$stu_acad_data['updated_at'] = date('Y-m-d H:i:s');
			$stu_acad_data['updated_by'] = $logged_in_info->person_id;
		}
		if ($stu_info_id == -1) {
			$stu_master_data['created_at'] = date('Y-m-d H:i:s');
			$stu_master_data['created_by'] = $logged_in_info->person_id;
		} else {
			$stu_master_data['updated_at'] = date('Y-m-d H:i:s');
			$stu_master_data['updated_by'] = $logged_in_info->person_id;
		}
		$stu_address_data = array(
			'stu_cadd' => NULL
		);
		$person_data = array(
			'full_name'=>$form_data['stu_first_name'].'.'.$form_data['stu_last_name']
		);
		$employee_data = array(
			'user_type_id'=>11
		);
		if ($this->Student->save($stu_master_data, $stu_acad_data, $stu_info_data, $stu_address_data, $person_data, $employee_data, $stu_info_id, $employee_id, $stu_address_id)) {
			//New student
			if ($stu_info_id == -1) {
				$success_message = lang('students_successful_adding') . ' ' . $stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'];
				echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_data['stu_info_id']));
			} else { //previous student
				$success_message = lang('students_successful_updating') . ' ' . $stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'];
				echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_id));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .
			$stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'], 'stu_info_id' => -1));
		}
	}

	/*
	This deletes customers from the customers table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$students_to_delete = $this->input->post('ids');
		
		if($this->Student->delete_list($students_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('students_successful_deleted').' '.
			count($students_to_delete).' '.lang('students_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('students_cannot_be_deleted')));
		}
	}

	function last_running_number()
	{
        $last_running_number = $this->Student->get_last_running_number();
        $running_number = $last_running_number + 1;
        if (strlen($running_number) < 6) {
            $running_number = str_pad($running_number, 6, '0', STR_PAD_LEFT);
        }
        return $running_number;
    }	
	function check_duplicate()
	{			
		echo json_encode(array('duplicate'=>$this->input->post('term')));
	}
	
	function check_duplicate_academic()
	{			
		echo json_encode(array('duplicate'=>$this->Student->check_duplicate_academic($this->input->post('term'))));
	}
	function detail($stu_info_id=-1)
	{
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['person_info'] = $this->Student->get_info($stu_info_id);
		$data['num_academic'] = ($this->Student->get_info_acad_by_stu_id($stu_info_id)->num_rows()) + 1;
		$data['num_acad_id_card'] = $data['person_info']->stu_unique_id_written.'-'.$data['num_academic'];
		$data['course_info'] = $this->Course->get_info($data['person_info']->stu_acad_course_detail_id);
		$data['batch_info'] = $this->Batch->get_info($data['person_info']->stu_acad_batch_id);
		$data['nationality_info'] = $this->Nationality->get_info($data['person_info']->stu_nationality_id);
		
		$data['cadd_country_info'] = $this->Nationality->get_info_country($data['person_info']->stu_cadd_country);
		$data['cadd_city_info'] = $this->Nationality->get_info_city($data['person_info']->stu_cadd_city);
		$data['cadd_state_info'] = $this->Nationality->get_info_state($data['person_info']->stu_cadd_state);

		$data['padd_country_info'] = $this->Nationality->get_info_country($data['person_info']->stu_padd_country);
		$data['padd_city_info'] = $this->Nationality->get_info_city($data['person_info']->stu_padd_city);
		$data['padd_state_info'] = $this->Nationality->get_info_state($data['person_info']->stu_padd_state);
	    	
		$data['guardian'] = $this->Student->get_guardian_info($stu_info_id);
		$get_guardian = $data['guardian'];
		$data['manage_table_guardian'] = get_guardian_manage_table($get_guardian,$this);

		$data['category_info'] = $this->Admission_category->get_info($data['person_info']->stu_category_id);
		$data['section_info'] = $this->Section->get_info($data['person_info']->stu_master_section_id);

		$data['level_info'] = $this->Levels->get_info($data['person_info']->stu_master_level_id);
		$data['university_info'] = $this->Universities->get_info($data['person_info']->stu_university_id);
		$stu_master_id = $data['person_info']->stu_master_id;
		$data['transfer_majors'] = $this->Student->get_all_students_transfer($stu_master_id, 'major');
		$data['transfer_faculties'] = $this->Student->get_all_students_transfer($stu_master_id, 'university');

		$data['universities'] = $this->opt_selection_faculty();
		$data['skills'] = $this->opt_selection_major();
		$data['major'] = $this->opt_selection_major();
		$data['courses'] = $this->opt_courses();
		$data['batches'] = $this->opt_batches();
		$data['section'] = $this->opt_section();
		$data['levels'] = $this->opt_degrees();
		$data['stu_status'] = $this->opt_status();
		$data['stu_room'] = $this->opt_room();
		$data['stu_class'] = $this->opt_class();
		$data['stu_schedule'] = $this->opt_schedule();
		$data['grade'] = $this->opt_grade();
		$data['stu_scholarship'] = $this->opt_scholarship();
		$items = $this->Student->get_all_academic($stu_master_id);
		$data['items_academic'] = get_students_academic_rows($items, $this);

		$ch_btn_snap = $this->Student->check_prof($stu_info_id);
		if(empty($ch_btn_snap )){
			$data['btn_snap'] = '<input type="button" class="snap" value="SNAP IT" onClick="take_snapshot()">';
			$data['old_prof'] = '<img class="img-circle edusec-img-disp" src="'.site_url("assets/img/no-photo.png").'" alt="No Image">';
		}else{
			$data['btn_snap'] = '<input style="background:red" type="button" class="snap" value="Change" onClick="clear_snapshot()">';
			$data['old_prof'] = '<img class="img-circle edusec-img-disp" src="'.base_url("assets/avatars/$ch_btn_snap").'">';
		}

		// job status
		$get_info_job = $this->Student->info_job_cate()->result();
		$job_temp = ["" => lang('common_select')];
		foreach($get_info_job as $val => $key) {
			$job_temp[$key->job_id] =  $key->job_title;
		}
		$data['job_status'] = $job_temp;
		$provinces = $this->Location->get_all_provinces();
		$provinces_temp = ["" => lang('common_select')];
		foreach($provinces as $key => $row) {
			$provinces_temp[$row->province_id] =  $row->province_name.' ('.$row->province_name_kh.')';
		}
		$data['provinces'] = $provinces_temp;

		$job_info = $this->Student->stu_job_info($stu_info_id);
		$data['job_info'] = get_students_job_rows($job_info, $this);

		$this->load->view("students/detail",$data);
	}

	function update_personal($student_id=-1){
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$person_info = $this->Student->get_info($student_id);
		$data['person_info'] = $person_info;
		$data['full_name'] = $person_info->stu_last_name.' '.$person_info->stu_first_name;
		$data['stu_prefix'] = 'STU';
		if ($student_id == -1) {
			$data['stu_unique_id'] = $this->last_running_number();
		}
		$data['scholarship'] = $this->opt_scholarship();
		$data['admission_categories'] = $this->opt_admission_categories();
		$data['titles'] = $this->opt_titles();
		$data['is_scholarship'] = $this->opt_is_scholarship();;
		$data['is_graduated'] = $this->opt_is_graduated();
		$data['work_match'] = $this->opt_work_match();
		$data['genders'] = $this->opt_gender();
		$data['health_status'] = $this->opt_health_status();
		$data['stu_schedule'] = $this->opt_schedule();
		$data['levels'] = $this->opt_degrees();
		$data['universities'] = $this->opt_selection_faculty;
		$data['skills'] = $this->opt_selection_major;
		$data['courses'] = $this->opt_courses();
		$data['batches'] = $this->Student->get_all_batches();
		$data['section'] = $this->opt_section();
		$data['nationality'] = $this->opt_nationality();
		$data['stu_status'] = $this->opt_status();
		$data['stu_grade'] = $this->opt_grade();

		$this->load->view("students/update_personal",$data);
	}

	function save_personal($stu_info_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$person_info = $this->Student->get_info($stu_info_id);
		$form_data = $this->input->post();
		$stu_info_data = array(
			'stu_unique_id' => $form_data['stu_unique_id'],
			'stu_title' => $form_data['stu_title'],
			'stu_first_name'=>$form_data['stu_first_name'],
			'stu_first_name'=>$form_data['stu_first_name'],
			'stu_last_name'=>$form_data['stu_last_name'],
			'stu_first_name_kh'=>$form_data['stu_first_name_kh'],
	        'stu_last_name_kh'=>$form_data['stu_last_name_kh'],
			'stu_gender'=>$form_data['stu_gender'],
			'stu_dob' => date('Y-m-d', strtotime($form_data['stu_dob'])),
			'stu_email_id' => $form_data['stu_email_id'],
			'stu_mobile_no' => $form_data['stu_mobile_no'],
			'stu_admission_date' => date('Y-m-d', strtotime($form_data['stu_admission_date'])),
			'stu_high_school' => $form_data['stu_high_school'],
			'stu_exam_hschool' => $form_data['stu_exam_hschool'],
			'stu_certificate_id_hschool' => $form_data['stu_certificate_id_hschool'],
			'stu_languages' => $form_data['stu_languages'],
			'stu_card_number'=>$form_data['stu_card_number'],
			'stu_card_no'=>$form_data['stu_card_no'],
			'stu_emergency_contact'=>$form_data['stu_emergency_contact'],
			'is_graduated'=>$form_data['is_graduated'],
			'health_status'=>$form_data['health_status'],
			'is_refer_in'=>$form_data['is_refer_in'],
			'refer_in_from'=>$form_data['refer_in_from'],
			'stu_nationality_id' => $form_data['stu_nationality_id'],			
			'stu_category_id' => $form_data['stu_category_id']
		);
			
		if ($this->Student->save_personal($stu_info_data, $stu_info_id)) {
            //New student
            $success_message = lang('students_successful_updating') . ' ' . $stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'];
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_id));
        } else {
            echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .
                $stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'], 'stu_info_id' => -1));
        }
	}

	function save_stu_job_status($stu_job_id, $action_id){
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$data['controller_name']=strtolower(get_class());
		$person_info = $this->Student->get_info($student_id);
		$form_data = $this->input->post();
		$job_cate_id = $form_data['job_cate_id'];
		if($job_cate_id == '1'){
			$stu_job_data = array(
				'stu_job_stu_info_id' => $form_data['stu_info_id'],
				'stu_job_position' => '',
				'stu_job_cate_id' => $job_cate_id,
				'stu_job_name'=>'',
				'stu_job_local_id'=>'',
				'stu_job_desc'=>'',
				'stu_job_date'=> ''
			);
		}else{
			$stu_job_data = array(
				'stu_job_stu_info_id' => $form_data['stu_info_id'],
				'stu_job_position' => $form_data['job_position'],
				'stu_job_cate_id' => $job_cate_id,
				'stu_job_name'=>$form_data['job_name'],
				'stu_job_local_id'=>$form_data['stu_job_local'],
				'stu_job_desc'=>$form_data['stu_job_desc'],
				'stu_job_date'=> date('Y-m-d', strtotime($form_data['stu_job_date']))
			);
		}
		
		if ($stu_job_id == -1) {
			$stu_job_data['created_at'] = date('Y-m-d H:i:s');
			$stu_job_data['created_by'] = $logged_in_info->person_id;
		} else {
			$stu_job_data['updated_at'] = date('Y-m-d H:i:s');
			$stu_job_data['updated_by'] = $logged_in_info->person_id;
		}

		if ($this->Student->save_stu_job_status($stu_job_data, $stu_job_id)) {

			$job_info = $this->Student->stu_job_info($stu_job_data['stu_job_stu_info_id']);
			$q_job_info = get_students_job_rows($job_info, $this);
            //New student
            $success_message = lang('students_successful_updating') . ' ' . $stu_job_data['stu_job_name'];
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_job_id' => $stu_job_data['stu_job_id'], 'job_info' => $q_job_info));
        } else {
            	echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .
                $stu_job_data['stu_job_name'], 'stu_job_id' => -1));
        }
	}

	function update_academic($student_id=-1){

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$person_info = $this->Student->get_info($student_id);
		$data['person_info'] = $person_info;
		$data['full_name'] = $person_info->stu_last_name.' '.$person_info->stu_first_name;
		$data['nationality_info'] = $this->Nationality->get_info($person_info->stu_master_nationality_id);

		$edu_courses = $this->Student->get_courses();
		$courses_temp = ["0" => lang('common_select_title')];
		foreach($edu_courses as $key => $row) {
			$courses_temp[$row->course_id] =  $row->course_name;
		}
		$data['courses'] = $courses_temp;

		$edu_batchs = $this->Student->get_batchs();
		$batch_temp = ["0" => lang('common_select_title')];
		foreach($edu_batchs as $key => $row) {
			$batch_temp[$row->batch_id] =  $row->batch_name;
		}
		$data['batch'] = $batch_temp;

		$edu_section = $this->Student->get_section();
		$section_temp = ["0" => lang('common_select_title')];
		foreach($edu_section as $key => $row) {
			$section_temp[$row->section_id] =  $row->section_name;
		}
		$data['section'] = $section_temp;		

		$data['status'] = [
						"" => lang('common_select_title'),
						"0" => lang('students_active'),
						"1" => lang('students_inactive')
						];

		$edu_stu_status = $this->Student->get_stu_status();
		$stu_status_temp = ["0" => lang('common_select_title')];
		foreach($edu_stu_status as $key => $row) {
			$stu_status_temp[$row->stu_status_id] =  $row->stu_status_name;
		}
		$data['stu_status'] = $stu_status_temp;
		$universities = $this->Student->get_all_universities();
		$universities_temp = ["" => lang('students_select_university')];
		foreach($universities as $key => $university) {
			$universities_temp[$university->university_id] =  $university->university_name;
		}
		$data['universities'] = $universities_temp;
		$levels = $this->Student->get_all_levels();
		$levels_temp = ["" => lang('common_select')];
		foreach($levels as $key => $level) {
			$levels_temp[$level->level_id] =  $level->level_name;
		}
		$data['levels'] = $levels_temp;

		$this->load->view("students/update_academic",$data);
	}

	function do_update_academic($stu_info_id =-1){

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['person_info'] = $this->Student->get_info($stu_info_id);		
		$logged_in_info = $this->Employee->get_logged_in_employee_info();

		$form_data = $this->input->post();
		$stu_master_data = array(
				'stu_master_course_id' => $form_data['stu_master_course_id'],
				'stu_master_batch_id' => $form_data['stu_master_batch_id'],
				'stu_master_section_id'=>$form_data['stu_master_section_id'],	
				'is_status'=>$form_data['is_status'],
				'stu_master_stu_status_id'=>$form_data['stu_master_stu_status_id'],
				'stu_master_university_id'=>$form_data['stu_master_university_id'],
				'stu_master_level_id'=>$form_data['stu_master_level_id']
		);

		if ($student_id == -1) {
			$stu_master_data['created_at'] = date('Y-m-d H:i:s');
			$stu_master_data['created_by'] = $logged_in_info->person_id;
		} else {
			$stu_master_data['updated_at'] = date('Y-m-d H:i:s');
			$stu_master_data['updated_by'] = $logged_in_info->person_id;
		}
		
		$stu_info_data = array(
				'stu_admission_date'=> date('Y-m-d', strtotime($form_data['stu_admission_date']))
		);
		
		if ($this->Student->save_academic($stu_master_data,$stu_info_data, $stu_info_id)){
			//New address
            if ($stu_info_id == -1) {
                $success_message = lang('students_successful_adding') . ' ' . $stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'];
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_data['stu_info_id']));
            } else { //previous address
            	
                $success_message = lang('students_successful_updating') . ' ' . $stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'];
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_id));
            }
        } else {

            echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .
                $stu_info_data['stu_first_name'] . ' ' . $stu_info_data['stu_last_name'], 'stu_info_id' => -1));
        }
	}

	function add_guardians($stu_info_id,$guardian_id=-1){		
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());	
		$data['person_info'] = $this->Student->get_info($stu_info_id);
		$person_info = $data['person_info'];
		if($guardian_id == -1)
		{
			$data['stu_full_name'] = $person_info->stu_last_name.' '.$person_info->stu_first_name;
			$data['form_guardian'] = $stu_info_id.'/-1';
			$data['fe_sign'] = 'plus';
			$data['btn_submit'] = 'Add';
			$data['title_header'] = lang('students_add_guardian_details');
		}else{
			$data['guardian_info'] = $this->Student->guardian_update_info($guardian_id);
			$data['form_guardian'] = $stu_info_id.'/'.$guardian_id;
			$data['btn_submit'] = 'Update';
			$data['fe_sign'] = 'edit';
			$data['title_header'] = lang('students_update_guardian_details');
		}	
		$data['relation_id'] = ['Parents' => 'Parents', 'Other' => 'Other'];
		$this->load->view("students/add_guardian",$data);
	}

	function do_guardians($stu_info_id=-1, $option=-1){
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		
		$person_info = $this->Student->get_info($stu_info_id);
		$stu_master_id = false;
		if ($person_info->person_id!="") {
			$stu_master_id = $person_info->stu_master_id;
		}
		$form_data = $this->input->post();
		$guardian_data = array(
			'guardian_stu_info_id' => $person_info->stu_info_id,
			'guardian_relation_id' => $form_data['relation_id'],
			'guardian_father' => $form_data['guardian_father'],
			'guardian_father_kh' => $form_data['guardian_father_kh'],
			'guardian_mother' => $form_data['guardian_mother'],
			'guardian_mother_kh' => $form_data['guardian_mother_kh'],
			'guardian_relation' => $form_data['guardian_relation'],
			'guardian_relation_kh' => $form_data['guardian_relation_kh'],
			'guardian_mobile_no'=>$form_data['guardian_mobile_no'],
			'guardian_phone_no'=>$form_data['guardian_phone_no'],
			'guardian_qualification'=>$form_data['guardian_qualification'],
			'guardian_occupation'=>$form_data['guardian_occupation'],
			'guardian_occupation_kh'=>$form_data['guardian_occupation_kh'],
			'guardian_income'=>$form_data['guardian_income'],
	        'guardian_email'=>$form_data['guardian_email'],
	        'guardian_home_address'=>$form_data['guardian_home_address'],
	        'guardian_home_address_kh'=>$form_data['guardian_home_address_kh'],
			'guardian_office_address'=>$form_data['guardian_office_address'],
			'guardian_office_address_kh'=>$form_data['guardian_office_address_kh'],
		);

		if ($option == -1) {
			$guardian_data['guardia_stu_master_id'] = $stu_master_id;
			$guardian_data['created_at'] = date('Y-m-d H:i:s');
			$guardian_data['created_by'] = $logged_in_info->person_id;
		} else {
			$guardian_data['updated_at'] = date('Y-m-d H:i:s');
			$guardian_data['updated_by'] = $logged_in_info->person_id;
		}

		if ($this->Student->save_guardian($guardian_data, $option)){
			//New address
            if ($option == -1) {
                $success_message = lang('students_successful_adding') . ' ' . $guardian_data['guardian_name'];
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_guardian_id' => $guardian_data['stu_guardian_id'], 'stu_info_id' => $stu_info_id));
            } else { //previous address
            	
                $success_message = lang('students_successful_updating') . ' ' . $guardian_data['guardian_name'];
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_id, 'stu_guardian_id' => $option));
            }
        } else {

            echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .
                $guardian_data['guardian_name'], 'stu_info_id' => -1));
        }
	}

	function update_address($student_id=-1)
	{
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$person_info = $this->Student->get_info($student_id);
		$data['person_info'] = $person_info;
		$data['full_name'] = $person_info->stu_last_name.' '.$person_info->stu_first_name;

		$country = $this->Student->get_country();
		$country_temp = ["" => lang('common_select_title')];
		foreach($country as $key => $row) {
			$country_temp[$row->country_id] =  $row->country_name.' ('.$row->country_name_kh.')';
		}
		$data['country'] = $country_temp;

		$state = $this->Student->get_state();
		$state_temp = ["" => lang('common_select_title')];
		foreach($state as $key => $row) {
			$state_temp[$row->state_id] =  $row->state_name;
		}
		$data['state'] = $state_temp;

		$city = $this->Student->get_city();
		$city_temp = ["" => lang('common_select_title')];
		foreach($city as $key => $row) {
			$city_temp[$row->city_id] =  $row->city_name;
		}
		$data['city'] = $city_temp;
		$provinces = $this->Location->get_all_provinces();
		$provinces_temp = ["" => lang('common_select')];
		foreach($provinces as $key => $row) {
			$provinces_temp[$row->province_id] =  $row->province_name.' ('.$row->province_name_kh.')';
		}
		$data['provinces'] = $provinces_temp;

		$this->load->view("students/update_address",$data);
	}

	function do_update_address($stu_info_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$person_info = $this->Student->get_info($stu_info_id);

		$employee_id = false;
		$stu_address_id = false;
		if ($person_info->person_id!="") {
			$employee_id = $person_info->person_id;
			$stu_address_id = $person_info->stu_address_id;
		}

		$form_data = $this->input->post();
		// If don't want to take any input form post
		// You just unset it by input name, Ex: unset($form_data['stu_cadd'])
		$stu_address_data = $form_data;

		if ($this->Student->save_address($stu_address_data, $stu_address_id)){
			//New address
            if ($stu_info_id == -1) {
                $success_message = lang('students_successful_adding_address');
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_id));
            } else { //previous address
            	
                $success_message = lang('students_successful_updating_address');
                echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $stu_info_id));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address'), 'stu_info_id' => -1));
        }
	}

	function delete_guardian()
	{
		$this->check_action_permission('delete');
		$students_to_delete = $this->input->post('id');
		
		if($this->Student->delete_guardian($students_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('students_successful_deleted_guardian')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('students_cannot_be_deleted_guardian')));
		}
	}

	function transfer($stu_info_id=-1, $stu_transfer_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$person_info = $this->Student->get_info($stu_info_id);
		$stu_master_id = $person_info->stu_master_id;
		$form_data = $this->input->post();
		$transfer_data = array(
			'remark' => $form_data['remark'],
			'changed_date' => date('Y-m-d', strtotime($form_data['change_date'])),
			'transfer_type' => $form_data['change'],
			'stu_transfer_stu_master_id' => $stu_master_id,
		);
		if ($form_data['change'] == 'university') {
			$transfer_data['university_id'] = $form_data['university'];
		} else {
			$transfer_data['skill_id'] = $form_data['major'];
		}
		if ($stu_transfer_id == -1) {
			$transfer_data['created_by'] = $logged_in_info->person_id;
			$transfer_data['created_at'] = date('Y-m-d');
		} else {
			$transfer_data['updated_by'] = $logged_in_info->person_id;
			$transfer_data['updated_at'] = date('Y-m-d');
		}

		if ($this->Student->save_transfer($transfer_data, $stu_master_id, $stu_transfer_id)) {
			//New student
			$transfer_majors = $this->Student->get_all_students_transfer($stu_master_id, 'major');
			$transfer_faculties = $this->Student->get_all_students_transfer($stu_master_id, 'university');
			if($form_data['change'] == 'university'){
				$tbl_row = get_view_popup_transfer($transfer_faculties, $this, $form_data['change'], $person_info);
			}else{
				$tbl_row = get_view_popup_transfer($transfer_majors, $this, $form_data['change'], $student_info);
			}
			echo json_encode(array('success' => true, 'message' => lang('students_successful_updating'), 'tbl_row' => $tbl_row, 'change_type' => $form_data['change']));
		} else {
			echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address')));
		}
	}
	function delete_transfer()
	{
		$this->check_action_permission('delete');
		$transfer_id = $this->input->post('id');
		
		if($this->Student->delete_transfer($transfer_id))
		{
			echo json_encode(array('success'=>true,'message'=>lang('students_successful_deleted_transfer')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('students_cannot_be_deleted_transfer')));
		}
	}

	function delete_job_status()
	{
		$this->check_action_permission('delete');
		$job_status_id = $this->input->post('id');
		
		if($this->Student->delete_job_status($job_status_id))
		{
			echo json_encode(array('success'=>true,'message'=>lang('students_successful_deleted_job_status')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('students_cannot_be_deleted_job_status')));
		}
	}
	function delete_academic()
	{
		$this->check_action_permission('delete');
		$acad_id = $this->input->post('id');
		if($this->Student->delete_academic($acad_id))
		{
			echo json_encode(array('success'=>true,'message'=>lang('students_successful_deleted_job_status')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('students_cannot_be_deleted_job_status')));
		}
	}

	function postpon($stu_info_id=-1)
	{
		$data['controller_name'] = strtolower(get_class());
		$data['person_info'] = $this->Student->get_info($stu_info_id);
		$stu_master_id = $data['person_info']->stu_master_id;
		$data['postpon_students'] = $this->Student->get_all_students_postpon($stu_master_id, 'postpon');
		$data['postpon_same_class'] = $this->Student->get_all_students_postpon($stu_master_id, 'postpon_same_class');
		$data['refer_out_students'] = $this->Student->get_students_refer(-1, 'refer_out', $stu_master_id);
		$data['refer_in_students'] = $this->Student->get_students_refer(-1, 'refer_in', $stu_master_id);

		$data['universities'] = $this->opt_selection_faculty();
		$data['levels'] = $this->opt_degrees();
		$data['skills'] = $this->opt_selection_major();
		$data['courses'] = $this->opt_courses();
		$data['batches'] = $this->opt_batches();
		$data['section'] = $this->opt_section();

		$this->load->view("students/postpon/postpon", $data);
	}

	function save_postpon($stu_info_id=-1, $stu_postpon_id=-1) 
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$person_info = $this->Student->get_info($stu_info_id);
		$stu_master_id = $person_info->stu_master_id;
		$form_data = $this->input->post();
		$postpon_data = array(
			'reason_why' => $form_data['remark'],
			'start_date' => date('Y-m-d', strtotime($form_data['start_date'])),
			'end_date' => date('Y-m-d', strtotime($form_data['end_date'])),
			'postpon_type' => $form_data['postpon'],
			'stu_postpon_stu_master_id' => $stu_master_id,
		);
		if ($form_data['postpon'] == 'postpon') {
			$postpon_data['reason'] = $form_data['reason'];
		} else {
			$postpon_data['duration'] = $form_data['duration'];
		}
		if ($stu_postpon_id == -1) {
			$postpon_data['created_by'] = $logged_in_info->person_id;
			$postpon_data['created_at'] = date('Y-m-d');
		} else {
			$postpon_data['updated_by'] = $logged_in_info->person_id;
			$postpon_data['updated_at'] = date('Y-m-d');
		}

		if ($this->Student->save_postpon($postpon_data, $stu_master_id, $stu_postpon_id)) {
			//New record
			$postpon_info = $this->Student->get_students_postpon_by_id($postpon_data['stu_postpon_id'], $form_data['postpon']);
			if ($form_data['postpon'] == "postpon") {
				$tbl_row = '<tr>
					<td>'.date(get_date_format(), strtotime($postpon_info->start_date)).'</td>
					<td>'.date(get_date_format(), strtotime($postpon_info->end_date)).'</td>
					<td>'.$postpon_info->reason.'</td>
					<td>'.$postpon_info->reason_why.'</td>
				</tr>';
			} else {
				$tbl_row = '<tr>
					<td>'.date(get_date_format(), strtotime($postpon_info->start_date)).'</td>
					<td>'.date(get_date_format(), strtotime($postpon_info->end_date)).'</td>
					<td>'.$postpon_info->duration.'</td>
					<td>'.$postpon_info->reason_why.'</td>
				</tr>';
			}
			echo json_encode(array('success' => true, 'message' => lang('students_successful_updating'), 'tbl_row' => $tbl_row, 'postpon_type' => $form_data['postpon']));
		} else {
			echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address')));
		}
	}

	function save_refer_out($stu_info_id=-1, $stu_refer_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$person_info = $this->Student->get_info($stu_info_id);
		$stu_master_id = $person_info->stu_master_id;
		$form_data = $this->input->post();
		$refer_data = array(
			'remark' => $form_data['remark'],
			'refered_date' => date('Y-m-d', strtotime($form_data['refer_date'])),
			'refer_type' => $form_data['referring'],
			'stu_refer_stu_master_id' => $stu_master_id,
		);
		if ($form_data['referring'] == 'refer_out') {
			$refer_data['refer_to'] = $form_data['refer_out_to'];
		} else {
			$refer_data['refer_from'] = $form_data['refer_in_from'];
			$refer_data['university_id'] = $form_data['refer_in_university'];
			$refer_data['skill_id'] = $form_data['refer_in_major'];
			$refer_data['course_id'] = $form_data['refer_in_schedule'];
			$refer_data['batch_id'] = $form_data['refer_in_batch'];
			$refer_data['year_school_id'] = $form_data['refer_in_year_school'];
			$refer_data['level_id'] = $form_data['refer_in_level'];
		}
		if ($stu_refer_id == -1) {
			$refer_data['created_by'] = $logged_in_info->person_id;
			$refer_data['created_at'] = date('Y-m-d');
		} else {
			$refer_data['updated_by'] = $logged_in_info->person_id;
			$refer_data['updated_at'] = date('Y-m-d');
		}

		if ($this->Student->save_refer($refer_data, $stu_master_id, $stu_refer_id)) {
			//New record
			$refer_info = $this->Student->get_students_refer($refer_data['stu_refer_id'], $form_data['referring']);
			if ($form_data['referring'] == "refer_out") {
				$tbl_row = '<tr>
					<td>'.$refer_info->refer_to.'</td>
					<td>'.date(get_date_format(), strtotime($refer_info->refered_date)).'</td>
					<td>'.$refer_info->remark.'</td>
				</tr>';
			} else {
				$tbl_row = '<tr>
					<td>'.$refer_info->refer_from.'</td>
					<td>'.date(get_date_format(), strtotime($refer_info->refered_date)).'</td>
					<td>'.$refer_info->university_name.'</td>
					<td>'.$refer_info->skill_name.'</td>
					<td>'.$refer_info->level_name.'</td>
				</tr>';
			}
			echo json_encode(array('success' => true, 'message' => lang('students_successful_updating'), 'tbl_row' => $tbl_row, 'referring' => $form_data['referring']));
		} else {
			echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address')));
		}
	}

	function get_major_course()
	{
		// get faculty id by major
		$id_univer = $this->Major_model->get_info($this->input->post('major_id'))->faculty_id;
		// get course
		$courses = $this->Course->get_courses($this->input->post('major_id'));
		$option = '<option value="">'.lang('students_select_course').'</option>';
		if ($courses->num_rows() > 0) {
			foreach($courses->result() as $key => $course) {
				$option .= '<option value="'.$course->course_id.'">'.$course->course_name.'</option>';
			}
		}
		echo json_encode(array('courses' => $option, 'university_id' => $id_univer));
	}
	function save_stu_academic($stu_acad_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$form_data = $this->input->post();
		$person_info = $this->Student->get_info($form_data['stu_info_id']);
		$academic_data = [
			'stu_acad_stu_acad_card' => $form_data['stu_unique_id'],
			'stu_acad_stu_acad_unique' => $form_data['num_acad_card'],
			'stu_acad_stu_master_id' => $person_info->stu_master_id,
			'stu_acad_stu_info_id' => $form_data['stu_info_id'],
			'stu_acad_university_id' => $form_data['university'],
			'stu_acad_skill_id' => $form_data['majors'],
			'stu_acad_course_detail_id' => $form_data['course_ids'],
			'stu_acad_batch_id' => $form_data['batch'],
			'stu_acad_grade' => $form_data['grade'],
			'stu_acad_section_id' => $form_data['section'],
			'stu_acad_level_id' => $form_data['degree'],
			'stu_acad_schedule_id' => $form_data['schedule'],
			'stu_acad_scholarship_id'=> $form_data['stu_scholarship'],
			'stu_acad_status' => $form_data['acad_status'],
			'stu_acad_stu_room' => $form_data['acad_room'],
			'stu_acad_stu_class' => $form_data['acad_class'],
			'stu_acad_admission_date' => date('Y-m-d', strtotime($form_data['admission_date'])),
			'stu_acad_completion_date' => date('Y-m-d', strtotime($form_data['completion_date'])),
		];

		if ($this->Student->save_stu_academic($academic_data, $stu_acad_id)){
			$acad_id = $stu_acad_id == -1 ? $academic_data['stu_acad_id'] : $stu_acad_id;

		
			$items = $this->Student->get_all_academic($person_info->stu_master_id, $acad_id);
			$items_academic = get_students_academic_rows($items, $this);
			
			//New academic
			if ($stu_acad_id == -1) {
				$message = lang('students_successful_adding_academic');
				echo json_encode(array('success' => true, 'message' => $message, 'stu_acad_id' => $academic_data['stu_acad_id'], 'items_academic' => $items_academic));
			} else { //previous academic
				$message = lang('students_successful_updating_academic');
				echo json_encode(array('success' => true, 'message' => $message, 'stu_acad_id' => $stu_acad_id, 'items_academic' => $items_academic));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_academic'), 'stu_acad_id' => -1));
		}
	}

	function suggest_faculty(){
		$major_id = $this->input->post('major_id');	
		$query = array();
        $query = $this->Student->suggest_faculty($major_id)->result();
        echo json_encode($query);
	}

	function suggest_course(){
		$major_id = $this->input->post('major_id');		
		$query = array();
        $query = $this->Student->suggest_course($major_id)->result();
        echo json_encode($query);
	}

	function suggest_major(){
		$faculty_id = $this->input->post('faculty_id');	
		$query = array();
        $query = $this->Student->suggest_major($faculty_id)->result();
        echo json_encode($query);
	}

	function upload_prof(){
		$stu_code = $this->input->post('stu_id');
		$id_stu = $this->input->post('id_stu');

		$config['upload_path']   = './assets/avatars'; 
	    $config['allowed_types'] = 'png|jpeg|jpg|gif';	
	    $config['max_size'] = '1024';
	    $config['max_width']  = '1024';
	    $config['max_height']  = '768';
	    $config['file_name'] = $id_stu.'_'.$_FILES['userfile']['name'];

		$this->load->library('upload');
		// we have to initialize before upload
		$this->upload->initialize($config);

         if ( ! $this->upload->do_upload('userfile')) {
			redirect(site_url('students/detail/'.$id_stu));
         }else { 
         	$upload_data = $this->upload->data(); 
  			$name_prof = $upload_data['file_name'];
         	$data = array('profile_img' =>$name_prof);
         	$ch = $this->Student->check_prof($id_stu);
			if(!empty($ch)){
				unlink("./assets/avatars/$ch");
			}
			if($this->Student->update_prof($data, $id_stu) == TRUE){
				redirect(site_url('students/detail/'.$id_stu));
			}else{
				echo "save false";
			}
         } 

	}
	function snap(){	
		$stu_id = $this->input->post('stu_id');
		$id_stu = $this->input->post('id_stu');

		$image_name = $this->input->post('image_name');		
		$img_title = substr($image_name,-18);
		// $title_img = substr($img_title,0,14); clear file type jpg

		if(!empty($image_name)){
			$data = array('profile_img' =>$img_title);
			if($this->Student->update_prof($data, $id_stu) == TRUE){
				echo "TRUE";
			}else{
				echo "FALSE";
			}
		}else{
			echo "FALSE";
		}
	}
	function clear_prof($stu_info_id){
		$id_stu = $this->input->post('id_stu');
		if($id_stu){
			$get_id = $id_stu;
		}else{			
			$get_id = $stu_info_id;
		}
		$ch = $this->Student->check_prof($get_id);
		if(!empty($ch )){
			unlink("./assets/avatars/$ch");
		}
		$data = array('profile_img' =>'');
		if($this->Student->update_prof($data, $get_id)){
			echo 'TRUE';
		}		
	}
	function stu_unique_id_exists() 
	{
		$wid = $_POST['term'];
        $last_id_number = $this->Student->get_last_id_number($wid);        
       	echo json_encode(array("duplicate"=>$last_id_number));
    }

    function stu_mail_exists(){
    	$mail = $this->input->post('mail');
    	$query = $this->Student->checkMailExists($mail);
    	echo json_encode ( $query );
    }

}
?>