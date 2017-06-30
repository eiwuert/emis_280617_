<?php
/**
* Section table information
*/
class Section extends CI_Model
{
	function get_all($limit=10000, $offset=0,$col='section_id',$order='desc')
	{
		$section = $this->db->dbprefix('section');
		$data = $this->db->query("SELECT * 
						FROM " . $section . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}
	function count_all()
	{
		$this->db->from('section');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}
	function get_byId($id)
	{
		return $this->db->where('section_id',$id)->where('is_status',0)->get('section');
	}

	function search($search, $limit=20,$offset=0,$column='section_id',$orderby='desc')
	{
		$this->db->from('section');
		$this->db->where("(section_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('section');
		$this->db->where("(section_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function check_duplicate($term)
	{
		$this->db->from('section');
		$this->db->where('is_status',0);
		$query = $this->db->where("section_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}

	/*
	Inserts or updates a section
	*/
	function save(&$section_data, $section_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$section_id or !$this->exists($section_id)) {
			$success = $this->db->insert('section',$section_data);
			$section_data['section_id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('section_id', $section_id)
				->update('section', $section_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function exists($section_id)
	{
		$this->db->from('section');
		$this->db->where('section.section_id',$section_id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}

	/*
	Get search suggestions to find section
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->db->from('section');
		$this->db->where("(section_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->section_name;
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
	Deletes a list of section
	*/
	function delete_list($section_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from section table
		$this->db->where_in('section_id',$section_id);
		$success = $this->db->update('section', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	function delete($section_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($section_id && $this->exists($section_id)) {
			$success = $this->db->where('section_id', $section_id)->update('section', array('is_status' => 1));
		}
		$this->db->trans_complete();
		return $success;
	}

	function section_exists($section_name)
	{
		$this->db->from('section');
		$this->db->where('section.section_name',$section_name);
		$this->db->where('section.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->section_name;
		}
	}

	function get_info($section_id)
	{
		$this->db->from('section');	
		$this->db->where('section_id',$section_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $section_id is NOT an section
			$section_obj = new stdClass;
			
			//Get all the fields from section table
			$fields = $this->db->list_fields('section');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$section_obj->$field='';
			}
			
			return $section_obj;
		}
	}

}