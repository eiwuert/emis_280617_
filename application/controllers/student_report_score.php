<?php
require_once ("secure_area.php");
class Student_report_score extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->check_action_permission('search');	
		$data['select_major'] = $this->opt_selection_major();
		$data['select_faculty'] = $this->opt_selection_faculty();
		$data['select_degree'] = $this->opt_degrees();
		$data['select_batch'] = $this->opt_batches();
		$data['selection_section'] = $this->opt_section();
		$data['selection_class'] = $this->opt_class();
		$data['selection_room'] = $this->opt_room();
		$data['selection_subject'] = $this->opt_subject();
		$data['selection_grade'] = $this->opt_grade();
		$data['selection_semester'] = $this->opt_semester();
		$this->load->view('reports/stu_report_score/manage',$data);
	}
	function search_report(){
		$data['controller_name']=strtolower(get_class());
		$this->check_action_permission('search');

		$data['select_major'] = $this->opt_selection_major();
		$data['select_faculty'] = $this->opt_selection_faculty();
		$data['select_degree'] = $this->opt_degrees();
		$data['select_batch'] = $this->opt_batches();
		$data['selection_section'] = $this->opt_section();
		$data['selection_class'] = $this->opt_class();
		$data['selection_room'] = $this->opt_room();
		$data['selection_subject'] = $this->opt_subject();
		$data['selection_grade'] = $this->opt_grade();
		$data['selection_semester'] = $this->opt_semester();	

		$post = $this->input->post();
		$data['post'] = $post;

		$data['main_title_skill'] = $this->Major_model->get_byId($post['major'])->row()->skill_name;
		$data['main_title_university'] = $this->Universities->get_byId($post['faculty'])->row()->university_name;		
		$data['main_title_batch'] = $this->Batch->get_info($post['batch'])->batch_name;
		$data['main_title_degree'] = $this->Levels->get_info($post['degree'])->level_name;
		$data['main_title_semester'] = $post['semester'];
		$data['main_title_grade'] = $this->Grades->get_info($post['grade'])->grade_name;
		$data['main_title_academic_year'] = $this->Section->get_byId($post['section'])->row()->section_name;		
		$data['main_title_class'] = $this->School_class_model->get_byId($post['class'])->row()->school_class_name;		
		$data['main_title_room'] = $this->Rooms->get_byId($post['room'])->row()->room_name;		
		if(!empty($post['subject'])){
			$data['main_title_subject'] = $this->Subject->get_info($post['subject'])->subject_name;		
		}else{
			$data['main_title_subject'] = 'All';
		}

		$data['mainTitle'] = "Student Score Report";
		$query = $this->Reports_model->get_info_stu_score($post);
		$data['manage_table'] = rep_student_score($query, $this);

		if($post['submit'] == 'Search'){
			$this->load->view('reports/stu_report_score/manage',$data);
		}elseif($post['submit'] == 'Print Excel'){
			$this->load->view('reports/stu_report_score/print_report',$data);
		}


			// if($data['v_type'] == 0){ //v = 0 stu info
				
			// 		if($post['table_type'] == 'table_list'){
			// 			$data['mainTitle'] = "Student Report";
			// 			$query = $this->Reports_model->search_student_report($post);
			// 			$data['manage_table'] = rep_student($query, $this);
			// 		}elseif($post['table_type'] == 'table_summery'){
			// 			$data['mainTitle'] = "Student Summery";
			// 			$query = $this->Reports_model->search_student_report_summery($post);
			// 			$data['manage_table'] = rep_student_summery($query, $this);
			// 		}					
			// 		if($post['submit'] == 'Search'){
			// 			$this->load->view('reports/stu_report_score/manage',$data);
			// 		}elseif($post['submit'] == 'Print'){
			// 			if($post['table_type'] == 'table_list'){
			// 				$this->load->view('reports/stu_report_score/print_report',$data);
			// 			}elseif($post['table_type'] == 'table_summery'){
			// 				$this->load->view('reports/stu_report_score/print_sumery',$data);
			// 			}
			// 		}

			// }elseif($data['v_type'] == 1){ //v = 1 payment
				
			// 		if($post['table_type'] == 'table_list'){						
			// 			$data['mainTitle'] = "Student Payment Report";
			// 			$query = $this->Reports_model->search_student_pay_report($post);
			// 			$data['manage_table'] = rep_pay_student($query, $this);
			// 		}elseif($post['table_type'] == 'table_summery'){
			// 			$data['mainTitle'] = "Student Summery";
			// 			$query = $this->Reports_model->search_student_pay_report_summery($post);						
			// 			$data['manage_table'] = rep_pay_student_summery($query, $this);
			// 		}
					
			// 		if($post['submit'] == 'Search'){
			// 			$this->load->view('reports/stu_report_score/manage',$data);
			// 		}elseif($post['submit'] == 'Print'){
			// 			if($post['table_type'] == 'table_list'){
			// 				$this->load->view('reports/stu_report_score/print_payment_report',$data);
			// 			}elseif($post['table_type'] == 'table_summery'){
			// 				$this->load->view('reports/stu_report_score/print_payment_summery',$data);
			// 			}
			// 		}
			// }
	}
	function suggest_major(){
		$id = $this->input->post('id');	
		$query = array();
        $query = $this->Reports_model->suggest_major($id)->result();
        echo json_encode($query);
	}
	function suggest_subject(){
		$major = $this->input->post('major');
		$grade = $this->input->post('grade');
		$semester = $this->input->post('semester');
        $query = $this->Reports_model->suggest_subject($major, $grade, $semester)->result();
        echo json_encode($query);
	}
	function suggest_faculty(){
		$id = $this->input->post('id');	
        $query = $this->Reports_model->suggest_faculty($id)->row();
        echo $query->university_id;
	}
	
	function clear_state()
	{
		redirect('student_report');
	}		
}
