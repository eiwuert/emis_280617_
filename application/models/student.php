<?php
class Student extends Person
{	
	/*
	Determines if a given person_id is a customer
	*/
	function exists($stu_info_id)
	{
		$this->db->from('stu_master');	
		$this->db->where('stu_master.stu_master_stu_info_id',$stu_info_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	function get_all($limit=10000, $offset=0,$col='stu_master_id',$order='desc')
	{
		$stu_info = $this->db->dbprefix('stu_info');
        $stu_master = $this->db->dbprefix('stu_master');
        $stu_academic = $this->db->dbprefix('stu_academic');
        $major = $this->db->dbprefix('skill');
        $data = $this->db->query("SELECT * 
						FROM " . $stu_master . "
						STRAIGHT_JOIN " . $stu_info . " ON " . $stu_master . ".stu_master_stu_info_id = " . $stu_info . ".stu_info_id 
						LEFT JOIN " . $stu_academic . " ON " . $stu_academic . ".stu_acad_stu_info_id = " . $stu_info . ".stu_info_id 
						LEFT JOIN " . $major . " ON " . $major . ".skill_id = " . $stu_academic . ".stu_acad_skill_id 
						WHERE ".$stu_master.".is_status = 0 AND is_refer_out = 0 GROUP BY ".$stu_info.".stu_info_id ORDER BY " . $col . " " . $order . " LIMIT " . $offset . "," . $limit);
        return $data;
	}
	
	function get_all_universities()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('university');
		return $query->result();
	}
	
	function count_all()
	{
		$this->db->from('stu_info');
		$this->db->join('stu_master','stu_master.stu_master_stu_info_id=stu_info.stu_info_id');
		$this->db->where('is_status',0)->where('is_refer_out', 0);
		return $this->db->count_all_results();
	}

	function get_info($stu_info_id)
	{

		$this->db->select('*, 
			pro_cadd.province_name as province_name_cadd, pro_cadd.province_name_kh as province_name_kh_cadd,
			pro_badd.province_name as province_name_badd, pro_badd.province_name_kh as province_name_kh_badd,
			pro_padd.province_name as province_name_padd, pro_padd.province_name_kh as province_name_kh_padd,
			room.room_name as room_name, school_class.school_class_name as class_name,
			grade.grade_name as grade_name
			');
		$this->db->from('stu_info');
		$this->db->join('stu_master', 'stu_master.stu_master_stu_info_id = stu_info.stu_info_id');
		$this->db->join('stu_academic', 'stu_academic.stu_acad_stu_master_id = stu_master.stu_master_id');
		$this->db->join('stu_address', 'stu_master.stu_master_stu_address_id = stu_address.stu_address_id', 'left');
		$this->db->join('provinces pro_cadd', 'pro_cadd.province_id = stu_address.stu_cadd_province', 'left');
		$this->db->join('provinces pro_badd', 'pro_badd.province_id = stu_address.stu_badd_province', 'left');
		$this->db->join('provinces pro_padd', 'pro_padd.province_id = stu_address.stu_padd_province', 'left');
		$this->db->join('employees', 'stu_master.stu_master_user_id = employees.person_id', 'left');
		$this->db->join('room', 'stu_info.stu_master_stu_room = room.room_id', 'left');
		$this->db->join('school_class', 'stu_info.stu_master_stu_class = school_class.school_class_id', 'left');
		$this->db->join('grade', 'stu_info.students_grade = grade.grade_id', 'left');
		$this->db->where('stu_info.stu_info_id',$stu_info_id);
		$this->db->where('stu_academic.stu_acad_register',1);
		$query = $this->db->get();	
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $customer_id is NOT an customer
			$stu_obj = new stdClass;
			
			//Get all the fields from customer table
			$fields = $this->db->list_fields('stu_info');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$stu_obj->$field='';
			}

			$emp_fields = $this->db->list_fields('employees');			
			foreach ($emp_fields as $field)
			{
				$stu_obj->$field='';
			}

			$stu_master_fields = $this->db->list_fields('stu_master');			
			foreach ($stu_master_fields as $field)
			{
				$stu_obj->$field='';
			}			
			return $stu_obj;
		}
	}
	function save_person(&$person_data, &$employee_data, $employee_id=false)
	{
		$success=false;
					
		if(parent::save($person_data,$employee_id))
		{
			if (!$employee_id)
			{
				$employee_data['person_id'] = $person_data['person_id'];
				$success = $this->db->insert('employees',$employee_data);
			}
			else
			{
				$this->db->where('person_id', $employee_id);
				$success = $this->db->update('employees',$employee_data);		
			}
		}
		return $success;

	}

	function save_address(&$stu_address_data, $stu_address_id=false) {
		$success = false;
		if (!$stu_address_id) {
			$this->db->insert("stu_address", $stu_address_data);
			$success = $stu_address_data['stu_address_id'] = $this->db->insert_id();
		} else {
			$this->db->where('stu_address_id', $stu_address_id);
			$success = $this->db->update('stu_address', $stu_address_data);

		}
		return $success;
	}
 
	function save_guardian(&$guardian_data, $option=false) 
	{
		$success = false;
		if ($option == -1) {
			$this->db->insert("stu_guardians", $guardian_data);
			$success = $guardian_data['stu_guardian_id'] = $this->db->insert_id();
		} else {
			$this->db->where('stu_guardian_id', $option);
			$success = $this->db->update('stu_guardians', $guardian_data);
		}
		return $success;
	}
	
	/*
	Inserts or updates a student
	*/
	function save($stu_master_data, &$stu_acad_data, &$stu_info_data, &$stu_address_data, &$person_data, &$employee_data, $stu_info_id=false, $employee_id=false, $stu_address_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		$this->save_address($stu_address_data);
		$this->save_person($person_data, $employee_data, $employee_id);

		if($this->save_stu_info($stu_info_data, $stu_info_id))
		{
			if (!$stu_info_id or !$this->exists($stu_info_id))
			{
				$stu_master_data['stu_master_user_id'] = $employee_data['person_id'];
				$stu_master_data['stu_master_stu_address_id'] = $stu_address_data['stu_address_id'];
				$stu_master_data['stu_master_stu_info_id'] = $stu_info_id = $stu_info_data['stu_info_id'];
				$success = $this->db->insert('stu_master',$stu_master_data);
				$stu_master_data['stu_master_id'] = $this->db->insert_id();
				if($stu_master_data['stu_master_id']){
					$stu_acad_data['stu_acad_stu_master_id'] = $stu_master_data['stu_master_id'];
					$stu_acad_data['stu_acad_stu_info_id'] = $stu_info_id = $stu_info_data['stu_info_id'];
					$success = $this->db->insert('stu_academic',$stu_acad_data);
				}
			}
			else
			{
				$this->db->where('stu_master_stu_info_id', $stu_info_id);
				$success = $this->db->update('stu_master',$stu_master_data);
			}			
		}
		
		$this->db->trans_complete();
		return $success;
	}

	function save_academic(&$stu_master_data,&$stu_info_data, $stu_info_id=false){
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if($this->save_stu_info($stu_info_data, $stu_info_id))
		{
			if (!$stu_info_id or !$this->exists($stu_info_id))
			{
				$stu_master_data['stu_master_user_id'] = $employee_data['person_id'];
				$stu_master_data['stu_master_stu_address_id'] = $stu_address_data['stu_address_id'];
				$stu_master_data['stu_master_stu_info_id'] = $stu_info_id = $stu_info_data['stu_info_id'];
				$success = $this->db->insert('stu_master',$stu_master_data);
			}
			else
			{
				$this->db->where('stu_master_stu_info_id', $stu_info_id);
				$success = $this->db->update('stu_master',$stu_master_data);
			}			
		}

		
		$this->db->trans_complete();
		return $success;
	}

	function save_stu_info(&$stu_info_data,$stu_info_id=false)
	{		
					
		if (!$stu_info_id or !$this->exists_stu_info($stu_info_id))
		{
			if ($this->db->insert('stu_info',$stu_info_data))
			{
				$stu_info_data['stu_info_id']=$this->db->insert_id();
				return true;
			}
			
			return false;
		}
		$this->db->where('stu_info_id', $stu_info_id);
		return $this->db->update('stu_info',$stu_info_data);

	}

	function exists_stu_info($stu_info_id)
	{
		$this->db->from('stu_info');	
		$this->db->where('stu_info.stu_info_id',$stu_info_id);
		$query = $this->db->get();	
		return ($query->num_rows()==1);
	}

	function get_last_running_number() 
    {
        $query = $this->db
                    ->select('stu_unique_auto_num')
                    ->order_by("stu_info_id", "desc")
                    ->limit(1)
                    ->get('stu_info');
        if($query->num_rows() > 0){
            $data = $query->row();
            $id = $data->stu_unique_auto_num;
            return $id;
            // $proposal_code = explode("-", $id);
            // return $proposal_code[1];
        }else{
            return false;
        }
    }
	/*
	Deletes a list of student
	*/
	function delete_list($stu_ids)
	{		
		$this->db->where_in('stu_master_id',$stu_ids);
		return $this->db->update('stu_master', array('is_status' => 1));
 	}
	
	function check_duplicate($term)
	{
		$this->db->from('stu_info');
		$this->db->join('stu_master','stu_info.stu_info_id = stu_master.stu_master_stu_info_id');
		$this->db->where('is_status',0);	
		$query = $this->db->where("stu_unique_auto_num = ".$this->db->escape($term));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return true;
		}
		return false;
	}

	
	function check_duplicate_academic($term)
	{
		$this->db->from('stu_info');
		$this->db->join('stu_master','stu_info.stu_info_id = stu_master.stu_master_stu_info_id');
		$this->db->where('is_status',0);	
		$query = $this->db->where("stu_admission_date = ".$this->db->escape($term));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return true;
		}
		
