<?php
require_once ("secure_area.php");
class Short_course extends Secure_area 
{
	function __construct()
	{
		parent::__construct('short_course');
	}

	function index() {	
		$data['controller_name']=strtolower(get_class());
		$params = $this->session->userdata('short_course') ? $this->session->userdata('short_course') : array('offset' => 0, 'order_col' => 'id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('short_course/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('short_course/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Short_courses->search_count_all($data['search']);
			$table_data = $this->Short_courses->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Short_courses->count_all();
			$table_data = $this->Short_courses->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_short_courses_manage_table($table_data,$this);
		$this->load->view('short_course/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';
		$short_course = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("short_course",$short_course);
		if ($search) {
			$config['total_rows'] = $this->Short_courses->search_count_all($search);
			$table_data = $this->Short_courses->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Short_courses->count_all();
			$table_data = $this->Short_courses->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		}
		$config['base_url'] = site_url('short_course/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_short_courses_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$short_course = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("short_course",$short_course);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Short_courses->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('short_course/search');
		$config['total_rows'] = $this->Short_courses->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $this->Short_courses->search_count_all($search);
		$data['manage_table']= get_short_courses_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function suggest(){
		session_write_close();
		$suggestions = $this->Short_courses->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function view($id) {
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['courses_info'] = $this->Short_courses->get_all_byid($id)->row();
		$this->load->view('short_course/form',$data);
	}
	function save($id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$data = array('courses_title' => $this->input->post('title'),
						'courses_venue' => $this->input->post('venue'),
						'courses_date_from' => date_format(date_create($this->input->post('date_from')),"Y-m-d"),
						'courses_date_to' => date_format(date_create($this->input->post('date_to')),"Y-m-d"),
						'courses_orgainized' => $this->input->post('orgainized'),
						'courses_male_participants' => $this->input->post('male_participants'),
						'courses_female_participants' => $this->input->post('female_participants'));
		if ($id != -1) {
			$data['updated_by'] = $logged_in_employee_id;
			$data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$data['created_by'] = $logged_in_employee_id;
			$data['created_at'] = date('Y-m-d H:i:s');
		}
		if($this->Short_courses->save($data, $id)) {	
 			//New subject
			if($id==-1) {
				$message = lang('courses_successful_adding').' '.$data['courses_title'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$data['id']));
			} else {
				$message = lang('courses_successful_updating').' '.$data['courses_title'];
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		} else { //failure
			echo json_encode(array('success'=>false,'message'=>lang('courses_error_adding_updating').' '.
			$data['courses_title'],'id'=>-1));
		}
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$id=$this->input->post('ids');
		
		if ($this->Short_courses->delete($id))
		{
			echo json_encode(array('success'=>true,'message'=>lang('courses_successful_deleted')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('courses_cannot_be_deleted')));
		}
	}
	function clear_state()
	{
		$this->session->unset_userdata('short_course');
		redirect('short_course');
	}
}