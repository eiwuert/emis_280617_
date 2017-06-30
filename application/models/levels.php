<?php
/**
* Level of degree
*/
class Levels extends CI_Model
{
	
	function get_info($level_id)
	{
		$this->db->from('levels');	
		$this->db->where('level_id',$level_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $level_id is NOT an levels
			$levels_obj = new stdClass;
			
			//Get all the fields from levels table
			$fields = $this->db->list_fields('levels');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$levels_obj->$field='';
			}
			
			return $levels_obj;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('levels');
		$this->db->where('is_status',0);
		$query = $this->db->where("level_name = ".$this->db->escape($term));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return true;
		}

		return false;
	}

	function save(&$degree_data,$level_id=false)
	{
		if (!$level_id or !$this->exists($level_id))
		{
			if($this->db->insert('levels',$degree_data))
			{
				$degree_data['level_id']=$this->db->insert_id();
				return true;
			}
			return false;
		}

		$this->db->where('level_id', $level_id);
		return $this->db->update('levels',$degree_data);
	}

	function exists($level_id)
	{
		$this->db->from('levels');
		$this->db->where('level_id',$level_id);
		$query = $this->db->get();

		return ($query->num_rows()>0);
	}

	function search_count_all($search, $limit=10000)
	{
		$levels = $this->db->dbprefix('levels');
		$this->db->from($levels);
		$this->db->where("(level_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		level_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$levels.".is_status=0");
		$this->db->limit($limit);
		$result=$this->db->get();

		return $result->num_rows();
	}

	function search($search, $limit=20,$offset=0,$column='level_name',$orderby='asc')
	{
		$levels = $this->db->dbprefix('levels');
		$this->db->from($levels);
		$this->db->where("(level_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		level_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$levels.".is_status=0");
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);

		return $this->db->get();
	}

	function count_all()
	{
		$this->db->from('levels');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function get_all($limit=10000, $offset=0,$col='level_name',$order='desc')
	{
		$this->db->from('levels');
		$this->db->where('is_status',0);
		$this->db->order_by($col, $order);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	/*
	Get search suggestions to find degree
	*/
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();

		$this->db->from('levels');
		$this->db->like('level_name', $search);
		$this->db->where('is_status',0);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->level_name;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->select('level_name_kh');
		$this->db->from('levels');
		$this->db->where('is_status',0);
		$this->db->distinct();
		$this->db->like('level_name_kh', $search);
		$this->db->limit($limit);
		$by_name_kh = $this->db->get();

		$temp_suggestions = array();
		foreach($by_name_kh->result() as $row)
		{
			$temp_suggestions[] = $row->level_name_kh;
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
	Deletes a list of degrees
	*/
	function delete_list($ids)
	{
		$this->db->where_in('level_id',$ids);
		return $this->db->update('levels', array('is_status' => 1));
	}

	function get_degree_by_scholarship($level_ids)
	{
		$query = $this->db->from('levels')
				->where_in('level_id',$level_ids)
				->where('is_status',0)
				->get();
		return $query;
	}
	function list_level(){
		$this->db->from('levels');
		$this->db->where('is_status',0);
		$this->db->order_by('level_id','asc');
		return $this->db->get();
	}
}