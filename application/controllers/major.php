<?php
require_once ("secure_area.php");
class Major extends Secure_area 
{
	function __construct()
	{
		parent::__construct('major');
	}

	function index($offset = 0)
	{
		$params = $this->session->userdata('major_search_data') ? $this->session->userdata('major_search_data'): array(
					'offset' => 0,
					'order_col' => 'skill_id',
					'order_dir' => 'asc',
					'search' => FALSE
				);
		if ($offset!=$params['offset'])
		{
			redirect('major/index/'.$params['offset']);
		}

		$this->check_action_permission('search');
		$config['base_url'] = site_url('major/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search']) {
			$config['total_rows'] = $this->Major_model->search_count_all($data['search']);
			$table_data = $this->Major_model->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);

		} else {
			$config['total_rows'] = $this->Major_model->count_all();
			$table_data = $this->Major_model->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_major_manage_table($table_data,$this);

		$this->load->view('faculty/major/manage',$data);
	}

	function view($skill_id = -1)
	{
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['major_info'] = $this->Major_model->get_info($skill_id);
		$data['faculty'] = $this->opt_selection_faculty();
		$levels = $this->Student->get_all_levels();
		$data['levels'] = $this->opt_degrees();
		$data['major_coordinator'] = $this->opt_professor();		
		$this->load->view('faculty/major/form',$data);
	}

	function save($major_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$form_input = $this->input->post();

		$major_data = array('skill_name' => $form_input['major_name'],
							'skill_name_kh' => $form_input['major_name_kh'],
							'skill_major_code' => $form_input['major_code'],
							'skill_short_word' => $form_input['major_short_word'],
							'faculty_id' => $form_input['faculty'],
							'degree_id' => $form_input['levels'],
							'duration' => $form_input['duration'],
							'coordinator_id' => $form_input['major_coordinator'],
							'skill_academic_year' => $form_input['academic_year'],
							 );

		if ($major_id != -1) {
			$major_data['updated_by'] = $logged_in_info->person_id;
			$major_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$major_data['created_by'] = $logged_in_info->person_id;
			$major_data['created_at'] = date('Y-m-d H:i:s');
		}
		if($this->Major_model->save($major_data, $major_id)) {
			//New major
			if($major_id==-1) {
				$message = 'major_successful_updating'.' '.$skill_name['major_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'skill_id'=>$major_data['skill_id']));
			} else { //previous skill/major
				$message = 'major_successful_updating'.' '.$skill_name['major_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'skill_id'=>$major_id));
			}
		} else {
			echo json_encode(array('success'=>false,'message'=>'major_error_adding_updating'.' '.
			$major_data['major_name'],'major_id'=>-1));
		}
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'skill_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$major_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("major_search_data",$major_search_data);
		
		if ($search) {
			$config['total_rows'] = $this->Major_model->search_count_all($search);
			$table_data = $this->Major_model->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'skill_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		} else {
			$config['total_rows'] = $this->Major_model->count_all();
			$table_data = $this->Major_model->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_status_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		}
		$config['base_url'] = site_url('major/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_major_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Returns major table data rows. This will be called with AJAX.
	*/
	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');	
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'skill_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$major_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("major_search_data",$major_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Major_model->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('major/search');
		$config['total_rows'] = $this->Major_model->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Major_model->search_count_all($search);
		$data['manage_table']= get_major_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Major_model->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	/*
	This deletes student status from the stu_status table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$ids_to_delete=$this->input->post('ids');
		$total_rows= count($ids_to_delete);
		if($this->Major_model->delete_list($ids_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('major_successful_deleted').' '.
			$total_rows.' '.lang('university_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('major_cannot_be_deleted')));
		}		
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Major_model->check_duplicate($this->input->post('term'))));
	}

	function skill_exists()
	{
		if($this->Major_model->exists($this->input->post('skill_id')))
		echo 'false';
		else
		echo 'true';
	}

	function clear_state()
	{
		$this->session->unset_userdata('major_search_data');
		redirect('major');
	}

	function get_degree_info()
	{
		echo json_encode(array(
			'degree_info' => $this->Levels->get_info($this->input->post('degree_id'))
		));
	}

}