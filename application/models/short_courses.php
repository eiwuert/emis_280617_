<?php
class Short_courses extends Person
{	
	function get_all($limit=10000, $offset=0,$col='id',$order='asc')
	{
		$short_courses=$this->db->dbprefix('short_courses');
		$data=$this->db->query("SELECT * 
						FROM ".$short_courses."						
						WHERE is_status =0 ORDER BY ".$col." ".$order." 
						LIMIT  ".$offset.",".$limit);	
		return $data;
	}
	function count_all()
	{
		$this->db->from('short_courses');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}
	function search($search, $limit=20,$offset=0,$column='id',$orderby='asc')
	{
			$this->db->from('short_courses');
			$this->db->where("courses_title LIKE '%".$this->db->escape_like_str($search)."%' or 
								courses_venue LIKE '%".$this->db->escape_like_str($search)."%' or 
								courses_orgainized LIKE '%".$this->db->escape_like_str($search)."%' and is_status=0");		
			$this->db->order_by($column, $orderby);
	 		$this->db->limit($limit);
	 		$this->db->offset($offset);
	 		return $this->db->get();	
	}
	
	function search_count_all($search, $limit=10000)
	{
			$this->db->from('short_courses');
			$this->db->where("courses_title LIKE '%".$this->db->escape_like_str($search)."%' or 
								courses_venue LIKE '%".$this->db->escape_like_str($search)."%' or 
								courses_orgainized LIKE '%".$this->db->escape_like_str($search)."%' and is_status=0");	
	 		$this->db->limit($limit);
			$result=$this->db->get();				
			return $result->num_rows();		 		
	}
	function get_all_byid($id)
	{
		$query = $this->db->where('id',$id)->get('short_courses');			
		return $query;
	}
	function save(&$data,$id=false)
	{
		$success=false;
			if ($id <= 0){
				$success = $this->db->insert('short_courses',$data);
				$data['id'] = $this->db->insert_id();
			}else{
				$this->db->where('id', $id);
				$success = $this->db->update('short_courses',$data);
			}
		return $success;
	}
	function delete($id)
	{	
		$this->db->where_in('id', $id);
		return $this->db->delete('short_courses');
	}
	function query_suggestion($val,$limit){
		$this->db->from('short_courses');	
		$this->db->where('is_status', 0);
		$this->db->like($val,$search);
		$this->db->limit($limit);
		return $this->db->get();
	}
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();
		$title = "courses_title";
		$by_title = $this->query_suggestion($title, $limit);				
		$temp_suggestions = array();
		foreach($by_title->result() as $row)
		{
			$temp_suggestions[] = $row->courses_title;
		}		
		sort($temp_suggestions);		
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}

		$venue = "courses_venue";
		$by_venue = $this->query_suggestion($venue, $limit);				
		$temp_suggestions = array();
		foreach($by_venue->result() as $row)
		{
			$temp_suggestions[] = $row->courses_venue;
		}		
		sort($temp_suggestions);		
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}

		$courses_orgainized = "courses_orgainized";
		$by_courses_orgainized = $this->query_suggestion($courses_orgainized, $limit);				
		$temp_suggestions = array();
		foreach($by_courses_orgainized->result() as $row)
		{
			$temp_suggestions[] = $row->courses_orgainized;
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
?>
