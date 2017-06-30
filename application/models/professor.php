<?php
class Professor extends Person
{
	/*
	Returns all the professor
	*/
	function get_all($limit=10000, $offset=0,$col='last_name',$order='asc')
	{	
		$employees = $this->db->dbprefix('employees');
		$emp_info=$this->db->dbprefix('emp_info');
		$people = $this->db->dbprefix('people');		
		$levels=$this->db->dbprefix('levels');
		$user_type = $this->db->dbprefix('user_type');
		$emp_master = $this->db->dbprefix('emp_master');
		$data = $this->db->query("SELECT *  FROM ".$people."
					STRAIGHT_JOIN ".$employees." ON 
					".$people.".person_id = ".$employees.".person_id 
					INNER JOIN ".$emp_master." ON ".$emp_master.".emp_master_user_id = ".$people.".person_id
					LEFT JOIN ".$emp_info." ON ".$emp_info.".emp_info_id = ".$emp_master.".emp_master_emp_info_id
					LEFT JOIN ".$levels." ON ".$levels.".level_id = ".$people.".degree_level
					WHERE  ".$employees.".user_type_id  IN (10) and  deleted =0 ORDER BY ".$col." ". $order." 
					LIMIT  ".$offset.",".$limit);
		return $data;
	}
	
	function count_all()
	{
		$this->db->from('employees');
		$this->db->where('deleted',0);
		$this->db->where_in('user_type_id', array(10));
		return $this->db->count_all_results();
	}

	/*function exists($person_id)
	{
		$this->db->from('employees');	
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('employees.person_id',$person_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}*/

	/*
	Inserts or updates an employee
	*/
	/*function save(&$person_data, &$emp_master_data, &$emp_info_data, &$emp_address_data, &$employee_data,&$permission_data, &$permission_action_data, &$location_data, $employee_id=false)
	{
		$success=false;
		
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
			
		if(parent::save($person_data,$employee_id))
		{
			if (!$employee_id or !$this->exists($employee_id))
			{
				$employee_data['person_id'] = $employee_id = $person_data['person_id'];
				$success = $this->db->insert('employees',$employee_data);
				// Info Emp
				// $emp_info_data['emp_info_emp_master_id'] = $emp_master_id;
				// $emp_info_data['emp_unique_id'] = $employee_id;
				$success = $this->db->insert('emp_info',$emp_info_data);
				$emp_info_id = $this->db->insert_id();
				// Address
				$this->save_address($emp_address_data);
				// Master Emp
				$emp_master_data['emp_master_emp_address_id'] = $emp_address_data['emp_address_id'];
				$emp_master_data['emp_master_user_id'] = $employee_id;
				$emp_master_data['emp_master_emp_info_id'] = $emp_info_id;
				$success = $this->db->insert('emp_master',$emp_master_data);
			}
			else
			{
				$this->db->where('person_id', $employee_id);
				$success = $this->db->update('employees',$employee_data);
				// Emp Master
				$this->db->where('emp_master_user_id', $employee_id);
				$success = $this->db->update('emp_master',$emp_master_data);		
			}
			
			//We have either inserted or updated a new employee, now lets set permissions. 
			if($success)
			{
				//First lets clear out any permissions the employee currently has.
				$success=$this->db->delete('permissions', array('person_id' => $employee_id));
				
				//Now insert the new permissions
				if($success)
				{
					foreach($permission_data as $allowed_module)
					{
						$success = $this->db->insert('permissions',
						array(
						'module_id'=>$allowed_module,
						'person_id'=>$employee_id));
					}
				}
				
				//First lets clear out any permissions actions the employee currently has.
				$success=$this->db->delete('permissions_actions', array('person_id' => $employee_id));
				
				//Now insert the new permissions actions
				if($success)
				{
					foreach($permission_action_data as $permission_action)
					{
						list($module, $action) = explode('|', $permission_action);
						$success = $this->db->insert('permissions_actions',
						array(
						'module_id'=>$module,
						'action_id'=>$action,
						'person_id'=>$employee_id));
					}
				}
				
				$success=$this->db->delete('employees_locations', array('employee_id' => $employee_id));
				
				//Now insert the new employee locations
				if($success)
				{
					if ($location_data !== FALSE)
					{
						foreach($location_data as $location_id)
						{
							$success = $this->db->insert('employees_locations',
							array(
							'employee_id'=>$employee_id,
							'location_id'=>$location_id
							));
						}
				
					}
				}
				
			}
			
		}
		
		$this->db->trans_complete();		
		return $success;
	}*/
	
	/*
	Deletes one employee
	*/
	/*function delete($employee_id)
	{
		$success=false;
		
		//Don't let employee delete their self
		if($employee_id==$this->get_logged_in_employee_info()->person_id)
			return false;
		
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		$employee_info = $this->Employee->get_info($employee_id);
	
		if ($employee_info->image_id !== NULL)
		{
			$this->Person->update_image(NULL,$employee_id);
			$this->Appfile->delete($employee_info->image_id);			
		}			
		
		//Delete permissions
		if($this->db->delete('permissions', array('person_id' => $employee_id)) && $this->db->delete('permissions_actions', array('person_id' => $employee_id)))
		{	
			$this->db->where('person_id', $employee_id);
			$success = $this->db->update('employees', array('deleted' => 1));
		}
		$this->db->trans_complete();		
		return $success;
	}*/
	
	/*
	Deletes a list of employees
	*/
	/*function delete_list($employee_ids)
	{
		$success=false;
		
		//Don't let employee delete their self
		if(in_array($this->get_logged_in_employee_info()->person_id,$employee_ids))
			return false;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		foreach($employee_ids as $employee_id)
		{
			$employee_info = $this->Employee->get_info($employee_id);
		
			if ($employee_info->image_id !== NULL)
			{
				$this->Person->update_image(NULL,$employee_id);
				$this->Appfile->delete($employee_info->image_id);			
			}			
		}
		
		$this->db->where_in('person_id',$employee_ids);
		//Delete permissions
		if ($this->db->delete('permissions'))
		{
			//delete from employee table
			$this->db->where_in('person_id',$employee_ids);
			$success = $this->db->update('employees', array('deleted' => 1));
		}
		$this->db->trans_complete();		
		return $success;
 	}*/

 	function get_softfile($professor_id){
 		$query =  $this->db->where('emp_master_user_id',$professor_id)->join('emp_docs','emp_master_id = emp_docs.emp_docs_emp_master_id')->get('emp_master');
 		return $query;
 	}

	/*
	Get search suggestions to find professor
	*/
	function get_search_suggestions($search, $limit = 5)
	{
		$suggestions = array();
		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		last_name LIKE '%".$this->db->escape_like_str($search)."' or 
		CONCAT(last_name, ' ', first_name) LIKE '%".$this->db->escape_like_str($search)."%') and deleted = 0 and user_type_id IN (10)");
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->last_name.' '.$row->first_name;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[] = array('label' => $temp_suggestion);
		}

		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->where_in('user_type_id', array(10));
		$this->db->like("email", $search);
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
			$suggestions[] = array('label' => $temp_suggestion);
		}

		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->where_in('user_type_id', array(10));
		$this->db->like("username", $search);
		$this->db->limit($limit);
		$by_username = $this->db->get();
		foreach($by_username->result() as $row)
		{
			$suggestions[] = array('label' => $row->username);
		}

		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->where_in('user_type_id', array(10));
		$this->db->like("phone_number", $search);
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
			$suggestions[]=array('label' => $temp_suggestion);
		}

		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;
	}
	
	/*
	Preform a search on professor
	*/
	function search($search, $limit = 20, $offset = 0, $column = 'last_name', $orderby = 'asc')
	{
		$this->db->from('people');
        $this->db->join('employees', 'people.person_id = employees.person_id','left');
        $this->db->join('emp_master', 'emp_master.emp_master_user_id = people.person_id','left');
        $this->db->join('emp_info','emp_info.emp_info_id = emp_master.emp_master_emp_info_id','left');
        $this->db->join('levels','levels.level_id = people.degree_level','left');
        $this->db->where("(CONCAT(edu_people.last_name,' ',edu_people.first_name) LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.email LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.phone_number LIKE '%".$this->db->escape_like_str($search)."%') 
        				and deleted=0");
        $this->db->where_in('employees.user_type_id', array(10));
        $this->db->order_by($column, $orderby);
        $this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	
	function search_count_all($search, $limit = 10000)
	{

		$this->db->from('people');
        $this->db->join('employees', 'people.person_id = employees.person_id','left');
        $this->db->join('emp_master', 'emp_master.emp_master_user_id = people.person_id','left');
        $this->db->join('emp_info','emp_info.emp_info_id = emp_master.emp_master_emp_info_id','left');
        $this->db->join('levels','levels.level_id = people.degree_level','left');
        $this->db->where("(CONCAT(edu_people.last_name,' ',edu_people.first_name) LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.email LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.phone_number LIKE '%".$this->db->escape_like_str($search)."%') 
        				and deleted=0");
        $this->db->where_in('employees.user_type_id', array(10));
        $this->db->limit($limit);
		$result = $this->db->get();

		return $result->num_rows();
	}

	function check_duplicate($term)
	{
		$this->db->from('employees');
		$this->db->join('people', 'employees.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->where("CONCAT(email) = ".$this->db->escape($term));
		$query = $this->db->get();

		if($query->num_rows()>0)
		{
			return TRUE;
		}

		return FALSE;
	}

	/*
	Gets information about a particular professor
	*/
	function get_info($employee_id)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->join('emp_master', 'emp_master.emp_master_user_id = employees.person_id', 'left');
		$this->db->join('emp_info', 'emp_info.emp_info_id = emp_master.emp_master_emp_info_id', 'left');
		$this->db->join('emp_department', 'emp_department.emp_department_id = emp_master.emp_master_department_id', 'left');
		$this->db->join('emp_address', 'emp_address.emp_address_id = emp_master.emp_master_emp_address_id', 'left');
		$this->db->where('employees.person_id',$employee_id);
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
				$person_obj->$field = '';
			}

			return $person_obj;
		}
	}

	function get_info_edit_major($person_id){
		return $this->db->where('person_id',$person_id)->get('emp_major_person');
	}

}