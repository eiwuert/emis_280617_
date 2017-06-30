<?php
require_once ("secure_area.php");
class Degree_management extends Secure_area 
{
	function __construct()
	{
		parent::__construct('degree_management');
	}

	function index($offset=0) {
		$params = $this->session->userdata('degree_search_data') ? $this->session->userdata('degree_search_data') : array('offset' => 0, 'order_col' => 'level_name', 'order_dir' => 'asc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('degree_management/index/'.$params['offset']);
		}

		$this->check_action_permission('search');
		$config['base_url'] = site_url('degree_management/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20; 
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search'])
		{
			$config['total_rows'] = $this->Levels->search_count_all($data['search']);
			$table_data = $this->Levels->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Levels->count_all();
			$table_data = $this->Levels->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table']=get_degrees_manage_table($table_data,$this);

		$this->load->view('faculty/degree/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";

		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'level_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$degree_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("degree_search_data",$degree_search_data);
		if ($search)
		{
			$config['total_rows'] = $this->Levels->search_count_all($search);
			$table_data = $this->Levels->search($search, $per_page, $offset, $order_col, $order_dir);
		} else {
			$config['total_rows'] = $this->Levels->count_all();
			$table_data = $this->Levels->get_all($per_page, $offset, $order_col, $order_dir);
		}
		$config['base_url'] = site_url('degree_management/sorting');
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_degrees_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'level_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';
		
		$degree_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("degree_search_data",$degree_search_data);
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data=$this->Levels->search($search, $per_page, $offset, $order_col, $order_dir);
		$config['base_url'] = site_url('degree_management/search');
		$config['total_rows'] = $this->Levels->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_degrees_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Levels->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function clear_state()
	{
		$this->session->unset_userdata('degree_search_data');
		redirect('degree_management');
	}

	function form($degree_id=-1)
	{
		$data['controller_name']=strtolower(get_class());
		$data['degree_info']=$this->Levels->get_info($degree_id);
		$this->load->view('faculty/degree/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Levels->check_duplicate($this->input->post('term'))));
	}

	function save($level_id=-1)
	{
		$this->check_action_permission('add_update');
		$datas = $this->input->post();
		$degree_data = array(
			'level_name'=>$datas['level_name'],
			'level_code'=>$datas['level_code'],
			'level_name_kh'=>$datas['level_name_kh'],			
			'level_duration'=>$datas['level_duration'],
			'duration_type'=>$datas['duration_type'],
		);
		$logged_in_employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		if ($level_id != -1) {
			$degree_data['updated_by'] = $logged_in_employee_id;
			$degree_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$degree_data['created_by'] = $logged_in_employee_id;
			$degree_data['created_at'] = date('Y-m-d H:i:s');
		}

		$redirect=$this->input->post('redirect');

		if($this->Levels->save($degree_data,$level_id))
		{
			if($level_id==-1)
			{
				$success_message = lang('degree_successful_adding').' '.$degree_data['level_name'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'level_id'=>$degree_data['level_id'],'redirect' => $redirect));
			} else {
				$success_message = lang('degree_successful_updating').' '.$degree_data['level_name'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'level_id'=>$level_id,'redirect' => $redirect));
			}
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('degree_error_adding_updating').' '.
			$degree_data['level_name'],'level_id'=>-1));
		}
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$ids_to_delete = $this->input->post('ids');
		$total_rows = count($ids_to_delete);
		if($this->Levels->delete_list($ids_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('university_successful_deleted').' '.
			$total_rows.' '.lang('university_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('university_cannot_be_deleted')));
		}
	}

	function get_degree_info()
	{
		echo json_encode(array(
			'degree_info' => $this->Levels->get_info($this->input->post('degree_id'))
		));
	}
}