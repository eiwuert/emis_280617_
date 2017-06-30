<?php
require_once ("secure_area.php");
class Report_employee extends Secure_area 
{
	function index($offset=0){
		$data['controller_name']=strtolower(get_class());
		$data['select_major'] = $this->selection_major();
		$data['select_faculty'] = $this->selection_faculty();
		
		$data['selection_table_type'] = array('table_list' => 'Table List View',
												'table_summery' => 'Table Summery');
		$this->load->view('reports/report_info/manage',$data);
	}
	function search_report(){
		$data['controller_name']=strtolower(get_class());
		$data['selection_table_type'] = array('table_list' => 'Table List View','table_summery' => 'Table Summery');
		$data['select_major'] = $this->selection_major();
		$data['select_faculty'] = $this->selection_faculty();

		$post = $this->input->post();

		$data['fromMonth'] = $this->inputPost('from_month');
		$data['toMonth'] = $this->inputPost('to_month');
		$data['major'] = $this->inputPost('major');
		$data['faculty'] = $this->inputPost('faculty');
		$data['table_type'] = $this->inputPost('table_type');
		$submit = $this->inputPost('submit');

		$data['mainTitle']= 'Employee View Reports';
		$data['main_title_skill'] = $this->Major_model->get_byId($this->inputPost('major'))->row()->skill_name;
		$data['main_title_university'] = $this->Universities->get_byId($this->inputPost('faculty'))->row()->university_name;		
		$data['main_title_date'] = $data['fromMonth'].' - '.$data['toMonth'];		

		if($data['fromMonth'] <= $data['toMonth']){
			if($data['table_type'] == 'table_list'){
				$report_emp = $this->Reports_model->get_employees_info($post);
				$data['manage_table'] = rep_emp($report_emp, $this);

				if($submit == 'Search'){
					$this->load->view('reports/report_info/manage',$data);
				}elseif($submit == 'Print'){
					$this->load->view('reports/report_info/manage_emp_excel',$data);
				}
			}elseif($data['table_type'] == 'table_summery'){
				$count_emp = $this->Reports_model->get_employees_info_summery($post);
				$data['manage_table'] = rep_emp_summary($count_emp, $this);
				if($submit == 'Search'){
					$this->load->view('reports/report_info/manage',$data);
				}elseif($submit == 'Print'){
					$this->load->view('reports/report_info/manage_emp_excel_summery',$data);
				}
			}
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
		redirect('report_employee');
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