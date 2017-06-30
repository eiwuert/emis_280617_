<?php
/**
* EmpAddress table information
*/
class Emp_address extends CI_Model
{
	
	function get_info($emp_address_id)
	{
		$this->db->from('emp_address');	
		$this->db->where('emp_address_id',$emp_address_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $emp_address_id is NOT an address
			$address_obj = new stdClass;
			
			//Get all the fields from address table
			$fields = $this->db->list_fields('emp_address');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$address_obj->$field='';
			}
			
			return $address_obj;
		}
	}

	// ditecso developer
	function check_duplicate($term)
	{
		$this->db->from('emp_info');		
		$query = $this->db->where("emp_attendance_card_id = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
		
	}

	function get_emp_info($person_id){
		$this->db->from('employees');	
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->join('emp_master', 'emp_master.emp_master_user_id = employees.person_id', 'left');
		$this->db->join('emp_info', 'emp_info.emp_info_id = emp_master.emp_master_emp_info_id', 'left');
		$this->db->join('emp_department', 'emp_department.emp_department_id = emp_master.emp_master_department_id', 'left');
		$this->db->where('employees.person_id',$person_id);
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $employee_id is NOT an employee
			$person_obj=parent::get_info(-1);
			
			//Get all the fields from employee table
			$fields = $this->db->list_fields('employees');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}

			$emp_fields = $this->db->list_fields('emp_master');			
			foreach ($emp_fields as $field)
			{
				$person_obj->$field='';
			}

			$emp_info_fields = $this->db->list_fields('emp_info');			
			foreach ($emp_info_fields as $field)
			{
				$person_obj->$field='';
			}

			$emp_department_fields = $this->db->list_fields('emp_department');			
			foreach ($emp_department_fields as $field)
			{
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}


	function get_other_info($emp_info_id){
		$this->db->from('employees');	
		$this->db->join('emp_master', 'emp_master.emp_master_user_id = employees.person_id', 'left');
		$this->db->join('emp_info', 'emp_info.emp_info_id = emp_master.emp_master_emp_info_id', 'left');
		$this->db->where('emp_info.emp_info_id',$emp_info_id);
		$query = $this->db->get();

		if($query->num_rows() == 1){
			return $query->row();
		}else{
			//Get empty base parent object, as $employee_id is NOT an employee
			$person_obj=parent::get_info(-1);
			
			//Get all the fields from employee table
			$fields = $this->db->list_fields('employees');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}

			$emp_fields = $this->db->list_fields('emp_master');			
			foreach ($emp_fields as $field)
			{
				$person_obj->$field='';
			}

			$emp_info_fields = $this->db->list_fields('emp_info');			
			foreach ($emp_info_fields as $field)
			{
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}

	function save_info(&$emp_info_data, $emp_info_id){
		$success = false;
		if ($emp_info_id) {
			$this->db->where('emp_info_id', $emp_info_id);
			$success = $this->db->update('emp_info', $emp_info_data);
		}else{
			$success = $this->db->insert('emp_info',$emp_info_data);
			$emp_info_data['emp_info_id'] = $this->db->insert_id();
		}
		return $success;
	}

	function get_info_province($id){
 		$this->db->from('provinces');
 		if(!empty($id) || $id > 0){
 			$this->db->where('province_id',$id);
 		}
 		$this->db->where('deleted',0);
 		return $this->db->get();
 	}
	
	// function get_country(){
	// 	$query = $this->db->where("is_status", 0)->get('edu_country');
	// 	return $query->result();
	// }

	// function get_state(){
	// 	$query = $this->db->where("is_status", 0)->get('edu_state');
	// 	return $query->result();
	// }

	// function get_city(){
	// 	$query = $this->db->where("is_status", 0)->get('edu_city');
	// 	return $query->result();
	// }
	

}