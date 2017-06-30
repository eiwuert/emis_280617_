<?php
//Some reports need time information others do not. So this allows us to reuse this function. The $time parameter should be passed from the corresponding
//date_input_excel_whatever_specific_blabla that calls the private function: _get_common_report_data, that in turn, calls this helper function.
function get_simple_date_ranges($time=false)
{
		$CI =& get_instance();
		// $CI->load->language('reports');

		if(!$time)
		{
			$today =  date('Y-m-d');
			$yesterday = date('Y-m-d', mktime(0,0,0,date("m"),date("d")-1,date("Y")));
			$six_days_ago = date('Y-m-d', mktime(0,0,0,date("m"),date("d")-6,date("Y")));
			$start_of_this_month = date('Y-m-d', mktime(0,0,0,date("m"),1,date("Y")));
			$end_of_this_month = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
			$start_of_last_month = date('Y-m-d', mktime(0,0,0,date("m")-1,1,date("Y")));
			$end_of_last_month = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime((date('m') - 1).'/01/'.date('Y').' 00:00:00'))));
			
			$start_of_jan_mar_quarterly = date('Y-m-d', mktime(0,0,0,1,1,date("Y")));
			$end_of_jan_mar_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('03/01/'.date('Y').' 00:00:00'))));
			$start_of_apr_jun_quarterly = date('Y-m-d', mktime(0,0,0,4,1,date("Y")));
			$end_of_apr_jun_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('06/01/'.date('Y').' 00:00:00'))));
			$start_of_jul_sep_quarterly = date('Y-m-d', mktime(0,0,0,7,1,date("Y")));
			$end_of_jul_sep_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('09/01/'.date('Y').' 00:00:00'))));
			$start_of_oct_dec_quarterly = date('Y-m-d', mktime(0,0,0,10,1,date("Y")));
			$end_of_oct_dec_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('12/01/'.date('Y').' 00:00:00'))));
			$start_of_jan_jun_half_yearly = date('Y-m-d', mktime(0,0,0,1,1,date("Y")));
			$end_of_jan_jun_half_yearly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('06/01/'.date('Y').' 00:00:00'))));
			$start_of_jul_dec_half_yearly = date('Y-m-d', mktime(0,0,0,7,1,date("Y")));
			$end_of_jul_dec_half_yearly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('12/01/'.date('Y').' 00:00:00'))));

			$start_of_this_year =  date('Y-m-d', mktime(0,0,0,1,1,date("Y")));
			$end_of_this_year =  date('Y-m-d', mktime(0,0,0,12,31,date("Y")));
			$start_of_last_year =  date('Y-m-d', mktime(0,0,0,1,1,date("Y")-1));
			$end_of_last_year =  date('Y-m-d', mktime(0,0,0,12,31,date("Y")-1));
			$start_of_time =  date('Y-m-d', 0);

			return array(
				$today. '/' . $today 								=> lang('reports_today'),
				$yesterday. '/' . $yesterday						=> lang('reports_yesterday'),
				$six_days_ago. '/' . $today 						=> lang('reports_last_7'),
				$start_of_this_month . '/' . $end_of_this_month		=> lang('reports_this_month'),
				$start_of_last_month . '/' . $end_of_last_month		=> lang('reports_last_month'),
				$start_of_jan_mar_quarterly . '/' . $end_of_jan_mar_quarterly		=> lang('reports_quarterly_jan_mar'),
				$start_of_apr_jun_quarterly . '/' . $end_of_apr_jun_quarterly		=> lang('reports_quarterly_apr_jun'),
				$start_of_jul_sep_quarterly . '/' . $end_of_jul_sep_quarterly		=> lang('reports_quarterly_jul_sep'),
				$start_of_oct_dec_quarterly . '/' . $end_of_oct_dec_quarterly		=> lang('reports_quarterly_oct_dec'),
				$start_of_jan_jun_half_yearly . '/' . $end_of_jan_jun_half_yearly		=> lang('reports_half_yealy_jan_jun'),
				$start_of_jul_dec_half_yearly . '/' . $end_of_jul_dec_half_yearly		=> lang('reports_half_yealy_jul_dec'),
				$start_of_this_year . '/' . $end_of_this_year	 	=> lang('reports_this_year'),
				$start_of_last_year . '/' . $end_of_last_year		=> lang('reports_last_year'),
				$start_of_time . '/' . 	$today						=> lang('reports_all_time'),
			);
		}
		else
		{
			$today =  date('Y-m-d').' 00:00:00';
			$end_of_today=date('Y-m-d').' 23:59:59';
			$yesterday = date('Y-m-d', mktime(0,0,0,date("m"),date("d")-1,date("Y"))).' 00:00:00';
			$end_of_yesterday=date('Y-m-d', mktime(0,0,0,date("m"),date("d")-1,date("Y"))).' 23:59:59';
			$six_days_ago = date('Y-m-d', mktime(0,0,0,date("m"),date("d")-6,date("Y"))).' 00:00:00';
			$start_of_this_month = date('Y-m-d', mktime(0,0,0,date("m"),1,date("Y"))).' 00:00:00';
			$end_of_this_month = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00')))).' 23:59:59';
			$start_of_last_month = date('Y-m-d', mktime(0,0,0,date("m")-1,1,date("Y"))).' 00:00:00';
			$end_of_last_month = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime((date('m') - 1).'/01/'.date('Y').' 00:00:00')))).' 23:59:59';

			$start_of_jan_mar_quarterly = date('Y-m-d', mktime(0,0,0,1,1,date("Y"))).' 00:00:00';
			$end_of_jan_mar_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('03/01/'.date('Y').' 00:00:00')))).' 23:59:59';
			$start_of_apr_jun_quarterly = date('Y-m-d', mktime(0,0,0,4,1,date("Y"))).' 00:00:00';
			$end_of_apr_jun_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('06/01/'.date('Y').' 00:00:00')))).' 23:59:59';
			$start_of_jul_sep_quarterly = date('Y-m-d', mktime(0,0,0,7,1,date("Y"))).' 00:00:00';
			$end_of_jul_sep_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('09/01/'.date('Y').' 00:00:00')))).' 23:59:59';
			$start_of_oct_dec_quarterly = date('Y-m-d', mktime(0,0,0,10,1,date("Y"))).' 00:00:00';
			$end_of_oct_dec_quarterly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('12/01/'.date('Y').' 00:00:00')))).' 23:59:59';
			$start_of_jan_jun_half_yearly = date('Y-m-d', mktime(0,0,0,1,1,date("Y"))).' 00:00:00';
			$end_of_jan_jun_half_yearly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('06/01/'.date('Y').' 00:00:00')))).' 23:59:59';
			$start_of_jul_dec_half_yearly = date('Y-m-d', mktime(0,0,0,7,1,date("Y"))).' 00:00:00';
			$end_of_jul_dec_half_yearly = date('Y-m-d',strtotime('-1 second',strtotime('+1 month',strtotime('12/01/'.date('Y').' 00:00:00')))).' 23:59:59';

			$start_of_this_year =  date('Y-m-d', mktime(0,0,0,1,1,date("Y"))).' 00:00:00';
			$end_of_this_year =  date('Y-m-d', mktime(0,0,0,12,31,date("Y"))).' 23:59:59';
			$start_of_last_year =  date('Y-m-d', mktime(0,0,0,1,1,date("Y")-1)).' 00:00:00';
			$end_of_last_year =  date('Y-m-d', mktime(0,0,0,12,31,date("Y")-1)).' 23:59:59';
			$start_of_time =  date('Y-m-d', 0);

			return array(
				$today. '/' . $end_of_today 								=> lang('reports_today'),
				$yesterday. '/' . $end_of_yesterday						=> lang('reports_yesterday'),
				$six_days_ago. '/' . $end_of_today  						=> lang('reports_last_7'),
				$start_of_this_month . '/' . $end_of_this_month		=> lang('reports_this_month'),
				$start_of_last_month . '/' . $end_of_last_month		=> lang('reports_last_month'),
				$start_of_jan_mar_quarterly . '/' . $end_of_jan_mar_quarterly		=> lang('reports_quarterly_jan_mar'),
				$start_of_apr_jun_quarterly . '/' . $end_of_apr_jun_quarterly		=> lang('reports_quarterly_apr_jun'),
				$start_of_jul_sep_quarterly . '/' . $end_of_jul_sep_quarterly		=> lang('reports_quarterly_jul_sep'),
				$start_of_oct_dec_quarterly . '/' . $end_of_oct_dec_quarterly		=> lang('reports_quarterly_oct_dec'),
				$start_of_jan_jun_half_yearly . '/' . $end_of_jan_jun_half_yearly		=> lang('reports_half_yealy_jan_jun'),
				$start_of_jul_dec_half_yearly . '/' . $end_of_jul_dec_half_yearly		=> lang('reports_half_yealy_jul_dec'),
				$start_of_this_year . '/' . $end_of_this_year	 	=> lang('reports_this_year'),
				$start_of_last_year . '/' . $end_of_last_year		=> lang('reports_last_year'),
				$start_of_time . '/' . 	$end_of_today						=> lang('reports_all_time'),
			);
		}
}

