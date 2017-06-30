<?php
require_once ("secure_area.php");
class Fees_collection extends Secure_area 
{
	function index($offset=0) {
		$this->check_action_permission('search');
		$data['controller_name']=strtolower(get_class());

			$data['major'] = $this->opt_selection_major();
			$data['degrees'] = $this->opt_degrees();
			$data['batches'] = $this->opt_batches();
			$data['period'] = $this->opt_grade();
			$data['year'] = $this->opt_section();
			$data['scholarship'] = $this->opt_scholarship();

			$params = $this->session->userdata('stu_fee_search_data') ? $this->session->userdata('stu_fee_search_data') : array('offset' => 0, 'order_col' => 'stu_master_id', 'order_dir' => 'desc', 'search' => FALSE);
			if ($offset!=$params['offset'])
			{
			   redirect('fees_collection/index/'.$params['offset']);
			}
			$config['base_url'] = site_url('fees_collection/sorting');
			$config['per_page'] = $this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;
			$data['per_page'] = $config['per_page'];
			$data['search'] = $params['search'] ? $params['search'] : "";
		
			$config['total_rows'] = $this->Fees_collections->count_all();
			$table_data = $this->Fees_collections->get_all($data['per_page'],$params['offset'],$params['order_col'],$params['order_dir']);

			$data['total_rows'] = $config['total_rows'];
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			$data['order_col'] = $params['order_col'];
			$data['order_dir'] = $params['order_dir'];
			$data['manage_table']=get_fees_collection_manage_table($table_data,$this);
		$this->load->view('faculty/fee_collection/manage',$data);
	}

