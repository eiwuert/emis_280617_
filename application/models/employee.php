<?php
class Employee extends Person
{
	function get_all_user_type($user_type_id) {
		return $this->db->where('is_option', 1)->get("user_type")->result();
	}

	/*
	Returns all the employees
	*/
	function get_all($limit=10000, $offset=0,$col='last_name',$order='asc')
	{
		$employees=$this->db->dbprefix('employees');
		$emp_info=$this->db->dbprefix('emp_info');
		$people=$this->db->dbprefix('people');
		$levels=$this->db->dbprefix('levels');
        $user_type = $this->db->dbprefix('user_type');
        $emp_master = $this->db->dbprefix('emp_master');
		$data=$this->db->query("SELECT * 
						FROM ".$people."
						STRAIGHT_JOIN ".$employees." ON 
						".$people.".person_id = ".$employees.".person_id 
						INNER JOIN ".$user_type." ON 
						".$employees.".user_type_id = ".$user_type.".user_type_id 
						INNER JOIN ".$emp_master." ON 
						".$emp_master.".emp_master_user_id = ".$people.".person_id
						LEFT JOIN ".$emp_info." ON ".$emp_info.".emp_info_id = ".$emp_master.".emp_master_emp_info_id
						LEFT JOIN ".$levels." ON ".$levels.".level_id = ".$people.".degree_level
						WHERE  ".$employees.".user_type_id  IN (1, 2, 3, 4, 5, 6, 7, 8, 9) OR ".$people.".as_employee_id IN (0,1) and  deleted =0 ORDER BY ".$col." ". $order." 
						LIMIT  ".$offset.",".$limit);
		return $data;
	}	
	function count_all()
	{
		$this->db->from('employees');
		$this->db->where('deleted',0);
		$this->db->where_in('user_type_id', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
		return $this->db->count_all_results();
	}

	function get_user_type($user_type_id) {
		$this->db->from('user_type');
		$this->db->where('user_type_id', $user_type_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->row();
		} else {
			return false;
		}
	}
	
	function exists($professor_id)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('employees.person_id',$professor_id);
		$query = $this->db->get();		
		return ($query->num_rows()==1);
	}
		
	function employee_username_exists($username)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('employees.username',$username);
		$this->db->where('employees.deleted',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->username;
		}
	}

