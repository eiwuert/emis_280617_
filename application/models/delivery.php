<?php
class Delivery extends CI_Model
{
	// table management 
	function get_all($limit=10000, $offset=0, $col='delivery_id', $order='desc'){
		$data = $this->db->query("SELECT d.delivery_id,
										d.exchange_riel,
										d.exchange_baht,
										d.discount,
										d.total_price_d,
										d.total_price_r,
										d.total_price_b,
										d.delivery_ondate,
										d.receiver_id,
										d.purpose,
										d.send_by,
										d.deleted,
										p1.first_name as receiver_f,
										p1.last_name as receiver_l,
										p2.first_name as send_by_f,
										p2.last_name as send_by_l
								FROM edu_items_delivery as d
								LEFT JOIN edu_people as p1 ON p1.person_id = d.receiver_id
								LEFT JOIN edu_people as p2 ON p2.person_id = d.send_by_id
								WHERE d.deleted = 0
								ORDER BY {$col} {$order} 
								LIMIT {$offset},{$limit}");
		return $data;

	}
	
	function count_all(){
		$this->db->where('deleted',0)->from('items_delivery');
		return $this->db->count_all_results();
	}

	function search($search, $limit=20,$offset=0,$column='delivery_id',$orderby='desc')
	{
		$this->db->select('d.delivery_id,
							d.exchange_riel,
							d.exchange_baht,
							d.discount,
							d.total_price_d,
							d.total_price_r,
							d.total_price_b,
							d.delivery_ondate,
							d.receiver_id,
							d.purpose,
							d.send_by,							
							d.deleted,
							p1.first_name as receiver_f,
							p1.last_name as receiver_l,
							p2.first_name as send_by_f,
							p2.last_name as send_by_l');
		$this->db->from('items_delivery as d');
		$this->db->where("(p1.first_name LIKE '%".$this->db->escape_like_str($search)."%' OR p1.last_name LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->or_where("(p2.first_name LIKE '%".$this->db->escape_like_str($search)."%' OR p2.last_name LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->or_where("(d.delivery_ondate LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->join('people as p1','p1.person_id = d.receiver_id');
		$this->db->join('people as p2','p2.person_id = d.send_by_id');
		$this->db->where('d.deleted','0');
		$this->db->order_by($column,$orderby);
		$this->db->limit($limit);
		$this->db->offset($offset);
		return $this->db->get();
	}
	function search_count_all($search, $limit=10000)
	{
		$this->db->select('d.delivery_id,
							d.exchange_riel,
							d.exchange_baht,
							d.discount,
							d.total_price_d,
							d.total_price_r,
							d.total_price_b,
							d.delivery_ondate,
							d.receiver_id,
							d.purpose,
							d.deleted,
							d.send_by,
							p1.first_name as receiver_f,
							p1.last_name as receiver_l,
							p2.first_name as send_by_f,
							p2.last_name as send_by_l');
		$this->db->from('items_delivery as d');
		$this->db->where("(p1.first_name LIKE '%".$this->db->escape_like_str($search)."%' OR p1.last_name LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->or_where("(p2.first_name LIKE '%".$this->db->escape_like_str($search)."%' OR p2.last_name LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->or_where("(d.delivery_ondate LIKE '%".$this->db->escape_like_str($search)."%')");
		$this->db->join('people as p1','p1.person_id = d.receiver_id');
		$this->db->join('people as p2','p2.person_id = d.send_by_id');
		$this->db->where('d.deleted',0);
		$this->db->limit($limit);
		$result=$this->db->get();
		return $result->num_rows();
	}
	function get_search_suggestions_delivery($search,$limit=25){
		$suggestions = array();
		$this->db->select('p1.first_name as f1_name, p1.last_name as l1_name, p2.first_name as f2_name, p2.last_name as l2_name');
		$this->db->from('items_delivery');
		$this->db->join('people as p1','p1.person_id = items_delivery.receiver_id','left');
		$this->db->join('people as p2','p2.person_id = items_delivery.send_by_id','left');
		$this->db->like('p1.first_name', $search);
        $this->db->or_like('p1.last_name', $search);
        $this->db->or_like('p2.first_name', $search);
        $this->db->or_like('p2.last_name', $search);
        $this->db->where('items_delivery.deleted',0);
		$this->db->group_by('items_delivery.delivery_id');
		$this->db->limit($limit);
		$by_name = $this->db->get();
		
		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->f1_name;
		}	
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->l1_name;
		}		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		// ===========
		$this->db->select('p1.first_name as f1_name, p1.last_name as l1_name, p2.first_name as f2_name, p2.last_name as l2_name, items_delivery.delivery_ondate');
		$this->db->from('items_delivery');
		$this->db->join('people as p1','p1.person_id = items_delivery.receiver_id','left');
		$this->db->join('people as p2','p2.person_id = items_delivery.send_by_id','left');
		$this->db->like('p1.first_name', $search);
        $this->db->or_like('p1.last_name', $search);
        $this->db->or_like('p2.first_name', $search);
        $this->db->or_like('p2.last_name', $search);
        $this->db->where('items_delivery.deleted',0);
		$this->db->group_by('items_delivery.delivery_id');
		$this->db->limit($limit);
		$by_name = $this->db->get();

		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->f2_name;
		}		
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->l2_name;
		}	
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		// ===========
		$this->db->select('delivery_ondate');
		$this->db->from('items_delivery');
		$this->db->like('delivery_ondate', $search);       
		$this->db->group_by('delivery_id');
		$this->db->limit($limit);
		$by_name = $this->db->get();

		$temp_suggestions = array();
		foreach($by_name->result() as $row)
		{
			$temp_suggestions[] = $row->delivery_ondate;
		}		
		sort($temp_suggestions);
		foreach($temp_suggestions as $temp_suggestion)
		{
			$suggestions[]=array('label'=> $temp_suggestion);		
		}
		// ===========
		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0,$limit);
		}
		return $suggestions;
	}
	// save items
	function item_save(&$item_data,$item_id=false, $unit_data, $unit_data_old)
	{
		$count = count($unit_data['item_name']);
		$success=false;
		$this->db->trans_start();
		if (!$item_id or !$this->exists($item_id))
		{
			$success = $this->db->insert('items_delivery',$item_data);
			$item_data['delivery_id']=$this->db->insert_id();

			for ($i=0; $i < $count; $i++) { 
				$data_sale = array(
					"delivery_id" => $item_data['delivery_id'],
					"delivery_item_id" => $unit_data['item_name'][$i],
					"delivery_item_unit" => $unit_data['item_unit'][$i],
					"delivery_price_for_sell" => $unit_data['storage_unit_price'][$i],
					"delivery_discount_for_sell" => $unit_data['storage_unit_discount'][$i],
					"delivery_quantity" => $unit_data['quantity'][$i],
					"delivery_all_qty" => $unit_data['all_qty'][$i],
					"delivery_total_dollar" => $unit_data['total_dollar'][$i],
					"delivery_total_riel" => $unit_data['total_riel'][$i],
					"delivery_total_baht" => $unit_data['total_baht'][$i],					
					"delivery_each_discount" => $unit_data['d_each_discount'][$i],
				);
				$success = $this->db->insert('edu_items_delivery_stored',$data_sale);
			}
		}else{
			$success = $this->db->where('delivery_id', $item_id)->update('items_delivery',$item_data);
			// update_old pro
			$count_items_old = count($unit_data_old['autoid']);
			for ($i=0; $i < $count_items_old; $i++) { 
				$data_sale_update = array(
					"delivery_id" => $item_id,
					"delivery_item_id" => $unit_data_old['item_name'][$i],
					"delivery_item_unit" => $unit_data_old['item_unit'][$i],
					"delivery_price_for_sell" => $unit_data_old['storage_unit_price'][$i],
					"delivery_discount_for_sell" => $unit_data_old['storage_unit_discount'][$i],
					"delivery_quantity" => $unit_data_old['quantity'][$i],
					"delivery_all_qty" => $unit_data_old['all_qty'][$i],
					"delivery_total_dollar" => $unit_data_old['total_dollar'][$i],
					"delivery_total_riel" => $unit_data_old['total_riel'][$i],
					"delivery_total_baht" => $unit_data_old['total_baht'][$i],
					"delivery_each_discount" => $unit_data_old['d_each_discount'][$i],
					"deleted" => $unit_data_old['deleted'][$i],
				);
				$success = $this->db->where('id',$unit_data_old['autoid'][$i])->update('edu_items_delivery_stored',$data_sale_update);
			}
			// insert new if new
			for ($i=0; $i < $count; $i++) { 
				$data_sale = array(
					"delivery_id" => $item_id,
					"delivery_item_id" => $unit_data['item_name'][$i],
					"delivery_item_unit" => $unit_data['item_unit'][$i],
					"delivery_price_for_sell" => $unit_data['storage_unit_price'][$i],
					"delivery_discount_for_sell" => $unit_data['storage_unit_discount'][$i],
					"delivery_quantity" => $unit_data['quantity'][$i],
					"delivery_all_qty" => $unit_data['all_qty'][$i],
					"delivery_total_dollar" => $unit_data['total_dollar'][$i],
					"delivery_total_riel" => $unit_data['total_riel'][$i],
					"delivery_total_baht" => $unit_data['total_baht'][$i],					
					"delivery_each_discount" => $unit_data['d_each_discount'][$i],
				);
				$success = $this->db->insert('edu_items_delivery_stored',$data_sale);
			}
		}		
		$this->db->trans_complete();
		return $success;
	}

	function into_item_table($i_storage){
		$this->db->insert('items_delivery_pass',$i_storage);
	}

	function exists($item_id)
	{
		$this->db->from('items_delivery');
		$this->db->where('delivery_id',$item_id);
		$query = $this->db->get();
		return ($query->num_rows()==1);
	}

	function get_storage($id){
		$this->db->select('d.delivery_id,
							d.exchange_riel,
							d.exchange_baht,
							d.discount,
							d.total_price_d,
							d.total_price_r,
							d.total_price_b,
							d.delivery_ondate,
							d.receiver_id,
							d.purpose,							
							d.deleted,
							d.send_by_id,
							d.all_discount,
							p1.first_name as receiver_f,
							p1.last_name as receiver_l,
							p2.first_name as send_by_f,
							p2.last_name as send_by_l');
		$this->db->from('items_delivery as d');	
		$this->db->join('people as p1','p1.person_id = d.receiver_id','left');
		$this->db->join('people as p2','p2.person_id = d.send_by_id','left');	
		$this->db->where('delivery_id',$id);
		$data_result = $this->db->get();
		return $data_result;
	}
	function get_storage_pro($id){
		$this->db->from('items_delivery_stored');		
		$this->db->where('delivery_id',$id);
		$this->db->where('items_delivery_stored.deleted',0);
		$this->db->join('items','items.item_id = items_delivery_stored.delivery_item_id','left');	
		$data_result = $this->db->get();
		return $data_result;
	}	
	function get_cate_unit_id($id){
		$this->db->from('item_sell_price');
        $this->db->join('item_category_unit','item_category_unit.unit_id = item_sell_price.item_unit_cate_id','left');
        $this->db->where('item_sell_price.item_id',$id);
        $this->db->where('item_sell_price.deleted',0);	     
		return $this->db->get();
	}
	function get_view_delivery_print($delivery_id){
		$this->db->select('i.item_unique_id, 
							i.item_name,
							i.item_name_kh,
							i.model,
							ds.delivery_quantity,
							ds.delivery_all_qty,
							ds.delivery_total_dollar,
							ds.delivery_total_riel,
							ds.delivery_total_baht,
							d.receiver_id,
							d.send_by_id,
							u.unit_name');
		$this->db->from('items_delivery_stored as ds');
		$this->db->join('items as i','i.item_id = ds.delivery_item_id','left');
		$this->db->join('item_category_unit as u','u.unit_id = ds.delivery_item_unit','left');
		$this->db->join('items_delivery as d','d.delivery_id = ds.delivery_id','left');
		$this->db->where('ds.delivery_id',$delivery_id);
		return $this->db->get();
	}
	function get_receiver($receiver_id=''){		
		return $this->db->where('person_id',$receiver_id)->get('people')->row();
	}
	function get_send_by($send_by_id=''){
		return $this->db->where('person_id',$send_by_id)->get('people')->row();
	}

	function delete_list($delivery_id)
	{
		$success=false;
		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		$this->db->where_in('delivery_id',$delivery_id);
		$success = $this->db->update('items_delivery', array('deleted' => 1));
		$this->db->trans_complete();
		return $success;
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
	function remove_unit($id){
		return $this->db->where('id',$id)->delete('items_delivery_stored');
	}




























	// function get_search_suggestions($search,$limit=25){

	// 	$suggestions = array();

	// 	$this->db->from('items');
	// 	$this->db->like('item_name', $search);
	// 	$this->db->where('deleted',0);
	// 	$this->db->limit($limit);
	// 	$by_name = $this->db->get();
	// 	$temp_suggestions = array();
	// 	foreach($by_name->result() as $row)
	// 	{
	// 		$temp_suggestions[] = array('label' => $row->item_name, 'unique_id' => $row->item_unique_id, 'label_id' => $row->item_id );
	// 	}
		
	// 	// sort($temp_suggestions);
	// 	foreach($temp_suggestions as $temp_suggestion)
	// 	{
	// 		$suggestions[]=array('label'=> $temp_suggestion['label'], 'unique_id'=> $temp_suggestion['unique_id'], 'label_id'=> $temp_suggestion['label_id']);		
	// 	}
	
		
	// 	//only return $limit suggestions
	// 	if(count($suggestions > $limit))
	// 	{
	// 		$suggestions = array_slice($suggestions, 0,$limit);
	// 	}
	// 	return $suggestions;
	// }
	


	// function get_info_items($id_item){	
	// 	$this->db->from('items');
	// 	$this->db->where('item_id',$id_item);
	// 	$this->db->where('deleted',0);
	// 	return $this->db->get();
	// }
	// function keep_items($datas){
	// 	if($this->db->insert('items_delivery_stored',$datas)){
	// 		return true;
	// 	}
	// 	return false;
	// }
	// function remove_items($uid){
	// 	$this->db->where('d_user',$uid)->delete('items_delivery_stored');
	// }

	// function up_amount($id,$array_amount){
	// 	$this->db->where('d_id',$id);
	// 	$this->db->update('items_delivery_stored',$array_amount);
	// 	return true;
	// }

	// function get_storage_by_user($uid){
	// 	$this->db->select('edu_items_delivery_stored.d_unit_price as total_dollar,
	// 						edu_items_delivery_stored.d_unit_price_reil as total_reil,
	// 						edu_items_delivery_stored.d_unit_price_baht as total_baht,
	// 						edu_items_delivery_stored.d_amount as total_amount,
	// 						edu_items.item_unique_id as item_unique_id,
	// 						edu_items_delivery_stored.d_item_id as item_id,
	// 						edu_items.item_name as item_name,
	// 						edu_items.item_name_kh as item_name_kh,
	// 						edu_items.unit_price as unit_price,
	// 						edu_items.unit_price_reil as unit_price_reil,
	// 						edu_items.unit_price_baht as unit_price_baht');
	// 	$this->db->where('d_user',$uid)->join('items','items_delivery_stored.d_item_id = items.item_id')->from('edu_items_delivery_stored');
	// 	return $this->db->get();
	// }

	// function delete_data_storage($id){
	// 	$this->db->where('d_id',$id)->delete('items_delivery_stored');
	// 	return true;
	// }
	// function view_item_delivery_byid($pass_id){
	// 	$this->db->from('items_delivery_pass');
	// 	$this->db->where('pass_id',$pass_id);
	// 	return $this->db->get();
	// }

}
