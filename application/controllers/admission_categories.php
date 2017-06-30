<?php
require_once ("secure_area.php");
class Admission_categories extends Secure_area 
{	
	function index() {
		$params = $this->session->userdata('admission_search_data') ? $this->session->userdata('admission_search_data') : array('offset' => 0, 'order_col' => 'stu_category_id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
		   redirect('admission_categories/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('admission_categories/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search'])
		{
			$config['total_rows'] = $this->Admission_category->search_count_all($data['search']);
			$table_data = $this->Admission_category->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Admission_category->count_all();			
			$table_data = $this->Admission_category->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_admission_manage_table($table_data,$this);

		$this->load->view('students/admission_category/list',$data);
	}

	
	function form($admission_category_id = -1) {
		$data['controller_name']=strtolower(get_class());
		$data['admission_category_info'] = $this->Admission_category->get_info($admission_category_id);
		$this->load->view('students/admission_category/create_new',$data);
	}

	function save($admission_category_id= -1){
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$admission_data = array(
			'stu_category_name'=>$this->input->post('admission_name')
		);

		if ($admission_category_id != -1) {
			$admission_data['updated_by'] = $logged_in_employee_id;
			$admission_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$admission_data['created_by'] = $logged_in_employee_id;
			$admission_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Admission_category->save($admission_data, $admission_category_id))
		{		
			//New designation
			if($admission_category_id==-1)
			{
				$message = lang('admission_category_successful_adding').' '.$designation_data['stu_category_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'stu_category_id'=>$admission_data['admission_id']));
			}
			else //previous designation
			{
				$message = lang('admission_category_successful_updating').' '.$designation_data['stu_category_name'];
				echo json_encode(array('success'=>true,'message'=>$message,'stu_category_id'=>$admission_category_id));
			}
		}
		else//failure
		{	
			echo json_encode(array('success'=>false,'message'=>lang('admission_category_error_adding_updating').' '.
			$designation_data['stu_category_name'],'admission_category_id'=>-1));
		}

	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'admission_category_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$admission_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("admission_search_data",$admission_search_data);
		
		if ($search)
		{
			$config['total_rows'] = $this->Admission_category->search_count_all($search);
			$table_data = $this->Admission_category->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_category_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		else
		{
			$config['total_rows'] = $this->Admission_category->count_all();
			$table_data = $this->Admission_category->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_category_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('Admission_categories/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_admission_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));	
		
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_category_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$admission_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("admission_search_data",$admission_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Admission_category->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('admission_categories/search');
		$config['total_rows'] = $this->Admission_category->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);				
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Admission_category->search_count_all($search);
		$data['manage_table']= get_admission_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Admission_category->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}
	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Admission_category->check_duplicate($this->input->post('term'))));
	}

	function admission_exists()
	{
		if($this->Admission_category->admission_exists($this->input->post('admission_name')))
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

		$admission_to_delete=$this->input->post('ids');
		
		if ($this->Admission_category->delete_list($admission_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('admission_successful_deleted').' '.
			count($admission_to_delete).' '.lang('admission_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('admission_cannot_be_deleted')));
		}
	}

	function delete_by_id($admission_category_id=-1) {

        $this->check_action_permission('delete');
        if ($admission_category_id && $this->Admission_category->delete($admission_category_id)) {
            echo json_encode(array('success'=>true, 'message'=>lang('admission_category_successful_deleted'), 'stu_category_id'=>$admission_category_id));
        } else {
            echo json_encode(array('success'=>false, 'message'=>lang('admission_category_error_delete'), 'stu_category_id'=>$admission_category_id));
        }
    }

    function clear_state()
	{
		$this->session->unset_userdata('admission_search_data');
		redirect('admission_categories');
	}
}