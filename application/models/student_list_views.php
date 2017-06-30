<?php
class Student_list_views extends CI_Model
{
	function get_search_students($post, $search = '', $limit = '', $offset='', $col='stu_first_name_kh',$order='asc'){
		
		$exstra = '';
		// edu_courses.skill_major_id
		if(!empty($post['major_name'])){ $exstra.= " AND edu_stu_academic.stu_acad_skill_id = {$post['major_name']}"; }
		if(!empty($post['year'])){ $exstra.= " AND edu_stu_academic.stu_acad_section_id = {$post['year']}"; }
		if(!empty($post['batch'])){ $exstra.= " AND edu_stu_academic.stu_acad_batch_id = {$post['batch']}"; }
		if(!empty($post['period'])){ $exstra.= " AND edu_stu_academic.stu_acad_grade = {$post['period']}"; }
		if(!empty($post['degree'])){ $exstra.= " AND edu_stu_academic.stu_acad_level_id = {$post['degree']}"; }
		if(!empty($post['semester'])){ $exstra.= " AND edu_courses.course_schedule_semester = {$post['semester']}"; }
		if(!empty($post['schedule'])){ $exstra.= " AND edu_stu_academic.stu_acad_schedule_id = {$post['schedule']}"; }
		if(!empty($post['room'])){ $exstra.= " AND edu_stu_academic.stu_acad_stu_room = {$post['room']}"; }
		if(!empty($search)){ $exstra.= " AND edu_stu_info.stu_last_name LIKE '%{$search}%' OR edu_stu_info.stu_first_name LIKE '%{$search}%' OR edu_stu_info.stu_email_id LIKE '%{$search}%'"; }
		if(!empty($limit)){ $limit = "limit {$offset},{$limit}"; }

		$query = $this->db->query("SELECT
									edu_stu_info.stu_info_id,
									edu_stu_info.stu_unique_id,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_gender,
									edu_stu_info.students_grade,
									edu_stu_master.stu_master_id,
									edu_skill.skill_name,
									edu_skill.skill_name_kh,
									edu_skill.skill_major_code,
									edu_section.section_name,
									edu_batches.batch_name,
									edu_grade.grade_name,
									edu_levels.level_name,
									edu_levels.level_name_kh,
									edu_courses.course_name,
									edu_courses.course_schedule_semester,
									edu_stu_academic.stu_acad_id,
									edu_stu_academic.stu_acad_schedule_id,
									edu_stu_academic.stu_acad_stu_room,
									edu_stu_info.stu_first_name_kh,
									edu_stu_info.stu_last_name_kh,
									edu_stu_info.stu_gender_kh,
									edu_stu_info.stu_dob,
									edu_stu_info.stu_dob_kh,
									edu_stu_info.stu_email_id,
									edu_stu_info.stu_mobile_no,
									edu_stu_info.stu_admission_date,
									edu_nationality.nationality_name,
									edu_nationality.nationality_name_kh,
									edu_university.university_name,
									edu_university.university_name_kh,
									edu_room.room_name
									FROM
									edu_stu_master
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
									LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
									LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
									LEFT JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
									LEFT JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
									LEFT JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
									LEFT JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
									LEFT JOIN edu_nationality ON edu_nationality.nationality_id = edu_stu_info.stu_nationality_id
									LEFT JOIN edu_university ON edu_university.university_id = edu_skill.faculty_id
									Left JOIN edu_room ON edu_room.room_id = edu_stu_academic.stu_acad_stu_room
									WHERE edu_stu_master.is_status = 0 {$exstra} ORDER BY {$col} {$order} {$limit}");

		return $query;
	}
	function count_search_students($post, $search = ''){
		$exstra = '';
		// edu_courses.skill_major_id
		if(!empty($post['major_name'])){ $exstra.= " AND edu_stu_academic.stu_acad_skill_id = {$post['major_name']}"; }
		if(!empty($post['year'])){ $exstra.= " AND edu_stu_academic.stu_acad_section_id = {$post['year']}"; }
		if(!empty($post['batch'])){ $exstra.= " AND edu_stu_academic.stu_acad_batch_id = {$post['batch']}"; }
		if(!empty($post['period'])){ $exstra.= " AND edu_stu_academic.stu_acad_grade = {$post['period']}"; }
		if(!empty($post['degree'])){ $exstra.= " AND edu_stu_academic.stu_acad_level_id = {$post['degree']}"; }
		if(!empty($post['semester'])){ $exstra.= " AND edu_courses.course_schedule_semester = {$post['semester']}"; }
		if(!empty($post['schedule'])){ $exstra.= " AND edu_stu_academic.stu_acad_schedule_id = {$post['schedule']}"; }
		if(!empty($post['room'])){ $exstra.= " AND edu_stu_academic.stu_acad_stu_room = {$post['room']}"; }
		if(!empty($search)){ $exstra.= " AND edu_stu_info.stu_first_name  = '{$search}'"; }
		$query = $this->db->query("SELECT
									edu_stu_info.stu_info_id,
									edu_stu_info.stu_unique_id,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_gender,
									edu_stu_info.students_grade,
									edu_stu_master.stu_master_id,
									edu_skill.skill_name,
									edu_skill.skill_name_kh,
									edu_skill.skill_major_code,
									edu_section.section_name,
									edu_batches.batch_name,
									edu_grade.grade_name,
									edu_levels.level_name,
									edu_levels.level_name_kh,
									edu_courses.course_name,
									edu_courses.course_schedule_semester,
									edu_stu_academic.stu_acad_id,
									edu_stu_academic.stu_acad_schedule_id,
									edu_stu_academic.stu_acad_stu_room,
									edu_stu_info.stu_first_name_kh,
									edu_stu_info.stu_last_name_kh,
									edu_stu_info.stu_gender_kh,
									edu_stu_info.stu_dob,
									edu_stu_info.stu_dob_kh,
									edu_stu_info.stu_email_id,
									edu_stu_info.stu_mobile_no,
									edu_stu_info.stu_admission_date,
									edu_nationality.nationality_name,
									edu_nationality.nationality_name_kh,
									edu_university.university_name,
									edu_university.university_name_kh,
									edu_room.room_name
									FROM
									edu_stu_master
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
									LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
									LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
									LEFT JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
									LEFT JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
									LEFT JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
									LEFT JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
									LEFT JOIN edu_nationality ON edu_nationality.nationality_id = edu_stu_info.stu_nationality_id
									LEFT JOIN edu_university ON edu_university.university_id = edu_skill.faculty_id
									Left JOIN edu_room ON edu_room.room_id = edu_stu_academic.stu_acad_stu_room
									WHERE edu_stu_master.is_status = 0 {$exstra}");

		return $query->num_rows();
	}

	
	function get_search_suggestions($search, $limit=25, $post)
	{
		$suggestions = array();

        // search by last name
		$by_name = "edu_stu_info.stu_last_name LIKE '%{$search}%'";
		$get_by_name = $this->all_suggest_stu($search,$limit, $by_name, $post);
        
        $temp_suggestions = array();
        foreach($get_by_name->result() as $row)
        {
            $temp_suggestions[] = $row->stu_last_name;
        }
      
        sort($temp_suggestions);
        foreach($temp_suggestions as $temp_suggestion)
        {
            $suggestions[]=array('label'=> $temp_suggestion);       
        }     

        // search by first name
		$by_first_name = "edu_stu_info.stu_first_name LIKE '%{$search}%'";
		$get_by_first_name = $this->all_suggest_stu($search,$limit, $by_first_name, $post);
        
        $temp_suggestions = array();
        foreach($get_by_first_name->result() as $row)
        {
            $temp_suggestions[] = $row->stu_first_name;
        }
      
        sort($temp_suggestions);
        foreach($temp_suggestions as $temp_suggestion)
        {
            $suggestions[]=array('label'=> $temp_suggestion);       
        }     

        // search by email
        $by_email = "edu_stu_info.stu_email_id LIKE '%{$search}%'";
		$get_by_email = $this->all_suggest_stu($search,$limit, $by_email, $post);
        
        $temp_suggestions = array();
        foreach($get_by_email->result() as $row)
        {
            $temp_suggestions[] = $row->stu_email_id;
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

	function all_suggest_stu($search,$limit, $by, $post){
		if(!empty($post['major_name'])){ $exstra.= " AND edu_stu_academic.stu_acad_skill_id = {$post['major_name']}";}
		if(!empty($post['year'])){ $exstra.= " AND edu_stu_academic.stu_acad_section_id = {$post['year']}"; }
		if(!empty($data['batch'])){ $exstra.= " AND edu_stu_academic.stu_acad_batch_id = {$data['batch']}"; }
		if(!empty($data['period'])){ $exstra.= " AND edu_stu_academic.stu_acad_grade = {$data['period']}"; }
		if(!empty($data['degree'])){ $exstra.= " AND edu_stu_academic.stu_acad_level_id = {$data['degree']}"; }
		if(!empty($data['semester'])){ $exstra.= " AND edu_courses.course_schedule_semester = {$data['semester']}"; }
		if(!empty($data['schedule'])){ $exstra.= " AND edu_stu_academic.stu_acad_schedule_id = {$data['schedule']}"; }
		if(!empty($data['room'])){ $exstra.= " AND edu_stu_academic.stu_acad_stu_room = {$data['room']}"; }
		$query = $this->db->query("SELECT
									edu_stu_info.stu_info_id,
									edu_stu_info.stu_unique_id,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_gender,
									edu_stu_info.students_grade,
									edu_stu_master.stu_master_id,
									edu_skill.skill_name,
									edu_skill.skill_name_kh,
									edu_skill.skill_major_code,
									edu_section.section_name,
									edu_batches.batch_name,
									edu_grade.grade_name,
									edu_levels.level_name,
									edu_levels.level_name_kh,
									edu_courses.course_name,
									edu_courses.course_schedule_semester,
									edu_stu_academic.stu_acad_id,
									edu_stu_academic.stu_acad_schedule_id,
									edu_stu_academic.stu_acad_stu_room,
									edu_stu_info.stu_first_name_kh,
									edu_stu_info.stu_last_name_kh,
									edu_stu_info.stu_gender_kh,
									edu_stu_info.stu_dob,
									edu_stu_info.stu_dob_kh,
									edu_stu_info.stu_email_id,
									edu_stu_info.stu_mobile_no,
									edu_stu_info.stu_admission_date,
									edu_nationality.nationality_name,
									edu_nationality.nationality_name_kh,
									edu_university.university_name,
									edu_university.university_name_kh,
									edu_room.room_name
									FROM
									edu_stu_master
									LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
									LEFT JOIN edu_stu_academic ON edu_stu_academic.stu_acad_stu_master_id = edu_stu_master.stu_master_id
									LEFT JOIN edu_skill ON edu_skill.skill_id = edu_stu_academic.stu_acad_skill_id
									LEFT JOIN edu_section ON edu_section.section_id = edu_stu_academic.stu_acad_section_id
									LEFT JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
									LEFT JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
									LEFT JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
									LEFT JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
									LEFT JOIN edu_nationality ON edu_nationality.nationality_id = edu_stu_info.stu_nationality_id
									LEFT JOIN edu_university ON edu_university.university_id = edu_skill.faculty_id
									Left JOIN edu_room ON edu_room.room_id = edu_stu_academic.stu_acad_stu_room
                        WHERE edu_stu_master.is_status = 0 AND ({$by}) {$exstra} limit {$limit} ");
		return $query;
	}
	
	function get_subj_by_skill($skill_id){
		return $this->db->query("SELECT
						edu_subjects.subjects_short_name,
						edu_subjects.subject_name
						FROM edu_subjects
						INNER JOIN edu_subject_major ON edu_subject_major.subject_id = edu_subjects.sub_id
						WHERE edu_subject_major.major_id = {$skill_id}");
	}
	function get_all_skills()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('skill');
		return $query->result();
	}

	function get_all_section()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('section');
		return $query->result();
	}

	function get_all_degree()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('levels');
		return $query->result();
	}
	function get_all_batch()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('batches');
		return $query->result();
	}
	function get_all_room()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('room');
		return $query->result();
	}
}
