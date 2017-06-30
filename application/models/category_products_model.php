<?php
/**
* Category table information
*/
class Category_products_model extends CI_Model
{
	function get_all($limit=10000, $offset=0,$col='item_category_id',$order='desc')
	{
		$cate_prod = $this->db->dbprefix('item_category');
		$data = $this->db->query("SELECT * 
						FROM " . $cate_prod . "
						WHERE deleted = 0 ORDER BY " . $col . " " . $order . " 
						LIMIT  " . $offset . "," . $limit);
		return $data;
	}

	function count_all()
	{
		$this->db->from('item_category');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	/*
	Get search suggestions to find cate_prod
	*/
	function get_search_suggestions($search,$limit=5)
	{
		$suggestions = array();

		$this->db->from('item_category');
		$this->db->where("(name LIKE '%".$this->db->escape_like_str($search)."%') AND deleted = 0");

		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->name;
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

	function search($search, $limit=20,$offset=0,$column='item_category_id',$orderby='desc')
	{
		$this->db->from('item_category');
		$this->db->where("(name LIKE '%".$this->db->escape_like_str($search)."%') and deleted = 0");
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function search_count_all($search, $limit=10000)
	{
		$this->db->from('item_category');
		$this->db->where("(name LIKE '%".$this->db->escape_like_str($search)."%') and deleted = 0");
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}

	function get_info($item_category_id)
	{
		$this->db->from('item_category');	
		$this->db->where('item_category_id',$item_category_id);
		$query = $this->db->get();
		if($query->num_rows()==1) {
			return $query->row();
		} else {
			//Get all the fields from school_class table
			$fields = $this->db->list_fields('item_category');
			//append those fields to base parent object, we we have a complete empty object
			foreach ($fields as $field)
			{
				$person_obj->$field='';
			}
			return $person_obj;
		}
	}

	/*
	Inserts or updates a school_class
	*/
	function save(&$cate_prod_data, $item_category_id=false)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		if (!$item_category_id or !$this->exists($item_category_id)) {
			$success = $this->db->insert('item_category',$cate_prod_data);
			$cate_prod_data['item_category_id'] = $this->db->insert_id();
		} else {
			$success = $this->db
				->where('item_category_id', $item_category_id)
				->update('item_category', $cate_prod_data);
		}

		$this->db->trans_complete();
		return $success;
	}

	function exists($item_category_id)
	{
		$this->db->from('item_category');
		$this->db->where('item_category_id',$item_category_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}


	function category_products_exists($name)
	{
		$this->db->from('item_category');
		$this->db->where('name',$name);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		if($query->num_rows() >= 1)
		{
			return $query->row()->name;
		}
	}

	function check_duplicate($term)
	{
		$this->db->from('item_category');
		$this->db->where('deleted',0);
		$query = $this->db->where("name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows() > 0)
		{
			return true;
		}
	}

	/*
	Deletes a list of school_class
	*/
	function delete_list($item_category_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		//delete from school_class table
		$this->db->where_in('item_category_id',$item_category_id);
		$success = $this->db->update('item_category', array('deleted' => 1));
		$this->db->trans_complete();
		return $success;
	}

}