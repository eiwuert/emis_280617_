<?php
require_once ("secure_area.php");
class Iqa_tool extends Secure_area 
{
	function __construct()
	{
		parent::__construct('iqa_tool');
	}

	function index()
	{
		redirect('iqa_tool/view');
	}

	function view($id = -1, $redirect= -1)
	{
		$this->check_action_permission('add_update');
		$data['redirect'] = $redirect;
		$data['controller_name'] = strtolower(get_class());
		$data['iqa_result_info'] = $this->Iqa_model->get_info_iqa_tool($id);
		$data['iqa_titles'] = $this->Iqa_model->get_iqa_result_titles($id);

		$data['employees'] = $this->opt_employee_professor();
		$data['employees_somu'] = $this->opt_employee_professor();		
		$data['accessor_byroom'] = $this->opt_room();		

		$iqa_types = $this->Iqa_model->get_all();
		if($id !== -1){
			// evaluate by employee
			$get_evaluate_by = $this->Iqa_model->get_info_evaluate_by($id)->result();
			$get_info_evaluate_by = array();
			foreach($get_evaluate_by as $row => $key){
				$get_info_evaluate_by[]= $key->evaluate_by_id;
			}
			$data['info_evaluate_by'] = $get_info_evaluate_by;
			// evalute by class
			$get_evaluate_by_room = $this->Iqa_model->get_info_evaluate_by_room($id)->result();
			$get_info_evaluate_by_room = array();
			foreach($get_evaluate_by_room as $row => $key){
				$get_info_evaluate_by_room[]= $key->evaluate_by_id;
			}
			$data['info_evaluate_by_room'] = $get_info_evaluate_by_room;
		}
		$data['iqa_types'] = ['' => '-- Please Select --'];
		if ($iqa_types->num_rows() > 0) {
			foreach ($iqa_types->result() as $key => $iqa) {
				$data['iqa_types'][$iqa->id] = $iqa->name_eng;
			}
		}

		$data['dropEvlFor'] = array('1'=>'By Student', '2'=>'By Employee');

		$this->load->view('iqa/iqa_tool/view', $data);
	}

	function get_iqa_titles()
	{
		$iqa_type_id = $this->input->post('iqa_type_id');
		if($iqa_type_id !== '' || $iqa_type_id > 0){			
			$data['iqa_titles'] = $this->Iqa_model->get_iqa_titles($iqa_type_id);
			$rows = $this->load->view('iqa/iqa_tool/rows', $data, true);
			echo $rows;
		}
	}

	function save($id = -1)
	{
		$this->check_action_permission('add_update');
		$logged_in_employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		$form_data = $this->input->post();
		$iqa_tool = [
			'evaluate_type_id' => $form_data['iqa_type'],
			'evaluate_to' => $form_data['employee'],
			'evaluate_date' => date('Y-m-d', strtotime($form_data['date'])),
			'date_from' => date('Y-m-d', strtotime($form_data['start_date'])),
			'date_to' => date('Y-m-d', strtotime($form_data['end_date'])),
			'description' => $form_data['description']
		];
		if ($id != -1) {
			$iqa_tool['updated_by'] = $logged_in_employee_id;
			$iqa_tool['updated_at'] = date('Y-m-d H:i:s');
			$iqa_tool['evaluate_for'] = $form_data['edit_evaluate_for'];
		} else {
			$iqa_tool['created_by'] = $logged_in_employee_id;
			$iqa_tool['updated_at'] = date('Y-m-d H:i:s');
			$iqa_tool['evaluate_for'] = $form_data['evaluate_for'];
		}
		$iqa_titles = [
			'ids' => $form_data['ids'],
			'title_eng' => $form_data['evaluation_title'],
			'title_kh' => $form_data['evaluation_title_kh'],
			'score' => $form_data['scores']
		];
		if($iqa_tool['evaluate_for'] == 1 || $form_data['edit_evaluate_for'] == 1){
			$evaluate_by = $this->input->post('accessor_by_room');
			$save = $this->Iqa_model->save_iqa_tool_by_room($iqa_tool, $iqa_titles, $id, $evaluate_by);
		}elseif ($iqa_tool['evaluate_for'] == 2 || $form_data['edit_evaluate_for'] == 2) {
			$evaluate_by = $this->input->post('accessor');
			$save = $this->Iqa_model->save_iqa_tool($iqa_tool, $iqa_titles, $id, $evaluate_by);
		}

		if($save){
			//New IQA
			if($id == -1) {
				$message = 'Adding Success';
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$iqa_tool['id']));
			} else { //previous IQA
				$message = 'Updating Success';
				echo json_encode(array('success'=>true,'message'=>$message,'id'=>$id));
			}
		} else { //failure
			$message = "Error";
			echo json_encode(array('success'=>false,'message'=>$message,'id'=>-1));
		}
	}

	function view_employee() {
		$data['controller_name']=strtolower(get_class());

		$this->load->view('iqa/iqa_tool/manage_employee',$data);
	}
	function display() {
		$data['controller_name']=strtolower(get_class());

		$this->load->view('iqa/iqa_tool/display',$data);
	}
}