function get_months()
{
	$months = array();
	for($k=1;$k<=12;$k++)
	{
		$cur_month = mktime(0, 0, 0, $k, 1, 2000);
		$months[date("m", $cur_month)] = get_month_translation(date("m", $cur_month));
	}

	return $months;
}

function get_month_translation($month_numeric)
{
	return lang('reports_month_'.$month_numeric);
}

function get_days()
{
	$days = array();

	for($k=1;$k<=31;$k++)
	{
		$cur_day = mktime(0, 0, 0, 1, $k, 2000);
		$days[date('d',$cur_day)] = date('j',$cur_day);
	}

	return $days;
}

function get_years()
{
	$years = array();
	for($k=0;$k<10;$k++)
	{
		$years[date("Y")-$k] = date("Y")-$k;
	}

	return $years;
}

function get_hours($time_format)
    {
       $hours = array();
	   if($time_format == '24_hour')
	   {
       for($k=0;$k<24;$k++)
		{
          $hours[$k] = $k;
		}
	   }
	   else 
	   {
		for($k=0;$k<24;$k++)
		{
		
          $hours[$k]  = date('h a', mktime($k));
		
		}
		
		
	   }
       return $hours;
    }


    function get_minutes()
    {
       $hours = array();
       for($k=0;$k<60;$k++)
       {
          $minutes[$k] = $k;
       }
       return $minutes;
    }


