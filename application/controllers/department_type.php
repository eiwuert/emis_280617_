<?php
require_once ("secure_area.php");
class Department_type extends Secure_area
{
	function __construct()
	{
		parent::__construct('department_type');
	}

	function index($offset=0) {
		$params = $this->session->userdata('dept_search_data') ? $this->session->userdata('dept_search_data') : array('offset' => 0, 'order_col' => 'dept_title', 'order_dir' => 'asc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('department_type/index/'.$params['offset']);
		}

		$this->check_action_permission('search');
		$config['base_url'] = site_url('department_type/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20; 
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search'])
		{
			$config['total_rows'] = $this->Dept->search_count_all($data['search']);
			$table_data = $this->Dept->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Dept->count_all();
			$table_data = $this->Dept->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_dept_manage_table($table_data,$this);

		$this->load->view('faculty/dept/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";

		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'dept_title';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$dept_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("dept_search_data",$dept_search_data);
		if ($search)
		{
			$config['total_rows'] = $this->Dept->search_count_all($search);
			$table_data = $this->Dept->search($search, $per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'dept_title' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		} else {
			$config['total_rows'] = $this->Dept->count_all();
			$table_data = $this->Dept->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'dept_title' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
		}
		$config['base_url'] = site_url('department_type/sorting');
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_dept_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function form($dept_id = -1) {
		$data['controller_name'] = strtolower(get_class());
		$data['dept_info'] = $this->Dept->get_info($dept_id);
		$this->load->view('faculty/dept/form',$data);
	}
	// function check_duplicate()
	// {
	// 	echo json_encode(array('duplicate'=>$this->Dept->check_duplicate($this->input->post('term'))));
	// }
	function save($dept_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id=$this->Employee->get_logged_in_employee_info()->person_id;
		$datas = $this->input->post();
		$deptData = array(
			'dept_title'=>$datas['dept_title'],
			'dept_title_kh'=>$datas['dept_title_kh']
		);
		if($dept_id == -1){
			$deptData['created_at'] =  date('Y-m-d H:i:s');
			$deptData['created_by'] =  $logged_in_employee_id;
		}else{
			$deptData['updated_at'] = date('Y-m-d H:i:s');
			$deptData['updated_by'] = $logged_in_employee_id;
		}

		if($this->Dept->save($deptData,$dept_id))
		{
			if($dept_id==-1)
			{
				$success_message = lang('dept_successful_adding').' '.$deptData['dept_title'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'dept_id'=>$deptData['dept_id'],'redirect' => $redirect));
			} else { //previous university
				$success_message = lang('dept_successful_updating').' '.$deptData['dept_title'];
				echo json_encode(array('success'=>true,'message'=>$success_message,'dept_id'=>$dept_id,'redirect' => $redirect));
			}
		}
		else //failure
		{
			echo json_encode(array('success'=>false,'message'=>lang('dept_error_adding_updating').' '.
			$deptData['dept_title'],'dept_id'=>-1));
		}
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$ids_to_delete=$this->input->post('ids');
		$total_rows= count($ids_to_delete);
		if($this->Dept->delete_list($ids_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('dept_successful_deleted').' '.
			$total_rows.' '.lang('dept_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('dept_cannot_be_deleted')));
		}
	}
	function clear_state()
	{
		$this->session->unset_userdata('dept_search_data');
		redirect('department_type');
	}

	// Gives search suggestions based on what is being searched for
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Dept->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	// function search()
	// {
	// 	$this->check_action_permission('search');
	// 	$search=$this->input->post('search');
	// 	$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
	// 	$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'dept_name';
	// 	$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';
		
	// 	$dept_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
	// 	$this->session->set_userdata("dept_search_data",$dept_search_data);
	// 	$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
	// 	$search_data=$this->Dept->search($search, $per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'dept_name' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc');
	// 	$config['base_url'] = site_url('university/search');
	// 	$config['total_rows'] = $this->Dept->search_count_all($search);
	// 	$config['per_page'] = $per_page ;
	// 	$this->pagination->initialize($config);
	// 	$data['pagination'] = $this->pagination->create_links();
	// 	$data['manage_table']=get_faculties_manage_table_data_rows($search_data,$this);
	// 	echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	// }
}