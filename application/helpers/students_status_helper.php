<?php
function get_students_status_manage_table($students, $controller) {
	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
   	$headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('students_status_id'),
        lang('students_status_name'),
        lang('students_status_description'),
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
    $table.=get_students_status_manage_table_data_rows($students, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_students_status_manage_table_data_rows($students, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($students->result() as $student) {
        $table_data_rows.=get_student_status_data_row($student, $controller);
    }

    if ($students->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='4'><span class='col-md-12 text-center text-warning' >" . lang('students_status_no_student_status_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_student_status_data_row($student, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('students_status', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('students_status', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
 	$table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$student->stu_status_id' value='" . $student->stu_status_id . "'/></td>";
    $table_data_row.='<td>' . $student->stu_status_id . '</td>';
    $table_data_row.='<td >' . H($student->stu_status_name) . '</td>';
    $table_data_row.='<td>' . H($student->stu_status_description) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/detail/$student->stu_status_id", '<i class="ace-icon fa fa-search-plus bigger-180"></i>', array('class' => 'detail-student-status', 'title' => lang('common_detail')));
        $table_data_row.=anchor($controller_name . "/view/$student->stu_status_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-student-status green', 'title' => lang('common_update')));
    }
    /*if ($delete) {
        $table_data_row.=anchor($controller_name . "/deletes/$student->stu_status_id", '<i class="ace-icon fa fa-remove red bigger-180 remove-student-status"></i>', array('class' => 'delete-student-status', 'title' => lang('common_delete')));
    }*/
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}