<?php
class Student_card_model extends Person
{	
	function get_search_students($major_id, $batch, $year, $period, $degree_id,  $semester, $schedule, $room, $search){
		$exstra = '';
		if($major_id !== ''){ $exstra.= " AND edu_stu_academic.stu_acad_skill_id = {$major_id}"; }
		if($year !== ''){ $exstra.= " AND edu_stu_academic.stu_acad_section_id = {$year}"; }
		if($batch !== ''){ $exstra.= " AND edu_stu_academic.stu_acad_batch_id = {$batch}"; }
		if($period !== ''){ $exstra.= " AND edu_stu_academic.stu_acad_grade = {$period}"; }
		if($degree_id !== ''){ $exstra.= " AND edu_stu_academic.stu_acad_level_id = {$degree_id}"; }
		if($semester !== ''){ $exstra.= " AND edu_courses.course_schedule_semester = {$semester}"; }
		if($schedule !== ''){ $exstra.= " AND edu_stu_academic.stu_acad_schedule_id = {$schedule}"; }
		if($room !== ''){ $exstra.= " AND edu_stu_academic.stu_acad_stu_room = {$room}"; }
		if($search !== ''){ $exstra.= " AND edu_stu_info.stu_first_name  = '{$search}'"; }

		$query = $this->db->query("SELECT edu_stu_info.stu_info_id,
									edu_stu_info.stu_unique_id,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_middle_name,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_gender,
									edu_stu_info.students_grade,
									edu_stu_master.stu_master_id,
									edu_skill.skill_name,
									edu_skill.skill_major_code,
									edu_section.section_name,
									edu_batches.batch_name,
									edu_grade.grade_name,
									edu_levels.level_name,
									edu_courses.course_name,
									edu_courses.course_schedule_semester,
									edu_stu_academic.stu_acad_id,
									edu_stu_academic.stu_acad_schedule_id,
									edu_stu_academic.stu_acad_stu_room
									FROM
									edu_stu_master
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
									LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
									LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
									INNER JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
									INNER JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
									INNER JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
									INNER JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
								WHERE edu_stu_master.is_status = 0 {$exstra}");
		return $query;
	}

	function get_code_major_suggestions($search,$limit=25){

		$suggestions = array();

		$this->db->from('skill');
		$this->db->like('skill_major_code', $search);
		$this->db->where('is_status',0);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = array('label' => $row->skill_major_code,'label_id' => $row->skill_id);
		}
		
		// sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion['label'], 'label_id'=> $temp_suggestion['label_id']);		
		}
		
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;
	}

	function suggestions_score_stu_search($search,$limit=25,$sug_data){
		$suggestions = array();

		$this->db->from('stu_info');
		$this->db->where('edu_stu_master.is_status',0);
		$this->db->where("(stu_first_name LIKE '%".$this->db->escape_like_str($search)."%'
			OR stu_last_name LIKE '%".$this->db->escape_like_str($search)."%')");
		if(!empty($sug_data['major_id'])){ $this->db->where('edu_courses.skill_major_id',$sug_data['major_id']);}
		if(!empty($sug_data['batch'])){ $this->db->where('edu_stu_master.stu_master_batch_id',$sug_data['batch']);}
		// if(!empty($sug_data['year'])){ $this->db->where('edu_stu_master.stu_master_batch_id',$sug_data['year']);}
		if(!empty($sug_data['period'])){ $this->db->where('edu_courses.duration',$sug_data['period']);}
		if(!empty($sug_data['degree_id'])){ $this->db->where('edu_courses.level_id',$sug_data['degree_id']);}

		$this->db->join('edu_stu_master','edu_stu_master.stu_master_stu_info_id = edu_stu_info.stu_info_id AND edu_stu_info.stu_info_stu_master_id = edu_stu_master.stu_master_id','left');
		$this->db->join('edu_batches','edu_stu_master.stu_master_batch_id = edu_batches.batch_id','left');
		$this->db->join('edu_stu_academic','edu_stu_master.stu_master_user_id = edu_stu_academic.stu_acad_id','left');
		$this->db->join('edu_courses','edu_batches.batch_course_id = edu_courses.course_id AND edu_stu_academic.stu_acad_course_detail_id = edu_courses.course_id','left');
		$this->db->join('edu_skill','edu_courses.skill_major_id = edu_skill.skill_id','left');
		$this->db->join('edu_levels','edu_courses.level_id = edu_levels.level_id','left');

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->stu_first_name;
		}
		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}
		
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;
	}

	function get_skill_by_id($get_id)
	{
		$query = $this->db
					->where('skill_id',$get_id)
		            ->where("is_status", 0)
		            ->get('skill');
		return $query;
	}

	// function get_all_skills()
	// {
	// 	$query = $this->db
	// 	            ->where("is_status", 0)
	// 	            ->get('skill');
	// 	return $query->result();
	// }

	// function get_all_degree()
	// {
	// 	$query = $this->db
	// 	            ->where("is_status", 0)
	// 	            ->get('levels');
	// 	return $query->result();
	// }

	// function get_all_batch()
	// {
	// 	$query = $this->db
	// 	            ->where("is_status", 0)
	// 	            ->get('batches');
	// 	return $query->result();
	// }

	function get_all_section()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('section');
		return $query->result();
	}


	function query_student_card($id){
		$q_stu = $this->db->query("SELECT edu_stu_info.stu_info_id,
							edu_stu_info.stu_unique_id,
							edu_stu_info.stu_first_name,
							edu_stu_info.stu_first_name_kh,
							edu_stu_info.stu_middle_name,
							edu_stu_info.stu_last_name,
							edu_stu_info.stu_last_name_kh,
							edu_stu_info.profile_img,
							edu_stu_info.stu_gender,
							edu_stu_info.stu_dob,
							edu_stu_info.profile_img,
							edu_stu_info.students_grade,
							edu_stu_master.stu_master_id,
							edu_skill.skill_name,
							edu_skill.skill_name_kh,
							edu_skill.skill_major_code,
							edu_section.section_name,
							edu_batches.batch_name,
							edu_grade.grade_name,
							edu_levels.level_id,
							edu_levels.level_name,
							edu_levels.level_name_kh,
							edu_courses.course_name,
							edu_courses.course_schedule_semester,
							edu_stu_academic.stu_acad_id,
							edu_stu_academic.stu_acad_stu_acad_card,
							edu_stu_academic.stu_acad_schedule_id,
							edu_stu_academic.stu_acad_stu_room,
							edu_nationality.nationality_name,
							edu_nationality.nationality_name_kh,
							edu_university.university_name,
							edu_university.card_color_type
							FROM
							edu_stu_master
							LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
							LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
							LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
							LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
							INNER JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
							INNER JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
							INNER JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
							INNER JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
							INNER JOIN edu_nationality ON edu_nationality.nationality_id = edu_stu_info.stu_nationality_id
							INNER JOIN edu_university ON edu_university.university_id = edu_stu_academic.stu_acad_university_id
						WHERE edu_stu_master.is_status = 0 AND edu_stu_academic.stu_acad_id IN ({$id})");

		return $q_stu;
	}

	function get_level_student($stu_info_id, $skill_id){	
		$q = $this->db->where('student_skill_id',$skill_id)->where('student_id',$stu_info_id)->group_by('student_grade')->order_by('student_grade','ASC')->get('edu_scores');
		return $q;		
	}

	function get_student_subject1($student_id, $student_skill_id,​ $student_grade){
		$q = $this->db->where('student_skill_id',$student_skill_id)->where('student_id',$student_id)->where('semester','1')->where('student_grade',$student_grade)->join('edu_subjects','edu_subjects.sub_id = edu_scores.subject_id')->join('edu_subject_level_year','edu_subject_level_year.subject_id = edu_subjects.sub_id AND edu_subject_level_year.level_year = edu_scores.student_grade')->get('edu_scores');

		return $q;		
	}
	function get_student_subject2($student_id, $student_skill_id,​ $student_grade){
		$q = $this->db->where('student_skill_id',$student_skill_id)->where('student_id',$student_id)->where('semester','')->where('student_grade',$student_grade)->join('edu_subjects','edu_subjects.sub_id = edu_scores.subject_id')->join('edu_subject_level_year','edu_subject_level_year.subject_id = edu_subjects.sub_id AND edu_subject_level_year.level_year = edu_scores.student_grade')->get('edu_scores');

		return $q;	
	}

	// 

	function get_row_subjects($student_skill_id, $student_semester, $student_grade){
		return $query = $this->db->join('subject_major','subject_major.subject_id = subjects.sub_id')->join('subject_semester','subject_semester.subject_id = subjects.sub_id')->join('subject_level_year','subject_level_year.subject_id = subjects.sub_id')->where('subject_major.major_id',$student_skill_id)->where('subject_semester.semester',$student_semester)->where('subject_level_year.level_year',$student_grade)->get('subjects');

	}

	function get_result_score($student_id, $sco_semester, $sco_grade, $sco_skill, $sco_subject){
		$q = $this->db->where('scores.student_skill_id',$sco_skill)->where('scores.student_id',$student_id)->where('scores.semester',$sco_semester)->where('scores.student_grade',$sco_grade)->where('scores.subject_id',$sco_subject)->join('edu_subjects','edu_subjects.sub_id = edu_scores.subject_id')->join('edu_subject_level_year','edu_subject_level_year.subject_id = edu_subjects.sub_id AND edu_subject_level_year.level_year = edu_scores.student_grade')->get('edu_scores');
		return $q;	
	}
	


}
?>