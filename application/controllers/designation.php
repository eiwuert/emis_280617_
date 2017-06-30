<?php
require_once ("secure_area.php");
class Designation extends Secure_area 
{
	function __construct()
	{
		parent::__construct('designation');
	}

	function index() {
		$params = $this->session->userdata('designation_search_data') ? $this->session->userdata('designation_search_data') : array('offset' => 0, 'order_col' => 'designation_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
		   redirect('designation/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('designation/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search'])
		{
			$config['total_rows'] = $this->Designation_model->search_count_all($data['search']);
			$table_data = $this->Designation_model->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Designation_model->count_all();			
			$table_data = $this->Designation_model->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_designation_manage_table($table_data,$this);
		
		$this->load->view('designation/manage',$data);

	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'designation_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$designation_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("designation_search_data",$designation_search_data);
		
		if ($search)
		{
			$config['total_rows'] = $this->Designation_model->search_count_all($search);
			$table_data = $this->Designation_model->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'designation_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		else
		{
			$config['total_rows'] = $this->Designation_model->count_all();
			$table_data = $this->Designation_model->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'designation_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('designation/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_designation_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));	
		
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'designation_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$designation_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("designation_search_data",$designation_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Designation_model->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('designation/search');
		$config['total_rows'] = $this->Designation_model->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Designation_model->search_count_all($search);
		$data['manage_table']= get_designation_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Inserts/updates an designation
	*/
	function save($designation_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;

		$designation_data = array(
			'designation_name'=>$this->input->post('designation_name'),
			'designation_alias'=>$this->input->post('designation_alias')
		);

		if ($designation_id != -1) {
			$designation_data['updated_by'] = $logged_in_employee_id;
			$designation_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$designation_data['created_by'] = $logged_in_employee_id;
			$designation_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Designation_model->save($designation_data, $designation_id))
		{			
			//New designation
			if($designation_id==-1)
			{
				$message = lang('designation_successful_adding').' '.$designation_data['designation_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'designation_id'=>$designation_data['designation_id']));
			}
			else //previous designation
			{
				$message = lang('designation_successful_updating').' '.$designation_data['designation_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'designation_id'=>$designation_id));
			}
		}
		else//failure
		{	
			echo json_encode(array('success'=>false,'message'=>lang('designation_error_adding_updating').' '.
			$designation_data['designation_name'],'designation_id'=>-1));
		}
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Designation_model->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function form($designation_id = -1) {

		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['designation_info'] = $this->Designation_model->get_info($designation_id);
		$this->load->view('designation/form',$data);
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Designation_model->check_duplicate($this->input->post('term'))));
	}

	function designation_exists()
	{
		if($this->Designation_model->designation_exists($this->input->post('designation_name')))
			echo 'false';
		else
			echo 'true';	
	}

	/*
	This deletes designation from the designation table
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$designation_to_delete=$this->input->post('ids');
		
		if ($this->Designation_model->delete_list($designation_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('designation_successful_deleted').' '.
			count($designation_to_delete).' '.lang('designation_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('designation_cannot_be_deleted')));
		}
	}

	function detail($designation_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name'] = strtolower(get_class());
		$data['designation_info'] = $this->Designation_model->get_detail($designation_id);
		$this->load->view('designation/detail',$data);
	}

	function delete_by_id($designation_id=-1) {
        $this->check_action_permission('delete');
        if ($designation_id && $this->Designation_model->delete($designation_id)) {
            echo json_encode(array('success'=>true, 'message'=>lang('designation_successful_deleted'), 'designation_id'=>$designation_id));
        } else {
            echo json_encode(array('success'=>false, 'message'=>lang('designation_error_delete'), 'designation_id'=>$designation_id));
        }
    }
    
    function clear_state()
	{
		$this->session->unset_userdata('designation_search_data');
		redirect('designation');
	}

}