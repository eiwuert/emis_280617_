<?php

/*
  Gets the html table to manage items.
 */

function get_items_manage_table($items, $controller) {
    $CI = & get_instance();
    // $has_cost_price_permission = $CI->Employee->has_module_action_permission('items', 'see_cost_price', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table = '<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">';

    $headers = array('<input type="checkbox" id="select_all" />',
        $CI->lang->line('items_unique_id'),
        $CI->lang->line('items_name'),
        $CI->lang->line('items_name_kh'),
        $CI->lang->line('items_category'),
        $CI->lang->line('items_model'),
        $CI->lang->line('items_current_stock'),
        $CI->lang->line('items_average'),
        $CI->lang->line('common_view'),
        $CI->lang->line('common_action'),
    );
    $table.='<thead><tr>';
    $count = 0;
    foreach ($headers as $header) {
        $count++;

        if ($count == 1) {
            $table.="<th class='leftmost'>$header</th>";
        } elseif ($count == count($headers)) {
            $table.="<th class='rightmost'>$header</th>";
        } else {
            $table.="<th>$header</th>";
        }
    }
    $table.='</tr></thead><tbody id="bodyDrop">';
    $table.=get_items_manage_table_data_rows($items, $controller);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the items.
 */

function get_items_manage_table_data_rows($items, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';
    $total_item_qty = '';
    foreach ($items->result() as $item) {
	    	$item_id = $item->item_id;
	    	// calculate stock follow by items_report function view()
			$get_all_po = $CI->Item_products->get_po($item_id)->row();
			$po = array(
				'p_qty' => $get_all_po->allQty,
				'p_dollar' => $get_all_po->total_dollar,
				'p_riel' => $get_all_po->total_riel,
				'p_baht' => $get_all_po->total_baht
			);
			$get_all_delivery = $CI->Item_products->get_delivery($item_id)->row();
			$delivery = array(
				'qty' => $get_all_delivery->allQty,
				'dollar' => $get_all_delivery->total_dollar,
				'riel' => $get_all_delivery->total_riel,
				'baht' => $get_all_delivery->total_baht
			);
			$get_average = (($po['p_dollar'] - $delivery['dollar']) / ($po['p_qty'] - $delivery['qty']));
			$result_avg = ($get_average <= 0)? 0: $get_average;
			$current = array(
				'current_qty' => $po['p_qty'] - $delivery['qty'],
				'average_cost' => $result_avg
			);
	        $table_data_rows.=get_item_data_row($item, $controller, $current);
    }

    if ($items->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='17'><span class='col-md-12 text-center text-warning' >" . lang('items_no_items_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_item_data_row($item, $controller, $current) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
	// to_currency_no_money($item->unit_price_baht, 10) 
    $table_data_row = '<tr>';    
    $table_data_row.="<td><input type='checkbox' id='item_$item->item_id' value='" . $item->item_id . "'/></td>";
    $table_data_row.='<td>' . H($item->item_unique_id) . '</td>';
    $table_data_row.='<td>' . H($item->item_name) . '</td>';
    $table_data_row.='<td>' . H($item->item_name_kh) . '</td>';
    $table_data_row.='<td>' . H($item->name) . '</td>';
    $table_data_row.='<td>' . $item->model. '</td>';
    $table_data_row.='<td align="right">' . to_quantity($current['current_qty']) . '</td>';
    $table_data_row.='<td align="right">' . to_currency_no_money($current['average_cost'], 2) . '</td>';
    $table_data_row.='<td align="right"><a class="viewDrop" data-id="'.$item->item_id.'" href="javascript:void(0);">View</a></td>';
    $table_data_row.='<td align="right">' . anchor($controller_name . "/view/$item->item_id/2", lang('common_edit'), array('class' => '', 'title' => lang($controller_name . '_update'))) . '</td>';
    $table_data_row.='</tr>'; 

		    $table_data_row.= '<tr class="dropUnit_'.$item->item_id.'" style="display:none; background:rgb(207, 251, 218);border-top:solid 3px #000">';    
		    $table_data_row.='<td></td>';    
		    $table_data_row.='<td>'.lang('items_unit').'</td>';      
		    $table_data_row.='<td>'.lang('items_totalUnit').'</td>';   
		    $table_data_row.='<td>'.lang('items_unit_forsell').'</td>';   
		    $table_data_row.='<td>'.lang('items_discount_sell').'</td>';   
		    $table_data_row.='<td colspan="5"></td>';
		    $table_data_row.='</tr>';

    $getViewUnit = $CI->Item_products->getListUnit($item->item_id);
    if($getViewUnit->num_rows() > 0){
    	foreach($getViewUnit->result() as $rowUnit){
		    $table_data_row.='</tr>';       
		    $table_data_row.= '<tr class="dropUnit_'.$item->item_id.'" style="display:none; background:rgb(207, 251, 218);">';    
		    $table_data_row.='<td></td>';     
		    $table_data_row.='<td> - '.$rowUnit->unit_name.' :</td>';
		    $table_data_row.='<td align="right">'.round(intval($current['current_qty'] / $rowUnit->item_qty_unit)).'</td>';
		    $table_data_row.='<td align="right">$ '.$rowUnit->item_set_price.'</td>';
		    $table_data_row.='<td align="right">% '.$rowUnit->item_discount.'</td>';
		    $table_data_row.='<td colspan="5"></td>';
		    $table_data_row.='</tr>';
    	}    	
    }

    return $table_data_row;
}


// ============================================================

function get_items_barcode_data($item_ids)
{
	$CI =& get_instance();	
	$result = array();

	$item_ids = explode('~', $item_ids);
	foreach ($item_ids as $item_id)
	{
		$item_info = $CI->Item->get_info($item_id);
		$item_location_info = $CI->Item_location->get_info($item_id);
		
		$today =  strtotime(date('Y-m-d'));
		$is_item_location_promo = ($item_location_info->start_date !== NULL && $item_location_info->end_date !== NULL) && (strtotime($item_location_info->start_date) <= $today && strtotime($item_location_info->end_date) >= $today);
		$is_item_promo = ($item_info->start_date !== NULL && $item_info->end_date !== NULL) && (strtotime($item_info->start_date) <= $today && strtotime($item_info->end_date) >= $today);
		
		$regular_item_price = $item_location_info->unit_price ? $item_location_info->unit_price : $item_info->unit_price;
		
		if ($is_item_location_promo)
		{
			$item_price = $item_location_info->promo_price;
		}
		elseif ($is_item_promo)
		{
			$item_price = $item_info->promo_price;
		}
		else
		{
			$item_price = $item_location_info->unit_price ? $item_location_info->unit_price : $item_info->unit_price;
		}		
		
		if($CI->config->item('barcode_price_include_tax'))
		{
			if($item_info->tax_included)
			{
				$result[] = array('name' => ($is_item_location_promo || $is_item_promo ? '<span style="text-decoration: line-through;">'.to_currency($regular_item_price).'</span> ' : ' ').to_currency($item_price).': '.$item_info->name, 'id'=> number_pad($item_id, 10));
			}
			else
			{				
				$result[] = array('name' => ($is_item_location_promo || $is_item_promo ? '<span style="text-decoration: line-through;">'.to_currency(get_price_for_item_including_taxes($item_id,$regular_item_price)).'</span> ' : ' ').to_currency(get_price_for_item_including_taxes($item_id,$item_price)).': '.$item_info->name, 'id'=> number_pad($item_id, 10));
				
	  	 	}
	  }
	  else
	  {
		if ($item_info->tax_included)
		{
		    $result[] = array('name' =>($is_item_location_promo || $is_item_promo ? '<span style="text-decoration: line-through;">'.to_currency(get_price_for_item_excluding_taxes($item_id, $regular_item_price)).'</span> ' : ' ').to_currency(get_price_for_item_excluding_taxes($item_id, $item_price)).': '.$item_info->name, 'id'=> number_pad($item_id, 10));
		}
		else
		{
			$result[] = array('name' => ($is_item_location_promo || $is_item_promo ? '<span style="text-decoration: line-through;">'.to_currency($regular_item_price).'</span> ' : ' ').to_currency($item_price).': '.$item_info->name, 'id'=> number_pad($item_id, 10));
	  	}
	  }
	}
	return $result;
}

function get_price_for_item_excluding_taxes($item_id_or_line, $item_price_including_tax, $sale_id = FALSE)
{
	$return = FALSE;
	$CI =& get_instance();
	
	if ($sale_id !== FALSE)
	{
		$tax_info = $CI->Sale->get_sale_items_taxes($sale_id, $item_id_or_line);
	}	
	else
	{
		$tax_info = $CI->Item_taxes_finder->get_info($item_id_or_line);
	}
	
	if (count($tax_info) == 2 && $tax_info[1]['cumulative'] == 1)
	{
		$return = $item_price_including_tax/(1+($tax_info[0]['percent'] /100) + ($tax_info[1]['percent'] /100) + (($tax_info[0]['percent'] /100) * (($tax_info[1]['percent'] /100))));
	}
	else //0 or more taxes NOT cumulative
	{
		$total_tax_percent = 0;
		
		foreach($tax_info as $tax)
		{
			$total_tax_percent+=$tax['percent'];
		}
		
		$return = $item_price_including_tax/(1+($total_tax_percent /100));
	}
	
	if ($return !== FALSE)
	{
		return to_currency_no_money($return, 10);
	}
	
	return FALSE;
}

function get_price_for_item_including_taxes($item_id_or_line, $item_price_excluding_tax, $sale_id = FALSE)
{
	$return = FALSE;
	$CI =& get_instance();
	if ($sale_id !== FALSE)
	{
		$tax_info = $CI->Sale->get_sale_items_taxes($sale_id,$item_id_or_line);
	}	
	else
	{
		$tax_info = $CI->Item_taxes_finder->get_info($item_id_or_line);
	}
	
	if (count($tax_info) == 2 && $tax_info[1]['cumulative'] == 1)
	{
		$first_tax = ($item_price_excluding_tax*($tax_info[0]['percent']/100));
		$second_tax = ($item_price_excluding_tax + $first_tax) *($tax_info[1]['percent']/100);
		$return = $item_price_excluding_tax + $first_tax + $second_tax;
	}	
	else //0 or more taxes NOT cumulative
	{
		$total_tax_percent = 0;
		
		foreach($tax_info as $tax)
		{
			$total_tax_percent+=$tax['percent'];
		}
		
		$return = $item_price_excluding_tax*(1+($total_tax_percent /100));
	}

	
	if ($return !== FALSE)
	{
		return to_currency_no_money($return, 10);
	}
	
	return FALSE;
}

function get_commission_for_item($item_id, $price, $quantity,$discount)
{
	$CI =& get_instance();
	$CI->load->library('sale_lib');

	$employee_id=$CI->sale_lib->get_sold_by_employee_id();
	$sales_person_info = $CI->Employee->get_info($employee_id);
	$employee_id=$CI->Employee->get_logged_in_employee_info()->person_id;
	$logged_in_employee_info = $CI->Employee->get_info($employee_id);
	
	$item_info = $CI->Item->get_info($item_id);
	
	if ($item_info->commission_fixed > 0)
	{
		return $quantity*$item_info->commission_fixed;
	}
	elseif($item_info->commission_percent > 0)
	{
		return to_currency_no_money(($price*$quantity-$price*$quantity*$discount/100)*($item_info->commission_percent/100));
	}
	elseif($CI->config->item('select_sales_person_during_sale'))
	{
		if($sales_person_info->commission_percent > 0)
		{
			return to_currency_no_money(($price*$quantity-$price*$quantity*$discount/100)*((float)($sales_person_info->commission_percent)/100));
		}
		return to_currency_no_money(($price*$quantity-$price*$quantity*$discount/100)*((float)($CI->config->item('commission_default_rate'))/100));
	}
	elseif($logged_in_employee_info->commission_percent > 0)
	{
		return to_currency_no_money(($price*$quantity-$price*$quantity*$discount/100)*((float)($logged_in_employee_info->commission_percent)/100));
	}
	else
	{
		return to_currency_no_money(($price*$quantity-$price*$quantity*$discount/100)*((float)($CI->config->item('commission_default_rate'))/100));
	}
}


/*
  Gets the html table to manage items.
*/
function get_po_manage_table($po, $controller) {
    $CI = & get_instance();
    $table = '<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">';

    $headers = array('<input type="checkbox" id="select_all" />',
        $CI->lang->line('po_supplier_no'),
        $CI->lang->line('po_supplier'),
        $CI->lang->line('po_received'),
        $CI->lang->line('po_date'),
        $CI->lang->line('po_total_dollar'),
        $CI->lang->line('po_total_riel'),
        $CI->lang->line('po_total_baht'),
        $CI->lang->line('po_discount'),
        $CI->lang->line('po_exchange_dollar'),
        $CI->lang->line('po_exchange_baht'),        
        $CI->lang->line('common_action'),
    );

    $table.='<thead><tr>';
    $count = 0;
    foreach ($headers as $header) {
        $count++;

        if ($count == 1) {
            $table.="<th class='leftmost'>$header</th>";
        } elseif ($count == count($headers)) {
            $table.="<th class='rightmost'>$header</th>";
        } else {
            $table.="<th>$header</th>";
        }
    }
    $table.='</tr></thead><tbody>';
    $table.=get_po_manage_table_data_rows($po, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_po_manage_table_data_rows($po, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($po->result() as $po_item) {
        $table_data_rows.=get_po_data_row($po_item, $controller);
    }

    if ($po->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='17'><span class='col-md-12 text-center text-warning' >" . lang('po_no_items_to_display') . "</span></tr>";
    }
    return $table_data_rows;
}

function get_po_data_row($po_item, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    $table_data_row.="<td width='2%'><input type='checkbox' id='po_id_$po_item->po_id' value='" . $po_item->po_id . "'/></td>";
    $table_data_row.='<td width="3%">' . $po_item->po_id . '</td>';
    $table_data_row.='<td width="10%">' . H($po_item->company_name) . '</td>';
    $table_data_row.='<td width="10%"> receved</td>';
    $table_data_row.='<td width="9%">' . H($po_item->po_date) . '</td>';
    $table_data_row.='<td width="9%">' . $po_item->po_total_d . '</td>';
    $table_data_row.='<td width="10%">' . $po_item->po_total_r. '</td>';
    $table_data_row.='<td width="9%">' . $po_item->po_total_b . '</td>';
    $table_data_row.='<td width="9%">' . $po_item->po_total_discount . '</td>';
    $table_data_row.='<td width="9%">' . $po_item->po_exchange_d . '</td>';
    $table_data_row.='<td width="9%">' . $po_item->po_exchange_b . '</td>';
    $table_data_row.='<td width="4%" class="rightmost">';
    $table_data_row.='<a href="'.site_url($controller_name."/view/$po_item->po_id/2").'"><i class="ace-icon fa fa-pencil bigger-180"></i></a>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}

	// function get_items_manage_table($items, $controller) {

	// }

?>