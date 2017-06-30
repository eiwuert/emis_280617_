<?php
/**
* Faculty Management
*/
class Universities extends CI_Model
{

	function get_info($university_id)
	{
		$this->db->from('university');
		$this->db->join('people', 'people.person_id = university.university_dean_id', 'left');
		$this->db->where('university_id',$university_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $university_id is NOT an university
			$university_obj = new stdClass;
			
			//Get all the fields from university table
			$fields = $this->db->list_fields('university');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$university_obj->$field='';
			}
			
			return $university_obj;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('university');
		$this->db->where('is_status',0);
		$query = $this->db->where("university_name = ".$this->db->escape($term));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return true;
		}

		return false;
	}

	function exists($university_id)
	{
		$this->db->from('university');
		$this->db->where('university_id',$university_id);
		$query = $this->db->get();

		return ($query->num_rows()>0);
	}

	function save(&$uni_data,$university_id=false)
	{
		if (!$university_id or !$this->exists($university_id))
		{
			if($this->db->insert('university',$uni_data))
			{
				$uni_data['university_id']=$this->db->insert_id();
				return true;
			}
			return false;
		}

		$this->db->where('university_id', $university_id);
		return $this->db->update('university',$uni_data);
	}

	function count_all()
	{
		$this->db->from('university');
		$this->db->join('people', 'people.person_id = university.university_dean_id', 'left');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function get_all($limit=10000, $offset=0,$col='university_name',$order='desc')
	{
		$this->db->from('university');
		$this->db->join('people', 'people.person_id = university.university_dean_id', 'left');
		$this->db->where('is_status',0);
		$this->db->order_by($col, $order);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$university = $this->db->dbprefix('university');
		$this->db->from($university);
		$this->db->join('people', 'people.person_id = university.university_dean_id', 'left');
		$this->db->where("(university_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		university_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$university.".is_status=0");
		$this->db->limit($limit);
		$result=$this->db->get();

		return $result->num_rows();
	}

	function get_byId($id)
	{
		$this->db->from('university');
		$this->db->join('people', 'people.person_id = university.university_dean_id', 'left');
		$this->db->where('university_id',$id);
		$this->db->where('is_status',0);
		return $this->db->get();
	}

	function search($search, $limit=20,$offset=0,$column='university_name',$orderby='asc')
	{
		$university = $this->db->dbprefix('university');
		$this->db->from($university);
		$this->db->join('people', 'people.person_id = university.university_dean_id', 'left');
		$this->db->where("(university_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		university_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$university.".is_status=0");
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);

		return $this->db->get();
	}

	/*
	Deletes a list of universities
	*/
	function delete_list($ids)
	{
		$this->db->where_in('university_id',$ids);
		return $this->db->update('university', array('is_status' => 1));
	}

	/*
	Get search suggestions to find university
	*/
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();

		$this->db->from('university');
		$this->db->like('university_name', $search);
		$this->db->where('is_status',0);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->university_name;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->select('university_name_kh');
		$this->db->from('university');
		$this->db->where('is_status',0);
		$this->db->distinct();
		$this->db->like('university_name_kh', $search);
		$this->db->limit($limit);
		$by_name_kh = $this->db->get();

		$temp_suggestions = array();
		foreach($by_name_kh->result() as $row)
		{
			$temp_suggestions[] = $row->university_name_kh;
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
}