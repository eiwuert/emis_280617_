<?php
class Major_model extends CI_Model
{

	function get_info($skill_id)
	{
		$this->db->from('skill');
		$this->db->where('skill_id',$skill_id);
		$this->db->where('is_status',0);
		$query = $this->db->get();
		
		if($query->num_rows()==1) {
			return $query->row();
		} else {
			//Get empty base parent object, as $skill_id is NOT an skill
			$skill_obj = new stdClass;
			
			//Get all the fields from skill table
			$fields = $this->db->list_fields('skill');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$skill_obj->$field='';
			}
			
			return $skill_obj;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('skill');
		$this->db->where('is_status',0);
		$query = $this->db->where("skill_major_code = ".$this->db->escape($term));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return true;
		}
		return false;
	}

	function exists($skill_id)
	{
		$this->db->from('skill');
		$this->db->where('skill_id',$skill_id);
		$query = $this->db->get();
		
		return ($query->num_rows()>0);
	}

	function save(&$major_data,$skill_id=false)
	{
		$success = false;
		$this->db->trans_start();
		if (!$skill_id or !$this->exists($skill_id))
		{
			$success =  $this->db->insert('skill',$major_data);
			$major_data['skill_id']=$this->db->insert_id();
		} else {
			$this->db->where('skill_id', $skill_id);
			$success = $this->db->update('skill',$major_data);
		}
		$success = $this->db->trans_complete();

		return $success;
	}

	function get_all_skill(){
		$this->db->where('is_status',0);
		$query = $this->db->from('skill');
		return $query;		
	}

	function count_all()
	{
		$this->db->from('skill');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function get_byId($id){
		$query = $this->db->where('skill_id',$id)->where('is_status',0)->get('skill');
		return $query;		
	}

	function get_all($limit=10000, $offset=0,$col='skill_id',$order='asc')
	{
		$this->db->from('skill');
		$this->db->where('is_status',0);
		$this->db->order_by($col, $order);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$skill = $this->db->dbprefix('skill');
		$this->db->from($skill);
		$this->db->where("(skill_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			skill_major_code LIKE '%".$this->db->escape_like_str($search)."%' or 
			skill_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$skill.".is_status=0");
		$this->db->limit($limit);
		$result=$this->db->get();

		return $result->num_rows();
	}

	function search($search, $limit=20,$offset=0,$column='skill_id',$orderby='asc')
	{
		$skill = $this->db->dbprefix('skill');
		$this->db->from($skill);
		$this->db->where("(skill_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			skill_major_code LIKE '%".$this->db->escape_like_str($search)."%' or 
			skill_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$skill.".is_status=0");
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);

		return $this->db->get();
	}

	/*
	Deletes a list of major
	*/
	function delete_list($ids)
	{
		$this->db->where_in('skill_id',$ids);
		return $this->db->update('skill', array('is_status' => 1));
	}

	/*
	Get search suggestions to find skill
	*/
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();
		$this->db->from('skill');
		$this->db->like('skill_name', $search);
		$this->db->where('is_status',0);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->skill_name;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->select('skill_name_kh');
		$this->db->from('skill');
		$this->db->where('is_status',0);
		$this->db->distinct();
		$this->db->like('skill_name_kh', $search);
		$this->db->limit($limit);
		$by_name_kh = $this->db->get();

		$temp_suggestions = array();
		foreach($by_name_kh->result() as $row)
		{
			$temp_suggestions[] = $row->skill_name_kh;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->from('skill');
		$this->db->like('skill_major_code', $search);
		$this->db->where('is_status',0);
		$this->db->limit($limit);
		$by_skill_major_code = $this->db->get();
		$temp_suggestions = array();
		foreach($by_skill_major_code->result() as $row)
		{
			$temp_suggestions[] = $row->skill_major_code;
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

	function get_major_by_scholarship($skill_ids)
	{
		$query = $this->db->from('skill')
				->where_in('skill_id',$skill_ids)
				->where('is_status',0)
				->get();
		return $query;
	}

	function get_skill_by_faculty($id){
		return $this->db->where('faculty_id',$id)->get('skill');
	}
}