<?php
require_once ("secure_area.php");
class Report_info extends Secure_area 
{
	function index($offset=0){
		$data['controller_name']=strtolower(get_class());
		// $data['manage_table']=get_items_report_manage_table($table_data,$this,$current);	
		$data['select_major'] = $this->selection_major();
		$data['select_faculty'] = $this->selection_faculty();
		$data['selection_type'] = array('employee_info' => 'Employee Info.',
										'professor_info' => 'Professor Info.',
										'student_info' => 'Student Info.',
										'income_student' => 'Income by Students');
		$data['selection_table_type'] = array('table_list' => 'Table List View',
												'table_summery' => 'Table Summery');
		$data['manage_table'] = test();
		$this->load->view('reports/report_info/manage',$data);
	}
	function search_report(){
		$data['controller_name']=strtolower(get_class());
		$data['dateFrom'] = $this->inputPost('date_from');
		$data['dateTo'] = $this->inputPost('date_to');		
		$data['major'] = $this->inputPost('major');		
		$data['faculty'] = $this->inputPost('faculty');	
		$data['type'] = $this->inputPost('selection_type');	
		$data['table_type'] = $this->inputPost('table_type');	
		$submit = $this->inputPost('submit');

		$data['select_major'] = $this->selection_major();
		$data['select_faculty'] = $this->selection_faculty();	

		$f_dateFrom = date_format(date_create($data['dateFrom']),"Y-m-d");
		$f_dateTo = date_format(date_create($data['dateTo']),"Y-m-d");

		$data['selection_type'] = array('employee_info' => 'Employee Info.', 
										'professor_info' => 'Professor Info.', 
										'student_info' => 'Student Info.', 
										'income_student' => 'Income by Students');
		$data['selection_table_type'] = array('table_list' => 'Table List View',
												'table_summery' => 'Table Summery');

		$data['mainTitle']= $data['type'];		


		$list_data = '';
		if($data['type'] == 'employee_info'){
			if($data['table_type'] == 'table_list'){
				$emp_male = $this->Reports_model->empMaleReport_count($data['major'],$data['faculty'],$gender='M');
				$emp_female = $this->Reports_model->empMaleReport_count($data['major'],$data['faculty'],$gender='F');
				$list_data.= manageEmployeeReport($emp_male, $emp_female, $this);
			}elseif($data['table_type'] == 'table_summery'){
				// $list_data.= manageEmployeeReport($emp_male, $emp_female, $this);
				$emp_male = $this->Reports_model->empMaleReport($data['major'],$data['faculty'],$gender='M');
				$emp_female = $this->Reports_model->empMaleReport($data['major'],$data['faculty'],$gender='F');
				echo $this->db->last_query();
				exit();
			}
		}elseif($data['type'] == 'professor_info'){
			$prof_male = $this->Reports_model->empProfReport($data['major'],$data['faculty'],$gender='M');
			$prof_female = $this->Reports_model->empProfReport($data['major'],$data['faculty'],$gender='F');
			$list_data.= manageProfessorReport($prof_male, $prof_female, $this);
		}elseif($data['type'] == 'student_info'){
			$stu_enrolled = $this->Reports_model->stu_enrolled($f_dateFrom,$f_dateTo, $data['major']);
			$list_data.= manageNewInrolledReport($stu_enrolled, $this);	
		}elseif($data['type'] == 'income_student'){
			$stu_enrolled = $this->Reports_model->stu_enrolled($f_dateFrom,$f_dateTo, $data['major']);

		}

		$data['manage_table']= $list_data;
		if($submit == 'Search'){	
			$this->load->view('reports/report_info/manage',$data);
		}elseif($submit == 'Print'){		
			$this->load->view('items/items_report/manage_excel',$data);
		}
	}
	function suggest_major(){
		$id = $this->input->post('id');	
		$query = array();
        $query = $this->Reports_model->suggest_major($id)->result();
        echo json_encode($query);
	}
	function suggest_faculty(){
		$id = $this->input->post('id');	
        $query = $this->Reports_model->suggest_faculty($id)->row();
        echo $query->university_id;
	}
	
	function clear_state()
	{
		redirect('report_info');
	}

	function selection_major(){
		$major = $this->Major_model->get_all()->result();
		$major_temp = ["" => '-- Select Major --'];
		foreach($major as $key => $row) {
			$major_temp[$row->skill_id] =  $row->skill_name;
		}
		return $major_temp;
	}
	function selection_faculty(){
		$faculty = $this->Universities->get_all()->result();
		$faculty_temp = ["" => '-- Select Major --'];
		foreach($faculty as $key => $row) {
			$faculty_temp[$row->university_id] =  $row->university_name;
		}
		return $faculty_temp;
	}

}