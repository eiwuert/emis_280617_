<?php
function get_students_manage_table($students, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('students_id'),
        lang('common_first_name'),
        lang('common_last_name'),
        lang('common_first_name_kh'),
        lang('common_last_name_kh'),
        lang('common_email'),
        lang('common_gender'),
        lang('common_major'),
        lang('common_created_at'),
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
    $table.=get_students_manage_table_data_rows($students, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the students.
 */
function get_students_manage_table_data_rows($students, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($students->result() as $student) {
        $table_data_rows.=get_student_data_row($student, $controller);
    }

    if ($students->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='11'><span class='col-md-12 text-center text-warning' >" . lang('students_no_student_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_student_data_row($student, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('students', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('students', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input name='ch_id[]' type='checkbox'  id='student_$student->stu_info_id' value='" . $student->stu_info_id . "'/></td>";
    $table_data_row.='<td>' . $student->stu_info_id . '</td>';
    $table_data_row.='<td >' . H($student->stu_last_name) . '</td>';
    $table_data_row.='<td>' . H($student->stu_first_name) . '</td>';
    $table_data_row.='<td >' . H($student->stu_last_name_kh) . '</td>';
    $table_data_row.='<td>' . H($student->stu_first_name_kh) . '</td>';
    $table_data_row.='<td>' . H($student->stu_email_id) . '</td>';
    $table_data_row.='<td>' . H($student->stu_gender) . '</td>';
    $table_data_row.='<td>' . H($student->skill_name) . '</td>';
    $table_data_row.='<td>' . $created_at = $student->created_at != "0000-00-00 00:00:00" ? date(get_date_format(), strtotime($student->created_at)) : "" . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        if ($add_update) {
            $table_data_row.=anchor($controller_name . "/detail/$student->stu_info_id", '<i class="ace-icon fa fa-search-plus bigger-180"></i>', array('class' => 'detail-student', 'title' => lang('students_detail')));
        }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}

// Get record of university
function get_faculties_manage_table($faculties, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('university_no'),
        lang('university_name'),
        lang('university_name_kh'),
        lang('university_faculty_dean'),
        lang('faculty_code'),
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
    $table.=get_faculties_manage_table_data_rows($faculties, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the university.
 */

function get_faculties_manage_table_data_rows($faculties, $controller) {
    $CI = &get_instance();
    $table_data_rows = '';

    $no = 1;
    foreach ($faculties->result() as $faculty) {
        $table_data_rows.=get_faculty_data_row($faculty, $controller, $no);
        $no++;
    }

    if ($faculties->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('university_no_university_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_faculty_data_row($faculty, $controller, $no) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('university', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('university', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='student_$faculty->university_id' value='" . $faculty->university_id . "'/></td>";
    $table_data_row.='<td>' . $no . '</td>';
    $table_data_row.='<td >' . H($faculty->university_name) . '</td>';
    $table_data_row.='<td >' . H($faculty->university_name_kh) . '</td>';
    $table_data_row.='<td >' . H($faculty->last_name.' '.$faculty->first_name) . '</td>';
    $table_data_row.='<td >' . $faculty->university_code . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        // $table_data_row.=anchor($controller_name . "/detail/$faculty->university_id", '<i class="ace-icon fa fa-search-plus bigger-180"></i>', array('class' => 'detail-faculty', 'title' => lang('university_detail')));
        $table_data_row.=anchor($controller_name . "/form/$faculty->university_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-faculty green', 'title' => lang('university_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}
// Department Type
function get_dept_manage_table($table_data, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('common_no'),
        lang('dept_title'),
        lang('dept_title_kh'),
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
    $table.=get_dept_manage_table_data_rows($table_data, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*Gets the html data rows for the dept.*/
function get_dept_manage_table_data_rows($table_data, $controller) {
    $CI = &get_instance();
    $table_data_rows = '';
    $no = 1;
    foreach ($table_data->result() as $val) {
        $table_data_rows.=get_dept_data_row($val, $controller, $no);
        $no++;
    }

    if ($table_data->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='5'><span class='col-md-12 text-center text-warning' >" . lang('dept_no_dept_to_display') . "</span></tr>";
    }
    return $table_data_rows;
}
function get_dept_data_row($val, $controller, $no) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('department_type', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('department_type', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='dept_$val->dept_id' value='" . $val->dept_id . "'/></td>";
    $table_data_row.='<td>' . $no . '</td>';
    $table_data_row.='<td >' . H($val->dept_title) . '</td>';
    $table_data_row.='<td >' . H($val->dept_title_kh) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
    
        $table_data_row.=anchor($controller_name . "/form/$val->dept_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-dept green', 'title' => lang('dept_update')));
    
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

// Get record as table of degree/level
function get_degrees_manage_table($degrees, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('degree_no'),
        lang('degree_code'),
        lang('degree_name'),
        lang('degree_name_kh'),
        lang('degree_duration'),
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
    $table.=get_degrees_manage_table_data_rows($degrees, $controller);
    $table.='</tbody></table>';
    return $table;
}
/*
  Gets the html data rows for the university.
 */

function get_degrees_manage_table_data_rows($degrees, $controller) {
    $CI = &get_instance();
    $table_data_rows = '';

    $no = 1;
    foreach ($degrees->result() as $degree) {
        $table_data_rows.=get_degree_data_row($degree, $controller, $no);
        $no++;
    }

    if ($degrees->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('degree_no_degree_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_degree_data_row($degree, $controller, $no) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('degree_management', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('degree_management', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='student_$degree->level_id' value='" . $degree->level_id . "'/></td>";
    $table_data_row.='<td>' . $no . '</td>';
    $table_data_row.='<td >' . H($degree->level_code) . '</td>';
    $table_data_row.='<td >' . H($degree->level_name) . '</td>';
    $table_data_row.='<td >' . H($degree->level_name_kh) . '</td>';
    $table_data_row.='<td >' . H($degree->level_duration.' '.ucwords($degree->duration_type)) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$degree->level_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-degree green', 'title' => lang('degree_management_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

/*
  Gets the html table to manage permission.
*/
function get_people_permission_manage_table($people, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    
    $headers = array(
        // '<input type="checkbox" id="select_all" />',
        lang('common_person_id'),
        lang('employees_username'),
        lang('common_full_name'),
        lang('common_full_name').lang('common_kh'),
        lang('common_role'),
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
            $table.="<th>$header</th>";
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
    $table.=get_people_permission_manage_table_data_rows($people, $controller);
    $table.='</tbody></table>';
    return $table;
}

/*
  Gets the html data rows for the permission.
 */

function get_people_permission_manage_table_data_rows($people, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($people->result() as $person) {
        $table_data_rows.=get_person_permission_data_row($person, $controller);
    }

    if ($people->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('common_no_persons_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_person_permission_data_row($person, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $avatar_url = $person->image_id ? site_url('app_files/view/' . $person->image_id) : false;
    
    $table_data_row = '<tr>';
    // $table_data_row.="<td><input type='checkbox'  id='person_$person->person_id' value='" . $person->person_id . "'/></td>";
    $table_data_row.='<td>' . $person->person_id . '</td>';
    $table_data_row.='<td>' . H($person->username) . '</td>';
    $table_data_row.='<td>' . H($person->last_name.' '.$person->first_name) . '</td>';
    $table_data_row.='<td>' . H($person->last_name_kh.' '.$person->first_name_kh) . '</td>';
    $table_data_row.='<td>' . H($person->user_type) . '</td>';
   
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

    $table_data_row.='<td class="action-buttons">' . $edit_action . '</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_room_manage_table($room, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('room_id'),
        lang('room_name'),
        lang('room_note'),
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
    $table.=get_room_manage_table_data_rows($room, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_room_manage_table_data_rows($room, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($room->result() as $d) {
        $table_data_rows.=get_room_data_row($d, $controller);
    }

    if ($room->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='5'><span class='col-md-12 text-center text-warning' >" . lang('room_no_room_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_room_data_row($room, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('room', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$room->room_id' value='" . $room->room_id . "'/></td>";
    $table_data_row.='<td>' . $room->room_id . '</td>';
    $table_data_row.='<td >' . H($room->room_name) . '</td>';
    $table_data_row.='<td >' . H($room->room_note) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$room->room_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-room green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}





function get_grade_manage_table($grade, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('grade_id'),
        lang('grade_name'),
        lang('grade_note'),
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
    $table.=get_grade_manage_table_data_rows($grade, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_grade_manage_table_data_rows($grade, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($grade->result() as $d) {
        $table_data_rows.=get_grade_data_row($d, $controller);
    }

    if ($grade->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='5'><span class='col-md-12 text-center text-warning' >" . lang('grade_no_grade_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_grade_data_row($grade, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('grade', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$grade->grade_id' value='" . $grade->grade_id . "'/></td>";
    $table_data_row.='<td>' . $grade->grade_id . '</td>';
    $table_data_row.='<td >' . H($grade->grade_name) . '</td>';
    $table_data_row.='<td >' . H($grade->grade_note) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$grade->grade_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-grade green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}








function get_school_class_manage_table($school_class, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));


    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('school_class_id'),
        lang('school_class_name'),
        lang('school_class_note'),
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
    $table.=get_school_class_manage_table_data_rows($school_class, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_school_class_manage_table_data_rows($school_class, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($school_class->result() as $d) {
        $table_data_rows.=get_school_class_data_row($d, $controller);
    }
    if ($school_class->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='5'><span class='col-md-12 text-center text-warning' >" . lang('school_class_no_school_class_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_school_class_data_row($school_class, $controller) {  
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('school_class', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$school_class->school_class_id' value='" . $school_class->school_class_id . "'/></td>";
    $table_data_row.='<td>' . $school_class->school_class_id . '</td>';
    $table_data_row.='<td >' . H($school_class->school_class_name) . '</td>';
    $table_data_row.='<td >' . H($school_class->school_class_note) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$school_class->school_class_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-school_class green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}

































function get_category_products_manage_table($category_products, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('common_no'),
        lang('category_products_name'),
        lang('category_products_note'),
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
    $table.=get_category_products_manage_table_data_rows($category_products, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_category_products_manage_table_data_rows($category_products, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';
    $i = 0;
    foreach ($category_products->result() as $d) {
        $i++;
        $table_data_rows.=get_category_products_data_row($d, $controller, $i);
    }
    if ($category_products->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='5'><span class='col-md-12 text-center text-warning' >" . lang('category_products_no_category_products_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_category_products_data_row($category_products, $controller, $i) {  
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('category_products', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$category_products->item_category_id' value='" . $category_products->item_category_id . "'/></td>";
    $table_data_row.='<td>' . $i . '</td>';
    $table_data_row.='<td >' . H($category_products->name) . '</td>';
    $table_data_row.='<td >' . H($category_products->description) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$category_products->item_category_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-category_products green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}


































function get_academic_manage_table($academic, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('academic_year_id'),
        lang('academic_year_name'),
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
    $table.=get_academic_manage_table_data_rows($academic, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_academic_manage_table_data_rows($academic, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($academic->result() as $d) {
        $table_data_rows.=get_academic_data_row($d, $controller);
    }

    if ($academic->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='5'><span class='col-md-12 text-center text-warning' >" . lang('academic_year_no_academic_year_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_academic_data_row($academic, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('academic_year', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$academic->section_id' value='" . $academic->section_id . "'/></td>";
    $table_data_row.='<td>' . $academic->section_id . '</td>';
    $table_data_row.='<td >' . H($academic->section_name) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$academic->section_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-academic green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_subjects_manage_table($subjects, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('subjects_id'),
        lang('subjects_name'),
        lang('subjects_name_kh'),
        lang('subjects_short_name'),
        lang('subjects_semester'),
        lang('subjects_credit'),
        lang('subjects_other'),
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
    $table.=get_subjects_manage_table_data_rows($subjects, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_subjects_manage_table_data_rows($subjects, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($subjects->result() as $subject) {
        $table_data_rows.=get_subjects_data_row($subject, $controller);
    }

    if ($subjects->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('subjects_no_subjects_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_subjects_data_row($subject, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('subjects', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $get_semester1 = $CI->db->where('semester',1)->where('subject_id',$subject->sub_id)->get('subject_semester')->row()->semester;
    $get_semester2 = $CI->db->where('semester',2)->where('subject_id',$subject->sub_id)->get('subject_semester')->row()->semester;

    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$subject->sub_id' value='" . $subject->sub_id . "'/></td>";
    $table_data_row.='<td>' . $subject->sub_id . '</td>';
    $table_data_row.='<td>' . H($subject->subject_name) . '</td>';
    $table_data_row.='<td>' . H($subject->subject_name_kh) . '</td>';
    $table_data_row.='<td>' . H($subject->subjects_short_name) . '</td>';
    $table_data_row.='<td>' . $get_semester1.$get_semester2 . '</td>';
    $table_data_row.='<td>' . H($subject->subject_credit) . '</td>';
    $table_data_row.='<td>' . H($subject->subject_other) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/view/$subject->sub_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-subjects green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_search_subject_manage_table($query, $controller){
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($query->num_rows() > 0){
        $table_subj = '';
        $i = '';
        foreach($query->result() as $row){
            $i++;
            $table_subj .= '<tr>';
            $table_subj .= "<td><input name='ch_id[]' type='checkbox'  id='status_".$row->sub_id."' value='" . $row->sub_id . "' checked /></td>";
            $table_subj .= '<td>'.$i.'</td>';
            $table_subj .= '<td>'.$row->subject_name.'</td>';
            $table_subj .= '<td>'.$row->subject_credit.'</td>';
            $table_subj .= '<td>'.$row->semester.'</td>';
            $table_subj .= '<td>'.$row->level_year.'</td>';
            $table_subj .= '</tr>';
        }
        return $table_subj;
    }
}

function get_course_manage_table($courses, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('course_id'),
        lang('course_code'),
        lang('course_name'),
        lang('course_name_kh'),
        lang('course_degree'),
        lang('course_credit'),
        lang('course_schedule'),
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
    $table.=get_course_manage_table_data_rows($courses, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_course_manage_table_data_rows($courses, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($courses->result() as $course) {
        $table_data_rows.=get_course_data_row($course, $controller);
    }

    if ($courses->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('course_no_course_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_course_data_row($course, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('course_management', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$course->course_id' value='" . $course->course_id . "'/></td>";
    $table_data_row.='<td>' . $course->course_id . '</td>';
    $table_data_row.='<td>' . $course->course_code . '</td>';
    $table_data_row.='<td >' . H($course->course_name) . '</td>';
    $table_data_row.='<td >' . H($course->course_name_kh) . '</td>';
    $table_data_row.='<td >' . H($course->level_name) . '</td>';
    $table_data_row.='<td >' . $course->credit . '</td>';
    $table_data_row.='<td >';
        $table_data_row.='<div class="action-buttons align-center">';
           $table_data_row.='<a style="color:blue" href="'.site_url($controller_name . "/view_schedule/$course->course_id").'"><center>Full-Time</center></a>';

           $table_data_row.='<a style="color:red" href="'.site_url($controller_name . "/view_schedule2/$course->course_id").'"><center>Part-Time</center></a>';
        $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$course->course_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-course green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_scholarships_manage_table($scholarships, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('scholarship_id'),
        lang('scholarship_scholarship_from'),
        lang('scholarship_scholarship_from_kh'),
        lang('scholarship_started_date'),
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
    $table.=get_scholarships_manage_table_data_rows($scholarships, $controller);

    $table.='</tbody></table>';
    return $table;
}

function get_scholarships_manage_table_data_rows($scholarships, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($scholarships->result() as $scholarship) {
        $table_data_rows.=get_scholarship_data_row($scholarship, $controller);
    }

    if ($scholarships->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='5'><span class='col-md-12 text-center text-warning' >" . lang('scholarship_no_scholarship_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_scholarship_data_row($scholarship, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission('scholarship', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$scholarship->scho_id' value='" . $scholarship->scho_id . "'/></td>";
    $table_data_row.='<td>' . $scholarship->scho_id . '</td>';
    $table_data_row.='<td>' . H($scholarship->scholarship_from) . '</td>';
    $table_data_row.='<td>' . H($scholarship->scholarship_from_kh) . '</td>';
    $table_data_row.='<td>' . date(get_date_format(), strtotime($scholarship->started_date)) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    $table_data_row.=anchor($controller_name . "/view/$scholarship->scho_id/2", '<i class="ace-icon fa fa-list bigger-180"></i>', array('class' => 'view-scholarship green', 'title' => lang('common_view')));
    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$scholarship->scho_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-scholarship green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

// letterin
function get_letter_in_manage_table($letter_in, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table = '<table class="tablesorter table table-bordered table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('letter_id'),
        lang('received_date'),
        lang('send_from'),
        lang('orginazation'),
        lang('purpose'),
        lang('received_by'),
        lang('common_add'),
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
    $table.=get_letter_in_manage_table_data_rows($letter_in, $controller);
    $table.='</tbody></table>';
    return $table;
}
function get_letter_in_manage_table_data_rows($letter_in, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';
    foreach ($letter_in->result() as $row_letter_in) {
        $table_data_rows.=get_letter_in_data_row($row_letter_in, $controller);
    }
    if ($letter_in->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='9'><span class='col-md-12 text-center text-warning' >" . lang('letter_in_no_letter_to_display') . "</span></tr>";
    }
    return $table_data_rows;
}
function get_letter_in_data_row($row_letter_in, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('letter_in', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('letter_in', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox' id='$row_letter_in->id' value='" . $row_letter_in->id . "'/></td>";
    $table_data_row.='<td>' . $row_letter_in->id . '</td>';
    $table_data_row.='<td>' . $row_letter_in->received_date . '</td>';
    $table_data_row.='<td >' . $row_letter_in->send_from . '</td>';
    $table_data_row.='<td >' . $row_letter_in->orginazation . '</td>';
    $table_data_row.='<td >' . $row_letter_in->purpose . '</td>';
    $table_data_row.='<td >' . $row_letter_in->user_type . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        $table_data_row.=anchor($controller_name . "/add_file/$row_letter_in->id/2", '<i class="ace-icon fa fa-file bigger-180"></i>', array('class' => 'update-letter_out blue', 'title' => lang('common_update')));
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        $table_data_row.=anchor($controller_name . "/print_ex/$row_letter_in->id/2", '<i class="ace-icon fa fa-print bigger-180"></i>', array('class' => 'update-mou green', 'title' => lang('common_update')));
        if ($add_update) {
            $table_data_row.=anchor($controller_name . "/view/$row_letter_in->id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-letter_in green', 'title' => lang('common_update')));
        }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}       
//get_letter_out
function get_letter_out_manage_table($letter_out, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    $table = '<table class="tablesorter table table-bordered table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('letter_id'),
        lang('send_out_date'),
        lang('send_to'),
        lang('organization'),
        lang('purpose'),
        lang('send_by'),
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
    $table.=get_letter_out_manage_table_data_rows($letter_out, $controller);
    $table.='</tbody></table>';
    return $table;
}
function get_letter_out_manage_table_data_rows($letter_out, $controller) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($letter_out->result() as $row_letter_out) {
        $table_data_rows.=get_letter_out_data_row($row_letter_out, $controller);
    }
    if ($letter_out->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='8'><span class='col-md-12 text-center text-warning' >" . lang('letter_out_no_letter_to_display') . "</span></tr>";
    }
    return $table_data_rows;
}
function get_letter_out_data_row($row_letter_out, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $delete = $CI->Employee->has_module_action_permission('letter_out', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('letter_out', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox'  id='status_$row_letter_out->id' value='" . $row_letter_out->id . "'/></td>";
    $table_data_row.='<td>' . $row_letter_out->id . '</td>';
    $table_data_row.='<td>' . $row_letter_out->send_out_date . '</td>';
    $table_data_row.='<td >' . $row_letter_out->send_to. '</td>';
    $table_data_row.='<td >' . $row_letter_out->organization . '</td>';
    $table_data_row.='<td >' . $row_letter_out->purpose . '</td>';
    $table_data_row.='<td >' . $row_letter_out->user_type . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        $table_data_row.=anchor($controller_name . "/add_file/$row_letter_out->id/2", '<i class="ace-icon fa fa-file bigger-180"></i>', array('class' => 'update-letter_out blue', 'title' => lang('common_update')));
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        $table_data_row.=anchor($controller_name . "/print_ex/$row_letter_out->id/2", '<i class="ace-icon fa fa-print bigger-180"></i>', array('class' => 'update-mou green', 'title' => lang('common_update')));
        if ($add_update) {
            $table_data_row.=anchor($controller_name . "/view/$row_letter_out->id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-letter_out green', 'title' => lang('common_update')));
        }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';
    return $table_data_row;
}

/**
 * Get record as table of fees
 * @param  object_array $fees       Object array of fee
 * @param  class $controller controller name
 * @return html             table of fees
 */
function get_fees_manage_table($fees, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('fees_name'),
        lang('common_major'),
        lang('degree_code'),
        lang('degree_name'),
        lang('fees_year_fee'),
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
    $table.=get_fees_manage_table_data_rows($fees, $controller);
    $table.='</tbody></table>';
    return $table;
}

/**
 * Gets the html data rows for the fees.
 * @param  object_array $fees       Object array of fees
 * @param  class $controller class name
 * @return html             Rows of table
 */
function get_fees_manage_table_data_rows($fees, $controller) {
    $CI = &get_instance();
    $table_data_rows = '';

    $no = 1;
    foreach ($fees->result() as $fee) {
        $table_data_rows.=get_fee_data_row($fee, $controller, $no);
        $no++;
    }

    if ($fees->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='8'><span class='col-md-12 text-center text-warning' >" . lang('fees_no_fee_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

/**
 * Get row of table
 * @param  object $fee        An object array of fee
 * @param  class $controller class name
 * @param  int $no         increment of row table
 * @return html             Row of table
 */
function get_fee_data_row($fee, $controller, $no) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $view = $CI->Employee->has_module_action_permission($controller_name, 'search', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);

    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox' id='student_$fee->fees_category_id' value='" . $fee->fees_category_id . "'/></td>";
    // $table_data_row.='<td>' . $no . '</td>';
    $table_data_row.='<td >' . H($fee->fees_collect_name) . '</td>';
    $table_data_row.='<td >' . H($fee->skill_name) . '</td>';
    $table_data_row.='<td >' . H($fee->level_code) . '</td>';
    $table_data_row.='<td >' . H($fee->level_name) . '</td>';
    $table_data_row.='<td >' . H($fee->section_name) . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($view) {
        $table_data_row.=anchor($controller_name . "/view/$fee->fees_category_id/2", '<i class="ace-icon fa fa-search-plus bigger-180"></i>', array('class' => 'view-fee', 'title' => lang('common_view')));
    }
    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/form/$fee->fees_category_id/2", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-fee green', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

/**
 * Get record as table of IQA
 * @param  object_array $iqas       Object array of IQA
 * @param  class $controller controller name
 * @return html             table of IQA
 */
function get_iqa_manage_table($iqas, $controller) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('common_no'),
        lang('iqa_evaluation_title'),
        lang('iqa_evaluation_title_kh'),
        lang('iqa_date'),
        lang('common_year'),
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
    $table.=get_iqa_manage_table_data_rows($iqas, $controller);
    $table.='</tbody></table>';
    return $table;
}

/**
 * Gets the html data rows for the IQA.
 * @param  object_array $iqas       Object array of IQA
 * @param  class $controller class name
 * @return html             Rows of table
 */
function get_iqa_manage_table_data_rows($iqas, $controller) {
    $CI = &get_instance();
    $table_data_rows = '';

    $no = 1;
    foreach ($iqas->result() as $iqa) {
        $table_data_rows .= get_iqa_data_row($iqa, $controller, $no);
        $no++;
    }

    if ($iqas->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='7'><span class='col-md-12 text-center text-warning' >" . lang('iqa_no_iqa_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

/**
 * Get row of table
 * @param  object $iqa        An object array of IQA
 * @param  class $controller class name
 * @param  int $no         increment of row table
 * @return html             Row of table
 */
function get_iqa_data_row($iqa, $controller, $no) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);

    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox' id='iqa_$iqa->id' value='" . $iqa->id . "'/></td>";
    $table_data_row.='<td>' . $no . '</td>';
    $table_data_row.='<td >' . H($iqa->name_eng) . '</td>';
    $table_data_row.='<td >' . H($iqa->name_kh) . '</td>';
    $table_data_row.='<td >' . date(get_date_format(), strtotime($iqa->date)) . '</td>';
    $table_data_row.='<td >' . $iqa->year . '</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';

    if ($add_update) {
        $table_data_row.=anchor($controller_name . "/view/$iqa->id/2", '<i class="ace-icon fa fa-pencil bigger-150"></i>', array('class' => 'btn btn-block btn-primary update-iqa', 'title' => lang('common_update')));
    }
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

/**
 * Get record as table of IQA Result
 * @param  object_array $iqas       Object array of IQA Result
 * @param  class $controller controller name
 * @return html             table of IQA
 */
function get_iqa_result_manage_table($iqas, $controller){
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('common_no'),
        lang('common_name'),
        lang('common_gender'),
        lang('iqa_evaluation_title'),
        lang('common_total'),
        lang('common_average'),
        lang('common_range'),
        lang('iqa_date_from'),
        lang('iqa_date_to'),
        ''
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
    $table.=get_iqa_result_manage_table_data_rows($iqas, $controller);
    $table.='</tbody></table>';
    return $table;
}

/**
 * Gets the html data rows for the IQA.
 * @param  object_array $iqas       Object array of IQA
 * @param  class $controller class name
 * @return html             Rows of table
 */
function get_iqa_result_manage_table_data_rows($iqas, $controller) {
    $CI = &get_instance();
    $table_data_rows = '';

    $no = 1;
    foreach ($iqas->result() as $iqa) {
        $table_data_rows .= get_iqa_result_data_row($iqa, $controller, $no);
        $no++;
    }

    if ($iqas->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='11'><span class='col-md-12 text-center text-warning' >" . lang('iqa_no_iqa_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}
function get_iqa_result_data_row($iqa, $controller, $no) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $iqa_ids = $CI->Iqa_results->get_all_iqa_ids($iqa->evaluate_to, $iqa->evaluate_type_id);
    $total_score_average = $CI->Iqa_results->get_score_average($iqa_ids);

    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox' id='iqa_$iqa->evaluate_to' value='" . $iqa->evaluate_to . "'/></td>";
    $table_data_row.='<td>' . $no . '</td>';
    $table_data_row.='<td >' . H($iqa->last_name . ' ' . $iqa->first_name) . '</td>';
    $table_data_row.='<td >' . H($iqa->gender) . '</td>';
    $table_data_row.='<td >' . H($iqa->name_eng) . '</td>';
    $table_data_row.='<td >' . $total_score_average['total_score'].'</td>';
    $table_data_row.='<td >' . $total_score_average['average'].'</td>';
    $table_data_row.='<td >' . 'Range' . '</td>';
    $table_data_row.='<td >' . date(get_date_format(), strtotime($iqa->date_from)).'</td>';
    $table_data_row.='<td >' . date(get_date_format(), strtotime($iqa->date_to)).'</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        if ($add_update) {
            $table_data_row.=anchor(site_url($controller_name) . "/display/$iqa->evaluate_to/$iqa->evaluate_type_id/$iqa->id", '<i class="ace-icon fa fa-search bigger-180"></i>', array('class' => 'update-iqa', 'title' => lang('common_view')));
        }
        $table_data_row.=anchor($controller_name . "/edit/$iqa->evaluate_to/$iqa->evaluate_type_id/$iqa->id", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-letter_in green', 'title' => lang('common_update')));
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

// IQA Result for Room
function get_iqa_result_room_manage_table($iqas, $controller){
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('common_no'),
        lang('common_name'),
        lang('common_gender'),
        lang('iqa_evaluation_title'),
        lang('common_total'),
        lang('common_average'),
        lang('common_range'),
        lang('iqa_date_from'),
        lang('iqa_date_to'),
        ''
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
    $table.=get_iqa_result_room_manage_table_data_rows($iqas, $controller);
    $table.='</tbody></table>';
    return $table;
}
function get_iqa_result_room_manage_table_data_rows($iqas, $controller) {
    $CI = &get_instance();
    $table_data_rows = '';

    $no = 1;
    foreach ($iqas->result() as $iqa) {
        $table_data_rows .= get_iqa_result_room_data_row($iqa, $controller, $no);
        $no++;
    }

    if ($iqas->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='11'><span class='col-md-12 text-center text-warning' >" . lang('iqa_no_iqa_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}
function get_iqa_result_room_data_row($iqa, $controller, $no) {
    $CI = &get_instance();
    $controller_name = strtolower(get_class($CI));
    $add_update = $CI->Employee->has_module_action_permission($controller_name, 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
    $iqa_ids = $CI->Iqa_results->get_all_iqa_ids($iqa->evaluate_to, $iqa->evaluate_type_id);
    $total_score_average = $CI->Iqa_results->get_score_average($iqa_ids);

    $table_data_row = '<tr>';
    $table_data_row.="<td><input type='checkbox' id='iqa_$iqa->evaluate_to' value='" . $iqa->evaluate_to . "'/></td>";
    $table_data_row.='<td>' . $no . '</td>';
    $table_data_row.='<td >' . H($iqa->last_name . ' ' . $iqa->first_name) . '</td>';
    $table_data_row.='<td >' . H($iqa->gender) . '</td>';
    $table_data_row.='<td >' . H($iqa->name_eng) . '</td>';
    $table_data_row.='<td >' . $total_score_average['total_score'].'</td>';
    $table_data_row.='<td >' . $total_score_average['average'].'</td>';
    $table_data_row.='<td >' . 'Range' . '</td>';
    $table_data_row.='<td >' . date(get_date_format(), strtotime($iqa->date_from)).'</td>';
    $table_data_row.='<td >' . date(get_date_format(), strtotime($iqa->date_to)).'</td>';
    $table_data_row.='<td>';
    $table_data_row.='<div class="action-buttons">';
        if ($add_update) {
            $table_data_row.=anchor(site_url($controller_name) . "/display/$iqa->evaluate_to/$iqa->evaluate_type_id/$iqa->id", '<i class="ace-icon fa fa-search bigger-180"></i>', array('class' => 'update-iqa', 'title' => lang('common_view')));
        }
        $table_data_row.=anchor($controller_name . "/edit/$iqa->evaluate_to/$iqa->evaluate_type_id/$iqa->id", '<i class="ace-icon fa fa-pencil bigger-180"></i>', array('class' => 'update-letter_in green', 'title' => lang('common_update')));
    $table_data_row.='</div>';
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

