<?php

function get_guardian_manage_table($get_guardian,$contorller){

	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table_guardian ='';

    if($get_guardian !== null){
    	foreach ($get_guardian->result() as $k => $g) {	
    		$no = $k + 1;  
    		$table_guardian .= "<div class='wrap-guardian'>";  
			$table_guardian .="	<div class='row'>
							<div class='col-xs-12 col-md-12 col-lg-12'>
								<h2 class='page-header edusec-border-bottom-warning'>
													$no-$g->guardian_relation_id	
									<div class='pull-right'>
										<a style='padding:3px 10px' class='btn btn-primary btn-sm' href='".site_url('students/add_guardians/'.$g->guardian_stu_info_id.'/'.$g->stu_guardian_id.'/2')."' onclick='updateGuard(2,13, 'guardians');return false;'>
										<i class='fa fa-pencil-square-o'></i> ".lang('common_edit')."</a>						    
										<a style='padding:3px 10px' class='btn btn-danger btn-sm del-guardian' href='#' data-confirm='".lang('students_confirm_delete_guardian')."' data-method='post' data-item='".$g->stu_guardian_id."'>
											<i class='fa fa-trash-o'></i> ".lang('common_delete')."</a> 
									</div>
								</h2>
							</div>
						</div>";

						// $table_guardian.= anchor($controller_name."/deletes/$g->stu_guardian_id", '<i class="fa fa-trash-o"></i> Delete</a>', array('class' => 'delete-guardian', '_title' => lang('common_delete')));
											
	$table_guardian .=" <div class='row'>	
							<div class='col-md-12 col-xs-12 col-sm-12'>
							  <div class='col-lg-12 col-sm-12 col-xs-12 no-padding'>
								<div class='col-lg-3 col-xs-3 edusec-profile-label'>".lang('students_relation_id')."</div>
								<div class='col-lg-9 col-xs-9 edusec-profile-text' style='min-height: 45px;'> $g->guardian_relation_id </div>
							  </div>
							</div>";
							if($g->guardian_relation_id == 'Parents'){
				$table_guardian .=" <div class='col-md-12 col-xs-12 col-sm-12'>
									  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
										<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_father')."</div>
										<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_father </div>
									  </div>
									  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
										<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_father_kh').lang('common_kh')."</div>
										<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_father_kh </div>
									  </div>
									</div>
									<div class='col-md-12 col-xs-12 col-sm-12'>
									  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
										<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_mother')."</div>
										<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_mother </div>
									  </div>
									  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
										<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_mother_kh').lang('common_kh')."</div>
										<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_mother_kh </div>
									  </div>
									</div>";
							}elseif($g->guardian_relation_id == 'Other'){
				$table_guardian .=" <div class='col-md-12 col-xs-12 col-sm-12'>
									  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
										<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_relation')."</div>
										<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_relation </div>
									  </div>
									  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
										<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_relation').lang('common_kh')."</div>
										<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_relation_kh </div>
									  </div>
									</div>";
							}
	$table_guardian .=" <div class='col-md-12 col-xs-12 col-sm-12'>
							  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
								<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_occupation')."</div>
								<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_occupation </div>
							  </div>
							  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
								<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_occupation').lang('common_kh')."</div>
								<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_occupation_kh </div>
							  </div>
							</div>

							<div class='col-md-12 col-xs-12 col-sm-12'>
							  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
								<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_mobile_no')."</div>
								<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_mobile_no </div>
							  </div>
							  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
								<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_phone_no')."</div>
								<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_phone_no </div>
							  </div>
							</div>

							<div class='col-md-12 col-xs-12 col-sm-12'>
							  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
								<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_income')."</div>
								<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_income </div>
							  </div>
							  <div class='col-lg-6 col-sm-6 col-xs-12 no-padding'>
								<div class='col-lg-6 col-xs-6 edusec-profile-label'>".lang('students_email')."</div>
								<div class='col-lg-6 col-xs-6 edusec-profile-text' style='min-height: 45px;'> $g->guardian_email </div>
							  </div>
							</div>

							 <div class='col-md-12 col-xs-12 col-sm-12'>
								<div class='col-md-3 col-xs-6 col-sm-3 edusec-profile-label'>".lang('students_qualification')."</div>
								<div class='col-md-9 col-xs-6 col-sm-9 edusec-profile-text' style='min-height: 45px;'> $g->guardian_qualification </div>
							 </div>

							<div class='col-md-12 col-xs-12 col-sm-12'>
								<div class='col-md-3 col-xs-6 col-sm-3 edusec-profile-label'>".lang('students_home_address')."</div>
								<div class='col-md-9 col-xs-6 col-sm-9 edusec-profile-text' style='min-height: 45px;'> $g->guardian_home_address </div>
							</div>

							<div class='col-md-12 col-xs-12 col-sm-12'>
								<div class='col-md-3 col-xs-6 col-sm-3 edusec-profile-label'>".lang('students_home_address').lang('common_kh')."</div>
								<div class='col-md-9 col-xs-6 col-sm-9 edusec-profile-text' style='min-height: 45px;'> $g->guardian_home_address_kh </div>
							</div>

							<div class='col-md-12 col-xs-12 col-sm-12'>
								<div class='col-md-3 col-xs-6 col-sm-3 edusec-profile-label'>".lang('students_office_address')."</div>
								<div class='col-md-9 col-xs-6 col-sm-9 edusec-profile-text' style='min-height: 45px;'> $g->guardian_office_address </div>
							</div>

							<div class='col-md-12 col-xs-12 col-sm-12'>
								<div class='col-md-3 col-xs-6 col-sm-3 edusec-profile-label'>".lang('students_office_address').lang('common_kh')."</div>
								<div class='col-md-9 col-xs-6 col-sm-9 edusec-profile-text' style='min-height: 45px;'> $g->guardian_office_address_kh </div>
							</div>

						</div>";
					$table_guardian .= "</div>";
				}
    	}else{
    			$table_guardian .="	<table width='100%' cellpadding='0' cellspacing='0' class='table table-striped table-bordered table-hover table-responsive'>
										<tbody>
											<tr>
												<th class='table-cell-title text-center' colspan='4'>".lang("students_no_data_available")."</th>
											</tr>
										</tbody>
									</table>";
    			
    	}  	
		

		return $table_guardian;

}

