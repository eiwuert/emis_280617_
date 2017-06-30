<?php
/**
* letter table information
*/
class Letter_out_model extends CI_Model
{
	function get_user_type_info()
	{
		$this->db->from('user_type');
		$this->db->where('is_option', 1);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->result();
		}
	}
	/*
	Inserts or updates a letter out
	*/
	function save(&$letter_data, $letter_id = false)
	{
		$success = false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$letter_id or !$this->exists($letter_id)) {
			$success = $this->db->insert('letter_out',$letter_data);
			$letter_data['id'] = $this->db->insert_id();
		} else {
			$success = $this->db->where('id', $letter_id)->update('letter_out', $letter_data);
		}
		$this->db->trans_complete();
		return $success;
	}
	function exists($letter_id)
	{
		$this->db->from('letter_out');
		$this->db->where('letter_out.id',$letter_id);
		$this->db->where('is_status',0); 
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}
	function count_all()
	{
		$this->db->from('letter_out');
		$this->db->where('is_status',0); 
		return $this->db->count_all_results();
	}
	function get_all($limit=10000, $offset=0, $col='id', $order='desc')
	{
		$letter_out = $this->db->dbprefix('letter_out');
		$user_type = $this->db->dbprefix('user_type');
		$data = $this->db->query("SELECT * FROM " . $letter_out . " LEFT JOIN ".$user_type." ON ".$user_type.".user_type_id = ".$letter_out.".send_by WHERE " . $letter_out . ".is_status = 0 ORDER BY " . $col . " " . $order . " LIMIT  " . $offset . "," . $limit);
		return $data;
	}
	/*
	Get search suggestions to find letter
	*/
	function get_search_suggestions($search, $limit = 5)
	{
		$suggestions = array();
		$this->db->from('letter_out');
		$this->db->where("(send_to LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->where('is_status',0); 
		$this->db->limit($limit);
		$by_send_to = $this->db->get();
		$temp_suggestions = array();
		foreach($by_send_to->result() as $row)
		{
			$temp_suggestions[] = $row->send_to;
		}
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}
		$this->db->from('letter_out');
		$this->db->where("(purpose LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->where('is_status',0); 
		$this->db->limit($limit);
		$by_purpose = $this->db->get();
		$temp_suggestions = array();
		foreach($by_purpose->result() as $row)
		{
			$temp_suggestions[] = $row->purpose;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0, $limit);
		}
		return $suggestions;
	}
	function search($search, $limit=20,$offset=0,$column='id',$orderby='desc')
	{
		$this->db->from('letter_out');
		$this->db->where("(send_to LIKE '%".$this->db->escape_like_str($search)."%' 
							OR purpose LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->where('is_status',0); 
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	function search_count_all($search, $limit=10000)
	{
		$this->db->from('letter_out');
		$this->db->where("(send_to LIKE '%".$this->db->escape_like_str($search)."%'  
							OR purpose LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->where('is_status',0); 
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}
	function get_letter_by_id($letter_id){
		$this->db->from('letter_out');
		$this->db->where('id',$letter_id);
		$this->db->where('is_status',0);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->row();
		}
	}
	/*
	Deletes a list of letter
	*/
	function delete_list($letter_out_delete)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$this->db->where_in('id',$letter_out_delete);
		$success = $this->db->update('letter_out', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}
	function get_info($letter_id)
	{
		$this->db->from('letter_out');
		$this->db->where('id',$letter_id);
		$this->db->join('user_type','user_type.user_type_id = letter_out.send_by','left');
		$query = $this->db->get();
		
		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $letter_id is NOT a letter
			$obj = new stdClass;
			
			//Get all the fields from letter_out table
			$fields = $this->db->list_fields('letter_out');
			
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$obj->$field='';
			}
			
			return $obj;
		}
	}
	function save_file($arr_file){
		$this->db->insert('letter_out_file',$arr_file);
	}
	function get_list_file($id_form){
		return $this->db->where('file_id_form',$id_form)->get('letter_out_file')->result();
	}
	function del_file($id_to_remove){
		$this->db->where('id',$id_to_remove)->delete('letter_out_file');
	}
}