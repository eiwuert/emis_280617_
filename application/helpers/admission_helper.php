<?php
function get_admission_manage_table($admission, $controller) {

	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
   	$headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('admission_category_id'),
        lang('admission_category_name'),
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
    $table.=get_admission_manage_table_data_rows($admission, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_admission_manage_table_data_rows($admission, $controller) {


    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($admission->result() as $d) {
        $table_data_rows.=get_admission_data_row($d, $controller);
    }

       
    if ($admission->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='4'><span class='col-md-12 text-center text-warning' >" . lang('admission_category_no_admission_category_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_admission_data_row($admission, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('admission_categories', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
        
    $add_update = $CI->Employee->has_module_action_permission('admission_categories', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
  
 	$table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$admission->stu_category_id' value='" . $admission->stu_category_id . "'/></td>";
    $table_data_row.='<td>' . $admission->stu_category_id . '</td>';
    $table_data_row.='<td >' . H($admission->stu_category_name) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
  
    if ($add_update) {
        // $table_data_row.=anchor($controller_name . "/detail/$admission->stu_category_id", '<i class="ace-icon fa fa-search-plus bigger-180"></i>', array('class' => 'detail-admission', 'title' => lang('common_detail')));
        $table_data_row.=anchor($controller_name . "/form/$admission->stu_category_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-admission green', 'title' => lang('common_update')));
    }
    // if ($delete) {
    //     $table_data_row.=anchor($controller_name . "/deletes/$student->designation_id", '<i class="ace-icon fa fa-remove red bigger-180 remove-student-status"></i>', array('class' => 'delete-student-status', 'title' => lang('common_delete')));
    // }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}