if (!function_exists('get_students_academic_rows')) {
	function get_students_academic_rows($academic, $contorller)
	{
		$CI = &get_instance();
		$controller_name = strtolower(get_class($CI));
		$items = get_student_academic_row($academic, $contorller);
		return $items;
	}
}

function get_student_academic_row($academic, $contorller)
{
	$CI = &get_instance();
	$controller_name = strtolower(get_class($CI));
	$item = '';
	if ($academic->num_rows() > 0) {
		foreach ($academic->result() as $key => $row) {
			$admission_date = $row->stu_acad_admission_date && $row->stu_acad_admission_date != "0000-00-00" ? date('d-m-Y', strtotime($row->stu_acad_admission_date)) : "";
			$completion_date = $row->stu_acad_completion_date && $row->stu_acad_completion_date != "0000-00-00" ? date('d-m-Y', strtotime($row->stu_acad_completion_date)) : "";
			$display = ($row->stu_acad_register == '1')? 'style="display:none"' : '';
			$item .= '<div class="academic-row">';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<h2 class="page-header">
									<i class="fa fa-info-circle"></i> 
									'.lang("common_course").': '.$row->course_name.'
									<div class="pull-right">
										<a  
										data-acad-unique-id="'.$row->stu_acad_stu_acad_unique.'" 
										data-acad-card="'.$row->stu_acad_stu_acad_card.'" 
										data-university="'.$row->stu_acad_university_id.'" 
										data-major="'.$row->skill_major_id.'" 
										data-course="'.$row->course_id.'" 
										data-batch="'.$row->stu_acad_batch_id.'" 
										data-grade="'.$row->stu_acad_grade.'" 
										data-section="'.$row->stu_acad_section_id.'" 
										data-degree="'.$row->stu_acad_level_id.'" 
										data-schedule="'.$row->stu_acad_schedule_id.'" 
										data-acad-status="'.$row->stu_acad_status.'" 
										data-scholarship="'.$row->stu_acad_scholarship_id.'" 
										data-acad-room="'.$row->stu_acad_stu_room.'" 
										data-acad-class="'.$row->stu_acad_stu_class.'" 
										data-admission-date="'.$admission_date.'" 
										data-completion-date="'.$completion_date.'" 
										data-toggle="modal" data-target="#studentAcedmic"
										class="btn-sm btn btn-primary text-warning update-row-academic" 
										href="#" 
										data-href="'.site_url("$controller_name/save_stu_academic/$row->stu_acad_id/2").'"><i class="fa fa-pencil-square-o"></i> '.lang('common_edit').'</a>
										<a '.$display.' class="btn btn-danger btn-sm del-stu_academic" href="javascript:void(0)" data-confirm="'.lang("students_confirm_delete").'" data-method="post" data-item="'.$row->stu_acad_id.'"><i class="fa fa-trash-o"></i> '.lang("common_delete").'</a>
									</div>
								</h2>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('common_num_acad_card').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_acad_stu_acad_unique.'</div>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('common_num_written').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_acad_stu_acad_card.'</div>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_university').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->university_name.'</div>
							</div>
						</div>';			
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang("students_skill").'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->skill_name.'</div>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_course').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->course_name.'</div>
							</div>
						</div>';

			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_batch').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->batch_name.'</div>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_section').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->section_name.'</div>
							</div>
						</div>';

			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_grade').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_acad_grade.'</div>
							</div>
						</div>';			
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_level').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->level_name.'</div>
							</div>
						</div>';

			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_schedule').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.(($row->stu_acad_schedule_id == 1)? 'Mon-fri':'').(($row->stu_acad_schedule_id == 2)? 'Sat-Sun':'').'</div>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('common_status').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_status_name.'</div>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_admission_date').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$admission_date.'</div>
							</div>
						</div>';
			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('common_scholarship').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->scholarship_from.'</div>
							</div>
						</div>';

			$item .= '<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('students_completion_date').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$completion_date.'</div>
							</div>
						</div>';
			$item .= '</div>';
		}

	return $item;
	}
}

	function get_students_job_rows($job_info, $contorller)
	{
		$CI = &get_instance();
		$controller_name = strtolower(get_class($CI));
		$items = get_student_job_row($job_info, $contorller);
		return $items;
	}

