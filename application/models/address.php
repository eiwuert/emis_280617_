<?php
/**
* Address table information
*/
class Address extends CI_Model
{
	
	function get_info($stu_address_id)
	{
		$this->db->from('stu_address');	
		$this->db->where('stu_address_id',$stu_address_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $stu_address_id is NOT an address
			$address_obj = new stdClass;
			
			//Get all the fields from address table
			$fields = $this->db->list_fields('stu_address');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$address_obj->$field='';
			}
			
			return $address_obj;
		}
	}

}