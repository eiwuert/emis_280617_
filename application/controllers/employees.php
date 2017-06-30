<?php
require_once ("person_controller.php");
class Employees extends Person_controller
{
	function __construct()
	{
		parent::__construct('employees');
	}
	
	function index($offset=0)
	{
		$params = $this->session->userdata('employee_search_data') ? $this->session->userdata('employee_search_data') : array('offset' => 0, 'order_col' => 'id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
		   redirect('employees/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('employees/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search'])
		{
			$config['total_rows'] = $this->Employee->search_count_all($data['search']);
			$table_data = $this->Employee->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Employee->count_all();
			$table_data = $this->Employee->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table']=get_people_manage_table($table_data,$this);
		$this->load->view('people/manage',$data);
	}
	
	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$employee_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("employee_search_data",$employee_search_data);
		if ($search)
		{
			$config['total_rows'] = $this->Employee->search_count_all($search);
			$table_data = $this->Employee->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		}
		else
		{
			$config['total_rows'] = $this->Employee->count_all();
			$table_data = $this->Employee->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		}
		$config['base_url'] = site_url('employees/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_people_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	
	function clear_state()
	{
		$this->session->unset_userdata('employee_search_data');
		redirect('employees');
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Employee->check_duplicate($this->input->post('term'))));
	}
	/* added for excel expert */
	function excel_export() {
		$data = $this->Employee->get_all()->result_object();
		$this->load->helper('report');
		$rows = array();
		$row = array(lang('employees_username'),lang('common_first_name'),lang('common_last_name'),lang('common_email'),lang('common_phone_number'),lang('common_address_1'),lang('common_address_2'),lang('common_city'),	lang('common_state'),lang('common_zip'),lang('common_country'),lang('common_comments'));
		$rows[] = $row;
		foreach ($data as $r) {
			$row = array(
				$r->username,
				$r->first_name,
				$r->last_name,
				$r->email,
				$r->phone_number,
				$r->address_1,
				$r->address_2,
				$r->city,
				$r->state,
				$r->zip,
				$r->country,
				$r->comments
			);
			$rows[] = $row;
		}
		
		$content = array_to_spreadsheet($rows);
		force_download('employees_export.'.($this->config->item('spreadsheet_format') == 'XLSX' ? 'xlsx' : 'csv'), $content);
		exit;
	}
	
	/*
	Returns employee table data rows. This will be called with AJAX.
	*/
	function search()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$employee_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("employee_search_data",$employee_search_data);
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data=$this->Employee->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		$config['base_url'] = site_url('employees/search');
		$config['total_rows'] = $this->Employee->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_people_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function suggest()
	{
		session_write_close();
		$suggestions = $this->Employee->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}
	function view($employee_id=-1,$redirect_code=0)
	{
		$this->check_action_permission('add_update');
		$data['person_info']=$this->Employee->get_info($employee_id);
		$data['logged_in_employee_id'] = $this->Employee->get_logged_in_employee_info()->person_id;
		$data['all_modules']=$this->Module->get_all_modules();
		$data['controller_name']=strtolower(get_class());

		$locations_list=$this->Location->get_all()->result();
		$authenticated_locations = $this->Employee->get_authenticated_location_ids($employee_id);
		$logged_in_employee_authenticated_locations = $this->Employee->get_authenticated_location_ids($data['logged_in_employee_id']);
		$can_assign_all_locations = $this->Employee->has_module_action_permission('employees', 'assign_all_locations', $this->Employee->get_logged_in_employee_info()->person_id);		
		$locations = array();
		foreach($locations_list as $row)
		{
			$has_access = in_array($row->location_id, $authenticated_locations);
			$can_assign_access = $can_assign_all_locations || (in_array($row->location_id, $logged_in_employee_authenticated_locations));

			$locations[$row->location_id] = array('name' => $row->name, 'has_access' => $has_access, 'can_assign_access' => $can_assign_access);
		}
		$data['locations']=$locations;
		$data['redirect_code']=$redirect_code;
		$data['user_types'] = $this->Employee->get_all_user_type();

		$data['titles'] = $this->opt_titles2();
		$data['emp_maritalstatus'] = $this->opt_emp_maritalstatus();
		$data['nationality'] = $this->opt_nationality();
		$data['province'] = $this->opt_province();	
		$data['emp_categories'] = $this->opt_time_schedule2();
		$data['emp_designations'] = $this->opt_designation();
		$data['emp_departments'] = $this->opt_selection_faculty();		
		$data['emp_departments_type'] = $this->opt_department_type();

		$years = ["" => lang('common_year')];
		for ($i=1; $i <= 60; $i++) { 
			$years[$i] = $i;
		}
		$data['years'] = $years;
		$months = ["" => lang('common_month')];
		for ($i=1; $i <= 11; $i++) { 
			$months[$i] = $i;
		}
		$data['months'] = $months;

		if ($employee_id == -1) {
			$data['emp_unique_id'] = $this->last_running_number();
		}
		$data['degree'] = $this->opt_degrees();
		$data['major'] = $this->opt_selection_major();
		$data['courses'] = $this->opt_courses();
		$this->load->view("employees/form",$data);
	}

	function last_running_number() 
	{
        $last_running_number = $this->Employee->get_last_running_number();
        $running_number = $last_running_number + 1;
        if (strlen($running_number) < 6) {
            $running_number = str_pad($running_number, 6, '0', STR_PAD_LEFT);
        }
        return $running_number;
    }

	function employee_exists()
	{
		if($this->Employee->employee_username_exists($this->input->post('username')))
		echo 'false';
		else
		echo 'true';	
	}
	function exmployee_exists_email()
	{
		if($this->Employee->employee_email_exists($this->input->post('email')))
		echo 'false';
		else
		echo 'true';	
	}
	/*
	Inserts/updates an employee
	*/
	function save($employee_id=-1)
	{
		$this->check_action_permission('add_update');
		$get_info_employee = $this->Employee->get_info_prof($professor_id);
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$form_input = $this->input->post();
		$majors = $form_input['majors'];
		$emp_info_data = array(
			'emp_unique_id'=>$form_input['emp_unique_id'],
			'emp_title'=>$form_input['emp_title'],
			'emp_maritalstatus'=>$form_input['emp_maritalstatus'],
			'emp_experience_year'=>$form_input['emp_experience_year'],
			'emp_experience_month'=>$form_input['emp_experience_month'],
		);
		$emp_master_data = array(
			'emp_master_department_id'=>$form_input['emp_master_department_id'],
			'emp_master_designation_id'=>$form_input['emp_master_designation_id'],
			'emp_master_category_id'=>$form_input['emp_master_category_id'],
			'emp_master_nationality_id'=>$form_input['emp_master_nationality_id'],
		);

		if ($employee_id == -1) {
			$emp_master_data['created_at'] = date('Y-m-d H:i:s');
			$emp_master_data['created_by'] = $logged_in_employee_id;
		}
		$emp_address_data = array(
			'emp_cadd' => NULL,
			'emp_cadd_house_no' => $form_input['home_no'],
			'emp_cadd_street_no' => $form_input['street_no'],
			'emp_cadd_district' => $form_input['district'],
			'emp_cadd_commune' => $form_input['commune'],
			'emp_cadd_province' => $form_input['province'],
			'emp_cadd_phone_no' => $form_input['phone_number']
		);
		$person_data = array(
			'first_name'=>$form_input['first_name'],
			'last_name'=>$form_input['last_name'],
			'first_name_kh'=>$form_input['first_name_kh'],
			'last_name_kh'=>$form_input['last_name_kh'],
			'gender'=>$form_input['gender'],
			'dob'=>date('Y-m-d', strtotime($form_input['dob'])),
			'email'=>$form_input['email'],
			'phone_number'=>$form_input['phone_number'],
			'zip'=>$form_input['zip'],
			'contact_name'=>$form_input['contact_name'],
			'contact_number'=>$form_input['contact_number'],
			'relationship'=>$form_input['relationship'],
			'expired_date'=>date('Y-m-d', strtotime($form_input['expired_date'])),
			'joined_date'=>date('Y-m-d', strtotime($form_input['joined_date'])),
			'degree_level'=>$form_input['degree_level'],
			'skill'=>$form_input['skill'],
			'bank_name'=>$form_input['bank_name'],
			'bank_number'=>$form_input['bank_number'],
			'teach_major'=>$form_input['teach_major'],
			'teach_course_ids'=>$form_input['teach_course_ids'],
			'department_type'=>$form_input['department_type']
		);
		$redirect_code = $form_input['redirect_code'];
		$employee_data = array(
			'user_type_id'=>$form_input['user_type']
		);
		$this->load->helper('directory');
		$valid_languages = directory_map(APPPATH.'language/', 1);
		$employee_data = array_merge($employee_data,array('language'=>in_array($form_input['language'], $valid_languages) ? $form_input['language'] : 'english'));
		if($this->Employee->save($person_data,$emp_master_data,$emp_info_data,$emp_address_data,$employee_data,$employee_id, $majors))
		{
			//New employee
			if($employee_id==-1)
			{
				$success_message = lang('employees_successful_adding').' '.$person_data['first_name'].' '.$person_data['last_name'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'person_id'=>$employee_data['person_id'],'redirect_code'=>$redirect_code));
			}
			else //previous employee
			{
				$success_message = lang('employees_successful_updating').' '.$person_data['first_name'].' '.$person_data['last_name'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'person_id'=>$employee_id,'redirect_code'=>$redirect_code));
			}
			//Delete Image
			if($form_input['del_image'] && $employee_id != -1) {
				$employee_info = $this->Employee->get_info($employee_id);
				if($employee_info->image_id != null) {
					$this->Person->update_image(NULL,$employee_id);
					$this->Appfile->delete($employee_info->image_id);
				}
			}
			//Save Image File
			if(!empty($_FILES["image_id"]) && $_FILES["image_id"]["error"] == UPLOAD_ERR_OK) {

				$new_file_name = $employee_data['person_id'].'_'.$_FILES["image_id"]["name"];
				$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
				$extension = strtolower(pathinfo($_FILES["image_id"]["name"], PATHINFO_EXTENSION));
				$dir = './assets/employees/'; 
				if (in_array($extension, $allowed_extensions)) {
					$config['image_library'] = 'gd2';
					$config['source_image'] = $_FILES["image_id"]["tmp_name"];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 400;
					$config['height'] = 300;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$image_file_id = $this->Appfile->save($_FILES["image_id"]["name"], file_get_contents($_FILES["image_id"]["tmp_name"]));
				}
				if($employee_id==-1) {
					$this->Person->update_image($image_file_id,$employee_data['person_id']);
					move_uploaded_file($_FILES["image_id"]["tmp_name"], $dir.$_FILES["image_id"]["name"]);
				} else {
					$this->Person->update_image($image_file_id,$employee_id);
					move_uploaded_file($_FILES["image_id"]["tmp_name"], $dir.$_FILES["image_id"]["name"]);

				}
			}
			// Upload CV, Document
			if (!empty($_FILES["filename"])) {
				$dir = './assets/employees/';
				$quantFiles = count($_FILES['filename']['name']);
				for($i = 0; $i < $quantFiles ; $i++) {
					if ($_FILES["filename"]["error"][$i] == UPLOAD_ERR_OK) {
						$file_name = $_FILES["filename"]["name"][$i];
						$new_file_name = date("His").'_'.$person_data['last_name'].'_'.$person_data['first_name'].'_'.preg_replace('/\s+/', '_', $file_name);
						$allowed_extensions = array('pdf', 'doc', 'docx', 'txt');
						$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
						if (in_array($extension, $allowed_extensions)) {							
							$docs_data = array(
								'emp_docs_path' => $new_file_name,
								'emp_docs_submited_at' => date('Y-m-d H:i:s'),
								'emp_docs_emp_master_id' => (($employee_id !== -1)? $get_info_employee->emp_master_id : $emp_master_data['master_id']),
								'created_by' => $logged_in_employee_id,
							);

							if ($this->Employee->save_document($docs_data)) {
								move_uploaded_file($_FILES["filename"]["tmp_name"][$i], $dir. $new_file_name);
							}
						}
					}
				}
			}
		}
		else//failure
		{	
			echo json_encode(array('success'=>false,'message'=>lang('employees_error_adding_updating').' '.
			$person_data['first_name'].' '.$person_data['last_name'],'person_id'=>-1));
		}
	}
	function save_personal($person_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$person_info = $this->Employee->get_info($person_id);
		$emp_info_id = $person_info->emp_info_id;
		$form_data = $this->input->post();
		$majors = $form_data['majors'];
		$person_data = array(
			'first_name'=>$form_data['first_name'],
			'last_name'=>$form_data['last_name'],
			'first_name_kh'=>$form_data['first_name_kh'],
	        'last_name_kh'=>$form_data['last_name_kh'],
			'gender'=>$form_data['gender'],
			'dob' => $form_data['dob'] ? date('Y-m-d', strtotime($form_data['dob'])) : "",
			'email' => $form_data['email'],
			'phone_number' => $form_data['phone_number'],
			'joined_date' => $form_data['joined_date'] ? date('Y-m-d', strtotime($form_data['joined_date'])) : "",
			'department_type'=>$form_data['department_type']
		);
		$emp_info_data = array(
			'emp_unique_id' => $form_data['emp_unique_id'],
			'emp_title' => $form_data['emp_title'],
			'emp_birthplace' => $form_data['emp_birthplace'],
			'emp_religion' => $form_data['emp_religion'],
			'emp_languages' => $form_data['emp_languages'],
			'emp_maritalstatus'=>$form_data['emp_maritalstatus'],
			'emp_experience_year'=>$form_data['emp_experience_year'],
			'emp_experience_month'=>$form_data['emp_experience_month'],
		);
		$emp_master_data = array(
			'emp_master_department_id'=>$form_data['emp_master_department_id'],
			'emp_master_designation_id'=>$form_data['emp_master_designation_id'],
			'emp_master_nationality_id' => $form_data['emp_master_nationality_id'],
			'emp_master_category_id' => $form_data['emp_master_category_id'],
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $logged_in_info->person_id,
		);

		if ($this->Employee->save_personal($person_data, $emp_master_data, $emp_info_data, $person_id, $emp_info_id, $majors)) {
            //New student
            $success_message = lang('students_successful_updating') . ' ' . $emp_info_data['stu_first_name'] . ' ' . $emp_info_data['stu_last_name'];
                echo json_encode(array('success' => true, 'message' => $success_message, 'person_id' => $person_id));
        } else {
            echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .
                $emp_info_data['stu_first_name'] . ' ' . $emp_info_data['stu_last_name'], 'person_id' => -1));
        }

	}
	/*
	This deletes employees from the employees table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$employees_to_delete=$this->input->post('ids');
		
		if (in_array(1,$employees_to_delete))
		{
			//failure
			echo json_encode(array('success'=>false,'message'=>lang('employees_cannot_delete_default_user')));
		}
		elseif($this->Employee->delete_list($employees_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('employees_successful_deleted').' '.
			count($employees_to_delete).' '.lang('employees_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('employees_cannot_be_deleted')));
		}
	}
		
	function cleanup()
	{
		$this->Employee->cleanup();
		echo json_encode(array('success'=>true,'message'=>lang('employees_cleanup_sucessful')));
	}

	function detail($employee_id=-1)
	{

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['person_info'] = $this->Employee->get_info($employee_id);
		// var_dump($data['person_info']);
		// exit();
		$data['designation_info'] = $this->Designation_model->get_info($data['person_info']->emp_master_designation_id);
		$data['category_info'] = $this->Category->get_info($data['person_info']->emp_master_category_id);
		$data['nationality_info'] = $this->Nationality->get_info($data['person_info']->emp_master_nationality_id);
		$data['cadd_province_info'] = $this->Emp_address->get_info_province($data['person_info']->emp_cadd_province);
		$data['padd_province_info'] = $this->Emp_address->get_info_province($data['person_info']->emp_padd_province);
		$data['address_info'] = $this->Emp_address->get_info($data['person_info']->emp_master_emp_address_id);
		
		$data['major_info'] = $this->Employee->get_major_arr($data['person_info']->teach_major);
		$data['course_info'] = $this->Employee->get_course_arr($data['person_info']->teach_course_ids);
		
		$data['faculty_info'] = $this->Universities->get_info($data['person_info']->teach_faculty);
		$data['academic_info'] = $this->Section->get_info($data['person_info']->teach_academic_year);
		
		$ch_btn_snap = $this->Employee->check_prof($data['person_info']->image_id);
		if(empty($ch_btn_snap )){
			$data['btn_snap'] = '<input type="button" class="snap" value="SNAP IT" onClick="take_snapshot()">';
			$data['old_prof'] = '<img class="img-circle edusec-img-disp" src="'.site_url("assets/img/no-photo.png").'" alt="No Image">';
		}else{
			$data['btn_snap'] = '<input style="background:red" type="button" class="snap" value="Change" onClick="clear_snapshot()">';
			$data['old_prof'] = '<img class="img-circle edusec-img-disp" src="'.base_url("assets/employees/$ch_btn_snap").'">';
		}

		$this->load->view("employees/detail",$data);
	}

	//************************************************** ditecso developer***********************************
	function check_duplicate_emp_info()
	{			
		echo json_encode(array('duplicate'=>$this->Emp_address->check_duplicate($this->input->post('term'))));
	}

	function update_other_info($person_id=-1){
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['person_other_info'] = $this->Emp_address->get_emp_info($person_id);
		$this->load->view("employees/update_emp_other_info",$data);
	}

	function do_update_other_info($emp_info_id = -1){
		$this->check_action_permission('add_update');		
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$employees_info = $this->Emp_address->get_other_info($emp_info_id);

		$form_data = $this->input->post();
		$emp_info_data = array(
			'emp_attendance_card_id' => $form_data['emp_attendance_card_id'],
			'emp_bankaccount_no' => $form_data["emp_bankaccount_no"],
			'emp_mother_name'=>$form_data["emp_mother_name"],
			'emp_reference'=>$form_data["emp_reference"],
			'emp_father_name'=>$form_data["emp_father_name"],
			'emp_reference_father'=>$form_data["emp_reference_father"],
			'emp_specialization'=>$form_data['emp_specialization'],
			'emp_languages'=>$form_data['emp_languages'],
			'emp_hobbies'=>$form_data['emp_hobbies']
		);

		if ($this->Emp_address->save_info($emp_info_data, $emp_info_id)){
			//New address
            if ($emp_info_id == -1) {
                $success_message = lang('employees_successful_adding');
                echo json_encode(array('success' => true, 'message' => $success_message, 'emp_info_id' => $emp_info_data['emp_info_id']));
            } else { //previous address
                $success_message = lang('employees_successful_updating');
                echo json_encode(array('success' => true, 'message' => $success_message, 'emp_info_id' => $emp_info_id));
            }
		}else{
			echo json_encode(array('success' => false, 'message' => lang('employees_error_adding_updating'), 'emp_info_id' => -1));
		}
	}

	function edit_guardian($person_id = -1){
		
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['emp_guardians'] = $this->Employee->get_info($person_id);
		$this->load->view("employees/update_emp_guardian",$data);		
	}

	function do_edit_guardian($emp_info_id=-1){
	
		$this->check_action_permission('add_update');	
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$employees_info = $this->Employee->get_info($emp_info_id);
	
		$form_data = $this->input->post();
		$emp_info_data = array( 
				'emp_guardian_name' => $form_data['emp_guardian_name'],
				'emp_guardian_name_kh' => $form_data['emp_guardian_name_kh'],
				'emp_guardian_relation' => $form_data['emp_guardian_relation'],
				'emp_guardian_relation_kh' => $form_data['emp_guardian_relation_kh'],
				'emp_guardian_qualification' => $form_data['emp_guardian_qualification'],
				'emp_guardian_occupation' => $form_data['emp_guardian_occupation'], 
				'emp_guardian_occupation_kh' => $form_data['emp_guardian_occupation_kh'],
				'emp_guardian_income' => $form_data['emp_guardian_income'],
				'emp_guardian_mobile_no' => $form_data['emp_guardian_mobile_no'],
				'emp_guardian_phone_no' => $form_data['emp_guardian_phone_no'],
				'emp_guardian_email_id' => $form_data['emp_guardian_email_id'],
				'emp_guardian_officeadd' => $form_data['emp_guardian_officeadd'],
				'emp_guardian_officeadd_kh' => $form_data['emp_guardian_officeadd_kh'],
				'emp_guardian_homeadd' => $form_data['emp_guardian_homeadd'],
				'emp_guardian_homeadd_kh' => $form_data['emp_guardian_homeadd_kh']
		); 
	
		if ($this->Emp_address->save_info($emp_info_data, $emp_info_id)){
			//New address
            if ($emp_info_id == -1) {
                $success_message = lang('employees_successful_adding');
                echo json_encode(array('success' => true, 'message' => $success_message, 'emp_info_id' => $emp_info_data['emp_info_id']));
            } else { //previous address
            	
                $success_message = lang('employees_successful_updating');
                echo json_encode(array('success' => true, 'message' => $success_message, 'emp_info_id' => $emp_info_id));
            }
		}else{
			echo json_encode(array('success' => false, 'message' => lang('employees_error_adding_updating'), 'emp_info_id' => -1));
		}
	}

	function update_address($person_id=-1){
		
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['emp_address'] = $this->Employee->get_info($person_id);
		$data['province'] = $this->opt_province();
		$this->load->view("employees/update_emp_address",$data);
	}

	function do_update_address($emp_address_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$employees_info = $this->Employee->get_info($emp_address_id);

		$form_data = $this->input->post();
		$emp_address_data = array(
			'emp_cadd' => $form_data['emp_cadd'],			
			'emp_cadd_house_no'=>$form_data['emp_cadd_house_no'],
			'emp_cadd_street_no'=>$form_data["emp_cadd_street_no"],
			'emp_cadd_district'=>$form_data["emp_cadd_district"],
			'emp_cadd_commune'=>$form_data["emp_cadd_commune"],
			'emp_cadd_province'=>$form_data['emp_cadd_province'],
			'emp_cadd_phone_no'=>$form_data['emp_cadd_phone_no'],
	        'emp_padd'=>$form_data['emp_padd'],
	        'emp_padd_house_no'=>$form_data['emp_padd_house_no'],
			'emp_padd_street_no' => $form_data["emp_padd_street_no"],
			'emp_padd_district'=>$form_data["emp_padd_district"],
			'emp_padd_commune'=>$form_data["emp_padd_commune"],
			'emp_padd_province'=>$form_data['emp_padd_province'],
			'emp_padd_phone_no'=>$form_data['emp_padd_phone_no'],
		);

		if ($this->Employee->save_address($emp_address_data, $emp_address_id)){
			//New address
            if ($emp_address_id == -1) {
                $success_message = lang('employees_successful_adding');
                echo json_encode(array('success' => true, 'message' => $success_message, 'emp_address_id' => $emp_address_data['emp_address_id']));
            } else { //previous address
            	
                $success_message = lang('employees_successful_updating');
                echo json_encode(array('success' => true, 'message' => $success_message, 'emp_address_id' => $emp_address_id));
            }
		}else{
			echo json_encode(array('success' => false, 'message' => lang('employees_error_adding_updating'), 'emp_address_id' => -1));
		}
	}

	function update_personal($employee_id=-1)
	{
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$person_info = $this->Employee->get_info($employee_id);
		$data['person_info'] = $person_info;
		$data['full_name'] = $person_info->last_name.' '.$person_info->first_name;
		/*$data['stu_prefix'] = 'STU';
		if ($student_id == -1) {
			$data['stu_unique_id'] = $this->last_running_number();
		}*/
		$data['genders'] = $this->opt_gender2();
		$data['titles'] = $this->opt_titles2();
		$data['emp_maritalstatus'] = $this->opt_emp_maritalstatus();
		$data['bloodgroups'] = $this->opt_bloodgroups();
		$data['nationality'] = $this->opt_nationality();
		$data['emp_categories'] = $this->opt_time_schedule2();
		$data['emp_designations'] = $this->opt_designation();
		$data['emp_departments'] = $this->opt_selection_faculty();
		$data['emp_departments_type'] = $this->opt_department_type();

		$years = ["" => lang('common_year')];
		for ($i=1; $i <= 60; $i++) { 
			$years[$i] = $i;
		}
		$data['years'] = $years;
		$months = ["" => lang('common_month')];
		for ($i=1; $i <= 11; $i++) { 
			$months[$i] = $i;
		}
		$data['months'] = $months;

		$skills = $this->Student->get_all_skills($person_info->emp_department_id);
		$skills_temp = [];
		foreach($skills as $key => $skill) {
			$skills_temp[$skill->skill_id] =  $skill->skill_name.' ('.$skill->skill_name_kh.')';
		}
		$data['major'] = $skills_temp;
		
		$get_edit_major = $this->Professor->get_info_edit_major($employee_id)->result();
		$e_major = array();
		foreach($get_edit_major as $key => $row){
			$e_major[] = $row->major_id;
		} 
		$data['edit_major'] = $e_major;

		if ($employee_id == -1) {
			$data['emp_unique_id'] = $this->last_running_number();
		}

		$this->load->view("employees/update_personal",$data);
	}

	function get_major_info()
	{
		echo json_encode(array(
			'major_info' => $this->Major_model->get_info($this->input->post('major_id'))
		));
	}

	function update_academic($employee_id=-1)
	{
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['person_info'] = $this->Employee->get_info($employee_id);
		$data['major_info'] = $this->Major_model->get_info($data['person_info']->teach_major);
		$data['faculty_info'] = $this->Universities->get_info($data['person_info']->teach_faculty);
		$data['academic_info'] = $this->Section->get_info($data['person_info']->teach_academic_year);
		
		$data['major'] = $this->opt_selection_major();
		$data['faculty'] = $this->opt_selection_faculty();
		$data['courses'] = $this->opt_courses();	
		$data['degree'] = $this->opt_degrees();

		$this->load->view("employees/update_emp_academic",$data);
	}

	function do_update_academic($person_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$employees_info = $this->Employee->get_info($person_id);

		$form_data = $this->input->post();
		$person_data = array(
			'degree_level' => $form_data['degree_level'],
			'skill' => $form_data["skill"],
			'teach_major'=>$form_data["teach_major"],
			'teach_faculty'=>$form_data["teach_faculty"],
			'teach_course_ids'=>$form_data["teach_course_ids"],
		);

		if ($this->Employee->save_people($person_data, $person_id)){
			if ($person_id == -1) {
				$success_message = lang('employees_successful_adding');
				echo json_encode(array('success' => true, 'message' => $success_message, 'person_id' => $person_data['person_id']));
			} else {
				$success_message = lang('employees_successful_updating');
				echo json_encode(array('success' => true, 'message' => $success_message, 'person_id' => $person_id));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => lang('employees_error_adding_updating'), 'person_id' => -1));
		}
	}

	function get_all_courses()
	{
		$major_ids = explode(',', $this->input->post('major_id'));
		$courses = $this->Course->get_courses($major_ids);
		$options = '';
		if ($courses->num_rows() > 0) {
			foreach ($courses->result() as $key => $course) {
				$options .= '<option value="'.$course->course_id.'">'.$course->course_name.' ('.$course->course_code.')'.'</option>';
			}
		}
		echo json_encode(array('options' => $options));
	}

	// xxxxxx
	function upload_prof(){
		$id_emp = $this->input->post('id_emp');
		$id_person = $this->input->post('id_person');
		$person_info = $this->Employee->get_info($id_person);


// print_r($_FILES["userfile"]["name"]);
// echo "</br>";
// print_r($_FILES["userfile"]["type"]);
// echo "</br>";
// print_r($_FILES["userfile"]["error"]);
// exit();
		
			if(!empty($_FILES["userfile"]) && !empty($_FILES["userfile"]["type"]) && $_FILES["userfile"]["error"] == UPLOAD_ERR_OK) {
				$new_file_name = $id_person.'_'.$_FILES["userfile"]["name"];
				$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
				$extension = strtolower(pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION));
				$dir = './assets/employees/'; 
				if (in_array($extension, $allowed_extensions)) {
					$config['image_library'] = 'gd2';
					$config['source_image'] = $_FILES["userfile"]["tmp_name"];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 400;
					$config['height'] = 300;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$ch = $this->Employee->check_prof($person_info->image_id);
					if(!empty($ch)){
						unlink("./assets/employees/$ch");
					}

					$image_file_id = $this->Appfile->save($_FILES["userfile"]["name"], file_get_contents($_FILES["userfile"]["tmp_name"]), $person_info->image_id);
				}
				$this->Person->update_image($image_file_id,$id_person);
				move_uploaded_file($_FILES["userfile"]["tmp_name"], $dir.$_FILES["userfile"]["name"]);
				redirect(site_url('employees/detail/'.$id_person));
			}
	}
	function snap(){	
		$id_emp = $this->input->post('id_emp');		
		$id_person = $this->input->post('id_person');
		$image_name = $this->input->post('image_name');				
		$person_info = $this->Employee->get_info($id_person);		
		// ch and unlink app_file
		$image_id = $person_info->image_id;	
		$img_title = substr($image_name,-18);
		// $title_img = substr($img_title,0,14); clear file type jpg
		if(!empty($image_name)){
			$data_file = array('file_name' =>$img_title);
			if($this->Employee->update_prof($data_file, $id_person, $image_id) == TRUE){
				echo "TRUE";
			}else{
				echo "FALSE";
			}
		}else{
			echo "FALSE";
		}
	}
	function clear_prof($stu_info_id){
		$id_emp = $this->input->post('id_emp');
		if($id_emp){
			$get_id = $id_emp;
		}else{			
			$get_id = $stu_info_id;
		}
		$ch = $this->Employee->check_prof($get_id);
		if(!empty($ch )){
			unlink("./assets/employees/$ch");
		}
		$data = array('profile_img' =>'');
		if($this->Employee->update_prof($data, $get_id)){
			echo 'TRUE';
		}		
	}
	function view_file($employee_id){		
		$data['controller_name']=strtolower(get_class());
		$this->check_action_permission('view');
		$q_docs = $this->Professor->get_softfile($employee_id);
		$load_fun = 'employees';
		$data['manage_table'] = get_docs_manage_table($q_docs, $this,$load_fun);
		$this->load->view("professors/view_softfile",$data);
	}

	function delete_soft_file()
	{
		$controller_name=strtolower(get_class());
		$this->check_action_permission('delete');
		$del_softfile = $this->input->post('ids');
		$load_fun = 'employees';
		
		if($this->Employee->del_softfiles($del_softfile,$load_fun))
		{
			echo json_encode(array('success'=>true,'message'=>lang($controller_name.'_successful_deleted').' '.
			count($del_softfile).' '.lang($controller_name.'_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang($controller_name.'_cannot_be_deleted')));
		}
	}
// tool
	function opt_province(){
		$province = $this->Emp_address->get_info_province()->result();
		$province_temp = [];
		foreach($province as $key => $val) {
			$province_temp[$val->province_id] =  $val->province_name.' ('.$val->province_name_kh.')';
		}
		return $province_temp;
	}

}
?>