function get_student_job_row($job_info, $contorller)
{
	$CI = &get_instance();
	$controller_name = strtolower(get_class($CI));
	$item = '';
	if ($job_info->num_rows() > 0) {
		foreach ($job_info->result() as $key => $row) {
			$stu_job_date = $row->stu_job_date && $row->stu_job_date != "0000-00-00" ? date('d-m-Y', strtotime($row->stu_job_date)) : "";
			
			$item.='<div class="job-row">';
			$item .= '  <div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<h2 class="page-header">
									<i class="fa fa-info-circle"></i> 
									'.lang("common_course").': '.$row->stu_job_name.'
									<div class="pull-right">
										<a  data-job-id="'.$row->stu_job_id.'" 
											data-stu-job-stu-info-id="'.$row->stu_job_stu_info_id.'" 
											data-stu-job-cate-id="'.$row->stu_job_cate_id.'" 
											data-stu-job-name="'.$row->stu_job_name.'" 
											data-stu-job-position="'.$row->stu_job_position.'" 
											data-stu-job-local-id="'.$row->stu_job_local_id.'" 
											data-stu-job-desc="'.$row->stu_job_desc.'" 
											data-stu-job-date="'.$row->stu_job_date.'" 										
											data-toggle="modal" data-target="#studentJobStatus"
											class="btn-sm btn btn-primary text-warning update-row-job" 
											href="#" data-href="'.site_url("$controller_name/save_stu_job_status/$row->stu_job_id").'"><i class="fa fa-pencil-square-o"></i> '.lang('common_edit').'</a>
										<a class="btn btn-danger btn-sm del-job_status" href="javascript:void(0)" data-confirm="'.lang("students_confirm_delete_job_status").'" data-method="post" data-item="'.$row->stu_job_id.'"><i class="fa fa-trash-o"></i> '.lang("common_delete").'</a>
									</div>
								</h2>
							</div>
						</div>';
			$item .= '	<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('stu_job_cate').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->job_title.'</div>
							</div>
						</div>';
			$item .= '	<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('stu_job_position').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_job_position.'</div>
							</div>
						</div>';
			$item .= '	<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('stu_job_name').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_job_name.'</div>
							</div>
						</div>';
			$item .= '	<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('stu_job_local').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->province_name.'</div>
							</div>
						</div>';			
			$item .= '	<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang("stu_job_desc").'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_job_desc.'</div>
							</div>
						</div>';
			$item .= '	<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-12">
								<div class="col-md-4 col-xs-4 edusec-profile-label">'.lang('stu_job_date').'</div>
								<div class="col-md-8 col-xs-8 edusec-profile-text">'.$row->stu_job_date.'</div>
							</div>
						</div>';
			$item.='</div>';
		}

	return $item;
	}
}

