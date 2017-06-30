<?php
require_once ("secure_area.php");
class Report_professors extends Secure_area 
{
	function index($offset=0){
		$data['controller_name']=strtolower(get_class());
		// $data['manage_table']=get_items_report_manage_table($table_data,$this,$current);	
		$data['month'] = $this->selection_month();
		$data['select_major'] = $this->selection_major();
		$data['select_faculty'] = $this->selection_faculty();
		
		$data['selection_table_type'] = array('table_list' => 'Table List View',
												'table_summery' => 'Table Summery');
		$this->load->view('reports/report_prof/manage',$data);
	}
	function search_report(){
		$data['controller_name']=strtolower(get_class());
		$data['month'] = $this->selection_month();	
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

		$data['mainTitle']= 'Professor View Reports';
		$data['main_title_skill'] = $this->Major_model->get_byId($this->inputPost('major'))->row()->skill_name;
		$data['main_title_university'] = $this->Universities->get_byId($this->inputPost('faculty'))->row()->university_name;		
		$data['main_title_date'] = $data['fromMonth'].' - '.$data['toMonth'];
		
		if($data['fromMonth'] <= $data['toMonth']){
			if($data['table_type'] == 'table_list'){

				$report_prof = $this->Reports_model->get_professor_info($post);
				$data['manage_table'] = rep_prof($report_prof, $this);
				if($submit == 'Search'){
					$this->load->view('reports/report_prof/manage',$data);
				}elseif($submit == 'Print'){
					$this->load->view('reports/report_prof/manage_prof_excel',$data);
				}

			}elseif($data['table_type'] == 'table_summery'){

				$count_prof = $this->Reports_model->get_professor_info_summery($post);
				$data['manage_table'] = rep_prof_summary($count_prof, $this);
				if($submit == 'Search'){
					$this->load->view('reports/report_prof/manage',$data);
				}elseif($submit == 'Print'){
					$this->load->view('reports/report_prof/manage_prof_excel_summery',$data);
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
		redirect('report_professor');
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

	function selection_month(){
		return array('1' => 'January','2' => 'Febuary','3' => 'March','4' => 'April','5' => 'May','6' => 'June','7' => 'July','8' => 'August','9' => 'September','10' => 'October','11' => 'November','12' => 'December');
	}

}