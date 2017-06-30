<?php
/**
* Course table information
*/
class Course extends CI_Model
{
	
	function get_info($course_id)
	{
		$this->db->from('courses');	
		$this->db->where('course_id',$course_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $course_id is NOT an course
			$course_obj = new stdClass;
			
			//Get all the fields from course table
			$fields = $this->db->list_fields('courses');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$course_obj->$field='';
			}
			
			return $course_obj;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('courses');
		$this->db->where('is_status',0);
		$query = $this->db->where("course_name = ".$this->db->escape($term));
		$query=$this->db->get();

		if($query->num_rows()>0)
		{
			return true;
		}
	}

	function code_exists($course_code)
	{
		$this->db->from('courses');
		$this->db->where('courses.course_code',$course_code);
		$this->db->where('courses.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->course_code;
		}
	}

	/*
	Inserts or updates a course
	*/
	function save(&$course_data, $course_id = false)
	{
		$success = false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$course_id or !$this->exists($course_id)) {
			$success = $this->db->insert('courses',$course_data);
			$course_data['course_id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('course_id', $course_id)
				->update('courses', $course_data);
		}
		$this->db->trans_complete();
		return $success;
	}

	function add_schedule1($data_schedule, $course_id = false, $id = false)
	{

		$success = false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		if($course_id && $id == 0) {
			$success = $this->db->insert('course_schedule',$data_schedule);
			$course_data['id'] = $this->db->insert_id();
		}else{		
			$success = $this->db
				->where('course_id', $course_id)
				->update('course_schedule', $data_schedule);
		}
		$this->db->trans_complete();

		return $success;
	}

	function add_schedule2($data_schedule, $course_id = false, $id = false)
	{
		$success = false;
		$this->db->trans_start();
		if($course_id && $id == 0) {
			$success = $this->db->insert('course_schedule2',$data_schedule);
			$course_data['id'] = $this->db->insert_id();
		}else{		
			$success = $this->db->where('id', $id)->update('course_schedule2', $data_schedule);
		}
		$this->db->trans_complete();

		return $success;
	}


