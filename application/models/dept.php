<?php
/**
* Faculty Management
*/
class Dept extends CI_Model
{

	function get_info($dept_id)
	{
		$this->db->from('department_type');
		$this->db->where('dept_id',$dept_id);
		$query = $this->db->get();		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $university_id is NOT an university
			$dept_obj = new stdClass;
			//Get all the fields from university table
			$fields = $this->db->list_fields('department_type');
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$dept_obj->$field='';
			}
			return $dept_obj;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('university');
		$this->db->where('is_status',0);
		$query = $this->db->where("dept_title = ".$this->db->escape($term));
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return true;
		}

		return false;
	}
	function save(&$deptData,$dept_id=false)
	{
		if ($dept_id == -1 || $dept_id <= 0)
		{
			if($this->db->insert('department_type',$deptData))
			{
				$deptData['dept_id']=$this->db->insert_id();
				return true;
			}
			return false;
		}

		$this->db->where('dept_id', $dept_id);
		return $this->db->update('department_type',$deptData);
	}
	function count_all()
	{
		$this->db->from('department_type');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function get_all($limit=10000, $offset=0,$col='dept_title',$order='desc')
	{
		$this->db->from('department_type');
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
		$this->db->where("(dept_title LIKE '%".$this->db->escape_like_str($search)."%' or 
		dept_title_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$university.".is_status=0");
		$this->db->limit($limit);
		$result=$this->db->get();

		return $result->num_rows();
	}

	function get_byId($id)
	{
		$this->db->from('university');
		$this->db->where('university_id',$id);
		$this->db->where('is_status',0);
		return $this->db->get();
	}

	function search($search, $limit=20,$offset=0,$column='dept_title',$orderby='asc')
	{
		$university = $this->db->dbprefix('university');
		$this->db->from($university);
		$this->db->join('people', 'people.person_id = university.university_dean_id', 'left');
		$this->db->where("(dept_title LIKE '%".$this->db->escape_like_str($search)."%' or 
		dept_title_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$university.".is_status=0");
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);

		return $this->db->get();
	}

	/*
	Get search suggestions to find university
	*/
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();

		$this->db->from('department_type');
		$this->db->like('dept_title', $search);
		$this->db->where('is_status',0);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->dept_title;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->from('university');
		$this->db->where('is_status',0);
		$this->db->like('dept_title_kh', $search);
		$this->db->limit($limit);
		$by_name_kh = $this->db->get();

		$temp_suggestions = array();
		foreach($by_name_kh->result() as $row)
		{
			$temp_suggestions[] = $row->dept_title_kh;
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

	function delete_list($ids)
	{
		$this->db->where_in('dept_id',$ids);
		return $this->db->update('department_type', array('is_status' => 1));
	}
}