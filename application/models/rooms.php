<?php
class Rooms extends CI_Model{

	function get_all($limit=10000, $offset=0,$col='room_id',$order='desc')
	{
		$room = $this->db->dbprefix('room');
		$data = $this->db->query("SELECT * 
						FROM " . $room . "
						WHERE is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function count_all()
	{
		$this->db->from('room');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function get_byId($id)
	{
		return $this->db->where('room_id',$id)->where('is_status',0)->get('room');
	}	

	function search($search, $limit=20,$offset=0,$column='room_id',$orderby='desc')
	{
		$this->db->from('room');
		$this->db->where("(room_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('room');
		$this->db->where("(room_name LIKE '%".$this->db->escape_like_str($search)."%') and is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function get_info($room_id)
	{
		$this->db->from('room');	
		$this->db->where('room_id',$room_id);
		$query = $this->db->get();
		if($query->num_rows()==1) {
			return $query->row();
		} else {
			//Get all the fields from room table
			$fields = $this->db->list_fields('room');

			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}

			return $person_obj;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('room');
		$this->db->where('is_status',0);
		$query = $this->db->where("room_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}

	function room_exists($room_name)
	{
		$this->db->from('room');
		$this->db->where('room.room_name',$room_name);
		$this->db->where('room.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->room_name;
		}
	}

	/*
	Inserts or updates a room
	*/
	function save(&$room_data, $room_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$room_id or !$this->exists($room_id)) {
			$success = $this->db->insert('room',$room_data);
			$room_data['room_id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('room_id', $room_id)
				->update('room', $room_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function exists($room_id)
	{
		$this->db->from('room');
		$this->db->where('room.room_id',$room_id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}

	/*
	Get search suggestions to find room
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->db->from('room');
		$this->db->where("(room_name LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->room_name;
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
	Deletes a list of room
	*/
	function delete_list($room_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from room table
		$this->db->where_in('room_id',$room_id);
		$success = $this->db->update('room', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	function autocomplete_room($term)
	{
		$data = $this->db->from('room')
			->like('room_name', $term)
			->where('is_status', 0)
			->get();
		return $data;
	}

	function delete($room_id=false) {
		$success = false;
		$this->db->trans_start();
		if ($room_id && $this->exists($room_id)) {
			$success = $this->db->where('room_id', $room_id)->update('room', array('is_status' => 1));
		}
		$this->db->trans_complete();
		return $success;
	}

}