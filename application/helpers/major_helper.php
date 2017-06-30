<?php
function get_major_manage_table($table_data, $controller) {

	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
   	$headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('major_code'),
        lang('major_name'),
        lang('major_name_kh'),
        lang('major_duration'),
        lang('major_academic_year'),
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
    $table.=get_major_manage_table_data_rows($table_data, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_major_manage_table_data_rows($table_data, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($table_data->result() as $major) {
    	$table_data_rows.=get_major_data_row($major, $controller);
    }

    if ($table_data->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('major_no_student_status_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_major_data_row($major, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('major', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('major', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
 	$table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$major->skill_id' value='" . $major->skill_id . "'/></td>";
    $table_data_row.='<td>' . $major->skill_major_code. '</td>';
    $table_data_row.='<td >' . H($major->skill_name) . '</td>';
    $table_data_row.='<td>' . H($major->skill_name_kh) . '</td>';
    $table_data_row.='<td>' . H($major->duration). '</td>';
    $table_data_row.='<td>' . H($major->skill_academic_year). '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/view/$major->skill_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-major green', 'title' => lang('common_update')));
    }
    
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}