		return false;
	}
 	/*
		Get search suggestions to find customers
	*/
	function get_all_suggestion_type($limit,$get_q){
        $this->db->from('stu_info');
        $this->db->join('stu_master','stu_master.stu_master_stu_info_id = stu_info.stu_info_id','left');   
        $this->db->where($get_q);  
        $this->db->where('stu_master.is_status','0');       
        $this->db->limit($limit);   
        return $query = $this->db->get();
	}

	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();
		// last name
		$q_name = "(edu_stu_info.stu_last_name LIKE '%".$this->db->escape_like_str($search)."%')";
		$by_name = $this->get_all_suggestion_type($limit,$q_name);
		// by first name
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->stu_last_name;
		}		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}

		// first name
		$q_name = "(edu_stu_info.stu_first_name LIKE '%".$this->db->escape_like_str($search)."%')";
		$by_name = $this->get_all_suggestion_type($limit,$q_name);
		// by first name
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
	
	/*
	Preform a search on student
	*/
	function search($search, $limit=20,$offset=0,$column='stu_master_id',$orderby='desc')
	{
		$this->db->from('stu_info');
		$this->db->join('stu_master','stu_master.stu_master_stu_info_id=stu_info.stu_info_id');
		$this->db->join('stu_academic','stu_academic.stu_acad_stu_info_id=stu_info.stu_info_id','left');
		$this->db->join('skill','skill.skill_id=stu_academic.stu_acad_skill_id','left');
		$this->db->where("(stu_first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		stu_last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		stu_email_id LIKE '%".$this->db->escape_like_str($search)."%' or
		CONCAT(`stu_first_name_kh`,' ',`stu_last_name_kh`) LIKE '%".$this->db->escape_like_str($search)."%' or 
		CONCAT(`stu_first_name`,' ',`stu_last_name`) LIKE '%".$this->db->escape_like_str($search)."%') AND edu_stu_master.is_status = 0 AND is_refer_out = 0");	
		
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	
	function search_count_all($search, $limit=10000)
	{
		$this->db->from('stu_info');
		$this->db->join('stu_master','stu_master.stu_master_stu_info_id=stu_info.stu_info_id');
		$this->db->where("(stu_first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		stu_last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		stu_email_id LIKE '%".$this->db->escape_like_str($search)."%' or 
		CONCAT(`stu_first_name_kh`,' ',`stu_last_name_kh`) LIKE '%".$this->db->escape_like_str($search)."%' or 
		CONCAT(`stu_first_name`,' ',`stu_last_name`) LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0 AND is_refer_out = 0");
		$this->db->limit($limit);
		$result=$this->db->get();				
		return $result->num_rows();
	}
	function get_all_skills($department_id='')
	{
		$this->db->from('skill');
		$this->db->where("is_status", 0);
		// if($department_id > 0){
		// 	$this->db->where('faculty_id',$department_id);
		// }
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_country(){
		$query = $this->db->where("is_status", 0)->get('edu_country');
		return $query->result();
	}

	function get_state(){
		$query = $this->db->where("is_status", 0)->get('edu_state');
		return $query->result();
	}

	function get_city(){
		$query = $this->db->where("is_status", 0)->get('edu_city');
		return $query->result();
	}

	function get_courses(){
		$query = $this->db->where("is_status", 0)->get('edu_courses');
		return $query->result();
	}

	function get_batchs(){
		$query = $this->db->where("is_status", 0)->get('edu_batches');
		return $query->result();
	}

	function get_section()
	{
		$query = $this->db->where("is_status", 0)->get('edu_section');
		return $query->result();
	}

	function get_stu_status()
	{
		$query = $this->db->where("is_status", 0)->get('edu_stu_status');
		return $query->result();
	}

	function get_guardian_info($stu_info_id)
	{
		$query = $this->db->where('guardian_stu_info_id',$stu_info_id)->where('stu_guardians.is_status', 0)->get('stu_guardians');
		if($query->num_rows() > 0)
		{
			return $query;
		}
	}

	function guardian_update_info($guardian_id)
	{
		$this->db->from('stu_guardians');	
		$this->db->where('stu_guardians.stu_guardian_id',$guardian_id);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
	}

	function delete_guardian($stu_guardian_id)
	{
		$this->db->where('stu_guardian_id',$stu_guardian_id);
		return $this->db->update('stu_guardians', array('is_status' => 1));
 	}
 	function delete_transfer($transfer_id)
	{
		$this->db->where('stu_transfer_id',$transfer_id);
		return $this->db->delete('stu_transfer');
 	}
 	function delete_job_status($job_id)
	{
		$this->db->where('stu_job_id',$job_id);
		return $this->db->delete('stu_job');
 	} 	
 	function delete_academic($acad_id)
	{
		$this->db->where('stu_acad_id',$acad_id);
		$this->db->where('stu_acad_register',0);
		return $this->db->delete('stu_academic');
 	}

 	function save_transfer(&$transfer_data, $stu_master_id=false, $stu_transfer_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($stu_transfer_id <= 0) {
			$success= $this->db->insert("stu_transfer", $transfer_data);
			$transfer_data['stu_transfer_id'] = $this->db->insert_id();
		} else {
			$this->db->where('stu_transfer_id', $stu_transfer_id);
			$success = $this->db->update('stu_transfer', $transfer_data);
		}
		$success = $this->db->trans_complete();
		return $success;
	}

	function get_all_students_transfer($stu_master_id=-1, $transfer_type=false)
	{
		if ($transfer_type == 'major') {
			$this->db->select('stu_transfer_id, stu_transfer.university_id, stu_transfer.skill_id, skill_name, skill_name_kh, transfer_type, changed_date, remark');
			$this->db->join('skill', 'skill.skill_id = stu_transfer.skill_id');
		} else {
			$this->db->select('stu_transfer_id, stu_transfer.university_id, stu_transfer.skill_id, university_name, university_name_kh, transfer_type, changed_date, remark');
			$this->db->join('university', 'university.university_id = stu_transfer.university_id');
		}
		$this->db->join('stu_master', 'stu_master.stu_master_id = stu_transfer.stu_transfer_stu_master_id');
		$this->db->where('transfer_type', $transfer_type);
		$this->db->where('stu_transfer_stu_master_id', $stu_master_id);
		$this->db->where('stu_transfer.is_status', 0);
		$query = $this->db->get('stu_transfer');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}
	function save_refer(&$refer_data, $stu_master_id=false, $stu_refer_id=false) {
		$success = false;
		$this->db->trans_start();
		if (!$stu_refer_id || $stu_refer_id == -1) {
			$success= $this->db->insert("stu_refer", $refer_data);
			$refer_data['stu_refer_id'] = $this->db->insert_id();
		} else {
			$this->db->where('stu_refer_id', $stu_refer_id);
			$success = $this->db->update('stu_refer', $refer_data);
		}
		if ($refer_data['refer_type'] == 'refer_out') {
			$this->update_student_refer_out($stu_master_id);
		}
		$success = $this->db->trans_complete();
		return $success;
	}

	function update_student_refer_out($stu_master_id)
	{
		return $this->db->where('stu_master_id', $stu_master_id)->update('stu_master', array('is_refer_out' => 1));
	}

	function save_postpon(&$postpon_data, $stu_master_id=false, $stu_postpon_id=false) {
		$success = false;
		$this->db->trans_start();
		if (!$stu_postpon_id || $stu_postpon_id == -1) {
			$success= $this->db->insert("stu_postpon", $postpon_data);
			$postpon_data['stu_postpon_id'] = $this->db->insert_id();
		} else {
			$this->db->where('stu_postpon_id', $stu_postpon_id);
			$success = $this->db->update('stu_postpon', $postpon_data);
		}
		$success = $this->db->trans_complete();
		return $success;
	}

	function get_all_students_postpon($stu_master_id=-1, $postpon_type=false)
	{
		$this->db->select('stu_postpon_id, start_date, end_date, postpon_type, reason_why, duration');
		$this->db->join('stu_master', 'stu_master.stu_master_id = stu_postpon.stu_postpon_stu_master_id');
		$this->db->where('postpon_type', $postpon_type);
		$this->db->where('stu_postpon_stu_master_id', $stu_master_id);
		$this->db->where('stu_postpon.is_status', 0);
		$query = $this->db->get('stu_postpon');
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		return false;
	}

	function get_students_postpon_by_id($stu_postpon_id=-1, $postpon_type=false)
	{
		$this->db->select('stu_postpon_id, start_date, end_date, postpon_type, reason_why, duration');
		$this->db->join('stu_master', 'stu_master.stu_master_id = stu_postpon.stu_postpon_stu_master_id');
		$this->db->where('postpon_type', $postpon_type);
		$this->db->where('stu_postpon_id', $stu_postpon_id);
		$this->db->where('stu_postpon.is_status', 0);
		$query = $this->db->get('stu_postpon');
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
	}

	function get_students_refer($stu_refer_id, $refer_type, $stu_master_id=false)
	{
		$this->db->select('*');
		$this->db->join('stu_master', 'stu_master.stu_master_id = stu_refer.stu_refer_stu_master_id');
		$this->db->join('university', 'university.university_id = stu_refer.university_id', 'left');
		$this->db->join('skill', 'skill.skill_id = stu_refer.skill_id', 'left');
		$this->db->join('courses', 'courses.course_id = stu_refer.course_id', 'left');
		$this->db->join('batches', 'batches.batch_id = stu_refer.batch_id', 'left');
		$this->db->join('section', 'section.section_id = stu_refer.year_school_id', 'left');
		$this->db->join('levels', 'levels.level_id = stu_refer.level_id', 'left');
		$this->db->where('refer_type', $refer_type);
		$this->db->where('stu_refer.is_status', 0);
		if ($stu_refer_id && $stu_refer_id != -1) {
			$this->db->where('stu_refer_id', $stu_refer_id);
		}
		if ($stu_master_id) {
			$this->db->where('stu_refer_stu_master_id', $stu_master_id);
		}
		$query = $this->db->get('stu_refer');
		if ($query->num_rows() > 0) {
			if ($stu_refer_id && $stu_refer_id != -1) {
				return $query->row();
			}
			return $query->result();
		}
		return false;
	}

	function save_stu_academic(&$academic_data, $stu_acad_id=false) {
		$success = false;
		if (!$stu_acad_id || !$this->exists_stu_academic($stu_acad_id)) {
			$this->db->insert("stu_academic", $academic_data);
			$success = $academic_data['stu_acad_id'] = $this->db->insert_id();
		} else {
			$this->db->where('stu_acad_id', $stu_acad_id);
			$success = $this->db->update('stu_academic', $academic_data);

		}
		return $success;
	}

	function exists_stu_academic($stu_acad_id)
	{
		$this->db->from('stu_academic');
		$this->db->where('stu_acad_id',$stu_acad_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	function get_all_academic($stu_master_id, $stu_acad_id=false)
	{
		$this->db
			->join('courses', 'courses.course_id = stu_academic.stu_acad_course_detail_id', 'left')
			->join('levels', 'levels.level_id = courses.level_id', 'left')
			->join('university', 'university.university_id = courses.university_id', 'left')
			->join('skill', 'skill.skill_id = courses.skill_major_id', 'left')
			->join('section', 'section.section_id = courses.academic_year_id', 'left')
			->join('batches', 'batches.batch_id = stu_academic.stu_acad_batch_id', 'left')	
			->join('stu_status', 'stu_status.stu_status_id = stu_academic.stu_acad_status', 'left')
			->join('scholarships', 'scholarships.scho_id = stu_academic.stu_acad_scholarship_id', 'left')
			->where('stu_academic.stu_acad_stu_master_id', $stu_master_id);
			if ($stu_acad_id) {
				$this->db->where('stu_academic.stu_acad_id', $stu_acad_id);
			}
		$query = $this->db->get('stu_academic');
		return $query;
	}
	

	function suggest_faculty($major ='' )
	{

		$query = $this->db->select("edu_skill.skill_id,
									edu_university.university_id,
									edu_university.university_name,
									edu_university.university_name_kh")
				->where('skill.skill_id',$major)
	            ->where("skill.is_status", 0)
	            ->join('edu_university','edu_university.university_id = edu_skill.faculty_id','left')
	            ->get('skill');
	
		return $query;
	}

	function suggest_course($major_id='')
	{
		$query = $this->db->where('skill_major_id',$major_id)
	            ->where("is_status", 0)
	            ->get('courses');
		return $query;
	}

	function suggest_major($faculty_id ='' )
	{
		$query = $this->db
				->where('faculty_id',$faculty_id)
	            ->where("is_status", 0)
	            ->get('skill');
	
		return $query;
	}
	function update_prof($data, $id_stu){
		$check_file = $this->check_prof($id_stu);
		if(!empty($check_prof )){
			unlink("./assets/avatars/$check_file");
		}
		return $this->db->where('stu_info_id',$id_stu)->update('stu_info',$data);
	}

	function check_prof($id_stu){
		return $this->db->where('stu_info_id',$id_stu)->get('stu_info')->row()->profile_img;
	}

	function get_last_id_number($wid) 
	{
		return $this->db->where('stu_unique_id',$wid)->get('stu_info')->row()->stu_unique_id;
	}
	function get_info_acad_by_stu_id($stu_info_id){
		return $this->db->where('stu_acad_stu_info_id',$stu_info_id)->get('stu_academic');
	}
	function info_job_cate(){
		return $this->db->get('edu_job_category');
	}

	function save_personal(&$stu_info_data, $stu_info_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$success = $this->save_stu_info($stu_info_data, $stu_info_id);	
		$this->db->trans_complete();
		return $success;
	}
	function save_stu_job_status(&$stu_job_data, $stu_job_id=false){
		$success=false;
		$this->db->trans_start();
		if (!$stu_job_id)
		{
			$success = $this->db->insert('stu_job',$stu_job_data);
			$stu_job_data['stu_job_id']=$this->db->insert_id();
		}else{
			$success = $this->db->where('stu_job_id',$stu_job_id)->update('stu_job',$stu_job_data);
		}
		$this->db->trans_complete();
		return $success;
	}
	function stu_job_info($stu_info_id){
		return $this->db->where('stu_job_stu_info_id',$stu_info_id)->join('job_category','job_category.job_id = stu_job.stu_job_cate_id','left')->join('provinces','provinces.province_id = stu_job.stu_job_local_id','left')->get('stu_job');
	}
	function get_all_batches()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('batches');
		return $query->result();
	}
	function checkMailExists($mail){
		$q = $this->db->where('stu_email_id',$mail)->get('edu_stu_info')->num_rows();
		if($q == 1){
			return false;
		}else{
			return true;
		}
	}
}
?>
