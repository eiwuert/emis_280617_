<?php
class Workshop extends Person
{	
	function get_all($limit=10000, $offset=0,$col='id',$order='asc')
	{
		$workshop=$this->db->dbprefix('workshop');
		$data=$this->db->query("SELECT * 
						FROM ".$workshop."						
						WHERE is_status =0 ORDER BY ".$col." ".$order." 
						LIMIT  ".$offset.",".$limit);		
		return $data;
	}
	function count_all()
	{
		$this->db->from('workshop');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}
	function search($search, $limit=20,$offset=0,$column='id',$orderby='asc')
	{
			$this->db->from('workshop');
			$this->db->where("workshop_title LIKE '%".$this->db->escape_like_str($search)."%' or 
								workshop_venue LIKE '%".$this->db->escape_like_str($search)."%' or 
								workshop_orgainized LIKE '%".$this->db->escape_like_str($search)."%' and is_status=0");		
			$this->db->order_by($column, $orderby);
	 		$this->db->limit($limit);
	 		$this->db->offset($offset);
	 		return $this->db->get();	
	}
	
	function search_count_all($search, $limit=10000)
	{
			$this->db->from('workshop');
			$this->db->where("workshop_title LIKE '%".$this->db->escape_like_str($search)."%' or 
								workshop_venue LIKE '%".$this->db->escape_like_str($search)."%' or 
								workshop_orgainized LIKE '%".$this->db->escape_like_str($search)."%' and is_status=0");	
	 		$this->db->limit($limit);
			$result=$this->db->get();				
			return $result->num_rows();		 		
	}
	function get_all_byid($id)
	{
		$query = $this->db->where('id',$id)->get('workshop');			
		return $query;
	}

	// function get_multiple_info($suppliers_ids)
	// {
	// 	$this->db->from('suppliers');		
	// 	$this->db->order_by("last_name", "asc");
	// 	return $this->db->get();		
	// }
	function save(&$data,$id=false)
	{
		$success=false;
			if ($id <= 0){
				$success = $this->db->insert('workshop',$data);
				$data['id'] = $this->db->insert_id();
			}else{
				$this->db->where('id', $id);
				$success = $this->db->update('workshop',$data);
			}
		return $success;
	}
	function delete($id)
	{	
		$this->db->where_in('id', $id);
		return $this->db->delete('workshop');
	}
	function query_suggestion($val,$limit){
		$this->db->from('workshop');	
		$this->db->where('is_status', 0);
		$this->db->like($val,$search);
		$this->db->limit($limit);
		return $this->db->get();
	}
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();
		$title = "workshop_title";
		$by_title = $this->query_suggestion($title, $limit);				
		$temp_suggestions = array();
		foreach($by_title->result() as $row)
		{
			$temp_suggestions[] = $row->workshop_title;
		}		
		sort($temp_suggestions);		
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}

		$venue = "workshop_venue";
		$by_venue = $this->query_suggestion($venue, $limit);				
		$temp_suggestions = array();
		foreach($by_venue->result() as $row)
		{
			$temp_suggestions[] = $row->workshop_venue;
		}		
		sort($temp_suggestions);		
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}

		$workshop_orgainized = "workshop_orgainized";
		$by_workshop_orgainized = $this->query_suggestion($workshop_orgainized, $limit);				
		$temp_suggestions = array();
		foreach($by_workshop_orgainized->result() as $row)
		{
			$temp_suggestions[] = $row->workshop_orgainized;
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
	// function get_suppliers_search_suggestions($search,$limit=25)
	// {
	// 	$suggestions = array();
		
	// 	$this->db->from('suppliers');
	// 	$this->db->where('deleted', 0);
	// 	$this->db->like("company_name",$search);
	// 	$this->db->limit($limit);
	// 	$by_company_name = $this->db->get();		
	// 	$temp_suggestions = array();		
	// 	foreach($by_company_name->result() as $row)
	// 	{
	// 		$temp_suggestions[$row->person_id] = $row->company_name;
	// 	}		
	// 	asort($temp_suggestions);
		
	// 	foreach($temp_suggestions as $key => $value)
	// 	{
	// 		$suggestions[]=array('label' => $value);		
	// 	}
							
	// 	//only return $limit suggestions
	// 	if(count($suggestions > $limit))
	// 	{
	// 		$suggestions = array_slice($suggestions, 0,$limit);
	// 	}
	// 	return $suggestions;

	// }	
	
	// function find_supplier_id($search)
	// {
	// 	if ($search)
	// 	{
	// 		$this->db->select("suppliers.person_id");
	// 		$this->db->from('suppliers');
	// 		$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
	// 		last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
	// 		CONCAT(`first_name`,' ',`last_name`) LIKE '".$this->db->escape_like_str($search)."%' or
	// 		company_name LIKE '%".$this->db->escape_like_str($search)."%' or 
	// 		email LIKE '%".$this->db->escape_like_str($search)."%') and deleted=0");		
	// 		$this->db->order_by("last_name", "asc");
	// 		$query = $this->db->get();
		
	// 		if ($query->num_rows() > 0)
	// 		{
	// 			return $query->row()->person_id;
	// 		}
	// 	}
		
	// 	return null;
	// }
}
?>
