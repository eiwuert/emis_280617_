<?php
function get_delivery_manage_table($data_table,$contorller){
	$CI =& get_instance();	
	$controller_name = strtolower(get_class($CI));

	$table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
   	$headers = array('<input type="checkbox" id="select_all" />',
        lang('delivery_receiver'),
        lang('delivery_ondate'),
        lang('delivery_send_by'),
        lang('delivery_exchange_riel'),
        lang('delivery_exchange_baht'),
        lang('delivery_total_dollar'),
        lang('delivery_total_reil'),
        lang('delivery_total_baht'),
        lang('delivery_discount'),
        lang('common_action')
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
    $table.=get_delivery_manage_table_data_rows($data_table, $controller);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the delivery.
 */
function get_delivery_manage_table_data_rows($data_table, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    $t_dollar ='';
    $t_reil='';
    $t_baht ='';
    foreach($data_table->result() as $row_table) {
        $table_data_rows.=get_delivery_data_row($row_table, $controller);
    }

    if ($data_table->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='11'><span class='col-md-12 text-center text-warning' >" . lang('delivery_no_delivery_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_delivery_data_row($row_table, $controller){
	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $delete = $CI->Employee->has_module_action_permission('delivery_note', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('delivery_note', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);

    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='delivery_$row_table->delivery_id' value='" . $row_table->delivery_id . "'/></td>";
    $table_data_row.='<td>' . (($row_table->receiver_f)? $row_table->receiver_f.' '.$row_table->receiver_l : 'Student' ) . '</td>';
    $table_data_row.='<td>' . H($row_table->delivery_ondate) . '</td>';
    $table_data_row.='<td>' . H($row_table->send_by_f.' '.$row_table->send_by_l) . '</td>';
    $table_data_row.='<td>' . H($row_table->exchange_riel) . '</td>';
    $table_data_row.='<td>' . H($row_table->exchange_baht) . '</td>';
    $table_data_row.='<td>' . H($row_table->total_price_d) . '</td>';
    $table_data_row.='<td>' . H($row_table->total_price_r) . '</td>';
    $table_data_row.='<td>' . H($row_table->total_price_b) . '</td>';
    $table_data_row.='<td>' . H($row_table->discount) . '</td>';
    // $table_data_row.='<td>' . $created_at = $row_table->created_at != "0000-00-00 00:00:00" ? date(get_date_format(), strtotime($row_table->created_at)) : "" . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        $ch_edit = ($row_table->deleted == 0)? 'view/'.$row_table->delivery_id.'/2' : '';
    	if ($add_update) {
        	$table_data_row.=anchor($controller_name . "/$ch_edit", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-delivery green', 'title' => lang('common_update')));
    	}
   	$table_data_row.=anchor($controller_name . "/print_item_delivery/$row_table->delivery_id/2", '<i class="ace-icon fa fa-print bigger-180"></i>', array('class' => 'update-delivery blue', 'title' => lang('common_view')));
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_print_delivery_table($delivery,$contorller){
    $CI =& get_instance();  
    $controller_name = strtolower(get_class($CI));
    $print ="";
    $print.="<tr>";
            $print.="<th><center>".lang('common_no')."</center></th>";
            $print.="<th><center>".lang('items_unique_id')."</center></th>";
            $print.="<th><center>".lang('items_name')."</center></th>";
            $print.="<th><center>".lang('items_name_kh')."</center></th>";
            $print.="<th><center>".lang('items_model')."</center></th>";
            $print.="<th><center>".lang('items_unit')."</center></th>";
            $print.="<th><center>".lang('delivery_amount')."</center></th>";
            $print.="<th><center>".lang('delivery_total_unit')."</center></th>";
            $print.="<th><center>".lang('delivery_total_dollar')."</center></th>";
            $print.="<th><center>".lang('delivery_total_reil')."</center></th>";
            $print.="<th><center>".lang('delivery_total_baht')."</center></th>";
    $print.="</tr>";

    if($delivery->num_rows() > 0 ){
        $n = 0;
        $sum_total_unit_price = '';
        $sum_total_unit_price_reil = '';
        $sum_total_unit_price_baht = '';
        foreach($delivery->result() as $p){
            $n++;
            $sum_total_unit_price += $p->delivery_total_dollar;
            $sum_total_unit_price_reil += $p->delivery_total_riel;
            $sum_total_unit_price_baht += $p->delivery_total_baht;
            $print .="<tr>";
                $print .="<td class='text_indent'>".$n."</td>";
                $print .="<td class='center'>".$p->item_unique_id."</td>";
                $print .="<td class='center'>".$p->item_name."</td>";
                $print .="<td class='center'>".$p->item_name_kh."</td>";                
                $print .="<td class='center'>".$p->model."</td>";
                $print .="<td class='center'>".$p->unit_name."</td>";
                $print .="<td class='center'>".$p->delivery_quantity."</td>";
                $print .="<td class='center'>".$p->delivery_all_qty."</td>";
                $print .="<td class='right'>".$p->delivery_total_dollar."</td>";
                $print .="<td class='right'>".$p->delivery_total_riel."</td>";
                $print .="<td class='right'>".$p->delivery_total_baht."</td>";
            $print .="</tr>";
        }
        
        $print .="<tr>";
            $print .="<td colspan='8'><center><b>Total:</b></center></td>";
                $print .="<td class='right'><b>".$sum_total_unit_price."</b></td>";
                $print .="<td class='right'><b>".$sum_total_unit_price_reil."</b></td>";
                $print .="<td class='right'><b>".$sum_total_unit_price_baht."</b></td>";
        $print .="</tr>";
    }else{
        $print .="<tr>";
            $print .="<td><center><b>No Items found.</b></center></td>";
        $print .="</tr>";
    }
    return $print;

}






?>