	function employee_email_exists($email)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('people.email',$email);
		$this->db->where('employees.deleted',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->email;
		}
	}

	/*
	Gets information about a particular employee
	*/
	function get_info($employee_id)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->join('emp_master', 'emp_master.emp_master_user_id = employees.person_id', 'left');
		$this->db->join('emp_info', 'emp_info.emp_info_id = emp_master.emp_master_emp_info_id', 'left');
		$this->db->join('emp_department', 'emp_department.emp_department_id = emp_master.emp_master_department_id', 'left');
		$this->db->join('emp_address', 'emp_address.emp_address_id = emp_master.emp_master_emp_address_id', 'left');
		$this->db->join('levels', 'levels.level_id = people.degree_level', 'left');
		$this->db->join('department_type', 'people.department_type = department_type.dept_id', 'left');
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

	/*
	Gets information about multiple employees
	*/
	function get_multiple_info($employee_ids)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where_in('employees.person_id',$employee_ids);
		$this->db->order_by("last_name", "asc");
		return $this->db->get();
	}

	/*
	Inserts or updates an employee
	*/
	function save(&$person_data, &$emp_master_data, &$emp_info_data, &$emp_address_data, &$employee_data, $employee_id=false, $majors)
	{
		$count_major = count($majors);
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		if(parent::save($person_data,$employee_id))
		{
			if (!$employee_id or !$this->exists($employee_id))
			{
				$employee_data['person_id'] = $employee_id = $person_data['person_id'];
				$success = $this->db->insert('employees',$employee_data);
				$employee_data['id'] = $this->db->insert_id();
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
				$emp_master_data['master_id'] = $this->db->insert_id();
				// insert table major as array
				if($major_id !== false){
					for ($i=0; $i < $count_major ; $i++) { 
						$data_majors = array(
									"person_id"=>$person_data['person_id'],
									"major_id"=>$majors[$i]
						);
						$success = $this->db->insert('emp_major_person',$data_majors);
					}
				}
			}
			else
			{
				$this->db->where('person_id', $employee_id);
				$success = $this->db->update('employees',$employee_data);
				// Emp Master
				$this->db->where('emp_master_user_id', $employee_id);
				$success = $this->db->update('emp_master',$emp_master_data);
				// re-check table majors and insert
				if($employee_id && $majors !== ''){
					$this->db->where('person_id',$employee_id)->delete('emp_major_person');
					for ($i=0; $i < $count_major ; $i++) { 
						$data_majors = array(
									"person_id"=>$employee_id,
									"major_id"=>$majors[$i]
						);
						$success = $this->db->insert('emp_major_person',$data_majors);
					}
				}
			}			
		}

		$this->db->trans_complete();
		return $success;
	}

	/*
	Deletes one employee
	*/
	function delete($employee_id)
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
	}

	/*
	Deletes a list of employees
	*/
	function delete_list($employee_ids)
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
	}

	function check_duplicate($term)
	{
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->where('deleted',0);
		$query = $this->db->where("CONCAT(email) = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}
	/*
	Get search suggestions to find employees
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			last_name LIKE '%".$this->db->escape_like_str($search)."%' or
		CONCAT(`last_name`, ' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') and deleted=0 and user_type_id IN (1, 2, 3, 4, 5, 6, 7, 8, 9)");

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
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->where('deleted', 0);
		$this->db->where_in('user_type_id', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
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

		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->where('deleted', 0);
		$this->db->where_in('user_type_id', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
		$this->db->like("username",$search);
		$this->db->limit($limit);
		$by_username = $this->db->get();
		foreach($by_username->result() as $row)
		{
			$suggestions[]=array('label'=> $row->username);
		}

		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->where('deleted', 0);
		$this->db->where_in('user_type_id', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
		$this->db->like("phone_number",$search);
		$this->db->limit($limit);
		$by_phone = $this->db->get();
		$temp_suggestions = array();
		foreach($by_phone->result() as $row)
		{
			$temp_suggestions[]=$row->phone_number;
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

	/*
	Preform a search on employees
	*/
	function search($search, $limit=20,$offset=0,$column='last_name',$orderby='asc')
	{
		$this->db->from('people');
        $this->db->join('employees', 'people.person_id = employees.person_id','left');
        $this->db->join('user_type', 'employees.user_type_id = user_type.user_type_id','left');
        $this->db->join('edu_emp_master','emp_master.emp_master_user_id = people.person_id','left');
        $this->db->join('levels','levels.level_id = people.degree_level','left');
        $this->db->where("(CONCAT(edu_people.last_name,' ',edu_people.first_name) LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.email LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.phone_number LIKE '%".$this->db->escape_like_str($search)."%') 
        				and deleted=0");
        $this->db->where_in('employees.user_type_id', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
        $this->db->order_by($column, $orderby);
        $this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	
	function search_count_all($search, $limit=10000)
	{
		$this->db->from('people');
        $this->db->join('employees', 'people.person_id = employees.person_id','left');
        $this->db->join('user_type', 'employees.user_type_id = user_type.user_type_id','left');
        $this->db->join('edu_emp_master','emp_master.emp_master_user_id = people.person_id','left');
        $this->db->join('levels','levels.level_id = people.degree_level','left');
        $this->db->where("(CONCAT(edu_people.last_name,' ',edu_people.first_name) LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.email LIKE '%".$this->db->escape_like_str($search)."%') 
        				OR (edu_people.phone_number LIKE '%".$this->db->escape_like_str($search)."%') 
        				and deleted=0");
        $this->db->where_in('employees.user_type_id', array(1, 2, 3, 4, 5, 6, 7, 8, 9));
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}
	
	/*
	Attempts to login employee and set session. Returns boolean based on outcome.
	*/
	function login($username, $password)
	{
		$query = $this->db->get_where('employees', array('username' => $username,'password'=>md5($password), 'deleted'=>0), 1);
		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			$this->session->set_userdata('person_id', $row->person_id);
			return true;
		}
		return false;
	}

	/*
	Logs out a user by destorying all session data and redirect to login
	*/
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

	/*
	Determins if a employee is logged in
	*/
	function is_logged_in()
	{
		return $this->session->userdata('person_id')!=false;
	}

	/*
	Gets information about the currently logged in employee.
	*/
	function get_logged_in_employee_info()
	{
		if($this->is_logged_in())
		{
			return $this->get_info($this->session->userdata('person_id'));
		}

		return false;
	}

	/*
	Gets the current employee's location. If they have more than 1, then a user can change during session
	*/
	function get_logged_in_employee_current_location_id()
	{
		if($this->is_logged_in())
		{
			//If we have a location in the session
			if ($this->session->userdata('employee_current_location_id')!==FALSE)
			{
				return $this->session->userdata('employee_current_location_id');
			}

			//Return the first location user is authenticated for
			return current($this->get_authenticated_location_ids($this->session->userdata('person_id')));
		}

		return FALSE;
	}

	function get_current_location_info()
	{
		return $this->Location->get_info($this->get_logged_in_employee_current_location_id());
	}

	function set_employee_current_location_id($location_id)
	{
		if ($this->is_location_authenticated($location_id))
		{
			$this->session->set_userdata('employee_current_location_id', $location_id);
		}
	}

	/*
	Gets the current employee's register id (if set)
	*/
	function get_logged_in_employee_current_register_id()
	{
		if($this->is_logged_in()) {
			//If we have a register in the session
			if ($this->session->userdata('employee_current_register_id')!==FALSE) {
				return $this->session->userdata('employee_current_register_id');
			}

			return NULL;
		}

		return NULL;
	}

	function set_employee_current_register_id($register_id)
	{
		$this->session->set_userdata('employee_current_register_id', $register_id);
	}

	/*
	Determins whether the employee specified employee has access the specific module.
	*/
	function has_module_permission($module_id,$person_id)
	{
		//if no module_id is null, allow access
		if($module_id==null)
		{
			return true;
		}

		$query = $this->db->get_where('permissions', array('person_id' => $person_id,'module_id'=>$module_id), 1);
		return $query->num_rows() == 1;
	}

	function has_module_action_permission($module_id, $action_id, $person_id)
	{
		//if no module_id is null, allow access
		if($module_id==null)
		{
			return true;
		}

		$query = $this->db->get_where('permissions_actions', array('person_id' => $person_id,'module_id'=>$module_id,'action_id'=>$action_id), 1);
		return $query->num_rows() == 1;
	}

	function get_employee_by_username_or_email($username_or_email)
	{
		$this->db->from('employees');
		$this->db->join('people', 'people.person_id = employees.person_id');
		$this->db->where('username',$username_or_email);
		$this->db->or_where('email',$username_or_email);
		$query = $this->db->get();

		if ($query->num_rows() == 1)
		{
			return $query->row();
		}

		return false;
	}

	function update_employee_password($employee_id, $password)
	{
		$employee_data = array('password' => $password);
		$this->db->where('person_id', $employee_id);
		$success = $this->db->update('employees',$employee_data);

		return $success;
	}

	function cleanup()
	{
		$employee_data = array('username' => null);
		$this->db->where('deleted', 1);
		return $this->db->update('employees',$employee_data);
	}

	function get_employee_id($username)
	{
		$query = $this->db->get_where('employees', array('username' => $username, 'deleted'=>0), 1);
		if ($query->num_rows() ==1)
		{
			$row=$query->row();
			return $row->person_id;
		}
		return false;
	}
	
	function get_authenticated_location_ids($employee_id)
	{
		$this->db->select('employees_locations.location_id');
		$this->db->from('employees_locations');
		$this->db->join('locations', 'locations.location_id = employees_locations.location_id');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('deleted', 0);
		$this->db->order_by('location_id', 'asc');

		$location_ids = array();
		foreach($this->db->get()->result_array() as $location)
		{
			$location_ids[] = $location['location_id'];
		}

		return $location_ids;
	}

	function is_location_authenticated($location_id)
	{
		if ($employee = $this->get_logged_in_employee_info())
		{
			$this->db->select('location_id');
			$this->db->from('employees_locations');
			$this->db->where('employee_id', $employee->person_id);
			$this->db->where('location_id', $location_id);
			$result = $this->db->get();

			return $result->num_rows() == 1;
		}
		
		return FALSE;
	}

	function is_employee_authenticated($employee_id, $location_id)
	{
		static $authed_employees;
		
		if (!$authed_employees)
		{
			$this->db->select('employee_id');
			$this->db->from('employees_locations');
			$this->db->where('location_id', $location_id);
			$result = $this->db->get();
			$authed_employees = array();
			
			foreach($result->result_array() as $employee)
			{
				$authed_employees[$employee['employee_id']] = TRUE;
			}
		}
		return isset($authed_employees[$employee_id]) && $authed_employees[$employee_id]; 
	}
	/*
	Preform a search on employees as project manager
	*/
	function search_by_user_type($search, $limit=20,$offset=0,$column='last_name',$orderby='asc', $user_type_id='all')
	{
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%'  or 
		last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		email LIKE '%".$this->db->escape_like_str($search)."%' or 
		phone_number LIKE '%".$this->db->escape_like_str($search)."%' or 
		username LIKE '%".$this->db->escape_like_str($search)."%' or 
		CONCAT(`last_name`,' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%' ) and deleted=0");
		if ($user_type_id != "all") {
			$this->db->where_in('user_type_id', $user_type_id);
		}
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	// function get_all_departments()
	// {
	// 	$query = $this->db
	// 			->where("is_status", 0)
	// 			->get('university');
	// 	return $query->result();
	// }

	function get_last_running_number() 
	{
		$query = $this->db
			->select('emp_unique_id')
			->order_by("emp_unique_id", "desc")
			->limit(1)
			->get('emp_info');
		if($query->num_rows() > 0){
			$data = $query->row();
			$id = $data->emp_unique_id;
			return $id;
		}else{
			return false;
		}
	}

	function save_address(&$emp_address_data, $emp_address_id=false) {
		$success = false;
		if (!$emp_address_id) {
			$this->db->insert("emp_address", $emp_address_data);
			$success = $emp_address_data['emp_address_id'] = $this->db->insert_id();
		} else {
			$this->db->where('emp_address_id', $emp_address_id);
			$success = $this->db->update('emp_address', $emp_address_data);

		}
		return $success;
	}

	function save_personal(&$person_data, &$emp_master_data, &$emp_info_data, $person_id=false, $emp_info_id, $majors)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$success = parent::save($person_data, $person_id);
		if($this->save_emp_info($emp_info_data, $emp_info_id))
		{
			$this->db->where('emp_master_user_id', $person_id);
			$success = $this->db->update('emp_master',$emp_master_data);
		}
		$count_major = count($majors);
		if($person_id && $majors !== ''){
			$this->db->where('person_id',$person_id)->delete('emp_major_person');
			for ($i=0; $i < $count_major ; $i++) { 
				$data_majors = array(
							"person_id"=>$person_id,
							"major_id"=>$majors[$i]
				);
				$success = $this->db->insert('emp_major_person',$data_majors);
			}
		}
		
		$this->db->trans_complete();
		return $success;
	}

	function save_emp_info(&$emp_info_data,$emp_info_id=false)
	{
		if (!$emp_info_id or !$this->exists_emp_info($emp_info_id))
		{
			if ($this->db->insert('emp_info',$emp_info_data))
			{
				$emp_info_data['emp_info_id']=$this->db->insert_id();
				return true;
			}
			return false;
		}
		$this->db->where('emp_info_id', $emp_info_id);
		return $this->db->update('emp_info',$emp_info_data);

	}

	function exists_emp_info($emp_info_id)
	{
		$this->db->from('emp_info');
		$this->db->where('emp_info.emp_info_id',$emp_info_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}
	function save_document(&$docs_data)
	{
		return $this->db->insert('emp_docs', $docs_data);
	}

	function save_people($person_data, $person_id=-1)
	{
		return parent::save($person_data, $person_id);
	}
	function update_prof($data_file, $id_person, $image_id){
		$check_file = $this->check_prof($image_id);
		if(!empty($check_prof )){
			unlink("./assets/employees/$check_file");
		}
		$success=false;
		$this->db->trans_start();
			if($image_id =='' || $image_id <= 0){
				$success = $this->db->insert('app_files',$data_file);
				$data_file['file_id'] = $this->db->insert_id();
				$data_people = array('image_id' =>$data_file['file_id']);
			}else{
				$success = $this->db->where('file_id',$image_id)->update('app_files',$data_file);
				$data_people = array('image_id' =>$image_id);
			}
				$success = $this->db->where('person_id',$id_person)->update('people',$data_people);
		$this->db->trans_complete();
		return $success;
	}

	function check_prof($id_image){
		return $this->db->where('file_id',$id_image)->get('app_files')->row()->file_name;
	}

	function get_name_prof($professor_id){
		return $this->db->where('person_id',$professor_id)->join('app_files','people.image_id = app_files.file_id','left')->get('people')->row();
	}
	function get_info_prof($professor_id){
		return $this->db->where('emp_master.emp_master_user_id',$professor_id)
						->join('emp_docs','emp_docs.emp_docs_emp_master_id = emp_master.emp_master_id','left')
						->join('people','people.person_id = emp_master.emp_master_user_id','left')
						->join('employees','employees.person_id = emp_master.emp_master_user_id','left')
						->get('emp_master')->row();
	}

	function del_softfiles($del_softfile,$load_fun)
	{	
		$arr = count($del_softfile);
		for ($i=0; $i < $arr ; $i++) { 
			$get_docs = $this->db->where('emp_docs_id',$del_softfile[$i])->get('emp_docs');
			if($get_docs->num_rows() > 0){
				$img = $get_docs->row()->emp_docs_path;
				unlink("./assets/$load_fun/$img");
			}
		}
		return $this->db->where_in('emp_docs_id',$del_softfile)->delete('emp_docs');
 	}

 	function get_info_edit_major($person_id){
 		return $this->db->where('person_id',$person_id)->get('emp_major_person');
 	}

	function get_major_arr($id_arr){
		$id = (!empty($id_arr))? $id_arr : 0;
 		$query = $this->db->query("SELECT * FROM edu_skill WHERE is_status = 0 AND skill_id IN ({$id})");
 		return $query;
 	}

 	function get_course_arr($id_arr){
 		$id = (!empty($id_arr))? $id_arr : 0;
 		$query = $this->db->query("SELECT * FROM edu_courses WHERE is_status = 0 AND course_id IN ({$id})");
 		return $query;
 	}

 	// function get_province(){
 	// 	return $this->db->where('deleted',0)->get('provinces');
 	// }
 	function get_all_employee_professor($col='last_name',$order='asc')
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
					INNER JOIN ".$emp_master." ON 
						".$emp_master.".emp_master_user_id = ".$people.".person_id
					LEFT JOIN ".$emp_info." ON ".$emp_info.".emp_info_id = ".$emp_master.".emp_master_emp_info_id
					LEFT JOIN ".$levels." ON ".$levels.".level_id = ".$people.".degree_level
					WHERE  ".$employees.".user_type_id  IN (1, 2, 3, 4, 5, 6, 7, 8, 9, 10) and  deleted =0 ORDER BY ".$col." ". $order);
		return $data;
	}
}
?>
