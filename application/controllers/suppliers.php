<?php
require_once ("secure_area.php");
class Suppliers extends Secure_area 
{
	function __construct()
	{
		parent::__construct('suppliers');
	}

	function index() {
		$params = $this->session->userdata('supplier_search_data') ? $this->session->userdata('supplier_search_data') : array('offset' => 0, 'order_col' => 'id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('supplier/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('supplier/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Supplier->search_count_all($data['search']);
			$table_data = $this->Supplier->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Supplier->count_all();
			$table_data = $this->Supplier->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_supplier_manage_table($table_data,$this);
		$this->load->view('items/supplier/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$supplier_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("supplier_search_data",$supplier_search_data);

		if ($search) {
			$config['total_rows'] = $this->Supplier->search_count_all($search);
			$table_data = $this->Supplier->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Supplier->count_all();
			$table_data = $this->Supplier->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('suppliers/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_supplier_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$supplier_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("supplier_search_data",$supplier_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Supplier->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('suppliers/search');
		$config['total_rows'] = $this->Supplier->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Supplier->search_count_all($search);
		$data['manage_table']= get_supplier_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function save($id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$data = array('company_name' => $this->input->post('company_name'),
							'last_name' => $this->input->post('last_name'),
							'first_name' => $this->input->post('first_name'),
							'phone_number' => $this->input->post('phone_number'),
							'email' => $this->input->post('email'));
		if ($id != -1) {
			$data['updated_by'] = $logged_in_employee_id;
			$data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$data['created_by'] = $logged_in_employee_id;
			$data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Supplier->save($data, $id)) {	
			//New subject
			if($id==-1) {
				$message = lang('suppliers_successful_adding').' '.$data['company_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$data['id']));

			} else {
				$message = lang('suppliers_successful_updating').' '.$data['company_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('suppliers_error_adding_updating').' '.
			$data['company_name'],'id'=>-1));
		}
	}
	function suggest(){
		session_write_close();
		$suggestions = $this->Supplier->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$supplier_id=$this->input->post('ids');
		
		if ($this->Supplier->delete($supplier_id))
		{
			echo json_encode(array('success'=>true,'message'=>lang('subject_successful_deleted')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('subject_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('supplier_search_data');
		redirect('suppliers');
	}

	function view($sub_id) {
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['supplier_info'] = $this->Supplier->get_info($sub_id);
		$this->load->view('items/supplier/form',$data);
	}
}