<?php
require_once ("secure_area.php");
require_once ("interfaces/idata_controller.php");
class Items extends Secure_area implements iData_controller
{
	function __construct()
	{
		parent::__construct('items');
	}

	function item_unique_exists()
	{
		if($this->Item->item_unique_exists($this->input->post('item_unique_id')))
		echo 'false';
		else
		echo 'true';
	}

	function check_duplicate()
	{
		echo json_encode(array('duplicate'=>$this->Item->check_duplicate($this->input->post('term'))));
	}

	function search()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search');
		$category = $this->input->post('category');
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'item_name';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$item_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search,  'category' => $category);
		$this->session->set_userdata("item_search_data",$item_search_data);
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$search_data=$this->Item->search($search, $category, $per_page, $offset, $order_col, $order_dir);
		$config['base_url'] = site_url('items/search');
		$config['total_rows'] = $this->Item->search_count_all($search, $category);
		$config['per_page'] = $per_page ;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_items_manage_table_data_rows($search_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function suggest()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Item->get_search_suggestions($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function last_running_number()
	{
		$last_running_number = $this->Item->get_last_running_number();
		$running_number = $last_running_number + 1;
		if (strlen($running_number) < 6) {
			$running_number = str_pad($running_number, 6, '0', STR_PAD_LEFT);
		}
		return $running_number;
	}

	function save($item_id=-1)
	{
		$this->check_action_permission('add_update');
		$datas = $this->input->post();
		$item_data = array(
			'item_name'=>$datas['item_name'],
			'item_name_kh'=>$datas['item_name_kh'],
			'unit'=>$datas['unit'],
			'item_unique_id'=>$datas['item_unique_id']=='' ? null:$datas['item_unique_id'],
			'model'=>$datas['model'],
			'quantity'=>$datas['quantity'],
			'unit_price'=>$datas['unit_price'],
			'category_id'=>$datas['category_id']=='' ? null:$datas['category_id'],
			'supplier_id'=>$datas['supplier_id'],
			'description'=>$datas['description'],
		);

		$employee_id=$this->Employee->get_logged_in_employee_info()->person_id;

		$redirect=$this->input->post('redirect');

		if($this->Item->save($item_data,$item_id))
		{
			$success_message = '';

			//New item
			if($item_id==-1)
			{
				$success_message = lang('items_successful_adding').' '.$item_data['name'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'item_id'=>$item_data['item_id'],'redirect' => $redirect, 'sale_or_receiving'=>$sale_or_receiving));
				$item_id = $item_data['item_id'];
			}
			else //previous item
			{
				$success_message = lang('items_successful_updating').' '.$item_data['name'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'item_id'=>$item_id,'redirect' => $redirect, 'sale_or_receiving'=>$sale_or_receiving));
			}

		}
		else //failure
		{
			echo json_encode(array('success'=>false,'message'=>lang('items_error_adding_updating').' '.
			$item_data['name'],'item_id'=>-1));
		}

	}
	function cleanup()
	{
		$this->Item->cleanup();
		echo json_encode(array('success'=>true,'message'=>lang('items_cleanup_sucessful')));
	}

	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	function index($offset=0)
	{
		$params = $this->session->userdata('po_search_data') ? $this->session->userdata('po_search_data') : array('offset' => 0, 'order_col' => 'po_id', 'order_dir' => 'asc');
		if ($offset!=$params['offset'])
		{
			redirect('items/index/'.$params['offset']);
		}

		$this->check_action_permission('search');
		$config['base_url'] = site_url('items/sorting');
		$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
		$data['controller_name']=strtolower(get_class());
		$data['per_page'] = $config['per_page'];
		$data['search'] = $params['search'] ? $params['search'] : "";

		if ($data['search'])
		{
			$config['total_rows'] = $this->Item->search_count_all($data['search'], $data['category']);
			$table_data = $this->Item->search($data['search'],$data['category'],$data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}
		else
		{
			$config['total_rows'] = $this->Item->count_all_po();
			$table_data = $this->Item->get_all_po($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);
		}

		$data['total_rows'] = $config['total_rows'];
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['order_col'] = $params['order_col'];
		$data['order_dir'] = $params['order_dir'];

		$data['manage_table']=get_po_manage_table($table_data,$this);
		$this->load->view('items/manage_po',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";

		$per_page=$this->config->item('number_of_po_per_page') ? (int)$this->config->item('number_of_po_per_page') : 20;
		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'po_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'asc';

		$po_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("po_search_data",$po_search_data);
		if ($search)
		{
			$config['total_rows'] = $this->Item->search_count_all($search, $category);
			$table_data = $this->Item->search($search, $category, $per_page, $offset, $order_col, $order_dir);
		}
		else
		{
			$config['total_rows'] = $this->Item->count_all_po();
			$table_data = $this->Item->get_all_po($per_page, $offset, $order_col, $order_dir);
		}
		$config['base_url'] = site_url('items/sorting');
		$config['per_page'] = $per_page;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table']=get_po_manage_table_data_rows($table_data,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}

	function view($po_id=-1,$redirect=0)
	{
		$this->check_action_permission('add_update');
		$data = array();
		$data['controller_name'] = strtolower(get_class());
		$data['po_info'] = $this->Item->get_po_byid($po_id)->row();
		$data['po_items_info'] = $this->Item->get_po_items_by_id($po_id)->result();
		
		$suppliers = array('' => lang('items_none'));
		foreach($this->Supplier->get_all()->result_array() as $row)
		{
			$suppliers[$row['id']] = $row['company_name'] .' ('.$row['first_name'] .' '. $row['last_name'].')';
		}
		$data['suppliers'] = $suppliers;
		
		$prof = $this->Professor->get_all()->result();
		$data['employee'] = ['' => '-- Please Select --'];
		foreach ($prof as $key => $val) {
			$data['employee'][$val->person_id] = $val->last_name.' '.$val->first_name;
		}

		$select = $this->Item->get_cate_item_name()->result();
		$data['items'] = $select;
		// $select = $this->Item->get_item_cate_unit()->result();
		// $data['unit_items'] = $select;

		$this->load->view("items/form",$data);
	}

	function suggest_items(){
		$id = $this->input->post('id');
		$q = $this->Item->get_cate_item_name_id($id);
		$get = $q->row()->item_unique_id;
		echo json_encode(array("code" => $get));
	}
	function suggest_unit(){
		$id = $this->input->post('id');
		$q = $this->Item->get_cate_unit_id($id);
		$res = '&nbsp';
		if($q->num_rows()>0)
		{
			foreach($q->result() as $u)
			{
				$u_id = $u->item_unit_cate_id;
				$u_qty = $u->item_qty_unit;
				$u_title = $u->unit_name;
				$res .= "<option data-qty='$u_qty' value='$u_id' >".$u_title."</option>";
			}
		}

		echo json_encode(array('res'=>$res));
	}
	// item_form
	function save_po($po_id=-1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$datas = $this->input->post();

		$po_data_items = array(
			'item_name' => $datas['item_name'],
			'item_unique_id' => $datas['item_unique_id'],
			'item_unit' => $datas['item_unit'],
			'quantity' => $datas['quantity'],
			'all_qty' => $datas['all_qty'],
			'd_price' => $datas['d_price'],			
			'total_dollar' => $datas['total_dollar'],
			'total_riel' => $datas['total_riel'],
			'total_baht' => $datas['total_baht'],
			'each_discount' => $datas['each_discount'],
			'created_by' => $logged_in_employee_id,
			'created_at' => date('Y-m-d H:i:s')
		);
		$po_data_items_old = array(
			'autoid' => $datas['autoid'],
			'item_name' => $datas['item_name_old'],
			'item_unique_id' => $datas['item_unique_id_old'],
			'item_unit' => $datas['item_unit_old'],
			'quantity' => $datas['quantity_old'],
			'all_qty' => $datas['all_qty_old'],
			'd_price' => $datas['d_price_old'],			
			'total_dollar' => $datas['total_dollar_old'],
			'total_riel' => $datas['total_riel_old'],
			'total_baht' => $datas['total_baht_old'],
			'each_discount' => $datas['each_discount_old'],
			'updated_by' => $logged_in_employee_id,
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted' => $datas['deleted']

		);
		$po_data = array(
			'po_supplier'=>$datas['supplier'],
			'po_exchange_d'=>$datas['exchange_dollar'],
			'po_exchange_b'=>$datas['exchange_baht'],
			'po_discount'=>$datas['discount'],
			'po_total_discount'=>$datas['total_discount'],

			'po_total_d'=>$datas['dollar_total'],
			'po_total_r'=>$datas['riel_total'],
			'po_total_b'=>$datas['baht_total'],
			
			'po_receiver_id' => $datas['receiver'],
			// 'po_send_by_id' => $datas['send_by'],
			'po_date'=>date("Y-m-d", strtotime($datas['date'])),
			'po_description'=>$datas['description'],
		);

		if ($po_id != -1) {
			$po_data['updated_by'] = $logged_in_employee_id;
			$po_data['updated_at'] = date('Y-m-d H:i:s');
		} else {
			$po_data['created_by'] = $logged_in_employee_id;
			$po_data['created_at'] = date('Y-m-d H:i:s');
		}

		if($this->Item->save_po($po_data,$po_id, $po_data_items, $po_data_items_old))
		{
			$success_message = '';
			//New item
			if($item_id==-1)
			{
				$success_message = lang('po_successful_adding');
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'po_id'=>$po_data['po_id']));
			}
			else //previous item
			{
				$success_message = lang('po_successful_updating').' '.$item_data['name'];
				$this->session->set_flashdata('manage_success_message', $success_message);
				echo json_encode(array('success'=>true,'message'=>$success_message,'po_id'=>$po_id));
			}
		}
		else //failure
		{
			echo json_encode(array('success'=>false,'message'=>lang('po_error_adding_updating').' '.$item_data['name'],'item_id'=>-1));
		}

	}

	function suggest_po()
	{
		//allow parallel searchs to improve performance.
		session_write_close();
		$suggestions = $this->Item->get_search_suggestions_po($this->input->get('term'),100);
		echo json_encode($suggestions);
	}

	function clear_state()
	{
		$this->session->unset_userdata('po_search_data');
		redirect('items');
	}

	function delete()
	{
		$this->check_action_permission('delete');
		$po_to_delete=$this->input->post('ids');
		$total_rows= count($po_to_delete);

		if($this->Item->delete_list_po($po_to_delete))
		{
			echo json_encode(array('success'=>true,'message'=>lang('items_successful_deleted').' '.
			$total_rows.' '.lang('items_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success'=>false,'message'=>lang('items_cannot_be_deleted')));
		}
	}
}
?>