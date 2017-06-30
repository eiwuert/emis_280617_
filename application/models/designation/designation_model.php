<?php
class Designation_model extends CI_Model{
	
	function get_all($limit=10000, $offset=0,$col='designation_id',$order='desc')
	{

        $designation = $this->db->dbprefix('designation');
        $data = $this->db->query("SELECT * 
						FROM " . $designation . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
        return $data;
	}

	function count_all()
	{
		$this->db->from('designation');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function search($search, $limit=20,$offset=0,$column='designation_id',$orderby='desc')
	{
		$this->db->from('designation');
		$this->db->where("(designation_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('designation');
		$this->db->where("(designation_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();				
		return $result->num_rows();
	}

	function get_info($designation_id)
	{
		$this->db->from('designation');	
		$this->db->where('designation_id',$designation_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{			
			//Get all the fields from designation table
			$fields = $this->db->list_fields('designation');
			
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
		$this->db->from('designation');
		$this->db->where('is_status',0);		
		$query = $this->db->where("designation_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}

	function designation_exists($designation_name)
	{
		$this->db->from('designation');	
		$this->db->where('designation.designation_name',$designation_name);
		$this->db->where('designation.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->designation_name;
		}
	}

	/*
	Inserts or updates a designation
	*/
	function save(&$designation_data, $designation_id=false)
	{
		$success=false;
		
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$designation_id or !$this->exists($designation_id))
		{
			$success = $this->db->insert('designation',$designation_data);
			$designation_data['designation_id'] = $this->db->insert_id();
			
		}
		else
		{
			$this->db->where('designation_id', $designation_id);
			$success = $this->db->update('designation',$designation_data);	
				
		}

		$this->db->trans_complete();		
		return $success;
	}

	function exists($designation_id)
	{
		$this->db->from('designation');	
		$this->db->where('designation.designation_id',$designation_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}

	/*
	Get search suggestions to find employees
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->from('designation');
		
		$this->db->where("(designation_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");
		
		$this->db->limit($limit);	
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->designation_name;
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
	Deletes a list of designation
	*/
	function delete_list($designation_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from designation table
		$this->db->where_in('designation_id',$designation_id);
		$success = $this->db->update('designation', array('is_status' => 1));
		$this->db->trans_complete();		
		return $success;
 	}

 	function delete($designation_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($designation_id && $this->exists($designation_id)) {
			$success = $this->db->where('designation_id', $designation_id)->update('designation', array('is_status' => 1));
		}
		$this->db->trans_complete();
		return $success;
	}

 	function get_detail($designation_id)
	{
		$this->db->select('*, CONCAT(creator.`first_name`," ",creator.`last_name`) as creator_name, CONCAT(updator.`first_name`," ",updator.`last_name`) as updator_name', FALSE);
		$this->db->from('designation');
		$this->db->join('people as creator', 'creator.person_id = designation.created_by');
		$this->db->join('people as updator', 'updator.person_id = designation.updated_by', 'left');
		$this->db->where('designation_id',$designation_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		return false;
	}


	
}