<?php
class Scholarships extends CI_Model {

	function get_all($limit=10000, $offset=0, $col='scho_id', $order='desc')
	{
		$scholarships = $this->db->dbprefix('scholarships');
		$degree = $this->db->dbprefix('levels');
		$data = $this->db->query("SELECT * 
						FROM " . $scholarships . " 
						STRAIGHT_JOIN ".$degree." ON 
						".$scholarships.".degree = ".$degree.".level_id 
						WHERE ".$scholarships.".is_status = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function count_all()
	{
		$this->db->from('scholarships');
		$this->db->where('is_status',0);
		return $this->db->count_all_results();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('scholarships');
		$this->db->where("(scholarship_from LIKE '%".$this->db->escape_like_str($search)."%') 
		AND is_status = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function search($search, $limit=20,$offset=0,$column='scho_id',$orderby='desc')
	{
		$this->db->from('scholarships');
		$this->db->where("(scholarship_from LIKE '%".$this->db->escape_like_str($search)."%') 
			AND is_status = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	/*
	Get search suggestions to find course
	*/
	function get_search_suggestions($search, $limit = 5)
	{
		$suggestions = array();

		$this->db->from('scholarships');
		$this->db->where("(scholarship_from LIKE '%".$this->db->escape_like_str($search)."%') AND is_status = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row) {
			$temp_suggestions[] = $row->scholarship_from;
		}

		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion) {
			$suggestions[]=array('label'=> $temp_suggestion);
		}

		//only return $limit suggestions
		if(count($suggestions > $limit)) {
			$suggestions = array_slice($suggestions, 0, $limit);
		}

		return $suggestions;
	}

	function get_info($id)
	{
		$this->db->from('scholarships');
		$this->db->join('levels', 'levels.level_id = scholarships.degree');
		$this->db->where('scho_id',$id);
		$query = $this->db->get();

		if($query->num_rows()==1) {
			return $query->row();
		} else {
			//Get empty base parent object, as $id is NOT an scholarship
			$obj = new stdClass;
			//Get all the fields from scholarships table
			$fields = $this->db->list_fields('scholarships');
			foreach ($fields as $field) {
				$obj->$field='';
			}

			return $obj;
		}
	}

	/*
	Inserts or updates a scholarship
	*/
	function save(&$scho_data, $id = false)
	{

		$success = false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();

		if (!$id or !$this->exists($id)) {
			$success = $this->db->insert('scholarships',$scho_data);
			$scho_data['id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('scho_id', $id)
				->update('scholarships', $scho_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function exists($id)
	{
		$this->db->from('scholarships');
		$this->db->where('scholarships.scho_id',$id);
		$query = $this->db->get();

		return ($query->num_rows()==1);
	}

	/*
	Deletes a list of scholarship
	*/
	function delete_list($scho_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$this->db->where_in('scho_id',$scho_id);
		$success = $this->db->update('scholarships', array('is_status' => 1));
		$this->db->trans_complete();
		return $success;
	}

	public function get_list_scholarship($ids)
	{
		$this->db->from('scholarships');
		$this->db->join('levels', 'levels.level_id = scholarships.degree');
		$this->db->where_in('scho_id',$ids);

		$result = $this->db->get();
		$data = [];
		if ($result->num_rows() > 0) {
			$data = $result->result();
		}
		return $data;
	}
}