<?php
require_once ("secure_area.php");
class University extends Secure_area
{
	function __construct()
	{
		parent::__construct('university');
	}

	function index($offset=0) {
		$params = $this->session->userdata('faculty_search_data') ? $this->session->userdata('faculty_search_data') : array('offset' => 0, 'order_col' => 'university_name', 'order_dir' => 'asc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('university/index/'.$params['offset']);
		}

		$this->check_action_permission('search');
		$config['base_url'] = site_url('university/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20; 
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search'])
		{
			$config['total_rows'] = $this->Universities->search_count_all($data['search']);
			$table_data = $this->Universities->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Universities->count_all();
			$table_data = $this->Universities->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_faculties_manage_table($table_data,$this);

		$this->load->view('faculty/university/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";

		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'university_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$faculty_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("faculty_search_data",$faculty_search_data);
		if ($search)
		{
			$config['total_rows'] = $this->Universities->search_count_all($search);
			$table_data = $this->Universities->search($search, $per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'university_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		} else {
			$config['total_rows'] = $this->Universities->count_all();
			$table_data = $this->Universities->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'university_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		}
		$config['base_url'] = site_url('university/sorting');
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_faculties_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function form($university_id = -1) {
		$data['controller_name'] = strtolower(get_class());
		$data['uni_info'] = $this->Universities->get_info($university_id);
		$data['faculty_dean'] = $this->opt_professor();
		$data['card_color_type'] = $this->opt_color_type();
		$this->load->view('faculty/university/form',$data);
	}
	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Universities->check_duplicate($this->input->post('term'))));
	}
	function save($university_id=-1)
	{
		$this->check_action_permission('add_update');
		$datas = $this->input->post();
		$uni_data = array(
			'university_name'=>$datas['university_name'],
			'university_name_kh'=>$datas['university_name_kh'],
			'university_dean_id'=>$datas['faculty_dean'],
			'university_code'=>$datas['university_code'],
			'created_at'=>$datas['created_at'] != '' ? date('Y-m-d H:i:s', strtotime($datas['created_at'])) : '',
			'updated_at'=>$datas['updated_at'] != '' ? date('Y-m-d H:i:s', strtotime($datas['updated_at'])) : '',
			'card_color_type'=>$datas['card_color_type'],
			'university_name_short_word'=>$datas['university_name_short_word'],
		);
		$logged_in_employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		if ($university_id != -1) {
			$uni_data['updated_by'] = $logged_in_employee_id;	
		} else {
			$uni_data['created_by'] = $logged_in_employee_id;
		}
		$redirect=$this->input->post('redirect');

		if($this->Universities->save($uni_data,$university_id))
		{
			if($university_id==-1)
			{
				$success_message = lang('university_successful_adding').' '.$uni_data['university_name'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'university_id'=>$uni_data['university_id'],'redirect' => $redirect));
			} else { //previous university
				$success_message = lang('university_successful_updating').' '.$uni_data['university_name'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'university_id'=>$university_id,'redirect' => $redirect));
			}
		}
		else //failure
		{
			echo json_encode(array('success'=>false,'message'=>lang('university_error_adding_updating').' '.
			$uni_data['university_name'],'university_id'=>-1));
		}
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$ids_to_delete=$this->input->post('ids');
		$total_rows= count($ids_to_delete);
		if($this->Universities->delete_list($ids_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('university_successful_deleted').' '.
			$total_rows.' '.lang('university_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('university_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('faculty_search_data');
		redirect('university');
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Universities->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function search()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'university_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';
		
		$faculty_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("faculty_search_data",$faculty_search_data);
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data=$this->Universities->search($search, $per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'university_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		$config['base_url'] = site_url('university/search');
		$config['total_rows'] = $this->Universities->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_faculties_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
}