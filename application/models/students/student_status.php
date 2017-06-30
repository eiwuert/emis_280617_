<?php
class Student_status extends Person
{
	function get_all($limit=10000, $offset=0,$col='stu_status_id',$order='desc')
	{
        $stu_status = $this->db->dbprefix('stu_status');
        $data = $this->db->query("SELECT * 
						FROM " . $stu_status . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
        return $data;
	}

	function count_all()
	{
		$this->db->from('stu_status');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function search($search, $limit=20,$offset=0,$column='stu_status_id',$orderby='desc')
	{
		$this->db->from('stu_status');
		$this->db->where("(stu_status_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('stu_status');
		$this->db->where("(stu_status_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();				
		return $result->num_rows();
	}

	function get_info($stu_status_id)
	{
		$this->db->from('stu_status');	
		$this->db->where('stu_status_id',$stu_status_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{			
			//Get all the fields from stu_status table
			$fields = $this->db->list_fields('stu_status');
			
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
		$this->db->from('stu_status');
		$this->db->where('is_status',0);		
		$query = $this->db->where("stu_status_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}

	function student_status_exists($stu_status_name)
	{
		$this->db->from('stu_status');	
		$this->db->where('stu_status.stu_status_name',$stu_status_name);
		$this->db->where('stu_status.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->stu_status_name;
		}
	}

	/*
	Inserts or updates a student status
	*/
	function save(&$stu_status_data, $stu_status_id=false)
	{
		$success=false;
		
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
			
		if (!$stu_status_id or !$this->exists($stu_status_id))
		{
			$success = $this->db->insert('stu_status',$stu_status_data);
			$stu_status_data['stu_status_id'] = $this->db->insert_id();
		}
		else
		{
			$this->db->where('stu_status_id', $stu_status_id);
			$success = $this->db->update('stu_status',$stu_status_data);		
		}
		
		$this->db->trans_complete();		
		return $success;
	}

	function exists($stu_status_id)
	{
		$this->db->from('stu_status');	
		$this->db->where('stu_status.stu_status_id',$stu_status_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}

	/*
	Get search suggestions to find employees
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->from('stu_status');
		
		$this->db->where("(stu_status_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");
		
		$this->db->limit($limit);	
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->stu_status_name;
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
	Deletes a list of stu_status
	*/
	function delete_list($stu_status_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from stu_status table
		$this->db->where_in('stu_status_id',$stu_status_id);
		$success = $this->db->update('stu_status', array('is_status' => 1));
		$this->db->trans_complete();		
		return $success;
 	}

 	function delete($stu_status_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($stu_status_id && $this->exists($stu_status_id)) {
			$success = $this->db->where('stu_status_id', $stu_status_id)->update('stu_status', array('is_status' => 1));
		}
		$this->db->trans_complete();
		return $success;
	}

 	function get_detail($stu_status_id)
	{
		$this->db->select('*, CONCAT(creator.`first_name`," ",creator.`last_name`) as creator_name, CONCAT(updator.`first_name`," ",updator.`last_name`) as updator_name', FALSE);
		$this->db->from('stu_status');
		$this->db->join('people as creator', 'creator.person_id = stu_status.created_by');
		$this->db->join('people as updator', 'updator.person_id = stu_status.updated_by', 'left');
		$this->db->where('stu_status_id',$stu_status_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		return false;
	}

}