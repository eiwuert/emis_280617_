<?php
/**
* Batch table information
*/
class Batch extends CI_Model
{
	
	function get_info($batch_id)
	{
		$this->db->from('batches');	
		$this->db->where('batch_id',$batch_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $batch_id is NOT an batch
			$batch_obj = new stdClass;
			
			//Get all the fields from batch table
			$fields = $this->db->list_fields('batches');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$batch_obj->$field='';
			}
			
			return $batch_obj;
		}
	}

	function get_all($limit=10000, $offset=0,$col='batch_id',$order='desc')
	{
		$batches = $this->db->dbprefix('batches');
		$data = $this->db->query("SELECT * 
						FROM " . $batches . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function count_all()
	{
		$this->db->from('batches');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function search($search, $limit=20,$offset=0,$column='batch_id',$orderby='desc')
	{
		$this->db->from('batches');
		$this->db->where("(batch_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	function search_count_all($search, $limit=10000)
	{
		$this->db->from('batches');
		$this->db->where("(batch_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	/*
		Get search suggestions to find school_class
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->db->from('batches');
		$this->db->where("(batch_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->batch_name;
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

	function batch_exists($batch_name)
	{
		$this->db->from('batches');
		$this->db->where('batches.batch_name',$batch_name);
		$this->db->where('batches.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->batch_name;
		}
	}

	function suggest_faculty($major_id ='' )
	{
		if($major_id !== ''){
			$query = $this->db->select("edu_skill.skill_id,
										edu_university.university_id,
										edu_university.university_name,
										edu_university.university_name_kh")
					->where('skill.skill_id',$major_id)
		            ->where("skill.is_status", 0)
		            ->join('edu_university','edu_university.university_id = edu_skill.faculty_id','left')
		            ->get('skill');
		}else{
			$query = $this->db
		            ->where("is_status", 0)
		            ->get('university');
		}
		return $query;
	}
	function get_all_major()
	{
		$query = $this->db
		            ->where("is_status", 0)
		            ->get('skill');
		return $query->result();
	}

	/*
		Inserts or updates a school_class
	*/
	function save(&$batch_data, $batch_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if ($batch_id <= 0) {
			$success = $this->db->insert('batches',$batch_data);
			$batch_data['batch_id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('batch_id', $batch_id)
				->update('batches', $batch_data);
		}

		$this->db->trans_complete();
		return $success;
	}
	/*
	Deletes a list of subjects
	*/
	function delete_list($batch_to_delete)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from subjects table
		$this->db->where_in('batch_id',$batch_to_delete);
		$success = $this->db->update('batches', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}
}