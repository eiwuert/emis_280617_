<?php
function get_fees_collection_manage_table($q_search_stu, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    $headers = array(
        '<input type="checkbox" id="select_all" />',
        lang('code'),
        lang('student_name'),
        lang('sex'),
        lang('degree'),
        lang('major'),
        lang('batch'),
        lang('year'),
        lang('period'),
        lang('scholarship'),
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
    $table.=get_fee_manage_table_data_rows($q_search_stu, $controller);
    $table.='</tbody></table>';
    return $table;
}

function get_fee_manage_table_data_rows($q_search_stu, $controller){
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($q_search_stu->result() as $stu) {
        $table_data_rows.=get_fee_collection_data_row($stu, $controller);
    }

    if ($q_search_stu->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='10'><span class='col-md-12 text-center text-warning' >" . lang('students_no_student_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_fee_collection_data_row($stu, $controller){
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
                    
    $delete = $CI->Employee->has_module_action_permission('fees_collection', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('fees_collection', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);

    $table_data_row = '<tr>';
    $table_data_row.="<td><input name='ch_id[]' type='checkbox'  id='student_$student->stu_info_id' value='" . $student->stu_info_id . "'/></td>";
    $table_data_row.='<td>' . $stu->stu_unique_id . '</td>';
    $table_data_row .= '<td>'.((!empty($stu->stu_first_name))? $stu->stu_first_name."&nbsp;" : "").((!empty($stu->stu_middle_name))? $stu->stu_middle_name."&nbsp;" : "").((!empty($stu->stu_last_name))? $stu->stu_last_name : "").'</td>';
    $table_data_row.='<td>' . H($stu->stu_gender) . '</td>';
    $table_data_row.='<td >' . H($stu->level_name) . '</td>';
    $table_data_row.='<td>' . H($stu->skill_name) . '</td>';
    $table_data_row.='<td>' . H($stu->batch_name) . '</td>';
    $table_data_row.='<td>' . H($stu->section_name) .'</td>';
    $table_data_row.='<td>' . $stu->grade_name .'</td>';
    $table_data_row.='<td>' . $stu->scholarship_from .'</td>';
    $table_data_row.='<td>';
        $table_data_row .= '<a class="btn btn-block btn-primary" href="'.site_url("fees_collection/fee_payment_transaction/$stu->stu_acad_id/0").'" >Pay</a>';       
    $table_data_row.='</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_view_stu_manage_table_info($get_info_stu, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_info_stu->num_rows() > 0){

        $table_stu = '';
        $row = $get_info_stu->row();

            $table_stu .= '<tr>';
                $table_stu .= '<th><label>'.lang('name_kh').'</label></th>';
                $table_stu .= '<td>'.((!empty($row->stu_first_name_kh))? $row->stu_first_name_kh."&nbsp;" : "").((!empty($row->stu_middle_name_kh))? $row->stu_middle_name_kh."&nbsp;" : "").((!empty($row->stu_last_name_kh))? $row->stu_last_name_kh : "").'</td>';
                $table_stu .= '<td><label>'.lang('degree').':</label></td>';
                $table_stu .= '<td>'.$row->level_name.'</td>';
            $table_stu .= '</tr>';
            $table_stu .= '<tr>';
                $table_stu .= '<th><label>'.lang('name_en').'</label></th>';
                $table_stu .= '<td>'.((!empty($row->stu_first_name))? $row->stu_first_name."&nbsp;" : "").((!empty($row->stu_middle_name))? $row->stu_middle_name."&nbsp;" : "").((!empty($row->stu_last_name))? $row->stu_last_name : "").'</td>';
                $table_stu .= '<td><label>'.lang('batch').':</label></td>';
                $table_stu .= '<td>'.$row->batch_name.'</td>';
            $table_stu .= '</tr>';
            $table_stu .= '<tr>';
                $table_stu .= '<th><label>'.lang('sex').':</label></th>';
                $table_stu .= '<td>'.$row->stu_gender.'</td>';
                $table_stu .= '<td><label>'.lang('year').':</label></td>';
                $table_stu .= '<td>'.$row->section_name.'</td>';
            $table_stu .= '</tr>';
            $table_stu .= '<tr>';
                $table_stu .= '<th><label>'.lang('dob').':</label></th>';
                $table_stu .= '<td>'.$row->stu_dob.'</td>';
                $table_stu .= '<td><label>'.lang('period').':</label></td>';
                $table_stu .= '<td>'.$row->grade_name.'</td>';
            $table_stu .= '</tr>';
            $table_stu .= '<tr>';
                $table_stu .= '<th><label>'.lang('nationality').':</label></th>';
                $table_stu .= '<td>'.$row->nationality_name.'</td>';
                $table_stu .= '<td><label>'.lang('school_of').':</label></td>';
                $table_stu .= '<td>'.$row->university_name.'</td>';
            $table_stu .= '</tr>';
            $table_stu .= '<tr>';
                $table_stu .= '<th><label>'.lang('pob').':</label></th>';
                $table_stu .= '<td>'.$row->stu_birthplace.'</td>';
                $table_stu .= '<td><label>'.lang('major').':</label></td>';
                $table_stu .= '<td>'.$row->skill_name.'</td>';
            $table_stu .= '</tr>';

        return $table_stu;
    }
}

function get_view_stu_payment_info($get_list_stu_payment, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_list_stu_payment->num_rows() > 0){

        $table_stu = '';
            $table_stu .= '<thead>';
                $table_stu .= '<tr>';
                    $table_stu .= '<th>#</th>';
                    $table_stu .= '<th>Student ID</th>';
                    $table_stu .= '<th>Scholarship</th>';
                    $table_stu .= '<th>Self Paid</th>';
                    $table_stu .= '<th>Discount</th>';
                    $table_stu .= '<th>Debt</th>';
                    $table_stu .= '<th>Vat</th>';
                    $table_stu .= '<th>Total</th>';
                    $table_stu .= '<th>&nbsp;</th>';
                $table_stu .= '</tr>';
            $table_stu .= '</thead>';
            $table_stu .= '<tbody id="table_view_pay" >';
                $i = 0;
                foreach($get_list_stu_payment->result() as $row ){
                $i++;
                $edit = site_url("$controller_name/fee_payment_transaction/$row->pay_stu_acad_id/$row->pay_id");
                $print = site_url("$controller_name/fee_print/$row->pay_id");
                $print_list = site_url("$controller_name/fee_print_list/$row->pay_id");
                $table_stu .= '<tr data-key="2">';
                    $table_stu .= '<td>'.$i.'</td>';
                    $table_stu .= '<td>'.$row->pay_stu_unique_id.'</td>';
                    $table_stu .= '<td>'.$row->scholarship_from.'</td>';
                    $table_stu .= '<td>'.$row->pay_scholarship_percent.'</td>';
                    $table_stu .= '<td>'.$row->pay_discount.'</td>';
                    $table_stu .= '<td>'.$row->pay_debt.'</td>';
                    $table_stu .= '<td>'.$row->pay_vat.'</td>';
                    $table_stu .= '<td>'.$row->pay_grand_total.'</td>';
                    $table_stu .= '<td>';
                        $table_stu .= '<a style="margin:0px 4px" href="'.$edit.'" title="Update" data-pjax="0"><span class="glyphicon glyphicon-edit blue"></span></a>';
                        $table_stu .= '<a style="margin:0px 4px" target="_blank" href="'.$print.'" title="Print" data-pjax="0"><span class="glyphicon glyphicon-print green"></span></a>';
                        $table_stu .= '&nbsp;';
                        $table_stu .= '<a style="margin:0px 4px" target="_blank" href="'.$print_list.'" title="Print List" data-pjax="0"><span class="glyphicon glyphicon-print orange"></span></a>';
                        $table_stu .= '&nbsp;';
                        $table_stu .= '<a href="javascript:void(0)" data-id="'.$row->pay_id.'" title="Delete" class="delete_pay"><span class="glyphicon glyphicon-remove red"></span></a>';
                    $table_stu .= '</td>';
                $table_stu .= '</tr>';

                }
                
            $table_stu .= '</tbody>';

        return $table_stu;
    }
}