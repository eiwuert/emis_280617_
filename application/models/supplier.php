<?php
class Supplier extends Person
{	
	function get_all($limit=10000, $offset=0,$col='company_name',$order='asc')
	{
		$suppliers=$this->db->dbprefix('suppliers');
		$data=$this->db->query("SELECT * 
						FROM ".$suppliers."						
						WHERE deleted =0 ORDER BY ".$col." ".$order." 
						LIMIT  ".$offset.",".$limit);		
		return $data;	
	}
	function count_all()
	{
		$this->db->from('suppliers');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	function get_multiple_info($suppliers_ids)
	{
		$this->db->from('suppliers');		
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	function save(&$data,$id=false)
	{
		$success=false;
			if ($id <= 0){
				$success = $this->db->insert('suppliers',$data);
				$data['id'] = $this->db->insert_id();
			}else{
				$this->db->where('id', $id);
				$success = $this->db->update('suppliers',$data);
			}
		return $success;
	}
	function delete($supplier_id)
	{	
		$data = array('deleted' => 1);
		$this->db->where_in('id', $supplier_id);
		return $this->db->update('suppliers', $data);
	}
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();		
		$this->db->from('suppliers');	
		$this->db->where('deleted', 0);
		$this->db->like("company_name",$search);
		$this->db->limit($limit);	
		$by_company_name = $this->db->get();		
		$temp_suggestions = array();
		foreach($by_company_name->result() as $row)
		{
			$temp_suggestions[] = $row->company_name;
		}		
		sort($temp_suggestions);		
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}

		$this->db->from('suppliers');			
		$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->db->escape_like_str($search)."%' or 
		CONCAT(`last_name`,', ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') and deleted=0");
		$this->db->limit($limit);	
		$by_name = $this->db->get();				
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->last_name.', '.$row->first_name;
		}		
		sort($temp_suggestions);		
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
			
		$this->db->from('suppliers');
		$this->db->where('deleted', 0);
		$this->db->like("email",$search);
		$this->db->limit($limit);
		$by_email = $this->db->get();
		$temp_suggestions = array();
		foreach($by_email->result() as $row)
		{
			$temp_suggestions[] = $row->email;
		}		
		sort($temp_suggestions);		
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		$this->db->from('suppliers');
		$this->db->where('deleted', 0);
		$this->db->like("phone_number",$search);
		$this->db->limit($limit);		
		$by_phone = $this->db->get();
		
		$temp_suggestions = array();
		foreach($by_phone->result() as $row)
		{
			$temp_suggestions[] = $row->phone_number;
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
	function get_suppliers_search_suggestions($search,$limit=25)
	{
		$suggestions = array();
		
		$this->db->from('suppliers');
		$this->db->where('deleted', 0);
		$this->db->like("company_name",$search);
		$this->db->limit($limit);
		$by_company_name = $this->db->get();		
		$temp_suggestions = array();		
		foreach($by_company_name->result() as $row)
		{
			$temp_suggestions[$row->person_id] = $row->company_name;
		}		
		asort($temp_suggestions);
		
		foreach($temp_suggestions as $key => $value)
		{
			$suggestions[]=array('label' => $value);		
		}
							
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;

	}
	function search($search, $limit=20,$offset=0,$column='last_name',$orderby='asc')
	{
			$this->db->from('suppliers');
			$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			company_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			email LIKE '%".$this->db->escape_like_str($search)."%' or 
			phone_number LIKE '%".$this->db->escape_like_str($search)."%' or 
			CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->db->escape_like_str($search)."%' or 
			CONCAT(`last_name`,', ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') and deleted=0");		
			$this->db->order_by($column, $orderby);
	 		$this->db->limit($limit);
	 		$this->db->offset($offset);
	 		return $this->db->get();	
	}
	
	function search_count_all($search, $limit=10000)
	{
			$this->db->from('suppliers');
			$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			company_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			email LIKE '%".$this->db->escape_like_str($search)."%' or 
			phone_number LIKE '%".$this->db->escape_like_str($search)."%' or 
			CONCAT(`first_name`,' ',`last_name`) LIKE '%".$this->db->escape_like_str($search)."%') and deleted=0");		
	 		$this->db->limit($limit);
			$result=$this->db->get();				
			return $result->num_rows();		 		
	}
	
	function find_supplier_id($search)
	{
		if ($search)
		{
			$this->db->select("suppliers.person_id");
			$this->db->from('suppliers');
			$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			CONCAT(`first_name`,' ',`last_name`) LIKE '".$this->db->escape_like_str($search)."%' or
			company_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			email LIKE '%".$this->db->escape_like_str($search)."%') and deleted=0");		
			$this->db->order_by("last_name", "asc");
			$query = $this->db->get();
		
			if ($query->num_rows() > 0)
			{
				return $query->row()->person_id;
			}
		}
		
		return null;
	}
}
?>
