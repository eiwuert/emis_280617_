<?php
require_once ("secure_area.php");
class User_permission extends Secure_area
{
	function __construct()
	{
		parent::__construct('user_permission');
	}

	function index()
	{
		$params = $this->session->userdata('permission_search_data') ? $this->session->userdata('permission_search_data') : array('offset' => 0, 'order_col' => 'id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
		   redirect('user_permission/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('user_permission/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Permissions->search_count_all($data['search']);
			$table_data = $this->Permissions->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Permissions->count_all();
			$table_data = $this->Permissions->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table']=get_people_permission_manage_table($table_data,$this);
		$this->load->view('user_permission/manage', $data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$permission_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("permission_search_data",$permission_search_data);
		if ($search) {
			$config['total_rows'] = $this->Permissions->search_count_all($search);
			$table_data = $this->Permissions->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		} else {
			$config['total_rows'] = $this->Permissions->count_all();
			$table_data = $this->Permissions->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		}
		$config['base_url'] = site_url('user_permission/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_people_permission_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Returns employee permission table data rows. This will be called with AJAX.
	*/
	function search()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$permission_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("permission_search_data",$permission_search_data);
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data=$this->Permissions->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'last_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		$config['base_url'] = site_url('user_permission/search');
		$config['total_rows'] = $this->Permissions->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_people_permission_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function view($employee_id=-1,$redirect_code=0)
	{
		$this->check_action_permission('add_update');
		$data['person_info']=$this->Employee->get_info($employee_id);
		$data['logged_in_employee_id'] = $this->Employee->get_logged_in_employee_info()->person_id;
		$data['all_modules']=$this->Module->get_all_modules();
		$data['controller_name']=strtolower(get_class());
		$data['locations']=$locations;
		$data['redirect_code']=$redirect_code;
		$data['user_types'] = $this->Employee->get_all_user_type();

		$this->load->view("user_permission/form", $data);
	}

	function save($employee_id=-1)
	{
		$this->check_action_permission('add_update');
		$form_input = $this->input->post();
		$permission_data = $form_input["permissions"]!=false ? $form_input["permissions"]:array();
		$permission_action_data = $form_input['permissions_actions']!=false ? $form_input['permissions_actions']:array();
		$redirect_code=$form_input['redirect_code'];
		//Password has been changed OR first time password set
		if($form_input['password']!=''){
			$employee_data=array(
				'username'=>$form_input['username'],
				'user_type_id'=>$form_input['user_type'],
				'password'=>md5($form_input['password'])
			);
			$employee_location_data=array(
				'employee_id'=>$employee_id,
				'location_id'=>1
			);
		} else { //Password not changed
			$employee_data=array(
				'username'=>$form_input['username'],
				'user_type_id'=>$form_input['user_type']
			);
		}

		$this->load->helper('directory');
		$valid_languages = directory_map(APPPATH.'language/', 1);
		$employee_data=array_merge($employee_data,array('language'=>in_array($form_input['language'], $valid_languages) ? $form_input['language'] : 'english'));

		if($this->Permissions->save($employee_data,$permission_data, $permission_action_data, $employee_id, $employee_location_data)) {
			//New employee
			if($employee_id==-1) {
				$success_message = lang('employees_successful_adding').' '.$person_data['first_name'].' '.$person_data['last_name'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'person_id'=>$employee_data['person_id'],'redirect_code'=>$redirect_code));
			} else { //previous employee
				$success_message = lang('employees_successful_updating').' '.$person_data['first_name'].' '.$person_data['last_name'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'person_id'=>$employee_id,'redirect_code'=>$redirect_code));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('employees_error_adding_updating').' '.
			$person_data['first_name'].' '.$person_data['last_name'],'person_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Employee->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function clear_state()
	{
		$this->session->unset_userdata('permission_search_data');
		redirect('user_permission');
	}

}