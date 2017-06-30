<?php
require_once ("secure_area.php");
class Workshops extends Secure_area 
{
	function __construct()
	{
		parent::__construct('workshops');
	}

	function index() {	
		$data['controller_name']=strtolower(get_class());
		$params = $this->session->userdata('workshops') ? $this->session->userdata('workshops') : array('offset' => 0, 'order_col' => 'id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('workshops/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('workshops/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Workshop->search_count_all($data['search']);
			$table_data = $this->Workshop->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Workshop->count_all();
			$table_data = $this->Workshop->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_workshop_manage_table($table_data,$this);
		$this->load->view('workshops/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$workshops = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("workshops",$workshops);

		if ($search) {
			$config['total_rows'] = $this->Workshop->search_count_all($search);
			$table_data = $this->Workshop->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Workshop->count_all();
			$table_data = $this->Workshop->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('workshops/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_workshop_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$workshops = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("workshops",$workshops);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Workshop->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('workshops/search');
		$config['total_rows'] = $this->Workshop->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Workshop->search_count_all($search);
		$data['manage_table']= get_workshop_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function suggest(){
		session_write_close();
		$suggestions = $this->Workshop->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function view($id) {
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['workshop_info'] = $this->Workshop->get_all_byid($id)->row();
		$this->load->view('workshops/form',$data);
	}
	function save($id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$data = array('workshop_title' => $this->input->post('title'),
						'workshop_venue' => $this->input->post('venue'),
						'workshop_date_from' => date_format(date_create($this->input->post('date_from')),"Y-m-d"),
						'workshop_date_to' => date_format(date_create($this->input->post('date_to')),"Y-m-d"),
						'workshop_orgainized' => $this->input->post('orgainized'),
						'workshop_female_participants' => $this->input->post('female_participants'),
						'workshop_total' => $this->input->post('workshop_total'));
		if ($id != -1) {
			$data['updated_by'] = $logged_in_employee_id;
			$data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$data['created_by'] = $logged_in_employee_id;
			$data['created_at'] = date('Y-m-d H:i:s');
		}
		if($this->Workshop->save($data, $id)) {	
			//New subject
			if($id==-1) {
				$message = lang('suppliers_successful_adding').' '.$data['workshop_title'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$data['id']));
			} else {
				$message = lang('suppliers_successful_updating').' '.$data['workshop_title'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('suppliers_error_adding_updating').' '.
			$data['workshop_title'],'id'=>-1));
		}
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$id=$this->input->post('ids');
		
		if ($this->Workshop->delete($id))
		{
			echo json_encode(array('success'=>true,'message'=>lang('workshop_successful_deleted')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('workshop_cannot_be_deleted')));
	}
	}
	function clear_state()
	{
		$this->session->unset_userdata('workshops');
		redirect('workshops');
	}
}