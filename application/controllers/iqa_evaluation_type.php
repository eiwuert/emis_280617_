<?php
require_once ("secure_area.php");
class Iqa_evaluation_type extends Secure_area 
{
	function __construct()
	{
		parent::__construct('iqa_evaluation_type');
	}

	function index($offset = 0)
	{
		$params = $this->session->userdata('iqa_type_search_data') ? $this->session->userdata('iqa_type_search_data') : array('offset' => 0, 'order_col' => 'name_eng', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset != $params['offset']) {
			redirect('iqa_evaluation_type/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('iqa_evaluation_type/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name'] = strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Iqa_model->search_count_all($data['search']);
			$table_data = $this->Iqa_model->search($data['search'], $data['per_page'], $params['offset'], $params['order_col'], $params['order_dir']);
		} else {
			$config['total_rows'] = $this->Iqa_model->count_all();
			$table_data = $this->Iqa_model->get_all($data['per_page'], $params['offset'], $params['order_col'], $params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_iqa_manage_table($table_data, $this);

		$this->load->view('iqa/iqa_evaluation_type/manage',$data);
	}
	function view($id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['iqa_info'] = $this->Iqa_model->get_info($id);
		$data['iqa_titles'] = $this->Iqa_model->get_titles($data['iqa_info']->id);

		$this->load->view('iqa/iqa_evaluation_type/view', $data);
	}
	function display() {
		$data['controller_name']=strtolower(get_class());

		$this->load->view('iqa/iqa_evaluation_type/display',$data);
	}

	function save($id = -1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$form_data = $this->input->post();
		$iqa_data = [
			'name_eng' => $form_data['iqa_name'],
			'name_kh' => $form_data['iqa_name_kh'],
			'date' => date('Y-m-d', strtotime($form_data['date'])),
			'year' => $form_data['year']
		];
		if ($id != -1) {
			$iqa_data['updated_by'] = $logged_in_employee_id;
			$iqa_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$iqa_data['created_by'] = $logged_in_employee_id;
			$iqa_data['created_at'] = date('Y-m-d H:i:s');
		}
		$iqa_titles = [
			'ids' => $form_data['title_ids'],
			'title_eng' => $form_data['evaluation_title'],
			'title_kh' => $form_data['evaluation_title_kh']
		];

		if($this->Iqa_model->save($iqa_data, $iqa_titles, $id)) {
			//New IQA
			if($id == -1) {
				$message = lang('iqa_successful_adding').' '.$iqa_data['name_eng'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$iqa_data['id']));
			} else { //previous IQA
				$message = lang('iqa_successful_updating').' '.$iqa_data['name_eng'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('iqa_error_adding_updating').' '.
			$iqa_data['name_eng'],'id'=>-1));
		}
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'name_eng';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$iqa_type_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("iqa_type_search_data", $iqa_type_search_data);

		if ($search) {
			$config['total_rows'] = $this->Iqa_model->search_count_all($search);
			$table_data = $this->Iqa_model->search($search, $per_page, $offset, $order_col, $order_dir);
		} else {
			$config['total_rows'] = $this->Iqa_model->count_all();
			$table_data = $this->Iqa_model->get_all($per_page, $offset, $order_col, $order_dir);
		}
		$config['base_url'] = site_url('iqa_evaluation_type/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_iqa_manage_table_data_rows($table_data, $this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'name_eng';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$iqa_type_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("iqa_type_search_data", $iqa_type_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Iqa_model->search($search, $per_page, $offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('iqa_evaluation_type/search');
		$config['total_rows'] = $this->Iqa_model->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Iqa_model->search_count_all($search);
		$data['manage_table'] = get_iqa_manage_table_data_rows($search_data, $this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Iqa_model->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	/*
	This deletes record
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$ids_to_delete = $this->input->post('ids');

		if ($this->Iqa_model->delete_list($ids_to_delete)) {
			echo json_encode(array('success'=>true, 'message'=>lang('iqa_successful_deleted').' '.
			count($ids_to_delete).' '.lang('iqa_one_or_multiple')));
		} else {
			echo json_encode(array('success'=>false, 'message'=>lang('iqa_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('iqa_type_search_data');
		redirect('iqa_evaluation_type');
	}

}