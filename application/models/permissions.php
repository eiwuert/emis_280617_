<?php
class Permissions extends CI_Model
{
	function count_all()
	{
		$this->db->from('employees');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}

	function get_all($limit=10000, $offset=0,$col='last_name',$order='asc')
	{
		$employees=$this->db->dbprefix('employees');
		$people=$this->db->dbprefix('people');
		$user_type = $this->db->dbprefix('user_type');
		$data=$this->db->query("SELECT * 
						FROM ".$people."
						STRAIGHT_JOIN ".$employees." ON 
						".$people.".person_id = ".$employees.".person_id 
						INNER JOIN ".$user_type." ON 
						".$employees.".user_type_id = ".$user_type.".user_type_id 
						AND deleted = 0 ORDER BY ".$col." ". $order." 
						LIMIT  ".$offset.",".$limit);
		return $data;
	}

	function search($search, $limit=20,$offset=0,$column='last_name',$orderby='asc')
	{
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->join('user_type','employees.user_type_id=user_type.user_type_id');
		$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
			email LIKE '%".$this->db->escape_like_str($search)."%' or 
			phone_number LIKE '%".$this->db->escape_like_str($search)."%' or 
			username LIKE '%".$this->db->escape_like_str($search)."%' or 
			CONCAT(`last_name`, ' ', `first_name`) LIKE '%".$this->db->escape_like_str($search)."%' ) and deleted=0");
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);

		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('employees');
		$this->db->join('people','employees.person_id=people.person_id');
		$this->db->where("(first_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		last_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		email LIKE '%".$this->db->escape_like_str($search)."%' or 
		phone_number LIKE '%".$this->db->escape_like_str($search)."%' or 
		username LIKE '%".$this->db->escape_like_str($search)."%' or 
		CONCAT(`last_name`,' ',`first_name`) LIKE '%".$this->db->escape_like_str($search)."%') and deleted=0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function save(&$employee_data,&$permission_data, &$permission_action_data, $employee_id=false, $employee_location_data)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$this->db->where('person_id', $employee_id);
		$success = $this->db->update('employees',$employee_data);
		//We have either inserted or updated a new employee, now lets set permissions. 
		if($success) {
			//First lets clear out any permissions the employee currently has.
			$success=$this->db->delete('permissions', array('person_id' => $employee_id));

			//Now insert the new permissions
			if($success) {
				foreach($permission_data as $allowed_module)
				{
					$success = $this->db->insert('permissions',
						array(
						'module_id'=>$allowed_module,
						'person_id'=>$employee_id)
					);
				}
			}
			//First lets clear out any permissions actions the employee currently has.
			$success=$this->db->delete('permissions_actions', array('person_id' => $employee_id));
			//Now insert the new permissions actions
			if($success) {
				foreach($permission_action_data as $permission_action) {
					list($module, $action) = explode('|', $permission_action);
					$success = $this->db->insert('permissions_actions',
					array(
					'module_id'=>$module,
					'action_id'=>$action,
					'person_id'=>$employee_id));
				}
			}
		}
		if($employee_location_data){
			//insert location
			$success = $this->db->insert('employees_locations',$employee_location_data);
		}
		
		$this->db->trans_complete();
		return $success;
	}

}