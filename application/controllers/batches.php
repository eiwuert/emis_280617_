<?php
require_once ("secure_area.php");
class Batches extends Secure_area 
{
	function __construct()
	{
		parent::__construct('batches');
	}

	function index() {
		$params = $this->session->userdata('batch_search_data') ? $this->session->userdata('batch_search_data') : array('offset' => 0, 'order_col' => 'batch_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('batch/index/'.$params['offset']);
		}		
		$this->check_action_permission('search');
		$config['base_url'] = site_url('batch/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search']) {
			$config['total_rows'] = $this->Batch->search_count_all($data['search']);
			$table_data = $this->Batch->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Batch->count_all();
			$table_data = $this->Batch->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_batch_manage_table($table_data,$this);

		$this->load->view('faculty/batches/manage',$data);
	}
	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Batch->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'batch_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$batch_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("batch_search_data",$batch_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Batch->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('batches/search');
		$config['total_rows'] = $this->Batch->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Batch->search_count_all($search);
		$data['manage_table']= get_batch_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'batch_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$school_class_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("batch_search_data",$school_class_search_data);

		if ($search) {
			$config['total_rows'] = $this->Batch->search_count_all($search);
			$table_data = $this->Batch->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'batch_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Batch->count_all();
			$table_data = $this->Batch->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'batch_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('batches/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_batch_manage_table($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function clear_state()
	{
		$this->session->unset_userdata('batch_search_data');
		redirect('batches');
	}

	function form($batch_id = -1) {

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['batch_info'] = $this->Batch->get_info($batch_id);

		$universities = $this->Batch->suggest_faculty()->result();
		$universities_temp = ["" => ' -- -- '];
		foreach($universities as $key => $university) {
			$universities_temp[$university->university_id] =  $university->university_name;
		}
		$data['faculty'] = $universities_temp;

		$skills = $this->Batch->get_all_major();
		$skills_temp = ["" => ' -- -- '];
		foreach($skills as $key => $skill) {
			$skills_temp[$skill->skill_id] =  $skill->skill_name.' ('.$skill->skill_name_kh.')';
		}
		$data['major'] = $skills_temp;

		$this->load->view('faculty/batches/form',$data);
	}

	function batch_exists()
	{
		if($this->Batch->batch_exists($this->input->post('batch_name')))
			echo 'false';
		else
			echo 'true';
	}
	function suggest_faculty(){
		$major_id = $this->input->post('major_id');	
		$query = array();
        $query = $this->Batch->suggest_faculty($major_id)->result();
        echo json_encode($query);
	}

	function save($batch_id = -1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$batch_data = array(
			'batch_name'=>$this->input->post('batch_name'),
			'batch_major'=>$this->input->post('batch_major'),
			'batch_faculty'=>$this->input->post('batch_faculty'),
			'start_date'=>date_format(date_create($this->input->post('batch_start_date')),"Y-m-d"),
			'end_date'=>date_format(date_create($this->input->post('batch_end_date')),"Y-m-d"),
			'batch_number'=>$this->input->post('batch_number')
		);
		
		if ($batch_id != -1) {
			$batch_data['updated_by'] = $logged_in_employee_id;
			$batch_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$batch_data['created_by'] = $logged_in_employee_id;
			$batch_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Batch->save($batch_data, $batch_id)) {
			//New batch
			if($batch_id==-1) {
				$message = lang('batch_successful_adding').' '.$batch_data['batch_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'batch_id'=>$batch_data['batch_id']));
			} else { //previous batch
				$message = lang('batch_successful_updating').' '.$batch_data['batch_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'batch_id'=>$batch_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('batch_error_adding_updating').' '.
			$batch_data['batch_name'],'batch_id'=>-1));
		}
	} 

	/*
	This deletes subject from the subject table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$batch_to_delete = $this->input->post('ids');
		
		if ($this->Batch->delete_list($batch_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('batch_successful_deleted').' '.
			count($batch_to_delete).' '.lang('subject_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('batch_cannot_be_deleted')));
		}
	}

}