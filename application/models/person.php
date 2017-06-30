<?php
class Person extends CI_Model 
{
	/*Determines whether the given person exists*/
	function exists_person($person_id)
	{
		$this->db->from('people');	
		$this->db->where('people.person_id',$person_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}
	
	/*Gets all people*/
	function get_all($limit=10000, $offset=0)
	{
		$this->db->from('people');
		$this->db->order_by("last_name", "asc");
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();		
	}
	
	function count_all()
	{
		$this->db->from('people');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	
	/*
	Gets information about a person as an array.
	*/
	function get_info($person_id)
	{
		$this->db->from('people');
        $this->db->join('employees','employees.person_id = people.person_id','left');
        $this->db->join('user_type','user_type.user_type_id=employees.user_type_id','left');
        $this->db->join('app_files','app_files.file_id = people.person_id','left');
		$this->db->where('people.person_id',$person_id);
                $query = $this->db->get();
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//create object with empty properties.
			$fields = $this->db->list_fields('people');
			$person_obj = new stdClass;
			
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}
			
			return $person_obj;
		}
	}
	
	/*
	Get people with specific ids
	*/
	function get_multiple_info($person_ids)
	{
		$this->db->from('people');
		$this->db->where_in('person_id',$person_ids);
		$this->db->order_by("last_name", "asc");
		return $this->db->get();		
	}
	
	/*
	Inserts or updates a person
	*/
	function save(&$person_data,$person_id=false)
	{	
		
		if (!$person_id or !$this->exists_person($person_id))
		{
			if ($this->db->insert('people',$person_data))
			{
				$person_data['person_id']=$this->db->insert_id();
				return true;
			}
			
			return false;
		}
		$this->db->where('person_id', $person_id);
		return $this->db->update('people',$person_data);
	}
	
	/*
	Deletes one Person (doesn't actually do anything)
	*/
	function delete($person_id)
	{
		return true;; 
	}
	
	/*
	Deletes a list of people (doesn't actually do anything)
	*/
	function delete_list($person_ids)
	{	
		return true;	
 	}

	function update_mailchimp_subscriptions($email, $first_name, $last_name, $mailing_list_ids)
	{
		$this->load->library('mcapi', array('apikey' => $this->Location->get_info_for_key('mailchimp_api_key')));
		$mailing_list_ids = $mailing_list_ids === FALSE ? array() : $mailing_list_ids;
		$current_lists = get_mailchimp_lists($email);
		foreach($current_lists as $list)
		{
			//If a list we are currently subscribed to is not in the updated list, unsubscribe
			if (!in_array($list['id'], $mailing_list_ids))
			{
				$this->mcapi->listUnsubscribe($list['id'], $email, false, false, false);
			}
		}
		
		foreach($mailing_list_ids as $list)
		{
			$this->mcapi->listSubscribe($list, $email, array('FNAME' => $first_name, 'LNAME' => $last_name), 'html', false, true, false, false);
		}
	}
	
	function update_image($file_id,$person_id)
	{
		$this->db->set('image_id',$file_id);
	    $this->db->where('person_id',$person_id);
	    return $this->db->update('people');
	}
	
	function update_person_docid($person_consultant, $person_id)
	{
	    $this->db->where('person_id',$person_id);
	    return $this->db->update('people', $person_consultant);
	}

    function save_document(&$insert_data_documents, $docs_id)
    {
        if (!$docs_id or !$this->exists_docs($docs_id)) {
            if ($this->db->insert('documents',$insert_data_documents)) {
                $insert_data_documents['id'] = $docs_id = $this->db->insert_id();
                $success = true;
            }
        } else {
            $this->db->where('id', $docs_id);
            $success = $this->db->update('documents', $insert_data_documents);
        }
        return $success;
    }

    function delete_document($docs_id)
    {
        $this->db->where('id', $docs_id);
        $success = $this->db->delete('documents');

        return $success;
    }	
}