	function exists($course_id)
	{
		$this->db->from('courses');
		$this->db->where('courses.course_id',$course_id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('courses');
		$this->db->where("(course_code LIKE '%".$this->db->escape_like_str($search)."%' 
		OR course_name LIKE '%".$this->db->escape_like_str($search)."%' 
		OR course_name_kh LIKE '%".$this->db->escape_like_str($search)."%') 
		AND is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function count_all()
	{
		$this->db->from('courses');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function get_all($limit=10000, $offset=0, $col='course_id', $order='desc')
	{
		$courses = $this->db->dbprefix('courses');
		$degree = $this->db->dbprefix('levels');
		$data = $this->db->query("SELECT * 
						FROM " . $courses . " 
						STRAIGHT_JOIN ".$degree." ON 
						".$courses.".level_id = ".$degree.".level_id 
						WHERE ".$courses.".is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function search($search, $limit=20,$offset=0,$column='course_id',$orderby='desc')
	{
		$this->db->from('courses');
		$this->db->where("(course_name LIKE '%".$this->db->escape_like_str($search)."%' 
			OR course_name_kh LIKE '%".$this->db->escape_like_str($search)."%' 
			OR course_code LIKE '%".$this->db->escape_like_str($search)."%') 
			AND is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	/*
	Get search suggestions to find course
	*/
	function get_search_suggestions($search, $limit = 5)
	{
		$suggestions = array();

		$this->db->from('courses');
		$this->db->where("(course_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->course_name;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->from('courses');
		$this->db->where("(course_name_kh LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name_kh = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name_kh->result() as $row)
		{
			$temp_suggestions[] = $row->course_name_kh;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->from('courses');
		$this->db->where("(course_code LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_code = $this->db->get();
		$temp_suggestions = array();
		foreach($by_code->result() as $row)
		{
			$temp_suggestions[] = $row->course_code;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0, $limit);
		}

		return $suggestions;
	}

	/*
	Deletes a list of course
	*/
	function delete_list($course_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$this->db->where_in('course_id',$course_id);
		$success = $this->db->update('courses', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	function delete_schedule($form_type,$id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$this->db->where('id',$id);
		if($form_type == 1){
			$success = $this->db->delete('course_schedule');
		}elseif($form_type == 2){
			$success = $this->db->delete('course_schedule2');
		}
		$this->db->trans_complete();
		return $success;
	}

	function get_courses($major_id=false, $limit=10000, $offset=0, $col='course_id', $order='desc')
	{
		$courses = $this->db->dbprefix('courses');
		$degree = $this->db->dbprefix('levels');
		$where = "WHERE ".$courses.".is_status = 0 ";
		if ($major_id) {
			$where .= "AND $courses.skill_major_id = $major_id ";
		}
		$data = $this->db->query("SELECT * 
						FROM " . $courses . " 
						STRAIGHT_JOIN ".$degree." ON 
						".$courses.".level_id = ".$degree.".level_id 
						".$where." ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function view_get_schedule($course_id, $schedule){
		return $this->db->query("SELECT c.id,
								c.course_id,
								subj_mon.subject_name AS s_mon,
								subj_tue.subject_name AS s_tue,
								subj_wed.subject_name AS s_wed,
								subj_thu.subject_name AS s_thu,
								subj_fri.subject_name AS s_fri,
								CONCAT_WS('', p_mon.first_name, p_mon.last_name) as e_mon,
								CONCAT_WS('', p_tue.first_name, p_tue.last_name) as e_tue,
								CONCAT_WS('', p_wed.first_name, p_wed.last_name) as e_wed,
								CONCAT_WS('', p_thu.first_name, p_thu.last_name) as e_thu,
								CONCAT_WS('', p_fri.first_name, p_fri.last_name) as e_fri,
								edu_room.room_name,
								edu_school_class.school_class_name,
								cst.time,
								p_fri.full_name
								FROM edu_course_schedule as c 
								LEFT JOIN edu_subjects AS subj_mon ON subj_mon.sub_id = c.mon_sub
								LEFT JOIN edu_subjects AS subj_tue ON subj_tue.sub_id = c.tue_sub
								LEFT JOIN edu_subjects AS subj_wed ON subj_wed.sub_id = c.wed_sub
								LEFT JOIN edu_subjects AS subj_thu ON subj_thu.sub_id = c.thu_sub
								LEFT JOIN edu_subjects AS subj_fri ON subj_fri.sub_id = c.fri_sub
								LEFT JOIN edu_employees AS empl_mon ON empl_mon.id = c.mon_prof
								LEFT JOIN edu_employees AS empl_tue ON empl_tue.id = c.tue_prof
								LEFT JOIN edu_employees AS empl_wed ON empl_wed.id = c.wed_prof
								LEFT JOIN edu_employees AS empl_thu ON empl_thu.id = c.thu_prof
								LEFT JOIN edu_employees AS empl_fri ON empl_fri.id = c.fri_prof
								LEFT JOIN edu_room ON edu_room.room_id = c.room
								LEFT JOIN edu_school_class ON edu_school_class.school_class_id = c.class
								LEFT JOIN edu_course_schedule_times AS cst ON cst.id = c.time_id
								LEFT JOIN edu_people AS p_mon ON p_mon.person_id = empl_mon.person_id
								LEFT JOIN edu_people AS p_tue ON p_tue.person_id = empl_tue.person_id
								LEFT JOIN edu_people AS p_wed ON p_wed.person_id = empl_wed.person_id
								LEFT JOIN edu_people AS p_thu ON p_thu.person_id = empl_thu.person_id
								LEFT JOIN edu_people AS p_fri ON p_fri.person_id = empl_fri.person_id
								WHERE c.course_id = {$course_id} AND cst.day = '{$schedule}'");
	}
	function view_get_schedule2($course_id, $schedule){
		$query = $this->db->query("SELECT c.id,
								c.course_id,
								subj_sat.subject_name as s_sat,
								subj_sun.subject_name as s_sun,	
								CONCAT_WS('', p_sat.first_name, p_sat.last_name) as e_sat,
								CONCAT_WS('', p_sun.first_name, p_sun.last_name) as e_sun,
								edu_room.room_name,
								edu_school_class.school_class_name,
								cst.time
								FROM edu_course_schedule2 as c 
								LEFT JOIN edu_subjects AS subj_sat ON subj_sat.sub_id = c.sat_sub
								LEFT JOIN edu_subjects AS subj_sun ON subj_sun.sub_id = c.sun_sub
								LEFT JOIN edu_employees AS empl_sat ON empl_sat.id = c.sat_prof
								LEFT JOIN edu_employees AS empl_sun ON empl_sun.id = c.sun_prof
								LEFT JOIN edu_people AS p_sat ON p_sat.person_id = empl_sat.person_id
								LEFT JOIN edu_people AS p_sun ON p_sun.person_id = empl_sun.person_id
								LEFT JOIN edu_room ON edu_room.room_id = c.room
								LEFT JOIN edu_school_class ON edu_school_class.school_class_id = c.class
								LEFT JOIN edu_course_schedule_times as cst ON cst.id = c.time_id
								WHERE c.course_id = {$course_id} AND cst.day = '{$schedule}'");
		return $query;
	}
	function get_schedule_edit($course_id, $id){
		return $this->db->where('id',$id)->where('course_id',$course_id)->get('edu_course_schedule');
	}
	function get_schedule_edit2($course_id, $id){
		return $this->db->where('id',$id)->where('course_id',$course_id)->get('edu_course_schedule2');
	}

	function get_head_view_schedule($course_id){
		return $this->db->query("SELECT edu_courses.course_id,
								edu_levels.level_name,
								edu_skill.skill_name,
								edu_courses.course_schedule_year,
								edu_courses.course_schedule_semester,
								edu_batches.batch_name,
								edu_section.section_name,
								edu_courses.course_schedule_promote,
								edu_courses.course_schedule_date_today,
								edu_courses.course_schedule_adjust_date,
								edu_courses.course_schedule_midterm,
								edu_courses.course_schedule_enddate,
								edu_courses.course_schedule_final_from,
								edu_courses.course_schedule_final_to,
								edu_courses.course_faculty_date,
								edu_university.university_name,
								edu_room.room_name
								FROM
								edu_courses
								INNER JOIN edu_levels ON edu_levels.level_id = edu_courses.level_id
								INNER JOIN edu_skill ON edu_skill.skill_id = edu_courses.skill_major_id
								INNER JOIN edu_batches ON edu_batches.batch_course_id = edu_courses.course_schedule_promote
								INNER JOIN edu_section ON edu_section.section_id = edu_courses.academic_year_id
								INNER JOIN edu_university ON edu_university.university_id = edu_courses.university_id
								INNER JOIN edu_room ON edu_room.room_id = edu_courses.room_id")->row();
	}
	
	function suggest_major($faculty_id){
		return $this->db->where('is_status',0)->where('faculty_id',$faculty_id)->get('skill');
	}
	function get_courses_info($course_id){
		return $this->db->where('course_id',$course_id)->get('courses');
	}
	function suggest_subject($get_cou_info_semester, $get_cou_info_level_year, $get_cou_info_skill){
		return  $this->db->where('edu_subject_semester.semester',$get_cou_info_semester)
						->where('edu_subject_level_year.level_year',$get_cou_info_level_year)
						->where('edu_subject_major.major_id',$get_cou_info_skill)
						->join('edu_subject_semester','edu_subject_semester.subject_id = edu_subjects.sub_id')
						->join('edu_subject_major','edu_subject_major.subject_id = edu_subjects.sub_id')
						->join('edu_subject_level_year','edu_subject_level_year.subject_id = edu_subjects.sub_id')
						->where('is_status',0)
						->get('subjects');
	}

	function suggest_batch(){
		return $this->db->get('batches');
	}
}