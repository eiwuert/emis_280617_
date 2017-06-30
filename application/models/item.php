<?php
class Item extends CI_Model
{
	/*
	Inserts or updates a item
	*/
	function save_po(&$po_data,$po_id=false, $po_data_items, $po_data_items_old)
	{
		$count_items = count($po_data_items['item_name']);
		$success=false;
		$this->db->trans_start();
		if ($po_id <= 0)
		{
			$success = $this->db->insert('items_process',$po_data);
			$po_data['po_id'] = $this->db->insert_id();
			// insert items
			for ($i=0; $i < $count_items; $i++) { 
				$items_save = array(
					'item_po_id' => $po_data['po_id'],
					'item_id' => $po_data_items['item_name'][$i],
					'item_unit_id' => $po_data_items['item_unit'][$i],
					'item_qty' => $po_data_items['quantity'][$i],
					'item_all_qty' => $po_data_items['all_qty'][$i],
					'item_pri_d' => $po_data_items['d_price'][$i],					
					'item_total_d' => $po_data_items['total_dollar'][$i],
					'item_total_r' => $po_data_items['total_riel'][$i],
					'item_total_b' => $po_data_items['total_baht'][$i],
					'item_each_discount' => $po_data_items['each_discount'][$i],
					'created_by' => $po_data_items['created_by'][$i],
					'created_at' => $po_data_items['created_at'][$i],
				);
				$success = $this->db->insert('items_process_stored',$items_save);
			}
		}else{
			$this->db->where('po_id', $po_id);
			$success= $this->db->update('items_process',$po_data);
			// update old
			$count_items_old = count($po_data_items_old['autoid']);
			for ($o=0; $o < $count_items_old; $o++) { 
				$items_update = array(
					'item_po_id' => $po_id,
					'item_id' => $po_data_items_old['item_name'][$o],
					'item_qty' => $po_data_items_old['quantity'][$o],
					'item_pri_d' => $po_data_items_old['d_price'][$o],
					'item_total_d' => $po_data_items_old['total_dollar'][$o],
					'item_total_r' => $po_data_items_old['total_riel'][$o],
					'item_total_b' => $po_data_items_old['total_baht'][$o],
					'item_each_discount' => $po_data_items_old['each_discount'][$o],
					'updated_by' => $po_data_items_old['updated_by'][$o],
					'updated_at' => $po_data_items_old['updated_at'][$o],
					'deleted' => $po_data_items_old['deleted'][$o]
				);
				$success = $this->db->where('id',$po_data_items_old['autoid'][$o])->update('items_process_stored',$items_update);
			}
			// insert new
			for ($i=0; $i < $count_items; $i++) { 
				$items_save = array(
					'item_po_id' => $po_id,
					'item_id' => $po_data_items['item_name'][$i],
					'item_unit_id' => $po_data_items['item_unit'][$i],
					'item_qty' => $po_data_items['quantity'][$i],
					'item_all_qty' => $po_data_items['all_qty'][$i],
					'item_pri_d' => $po_data_items['d_price'][$i],					
					'item_total_d' => $po_data_items['total_dollar'][$i],
					'item_total_r' => $po_data_items['total_riel'][$i],
					'item_total_b' => $po_data_items['total_baht'][$i],
					'item_each_discount' => $po_data_items['each_discount'][$i],
					'created_by' => $po_data_items['created_by'][$i],
					'created_at' => $po_data_items['created_at'][$i],
				);
				$success = $this->db->insert('items_process_stored',$items_save);
			}
			$this->db->where('po_id', $po_id);
			$success= $this->db->update('items_process',$po_data);	

		}

		$this->db->trans_complete();
		return $success;
	}
	
	function count_all_po()
	{
		$this->db->from('items_process');
		return $this->db->count_all_results();
	}
	/*
	Returns all the items
	*/
	function get_all_po($limit=10000, $offset=0,$col='po_id',$order='desc')
	{
		$this->db->from('items_process');
		$this->db->join('suppliers', 'items_process.po_supplier = suppliers.id','left');
		$this->db->order_by($col, $order);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function get_all_po_by_id($po_id)
	{
		$this->db->from('items_process');
		$this->db->join('suppliers', 'items_process.po_supplier = suppliers.id','left');
		$this->db->order_by($col, $order);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}

	function get_search_suggestions_po($search,$limit=25)
	{
		$suggestions = array();

		$this->db->from('items_process');
		$this->db->join('suppliers','items_process.po_supplier = suppliers.id','left');
		$this->db->like('company_name', $search);
		$this->db->group_by('po_supplier');
		$this->db->limit($limit);
		$by_name = $this->db->get();
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->company_name;
		}		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		

		// $this->db->from('items_process');
		// $this->db->join('suppliers','items_process.po_supplier = suppliers.id','left');
		// $this->db->like('po_receved', $search);
		// $this->db->group_by('po_supplier');
		// $this->db->limit($limit);
		// $by_po_receved = $this->db->get();
		
		// $temp_suggestions = array();
		// foreach($by_po_receved->result() as $row)
		// {
		// 	$temp_suggestions[] = $row->po_receved;
		// }
		
		// sort($temp_suggestions);
		// foreach($temp_suggestions as $temp_suggestion)
		// {
		// 	$suggestions[]=array('label'=> $temp_suggestion);		
		// }
		
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;

	}

	function delete_list_po($po_to_delete)
	{	
		$success=false;
		if($po_to_delete > 0){
			$success = $this->db->where_in('item_po_id',$po_to_delete)->delete('items_process_stored');
			$success = $this->db->where('po_id',$po_to_delete)->delete('items_process');
		}
		return $success;				

 	}
 	function get_po_byid($po_id)
	{
		return $this->db->where('items_process.po_id',$po_id)
				->join('suppliers','suppliers.id = items_process.po_supplier','left')
				->get('items_process');

	}
	function get_po_items_by_id($po_id)
	{
		return $this->db->select('items_process_stored.id,
								items.item_unique_id, 
								items_process_stored.item_po_id, 
								items_process_stored.item_unit_id, 
								items_process_stored.item_id, 
								items_process_stored.item_qty, 
								items_process_stored.item_all_qty, 
								items_process_stored.item_pri_d, 
								items_process_stored.item_total_d,
								items_process_stored.item_total_r,
								items_process_stored.item_total_b,
								items_process_stored.item_each_discount')
		->where('item_po_id',$po_id)
		->where('items_process_stored.deleted',0)
		->join('items','items.item_id = items_process_stored.item_id','left')
		->get('items_process_stored');
	}

	function get_cate_item_name(){
		$this->db->from('items');
		$this->db->where('deleted',0);
		$this->db->order_by('item_name','asc');
		return $this->db->get();
	}
	function get_cate_item_name_id($id){
		$this->db->from('items');
		$this->db->where('item_id',$id);
		$this->db->where('deleted',0);
		$this->db->order_by('item_name','asc');
		return $this->db->get();
	}

	function get_cate_unit_id($id){
		$this->db->from('item_sell_price');
        $this->db->join('item_category_unit','item_category_unit.unit_id = item_sell_price.item_unit_cate_id','left');
        $this->db->where('item_sell_price.item_id',$id);
        $this->db->where('item_sell_price.deleted',0);	
		return $this->db->get();
	}
}
?>
