<?php
class Score_model extends CI_Model
{
	function get_all($limit=10000, $offset=0,$col='stu_master_id',$order='desc')
	{
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
								LEFT JOIN edu_batches ON edu_batches.batch_id = edu_stu_academic.stu_acad_batch_id
								LEFT JOIN edu_grade ON edu_grade.grade_id = edu_stu_academic.stu_acad_grade
								LEFT JOIN edu_levels ON edu_levels.level_id = edu_stu_academic.stu_acad_level_id
								LEFT JOIN edu_courses ON edu_courses.course_id = edu_stu_academic.stu_acad_course_detail_id
								WHERE edu_stu_master.is_status = 0 AND is_refer_out = 0 ORDER BY {$col} {$order} LIMIT {$offset},{$limit}");
		return $query;
	}

	function count_all()
	{
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
								WHERE edu_stu_master.is_status = 0 AND is_refer_out = 0");
		return $query->num_rows(); // count_all_results()
	}

	function get_search_students($major_id = '', $batch = '', $year = '', $period = '', $degree_id = '', $semester = '', $schedule = '', $room = '', $search = ''){
		$exstra = '';
		// edu_courses.skill_major_id
		if(!empty($major_id)){ $exstra.= " AND edu_stu_academic.stu_acad_skill_id = {$major_id}"; }
		if(!empty($year)){ $exstra.= " AND edu_stu_academic.stu_acad_section_id = {$year}"; }
		if(!empty($batch)){ $exstra.= " AND edu_stu_academic.stu_acad_batch_id = {$batch}"; }
		if(!empty($period)){ $exstra.= " AND edu_stu_academic.stu_acad_grade = {$period}"; }
		if(!empty($degree_id)){ $exstra.= " AND edu_stu_academic.stu_acad_level_id = {$degree_id}"; }
		if(!empty($semester)){ $exstra.= " AND edu_courses.course_schedule_semester = {$semester}"; }
		if(!empty($schedule)){ $exstra.= " AND edu_stu_academic.stu_acad_schedule_id = {$schedule}"; }
		if(!empty($room)){ $exstra.= " AND edu_stu_academic.stu_acad_stu_room = {$room}"; }
		if(!empty($search)){ $exstra.= " AND edu_stu_info.stu_first_name  = '{$search}'"; }
		$query = $this->db->query("SELECT
									edu_stu_info.stu_info_id,
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

	function suggestions_score_stu_search($search,$limit=25,$sug_data){
		$suggestions = array();

		$this->db->from('stu_info');
		$this->db->where("(stu_first_name LIKE '%".$this->db->escape_like_str($search)."%'
			OR stu_last_name LIKE '%".$this->db->escape_like_str($search)."%')");
		if(!empty($sug_data['major_id'])){ $this->db->where('edu_courses.skill_major_id',$sug_data['major_id']);}
		if(!empty($sug_data['batch'])){ $this->db->where('edu_stu_master.stu_master_batch_id',$sug_data['batch']);}
		// if(!empty($sug_data['year'])){ $this->db->where('edu_stu_master.stu_master_batch_id',$sug_data['year']);}
		if(!empty($sug_data['period'])){ $this->db->where('edu_courses.duration',$sug_data['period']);}
		if(!empty($sug_data['degree_id'])){ $this->db->where('edu_courses.level_id',$sug_data['degree_id']);}

		$this->db->join('edu_stu_master','edu_stu_master.stu_master_stu_info_id = edu_stu_info.stu_info_id AND edu_stu_info.stu_info_stu_master_id = edu_stu_master.stu_master_id');
		$this->db->join('edu_batches','edu_stu_master.stu_master_batch_id = edu_batches.batch_id');
		$this->db->join('edu_stu_academic','edu_stu_master.stu_master_user_id = edu_stu_academic.stu_acad_id');
		$this->db->join('edu_courses','edu_batches.batch_course_id = edu_courses.course_id AND edu_stu_academic.stu_acad_course_detail_id = edu_courses.course_id');
		$this->db->join('edu_skill','edu_courses.skill_major_id = edu_skill.skill_id');
		$this->db->join('edu_levels','edu_courses.level_id = edu_levels.level_id');

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

	function get_all_info_stu_by_id($id){
		$query = $this->db->query("SELECT edu_stu_info.stu_info_id,
									edu_stu_info.stu_unique_id,
									edu_stu_info.stu_first_name,
									edu_stu_info.stu_first_name_kh,
									edu_stu_info.stu_middle_name,
									edu_stu_info.stu_last_name,
									edu_stu_info.stu_last_name_kh,
									edu_stu_info.stu_gender,
									edu_stu_info.stu_dob,
									edu_stu_info.students_grade,
									edu_stu_master.stu_master_id,
									edu_skill.skill_id,
									edu_skill.skill_name,
									edu_skill.skill_major_code,
									edu_section.section_id,
									edu_section.section_name,
									edu_batches.batch_name,
									edu_grade.grade_id,
									edu_grade.grade_name,
									edu_levels.level_name,
									edu_courses.course_name,
									edu_courses.course_schedule_semester,
									edu_stu_academic.stu_acad_id,
									edu_stu_academic.stu_acad_schedule_id,
									edu_stu_academic.stu_acad_stu_room,
									edu_nationality.nationality_name,
									edu_university.university_name,
									edu_room.room_name,
									edu_room.room_id
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
									INNER JOIN edu_room ON edu_room.room_id = edu_stu_academic.stu_acad_stu_room
								WHERE edu_stu_academic.stu_acad_id = {$id}");
		return $query;
	}

	function get_all_result_final1($id_stu){
			$query = $this->db->join('stu_info','stu_info.stu_info_id = scores.student_id','left')
					->join('subjects','subjects.sub_id = scores.subject_id','left')
					->where('stu_info_id',$id_stu)
					->where('semester',1)
					->where('ch_re_exam',0)
					->order_by('id','ASC')
					->get('scores');
			return $query;
	}
	function get_all_result_re_final1($id_stu){
			$query = $this->db->join('stu_info','stu_info.stu_info_id = scores.student_id','left')
					->join('subjects','subjects.sub_id = scores.subject_id','left')
					->where('stu_info_id',$id_stu)
					->where('semester',1)
					->where('ch_re_exam',1)
					->order_by('id','ASC')
					->get('scores');
			return $query;
	}
	function get_all_result_final2($id_stu){
			$query = $this->db->join('stu_info','stu_info.stu_info_id = scores.student_id','left')
					->join('subjects','subjects.sub_id = scores.subject_id','left')
					->where('stu_info_id',$id_stu)
					->where('semester',2)
					->where('ch_re_exam',0)
					->order_by('id','ASC')
					->get('scores');
			return $query;
	}
	function get_all_result_re_final2($id_stu){
			$query = $this->db->join('stu_info','stu_info.stu_info_id = scores.student_id','left')
					->join('subjects','subjects.sub_id = scores.subject_id','left')
					->where('stu_info_id',$id_stu)
					->where('semester',2)
					->where('ch_re_exam',1)
					->order_by('id','ASC')
					->get('scores');
			return $query;
	}
	function get_nas_final1($id_stu){
			$query = $this->db->join('stu_info','stu_info.stu_info_id = nas.student_id','left')
					->where('stu_info_id',$id_stu)
					->where('semester',1)
					->order_by('id','ASC')
					->get('nas');
			return $query;
	}
	function get_nas_final2($id_stu){
			$query = $this->db->join('stu_info','stu_info.stu_info_id = nas.student_id','left')
					->where('stu_info_id',$id_stu)
					->where('semester',2)
					->order_by('id','ASC')
					->get('nas');
			return $query;
	}
	function get_all_result_final_byid($eid=''){
			return $this->db->join('stu_info','stu_info.stu_info_id = scores.student_id','left')
					->join('subjects','subjects.sub_id = scores.subject_id','left')
					->where('id',$eid)
					->get('scores')->row();
	}
	function get_nas_byid($eid=''){
			return $this->db->join('stu_info','stu_info.stu_info_id = nas.student_id','left')
					->where('id',$eid)
					->get('nas')->row();
	}

	function get_all_result_pre($id_stu){
			return $this->db->join('stu_info','stu_info.stu_info_id = score_pre_exams.student_id','left')
					->join('subjects','subjects.sub_id = score_pre_exams.subject_id','left')
					->where('stu_info_id',$id_stu)
					->order_by('id','ASC')
					->get('score_pre_exams');
	}

	function get_all_result_pre_byid($eid=''){
			return $this->db->join('stu_info','stu_info.stu_info_id = score_pre_exams.student_id','left')
					->join('subjects','subjects.sub_id = score_pre_exams.subject_id','left')
					->where('id',$eid)
					->get('score_pre_exams')->row();
	}


	function get_all_result_state($id_stu){
			$query = $this->db->select('score_state_exam.id,
										score_state_exam.student_state_acad_id,
										score_state_exam.student_id,
										score_state_exam.score,
										subjects.subject_name
					')->join('stu_info','stu_info.stu_info_id = score_state_exam.student_id','left')
					->join('subjects','subjects.sub_id = score_state_exam.subject_id','left')
					->where('stu_info_id',$id_stu)
					->order_by('score_state_exam.id','ASC')
					->get('score_state_exam');
			return $query;
	}

	function get_all_result_state_byid($eid=''){
			$query = $this->db->select('score_state_exam.id,
										score_state_exam.student_id,
										score_state_exam.score,
										subjects.sub_id
					')->join('stu_info','stu_info.stu_info_id = score_state_exam.student_id','left')
					->join('subjects','subjects.sub_id = score_state_exam.subject_id','left')
					->where('score_state_exam.id',$eid)
					->get('score_state_exam')->row();

			return $query;
	}
	function get_all_result_thesis($id_stu){
			$query = $this->db->select('edu_score_thesis.id,
										edu_score_thesis.student_thesis_acad_id,
										edu_score_thesis.student_id,
										edu_score_thesis.thesis_written_score,
										edu_score_thesis.thesis_score,
										edu_score_thesis.thesis_defence_date
					')->join('stu_info','stu_info.stu_info_id = edu_score_thesis.student_id','left')
					->where('stu_info_id',$id_stu)
					->order_by('edu_score_thesis.id','ASC')
					->get('edu_score_thesis');
			return $query;
	}
	function get_all_result_thesis_byid($eid=''){
			$query = $this->db->select('edu_score_thesis.id,
										edu_score_thesis.student_id,
										edu_score_thesis.thesis_written_score,
										edu_score_thesis.thesis_score,
										edu_score_thesis.thesis_defence_date
					')->join('stu_info','stu_info.stu_info_id = edu_score_thesis.student_id','left')
					->where('edu_score_thesis.id',$eid)
					->get('edu_score_thesis')->row();
			return $query;
	}

	function save_score_final(&$final,$id){
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if ($id == -1) {
			$success = $this->db->insert('scores',$final);
			$final['id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('id', $id)
				->update('scores', $final);
		}

		$this->db->trans_complete();
		return $success;
	}

	function save_nas(&$nas_data,$id){
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if ($id == -1) {
			$success = $this->db->insert('nas',$nas_data);
			$nas_data['id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('id', $id)
				->update('nas', $nas_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function save_score_pre(&$score_pre,$id){
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if ($id == -1) {
			$success = $this->db->insert('score_pre_exams',$score_pre);
			$score_pre['id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('id', $id)
				->update('score_pre_exams', $score_pre);
		}

		$this->db->trans_complete();
		return $success;
	}

	function save_score_state(&$score_state,$id){
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if ($id == -1) {
			$success = $this->db->insert('edu_score_state_exam',$score_state);
			$score_state['id'] = $this->db->insert_id();
		} else {
			$success = $this->db->where('id', $id)->update('edu_score_state_exam', $score_state);
		}

		$this->db->trans_complete();
		return $success;
	}
	function save_score_thesis(&$score_thesis,$id){
		$success=false;
		$this->db->trans_start();
		if ($id == -1) {
			$success = $this->db->insert('edu_score_thesis',$score_thesis);
			$score_thesis['id'] = $this->db->insert_id();
		} else {
			$success = $this->db->where('id', $id)->update('edu_score_thesis', $score_thesis);
		}
		$this->db->trans_complete();
		return $success;
	}


	function get_skill_by_id($get_id)
	{
		$query = $this->db
					->where('skill_id',$get_id)
		            ->where("is_status", 0)
		            ->get('skill');
		return $query;
	}
	
	function get_all_batch()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('batches');
		return $query->result();
	}

	
	function del_pre_exam($id){
		if(!empty($id)){
			$this->db->where('id',$id)->delete('score_pre_exams');
			return 1;
		}
	}
	function del_state_exam($id){
		if(!empty($id)){		
			$this->db->where('id',$id)->delete('score_state_exam');
			return 1;
		}
	}
	function del_thesis($id){
		if(!empty($id)){	
			$this->db->where('id',$id)->delete('edu_score_thesis');
			return 1;
		}
	}
	function del_final_from($id){
		if(!empty($id)){
			$this->db->where('id',$id)->delete('scores');
			return 1;
		}
	}
	function del_nas_from($id){
		if(!empty($id)){
			$this->db->where('id',$id)->delete('nas');
			return 1;
		}
	}

	function search($search,$sug_data)
	{
		$this->db->from('stu_info');
		$this->db->where("(stu_first_name LIKE '%".$this->db->escape_like_str($search)."%' 
							OR stu_middle_name LIKE '%".$this->db->escape_like_str($search)."%' 
							OR stu_last_name LIKE '%".$this->db->escape_like_str($search)."%')");

		if(!empty($sug_data['major_id'])){ $this->db->where('edu_courses.skill_major_id',$sug_data['major_id']);}
		if(!empty($sug_data['batch'])){ $this->db->where('edu_stu_master.stu_master_batch_id',$sug_data['batch']);}
		// if(!empty($sug_data['year'])){ $this->db->where('edu_stu_master.stu_master_batch_id',$sug_data['year']);}
		if(!empty($sug_data['period'])){ $this->db->where('edu_courses.duration',$sug_data['period']);}
		if(!empty($sug_data['degree_id'])){ $this->db->where('edu_courses.level_id',$sug_data['degree_id']);}
		
		$this->db->join('edu_stu_master','edu_stu_master.stu_master_stu_info_id = edu_stu_info.stu_info_id AND edu_stu_info.stu_info_stu_master_id = edu_stu_master.stu_master_id');
		$this->db->join('edu_batches','edu_stu_master.stu_master_batch_id = edu_batches.batch_id');
		$this->db->join('edu_stu_academic','edu_stu_master.stu_master_user_id = edu_stu_academic.stu_acad_id');
		$this->db->join('edu_courses','edu_batches.batch_course_id = edu_courses.course_id AND edu_stu_academic.stu_acad_course_detail_id = edu_courses.course_id');
		$this->db->join('edu_skill','edu_courses.skill_major_id = edu_skill.skill_id');
		$this->db->join('edu_levels','edu_courses.level_id = edu_levels.level_id');
		return $this->db->get();
	}

	function get_stu_score($arr_stu){
		$q_stu = $this->db->query("SELECT edu_stu_info.stu_info_id,
						edu_stu_info.stu_unique_id,
						edu_stu_info.stu_first_name,
						edu_stu_info.stu_middle_name,
						edu_stu_info.stu_last_name,
						edu_stu_info.stu_first_name_kh,
						edu_stu_info.stu_middle_name_kh,
						edu_stu_info.stu_last_name_kh,
						edu_stu_info.stu_gender,
						edu_stu_info.stu_dob,
						edu_stu_info.stu_master_stu_room,
						edu_stu_info.students_grade,
						edu_stu_master.stu_master_id,
						edu_batches.batch_name,
						edu_stu_academic.stu_acad_stu_master_id,
						edu_courses.course_name,
						edu_courses.duration,
						edu_courses.course_schedule_semester,
						edu_courses.course_schedule_year,
						edu_skill.skill_id,
						edu_skill.skill_name,
						edu_skill.skill_name_kh,
						edu_levels.level_id,
						edu_levels.level_name,
						edu_levels.level_name_kh,
						edu_university.university_name,
						edu_university.university_id,
						edu_university.card_color_type,
						edu_section.section_name,
						edu_nationality.nationality_name,
						edu_nationality.nationality_name_kh,
						edu_room.room_name
						FROM edu_stu_master
						LEFT JOIN edu_stu_info ON edu_stu_info.stu_info_id = edu_stu_master.stu_master_stu_info_id
						LEFT JOIN edu_batches ON edu_stu_master.stu_master_batch_id = edu_batches.batch_id
						LEFT JOIN edu_stu_academic ON edu_stu_master.stu_master_user_id = edu_stu_academic.stu_acad_id
						LEFT JOIN edu_courses ON edu_courses.course_id = edu_stu_master.stu_master_course_id
						LEFT JOIN edu_skill ON edu_skill.skill_id = edu_courses.skill_major_id
						LEFT JOIN edu_levels ON edu_levels.level_id = edu_courses.level_id
						LEFT JOIN edu_nationality ON edu_stu_master.stu_master_nationality_id = edu_nationality.nationality_id
						LEFT JOIN edu_section ON edu_stu_master.stu_master_section_id = edu_section.section_id AND edu_section.section_id = edu_courses.academic_year_id
						LEFT JOIN edu_university ON edu_university.university_id = edu_courses.university_id
						LEFT JOIN edu_stu_address ON edu_stu_address.stu_address_id = edu_stu_master.stu_master_stu_address_id
						LEFT JOIN edu_room ON edu_room.room_id = edu_stu_info.stu_master_stu_room
						WHERE edu_stu_master.is_status = 0 AND stu_info_id IN ({$arr_stu})");
		return $q_stu;
	}
	function get_row_subjects($skill, $semester, $level_yar){
		return $query = $this->db->join('subject_major','subject_major.subject_id = subjects.sub_id')->join('subject_semester','subject_semester.subject_id = subjects.sub_id')->join('subject_level_year','subject_level_year.subject_id = subjects.sub_id')->where('subject_major.major_id',$skill)->where('subject_semester.semester',$semester)->where('subject_level_year.level_year',$level_yar)->get('subjects');
	}
	function get_result_score($stu_id, $stu_semester, $stu_grade, $stu_skill, $stu_subject){
		$q = $this->db->where('scores.student_skill_id',$stu_skill)->where('scores.student_id',$stu_id)->where('scores.semester',$stu_semester)->where('scores.student_grade',$stu_grade)->where('scores.subject_id',$stu_subject)->join('edu_subjects','edu_subjects.sub_id = edu_scores.subject_id')->join('edu_subject_level_year','edu_subject_level_year.subject_id = edu_subjects.sub_id AND edu_subject_level_year.level_year = edu_scores.student_grade')->get('edu_scores');;
		return $q;

		// echo $this->db->last_query();	
	}

	function get_score($subject_id,$major_id,$stu_id){
		 $q = $this->db->query("SELECT edu_subject_major.subject_id,
									edu_subject_major.major_id,
									edu_scores.subject_id,
									edu_scores.semester,
									edu_scores.attendance_score,
									edu_scores.midterm_group_discussion_score,
									edu_scores.midterm_quiz_score,
									edu_scores.midterm_assignment_score,
									edu_scores.midterm_exam_score,
									edu_scores.final_score,
									edu_scores.student_id,
									edu_scores.id
									FROM edu_scores
									INNER JOIN edu_subject_major ON edu_subject_major.subject_id = edu_scores.subject_id
									WHERE edu_scores.semester = 1 AND edu_scores.student_id = {$stu_id} AND edu_scores.subject_id = {$subject_id} AND edu_subject_major.major_id = {$major_id}");
		return $q;
	}

	function suggest_subject_score($semester_id, $skill_id, $level_yar){
		return $this->db->where('edu_subject_semester.semester',$semester_id)
						->where('edu_subject_level_year.level_year',$level_yar)
						->where('edu_subject_major.major_id',$skill_id)
						->join('edu_subject_semester','edu_subject_semester.subject_id = edu_subjects.sub_id')
						->join('edu_subject_major','edu_subject_major.subject_id = edu_subjects.sub_id')
						->join('edu_subject_level_year','edu_subject_level_year.subject_id = edu_subjects.sub_id')
						->where('is_status',0)->get('subjects');
	}
}
