<?php
class Grades extends CI_Model{

	function get_all($limit=10000, $offset=0,$col='grade_id',$order='desc')
	{
		$grade = $this->db->dbprefix('grade');
		$data = $this->db->query("SELECT * 
						FROM " . $grade . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function count_all()
	{
		$this->db->from('grade');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function search($search, $limit=20,$offset=0,$column='grade_id',$orderby='desc')
	{
		$this->db->from('grade');
		$this->db->where("(grade_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('grade');
		$this->db->where("(grade_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function get_info($grade_id)
	{
		$this->db->from('grade');	
		$this->db->where('grade_id',$grade_id);
		$query = $this->db->get();
		if($query->num_rows()==1) {
			return $query->row();
		} else {
			//Get all the fields from grade table
			$fields = $this->db->list_fields('grade');

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
		$this->db->from('grade');
		$this->db->where('is_status',0);
		$query = $this->db->where("grade_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}

	function grade_exists($grade_name)
	{
		$this->db->from('grade');
		$this->db->where('grade.grade_name',$grade_name);
		$this->db->where('grade.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->grade_name;
		}
	}

	/*
	Inserts or updates a grade
	*/
	function save(&$grade_data, $grade_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$grade_id or !$this->exists($grade_id)) {
			$success = $this->db->insert('grade',$grade_data);
			$grade_data['grade_id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('grade_id', $grade_id)
				->update('grade', $grade_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function exists($grade_id)
	{
		$this->db->from('grade');
		$this->db->where('grade.grade_id',$grade_id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}

	/*
	Get search suggestions to find grade
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->db->from('grade');
		$this->db->where("(grade_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->grade_name;
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
	Deletes a list of grade
	*/
	function delete_list($grade_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from grade table
		$this->db->where_in('grade_id',$grade_id);
		$success = $this->db->update('grade', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	function autocomplete_grade($term)
	{
		$data = $this->db->from('grade')
			->like('grade_name', $term)
			->where('is_status', 0)
			->get();
		return $data;
	}

	function delete($grade_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($grade_id && $this->exists($grade_id)) {
			$success = $this->db->where('grade_id', $grade_id)->update('grade', array('is_status' => 1));
		}
		$this->db->trans_complete();
		return $success;
	}

}