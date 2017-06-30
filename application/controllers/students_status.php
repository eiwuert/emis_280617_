<?php
require_once ("secure_area.php");
class Students_status extends Secure_area 
{
	function __construct()
	{
		parent::__construct();
	}

	function index() {
		$params = $this->session->userdata('student_status_search_data') ? $this->session->userdata('student_status_search_data') : array('offset' => 0, 'order_col' => 'stu_status_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
		   redirect('students_status/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('students_status/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search'])
		{
			$config['total_rows'] = $this->Student_status->search_count_all($data['search']);
			$table_data = $this->Student_status->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Student_status->count_all();
			$table_data = $this->Student_status->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_students_status_manage_table($table_data,$this);

		$this->load->view('students/students_status/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_status_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$student_status_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("student_status_search_data",$student_status_search_data);
		
		if ($search)
		{
			$config['total_rows'] = $this->Student_status->search_count_all($search);
			$table_data = $this->Student_status->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_status_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		else
		{
			$config['total_rows'] = $this->Student_status->count_all();
			$table_data = $this->Student_status->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_status_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('students_status/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_students_status_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));	
		
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_status_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$student_status_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("student_status_search_data",$student_status_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Student_status->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('students_status/search');
		$config['total_rows'] = $this->Student_status->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Student_status->search_count_all($search);
		$data['manage_table']= get_students_status_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function view($stu_status_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['stu_status_info'] = $this->Student_status->get_info($stu_status_id);

		$this->load->view('students/students_status/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Student_status->check_duplicate($this->input->post('term'))));
	}

	function stu_status_exists()
	{
		if($this->Student_status->student_status_exists($this->input->post('stu_status_name')))
		echo 'false';
		else
		echo 'true';	
	}

	/*
	Inserts/updates an student status
	*/
	function save($stu_status_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$stu_status_data = array(
			'stu_status_name'=>$this->input->post('stu_status_name'),
			'stu_status_description'=>$this->input->post('stu_status_description')
		);
		if ($stu_status_id != -1) {
			$stu_status_data['updated_by'] = $logged_in_employee_id;
			$stu_status_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$stu_status_data['created_by'] = $logged_in_employee_id;
			$stu_status_data['created_at'] = date('Y-m-d H:i:s');
		}
							
		if($this->Student_status->save($stu_status_data, $stu_status_id))
		{			
			//New student status
			if($stu_status_id==-1)
			{
				$message = lang('students_status_successful_adding').' '.$stu_status_data['stu_status_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'stu_status_id'=>$stu_status_data['stu_status_id']));
			}
			else //previous student status
			{
				$message = lang('students_status_successful_updating').' '.$stu_status_data['stu_status_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'stu_status_id'=>$stu_status_id));
			}
		}
		else//failure
		{	
			echo json_encode(array('success'=>false,'message'=>lang('students_status_error_adding_updating').' '.
			$stu_status_data['stu_status_name'],'stu_status_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Student_status->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	/*
	This deletes student status from the stu_status table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$stu_status_to_delete=$this->input->post('ids');
		
		if ($this->Student_status->delete_list($stu_status_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('students_status_successful_deleted').' '.
			count($stu_status_to_delete).' '.lang('students_status_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('students_status_cannot_be_deleted')));
		}
	}

	function detail($stu_status_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['stu_status_info'] = $this->Student_status->get_detail($stu_status_id);

		$this->load->view('students/students_status/detail',$data);
	}

	function delete_by_id($stu_status_id=-1) {
        $this->check_action_permission('delete');
        if ($stu_status_id && $this->Student_status->delete($stu_status_id)) {
            echo json_encode(array('success'=>true, 'message'=>lang('students_status_successful_deleted'), 'stu_status_id'=>$stu_status_id));
        } else {
            echo json_encode(array('success'=>false, 'message'=>lang('students_status_error_delete'), 'stu_status_id'=>$stu_status_id));
        }
    }
    
    function clear_state()
	{
		$this->session->unset_userdata('student_status_search_data');
		redirect('students_status');
	}

}