<?php
require_once ("secure_area.php");
class Fees_school extends Secure_area 
{
	function __construct()
	{
		parent::__construct('fees_school');
	}

	function index($offset = 0)
	{
		$params = $this->session->userdata('fees_search_data') ? $this->session->userdata('fees_search_data') : array('offset' => 0, 'order_col' => 'fees_collect_name', 'order_dir' => 'asc', 'search' => FALSE);
		if ($offset != $params['offset']) {
			redirect('fees_school/index/'.$params['offset']);
		}

		$this->check_action_permission('search');
		$config['base_url'] = site_url('fees_school/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20; 
		$data['controller_name'] = strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search']) {
			$config['total_rows'] = $this->Fees->search_count_all($data['search']);
			$table_data = $this->Fees->search($data['search'], $data['per_page'], $params['offset'], $params['order_col'], $params['order_dir']);
		} else {
			$config['total_rows'] = $this->Fees->count_all();
			$table_data = $this->Fees->get_all($data['per_page'], $params['offset'], $params['order_col'], $params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_fees_manage_table($table_data,$this);

		$this->load->view('faculty/other_fee/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search') ? $this->input->post('search') : "";
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'fees_collect_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$fees_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("fees_search_data", $fees_search_data);
		if ($search) {
			$config['total_rows'] = $this->Fees->search_count_all($search);
			$table_data = $this->Fees->search($search, $per_page, $offset, $order_col, $order_dir);
		} else {
			$config['total_rows'] = $this->Fees->count_all();
			$table_data = $this->Fees->get_all($per_page, $offset, $order_col, $order_dir);
		}
		$config['base_url'] = site_url('fees_school/sorting');
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_fees_manage_table_data_rows($table_data, $this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'fees_collect_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$fees_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("fees_search_data",$fees_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Fees->search($search, $per_page, $offset, $order_col, $order_dir);
		$config['base_url'] = site_url('fees_school/search');
		$config['total_rows'] = $this->Fees->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_fees_manage_table_data_rows($search_data, $this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Fees->get_search_suggestions($this->input->get('term'), 100);
		echo json_encode($suggestions);
	}

	function clear_state()
	{
		$this->session->unset_userdata('fees_search_data');
		redirect('fees_school');
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$ids_to_delete = $this->input->post('ids');
		$total_rows = count($ids_to_delete);
		if($this->Fees->delete_list($ids_to_delete)) {
			echo json_encode(array('success'=>true,'message'=>lang('common_successful_deleted').' '.
			$total_rows.' '.lang('fees_one_or_multiple')));
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('fees_cannot_be_deleted')));
		}
	}

	function form($fee_id = -1)
	{
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['fees_info'] = $this->Fees->get_info($fee_id);
		$fees_scholarship_id = $this->Fees->get_scholarship_fee($fee_id);
		$arr_fee_scho_id = array();
		foreach($fees_scholarship_id as $key=>$val){
			$arr_fee_scho_id[] = $val->fees_scho_id;
		}
		$data['view_scholarship'] = $arr_fee_scho_id;
		$data['levels'] = $this->opt_degrees();
		$data['skills'] = $this->opt_selection_major();
		$data['section'] = $this->opt_section();
		$data['scholarships'] = $this->opt_scholarship();
		$this->load->view('faculty/other_fee/form',$data);
	}

	function save($fee_id = -1)
	{
		$this->check_action_permission('add_update');
		$datas = $this->input->post();
		$scholarship_id = $this->input->post('scholarships');
		// Unset input post which not insert into DB
		unset($datas['scholarships']);
		unset($datas['submit']);
		$logged_in_employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		if ($fee_id != -1) {
			$datas['updated_by'] = $logged_in_employee_id;
			$datas['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$datas['created_by'] = $logged_in_employee_id;
			$datas['created_at'] = date('Y-m-d H:i:s');
		}

		$redirect = $this->input->post('redirect');	

		if ($this->Fees->save($datas, $fee_id, $scholarship_id)) {	
			if ($fee_id==-1) {
				$success_message = lang('fees_successful_adding').' '.$datas['fees_collect_name'];
				echo json_encode(array('success' => true, 'message' => $success_message, 'fee_id' => $datas['fee_id'], 'redirect' => $redirect));
			} else {
				$success_message = lang('fees_successful_updating').' '.$datas['fees_collect_name'];
				echo json_encode(array('success' => true, 'message' => $success_message, 'fee_id' => $fee_id, 'redirect' => $redirect));
			}
		} else {
			echo json_encode(array('success' => false, 'message' => lang('fees_error_adding_updating').' '.
			$datas['fees_collect_name'], 'fee_id' => -1));
		}
	}

	function view($fee_id = -1){
		$this->check_action_permission('search');
		$data['controller_name'] = strtolower(get_class());
		$data['fees_info'] = $this->Fees->get_info($fee_id);
		$fees_scholarship_id = $this->Fees->get_scholarship_fee($fee_id);
		$arr_fee_scho_id = array();
		foreach($fees_scholarship_id as $key=>$val){
			$arr_fee_scho_id[] = $val->fees_scho_id;
		}
		$data['scholarships'] = $this->Scholarships->get_list_scholarship($arr_fee_scho_id);
		$this->load->view('faculty/other_fee/view',$data);
	}

	


}