function get_random_colors($how_many)
{
	$colors = array();

	for($k=0;$k<$how_many;$k++)
	{
		$colors[] = '#'.random_color();
	}

	return $colors;
}

function random_color()
{
    mt_srand((double)microtime()*1000000);
    $c = '';
    while(strlen($c)<6){
        $c .= sprintf("%02X", mt_rand(0, 255));
    }
    return $c;
}

function get_template_colors()
{
	return array('#1c2b33', '#0e6638', '#bfa51b', '#d9561b', '#b2182d', '#ff0000', '#0000ff');
}

// REPORT
function get_items_report_manage_table($items, $controller) {
    $CI = & get_instance();
    // $has_cost_price_permission = $CI->Employee->has_module_action_permission('items', 'see_cost_price', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table = '<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">';

    $headers = array('<input type="checkbox" id="select_all" />',
        $CI->lang->line('items_unique_id'),
        $CI->lang->line('items_name'),
        $CI->lang->line('items_name_kh'),
        $CI->lang->line('items_category'),
        $CI->lang->line('items_model'),
        $CI->lang->line('items_unit'),        
        $CI->lang->line('items_current_stock'),        
        $CI->lang->line('items_discount'),        
        $CI->lang->line('items_dollar'),
        $CI->lang->line('items_reil'),
        $CI->lang->line('items_baht'),
        $CI->lang->line('items_baht'),
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
    $table.=get_items_report_manage_table_data_rows($items, $controller);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the items.
 */

function get_items_report_manage_table_data_rows($items, $controller) {
    $CI = & get_instance();
    $CI->load->model('Item_products');
    $table_data_rows = '';
    $total_item_qty = '';
    foreach ($items->result() as $item) {
    	$item_id = $item->item_id;
    	$get_item_byid = $CI->Item_products->sum_item_storage_byid($item_id)->row();
    	$get_average_cost = $CI->Item_products->get_average_cost($item_id)->row();
		$average_cost = round(floatval($get_average_cost->item_total_d / $get_average_cost->item_all_qty),3);  
    	$sum_itmes = array("total_qty" => $get_item_byid->total_qty,
    						"total_d" => $get_item_byid->total_d,
							"total_r" => $get_item_byid->total_r,
    						"total_b" => $get_item_byid->total_b,
    						"average_cost" => $average_cost);
        $table_data_rows.=get_item_report_data_row($item, $controller, $sum_itmes);
    }

    if ($items->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='17'><span class='col-md-12 text-center text-warning' >" . lang('items_no_items_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_item_report_data_row($item, $controller, $sum_itmes) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
	// to_currency_no_money($item->unit_price_baht, 10) 
    $table_data_row = '<tr>';    
    $table_data_row.="<td width='3%'><input type='checkbox' id='item_$item->item_id' value='" . $item->item_id . "'/></td>";
    $table_data_row.='<td width="13%">' . H($item->item_unique_id) . '</td>';
    $table_data_row.='<td width="13%">' . H($item->item_name) . '</td>';
    $table_data_row.='<td width="9%">' . H($item->item_name_kh) . '</td>';
    $table_data_row.='<td width="9%">' . H($item->name) . '</td>';
    $table_data_row.='<td width="12%">' . $item->model. '</td>';
    $table_data_row.='<td width="9%">' . $item->unit . '</td>';
    $table_data_row.='<td width="9%" align="right">' . to_quantity($sum_itmes['total_qty']) . '</td>';
    $table_data_row.='<td width="9%" align="right">discount</td>';
    $table_data_row.='<td width="9%">' . to_currency_no_money($sum_itmes['total_d'], 10) . '</td>';
    $table_data_row.='<td width="12%">' . to_currency_no_money($sum_itmes['total_r'], 10) . '</td>';
    $table_data_row.='<td width="12%">' . to_currency_no_money($sum_itmes['total_b'], 10) . '</td>';
    $table_data_row.='<td width="12%">' . to_currency_no_money($sum_itmes['average_cost'], 10) . '</td>';
    $table_data_row.='<td width="4%" class="rightmost">' . anchor($controller_name . "/view/$item->item_id/2", lang('common_view'), array('class' => '', 'title' => lang($controller_name . '_update'))) . '</td>';

    $table_data_row.='</tr>';
    return $table_data_row;
}


function manageItemReport($report, $controller){
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>Unique ID</th>
                    <th>Item Name</th>
                    <th>Item Name_kh</th>
                    <th>Item model</th>
                    <th>PO</th>
                    <th>Dilivery</th>
                    <th>Current</th>
                </tr>
            </thead>
            <tbody>';
            foreach($report as $key=>$val){
            $tb.='<tr>
                    <td>'.$val['item_unique'].'</td>
                    <td>'.$val['item_name'].'</td>
                    <td>'.$val['item_name_kh'].'</td>
                    <td>'.$val['item_model'].'</td>
                    <td>'.$val['item_po'].'</td>
                    <td>'.$val['item_delivery'].'</td>
                    <td>'.$val['item_current'].'</td>
                </tr>'; 
            } 
        $tb.='</tbody>
        </table>';

    return $tb;
}

function manageItemReport_income($report, $controller){   
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Unique ID</th>
                    <th>Item Name</th>
                    <th>Item Name_kh</th>
                    <th>Total Dollar</th>
                    <th>Total Riel</th>
                    <th>Total Baht</th>
                    <th>Discount</th>
                    <th>Set Discount</th>
                </tr>
            </thead>
            <tbody>';
            foreach($report as $key=>$val){
                $exchange_r = $val['item_exchange_riel'];
                $exchange_b = $val['item_exchange_baht'];
                $discount = $val['item_discount'];
                $dollar = ($val['item_totalDollar'] - $discount);
                $riel = ($val['item_totalRiel'] - ($discount * $exchange_r));
                $baht = ($val['item_totalBaht'] - ($discount * $exchange_b));

            $tb.='<tr>
                    <td>'.$val['item_date'].'</td>
                    <td>'.$val['item_unique'].'</td>
                    <td>'.$val['item_name'].'</td>
                    <td>'.H($val['item_name_kh']).'</td>
                    <td style="text-align:right">'.$dollar.'</td>
                    <td style="text-align:right">'.$riel.'</td>
                    <td style="text-align:right">'.$baht.'</td>
                    <td style="text-align:right">'.$discount.'</td>
                    <td style="text-align:right">% '.$val['item_set_discount'].'</td>
                </tr>'; 
            } 
        $tb.='</tbody>
        </table>';

    return $tb;
}

function manageItemReport_po($report, $controller){
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Unique ID</th>
                    <th>Item Name</th>
                    <th>Item Name_kh</th>
                    <th>Total Dollar</th>
                    <th>Total Riel</th>
                    <th>Total Baht</th>
                    <th>Discount</th>
                </tr>
            </thead>
            <tbody>';
            foreach($report as $key=>$val){
                $exchange_r = $val['item_exchange_riel'];
                $exchange_b = $val['item_exchange_baht'];
                $discount = $val['item_discount'];
                $dollar = ($val['item_totalDollar'] - $discount);
                $riel = ($val['item_totalRiel'] - ($discount * $exchange_r));
                $baht = ($val['item_totalBaht'] - ($discount * $exchange_b));
            $tb.='<tr>
                    <td>'.$val['item_date'].'</td>
                    <td>'.$val['item_unique'].'</td>
                    <td>'.$val['item_name'].'</td>
                    <td>'.H($val['item_name_kh']).'</td>
                    <td style="text-align:right">'.$dollar.'</td>
                    <td style="text-align:right">'.$riel.'</td>
                    <td style="text-align:right">'.$baht.'</td>
                    <td style="text-align:right">'.$discount.'</td>
                </tr>'; 
            } 
        $tb.='</tbody>
        </table>';

    return $tb;
}

// rep_emp
function rep_emp($report_emp, $controller){
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>'.lang('common_no').'</th>
                    <th>'.lang('common_last_name').'</th>
                    <th>'.lang('common_first_name').'</th>
                    <th>'.lang('common_last_name_kh').'</th>
                    <th>'.lang('common_first_name_kh').'</th>
                    <th>'.lang('common_gender').'</th>
                    <th>'.lang('common_dob').'</th>
                    <th>'.lang('common_joined_date').'</th>                  
                    <th>'.lang('common_expired_date').'</th>
                </tr>
            </thead>
            <tbody>'; 
            if($report_emp->num_rows() > 0){
                $i=0;
	            foreach($report_emp->result() as $row){
                    $i++;
		            $tb.='<tr>
                            <td>'.$i.'</td>
		                    <td>'.$row->last_name.'</td>
                            <td>'.$row->first_name.'</td>
                            <td>'.$row->last_name_kh.'</td>
                            <td>'.$row->first_name_kh.'</td>
		                    <td>'.$row->gender.'</td>
		                    <td>'.$row->dob.'</td>
                            <td>'.$row->joined_date.'</td>
		                    <td>'.$row->expired_date.'</td>
		               	</tr>'; 
	            }
	        }
        $tb.='</tbody>
        </table>';
    return $tb;
}


// rep_emp_summary
function rep_emp_summary($count_emp, $controller){  
    $tb = '';
    $tb.='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                        <th>'.lang('common_gender').'</th>';
                        foreach($count_emp as $val){
    $tb.='              <th>'.$val['month'].'</th>';
                        }
    $tb.='      </tr>
            </thead>
            <tbody>';
                $tb .= '<tr>';
                        $tb .= '<td>Male</td>';
                        foreach($count_emp as $val){
                        $tb .= '<td>'.$val['count_m_emp'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td>Female</td>';
                        foreach($count_emp as $val){
                        $tb .= '<td>'.$val['count_f_emp'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td><b>Total:</b></td>';
                        foreach($count_emp as $val){
                        $tb .= '<td><b>'.$val['total_emp'].'</b></td>';
                        }
                $tb .= '</tr>';

    $tb.='  </tbody>
        </table>';
    return $tb;
}
// rep_emp
function rep_prof($report_prof, $controller){
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>'.lang('common_no').'</th>
                    <th>'.lang('common_last_name').'</th>
                    <th>'.lang('common_first_name').'</th>
                    <th>'.lang('common_last_name_kh').'</th>
                    <th>'.lang('common_first_name_kh').'</th>
                    <th>'.lang('common_gender').'</th>
                    <th>'.lang('common_dob').'</th>
                    <th>'.lang('common_joined_date').'</th>                    
                    <th>'.lang('common_expired_date').'</th>
                </tr>
            </thead>
            <tbody>'; 
            if($report_prof->num_rows() > 0){
                $i=0;
                foreach($report_prof->result() as $row){
                    $i++;
                    $tb.='<tr>
                            <td>'.$i.'</td>
                            <td>'.$row->last_name.'</td>
                            <td>'.$row->first_name.'</td>
                            <td>'.$row->last_name_kh.'</td>
                            <td>'.$row->first_name_kh.'</td>
                            <td>'.$row->gender.'</td>
                            <td>'.$row->dob.'</td>
                            <td>'.$row->joined_date.'</td>
                            <td>'.$row->expired_date.'</td>
                        </tr>'; 
                }
            }
        $tb.='</tbody>
        </table>';
    return $tb;
}


// rep_emp_summary
function rep_prof_summary($count_prof, $controller){  
    $tb = '';
    $tb.='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                        <th>'.lang('common_gender').'</th>';
                        foreach($count_prof as $val){
    $tb.='              <th>'.$val['month'].'</th>';
                        }
    $tb.='      </tr>
            </thead>
            <tbody>';

                $tb .= '<tr>';
                        $tb .= '<td>Male</td>';
                        foreach($count_prof as $val){
                        $tb .= '<td>'.$val['count_m_prof'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td>Female</td>';
                        foreach($count_prof as $val){
                        $tb .= '<td>'.$val['count_f_prof'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td><b>Total:</b></td>';
                        foreach($count_prof as $val){
                        $tb .= '<td><b>'.$val['total_prof'].'</b></td>';
                        }
                $tb .= '</tr>';

    $tb.='  </tbody>
        </table>';
    return $tb;
}

// rep_student
function rep_student($query, $controller){
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>'.lang('common_name').'</th>
                    <th>'.lang('common_name_kh').'</th>
                    <th>'.lang('common_gender').'</th>
                    <th>'.lang('common_dob').'</th>
                    <th>'.lang('common_joined_date').'</th>
                    <th>'.lang('common_scholarship').'</th>
                </tr>
            </thead>
            <tbody>';
            if($query->num_rows() > 0){
                 foreach($query->result() as $row){
                     $tb.='<tr>
                             <td>'.$row->stu_last_name.' '.$row->stu_first_name.'</td>
                             <td>'.$row->stu_last_name_kh.' '.$row->stu_first_name_kh.'</td>
                             <td>'.$row->stu_gender.'</td>
                             <td>'.date_format(date_create($row->stu_dob),"d/m/Y").'</td>
                             <td>'.date_format(date_create($row->created_at),"d/m/Y").'</td>
                             <td>'.$row->scholarship_from.'</td>
                         </tr>'; 
                 }
             }
        $tb.='</tbody>
        </table>';

    return $tb;
}
// rep_student_summery
function rep_student_summery($query, $controller){  
    $tb = '';
    $tb.='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                        <th>'.lang('scholarship').'</th>';
                        foreach($query as $val){
    $tb.='              <th>'.$val['month'].'</th>';
                        }
    $tb.='      </tr>
            </thead>
            <tbody>';

                $tb .= '<tr>';
                        $tb .= '<td>Male</td>';
                        foreach($query as $val){
                        $tb .= '<td>'.$val['count_1'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td>Female</td>';
                        foreach($query as $val){
                        $tb .= '<td>'.$val['count_2'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td><b>Total:</b></td>';
                        foreach($query as $val){
                        $tb .= '<td><b>'.$val['total'].'</b></td>';
                        }
                $tb .= '</tr>';

    $tb.='  </tbody>
        </table>';
    return $tb;
}

// rep_pay_student
function rep_pay_student($query, $controller){
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>'.lang('common_name').'</th>
                    <th>'.lang('common_name_kh').'</th>
                    <th>'.lang('common_gender').'</th>
                    <th>'.lang('common_dob').'</th>
                    <th>'.lang('scholarship_scholarship_from').'</th>
                </tr>
            </thead>
            <tbody>';
            if($query->num_rows() > 0){
                 foreach($query->result() as $row){
                     $tb.='<tr>
                             <td>'.$row->stu_last_name.' '.$row->stu_first_name.'</td>
                             <td>'.$row->stu_last_name_kh.' '.$row->stu_first_name_kh.'</td>
                             <td>'.$row->stu_gender.'</td>
                             <td>'.date_format(date_create($row->stu_dob),"d/m/Y").'</td>
                             <td>'.$row->scholarship_from.'</td>
                         </tr>'; 
                 }
             }
        $tb.='</tbody>
        </table>';

    return $tb;
}

// rep_pay_student_summery
function rep_pay_student_summery($query, $controller){  
    $tb = '';
    $tb.='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                        <th>'.lang('scholarship').'</th>';
                        foreach($query as $val){
    $tb.='              <th>'.$val['month'].'</th>';
                        }
    $tb.='      </tr>
            </thead>
            <tbody>';

                $tb .= '<tr>';
                        $tb .= '<td>Self Paid</td>';
                        foreach($query as $val){
                        $tb .= '<td>'.$val['count_1'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td>Scholarship</td>';
                        foreach($query as $val){
                        $tb .= '<td>'.$val['count_2'].'</td>';
                        }
                $tb .= '</tr>';

                $tb .= '<tr>';
                        $tb .= '<td><b>Total:</b></td>';
                        foreach($query as $val){
                        $tb .= '<td><b>'.$val['total'].'</b></td>';
                        }
                $tb .= '</tr>';

    $tb.='  </tbody>
        </table>';
    return $tb;
}

// rep_student_score
function rep_student_score($query, $controller){
    $tb='<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
            <thead>
                <tr>
                    <th>'.lang('common_name').'</th>
                    <th>'.lang('common_name_kh').'</th>
                    <th>'.lang('common_gender').'</th>
                    <th>'.lang('common_dob').'</th>
                    <th>Attendance</th>
                    <th>Group Discustion</th>
                    <th>Quize</th>
                    <th>Assignment</th>
                    <th>Exam</th>
                    <th>Final</th>
                </tr>
            </thead>
            <tbody>';
            if($query->num_rows() > 0){
                 foreach($query->result() as $row){
                     $tb.='<tr>
                             <td>'.$row->stu_last_name.' '.$row->stu_first_name.'</td>
                             <td>'.$row->stu_last_name_kh.' '.$row->stu_first_name_kh.'</td>
                             <td>'.$row->stu_gender.'</td>
                             <td>'.date_format(date_create($row->stu_dob),"d/m/Y").'</td>
                             <td class="text-right">'.$row->attendance_score.'</td>
                             <td class="text-right">'.$row->midterm_group_discussion_score.'</td>
                             <td class="text-right">'.$row->midterm_quiz_score.'</td>
                             <td class="text-right">'.$row->midterm_assignment_score.'</td>
                             <td class="text-right">'.$row->midterm_exam_score.'</td>
                             <td class="text-right">'.$row->final_score.'</td>
                         </tr>'; 
                 }
             }
        $tb.='</tbody>
        </table>';

    return $tb;
}