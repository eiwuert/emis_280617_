<?php
class School_class_model extends CI_Model{

	function get_all($limit=10000, $offset=0,$col='school_class_id',$order='desc')
	{
		$school_class = $this->db->dbprefix('school_class');
		$data = $this->db->query("SELECT * 
						FROM " . $school_class . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function count_all()
	{
		$this->db->from('school_class');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}
	function get_byId($id)
	{
		return $this->db->where('school_class_id',$id)->where('is_status',0)->get('school_class');
	}
	function search($search, $limit=20,$offset=0,$column='school_class_id',$orderby='desc')
	{
		$this->db->from('school_class');
		$this->db->where("(school_class_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('school_class');
		$this->db->where("(school_class_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function get_info($school_class_id)
	{
		$this->db->from('school_class');	
		$this->db->where('school_class_id',$school_class_id);
		$query = $this->db->get();
		if($query->num_rows()==1) {
			return $query->row();
		} else {
			//Get all the fields from school_class table
			$fields = $this->db->list_fields('school_class');

			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}

			return $person_obj;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('school_class');
		$this->db->where('is_status',0);
		$query = $this->db->where("school_class_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}

	function school_class_exists($school_class_name)
	{
		$this->db->from('school_class');
		$this->db->where('school_class.school_class_name',$school_class_name);
		$this->db->where('school_class.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->school_class_name;
		}
	}

	/*
	Inserts or updates a school_class
	*/
	function save(&$school_class_data, $school_class_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$school_class_id or !$this->exists($school_class_id)) {
			$success = $this->db->insert('school_class',$school_class_data);
			$school_class_data['school_class_id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('school_class_id', $school_class_id)
				->update('school_class', $school_class_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function exists($school_class_id)
	{
		$this->db->from('school_class');
		$this->db->where('school_class.school_class_id',$school_class_id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}

	/*
	Get search suggestions to find school_class
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->db->from('school_class');
		$this->db->where("(school_class_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->school_class_name;
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
	Deletes a list of school_class
	*/
	function delete_list($school_class_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from school_class table
		$this->db->where_in('school_class_id',$school_class_id);
		$success = $this->db->update('school_class', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	function autocomplete_school_class($term)
	{
		$data = $this->db->from('school_class')
			->like('school_class_name', $term)
			->where('is_status', 0)
			->get();
		return $data;
	}

	function delete($school_class_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($school_class_id && $this->exists($school_class_id)) {
			$success = $this->db->where('school_class_id', $school_class_id)->update('school_class', array('is_status' => 1));
		}
		$this->db->trans_complete();
		return $success;
	}

}