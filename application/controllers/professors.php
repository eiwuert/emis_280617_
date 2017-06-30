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
		$this->check_action_permission('search');
		$params = $this->session->userdata('professor_search_data')? $this->session->userdata('professor_search_data')
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
		$config['base_url'] = site_url('professors/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page')? (int)$this->config->item('number_of_items_per_page'): 20;
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
		$per_page = $this->config->item('number_of_items_per_page')? (int)$this->config->item('number_of_items_per_page'): 20;
		$search_data = $this->Professor->search(
						$search,
						$per_page,
						$offset,
						$order_col,
						$order_dir);
		$config['base_url'] = site_url('professors/search');
		$config['total_rows'] = $this->Professor->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_people_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));	
	}
	/* Gives search suggestions based on what is being searched for*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Professor->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}
	function view_file($professor_id){		
		$data['controller_name']=strtolower(get_class());
		$this->check_action_permission('view');
		$q_docs = $this->Professor->get_softfile($professor_id);		
		$load_fun = 'professor';
		$data['manage_table'] = get_docs_manage_table($q_docs, $this, $load_fun);
		$this->load->view("professors/view_softfile",$data);
	}
	
	/*Loads the professor edit form*/
	function view($professor_id = -1, $redirect_code = 0)
	{
		$this->check_action_permission('add_update');
		$data['person_info'] = $this->Professor->get_info($professor_id);
		$data['profile'] = $this->Employee->check_prof($data['person_info']->image_id);
		$data['logged_in_employee_id'] = $this->Employee->get_logged_in_employee_info()->person_id;
		$data['all_modules'] = $this->Module->get_all_modules();
		$data['controller_name'] = strtolower(get_class());
		$data['redirect_code']=$redirect_code;
		$data['titles'] = $this->opt_titles2();
		$data['emp_maritalstatus'] = $this->opt_emp_maritalstatus();
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

		if ($professor_id == -1) {
			$data['emp_unique_id'] = $this->last_running_number();
		}

		$get_edit_major = $this->Professor->get_info_edit_major($professor_id)->result();
		$e_major = array();
		foreach($get_edit_major as $key => $row){
			$e_major[] = $row->major_id;
		} 
		$data['edit_major'] = $e_major;

		$skills = $this->Student->get_all_skills($data['person_info']->emp_master_department_id);
		$skills_temp = [];
		foreach($skills as $key => $skill) {
			$skills_temp[$skill->skill_id] =  $skill->skill_name.' ('.$skill->skill_name_kh.')';
		}
		$data['major'] = $skills_temp;

		$data['courses'] = $this->opt_courses();
		$data['province'] = $this->opt_province();
		$data['subject'] = $this->opt_subject();	
		$data['degree'] = $this->opt_degrees();
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
		$get_info_professors = $this->Employee->get_info_prof($professor_id);
		$form_input = $this->input->post();
		$majors = $this->input->post('majors');
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
			'home_no'=>$form_input['home_no'],
			'street_no'=>$form_input['street_no'],
			'district'=>$form_input['district'],
			'commune'=>$form_input['commune'],
			'province'=>$form_input['province'],
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
			'as_employee_id'=>$form_input['as_employee_id'],
			'department_type'=>$form_input['department_type']
		);	
		$redirect_code = $form_input['redirect_code'];
		$employee_data = array(
			'user_type_id'=>$form_input['user_type']
		);
		$this->load->helper('directory');
		$valid_languages = directory_map(APPPATH.'language/', 1);
		$employee_data = array_merge($employee_data,array('language'=>in_array($form_input['language'], $valid_languages) ? $form_input['language'] : 'english'));
		if($this->Employee->save($person_data,$emp_master_data,$emp_info_data,$emp_address_data,$employee_data, $professor_id, $majors)) {
			//New employee
			if($professor_id==-1) {
				$success_message = lang('employees_successful_adding').' '.$person_data['first_name'].' '.$person_data['last_name'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'person_id'=>$employee_data['person_id'],'redirect_code'=>$redirect_code));
			} else { //previous employee
				$success_message = lang('employees_successful_updating').' '.$person_data['first_name'].' '.$person_data['last_name'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'person_id'=>$professor_id,'redirect_code'=>$redirect_code));
			}
			//Delete Image
			if($form_input['del_image'] && $professor_id != -1) {
				$employee_info = $this->Employee->get_info($professor_id);
				if($employee_info->image_id != null) {
					$this->Person->update_image(NULL,$professor_id);
					$this->Appfile->delete($employee_info->image_id);
				}
			}
			//Save Image File
			if(!empty($_FILES["image_id"]) && $_FILES["image_id"]["error"] == UPLOAD_ERR_OK) {

				$new_file_name = $employee_data['person_id'].'_'.$_FILES["image_id"]["name"];
				$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
				$extension = strtolower(pathinfo($_FILES["image_id"]["name"], PATHINFO_EXTENSION));
				$dir = './assets/professor/'; 
				if (in_array($extension, $allowed_extensions)) {
					$config['image_library'] = 'gd2';
					$config['source_image'] = $_FILES["image_id"]["tmp_name"];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 400;
					$config['height'] = 300;
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$ch = $this->Employee->check_prof($get_info_professors->image_id);
					if(!empty($ch)){
						unlink("./assets/professor/$ch");
					}
					$image_file_id = $this->Appfile->save($_FILES["image_id"]["name"], file_get_contents($_FILES["image_id"]["tmp_name"]));
				}
				if($professor_id==-1) {
					$this->Person->update_image($image_file_id,$employee_data['person_id']);
					move_uploaded_file($_FILES["image_id"]["tmp_name"], $dir.$_FILES["image_id"]["name"]);
				} else {
					$this->Person->update_image($image_file_id,$professor_id);
					move_uploaded_file($_FILES["image_id"]["tmp_name"], $dir.$_FILES["image_id"]["name"]);
				}
			}
			// Upload CV, Document
			if (!empty($_FILES["filename"])) {
				$dir = './assets/professor/';
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
								'emp_docs_emp_master_id' => (($professor_id !== -1)? $get_info_professors->emp_master_id : $emp_master_data['master_id']),
								'created_by' => $logged_in_info->person_id
							);
							if ($this->Employee->save_document($docs_data)) {
								move_uploaded_file($_FILES["filename"]["tmp_name"][$i], $dir. $new_file_name);
							}
						}
					}
				}
			}

		} else {
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
	
	function delete_soft_file()
	{
		$controller_name=strtolower(get_class());
		$this->check_action_permission('delete');
		$del_softfile = $this->input->post('ids');	
		$load_fun = 'professor';
		if($this->Employee->del_softfiles($del_softfile,$load_fun))
		{
			echo json_encode(array('success'=>true,'message'=>lang($controller_name.'_successful_deleted').' '.
			count($del_softfile).' '.lang($controller_name.'_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>$pp));
		}
	}

	function suggestion_major(){
		$id = $_POST['id'];
		$query = array();
		$query = $this->Major_model->get_skill_by_faculty($id)->result();
		echo json_encode($query);
	}
}
?>