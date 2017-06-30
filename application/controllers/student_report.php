<?php
require_once ("secure_area.php");
class Student_report extends Secure_area 
{
	function index() {
		$data['controller_name']=strtolower(get_class());
		$this->check_action_permission('search');	
		$data['select_major'] = $this->opt_selection_major();
		$data['select_faculty'] = $this->opt_selection_faculty();
		$data['select_degree'] = $this->opt_degrees();
		$data['selection_table_type'] = $this->opt_table_type();
		$data['selection_section'] = $this->opt_section();
		$data['selection_class'] = $this->opt_class();
		$data['selection_room'] = $this->opt_room();
		$data['selection_scholarship'] = $this->opt_scholarship_search();
		$data['selection_type'] = $this->opt_select_type();
		$this->load->view('reports/stu_report/manage',$data);
	}

	function search_report(){		
		$data['controller_name']=strtolower(get_class());
		$data['select_major'] = $this->opt_selection_major();
		$data['select_faculty'] = $this->opt_selection_faculty();
		$data['select_degree'] = $this->opt_degrees();
		$data['selection_table_type'] = $this->opt_table_type();
		$data['selection_section'] = $this->opt_section();
		$data['selection_class'] = $this->opt_class();
		$data['selection_room'] = $this->opt_room();		
		$data['selection_scholarship'] = $this->opt_scholarship_search();
		$data['selection_type'] = $this->opt_select_type();

		$post = $this->input->post();
		$data['fromMonth'] = $post['from_month'];
		$data['toMonth'] = $post['to_month'];
		$data['v_type'] = $post['type'];
		$data['v_faculty'] = $post['faculty'];
		$data['v_major'] = $post['major'];
		$data['v_degree'] = $post['degree'];
		$data['v_section'] = $post['section'];
		$data['v_class'] = $post['class'];
		$data['v_room'] = $post['room'];
		$data['v_scholarship'] = $post['scholarship'];
		$data['v_table_type'] = $post['table_type'];

		$data['main_title_skill'] = $this->Major_model->get_byId($post['major'])->row()->skill_name;
		$data['main_title_university'] = $this->Universities->get_byId($post['faculty'])->row()->university_name;		
		$data['main_title_academic_year'] = $this->Section->get_byId($post['section'])->row()->section_name;		
		$data['main_title_scholarship'] = $this->Scholarships->get_info($post['scholarship'])->scholarship_from;		
		$data['main_title_class'] = $this->School_class_model->get_byId($post['class'])->row()->school_class_name;		
		$data['main_title_room'] = $this->Rooms->get_byId($post['room'])->row()->room_name;		
		$data['main_title_date'] = $data['fromMonth'].' - '.$data['toMonth'];

		if($data['fromMonth'] <= $data['toMonth']){
			if($data['v_type'] == 0){ //v = 0 stu info
				
					if($post['table_type'] == 'table_list'){
						$data['mainTitle'] = "Student Report";
						$query = $this->Reports_model->search_student_report($post);
						$data['manage_table'] = rep_student($query, $this);
					}elseif($post['table_type'] == 'table_summery'){
						$data['mainTitle'] = "Student Summery";
						$query = $this->Reports_model->search_student_report_summery($post);
						$data['manage_table'] = rep_student_summery($query, $this);
					}					
					if($post['submit'] == 'Search'){
						$this->load->view('reports/stu_report/manage',$data);
					}elseif($post['submit'] == 'Print'){
						if($post['table_type'] == 'table_list'){
							$this->load->view('reports/stu_report/print_report',$data);
						}elseif($post['table_type'] == 'table_summery'){
							$this->load->view('reports/stu_report/print_sumery',$data);
						}
					}

			}elseif($data['v_type'] == 1){ //v = 1 payment
				
					if($post['table_type'] == 'table_list'){						
						$data['mainTitle'] = "Student Payment Report";
						$query = $this->Reports_model->search_student_pay_report($post);
						$data['manage_table'] = rep_pay_student($query, $this);
					}elseif($post['table_type'] == 'table_summery'){
						$data['mainTitle'] = "Student Summery";
						$query = $this->Reports_model->search_student_pay_report_summery($post);						
						$data['manage_table'] = rep_pay_student_summery($query, $this);
					}
					
					if($post['submit'] == 'Search'){
						$this->load->view('reports/stu_report/manage',$data);
					}elseif($post['submit'] == 'Print'){
						if($post['table_type'] == 'table_list'){
							$this->load->view('reports/stu_report/print_payment_report',$data);
						}elseif($post['table_type'] == 'table_summery'){
							$this->load->view('reports/stu_report/print_payment_summery',$data);
						}
					}
			}
		}else{
			redirect(site_url('student_report'));
		}
	}





	function clear_state()
	{
		redirect('student_report');
	}		
}
