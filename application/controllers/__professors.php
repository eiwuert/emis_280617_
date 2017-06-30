<?php
require_once ("person_controller.php");
class Professors extends Person_controller
{
	function __construct()
	{
		parent::__construct('professors');
	}

	function index($offset=0)
	{
		$params = $this->session->userdata('professor_search_data')
				? $this->session->userdata('professor_search_data')
				: array(
					'offset' => 0,
					'order_col' => 'id',
					'order_dir' => 'desc',
					'search' => FALSE
				);
		if ($offset!=$params['offset'])
		{
		   redirect('professors/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('professors/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page')
							? (int)$this->config->item('number_of_items_per_page')
							: 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search'])
		{
			$config['total_rows'] = $this->Professor->search_count_all($data['search']);
			$table_data = $this->Professor->search(
				$data['search'],
				$data['per_page'],
				$params['offset'],
				$params['order_col'],
				$params['order_dir']
			);
		}
		else
		{
			$config['total_rows'] = $this->Professor->count_all();
			$table_data = $this->Professor->get_all(
				$data['per_page'],
				$params['offset'],
				$params['order_col'],
				$params['order_dir']
			);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_people_manage_table($table_data, $this);

		$this->load->view('people/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search') ? $this->input->post('search') : "";
		$per_page = $this->config->item('number_of_items_per_page')
					? (int)$this->config->item('number_of_items_per_page')
					: 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';
		$professor_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("professor_search_data",$professor_search_data);
		if ($search)
		{
			$config['total_rows'] = $this->Professor->search_count_all($search);
			$table_data = $this->Professor->search(
				$search,
				$per_page,
				$offset,
				$order_col,
				$order_dir
			);
		}
		else
		{
			$config['total_rows'] = $this->Professor->count_all();
			$table_data = $this->Professor->get_all(
				$per_page,
				$offset,
				$order_col,
				$order_dir
			);
		}
		$config['base_url'] = site_url('professors/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_people_manage_table_data_rows($table_data, $this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	
	function clear_state()
	{
		$this->session->unset_userdata('professor_search_data');
		redirect('professors');
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate' => $this->Professor->check_duplicate($this->input->post('term'))));
	}

	/*
	Returns professor table data rows. This will be called with AJAX.
	*/
	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$professor_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("professor_search_data",$professor_search_data);
		$per_page = $this->config->item('number_of_items_per_page')
					? (int)$this->config->item('number_of_items_per_page')
					: 20;
		$search_data = $this->Professor->search(
			$search,
			$per_page,
			$offset,
			$order_col,
			$order_dir
		);
		$config['base_url'] = site_url('professors/search');
		$config['total_rows'] = $this->Professor->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_people_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));	
	}
	
	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Professor->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	/* added for excel expert */
	/*function excel_export() {
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
	}*/
	
	/*
	Loads the professor edit form
	*/
	function view($professor_id = -1, $redirect_code = 0)
	{
		$this->check_action_permission('add_update');
		$data['person_info'] = $this->Professor->get_info($professor_id);
		$data['logged_in_employee_id'] = $this->Employee->get_logged_in_employee_info()->person_id;
		$data['all_modules'] = $this->Module->get_all_modules();
		$data['controller_name'] = strtolower(get_class());
		$data['redirect_code']=$redirect_code;
		$data['titles'] = [
			"" => lang('common_select_title'),
			"Mr." => lang('common_mr'),
			"Mrs." => lang('common_mrs'),
			"Ms." => lang('common_ms'),
			"Prof." => lang('common_prof'),
			"Dr." => lang('common_dr'),
		];
		$data['emp_maritalstatus'] = [
			"" => lang('common_select'),
			"UNMARRIED" => lang('common_unmarried'),
			"MARRIED" => lang('common_married'),
			"DIVORCED" => lang('common_divorced')
		];
		$nationality = $this->Student->get_all_nationality();
		$nationality_temp = ["" => lang('students_select_nationality')];
		foreach($nationality as $key => $row) {
			$nationality_temp[$row->nationality_id] =  $row->nationality_name;
		}
		$data['nationality'] = $nationality_temp;

		$categories = $this->Employee->get_all_categories();
		$emp_categories = ["" => lang('common_select')];
		foreach($categories as $key => $category) {
			$emp_categories[$category->emp_category_id] =  $category->emp_category_name;
		}
		$data['emp_categories'] = $emp_categories;

		$designations = $this->Employee->get_all_designations();
		$emp_designations = ["" => lang('common_select')];
		foreach($designations as $key => $desing) {
			$emp_designations[$desing->designation_id] =  $desing->designation_name;
		}
		$data['emp_designations'] = $emp_designations;

		$departments = $this->Employee->get_all_departments();
		$emp_departments = ["" => lang('common_select')];
		foreach($departments as $key => $dept) {
			$emp_departments[$dept->university_id] =  $dept->university_name;
		}
		$data['emp_departments'] = $emp_departments;

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

		if ($professor_id == -1) {
			$data['emp_unique_id'] = $this->last_running_number();
		}

		$skills = $this->Student->get_all_skills();
		$skills_temp = [];
		foreach($skills as $key => $skill) {
			$skills_temp[$skill->skill_id] =  $skill->skill_name.' ('.$skill->skill_name_kh.')';
		}
		$data['major'] = $skills_temp;
		$courses = $this->Course->get_courses();
		$courses_temp = [];
		foreach($courses->result() as $key => $course) {
			$courses_temp[$course->course_id] =  $course->course_name.' ('.$course->course_code.')';
		}
		$data['courses'] = $courses_temp;

		$this->load->view("professors/form",$data);
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
	Inserts/updates an Professor
	*/
	function save($professor_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$form_input = $this->input->post();
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
		if ($professor_id == -1) {
			$emp_master_data['created_at'] = date('Y-m-d H:i:s');
			$emp_master_data['created_by'] = $logged_in_info->person_id;
		} else {
			$emp_master_data['updated_at'] = date('Y-m-d H:i:s');
			$emp_master_data['updated_by'] = $logged_in_info->person_id;
		}
		$emp_address_data = array(
			'emp_cadd' => NULL
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
			'address_1'=>$form_input['address'],
			'city'=>$form_input['city'],
			'zip'=>$form_input['zip'],
			'contact_name'=>$form_input['contact_name'],
			'contact_number'=>$form_input['contact_number'],
			'relationship'=>$form_input['relationship'],
			'country'=>$form_input['country'],
			'expired_date'=>date('Y-m-d', strtotime($form_input['expired_date'])),
			'joined_date'=>date('Y-m-d', strtotime($form_input['joined_date'])),
			'degree_level'=>$form_input['degree_level'],
			'skill'=>$form_input['skill'],
			'bank_name'=>$form_input['bank_name'],
			'bank_number'=>$form_input['bank_number'],
			'teach_major'=>$form_input['teach_major'],
			'teach_course_ids'=>$form_input['teach_course_ids'],
		);
		$redirect_code = $form_input['redirect_code'];
		$employee_data = array(
			'user_type_id'=>$form_input['user_type']
		);

		$this->load->helper('directory');
		
		$valid_languages = directory_map(APPPATH.'language/', 1);
		$employee_data = array_merge($employee_data,array('language'=>in_array($form_input['language'], $valid_languages) ? $form_input['language'] : 'english'));
		
		if($this->Employee->save($person_data,$emp_master_data,$emp_info_data,$emp_address_data,$employee_data, $professor_id)) {
				
			//Delete Image
			if($form_input['del_image'] && $professor_id != -1) {
				$employee_info = $this->Employee->get_info($professor_id);
				if($employee_info->image_id != null) {
					$this->Person->update_image(NULL,$professor_id);
					$this->Appfile->delete($employee_info->image_id);
				}
			}

		// $upload_data = $this->upload->data();
		// print_r($_FILES[]);
		// exit();
			//Save Image File
			// if(empty($_FILES["image_id"]) && $_FILES["image_id"]["error"] == UPLOAD_ERR_OK) {
				
				$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
				$extension = strtolower(pathinfo($_FILES["image_id"]["name"], PATHINFO_EXTENSION));
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
				if($professor_id==-1) {
					$this->Person->update_image($image_file_id,$employee_data['person_id']);
				} else {
					$this->Person->update_image($image_file_id,$professor_id);
				}
			// }

			// Upload CV, Document
			if (!empty($_FILES["document"])) {
				$dir = "./uploads/documents/professors/";
				$quantFiles = count($_FILES['document']['name']);
				for($i = 0; $i < $quantFiles ; $i++) {
					if ($_FILES["document"]["error"][$i] == UPLOAD_ERR_OK) {
						$file_name = $_FILES["document"]["name"][$i];
						$new_file_name = $person_data['last_name'].'_'.$person_data['first_name'].'_'.$file_name;
						$allowed_extensions = array('pdf', 'doc', 'docx');
						$extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
						if (in_array($extension, $allowed_extensions)) {
							$docs_data = array(
								'emp_docs_path' => $new_file_name,
								'emp_docs_submited_at' => date('Y-m-d H:i:s'),
								'emp_docs_emp_master_id' => $emp_master_data['master_id'],
								'created_by' => $logged_in_info->person_id
							);
							if ($this->Employee->save_document($docs_data)) {
								move_uploaded_file($_FILES["document"]["tmp_name"][$i], $dir. $new_file_name);
							}
						}
					}
				}
			}

		} else {	//failure
			echo json_encode(array('success'=>false,'message'=>lang('employees_error_adding_updating').' '.
			$person_data['first_name'].' '.$person_data['last_name'],'person_id'=>-1));
		}
		
	}	

	/*
	This deletes professors from the professors table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$profs_to_delete = $this->input->post('ids');
		
		if (in_array(1,$profs_to_delete))
		{
			//failure
			echo json_encode(array('success'=>false,'message'=>lang('professors_cannot_delete_default_user')));
		}
		elseif($this->Employee->delete_list($profs_to_delete))
		{
			echo json_encode(array('success'=>true, 'message'=>lang('professors_successful_deleted').' '.
			count($profs_to_delete).' '.lang('professors_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('professors_cannot_be_deleted')));
		}
	}
		
	/*function cleanup()
	{
		$this->Employee->cleanup();
		echo json_encode(array('success'=>true,'message'=>lang('employees_cleanup_sucessful')));
	}*/

	/*function detail($employee_id=-1)
	{
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['person_info'] = $this->Employee->get_info($employee_id);
		$data['designation_info'] = $this->Designation_model->get_info($data['person_info']->emp_master_designation_id);
		$data['category_info'] = $this->Category->get_info($data['person_info']->emp_master_category_id);
		$data['nationality_info'] = $this->Nationality->get_info($data['person_info']->emp_master_nationality_id);
		$data['address_info'] = $this->Emp_address->get_info($data['person_info']->emp_master_emp_address_id);
		$this->load->view("employees/detail",$data);
	}*/
	
}
?>