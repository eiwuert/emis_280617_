<?php

/*
  Gets the html table to manage people.
*/

function get_people_manage_table($people, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';

    $headers = array('<input type="checkbox" id="select_all" />',
        lang($controller_name.'_id'),
        lang('common_name_in_eng'),
        lang('common_name_in_kh'),
        lang('common_email'),
        lang('common_phone_number'),
        lang('common_degree'),
        lang('common_started_date'),
        lang('common_created_at'),
        lang('common_view'),
        lang('common_action'),
    );

    $table.='<thead><tr>';
	if($controller_name == 'templates'){
	$count = 0;
    foreach ($headers as $header) {
        $count++;

        if ($count == 1) {
            $table.="<th class=''>$header</th>";
        } elseif ($count == count($headers)) {
            $table.="<th style='text-align: center' class='rightmost'>$header</th>";
        } else {
            $table.="<th>.$header</th>";
        }
    }
	}else{
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
	}
    
    $table.='</tr></thead><tbody>';
    $table.=get_people_manage_table_data_rows($people, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_people_manage_table_data_rows($people, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($people->result() as $person) {
        $table_data_rows.=get_person_data_row($person, $controller);
    }

    if ($people->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='12'><span class='col-md-12 text-center text-warning' >" . lang('common_no_persons_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_person_data_row($person, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $avatar_url = $person->image_id ? site_url('app_files/view/' . $person->image_id) : false;
    $joined_date = $person->joined_date != "" ? date('d-m-Y', strtotime($person->joined_date)) : "";
    
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='person_$person->person_id' value='" . $person->person_id . "'/></td>";
    $table_data_row.='<td>' . $person->emp_unique_id . '</td>';
    $table_data_row.='<td>' . H($person->last_name.' '.$person->first_name) . '</td>';
    $table_data_row.='<td>' . H($person->last_name_kh.' '.$person->first_name_kh) . '</td>';
    $table_data_row.='<td>' . mailto(H($person->email), H($person->email), array('class' => 'underline')) . '</td>';
    $table_data_row.='<td>' . H($person->phone_number) . '</td>';
    $table_data_row.='<td>' . H($person->level_name) . '</td>';
    $table_data_row.='<td>' . $joined_date . '</td>';
    $table_data_row.='<td>' . $created_at = $person->created_at != "0000-00-00 00:00:00" ? date(get_date_format(), strtotime($person->created_at)) : "" . '</td>';
   
    if ($controller_name == 'customers' && $CI->config->item('customers_store_accounts')) {
        $table_data_row.='<td width="15%">' . to_currency($person->balance) . '</td>';
        $table_data_row.='<td width="5%">' . anchor($controller_name . "/pay_now/$person->person_id", lang('customers_pay'), array('title' => lang('customers_pay'))) . '</td>';
    }

    $edit_action = '';
    if ($CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id)) {
        if ($controller_name == 'employees') {
            $edit_action = anchor($controller_name . "/detail/$person->person_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', 'class="green"');
        } else {
            $edit_action = anchor($controller_name . "/view/$person->person_id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', 'class="green"');
        }
    }

    $table_data_row.='<td class="action-buttons"><a href='.site_url("$controller_name/view_file/$person->person_id").'><i class="ace-icon fa fa-file bigger-150"></i></a></td>';
    $table_data_row.='<td class="action-buttons">' . $edit_action . '</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}




function get_docs_manage_table($q_docs, $controller, $load_fun) {

    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array('<input type="checkbox" id="select_all" />',        
        lang($controller_name.'_docs_name'),
        lang($controller_name.'_submit_at'),
        lang('common_action'),
    );

    $table.='<thead><tr>';
    if($controller_name == 'templates'){
    $count = 0;
    foreach ($headers as $header) {
        $count++;

        if ($count == 1) {
            $table.="<th class=''>$header</th>";
        } elseif ($count == count($headers)) {
            $table.="<th style='text-align: center' class='rightmost'>$header</th>";
        } else {
            $table.="<th>.$header</th>";
        }
    }
    }else{
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
    }
    
    $table.='</tr></thead><tbody>';
    $table.=get_docs_manage_table_data_rows($q_docs, $controller, $load_fun);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the people.
 */

function get_docs_manage_table_data_rows($q_docs, $controller,$load_fun) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($q_docs->result() as $docs) {
        $table_data_rows.=get_docs_data_row($docs, $controller,$load_fun);
    }

    if ($q_docs->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='12'><span class='col-md-12 text-center text-warning' >" . lang('common_no_persons_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_docs_data_row($docs, $controller, $load_fun) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));    
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='docs_$docs->emp_docs_id' value='" . $docs->emp_docs_id . "'/></td>";
    $table_data_row.='<td>' . $docs->emp_docs_path . '</td>';
    $table_data_row.='<td>' . date(get_date_format(), strtotime($docs->emp_docs_submited_at)). '</td>';
   
    if ($controller_name == 'customers' && $CI->config->item('customers_store_accounts')) {
        $table_data_row.='<td width="15%">' . to_currency($docs->balance) . '</td>';
        $table_data_row.='<td width="5%">' . anchor($controller_name . "/pay_now/$docs->person_id", lang('customers_pay'), array('title' => lang('customers_pay'))) . '</td>';
    }

    $table_data_row.='<td class="action-buttons"><a href="'.base_url("assets/$load_fun/$docs->emp_docs_path").'" download="'.base_url("assets/$load_fun/$docs->emp_docs_path").'"><i class="ace-icon fa fa-download bigger-150"></i></a>';
    $table_data_row.='</tr>';

    return $table_data_row;
}


















































// suplier table management
function get_supplier_manage_table($suppliers, $controller) {
    $CI = & get_instance();
    $table = '<table class="tablesorter table table-bordered table-striped table-hover" id="sortable_table">';
    $headers = array('<input type="checkbox" id="select_all" />',
                lang('suppliers_company_name'),
                lang('common_last_name'),
                lang('common_first_name'),
                lang('common_email'),
                lang('common_phone_number'),
                lang('common_action'));
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
    $table.=get_supplier_manage_table_data_rows($suppliers, $controller);
    $table.='</tbody></table>';
    return $table;
}
function get_supplier_manage_table_data_rows($suppliers, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($suppliers->result() as $supplier) {
        $table_data_rows.=get_supplier_data_row($supplier, $controller);
    }

    if ($suppliers->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='8'><span class='col-md-12 text-center text-warning' >" . lang('common_no_persons_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_supplier_data_row($supplier, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
    $table_data_row.="<td ><input type='checkbox' id='id_$supplier->id' value='" . $supplier->id . "'/></td>";
    $table_data_row.='<td >' . H($supplier->company_name) . '</td>';
    $table_data_row.='<td >' . H($supplier->last_name) . '</td>';
    $table_data_row.='<td >' . H($supplier->first_name) . '</td>';
    $table_data_row.='<td >' . mailto(H($supplier->email), H($supplier->email)) . '</td>';
    $table_data_row.='<td >' . H($supplier->phone_number) . '</td>';
    $table_data_row.='<td class="rightmost">' . anchor($controller_name . "/view/$supplier->id/2", lang('common_edit')) . '</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}
// workshop table management
function get_workshop_manage_table($workshop, $controller) {
    $CI = & get_instance();
    $table = '<table class="tablesorter table table-bordered table-striped table-hover" id="sortable_table">';
    $headers = array('<input type="checkbox" id="select_all" />',
                lang('common_title'),
                lang('workshop_venue'),
                lang('common_date_from'),
                lang('common_date_to'),
                lang('workshop_orgainized'),
                lang('common_female'),
                lang('common_total'),
                lang('common_action'));
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
    $table.=get_workshop_manage_table_data_rows($workshop, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_workshop_manage_table_data_rows($workshop, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';
    foreach ($workshop->result() as $val) {
        $table_data_rows.=get_workshop_data_row($val, $controller);
    }
    if ($workshop->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('common_no_persons_to_display') . "</span></td></tr>";
    }
    return $table_data_rows;
}
function get_workshop_data_row($val, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
        $table_data_row.="<td><input type='checkbox' id='id_$val->id' value='" . $val->id . "'/></td>";
        $table_data_row.='<td>' . $val->workshop_title . '</td>';
        $table_data_row.='<td>' . $val->workshop_venue . '</td>';
        $table_data_row.='<td>' . $val->workshop_date_from . '</td>';
        $table_data_row.='<td>' . $val->workshop_date_to. '</td>';
        $table_data_row.='<td>' . $val->workshop_orgainized . '</td>';
        $table_data_row.='<td>' . $val->workshop_female_participants . '</td>';
        $table_data_row.='<td>' . $val->workshop_total . '</td>';
        $table_data_row.='<td class="rightmost">' . anchor($controller_name . "/view/$val->id/2", lang('common_edit')) . '</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}
// Short courses table management
function get_short_courses_manage_table($short_courses, $controller) {
    $CI = & get_instance();
    $table = '<table class="tablesorter table table-bordered table-striped table-hover" id="sortable_table">';
    $headers = array('<input type="checkbox" id="select_all" />',
                lang('common_title'),
                lang('courses_venue'),
                lang('common_date_from'),
                lang('common_date_to'),
                lang('courses_orgainized'),
                lang('common_male'),
                lang('common_female'),
                lang('common_action'));
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
    $table.=get_short_courses_manage_table_data_rows($short_courses, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_short_courses_manage_table_data_rows($short_courses, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';
    foreach ($short_courses->result() as $val) {
        $table_data_rows.=get_short_courses_data_row($val, $controller);
    }
    if ($short_courses->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('common_no_persons_to_display') . "</span></td></tr>";
    }
    return $table_data_rows;
}
function get_short_courses_data_row($val, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table_data_row = '<tr>';
        $table_data_row.="<td><input type='checkbox' id='id_$val->id' value='" . $val->id . "'/></td>";
        $table_data_row.='<td>' . $val->courses_title . '</td>';
        $table_data_row.='<td>' . $val->courses_venue . '</td>';
        $table_data_row.='<td>' . $val->courses_date_from . '</td>';
        $table_data_row.='<td>' . $val->courses_date_to. '</td>';
        $table_data_row.='<td>' . $val->courses_orgainized . '</td>';
        $table_data_row.='<td>' . $val->courses_male_participants . '</td>';
        $table_data_row.='<td>' . $val->courses_female_participants . '</td>';
        $table_data_row.='<td class="rightmost">' . anchor($controller_name . "/view/$val->id/2", lang('common_edit')) . '</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}
// location manage table
function get_locations_manage_table($locations, $controller) {
    $CI = & get_instance();
    $table = '<table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">';

    $headers = array('<input type="checkbox" id="select_all" />',
        $CI->lang->line('locations_location_id'),
        $CI->lang->line('locations_name'),
        $CI->lang->line('locations_address'),
        $CI->lang->line('locations_phone'),
        $CI->lang->line('locations_email'),
        '&nbsp;'
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
    $table.=get_locations_manage_table_data_rows($locations, $controller);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the items.
 */

function get_locations_manage_table_data_rows($locations, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($locations->result() as $location) {
        $table_data_rows.=get_location_data_row($location, $controller);
    }

    if ($locations->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='11'><span class='col-md-12 text-center text-warning' >" . lang('locations_no_locations_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_location_data_row($location, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table_data_row = '<tr>';
    $table_data_row.="<td width='3%'><input type='checkbox' id='location_$location->location_id' value='" . $location->location_id . "'/></td>";
    $table_data_row.='<td width="10%">' . $location->location_id . '</td>';
    $table_data_row.='<td width="15%">' . H($location->name) . '</td>';
    $table_data_row.='<td width="15%">' . H($location->address) . '</td>';
    $table_data_row.='<td width="11%">' . H($location->phone) . '</td>';
    $table_data_row.='<td width="11%">' . H($location->email) . '</td>';
    $table_data_row.='<td width="4%" class="rightmost">' . anchor($controller_name . "/view/$location->location_id/2	", lang('common_edit'), array('class' => '', 'title' => lang($controller_name . '_update'))) . '</td>';

    $table_data_row.='</tr>';
    return $table_data_row;
}

/*
  Gets the html table to manage giftcards.
 */

function get_giftcards_manage_table($giftcards, $controller) {
    $CI = & get_instance();

    $table = '<table class="tablesorter table table-bordered table-striped table-hover" id="sortable_table">';

    $headers = array('<input type="checkbox" id="select_all" />',
        lang('giftcards_giftcard_number'),
        lang('giftcards_card_value'),
        lang('giftcards_customer_name'),
        '&nbsp',
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
    $table.=get_giftcards_manage_table_data_rows($giftcards, $controller);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the giftcard.
 */

function get_giftcards_manage_table_data_rows($giftcards, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($giftcards->result() as $giftcard) {
        $table_data_rows.=get_giftcard_data_row($giftcard, $controller);
    }

    if ($giftcards->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='11'><span class='col-md-12 text-center text-warning' >" . lang('giftcards_no_giftcards_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_giftcard_data_row($giftcard, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $link = site_url('reports/detailed_' . $controller_name . '/' . $giftcard->customer_id . '/0');
    $cust_info = $CI->Customer->get_info($giftcard->customer_id);

    $table_data_row = '<tr>';
    $table_data_row.="<td width='3%'><input type='checkbox' id='giftcard_$giftcard->giftcard_id' value='" . $giftcard->giftcard_id . "'/></td>";
    $table_data_row.='<td width="20%">' . H($giftcard->giftcard_number) . '</td>';
    $table_data_row.='<td width="25%">' . to_currency(H($giftcard->value), 10) . '</td>';
    $table_data_row.='<td width="20%"><a class="underline" href="' . $link . '">' . H($cust_info->first_name) . ' ' . H($cust_info->last_name) . '</a></td>';
    $table_data_row.='<td width="5%" class="rightmost">' . anchor($controller_name . "/view/$giftcard->giftcard_id/2	", lang('common_edit'), array('class' => '', 'title' => lang($controller_name . '_update'))) . '</td>';

    $table_data_row.='</tr>';
    return $table_data_row;
}

/*
  Gets the html table to manage item kits.
 */

function get_item_kits_manage_table($item_kits, $controller) {
    $CI = & get_instance();

    $table = '<table class="tablesorter table table-bordered table-striped table-hover" id="sortable_table">';

    $has_cost_price_permission = $CI->Employee->has_module_action_permission('item_kits', 'see_cost_price', $CI->Employee->get_logged_in_employee_info()->person_id);

    if ($has_cost_price_permission) {
        $headers = array('<input type="checkbox" id="select_all" />',
            lang('items_item_number'),
            lang('item_kits_name'),
            lang('item_kits_description'),
            lang('items_cost_price'),
            lang('items_unit_price'),
            '&nbsp',
        );
    } else {
        $headers = array('<input type="checkbox" id="select_all" />',
            lang('items_item_number'),
            lang('item_kits_name'),
            lang('item_kits_description'),
            lang('items_unit_price'),
            '&nbsp',
        );
    }
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
    $table.=get_item_kits_manage_table_data_rows($item_kits, $controller);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the item kits.
 */

function get_item_kits_manage_table_data_rows($item_kits, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($item_kits->result() as $item_kit) {
        $table_data_rows.=get_item_kit_data_row($item_kit, $controller);
    }

    if ($item_kits->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='11'><span class='col-md-12 text-center text-warning' >" . lang('item_kits_no_item_kits_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_item_kit_data_row($item_kit, $controller) {

    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $has_cost_price_permission = $CI->Employee->has_module_action_permission('item_kits', 'see_cost_price', $CI->Employee->get_logged_in_employee_info()->person_id);

    $table_data_row = '<tr>';
    $table_data_row.="<td width='3%'><input type='checkbox' id='item_kit_$item_kit->item_kit_id' value='" . $item_kit->item_kit_id . "'/></td>";
    $table_data_row.='<td width="15%">' . H($item_kit->item_kit_number) . '</td>';
    $table_data_row.='<td width="15%">' . H($item_kit->name) . '</td>';
    $table_data_row.='<td width="20%">' . H($item_kit->description) . '</td>';
    if ($has_cost_price_permission) {
        $table_data_row.='<td width="20%" align="right">' . (!is_null($item_kit->cost_price) ? to_currency(($item_kit->location_cost_price ? $item_kit->location_cost_price : $item_kit->cost_price), 10) : '') . '</td>';
    }

    $table_data_row.='<td width="20%" align="right">' . (!is_null($item_kit->unit_price) ? to_currency(($item_kit->location_unit_price ? $item_kit->location_unit_price : $item_kit->unit_price), 10) : '') . '</td>';
    $table_data_row.='<td width="5%" class="rightmost">' . anchor($controller_name . "/view/$item_kit->item_kit_id/2	", lang('common_edit'), array('class' => '', 'title' => lang($controller_name . '_update'))) . '</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}

function get_view_popup_transfer($transfer, $controller, $type, $person_info){
    
    $tbl_row = '<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>'.(($type == 'university')? lang('students_university') : lang('students_skill') ).'</th>
                        <th>'.(($type == 'university')? lang('students_university').lang('common_kh') : lang('students_skill').lang('common_kh') ).'</th>
                        <th>'.lang('students_changed_date').'</th>
                        <th>'.lang('common_remark').'</th>
                        <th>'.lang('common_edit').'</th>
                    </tr>
                </thead>
                <tbody class="open">';
                    foreach ($transfer as $row) {
             $tbl_row.= '<tr>
                            <td>'.H((($type == 'university')? $row->university_name : $row->skill_name )).'</td>
                            <td>'.H((($type == 'university')? $row->university_name_kh : $row->skill_name_kh )).'</td>
                            <td>'.date(get_date_format(), strtotime($row->changed_date)).'</td>
                            <td>'.$row->remark.'</td>
                            <td>';
                                $stu_info_id = $person_info->stu_info_id;
                                $stu_transfer_id = $row->stu_transfer_id;
                    $tbl_row.= '<a data-transfer-id="'.$row->stu_transfer_id.'" 
                                    data-transfer-type="'.$row->transfer_type.'" 
                                    data-transfer-university-id="'.$row->university_id.'"  
                                    data-transfer-major-id="'.$row->skill_id.'" 
                                    data-transfer-date="'.$row->changed_date.'" 
                                    data-transfer-remark="'.$row->remark.'"                                                
                                    data-toggle="modal" data-target="#transferStudent"
                                    class="btn-sm btn btn-primary text-warning update_row_transfer" 
                                    href="#" data-href="'.site_url("$controller_name/transfer/$stu_info_id/$stu_transfer_id").'"><i class="fa fa-pencil-square-o"></i>'.lang('common_edit').'</a>
                                <a class="btn btn-danger btn-sm del-transfer" href="javascript:void(0)" data-confirm="'.lang("students_confirm_delete_transfer").'" data-method="post" data-item="'.$row->stu_transfer_id.'"><i class="fa fa-trash-o"></i> '.lang('common_delete').'</a>
                            </td>
                        </tr>';                    
                    }
    $tbl_row.= '</tbody>
            </table>';
    return $tbl_row;
}

?>