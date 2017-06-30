<?php
require_once ("secure_area.php");
class Product_delivery_note extends Secure_area
{
	function __construct()
	{
		parent::__construct('product_delivery_note');
	}

	function index($offset = 0)
	{
		$params = $this->session->userdata('delivery_search_data') ? $this->session->userdata('delivery_search_data') : array('offset' => 0, 'order_col' => 'delivery_id', 'order_dir' => 'desc', 'search' => FALSE);

		if ($offset != $params['offset']) {
			redirect('product_delivery_note/index/'.$params['offset']);
		}	
		$this->check_action_permission('search');
		$config['base_url'] = site_url('product_delivery_note/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());

		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search']) {
			$config['total_rows'] = $this->Delivery->search_count_all($data['search']);
			$table_data = $this->Delivery->search($data['search'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		} else {
			$config['total_rows'] = $this->Delivery->count_all();
			$table_data = $this->Delivery->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];
		$data['manage_table'] = get_delivery_manage_table($table_data,$this);		
		$this->load->view('items/delivery_note/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'delivery_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$delivery_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("delivery_search_data",$delivery_search_data);
	
		if ($search) {
			$config['total_rows'] = $this->Delivery->search_count_all($search);
			$table_data = $this->Student->search($search,$per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');
		} else {
			$config['total_rows'] = $this->Delivery->count_all();
			$table_data = $this->Delivery->get_all($per_page, $offset, $order_col, $order_dir);
		}
		$config['base_url'] = site_url('product_delivery_note/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_delivery_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search = $this->input->post('search');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'delivery_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$delivery_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("delivery_search_data",$delivery_search_data);
		$per_page = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data = $this->Delivery->search($search,$per_page,$offset, $order_col ,$order_dir);
		$config['base_url'] = site_url('product_delivery_note/search');
		$config['total_rows'] = $this->Delivery->search_count_all($search);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['total_rows'] = $config['total_rows'];
		$data['manage_table'] = get_delivery_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	/*
	Gives search suggestions based on what is being searched for
	*/
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Delivery->get_search_suggestions_delivery($this->input->get('term'),100);
		echo json_encode($suggestions);
	}
	/*
	This deletes
	*/
	function delete()
	{
		$this->check_action_permission('delete');
		$letter_in_delete = $this->input->post('ids');
		if ($this->Delivery->delete_list($letter_in_delete)) {
			echo json_encode(array('success'=>true,'message'=>lang('delivery_successful_deleted').' '.count($letter_in_delete).' '.lang('letter_in_one_or_multiple')));
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('delivery_cannot_be_deleted')));
		}
	}

	function clear_state()
	{
		$this->session->unset_userdata('delivery_search_data');
		redirect('product_delivery_note');
	}

	function view($item_id = -1)
	{
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$data['controller_name'] = strtolower(get_class());

		$select = $this->Delivery->get_cate_item_name()->result();
		$data['items'] = $select;

		$employees = $this->Professor->get_all()->result();
		$data['employee'] = ['' => '-- Please Select --'];
		foreach ($employees as $key => $employee) {
			$data['employee'][$employee->person_id] = $employee->last_name.' '.$employee->first_name;
		}
		$data['receiver_type'] = array('employee' => 'Employee', 'student' => 'Student');

		$data['get_edit'] = $this->Delivery->get_storage($item_id)->row();
		$data['get_edit_pro'] = $this->Delivery->get_storage_pro($item_id);	

		$this->load->view('items/delivery_note/view',$data);
	}

	function save($item_id = -1)
	{		
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$datas = $this->input->post();
		// $storage_info_by_user = $this->Delivery->get_storage_by_user($logged_in_info->person_id);

		$unit_data = array(
			'item_name' => $datas['item_name'],
			'item_unit' => $datas['item_unit'],
			'storage_unit_price' => $datas['storage_unit_price'],
			'storage_unit_discount' => $datas['storage_unit_discount'],
			'quantity' => $datas['quantity'],
			'all_qty' => $datas['all_qty'],
			'total_dollar' => $datas['total_dollar'],
			'total_riel' => $datas['total_riel'],
			'total_baht' => $datas['total_baht'],
			'd_each_discount' => $datas['d_each_discount'],
			'created_by' => $logged_in_info,
			'created_at' => date('Y-m-d H:i:s')
		);
		$unit_data_old = array(
			'autoid' => $datas['autoid'],
			'deleted' => $datas['deleted'],
			'item_name' => $datas['item_name_old'],
			'item_unit' => $datas['item_unit_old'],
			'storage_unit_price' => $datas['storage_unit_price_old'],
			'storage_unit_discount' => $datas['storage_unit_discount_old'],
			'quantity' => $datas['quantity_old'],
			'all_qty' => $datas['all_qty_old'],
			'total_dollar' => $datas['total_dollar_old'],
			'total_riel' => $datas['total_riel_old'],
			'total_baht' => $datas['total_baht_old'],
			'd_each_discount' => $datas['d_each_discount_old'],			
			'updated_by' => $logged_in_info,
			'updated_at' => date('Y-m-d H:i:s')
		);

		$item_data = array(
			'exchange_riel' => $datas['exchange_riel'],
			'exchange_baht' => $datas['exchange_baht'],
			'discount' => $datas['discount'],
			'all_discount' => $datas['all_discount'],
			'total_price_d' => $datas['total_price_d'],
			'total_price_r' => $datas['total_price_r'],
			'total_price_b' => $datas['total_price_b'],
			'receiver_type_id' => $datas['receiver_type'],
			'receiver_id' => $datas['receiver'],
			'delivery_ondate' => date('Y-m-d', strtotime($datas['on_date'])),
			'purpose' => $datas['purpose'],
			'send_by_id' => $datas['send_by'],
			'ch_total' => $datas['ch_total']
		);

		if ($item_id == -1) {
			$item_data['created_at'] =  date('Y-m-d H:i:s');
			$item_data['created_by'] =  $logged_in_info->person_id;
		} else {
			$item_data['updated_at'] = date('Y-m-d H:i:s');
			$item_data['updated_by'] = $logged_in_info->person_id;
		}

		if ($this->Delivery->item_save($item_data,$item_id, $unit_data, $unit_data_old)) {
			$success_message = '';
			//New item
			if ($item_id == -1) {
				$success_message = lang('items_successful_adding').' '.$item_data['receiver'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'delivery_id'=>$item_data['delivery_id'],'redirect' => $redirect, 'receiver'=>$receiver));
				$item_id = $item_data['delivery_id'];
			} else { //previous item
				$success_message = lang('items_successful_updating').' '.$item_data['receiver'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'delivery_id'=>$item_id,'redirect' => $redirect, 'receiver'=>$receiver));
			}
		} else {
			echo json_encode(array('success'=>false,'message'=>lang('items_error_adding_updating').' '.$item_data['receiver'],'item_id'=>-1));
		}
		
	}

	function storage()
	{
		$id_item= $this->input->post('item_id_hidden');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();
		$get_info_items = $this->Delivery->get_info_items($id_item);		
		if ($get_info_items->num_rows == 1) {
			$row = $get_info_items->row();
			$datas = array('d_item_id' => $row->item_id, 
							'd_user' => $logged_in_info->person_id);

			if ($this->Delivery->keep_items($datas) == 1) {
				redirect('product_delivery_note/view/-1');
			} else {
				$this->session->set_flashdata('fail_keep', 'Save Item Fail.');
				redirect('product_delivery_note/view/-1');
			}
		} else {
			$this->session->set_flashdata('fail_keep', 'Select Item Faile.');
			redirect('product_delivery_note/view/-1',$data);
		}
	}

	// function suggest_view()
	// {
	// 	//allow parallel searchs to improve performance.
	// 	session_write_close();
	// 	$view_suggestions = $this->Delivery->get_search_suggestions($this->input->get('term'),100);
	// 	echo json_encode($view_suggestions);
	// }

	function update_amount($id = '')
	{
		$amount = ($this->input->post('k_amount') !== '')? $this->input->post('k_amount') : 0 ;
		$dollar = ($this->input->post('k_dollar') !== '')? $this->input->post('k_dollar') : 0 ;
		$reil = ($this->input->post('k_reil') !== '')? $this->input->post('k_reil') : 0 ;
		$bath = ($this->input->post('k_bath') !== '')? $this->input->post('k_bath') : 0 ;

		$cal_dollar = floatval($dollar * $amount);
		$cal_reil = floatval($reil * $amount);
		$cal_bath = floatval($bath * $amount);

		$array_amount = array(
				'd_amount' => $amount,
				'd_unit_price' => $cal_dollar,
				'd_unit_price_reil' => $cal_reil,
				'd_unit_price_baht' => $cal_bath
		);

		if ($this->Delivery->up_amount($id,$array_amount) == 1) {
			redirect('product_delivery_note/view/-1');
		} else {
			$this->session->set_flashdata('fail_keep', 'Update Fail.');
			redirect('product_delivery_note/view/-1',$data);
		}
	}

	// function delete_row($id)
	// {
	// 	if ($this->Delivery->delete_data_storage($id,$array_amount) == 1) {
	// 		redirect('product_delivery_note/view/-1');
	// 	} else {
	// 		$this->session->set_flashdata('fail_keep', 'Delete Fail.');
	// 		redirect('product_delivery_note/view/-1',$data);
	// 	}
	// }

	function print_item_delivery($delivery_id)
	{
		$data['controller_name'] = strtolower(get_class());
		$delivery = $this->Delivery->get_view_delivery_print($delivery_id);	
		$d_receiver_id = $this->Delivery->get_receiver($delivery->row()->receiver_id);
		$send_by_id = $this->Delivery->get_send_by($delivery->row()->send_by_id);
		$data['receiver'] = $d_receiver_id->last_name.' '.$d_receiver_id->first_name;
		$data['receiver_kh'] = $d_receiver_id->last_name_kh.' '.$d_receiver_id->first_name_kh;
		$data['send_by'] = $send_by_id->last_name.' '.$send_by_id->first_name;
		$data['send_by_kh'] = $send_by_id->last_name_kh.' '.$send_by_id->first_name_kh;
		$data['delivery_ondate'] = $delivery->row()->delivery_ondate;
		$data['purpose'] = $delivery->row()->purpose;
		$data['get_delivery'] = get_print_delivery_table($delivery,$this);
		$this->load->view('items/delivery_note/print',$data);
	}
	function suggest_items(){
		$id = $this->input->post('id');
		$q = $this->Delivery->get_cate_item_name_id($id);
		$get = $q->row()->item_unique_id;
		echo json_encode(array("code" => $get));
	}
	function suggest_unit(){
		$id = $this->input->post('id');
		$q = $this->Delivery->get_cate_unit_id($id);
		$res = '&nbsp';
		if($q->num_rows()>0)
		{
			foreach($q->result() as $u)
			{
				$u_id = $u->item_unit_cate_id;
				$u_qty = $u->item_qty_unit;
				$u_pri = $u->item_set_price;
				$u_discount = $u->item_discount;
				$get_pri = ($u_pri - $u_discount);
				$u_title = $u->unit_name;
				$res .= "<option data-qty='$u_qty' data-pri='$get_pri'  data-discount='$u_discount' value='$u_id' >".$u_title."</option>";
			}
		}
		echo json_encode(array('res'=>$res));
	}
}