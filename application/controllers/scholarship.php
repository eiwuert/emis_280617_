<?php
require_once ("secure_area.php");
class Scholarship extends Secure_area 
{
	function __construct()
	{
		parent::__construct('scholarship');
	}

	function index($offset = 0)
	{
		$params = $this->session->userdata('scho_search_data') ? $this->session->userdata('scho_search_data') : array('offset' => 0, 'order_col' => 'scho_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('scholarship/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('scholarship/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Scholarships->search_count_all($data['search']);
			$table_data = $this->Scholarships->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Scholarships->count_all();
			$table_data = $this->Scholarships->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_scholarships_manage_table($table_data,$this);
		$this->load->view('scholarship/manage_scholarship',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'scho_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$scho_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("scho_search_data",$scho_search_data);

		if ($search) {
			$config['total_rows'] = $this->Scholarships->search_count_all($search);
			$table_data = $this->Scholarships->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'scho_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Scholarships->count_all();
			$table_data = $this->Scholarships->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'scho_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('scholarship/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_scholarships_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'scho_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$scho_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("scho_search_data",$scho_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Scholarships->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('scholarship/search');
		$config['total_rows'] = $this->Scholarships->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Scholarships->search_count_all($search);
		$data['manage_table']= get_scholarships_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Scholarships->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($id=-1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['info'] = $this->Scholarships->get_info($id);
		$levels = $this->Student->get_all_levels();
		$levels_temp = [];
		foreach($levels as $key => $level) {
			$levels_temp[$level->level_id] =  $level->level_name;
		}
		$data['degree'] = $levels_temp;
		$skills = $this->Student->get_all_skills();
		$skills_temp = [];
		foreach($skills as $key => $skill) {
			$skills_temp[$skill->skill_id] =  $skill->skill_name.' ('.$skill->skill_name_kh.')';
		}
		$data['major'] = $skills_temp;

		$this->load->view('scholarship/form_scholarship',$data);
	}

	function view($id = -1)
	{
		$this->check_action_permission('search');
		$data['controller_name']=strtolower(get_class());
		$data['info'] = $this->Scholarships->get_info($id);
		$this->load->view('scholarship/view_scholarship',$data);
	}

	function save($id = -1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$forms = $this->input->post();
		$scho_data = array(
			'scholarship_from' => $forms['scholarship_from'],
			'degree' => $forms['hide_degree'],
			'major' => $forms['hide_major'],
			'scholarship_from_kh' => $forms['scholarship_from_kh'],
			'started_date' => date('Y-m-d', strtotime($forms['started_date'])),
		);

		if ($id != -1) {
			$scho_data['updated_by'] = $logged_in_employee_id;
			$scho_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$scho_data['created_by'] = $logged_in_employee_id;
			$scho_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Scholarships->save($scho_data, $id)) {
			//New scholarship
			if($id==-1) {
				$message = lang('scholarship_successful_adding').' '.$scho_data['scholarship_from'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$scho_data['id']));
			} else { //previous scholarship
				$message = lang('scholarship_successful_updating').' '.$scho_data['scholarship_from'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('scholarship_error_adding_updating').' '.
			$scho_data['scholarship_from'],'id'=>-1));
		}
	}

	/*
	This deletes record
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$scho_to_delete = $this->input->post('ids');

		if ($this->Scholarships->delete_list($scho_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('scholarship_successful_deleted').' '.
			count($scho_to_delete).' '.lang('scholarship_one_or_multiple')));
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('scholarship_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('scho_search_data');
		redirect('scholarship');
	}

}