<?php
/**
* Nationality table information
*/
class Nationality extends CI_Model
{
	function get_all()
	{
		return $this->db->where("is_status", 0)->get('nationality');
	}
	function get_info($nationality_id)
	{
		$this->db->from('nationality');	
		$this->db->where('nationality_id',$nationality_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $nationality_id is NOT an nationality
			$nationality_obj = new stdClass;
			
			//Get all the fields from nationality table
			$fields = $this->db->list_fields('nationality');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$nationality_obj->$field='';
			}
			
			return $nationality_obj;
		}
	}

	function get_info_country($stu_country){
		$query = $this->db->from('country')->where('country_id',$stu_country)->get();

		if($query->num_rows() == 1){
			return $query->row();
		}else{
			$country_obj = new stdClass;
			$fields = $this->db->list_fields('country');
			foreach($fields as $field){
				$country_obj->field = '';
			}
			return $country_obj;
		}
	}

	function get_info_city($stu_city){
		$query = $this->db->from('city')->where('city_id',$stu_city)->get();

		if($query->num_rows() == 1){
			return $query->row();
		}else{
			$city_obj = new stdClass;
			$fields = $this->db->list_fields('city');
			foreach($fields as $field){
				$city_obj->field = '';
			}
			return $city_obj;
		}
	}

	function get_info_state($stu_state){
		$query = $this->db->from('state')->where('state_id',$stu_state)->get();

		if($query->num_rows() == 1){
			return $query->row();
		}else{
			$state_obj = new stdClass;
			$fields = $this->db->list_fields('state');
			foreach($fields as $field){
				$state_obj->field = '';
			}
			return $state_obj;
		}
	}

}