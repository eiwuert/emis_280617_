<?php
class Item_products extends CI_Model
{
	/* Returns all the items */
	function get_all($limit=10000, $offset=0,$col='item_unique_id',$order='desc')
	{
		// $current_location=$this->Employee->get_logged_in_employee_current_location_id();	
		$this->db->from('items');
		$this->db->join('item_category', 'item_category.item_category_id = items.category_id','left');
		$this->db->where('items.deleted',0);
		$this->db->order_by($col, $order);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $query = $this->db->get();	
	}

	function count_all()
	{
		$this->db->from('items');
		$this->db->where('deleted',0);
		return $this->db->count_all_results();
	}
	function search_count_all($search, $limit=10000)
	{
		$items = $this->db->dbprefix('items');	
		$item_category = $this->db->dbprefix('item_category');
		$this->db->from($items);
		$this->db->join($item_category, $items.'.category_id = '.$item_category.'.item_category_id');
		$this->db->where("(item_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		item_unique_id LIKE '%".$this->db->escape_like_str($search)."%' or 
		model LIKE '%".$this->db->escape_like_str($search)."%') and ".$items.".deleted=0");
				
		$this->db->limit($limit);
		$result=$this->db->get();				
		return $result->num_rows();
	}

	function search($search,$limit=20,$offset=0,$column='item_unique_id',$orderby='asc')
	{		
		$search_terms_array=explode(" ", $this->db->escape_like_str($search));

		//to keep track of which search term of the array we're looking at now	
		$search_name_criteria_counter=0;
		$sql_search_name_criteria = '';
		//loop through array of search terms
		foreach ($search_terms_array as $x)
		{
			$sql_search_name_criteria.=
			($search_name_criteria_counter > 0 ? " AND " : "").
			"item_name LIKE '%".$this->db->escape_like_str($x)."%'";
			$search_name_criteria_counter++;
		}

		$items = $this->db->dbprefix('items');	
		$item_category = $this->db->dbprefix('item_category');	
		$this->db->from($items);
		$this->db->join($item_category, $items.'.category_id = '.$item_category.'.item_category_id');
		$this->db->where("((".
		$sql_search_name_criteria. ") or 
		item_name LIKE '%".$this->db->escape_like_str($search)."%' or 
		item_unique_id LIKE '%".$this->db->escape_like_str($search)."%' or ".
		"model LIKE '%".$this->db->escape_like_str($search)."%' or ".
		$items.".item_id LIKE '%".$this->db->escape_like_str($search)."%' or 
		".$items.".item_name_kh LIKE '%".$this->db->escape_like_str($search)."%') and ".$items.".deleted=0");
		
		
			
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	function get_all_categories()
	{
		$this->db->from('item_category');
		$this->db->where('deleted',0);
		$this->db->distinct();
		$this->db->order_by("name", "asc");
		return $this->db->get();
	}
	function get_search_suggestions($search,$limit=25)
	{
		$suggestions = array();

		$this->db->from('items');
		$this->db->like('item_name', $search);
		$this->db->where('deleted',0);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->item_name;
		}
		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		
		
		$this->db->select('item_unique_id');
		$this->db->from('items');
		$this->db->where('deleted',0);
		$this->db->distinct();
		$this->db->like('item_unique_id', $search);
		$this->db->limit($limit);
		$by_item_unique_id = $this->db->get();
		
		$temp_suggestions = array();
		foreach($by_item_unique_id->result() as $row)
		{
			$temp_suggestions[] = $row->item_unique_id;
		}
		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		

		$this->db->from('items');
		$this->db->like('model', $search);
		$this->db->where('deleted',0);
		$this->db->limit($limit);
		$by_model = $this->db->get();
		
		$temp_suggestions = array();
		foreach($by_model->result() as $row)
		{
			$temp_suggestions[] = $row->model;
		}
		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		
		$this->db->from('items');
		$this->db->like('item_name_kh', $search);
		$this->db->where('deleted',0);
		$this->db->limit($limit);
		$by_item_name_kh = $this->db->get();
		$temp_suggestions = array();
		foreach($by_item_name_kh->result() as $row)
		{
			$temp_suggestions[] = $row->item_name_kh;
		}
		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		
		$this->db->from('items');
		$this->db->where('item_id', $search);
		$this->db->where('deleted',0);
		$this->db->limit($limit);
		$by_item_id = $this->db->get();
		$temp_suggestions = array();
		foreach($by_item_id->result() as $row)
		{
			$temp_suggestions[] = $row->item_id;
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
	function delete_list($item_ids)
	{	
		$this->db->where_in('item_id',$item_ids);
		return $this->db->update('items', array('deleted' => 1));
 	}
 	function get_info($item_id)
	{
		//If we are NOT an int return empty item
		if (!is_numeric($item_id))
		{
			//Get empty base parent object, as $item_id is NOT an item
			$item_obj=new stdClass();

			//Get all the fields from items table
			$fields = $this->db->list_fields('items');

			foreach ($fields as $field)
			{
				$item_obj->$field='';
			}

			return $item_obj;	
		}
			
		$this->db->from('items');
		$this->db->where('item_id',$item_id);
		
		$query = $this->db->get();

		if($query->num_rows()==1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $item_id is NOT an item
			$item_obj=new stdClass();

			//Get all the fields from items table
			$fields = $this->db->list_fields('items');

			foreach ($fields as $field)
			{
				$item_obj->$field='';
			}

			return $item_obj;
		}
	}
	function get_last_running_number() 
    {
        $query = $this->db
                    ->select('item_unique_id')
                    ->order_by("item_id", "desc")
                    ->limit(1)
                    ->get('items');
        if($query->num_rows() > 0){
            $data = $query->row();
            $id = $data->item_unique_id;
            return $id;
        }else{
            return false;
        }
    }
    function save(&$item_data,$item_id=false,$item_sell_unit, $item_sell_unit_old)
	{
		$success=false;
		$this->db->trans_start();
		$count_sell_unit = count($item_sell_unit['sell_cate']);
		if (!$item_id or !$this->exists($item_id))
		{
			$success = $this->db->insert('items',$item_data);
			$item_data['item_id']=$this->db->insert_id();
			
			for ($i=0; $i < $count_sell_unit; $i++) { 
				$data_unit = array(
					"item_id" => $item_data['item_id'],
					"item_unit_cate_id" => $item_sell_unit['sell_cate'][$i],
					"item_qty_unit" => $item_sell_unit['sell_qty'][$i],
					"item_set_price" => $item_sell_unit['sell_price'][$i],
					"item_discount" => $item_sell_unit['discount'][$i],
				);
				$success = $this->db->insert('item_sell_price',$data_unit);
			}
		}else{
			$this->db->where('item_id', $item_id);
			$success = $this->db->update('items',$item_data);
			// old insert
			for ($i=0; $i < count($item_sell_unit_old['autoid']); $i++) { 
				$data_unit_old = array(
					"item_id" => $item_id,
					"item_unit_cate_id" => $item_sell_unit_old['sell_cate'][$i],
					"item_qty_unit" => $item_sell_unit_old['sell_qty'][$i],
					"item_set_price" => $item_sell_unit_old['sell_price'][$i],
					"item_discount" => $item_sell_unit_old['discount'][$i],
				);
				$success = $this->db->where('id',$item_sell_unit_old['autoid'][$i])->update('item_sell_price',$data_unit_old);
			}
			// new insert
			for ($i=0; $i < $count_sell_unit; $i++) { 
				$data_unit = array(
					"item_id" => $item_id,
					"item_unit_cate_id" => $item_sell_unit['sell_cate'][$i],
					"item_qty_unit" => $item_sell_unit['sell_qty'][$i],
					"item_set_price" => $item_sell_unit['sell_price'][$i],
					"item_discount" => $item_sell_unit['discount'][$i],
				);
				$success = $this->db->insert('item_sell_price',$data_unit);
			}
		}
		$this->db->trans_complete();
		return $success;
	}

	function sum_item_storage_byid($id){
		$q = $this->db->query("SELECT SUM(item_qty) as total_qty, 
										SUM(item_total_d) as total_d, 
										SUM(item_total_r) as total_r ,
										SUM(item_total_b) as total_b FROM edu_items_process_stored WHERE item_id = {$id}");
		return $q;
	}

	function get_sell_unit_info($item_id){
		$this->db->from('item_sell_price');
		$this->db->where('item_id',$item_id);
		$this->db->where('deleted',0);
		return $this->db->get();
	}
	function get_item_cate_unit(){
		$this->db->from('edu_item_category_unit');
		$this->db->where('deleted',0);
		$this->db->order_by('unit_name','asc');
		return $this->db->get();
	}
	function get_item_cate_unit_id($id){
		$this->db->from('edu_item_category_unit');
		$this->db->where('unit_id',$id);
		$this->db->join('item_category_unit','item_category_unit');
		$this->db->where('deleted',0);
		$this->db->order_by('unit_name','asc');
		return $this->db->get();
	}
	function get_average_cost($id){
		$this->db->select_sum('item_all_qty');
		$this->db->select_sum('item_total_d');
		$this->db->where('item_id',$id);
		$this->db->from('items_process_stored');
		$q = $this->db->get();
		return $q;
	}
	function remove_unit($id){
		return $this->db->where('id',$id)->delete('item_sell_price');
	}
	function getListUnit($id){		
		return $this->db->query("SELECT edu_item_category_unit.unit_name, edu_item_sell_price.item_qty_unit, edu_item_sell_price.item_set_price,edu_item_sell_price.item_discount
								FROM edu_item_sell_price 
								INNER JOIN edu_item_category_unit ON edu_item_category_unit.unit_id = edu_item_sell_price.item_unit_cate_id 
								where edu_item_sell_price.item_id = {$id}");
	}
	function get_unitType(){
		return $this->db->get('item_category_unit');
	}

	function getUnitItem($id,$limit=20,$offset=0,$column='item_unique_id',$orderby='asc')
	{		
		$items = $this->db->dbprefix('items');
		$item_category = $this->db->dbprefix('item_category');
		$item_sell_price = $this->db->dbprefix('item_sell_price');
		$this->db->from($items);
		$this->db->where('item_unit_cate_id', $id);
		$this->db->where($items.'.deleted', 0);
		$this->db->join($item_category, $items.'.category_id = '.$item_category.'.item_category_id','left');
		$this->db->join($item_sell_price, $items.'.item_id = '.$item_sell_price.'.item_id','left');			
		$this->db->order_by($column, $orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function getUnitItem_count_all($id,$limit=20,$offset=0,$column='item_unique_id',$orderby='asc')
	{	
		$items = $this->db->dbprefix('items');	
		$item_category = $this->db->dbprefix('item_category');
		$item_sell_price = $this->db->dbprefix('item_sell_price');
		$this->db->from($items);
		$this->db->where('item_unit_cate_id', $id);
		$this->db->where($items.'.deleted', 0);
		$this->db->join($item_category, $items.'.category_id = '.$item_category.'.item_category_id','left');		
		$this->db->join($item_sell_price, $items.'.item_id = '.$item_sell_price.'.item_id','left');				
		$this->db->order_by($column, $orderby);				
		$this->db->limit($limit);
		$result=$this->db->get();				
		return $result->num_rows();
	}

	function update_discount($searchUnitType, $row_ids, $disocunt){
		$success=false;
		$this->db->trans_start();
		$success = $this->db->query("UPDATE edu_item_sell_price SET item_discount={$disocunt} WHERE item_id IN ({$row_ids}) AND item_unit_cate_id = {$searchUnitType}");	
		$this->db->trans_complete();
		return $success;
	}
































































	/* Determines if a given item_id is an item */
	function exists($item_id)
	{
		$this->db->from('items');
		$this->db->where('item_id',$item_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	function item_unique_exists($item_unique_id)
	{
		$this->db->from('items');	
		$this->db->where('item_unique_id',$item_unique_id);
		$query = $this->db->get();
		
		return ($query->num_rows()==1);
	}
	function get_item_id($item_number)
	{
		$this->db->from('items');
		$this->db->where('item_number',$item_number);
		$this->db->or_where('product_id', $item_number); 

		$query = $this->db->get();

		if($query->num_rows() >= 1)
		{
			return $query->row()->item_id;
		}
		
		if ($additional_item_id = $this->Additional_item_numbers->get_item_id($item_number))
		{
			return $additional_item_id;
		}

		return false;
	}
	function get_multiple_info($item_ids)
	{
		$this->db->from('items');
		$this->db->where_in('item_id',$item_ids);
		$this->db->order_by("item_id", "asc");
		return $this->db->get();
	}

	function get_next_id($item_id)
	{
		$items_table = $this->db->dbprefix('items');
		$result = $this->db->query("SELECT item_id FROM $items_table WHERE item_id = (select min(item_id) from $items_table where deleted = 0 and item_id > ".$this->db->escape($item_id).")");
		
		if($result->num_rows() > 0)
		{
			$row = $result->result();
			return $row[0]->item_id;
		}
		
		return FALSE;
	}
	
	function get_prev_id($item_id)
	{
		$items_table = $this->db->dbprefix('items');
		$result = $this->db->query("SELECT item_id FROM $items_table WHERE item_id = (select max(item_id) from $items_table where deleted = 0 and item_id <".$this->db->escape($item_id).")");
		
		if($result->num_rows() > 0)
		{
			$row = $result->result();
			return $row[0]->item_id;
		}
		
		return FALSE;
	}
	/*
	Updates multiple items at once
	*/
	function update_multiple($item_data,$item_ids,$select_inventory=0)
	{
		if(!$select_inventory){
		$this->db->where_in('item_id',$item_ids);
		}
		return $this->db->update('items',$item_data);
	}	

	function check_duplicate($term)
	{
		$this->db->from('items');
		$this->db->where('deleted',0);		
		$query = $this->db->where("item_name = ".$this->db->escape($term));
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return true;
		}
	}
	function get_item_search_suggestions($search,$limit=25)
	{
		$suggestions = array();

		$this->db->from('items');
		$this->db->where('deleted',0);
		$this->db->like('name', $search);
		$this->db->limit($limit);
		$by_name = $this->db->get();
		
		$temp_suggestions = array();
		
		foreach($by_name->result() as $row)
		{
			if ($row->category && $row->size)
			{
				$temp_suggestions[$row->item_id] =  $row->name . ' ('.$row->category.', '.$row->size.')';
			}
			elseif ($row->category)
			{
				$temp_suggestions[$row->item_id] =  $row->name . ' ('.$row->category.')';
			}
			elseif ($row->size)
			{
				$temp_suggestions[$row->item_id] =  $row->name . ' ('.$row->size.')';
			}
			else
			{
				$temp_suggestions[$row->item_id] = $row->name;				
			}
			
		}
		
		asort($temp_suggestions);
		
		foreach($temp_suggestions as $key => $value)
		{
			$suggestions[]=array('value'=> $key, 'label' => $value);		
		}
		
		$this->db->from('items');
		$this->db->where('deleted',0);
		$this->db->like('item_number', $search);
		$this->db->limit($limit);
		$by_item_number = $this->db->get();
		
		$temp_suggestions = array();
		
		foreach($by_item_number->result() as $row)
		{
			$temp_suggestions[$row->item_id] = $row->item_number;
		}
		
		asort($temp_suggestions);
		
		foreach($temp_suggestions as $key => $value)
		{
			$suggestions[]=array('value'=> $key, 'label' => $value);		
		}
				
		$this->db->from('items');
		$this->db->like('product_id', $search);
		$this->db->where('deleted',0);
		$this->db->limit($limit);
		$by_product_id = $this->db->get();

		$temp_suggestions = array();
		
		foreach($by_product_id->result() as $row)
		{
			$temp_suggestions[$row->item_id] = $row->product_id;
		}
		
		asort($temp_suggestions);
		
		foreach($temp_suggestions as $key => $value)
		{
			$suggestions[]=array('value'=> $key, 'label' => $value);		
		}
		
		for($k=count($suggestions)-1;$k>=0;$k--)
		{
			if (!$suggestions[$k]['label'])
			{
				unset($suggestions[$k]);
			}
		}
		
		$suggestions = array_values($suggestions);
		
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;

	}
	function get_categories()
	{
		$this->db->from('items_category');
		$this->db->where('deleted',0);
		$this->db->distinct();
		$this->db->order_by("name", "asc");

		return $this->db->get();
	}
	function cleanup()
	{
		$item_data = array('item_number' => null, 'product_id' => null);
		$this->db->where('deleted', 1);
		return $this->db->update('items',$item_data);
	}

	function stock_report($dateFrom,$dateTo){
		$item_name = $this->get_item_name()->result();		
		$arr_itemname = array();
		foreach($item_name as $key => $row){
			$item_id = $row->item_id;
			$item_unique_id = $row->item_unique_id;
			$current_stock = $this->get_current_stock($item_id, $dateFrom, $dateTo);

				$allPoQty = $current_stock['po']->row()->allQty;
				$allDiliveryQty = $current_stock['delivery']->row()->allQty;
				$get_current = ($allPoQty - $allDiliveryQty);

			$arr_itemname[] = array('item_id' => $item_id,
									 'item_unique' => $item_unique_id,
									 'item_name' => $row->item_name,
									 'item_name_kh' => $row->item_name_kh,
									 'item_model' => $row->model,
									 'item_po' => $allPoQty,
									 'item_delivery' => $allDiliveryQty,
									 'item_current' => $get_current);
		}
		return $arr_itemname;
	}

	function income_report($dateFrom,$dateTo){
		$item_name = $this->get_item_name()->result();
		$arr_itemname = array();
		foreach($item_name as $key => $row){
			$item_id = $row->item_id;
			$stock = $this->get_current_stock($item_id, $dateFrom, $dateTo);
			
			$diliveryOnDate= $stock['delivery']->row()->delivery_ondate;
			$diliveryExchangeRiel = $stock['delivery']->row()->exchangeRiel;
			$diliveryExchangeBaht = $stock['delivery']->row()->exchangeBaht;
			$diliveryDollar = $stock['delivery']->row()->total_dollar;
			$diliveryRiel = $stock['delivery']->row()->total_riel;
			$diliveryBaht = $stock['delivery']->row()->total_baht;
			$diliveryDiscount = $stock['delivery']->row()->allEachDiscount;
			$diliverySetDiscount = $stock['delivery']->row()->setDiscount;

			$arr_itemname[] = array('item_id' => $item_id,
									 'item_unique' => $row->item_unique_id,
									 'item_name' => $row->item_name,
									 'item_name_kh' => $row->item_name_kh,
									 'item_date' => $diliveryOnDate,
									 'item_exchange_riel' => $diliveryExchangeRiel,
									 'item_exchange_baht' => $diliveryExchangeBaht,
									 'item_totalDollar' => $diliveryDollar,
									 'item_totalRiel' => $diliveryRiel,
									 'item_totalBaht' => $diliveryBaht,
									 'item_discount' => $diliveryDiscount,
									 'item_set_discount' => $diliverySetDiscount);					

		}
		return $arr_itemname;
	}

	function po_report($dateFrom,$dateTo){
		$item_name = $this->get_item_name()->result();
		$arr_itemname = array();
		foreach($item_name as $key => $row){
			$item_id = $row->item_id;
			$stock = $this->get_current_stock($item_id, $dateFrom, $dateTo);
				
			$poDate = $stock['po']->row()->po_date;
			$poExchangeRiel = $stock['po']->row()->exchangeDollar;
			$poExchangeBaht = $stock['po']->row()->exchangeBaht;
			$poDollar = $stock['po']->row()->total_dollar;
			$poRiel = $stock['po']->row()->total_riel;
			$poBaht = $stock['po']->row()->total_baht;
			$poDiscount = $stock['po']->row()->allDiscount;

			$arr_itemname[] = array('item_id' => $item_id,
									 'item_unique' => $row->item_unique_id,
									 'item_name' => $row->item_name,
									 'item_name_kh' => $row->item_name_kh,
									 'item_date' => $poDate,
									 'item_exchange_riel' => $poExchangeRiel,
									 'item_exchange_baht' => $poExchangeBaht,	 
									 'item_totalDollar' => $poDollar,
									 'item_totalRiel' => $poRiel,
									 'item_totalBaht' => $poBaht,
									 'item_discount' => $poDiscount);
		}
		return $arr_itemname;
	}

	function get_item_name(){		
		return $this->db->query("SELECT item_id, item_unique_id, item_name, item_name_kh, model FROM edu_items");
	}
	function get_current_stock($item_id, $dateFrom, $dateTo){
		$po = $this->get_po($item_id, $dateFrom, $dateTo);
		$delivery = $this->get_delivery($item_id, $dateFrom, $dateTo);
		return array('po'=>$po, 'delivery'=>$delivery);
	}
	function get_po($item_id, $dateFrom, $dateTo){
		$exstra = '';
		if(!empty($dateFrom) && !empty($dateTo)){
			$exstra.="AND edu_items_process.po_date BETWEEN '{$dateFrom}' AND '{$dateTo}'";
		}
		return $this->db->query("SELECT edu_items_process.po_id,
								edu_items_process.po_supplier,
								edu_items_process_stored.item_id,
								edu_items_process.po_date,
								Sum(edu_items_process.po_exchange_d) AS exchangeDollar,
								Sum(edu_items_process.po_exchange_b) AS exchangeBaht,
								Sum(edu_items_process_stored.item_all_qty) AS allQty,
								Sum(edu_items_process_stored.item_each_discount) AS allDiscount,
								Sum(edu_items_process_stored.item_total_d) AS total_dollar,
								Sum(edu_items_process_stored.item_total_r) AS total_riel,
								Sum(edu_items_process_stored.item_total_b) AS total_baht
								FROM edu_items_process
								LEFT JOIN edu_items_process_stored ON edu_items_process.po_id = edu_items_process_stored.item_po_id
								where edu_items_process_stored.item_id = {$item_id} {$exstra}");
	}
	function get_delivery($item_id, $dateFrom, $dateTo){
		$exstra = '';
		if(!empty($dateFrom) && !empty($dateTo)){
			$exstra.="AND edu_items_delivery.delivery_ondate BETWEEN '{$dateFrom}' AND '{$dateTo}'";
		}
		return $this->db->query("SELECT edu_items_delivery.delivery_id,
								edu_items_delivery_stored.delivery_item_id,
								edu_items_delivery.delivery_ondate,
								Sum(edu_items_delivery_stored.delivery_all_qty) AS allQty,
								Sum(edu_items_delivery_stored.delivery_discount_for_sell) AS setDiscount,
								Sum(edu_items_delivery.exchange_riel) AS exchangeRiel,
								Sum(edu_items_delivery.exchange_baht) AS exchangeBaht,
								Sum(edu_items_delivery_stored.delivery_each_discount) AS allEachDiscount,
								Sum(edu_items_delivery_stored.delivery_total_dollar) AS total_dollar,
								Sum(edu_items_delivery_stored.delivery_total_riel) AS total_riel,
								Sum(edu_items_delivery_stored.delivery_total_baht) AS total_baht
								FROM edu_items_delivery
								LEFT JOIN edu_items_delivery_stored ON edu_items_delivery.delivery_id = edu_items_delivery_stored.delivery_id
								WHERE edu_items_delivery_stored.delivery_item_id = {$item_id} {$exstra}");
	}


}
?>
