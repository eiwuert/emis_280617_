<?php
class Subject extends CI_Model{

	function get_all($limit=10000, $offset=0,$col='sub_id',$order='desc')
	{
		$subjects = $this->db->dbprefix('subjects');
		$data = $this->db->query("SELECT * 
						FROM " . $subjects . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function count_all()
	{
		$this->db->from('subjects');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function search($search, $limit=20,$offset=0,$column='sub_id',$orderby='desc')
	{
		$this->db->from('subjects');
		$this->db->where("(subject_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			subject_name_kh LIKE '%".$this->db->escape_like_str($search)."%' or 
			subjects_short_name LIKE '%".$this->db->escape_like_str($search)."%' ) and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('subjects');
		$this->db->where("(subject_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			subject_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function get_info($sub_id)
	{
		$this->db->from('subjects');
		$this->db->where('sub_id',$sub_id);
		$query = $this->db->get();
		if($query->num_rows()==1) {
			return $query->row();
		} else {
			//Get all the fields from subjects table
			$fields = $this->db->list_fields('subjects');

			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}

			return $person_obj;
		}
	}

	function re_subj_major($subject_id){
		$this->db->from('subject_major');
		$this->db->where('subject_id',$subject_id);
		return $query = $this->db->get()->result();
	}
	function re_subj_level_year($subject_id){
		$this->db->from('subject_level_year');
		$this->db->where('subject_id',$subject_id);
		return $query = $this->db->get()->result();
	}
	function re_subj_semester($subject_id,$semster){
		$this->db->from('subject_semester');
		$this->db->where('subject_id',$subject_id);
		$this->db->where('semester',$semster);
		return $query = $this->db->get()->result();
	}
	function check_duplicate($term)
	{
		$this->db->from('subjects');
		$this->db->where('is_status',0);
		$query = $this->db->where("subject_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}

	function subjects_exists($subject_name)
	{
		$this->db->from('subjects');
		$this->db->where('subjects.subject_name',$subject_name);
		$this->db->where('subjects.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->subject_name;
		}
	}

	/*
	Inserts or updates a subjects
	*/
	function save(&$subject_data, $subject_major_id, $subject_semester, $subject_level_year, $subject_professors, $sub_id=false)
	{
		$count_major = count($subject_major_id);
		$count_level_year = count($subject_level_year);
		$count_semester = count($subject_semester);
		$count_professors = count($subject_professors);
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$sub_id or !$this->exists($sub_id)) {
			$success = $this->db->insert('subjects',$subject_data);
			$subject_data['sub_id'] = $this->db->insert_id();
			
			for ($i=0; $i < $count_major; $i++) { 
				$id_major = $subject_major_id[$i];
				$data_subj_major = array('subject_id' => $subject_data['sub_id'], 'major_id' => $id_major );
				$success = $this->db->insert('subject_major',$data_subj_major);
			}
			for ($i=0; $i < $count_level_year; $i++) { 
				$id_level_year = $subject_level_year[$i];
				$data_subj_level_year = array('subject_id' => $subject_data['sub_id'], 'level_year' => $id_level_year );
				$success = $this->db->insert('subject_level_year',$data_subj_level_year);
			}
			for ($n=0; $n < $count_semester; $n++) { 
				$semester = $subject_semester[$n];
				$data_subj_semester = array('subject_id' => $subject_data['sub_id'],'semester' => $semester );
				$success = $this->db->insert('subject_semester',$data_subj_semester);
			}
			for ($i=0; $i < $count_professors; $i++) { 
				$data_prof = array(
					'subject_id' => $subject_data['sub_id'],
					'person_id' => $subject_professors[$i]
				);
				$success = $this->db->insert('emp_subj_person',$data_prof);
			}

		} else {
			$success = $this->db
				->where('sub_id', $sub_id)
				->update('subjects', $subject_data);
				
			// delete_major
			$this->db->where('subject_id',$sub_id)->delete('subject_major');
			for ($i=0; $i < $count_major; $i++) { 
				$id_major = $subject_major_id[$i];
				$data_subj_major = array('subject_id' => $sub_id,'major_id' => $id_major );
				$success = $this->db->insert('subject_major',$data_subj_major);
			}
			// delete_level_year
			$this->db->where('subject_id',$sub_id)->delete('subject_level_year');
			for ($i=0; $i < $count_level_year; $i++) { 
				$id_level_year = $subject_level_year[$i];
				$data_subj_level_year = array('subject_id' => $sub_id, 'level_year' => $id_level_year );
				$success = $this->db->insert('subject_level_year',$data_subj_level_year);
			}
			// delete_semester
			$this->db->where('subject_id',$sub_id)->delete('subject_semester');
			for ($n=0; $n < $count_semester; $n++) { 
				$semester = $subject_semester[$n];
				$data_subj_semester = array('subject_id' => $sub_id,'semester' => $semester );
				$success = $this->db->insert('subject_semester',$data_subj_semester);
			}
			$this->db->where('subject_id',$sub_id)->delete('emp_subj_person');
			for ($i=0; $i < $count_professors; $i++) { 
				$data_prof = array(
					'subject_id' => $sub_id,
					'person_id' => $subject_professors[$i]
				);
				$success = $this->db->insert('emp_subj_person',$data_prof);
			}

		}

		$this->db->trans_complete();
		return $success;
	}

	function exists($sub_id)
	{
		$this->db->from('subjects');
		$this->db->where('subjects.sub_id',$sub_id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}

	/*
	Get search suggestions to find subjects
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		// SEARCH NAME
		$this->db->from('subjects');
		$this->db->where("(subject_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->subject_name;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}
		// SEARCG NAME KH
		$this->db->from('subjects');
		$this->db->where("(subject_name_kh LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->subject_name_kh;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}
		// SEARCH SHORT NAME
		$this->db->from('subjects');
		$this->db->where("(subjects_short_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->subjects_short_name;
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

	/*
	Deletes a list of subjects
	*/
	function delete_list($sub_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from subjects table
		$this->db->where_in('sub_id',$sub_id);
		$success = $this->db->update('subjects', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	function delete($sub_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($sub_id && $this->exists($sub_id)) {
			$success = $this->db->where('sub_id', $sub_id)->update('subjects', array('is_status' => 1));
		}
		$this->db->trans_complete();
		return $success;
	}

	function get_all_major(){			
		return $q = $this->db->where('is_status',0)->get('skill')->result();
	}
	function get_all_major_byid($major_id){
		return $q = $this->db->where('is_status',0)->where('skill_id',$major_id)->get('skill');
	}
	function get_skill_by_id($get_id)
	{
		$query = $this->db
					->where('skill_id',$get_id)
		            ->where("is_status", 0)
		            ->get('skill');
		return $query;
	}
	function get_subject_year($major_id){
		return $this->db->where('subject_major.major_id',$major_id)
						->join('subject_major','subject_major.subject_id = subjects.sub_id')
						->join('subject_level_year','subject_level_year.subject_id = subjects.sub_id')
						->group_by('subject_level_year.level_year')
						->get('subjects');
	}
	function get_subject($major_id, $level_year, $semester){
		return $this->db->where('subject_major.major_id',$major_id)
						->where('subject_semester.semester', $semester)
						->where('subject_level_year.level_year',$level_year)
						->join('subject_major','subject_major.subject_id = subjects.sub_id')
						->join('subject_level_year','subject_level_year.subject_id = subjects.sub_id')
						->join('subject_semester','subject_semester.subject_id = subjects.sub_id')
						->get('subjects');
	}

	// function get_all_subjects(){
	// 	return $this->db->where('is_status',0)->get('subjects');
	// }
	function get_prof_drop_down($sub_id = ''){
		$this->db->from('people');
        $this->db->join('employees','employees.person_id = people.person_id','left');
        $this->db->join('emp_master','emp_master.emp_master_user_id=people.person_id','left');
        $this->db->join('edu_emp_major_person','edu_emp_major_person.person_id = people.person_id','left');
        if($sub_id){           	
        	$this->db->join('edu_emp_subj_person','edu_emp_subj_person.person_id = people.person_id','left');
        }
        $this->db->where_in('employees.user_type_id',10);
        if($sub_id){
           	$this->db->where('edu_emp_subj_person.subject_id',$sub_id);
        }
        $query = $this->db->get();
        return $query;
	}
	function get_prof_by_id($id_prof){
		$this->db->from('people');
        $this->db->join('employees','employees.person_id = people.person_id','left');
        $this->db->join('emp_master','emp_master.emp_master_user_id=people.person_id','left');
        $this->db->join('edu_emp_major_person','edu_emp_major_person.person_id = people.person_id','left');
        $this->db->where_in('employees.user_type_id',10);
        $this->db->where_in('edu_emp_major_person.major_id',$id_prof);
        $this->db->group_by('people.person_id');
        $query = $this->db->get();
        return $query;
	}

	function get_view_prof_by_subj($sub_id){
		$this->db->from('people');
        $this->db->join('employees','employees.person_id = people.person_id','left');
        $this->db->join('emp_master','emp_master.emp_master_user_id=people.person_id','left');
        $this->db->join('edu_emp_major_person','edu_emp_major_person.person_id = people.person_id','left');
        $this->db->join('edu_emp_subj_person','edu_emp_subj_person.person_id = people.person_id','left');
        $this->db->where_in('employees.user_type_id',10);
        $this->db->where('edu_emp_subj_person.subject_id',$sub_id);
        $this->db->group_by('people.person_id');
        $query = $this->db->get();
        return $query;
	}
	
}