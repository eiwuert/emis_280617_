<?php
function get_card_manage_table($q_search_stu, $controller) {
	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($q_search_stu->num_rows() > 0){

        $table_stu = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
        $headers = array(
            '<input type="checkbox" id="select_all" />',
            lang('code'),
            lang('student_name'),
            lang('sex'),
            lang('degree'),
            lang('major'),
            lang('batch'),
            lang('year'),
            lang('period')
        );
        $table_stu.='<thead><tr>';

        $count = 0;
        foreach ($headers as $header) {
            $count++;

            if ($count == 1) {
                $table_stu.="<th class='leftmost'>$header</th>";
            } elseif ($count == count($headers)) {
                $table_stu.="<th class='rightmost'>$header</th>";
            } else {
                $table_stu.="<th>$header</th>";
            }
        }
        $table_stu.='</tr></thead><tbody>';
        foreach($q_search_stu->result() as $row){
            $table_stu .= '<tr>';
            $table_stu .= '<td>';
                $table_stu .= '<input name="ch_id[]" type="checkbox"  id="student_$row->stu_acad_id" value="'. $row->stu_acad_id .'"/>';
            $table_stu .= '</td>';
            $table_stu .= '<td class="text-center">'.$row->stu_unique_id.'</td>';
            $table_stu .= '<td>'.((!empty($row->stu_first_name))? $row->stu_first_name."&nbsp;" : "").((!empty($row->stu_middle_name))? $row->stu_middle_name."&nbsp;" : "").((!empty($row->stu_last_name))? $row->stu_last_name : "").'</td>';
            $table_stu .= '<td>'.$row->stu_gender.'</td>';
            $table_stu .= '<td>'.$row->level_name.'</td>';
            $table_stu .= '<td>'.$row->skill_name.'</td>';
            $table_stu .= '<td>'.$row->batch_name.'</td>';
            $table_stu .= '<td>'.$row->section_name.'</td>';
            $table_stu .= '<td>'.$row->students_grade.'</td>';
            
            $table_stu .= '</tr>';
        }
        $table_stu.='</tbody></table>';
        return $table_stu;
    }

}