function get_stu_list_manage($q_search_stu, $controller, $selection_print) {
	$CI = & get_instance();
    $controller_name = strtolower(get_class($CI));

    $table = '<table class="tablesorter table table-bordered  table-hover" id="sortable_table">';
    if($selection_print == 0){    
	    $headers = array(
	        lang('code'),
	        lang('common_student_name'),
	        lang('common_student_name_kh'),
	        lang('common_gender'),
	        lang('common_date_of_birth'),
	        lang('common_email'),
	        lang('common_mobile_no'),
	        lang('common_admission'),
	        lang('common_nationality')
	    );
    }elseif($selection_print == 1){
    	$headers = array(
	        lang('code'),
	        lang('common_student_name'),
	        lang('common_student_name_kh'),
	        lang('common_gender'),
	        lang('common_date_of_birth'),
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
    $table.=get_stu_list_manage_data_rows($q_search_stu, $controller,$selection_print);
    $table.='</tbody></table>';		 
    return $table;
}
function get_stu_list_manage2($selection_print, $print_type) {
		$var.= form_open("student_list_view/print_search/$selection_print");
	   	$var.='<div class="col-sm-12 col-md-12 col-xs-12 form-group">';
		    $var.='<div class="col-sm-3 col-xs-12">';
		    	$var.= form_label('Print Type:', '', array('class' => 'col-sm-6 col-xs-12 required no-padding'));
		    	$var.= form_dropdown("print_type", $print_type, 0, "class='form-control' style='height:33px'");
		    $var.='</div>';
		    $var.='<div class="col-sm-3 col-xs-12 tb_number">';
		    	$var.= form_label('Table Number:', '', array('class' => 'col-sm-6 col-xs-12 required no-padding'));
		    	$var.= "<input type='number' name='table_number' value='' class='form-control' style='height:33px'/>";
		    $var.='</div>';
		    $var.='<div class="col-sm-3 col-xs-12">';
		    	$var.= form_label('&nbsp;', '', array('class' => 'col-sm-6 col-xs-12 required no-padding'));
		    	$var.='<input type="submit" name="submit" class="btn btn-success" style="width:100%" value="Print Exam Lists" />';
		    $var.='</div>';		    
		$var.='</div>';		
		$var.= '</form>';

	return $var;
}
function get_stu_list_manage_data_rows($q_search_stu, $controller, $selection_print) {
    $CI = & get_instance();
    $table_data_rows = '';

    foreach ($q_search_stu->result() as $stu) {
    	if($selection_print == 0){
    		$table_data_rows.=get_stu_list_data_row($stu, $controller);
    	}elseif($selection_print == 1){
    		$table_data_rows.=get_stu_list_data_row_exam($stu, $controller);
    	}
    }

    if ($q_search_stu->num_rows() == 0) {
        $table_data_rows.="<tr><td colspan='10'><span class='col-md-12 text-center text-warning' >" . lang('students_no_student_to_display') . "</span></tr>";
    }

    return $table_data_rows;
}

function get_stu_list_data_row($stu, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
                    
    $delete = $CI->Employee->has_module_action_permission('score', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('score', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
    $table_data_row = '<tr>';
    $table_data_row.='<td>' . $stu->stu_unique_id . '</td>';
    $table_data_row.='<td >' . H($stu->stu_last_name).' '.H($stu->stu_first_name). '</td>';
    $table_data_row.='<td>' . H($stu->stu_last_name_kh).' '.H($stu->stu_first_name_kh). '</td>';
    $table_data_row.='<td >' . $stu->stu_gender . '</td>';    
    $table_data_row.='<td>' . date_format(date_create($stu->stu_dob),"j F, Y").'</td>';
    $table_data_row.='<td>' . $stu->stu_email_id . '</td>';
    $table_data_row.='<td>' . $stu->stu_mobile_no . '</td>';
    $table_data_row.='<td>' . date_format(date_create($stu->stu_admission_date),"j F, Y").'</td>';
    $table_data_row.='<td>' . $stu->nationality_name .'</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}

function get_stu_list_data_row_exam($stu, $controller) {
    $CI = & get_instance();
    $controller_name = strtolower(get_class($CI));
                    
    $delete = $CI->Employee->has_module_action_permission('score', 'delete', $CI->Employee->get_logged_in_employee_info()->person_id);
    $add_update = $CI->Employee->has_module_action_permission('score', 'add_update', $CI->Employee->get_logged_in_employee_info()->person_id);
 
    $table_data_row = '<tr>';
    $table_data_row.='<td>' . $stu->stu_unique_id . '</td>';
    $table_data_row.='<td >' . H($stu->stu_last_name).' '.H($stu->stu_first_name). '</td>';
    $table_data_row.='<td>' . H($stu->stu_last_name_kh).' '.H($stu->stu_first_name_kh). '</td>';
 	$table_data_row.='<td >' . $stu->stu_gender . '</td>';
    $table_data_row.='<td>' . $stu->stu_dob .'</td>';
    $table_data_row.='</tr>';

    return $table_data_row;
}
