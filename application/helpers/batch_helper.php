<?php
function get_batch_manage_table($batch, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('batch_name'),
        lang('batch_start_date'),
        lang('batch_end_date'),
        lang('batch_number'),
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

    $table.=get_batch_manage_table_data_rows($batch, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the batch.
 */
function get_batch_manage_table_data_rows($batch, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($batch->result() as $row_batch) {
        $table_data_rows.=get_batch_data_row($row_batch, $controller);
    }

    if ($batch->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='6'><span class='col-md-12 text-center text-warning' >" . lang('batch_no_batch_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_batch_data_row($row_batch, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('batches', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('batches', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input name='ch_id[]' type='checkbox'  id='batch_$row_batch->batch_id' value='" . $row_batch->batch_id . "'/></td>";
    $table_data_row.='<td >' . H($row_batch->batch_name) . '</td>';
    $table_data_row.='<td>' . H($row_batch->start_date) . '</td>';
    $table_data_row.='<td >' . H($row_batch->end_date) . '</td>';
    $table_data_row.='<td >' . H($row_batch->batch_number) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$row_batch->batch_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-school_class green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}
