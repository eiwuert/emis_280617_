<?php
function get_score_manage_table($q_search_stu, $controller) {
	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($q_search_stu->num_rows() > 0){
        $table_stu = '';
        foreach($q_search_stu->result() as $row){
            $table_stu .= '<tr>';
            $table_stu .= "<td><input name='ch_id[]' type='checkbox'  id='status_".$row->stu_info_id."' value='" . $row->stu_info_id . "'/></td>";

            $table_stu .= '<td class="text-center">'.$row->stu_unique_id.'</td>';
            $table_stu .= '<td>'.((!empty($row->stu_first_name))? $row->stu_first_name."&nbsp;" : "").((!empty($row->stu_middle_name))? $row->stu_middle_name."&nbsp;" : "").((!empty($row->stu_last_name))? $row->stu_last_name : "").'</td>';
            $table_stu .= '<td>'.$row->stu_gender.'</td>';
            $table_stu .= '<td>'.$row->level_name.'</td>';
            $table_stu .= '<td>'.$row->skill_name.'</td>';
            $table_stu .= '<td>'.$row->batch_name.'</td>';
            $table_stu .= '<td>'.$row->section_name.'</td>';
            $table_stu .= '<td>'.$row->students_grade.'</td>';
            $table_stu .= '<td>';
                $table_stu .= '<a class="btn btn-primary" href="'.site_url("$controller_name/pre_exam/$row->stu_info_id").'" target="_blank">Pre-exam</a>';
                $table_stu .= '<a class="btn btn-primary" href="'.site_url("$controller_name/form/$row->stu_info_id").'" target="_blank">Score</a>';
                $table_stu .= '<a class="btn btn-primary" href="'.site_url("$controller_name/state_exam/$row->stu_info_id").'" target="_blank">State-exam</a>';
                $table_stu .= '<a class="btn btn-primary" href="'.site_url("$controller_name/thesis/$row->stu_info_id").'" target="_blank">Thesis</a>';
                $table_stu .= '<a class="btn btn-primary" href="'.site_url("$controller_name/nas/$row->stu_info_id").'" target="_blank">NAS</a>';
            $table_stu .= '</td>';
            $table_stu .= '</tr>';
        }
        return $table_stu;
    }

}
function get_score_manage_table_info($get_info_stu_pre, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_info_stu_pre->num_rows() > 0){

        $table_stu = '';
        $row = $get_info_stu_pre->row();

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
                $table_stu .= '<td>'.$row->students_grade.'</td>';
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
function manage_table_result_sco_final1($get_result_final1, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_result_final1->num_rows() > 0){

        $tb = '';
        $sum_score = '';
        $count = $get_result_final1->num_rows();
        foreach($get_result_final1->result() as $row){
            $student_id = $row->student_id;
            $sum_mid_term = floatval($row->midterm_group_discussion_score + $row->midterm_quiz_score) + floatval($row->midterm_assignment_score + $row->midterm_exam_score);
            $get_total = floatval($row->attendance_score + $sum_mid_term + $row->final_score);
            $sum_score += $get_total;

            $row_rank = $CI->db->query("SELECT (edu_scores.attendance_score + edu_scores.midterm_group_discussion_score + edu_scores.midterm_quiz_score + edu_scores.midterm_assignment_score + edu_scores.midterm_exam_score + edu_scores.final_score + nas) as result
                            FROM edu_scores where semester = 1 and student_id = {$student_id} and (edu_scores.attendance_score + edu_scores.midterm_group_discussion_score + edu_scores.midterm_quiz_score + edu_scores.midterm_assignment_score + edu_scores.midterm_exam_score + edu_scores.final_score + nas) <= {$get_total} ")->num_rows();
            $result_rank = (($count - $row_rank)+1);

            $grade = check_grad($get_total);
            $tb .= '<tr>';
            $tb .= '<td>'.$row->subject_name.'</td>';
            $tb .= '<td>'.$row->attendance_score.'</td>';
            $tb .= '<td>'.$sum_mid_term.'</td>';
            $tb .= '<td>'.$row->final_score.'</td>';  
            $tb .= '<td>'.$get_total.'</td>';
            $tb .= '<td>'.$grade.'</td>';
            $tb .= '<td>'.$result_rank.'th</td>';
            $tb .= '<td width="15%">';
                $tb .= '<div class="pull-right">';
                $tb .= '<a href="'.site_url("score/form/$row->student_id/$row->id").'" class="btn btn-primary">Edit</a>';
                $tb .= '<a href="'.site_url("score/delete_final_form/$row->student_id/$row->id").'" class="btn btn-danger">delete</a>';
                $tb .= '</div>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
            $tb .= '<tr>';
            $tb .= '<td colspan="4" class="align-right"><b>Total:</></td>';            
            $tb .= '<td><b>'.$sum_score.'</b></td>';
            $tb .= '<td></td>';           
            $tb .= '<td></td>';
            $tb .= '</tr>';

        return $tb;
    }
}
function manage_table_result_sco_final2($get_result_final2, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_result_final2->num_rows() > 0){

        $tb = '';
        $sum_score = '';
        $count = $get_result_final2->num_rows();
        foreach($get_result_final2->result() as $row){ 
            $student_id = $row->student_id;
            $sum_mid_term = floatval($row->midterm_group_discussion_score + $row->midterm_quiz_score) + floatval($row->midterm_assignment_score + $row->midterm_exam_score);
            $get_total = floatval($row->attendance_score + $sum_mid_term + $row->final_score);
            $sum_score += $get_total;
            
            $row_rank = $CI->db->query("SELECT (edu_scores.attendance_score + edu_scores.midterm_group_discussion_score + edu_scores.midterm_quiz_score + edu_scores.midterm_assignment_score + edu_scores.midterm_exam_score + edu_scores.final_score + nas) as result
                            FROM edu_scores where semester = 2 and student_id = {$student_id} and (edu_scores.attendance_score + edu_scores.midterm_group_discussion_score + edu_scores.midterm_quiz_score + edu_scores.midterm_assignment_score + edu_scores.midterm_exam_score + edu_scores.final_score + nas) <= {$get_total} ")->num_rows();
            $result_rank = (($count - $row_rank)+1);

            $grade = check_grad($get_total);
            $tb .= '<tr>';
            $tb .= '<td>'.$row->subject_name.'</td>';
            $tb .= '<td>'.$row->attendance_score.'</td>';
            $tb .= '<td>'.$sum_mid_term.'</td>';
            $tb .= '<td>'.$row->final_score.'</td>';            
            $tb .= '<td>'.$get_total.'</td>';
            $tb .= '<td>'.$grade.'</td>';
            $tb .= '<td>'.$result_rank.'th</td>';
            $tb .= '<td width="15%">';
                $tb .= '<div class="pull-right">';
                $tb .= '<a href="'.site_url("score/form/$row->student_id/$row->id").'" class="btn btn-primary">Edit</a>';
                $tb .= '<a href="'.site_url("score/delete_final_form/$row->student_id/$row->id").'" class="btn btn-danger">delete</a>';
                $tb .= '</div>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
            $tb .= '<tr>';
            $tb .= '<td colspan="4" class="align-right"><b>Total:</></td>';            
            $tb .= '<td><b>'.$sum_score.'</b></td>';
            $tb .= '<td></td>';           
            $tb .= '<td></td>';
            $tb .= '</tr>';
        return $tb;
    }
}
function manage_table_nas_final1($get_nas_final1, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_nas_final1->num_rows() > 0){

        $tb = '';
        $sum_nas = '';
        foreach($get_nas_final1->result() as $row){
            $get_total_nas = $row->nas;   
            $sum_nas+=   $get_total_nas;
            $tb .= '<tr>';
            $tb .= '<td>'.$get_total_nas.'</td>';
            $tb .= '<td width="15%">';
                $tb .= '<div class="pull-right">';
                $tb .= '<a href="'.site_url("score/nas/$row->student_id/$row->id").'" class="btn btn-primary">Edit</a>';
                $tb .= '<a href="'.site_url("score/delete_nas_form/$row->student_id/$row->id").'" class="btn btn-danger">delete</a>';
                $tb .= '</div>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
            $tb .= '<tr>';
            $tb .= '<td class="align-left"><b>Total: <span style="color:red">'.$sum_nas.'</span><b/></td>';            
            $tb .= '<td></td>'; 
            $tb .= '</tr>';

        return $tb;
    }
}
function manage_table_nas_final2($get_nas_final2, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_nas_final2->num_rows() > 0){

        $tb = '';
        $sum_nas = '';
        foreach($get_nas_final2->result() as $row){
            $get_total_nas = $row->nas;   
            $sum_nas+=   $get_total_nas;
            $tb .= '<tr>';
            $tb .= '<td>'.$get_total_nas.'</td>';
            $tb .= '<td width="15%">';
                $tb .= '<div class="pull-right">';
                $tb .= '<a href="'.site_url("score/nas/$row->student_id/$row->id").'" class="btn btn-primary">Edit</a>';
                $tb .= '<a href="'.site_url("score/delete_nas_form/$row->student_id/$row->id").'" class="btn btn-danger">delete</a>';
                $tb .= '</div>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
            $tb .= '<tr>';
            $tb .= '<td class="align-left"><b>Total: <span style="color:red">'.$sum_nas.'</span><b/></td>';            
            $tb .= '<td></td>'; 
            $tb .= '</tr>';

        return $tb;
    }
}
function manage_table_result_sco_pre($get_result_pre, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_result_pre->num_rows() > 0){

        $tb = '';
        $sum_score = '';
        $count = $get_result_pre->num_rows();
        $sum_score = '';
        foreach($get_result_pre->result() as $row){
            $sum_score += $row->score;
            $get_rang = $CI->db->query("SELECT * FROM edu_score_pre_exams WHERE subject_id = {$row->subject_id} AND score >= {$row->score}")->num_rows();
            $grade = check_grad($row->score);
            $tb .= '<tr>';
            $tb .= '<td>'.$row->subject_name.'</td>';
            $tb .= '<td>'.$row->score.'</td>';
            $tb .= '<td>'.$grade.'</td>';
            $tb .= '<td>'.$get_rang.'th</td>';
            $tb .= '<td width="15%">';
                $tb .= '<div class="pull-right">';
                $tb .= '<a href="'.site_url("score/pre_exam/$row->student_id/$row->id").'" class="btn btn-primary">Edit</a>';
                $tb .= '<a href="'.site_url("score/delete_pre_exam/$row->student_id/$row->id").'" class="btn btn-danger">delete</a>';
                $tb .= '</div>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
            $tb .= '<tr>';
                $tb .= '<td class="align-right"><b>Total:</b></td>';
                $tb .= '<td><b>'.$sum_score.'</b></td>';
                $tb .= '<td></td>';
                $tb .= '<td></td>';
                $tb .= '<td></td>';
            $tb .= '</tr>'; 
        return $tb;
    }
}
function manage_table_result_sco_state($get_result_state, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_result_state->num_rows() > 0){

        $tb = '';
        $sum_score = '';
        $sum_written = '';
        $sum_total_score = '';
        $count = $get_result_state->num_rows();
        foreach($get_result_state->result() as $row){
            $grade = check_grad(($row->thesis_score + $row->thesis_written_score));
            $sum_total_score += $row->score;
            $tb .= '<tr>';
            $tb .= '<td>'.$row->subject_name.'</td>';
            $tb .= '<td>'.$row->score.'</td>';
            $tb .= '<td>'.$grade.'</td>';
            $tb .= '<td>'.$rang.'th</td>';
            $tb .= '<td width="15%">';
                $tb .= '<div class="pull-right">';
                $tb .= '<a href="'.site_url("score/state_exam/$row->student_id/$row->id").'" class="btn btn-primary">Edit</a>';
                $tb .= '<a href="'.site_url("score/delete_state_exam/$row->student_id/$row->id").'" class="btn btn-danger">delete</a>';
                $tb .= '</div>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
            $tb .= '<tr>';
            $tb .= '<td class="align-right"><b>Total:</b></td>';
            $tb .= '<td><b>'.$sum_total_score.'</b></td>';    
            $tb .= '<td></td>';
            $tb .= '<td></td>';
            $tb .= '<td></td>';
            $tb .= '</tr>';
        return $tb;
    }
}

function manage_table_result_sco_thesis($get_result_thesis, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
    if($get_result_thesis->num_rows() > 0){

        $tb = '';
        $sum_score = '';
        $sum_written = '';
        $sum_total_score = '';
        $count = $get_result_thesis->num_rows();
        foreach($get_result_thesis->result() as $row){
            $sum_score += $row->thesis_score;
            $sum_written += $row->thesis_written_score;
            $total = $row->thesis_score + $row->thesis_written_score;
                // $rang = $CI->db->query("SELECT
                //                         (thesis_written_score + thesis_score) AS ca,edu_score_state_exam_details.subject_id as subject_id
                //                         FROM
                //                         edu_score_state_exam
                //                         INNER JOIN edu_score_state_exam_details ON edu_score_state_exam.id = edu_score_state_exam_details.score_exam_id
                //                         WHERE edu_score_state_exam_details.subject_id = {$row->subject_id} AND (thesis_written_score + thesis_score) >= {$total}")->num_rows();
            $grade = check_grad(($row->thesis_score + $row->thesis_written_score));
            $total_score = $row->thesis_written_score;
            $sum_total_score += $total_score;
            $tb .= '<tr>';
            $tb .= '<td>'.$row->thesis_written_score.'</td>';
            $tb .= '<td>'.$total_score.'</td>';
            $tb .= '<td>'.date('d-m-Y',strtotime($row->thesis_defence_date)).'</td>';
            $tb .= '<td>'.$grade.'</td>';
            $tb .= '<td>'.$rang.'th</td>';
            $tb .= '<td width="15%">';
                $tb .= '<div class="pull-right">';
                $tb .= '<a href="'.site_url("score/thesis/$row->student_id/$row->id").'" class="btn btn-primary">Edit</a>';
                $tb .= '<a href="'.site_url("score/delete_thesis/$row->student_id/$row->id").'" class="btn btn-danger">delete</a>';
                $tb .= '</div>';
            $tb .= '</td>';
            $tb .= '</tr>';
        }
            $tb .= '<tr>';
            $tb .= '<td class="align-right"><b>Total:</b></td>';
            $tb .= '<td><b>'.$sum_total_score.'</b></td>';    
            $tb .= '<td></td>';
            $tb .= '<td></td>';
            $tb .= '<td></td>';
            $tb .= '<td></td>';
            $tb .= '</tr>';
        return $tb;
    }
}

function check_grad($s_score){
    $score = intval($s_score);
    $grade = '';
    if($score >= 0 && $score <= 39){
        $grade .= 'F';
    }
    if($score >= 40 && $score <= 44){
        $grade .= 'E';
    }
    if($score >= 45 && $score <= 49){
        $grade .= 'D';
    }
    if($score >= 50 && $score <= 64){
        $grade .= 'C';
    }
    if($score >= 65 && $score <= 69){
        $grade .= 'C+';
    }
    if($score >= 70 && $score <= 79){
        $grade .= 'B';
    }
    if($score >= 80 && $score <= 84){
        $grade .= 'B+';
    }
    if($score >= 85 && $score <= 100 || $score > 100){
        $grade .= 'A';
    }
    return $grade; 
}
