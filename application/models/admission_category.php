<?php
/**
* Admission_category table information
*/
class Admission_category extends CI_Model
{
	
	function get_info($stu_category_id)
	{
		$this->db->from('stu_category');	
		$this->db->where('stu_category_id',$stu_category_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $stu_category_id is NOT an stu_category
			$stu_category_obj = new stdClass;
			
			//Get all the fields from stu_category table
			$fields = $this->db->list_fields('stu_category');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$stu_category_obj->$field='';
			}
			
			return $stu_category_obj;
		}
	}

	function save(&$admission_data, $admission_category_id=false){
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$admission_category_id or !$this->exists($admission_category_id))
		{
			$success = $this->db->insert('stu_category',$admission_data);
			$admission_data['admission_id'] = $this->db->insert_id();
			
		}
		else
		{


			$this->db->where('stu_category_id', $admission_category_id);
			$success = $this->db->update('stu_category',$admission_data);	
				
		}

		$this->db->trans_complete();	
		return $success;
	}



	function exists($admission_category_id)
	{
		$this->db->from('stu_category');	
		$this->db->where('stu_category.stu_category_id',$admission_category_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}

	function count_all()
	{
		$this->db->from('stu_category');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function get_all($limit=10000, $offset=0,$col='stu_category_id',$order='desc')
	{

        $admission = $this->db->dbprefix('stu_category');
        $data = $this->db->query("SELECT * 
						FROM " . $admission . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
        return $data;
	}
	/*
	Get search suggestions to find employees
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();
		
		$this->db->from('stu_category');
		
		$this->db->where("(stu_category_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");
		
		$this->db->limit($limit);	
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->stu_category_name;
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

	function check_duplicate($term)
	{
		$this->db->from('stu_category');
		$this->db->where('is_status',0);		
		$query = $this->db->where("stu_category_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}	

	function admission_exists($admission_name)
	{
		$this->db->from('stu_category');	
		$this->db->where('stu_category.stu_category_name',$admission_name);
		$this->db->where('stu_category.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->stu_category_name;
		}
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('stu_category');
		$this->db->where("(stu_category_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();				
		return $result->num_rows();
	}

	/*
	Deletes a list of designation
	*/
	function delete_list($stu_category_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from designation table
		$this->db->where_in('stu_category_id',$stu_category_id);
		$success = $this->db->update('stu_category', array('is_status' => 1));
		$this->db->trans_complete();		
		return $success;
 	}


	function search($search, $limit=20,$offset=0,$column='stu_category_id',$orderby='desc')
	{
		$this->db->from('stu_category');
		$this->db->where("(stu_category_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}


}