<?php
require_once ("secure_area.php");
class Room extends Secure_area 
{
	function __construct()
	{
		parent::__construct('room');
	}

	function index($offset = 0) {
		$params = $this->session->userdata('room_search_data') ? $this->session->userdata('room_search_data') : array('offset' => 0, 'order_col' => 'room_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('room/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('room/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Rooms->search_count_all($data['search']);
			$table_data = $this->Rooms->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Rooms->count_all();
			$table_data = $this->Rooms->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_room_manage_table($table_data,$this);
		
		$this->load->view('room/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'room_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$room_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("room_search_data",$room_search_data);

		if ($search) {
			$config['total_rows'] = $this->Rooms->search_count_all($search);
			$table_data = $this->Rooms->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'room_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Rooms->count_all();
			$table_data = $this->Rooms->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'room_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('room/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_room_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'room_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$room_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("room_search_data",$room_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Rooms->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('room/search');
		$config['total_rows'] = $this->Rooms->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Rooms->search_count_all($search);
		$data['manage_table']= get_room_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Inserts/updates an room
	*/
	function save($room_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$room_data = array(
			'room_name'=>$this->input->post('room_name'),
			'room_note'=>$this->input->post('room_note')
		);

		if ($room_id != -1) {
			$room_data['updated_by'] = $logged_in_employee_id;
			$room_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$room_data['created_by'] = $logged_in_employee_id;
			$room_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Rooms->save($room_data, $room_id)) {			
			//New room
			if($room_id==-1) {
				$message = lang('room_successful_adding').' '.$room_data['room_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'room_id'=>$room_data['room_id']));
			} else { //previous room
				$message = lang('room_successful_updating').' '.$room_data['room_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'room_id'=>$room_id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('room_error_adding_updating').' '.
			$room_data['room_name'],'room_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Rooms->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($room_id = -1) {

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['room_info'] = $this->Rooms->get_info($room_id);
		$this->load->view('room/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Rooms->check_duplicate($this->input->post('term'))));
	}

	function room_exists()
	{
		if($this->Rooms->room_exists($this->input->post('room_name')))
			echo 'false';
		else
			echo 'true';
	}

	/*
	This deletes room from the room table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$room_to_delete=$this->input->post('ids');
		
		if ($this->Rooms->delete_list($room_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('room_successful_deleted').' '.
			count($room_to_delete).' '.lang('room_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('room_cannot_be_deleted')));
		}
	}

	function detail($room_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['room_info'] = $this->Rooms->get_detail($room_id);
		$this->load->view('room/detail',$data);
	}

	function delete_by_id($room_id=-1) {
		$this->check_action_permission('delete');
		if ($room_id && $this->Rooms->delete($room_id)) {
			echo json_encode(array('success'=>true, 'message'=>lang('room_successful_deleted'), 'room_id'=>$room_id));
		} else {
			echo json_encode(array('success'=>false, 'message'=>lang('room_error_delete'), 'room_id'=>$room_id));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('room_search_data');
		redirect('room');
	}

}