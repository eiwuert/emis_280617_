<?php
require_once ("secure_area.php");
class Letter_out extends Secure_area 
{
	function __construct()
	{
		parent::__construct('letter_out');
	}


	function index($offset = 0) {
		$params = $this->session->userdata('letter_out_search_data') ? $this->session->userdata('letter_out_search_data') : array('offset' => 0, 'order_col' => 'id', 'order_dir' => 'desc', 'search' => FALSE);
		if ($offset!=$params['offset'])
		{
			redirect('letter_out/index/'.$params['offset']);
		}
		$this->check_action_permission('search');
		$config['base_url'] = site_url('letter_out/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";
		if ($data['search']) {
			$config['total_rows'] = $this->Letter_out_model->search_count_all($data['search']);
			$table_data = $this->Letter_out_model->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Letter_out_model->count_all();
			$table_data = $this->Letter_out_model->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_letter_out_manage_table($table_data,$this);
		$this->load->view('letter/letter_out/manage',$data);
	}
	function print_ex($letter_id){
		$data['controller_name']=strtolower(get_class());
		$data['detail'] = $this->Letter_out_model->get_info($letter_id);
		$this->load->view('letter/letter_out/print_ex',$data);
	}
	// keep letter in get info
	function view($letter_id = -1) {
		$this->check_action_permission('add_update');
		$data['controller_name']=strtolower(get_class());
		$data['letter_info_by_id'] = $this->Letter_out_model->get_info($letter_id);
		$get_employee_list = $this->Letter_out_model->get_user_type_info();
		$employee_temp = ["" => '--Employee Name--'];
		foreach($get_employee_list as $row){
			$employee_temp[$row->user_type_id] =  $row->user_type;
		}
		$data['employee'] = $employee_temp;
		$this->load->view('letter/letter_out/view',$data);
	}
	function save($letter_id=-1){
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$datas = $this->input->post();		
		$letter_data = array(
			'send_out_date'=> date('Y-m-d', strtotime($datas['send_out_date'])),
			'send_to'=>$datas['send_to'],
			'organization'=>$datas['organization'],
			'purpose'=>$datas['purpose'],
			'send_by'=>$datas['send_by']
		);		
		if($letter_id == -1){
			$letter_data['created_at'] =  date('Y-m-d H:i:s');
			$letter_data['created_by'] =  $logged_in_employee_id;
		}else{
			$letter_data['updated_at'] = date('Y-m-d H:i:s');
			$letter_data['updated_by'] = $logged_in_employee_id;
		}

		if($this->Letter_out_model->save($letter_data,$letter_id))
		{
			if($letter_id==-1)
			{
				$message = lang('letter_out_successful_adding').' '.$letter_data['purpose'];
				echo json_encode(array('success'=>true,'message'=>$message,'letter_id'=>$letter_data['id']));
			} else {
				$message = lang('letter_out_successful_updating').' '.$letter_data['purpose'];
				echo json_encode(array('success'=>true,'message'=>$message,'letter_id'=>$letter_id));
			}			
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('letter_out_error_adding_updating').' '.$letter_data['purpose'],'letter_id'=>-1));
		}
	}
	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'letter_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';
		$letter_out_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("letter_out_search_data",$letter_out_search_data);
		if ($search) {
			$config['total_rows'] = $this->Letter_out_model->search_count_all($search);
			$table_data = $this->Letter_out_model->search($search, $per_page, $offset, $order_col, $order_dir);
		} else {
			$config['total_rows'] = $this->Letter_out_model->count_all();
			$table_data = $this->Letter_out_model->get_all($per_page, $offset, $order_col ,$order_dir);
		}
		$config['base_url'] = site_url('letter_out/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_letter_out_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';
		$letter_out_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("letter_out_search_data",$letter_out_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Letter_out_model->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('letter_out/search');
		$config['total_rows'] = $this->Letter_out_model->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $config['total_rows'];
		$data['manage_table']= get_letter_out_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Letter_out_model->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}
	/*
	This deletes course
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$letter_out_delete=$this->input->post('ids');
		if ($this->Letter_out_model->delete_list($letter_out_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('letter_out_successful_deleted').' '.
			count($letter_out_delete).' '.lang('letter_out_one_or_multiple')));
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('letter_out_cannot_be_deleted')));
		}
	}
	function clear_state()
	{
		$this->session->unset_userdata('letter_out_search_data');
		redirect('letter_out');
	}
	function add_file($id){
		$data['controller_name']=strtolower(get_class());
		$data['id_form'] = $id;
		$data['title'] = 'Letter Out';
		$this->load->view('letter/upload_file',$data);
	}
	function uploads(){
		if ( ! empty($_FILES))
		{	
			$id_form =$_POST['id'];
			$config['upload_path'] = "./assets/letter_out";
			$config['allowed_types'] = 'doc|pdf|docx|xlsx|png|jpeg|txt|zip';
			$this->load->library('upload');

			$files           = $_FILES;			
			$number_of_files = count($_FILES['file']['name']);
			$errors = 0;
			// codeigniter upload just support one file
			// to upload. so we need a litte trick
			for ($i = 0; $i < $number_of_files; $i++)
			{
				$clear_file = $_FILES['file']['name'][$i];
				$_FILES['file']['name'] = date('dmY_h_i_s_').$clear_file;
				$_FILES['file']['type'] = $files['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $files['file']['error'][$i];
				$_FILES['file']['size'] = $files['file']['size'][$i];

				// we have to initialize before upload
				$this->upload->initialize($config);

				if (! $this->upload->do_upload("file")) {
					$errors++;
				}else{
					$arr_file = array('file_name' => $_FILES['file']['name'],
										'file_id_form' => $id_form,
										'file_size' => $_FILES['file']['size'],
										'file_type' => $_FILES['file']['type']);
					$this->Letter_out_model->save_file($arr_file);
				}
			}

			if ($errors > 0) {
				echo $errors . "File(s) cannot be uploaded";
			}

		}
		elseif ($this->input->post('file_to_remove')) 
		{
			$id_to_remove = $this->input->post('id_to_remove');
			$this->Letter_out_model->del_file($id_to_remove);
			$file_to_remove = $this->input->post('file_to_remove');
			unlink("./assets/letter_out/" . $file_to_remove);	
		}
	}
	function get_list(){
		$id_form = $_POST["id"];
		$q_file = $this->Letter_out_model->get_list_file($id_form);
		$data = '';
		foreach($q_file as $row){
	        $id = $row->id;
	        $file_name = $row->file_name;
	        $down_file = base_url().'assets/letter_out/'.$file_name;
	       $data.="<li class='list-group-item'><a href='".$down_file."' download='".$file_name."'>".substr($file_name,18)."</a><div class='pull-right'><a href='".$id."' data-file='".$file_name."' class='remove-file'><i class='glyphicon glyphicon-remove'></i></a></div></li>";
    	}
		echo $data;
	}
}