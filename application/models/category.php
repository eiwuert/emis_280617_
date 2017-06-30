<?php
/**
* Category table information
*/
class Category extends CI_Model
{
	function get_all(){
		$query = $this->db
				->where("is_status", 0)
				->get('emp_category');
		return $query->result();
	}
	function get_info($emp_category_id)
	{
		$this->db->from('emp_category');	
		$this->db->where('emp_category_id',$emp_category_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $emp_category_id is NOT an emp_category
			$emp_category_obj = new stdClass;
			
			//Get all the fields from emp_category table
			$fields = $this->db->list_fields('emp_category');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$emp_category_obj->$field='';
			}
			
			return $emp_category_obj;
		}
	}

}