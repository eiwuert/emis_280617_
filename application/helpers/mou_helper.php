<?php    
//get_mou
function get_mou_manage_table($mou, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table = '<table class="tablesorter table table-bordered table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('sign_date_mou'),
        lang('purpose_mou'),
        lang('orginazation_mou'),
        lang('valid_date_from_mou'),
        lang('valid_date_to_mou'),
        lang('response_by_mou'),
        lang('common_add'),
        lang('')
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
    $table.=get_mou_manage_table_data_rows($mou, $controller);
    $table.='</tbody></table>';
    return $table;
}
function get_mou_manage_table_data_rows($mou, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($mou->result() as $row_mou) {
        $table_data_rows.=get_mou_data_row($row_mou, $controller);
    }
    if ($mou->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('mou_no_mou_to_display') . "</span></tr>";
    }
    return $table_data_rows;
}
function get_mou_data_row($row_mou, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('mou', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('mou', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);

    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='mou_$row_mou->id' value='" . $row_mou->id . "'/></td>";
    $table_data_row.='<td>' . $sign_date = $row_mou->sign_date != "0000-00-00" ? date(get_date_format(), strtotime($row_mou->sign_date)) : "" . '</td>';
    $table_data_row.='<td>' . H($row_mou->purpose) . '</td>';
    $table_data_row.='<td >' . H($row_mou->orginazation). '</td>';
    $table_data_row.='<td >' . $valid_date_from = $row_mou->valid_date_from != "0000-00-00" ? date(get_date_format(), strtotime($row_mou->valid_date_from)) : "" . '</td>';
    $table_data_row.='<td >' . $valid_date_to = $row_mou->valid_date_to != "0000-00-00" ? date(get_date_format(), strtotime($row_mou->valid_date_to)) : "" . '</td>';
    $table_data_row.='<td >' . H($row_mou->user_type) . '</td>';
    $table_data_row.='<td>';
        $table_data_row.='<div class="action-buttons">';
            $table_data_row.=anchor($controller_name . "/add_file/$row_mou->id/2", '<i class="ace-icon fa fa-file bigger-180"></i>', array('class' => 'update-letter_out blue', 'title' => lang('common_update')));
        $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='<td>';
        $table_data_row.='<div class="action-buttons">';
            $table_data_row.=anchor($controller_name . "/print_ex/$row_mou->id/2", '<i class="ace-icon fa fa-print bigger-180"></i>', array('class' => 'update-mou green', 'title' => lang('common_update')));
            if ($add_update) {
                $table_data_row.=anchor($controller_name . "/view/$row_mou->id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-mou green', 'title' => lang('common_update')));
            }
        $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}     
