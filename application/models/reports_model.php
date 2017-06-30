<?php
class Reports_model extends CI_Model
{
	function get_employees_info($post, $gender='', $eYM){
		$exstra = '';	
		if($post['table_type'] == 'table_list'){				
			if(!empty($post['major'])){
				$exstra.=" AND edu_emp_major_person.major_id = {$post['major']}";
			}

			if(!empty($post['from_month']) && !empty($post['to_month'])){
				$exstra.=" AND DATE_FORMAT(edu_people.joined_date,'%Y%-%m') BETWEEN '{$post['from_month']}' AND '{$post['to_month']}'";
			}

		}elseif($post['table_type'] == 'table_summery'){			
			if(!empty($gender)){
				$exstra.=" AND edu_people.gender = '{$gender}'";
			}
			if(!empty($eYM)){
				$exstra.=" AND DATE_FORMAT(edu_people.expired_date,'%Y%-%m') >= '{$eYM}'";
			}
		}	

		$employees=$this->db->dbprefix('employees');
		$emp_info=$this->db->dbprefix('emp_info');
		$people=$this->db->dbprefix('people');
		$levels=$this->db->dbprefix('levels');
        $user_type = $this->db->dbprefix('user_type');
        $emp_master = $this->db->dbprefix('emp_master');
        $skill = $this->db->dbprefix('skill');
        $university = $this->db->dbprefix('university');
        $emp_major_person = $this->db->dbprefix('emp_major_person');
		$data=$this->db->query("SELECT ".$people.".first_name,
										".$people.".last_name,
										".$people.".first_name_kh,
										".$people.".last_name_kh,
										".$people.".gender,
										".$people.".dob,
										".$people.".joined_date,
										".$people.".expired_date,
										".$skill.".skill_name,
										".$university.".university_name
								FROM ".$people."
								STRAIGHT_JOIN ".$employees." ON 
								".$people.".person_id = ".$employees.".person_id 
								INNER JOIN ".$user_type." ON 
								".$employees.".user_type_id = ".$user_type.".user_type_id 
								INNER JOIN ".$emp_master." ON  ".$emp_master.".emp_master_user_id = ".$people.".person_id
								LEFT JOIN ".$emp_info." ON ".$emp_info.".emp_info_id = ".$emp_master.".emp_master_emp_info_id
								LEFT JOIN ".$levels." ON ".$levels.".level_id = ".$people.".degree_level
								LEFT JOIN ".$emp_major_person." ON ".$emp_major_person.".person_id = ".$people.".person_id
								LEFT JOIN ".$skill." ON ".$skill.".skill_id = ".$emp_major_person.".major_id
								LEFT JOIN ".$university." ON ".$university.".university_id = ".$skill.".faculty_id
								WHERE  ".$employees.".user_type_id  IN (1, 2, 3, 4, 5, 6, 7, 8, 9)
								AND  deleted =0 {$exstra} GROUP BY ".$people.".person_id");
		return $data;
	}

	function get_employees_info_summery($post){
		$date1 = $post['from_month'];
		$date2 = $post['to_month'];
		$output = [];
		$time   = strtotime($date1);
		$last   = date('Y-m', strtotime($date2));
		do {
		    $ym = date('Y-m', $time);
		    $m = date('m', $time);
		    $y = date('Y', $time);
		    $output[] = [ 'ym' => $ym,
			        		'm' => $m,
			        		'y' => $y ];
		    $time = strtotime('+1 month', $time);
		} while ($ym != $last);

		for ($i=0; $i < count($output) ; $i++) {
				$eYM = $output[$i]['ym'];
				$eM = $output[$i]['m'];
				$eY = $output[$i]['y'];
				$get_m = date_format(date_create($eYM),"F");
				$result_m = $this->get_employees_info($post, $gender='M', $eYM)->num_rows();
				$result_f = $this->get_employees_info($post, $gender='F', $eYM)->num_rows();
				$total_emp = ($result_m + $result_f);
				$emp_each_month[] = array('month' => $get_m.'-'.$eY, 'count_m_emp' => $result_m, 'count_f_emp' => $result_f, 'total_emp'=>$total_emp);
		}
		return $emp_each_month;
	}



	function get_professor_info($post, $gender='', $eYM){
		$exstra = '';	
		if($post['table_type'] == 'table_list'){					
			if(!empty($post['major'])){
				$exstra.=" AND edu_emp_major_person.major_id = {$post['major']}";
			}

			if(!empty($post['from_month']) && !empty($post['to_month'])){
				$exstra.=" AND DATE_FORMAT(edu_people.joined_date,'%Y%-%m') BETWEEN '{$post['from_month']}' AND '{$post['to_month']}'";
			}

		}elseif($post['table_type'] == 'table_summery'){			
			if(!empty($gender)){
				$exstra.=" AND edu_people.gender = '{$gender}'";
			}
			if(!empty($eYM)){
				$exstra.=" AND DATE_FORMAT(edu_people.expired_date,'%Y%-%m') >= '{$eYM}'";
			}
		}

		$employees = $this->db->dbprefix('employees');
		$emp_info=$this->db->dbprefix('emp_info');
		$people = $this->db->dbprefix('people');		
		$levels=$this->db->dbprefix('levels');
		$user_type = $this->db->dbprefix('user_type');
		$emp_master = $this->db->dbprefix('emp_master');
        $emp_major_person = $this->db->dbprefix('emp_major_person');
		$data = $this->db->query("SELECT * 
					FROM ".$people."
					STRAIGHT_JOIN ".$employees." ON 
					".$people.".person_id = ".$employees.".person_id 
					INNER JOIN ".$emp_master." ON 
						".$emp_master.".emp_master_user_id = ".$people.".person_id
					LEFT JOIN ".$emp_info." ON ".$emp_info.".emp_info_id = ".$emp_master.".emp_master_emp_info_id
					LEFT JOIN ".$levels." ON ".$levels.".level_id = ".$people.".degree_level
					LEFT JOIN ".$emp_major_person." ON ".$emp_major_person.".person_id = ".$people.".person_id
					WHERE  ".$employees.".user_type_id  IN (10) and  deleted =0 {$exstra} GROUP BY ".$people.".person_id");
		return $data;
	}

	function get_professor_info_summery($post){
		$date1 = $post['from_month'];
		$date2 = $post['to_month'];
		$output = [];
		$time   = strtotime($date1);
		$last   = date('Y-m', strtotime($date2));
		do {
		    $ym = date('Y-m', $time);
		    $m = date('m', $time);
		    $y = date('Y', $time);
		    $output[] = [ 'ym' => $ym,
			        		'm' => $m,
			        		'y' => $y ];
		    $time = strtotime('+1 month', $time);
		} while ($ym != $last);

		$emp_each_month = array();
		for ($i=0; $i < count($output) ; $i++) {
				$eYM = $output[$i]['ym'];
				$eM = $output[$i]['m'];
				$eY = $output[$i]['y'];
				$get_m = date_format(date_create($eYM),"F");
				$result_m = $this->get_professor_info($post, $gender='M', $eYM)->num_rows();
				$result_f = $this->get_professor_info($post, $gender='F', $eYM)->num_rows();
				$total = ($result_m + $result_f);
				$emp_each_month[] = array('month' => $get_m.'-'.$eY, 'count_m_prof' => $result_m, 'count_f_prof' => $result_f, 'total_prof'=>$total);
		}
		return $emp_each_month;
	}

				function stu_enrolled($f_dateFrom, $f_dateTo, $major){
					$qurey = $this->db->select('stu_info.stu_unique_id,
											stu_info.stu_last_name,
											stu_info.stu_first_name,
											edu_stu_info.stu_email_id,
											edu_stu_info.stu_mobile_no,
											stu_master.stu_master_id,
											stu_academic.stu_acad_id,
											skill.skill_id,
											skill.skill_name,
											stu_academic.stu_acad_admission_date,
											stu_info.stu_gender')
									->join('stu_info','stu_info.stu_info_id = stu_master.stu_master_stu_info_id','left')
									->join('stu_academic','stu_academic.stu_acad_stu_info_id = stu_info.stu_info_id','left')
									->join('skill','skill.skill_id = stu_academic.stu_acad_skill_id','left')
									->where('skill.skill_id',5)
									->where("stu_academic.stu_acad_admission_date BETWEEN '2017-01-13' AND '2019-01-13'")
									->group_by('stu_info.stu_info_id')->get('stu_master');
					return $qurey;
				}
				function suggest_major($faculty_id){
					return $this->db->where('is_status',0)->where('faculty_id',$faculty_id)->get('skill');
				}
				function suggest_faculty($major_id){
					return $this->db->join('university','university.university_id = skill.faculty_id','left')->where('university.is_status',0)->where('skill_id',$major_id)->get('skill');
				}
				function suggest_subject($major, $grade, $semester){
					return $this->db->join("subject_major","subject_major.subject_id = subjects.sub_id","left")
									->join("subject_level_year","subject_level_year.subject_id = subjects.sub_id","left")
									->join("subject_semester","subject_semester.subject_id = subjects.sub_id","left")
									->where('major_id',$major)->where('level_year',$grade)->where('semester',$semester)->get('subjects');
				}

// search stu_rep xxx
	function search_student_report($post, $gender, $eYM){
		$exstra = '';
		if(!empty($post['faculty'])){ $exstra .= " AND edu_stu_academic.stu_acad_university_id = {$post['faculty']} "; }
		if(!empty($post['major'])){ $exstra .= " AND edu_stu_academic.stu_acad_skill_id = {$post['major']} "; }
		if(!empty($post['degree'])){ $exstra .= " AND edu_stu_academic.stu_acad_level_id = {$post['degree']} "; }
		if(!empty($post['section'])){ $exstra .= " AND edu_stu_academic.stu_acad_section_id = {$post['section']} "; }
		if(!empty($post['class'])){ $exstra .= " AND edu_stu_academic.stu_acad_stu_class = {$post['class']} "; }
		if(!empty($post['room'])){ $exstra .= " AND edu_stu_academic.stu_acad_stu_room = {$post['room']} "; }

		if($post['scholarship'] >= 0){
			$exstra.=" AND edu_stu_academic.stu_acad_scholarship_id = {$post['scholarship']}";		
		}

		if($post['table_type'] == 'table_list'){
			if(!empty($post['from_month']) && !empty($post['to_month'])){
				$exstra.=" AND DATE_FORMAT(edu_stu_master.created_at,'%Y%-%m') BETWEEN '{$post['from_month']}' AND '{$post['to_month']}' ";
			}			
		}
		// 
		if($post['table_type'] == 'table_summery'){
			if(!empty($gender)){
				$exstra.=" AND edu_stu_info.stu_gender = '{$gender}'";
			}
			if(!empty($post['from_month']) && !empty($post['to_month'])){
				$exstra.=" AND DATE_FORMAT(edu_stu_master.created_at,'%Y%-%m') = '{$eYM}'";
			}
		}

		$query = $this->db->query("SELECT edu_stu_academic.stu_acad_id,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_last_name_kh,
									edu_stu_info.stu_first_name_kh,
									edu_stu_info.stu_dob,
									edu_stu_info.stu_gender,
									edu_stu_master.created_at,
									edu_scholarships.scholarship_from
									FROM edu_stu_master
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_info_id = edu_stu_info.stu_info_id
									LEFT JOIN edu_scholarships ON edu_scholarships.scho_id = edu_stu_academic.stu_acad_scholarship_id
									WHERE '1=1' {$exstra}");
		return $query;
	}

	function search_student_report_summery($post){
		$date1 = $post['from_month'];
		$date2 = $post['to_month'];		
		$output = [];
		$time   = strtotime($date1);
		$last   = date('Y-m', strtotime($date2));
		do {
		    $ym = date('Y-m', $time);
		    $m = date('m', $time);
		    $y = date('Y', $time);
		    $output[] = [ 'ym' => $ym,
			        		'm' => $m,
			        		'y' => $y ];
		    $time = strtotime('+1 month', $time);
		} while ($ym != $last);

		$each_month = array();		
		for ($i=0; $i < count($output) ; $i++) {
				$eYM = $output[$i]['ym'];
				$eM = $output[$i]['m'];
				$eY = $output[$i]['y'];
				$get_m = date_format(date_create($eYM),"F");
				$result_1 = $this->search_student_report($post, $gender = 'Male', $eYM)->num_rows();
				$result_2 = $this->search_student_report($post, $gender = 'Female', $eYM)->num_rows();
				$total = ($result_1 + $result_2);
				$each_month[] = array('month' => $get_m.'-'.$eY, 'count_1' => $result_1, 'count_2' => $result_2, 'total'=>$total);
		}
		return $each_month;
	}

	// xxx2
	function search_student_pay_report($post, $schol, $eYM){
		$exstra = '';
		if(!empty($post['major'])){ $exstra .= " AND edu_stu_academic.stu_acad_skill_id = {$post['major']} "; }
		if(!empty($post['degree'])){ $exstra .= " AND edu_stu_academic.stu_acad_level_id = {$post['degree']} "; }
		if(!empty($post['section'])){ $exstra .= "AND edu_stu_academic.stu_acad_section_id = {$post['section']} "; }
		if(!empty($post['class'])){ $exstra .= " AND edu_stu_academic.stu_acad_stu_class = {$post['class']} "; }
		if(!empty($post['room'])){ $exstra .= " AND edu_stu_academic.stu_acad_stu_room = {$post['room']} "; }
		
		if($post['table_type'] == 'table_list'){
			if(!empty($post['from_month']) && !empty($post['to_month'])){
				$exstra.=" AND DATE_FORMAT(edu_fees_payment_student.pay_date,'%Y%-%m') BETWEEN '{$post['from_month']}' AND '{$post['to_month']}' ";
			}
			if($post['scholarship'] >= 0){
				$exstra.=" AND edu_stu_academic.stu_acad_scholarship_id = {$post['scholarship']}";		
			}			
		}
		if($post['table_type'] == 'table_summery'){
			if($schol == 0){
				$exstra.=" AND edu_fees_payment_student.pay_scholarship_id <= 0";
			}if($schol == 1){
				$exstra.=" AND edu_fees_payment_student.pay_scholarship_id > 0";
			}
			if(!empty($post['from_month']) && !empty($post['to_month'])){
				$exstra.=" AND DATE_FORMAT(edu_fees_payment_student.pay_date,'%Y%-%m') = '{$eYM}'";
			}
		}

		$query = $this->db->query("SELECT edu_fees_payment_student.pay_id,
										edu_fees_payment_student.pay_stu_unique_id,
										edu_stu_academic.stu_acad_id,
										edu_stu_info.stu_last_name,
										edu_stu_info.stu_first_name,
										edu_stu_info.stu_last_name_kh,
										edu_stu_info.stu_first_name_kh,
										edu_stu_info.stu_gender,
										edu_scholarships.scholarship_from
									FROM edu_fees_payment_student
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_id = edu_fees_payment_student.pay_stu_acad_id
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_academic.stu_acad_stu_info_id
									LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
									LEFT JOIN edu_university ON edu_university.university_id = edu_stu_academic.stu_acad_university_id
									LEFT JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
									LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
									LEFT JOIN edu_scholarships ON edu_scholarships.scho_id = edu_fees_payment_student.pay_scholarship_id
									WHERE '1=1' {$exstra}");
		return $query;
	}

	function search_student_pay_report_summery($post){
		$date1 = $post['from_month'];
		$date2 = $post['to_month'];		
		$output = [];
		$time   = strtotime($date1);
		$last   = date('Y-m', strtotime($date2));
		do {
		    $ym = date('Y-m', $time);
		    $m = date('m', $time);
		    $y = date('Y', $time);
		    $output[] = ['ym' => $ym, 'm' => $m, 'y' => $y];
		    $time = strtotime('+1 month', $time);
		} while ($ym != $last);

		$each_month = array();
		for ($i=0; $i < count($output) ; $i++) {
				$eYM = $output[$i]['ym'];
				$eM = $output[$i]['m'];
				$eY = $output[$i]['y'];
				$get_m = date_format(date_create($eYM),"F");
				$result_1 = $this->search_student_pay_report($post, $schol = '0', $eYM)->num_rows();
				$result_2 = $this->search_student_pay_report($post, $schol = '1', $eYM)->num_rows();
				$total = ($result_1 + $result_2);
				$each_month[] = array('month' => $get_m.'-'.$eY, 'count_1' => $result_1, 'count_2' => $result_2, 'total'=>$total);

		}
		return $each_month;
	}

	function get_info_stu_score($post){
		$exstra = '';
		if(!empty($post['major'])){ $exstra .= " AND acad.stu_acad_skill_id = {$post['major']} "; }
		if(!empty($post['batch'])){ $exstra .= " AND acad.stu_acad_batch_id = {$post['batch']} "; }
		if(!empty($post['degree'])){ $exstra .= " AND acad.stu_acad_level_id = {$post['degree']} "; }
		if(!empty($post['semester'])){ $exstra .= " AND edu_scores.semester = {$post['semester']} "; }
		if(!empty($post['grade'])){ $exstra .= "AND acad.stu_acad_grade = {$post['grade']} "; }
		if(!empty($post['section'])){ $exstra .= "AND acad.stu_acad_section_id = {$post['section']} "; }
		if(!empty($post['class'])){ $exstra .= " AND acad.stu_acad_stu_class = {$post['class']} "; }
		if(!empty($post['room'])){ $exstra .= " AND acad.stu_acad_stu_room = {$post['room']} "; }
		if(!empty($post['subject'])){ $exstra .= " AND edu_subjects.sub_id = {$post['subject']} "; }
		return $this->db->query("SELECT *
								FROM edu_stu_master
								LEFT JOIN edu_stu_academic AS acad ON acad.stu_acad_stu_master_id = edu_stu_master.stu_master_id
								LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = acad.stu_acad_stu_info_id
								LEFT JOIN edu_scores ON edu_scores.student_final_acad_id = acad.stu_acad_id
								LEFT JOIN edu_subjects ON edu_subjects.sub_id = edu_scores.subject_id
								WHERE '1=1' {$exstra}");
	}
}