	function sorting()
	{
		$this->check_action_permission('search');
		$search=$this->input->post('search') ? $this->input->post('search') : "";
		$per_page=$this->config->item('number_of_items_per_page') ? (int)$this->config->item('number_of_items_per_page') : 20;

		$offset = $this->input->post('offset') ? $this->input->post('offset') : 0;
		$order_col = $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id';
		$order_dir = $this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc';

		$stu_fee_search_data = array('offset' => $offset, 'order_col' => $order_col, 'order_dir' => $order_dir, 'search' => $search);
		$this->session->set_userdata("stu_fee_search_data",$stu_fee_search_data);

			$config['total_rows'] = $this->Fees_collections->count_all();
			$table_data = $this->Fees_collections->get_all($per_page,$this->input->post('offset') ? $this->input->post('offset') : 0, $this->input->post('order_col') ? $this->input->post('order_col') : 'stu_master_id' ,$this->input->post('order_dir') ? $this->input->post('order_dir'): 'desc');

		$config['base_url'] = site_url('fees_collection/sorting');
		$config['per_page'] = $per_page; 
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['manage_table'] = get_fees_collection_manage_table($table_data,$this);	
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));	
	}

	function fee_payment_transaction($id_stu_acad,$id_edit=''){

		$data['controller_name']=strtolower(get_class());

		$get_info_stu = $this->Fees_collections->get_all_info_stu_by_id($id_stu_acad);
		$data['manage_student_info'] = get_view_stu_manage_table_info($get_info_stu,$this);
		// edit
		$edit = $this->Fees_collections->get_result_payment($id_edit);
		$data['get_edit'] = $edit;

		$level_id = intval($get_info_stu->row()->level_id);
		$major_id = intval($get_info_stu->row()->skill_id);
		$scholarship_academic = $get_info_stu->row()->stu_acad_scholarship_id;
		$section = $get_info_stu->row()->section_id;

		$data['suggest_data_payment'] = $this->Fees_collections->suggest_payment($level_id,$major_id, $scholarship_academic,$section)->row();
		$data['scholarship'] = $get_info_stu->row()->scholarship_from;
		$data['scholarship_id'] = $get_info_stu->row()->scho_id;
		$data['scholarship_percent'] = $this->opt_scholarship_percent();
		$data['monthly_self_paid_id'] = $this->opt_monthly_payment();
		$data['currency'] = $this->opt_currency();
		$data['payment_method'] = $this->opt_payment_method();
		$data['schedule'] = $this->opt_schedule2();
		$data['stu_info'] = $get_info_stu;
		$data['stu_unique_id'] = $get_info_stu->row()->stu_unique_id;

		$get_list_stu_payment = $this->Fees_collections->get_list_payment_stus($get_info_stu->row()->stu_info_id);
			// for edit page
			$e_scho = $edit->pay_scholarship_percent;
		    $e_fee = $edit->pay_amount_fee;
		    $e_exchange_r = floatval($edit->pay_ex_rate);
		    $e_exchange_b = floatval($edit->pay_ex_baht);

		    $data['e_pay_other_ch'] = $edit->pay_other_ch;
		    $data['e_pay_pre_ex_ch'] = $edit->pay_pre_ex_ch;
		    $data['e_pay_final_ch'] = $edit->pay_final_ch;
		    $data['e_pay_re_ex_ch'] = $edit->pay_re_ex_ch;
		    $data['e_pay_thesis_ch'] = $edit->pay_thesis_ch;
		    $data['e_pay_certificate_ch'] = $edit->pay_certificate_ch;

		    $data['on_disp_fee_r'] = ($e_exchange_r * $e_fee);
		    $data['on_disp_fee_b'] = ($e_exchange_b * $e_fee);

		    $data['e_scholarship_id'] = $edit->scholarship_from;

		    $data['e_scho_paid'] = $e_scho;
		    $data['e_scho_paid_fee_d'] = (($e_fee*$e_scho)/100);
		    $data['e_scho_paid_fee_r'] = (($e_fee*$e_scho)/100) * $e_exchange_r;
		    $data['e_scho_paid_fee_b'] = ((($e_fee*$e_scho)/100)* $e_exchange_b);
		    // percent
		    $e_paid = 100 - floatval($e_scho);
		    $data['e_disp_stu_paid'] = $e_paid;
		    $data['e_stu_self_paid_d'] = (($e_fee*$e_paid)/100);
		    $data['e_stu_self_paid_r'] = (($e_fee*$e_paid)/100) * $e_exchange_r;
		    $data['e_stu_self_paid_b'] = (($e_fee*$e_paid)/100) * $e_exchange_r;

		// $data['manage_result_sco_pre'] = manage_table_result_sco_pre($get_result_pre,$this);
		$data['view_stu_payment_info'] = get_view_stu_payment_info($get_list_stu_payment,$this);
		$this->load->view('faculty/fee_collection/fee_payment',$data);
	}






	function fee_print($pay_id){
		$data['controller_name']=strtolower(get_class());
		$data['get_print'] = $this->Fees_collections->get_result_payment($pay_id);
		$this->load->view('faculty/fee_collection/fee_print',$data);
	}
	function fee_print_list($pay_id){
		$data['controller_name']=strtolower(get_class());
		$data['get_print'] = $this->Fees_collections->get_result_payment($pay_id);
		$this->load->view('faculty/fee_collection/fee_print_list',$data);
	}
	function suggest_code_major(){
		session_write_close();
		$view_suggestions = $this->Fees_collections->get_code_major_suggestions($this->input->get('term'),100);
		echo json_encode($view_suggestions);
	}
	function get(){
		$get_id = $_POST["id"];
		$q_skill = $this->Fees_collections->get_skill_by_id($get_id);
		echo $q_skill->row()->skill_major_code;
	}
	function search_student(){
		$data['controller_name']=strtolower(get_class());
		$post = $this->input->post();		
		$this->session->set_userdata('ss_fee_collection', $post);

		$data['major'] = $this->opt_selection_major();
		$data['degrees'] = $this->opt_degrees();
		$data['batches'] = $this->opt_batches();
		$data['period'] = $this->opt_grade();
		$data['year'] = $this->opt_section();
		$data['scholarship'] = $this->opt_scholarship();
		$data['v_post'] = $post;

		$q_search_stu = $this->Fees_collections->get_search_students($post, $search);
		$data['manage_table'] = get_fees_collection_manage_table($q_search_stu,$this);

		$this->load->view('faculty/fee_collection/manage',$data);
	}

	function search(){
		$term = $this->input->post('search');
		if(!empty($term)){
			$search = "(edu_stu_info.stu_last_name ='{$term}' OR edu_stu_info.stu_first_name ='{$term}')";
		}
		$post = $this->session->userdata('ss_fee_collection');	
		$q_search_stu = $this->Fees_collections->get_search_students($post, $search);
		$data['pagination']= "";
		$data['manage_table']= get_fee_manage_table_data_rows($q_search_stu,$this);
		echo json_encode(array('manage_table' => $data['manage_table'], 'pagination' => $data['pagination']));
	}
	function suggest(){
		session_write_close();
		$ss_fee_collection = $this->session->userdata('ss_fee_collection');		
		$view_suggestions = $this->Fees_collections->get_suggest($ss_fee_collection,$this->input->get('term'),100);
		echo json_encode($view_suggestions);
	}

	function clear_state()
	{
			$this->session->unset_userdata('major_id');
			$this->session->unset_userdata('batch');
			$this->session->unset_userdata('year');
			$this->session->unset_userdata('period');
			$this->session->unset_userdata('degree');
		redirect('fees_collection');
	}


	function save_payment($stu_id='',$fee_cate_id){
		$this->check_action_permission('add_update');
		$logged_in_info = $this->Employee->get_logged_in_employee_info();

		$p = $this->input->post();
		$data_payment = array('pay_scholarship_id' => ($p['scholarship_id'] !== null)? $p['scholarship_id'] : 0,
								'pay_scholarship_percent' => $p['scholarship_percent'],
								'pay_stu_acad_id' => $p['pay_stu_acad_id'],
								
								'pay_other_fees' => $p['hbox_other_fee'],								
								'times_per_re_ex' => $p['times_per_re_ex'],
								
								'pay_pre_enter_exam' => $p['hbox_pre_enter_exam'],
								'pay_final_exam' => $p['hbox_final_exam'],
								'pay_re_exam' => $p['hbox_re_exam_fee'],
								'pay_thesis' => $p['hbox_thesis_fee'],
								'pay_certificate' => $p['hbox_certificate_fee'],
								'pay_amount_fee' => $p['e_pay_amount_fee'],

								'pay_other_ch' => $p['e_other_ch'],
								'pay_pre_ex_ch' => $p['e_pre_ex_ch'],
								'pay_final_ch' => $p['e_final_ch'],
								'pay_re_ex_ch' => $p['e_re_ex_ch'],
								'pay_thesis_ch' => $p['e_thesis_ch'],
								'pay_certificate_ch' => $p['e_certificate_ch'],

								'pay_ex_rate' => $p['exchange_dollar'],
								'pay_ex_baht' => $p['exchange_baht'],
								'pay_vat' => $p['vat'],
								'pay_penalty' => $p['penalty'],
								'pay_thesis_group_fee' => $p['thesis_group_fee'],
								'pay_discount' => $p['discount'],
								'pay_debt' => $p['debt'],
								'pay_grand_total' => $p['pay_grand_total_d'],
								'pay_stu_id' => $stu_id,
								'pay_set_fee_id' => $fee_cate_id,
								'pay_stu_unique_id' => $p['stu_unique_id'],

								'pay_grand_total_word' => $p['grand_total_word'],
								'pay_currency' => $p['currency'],
								'pay_payment_method' => $p['payment_method'],

								'pay_schedule_three' => $p['schedule_three'],
								'pay_schedule_six' => $p['schedule_six'],
								'pay_schedule_twelve' => $p['schedule_twelve'],
								'pay_schedule_month' => $p['persent_schedule_pay_month'],

								'pay_schedule' => $p['schedule'],
								'pay_date' => date_format(date_create($p['pay_date']),"Y-m-d"),
								'pay_description' => $p['description'],
							);		

		if ($fee_cate_id == 0) {
			$data_payment['created_at'] = date('Y-m-d H:i:s');
			$data_payment['created_by'] = $logged_in_info->person_id;
		} else {
			$data_payment['updated_at'] = date('Y-m-d H:i:s');
			$data_payment['updated_by'] = $logged_in_info->person_id;
		}

		if($stu_id !== '' or $stu_id >= 0){
			if ($this->Fees_collections->save_payments($data_payment,$fee_cate_id)) {
				if($fee_cate_id== 0)
				{
					$success_message = lang('students_successful_adding') . ' ' . $data_payment['pay_stu_unique_id'];
				echo json_encode(array('success' => true, 'message' => $success_message, 'stu_info_id' => $data_payment['pay_stu_id']));
				}else{
					$success_message = lang('students_successful_updating').' '.$data_payment['pay_stu_unique_id'];
					echo json_encode(array('success'=>true,'message'=>$success_message,'stu_info_id'=>$data_payment['pay_stu_id']));
				}			
				
			} else {
				echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .$data_payment['pay_stu_unique_id']));
			}
		}else{
			echo json_encode(array('success' => false, 'message' => lang('students_error_adding_updating_address') . ' ' .$data_payment['pay_stu_unique_id']));
		}
		
	}
	function delete_payment_stu(){
		$pay_stu_id = $this->input->post('stu_id');
		$pay_id = $this->input->post('pay_id');
		if($this->Fees_collections->delete_payment_stu($pay_stu_id,$pay_id)){
			redirect(site_url("fees_collection/fee_payment_transaction/$pay_stu_id"));
			echo 'ok';
		}
	}
}