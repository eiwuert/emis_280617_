<?php
/**
* letter table information
*/
class Mou_model extends CI_Model
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
	Inserts or updates a letter in
	*/
	function save(&$mou_data, $mou_id = false)
	{
		$success = false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$mou_id or !$this->exists($mou_id)) {
			$success = $this->db->insert('mou',$mou_data);
			$mou_data['id'] = $this->db->insert_id();
		} else {
			$success = $this->db->where('id', $mou_id)->update('mou', $mou_data);
		}
		$this->db->trans_complete();
		return $success;
	}

	function exists($mou_id)
	{
		$this->db->from('mou');
		$this->db->where('mou.id',$mou_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	function count_all()
	{
		$this->db->from('mou')->where('is_status', 0);
		return $this->db->count_all_results();
	}

	function get_all($limit=10000, $offset=0, $col='id', $order='desc')
	{
		$mou = $this->db->dbprefix('mou');
		$user_type = $this->db->dbprefix('user_type');
		$data = $this->db->query("SELECT * FROM " . $mou . " LEFT JOIN ".$user_type." ON ".$user_type.".user_type_id = ".$mou.".response_by WHERE ".$mou.".is_status = 0 ORDER BY " . $col . " " . $order . " LIMIT  " . $offset . "," . $limit);
		
		return $data;
	}

	/*
	Get search suggestions to find letter
	*/
	function get_search_suggestions($search, $limit = 5)
	{
		$suggestions = array();

		$this->db->from('mou');
		$this->db->where("(sign_date LIKE '%".$this->db->escape_like_str($search)."%')");

		$this->db->limit($limit);
		$sign_date = $this->db->get();
		$temp_suggestions = array();
		foreach($sign_date->result() as $row)
		{
			$temp_suggestions[] = $row->sign_date;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->from('mou');
		$this->db->where("(valid_date_from LIKE '%".$this->db->escape_like_str($search)."%')");

		$this->db->limit($limit);
		$valid_date_form = $this->db->get();
		$temp_suggestions = array();
		foreach($valid_date_form->result() as $row)
		{
			$temp_suggestions[] = $row->valid_date_form;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}



		$this->db->from('mou');
		$this->db->where("(valid_date_to LIKE '%".$this->db->escape_like_str($search)."%')");

		$this->db->limit($limit);
		$valid_date_to = $this->db->get();
		$temp_suggestions = array();
		foreach($valid_date_to->result() as $row)
		{
			$temp_suggestions[] = $row->valid_date_to;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}


		$this->db->from('mou');
		$this->db->where("(purpose LIKE '%".$this->db->escape_like_str($search)."%')");

		$this->db->limit($limit);
		$purpose = $this->db->get();
		$temp_suggestions = array();
		foreach($purpose->result() as $row)
		{
			$temp_suggestions[] = $row->purpose;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		$this->db->from('mou');
		$this->db->where("(orginazation LIKE '%".$this->db->escape_like_str($search)."%')");

		$this->db->limit($limit);
		$orginazation = $this->db->get();
		$temp_suggestions = array();
		foreach($orginazation->result() as $row)
		{
			$temp_suggestions[] = $row->orginazation;
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
		$this->db->from('mou')
			->join('user_type', 'user_type.user_type_id = mou.response_by')
			->where("(sign_date LIKE '%".$this->db->escape_like_str($search)."%' 
							OR valid_date_from LIKE '%".$this->db->escape_like_str($search)."%'
							OR valid_date_to LIKE '%".$this->db->escape_like_str($search)."%'
							OR orginazation LIKE '%".$this->db->escape_like_str($search)."%'
							OR purpose LIKE '%".$this->db->escape_like_str($search)."%'
							OR response_by LIKE '%".$this->db->escape_like_str($search)."%')")
			->where('is_status',0)
			->order_by($column,$orderby)
			->limit($limit)
			->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('mou')
			->join('user_type', 'user_type.user_type_id = mou.response_by')
			->where("(sign_date LIKE '%".$this->db->escape_like_str($search)."%' 
							OR valid_date_from LIKE '%".$this->db->escape_like_str($search)."%'
							OR valid_date_to LIKE '%".$this->db->escape_like_str($search)."%'
							OR orginazation LIKE '%".$this->db->escape_like_str($search)."%'
							OR purpose LIKE '%".$this->db->escape_like_str($search)."%'
							OR response_by LIKE '%".$this->db->escape_like_str($search)."%')")
			->where('is_status',0)
			->limit($limit);
		$result = $this->db->get();
		return $result->num_rows();
	}

	function get_mou_by_id($mou_id){
		$this->db->from('mou');
		$this->db->where('id',$mou_id);
		$this->db->join('user_type','user_type.user_type_id = mou.response_by','left');
		$this->db->where('mou.is_status',0);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			return $query->row();
		}
	}

	/*
	Deletes a list of letter
	*/
	function delete_list($mou_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$this->db->where_in('id',$mou_id);
		$success = $this->db->update('mou', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	function save_file($arr_file){
		$this->db->insert('mou_file',$arr_file);
	}
	function get_list_file($id_form){
		return $this->db->where('file_id_form',$id_form)->get('mou_file')->result();
	}
	function del_file($id_to_remove){
		$this->db->where('id',$id_to_remove)->delete('mou_file');
	}


















}