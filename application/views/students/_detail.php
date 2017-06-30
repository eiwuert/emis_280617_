<section class="content" style="min-height: 303px;">
	<section class="content-header">
		<div class="col-xs-12">
		  	<div class="col-xs-12">
				<h2 class="page-header">	
						<i class="fa fa-user"></i><?php echo lang("students_profile"); ?>
				</h2>
		  	</div>
		</div>
	</section>

	<section class="content edusec-user-profile" style="min-height: 303px;">
		<div class="col-xs-12">
			<div class="col-lg-3 table-responsive edusec-pf-border no-padding" style="margin-bottom:15px">
				<div class="col-md-12 text-center">
					<?php echo $old_prof?>
					<div class="photo-edit">
						<a class="photo-edit-icon" href="#" title="Change Profile Picture" data-toggle="modal" data-target="#photoup"><i class="fa fa-pencil"></i></a>
					</div>
				</div>
				<table class="table table-striped">
					<tbody>
						<tr>
							<th><?php echo lang("students_student_id_by_written"); ?></th>
							<td><?php echo $person_info->stu_unique_id; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_name"); ?></th>
							<td><?php echo $person_info->stu_last_name.' '.$person_info->stu_middle_name.' '.$person_info->stu_first_name; ?></td>
						</tr>
						<tr>
							<th><?php echo lang('common_name_kh'); ?></th>
							<td><?php echo $person_info->stu_last_name_kh.''.$person_info->stu_middle_name_kh.' '.$person_info->stu_first_name_kh; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("students_course"); ?></th>
							<td><?php echo $course_info->course_name; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("students_batch"); ?></th>
							<td><?php echo $batch_info->batch_name; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_email"); ?></th>
							<td><?php echo $person_info->stu_email_id; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_mobile_no"); ?></th>
							<td><?php echo $person_info->stu_mobile_no; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_created_at"); ?></th>
							<td><?php echo $created_at = $person_info->created_at != "0000-00-00 00:00:00" ? date(get_date_format(), strtotime($person_info->created_at)) : ""; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("students_status"); ?></th>
							<td>
							<?php if ($person_info->is_status == 0) { ?>
								<span class="label label-success">
								<?php echo lang('students_active'); ?>
								</span>
							<?php } else { ?>
								<span class="label label-warning">
								<?php echo lang('students_inactive'); ?>
								</span>
							<?php } ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>


			<div class="col-lg-9 profile-data">
				<ul class="nav nav-tabs responsive hidden-xs-1 hidden-sm-1" id="profileTab">
					<li class="active" id="personal-tab">
						<a href="#personal" data-toggle="tab"><i class="fa fa-street-view"></i> <?php echo lang("students_personal"); ?></a>
					</li>
					<li id="academic-tab">
						<a href="#academic" data-toggle="tab"><i class="fa fa-graduation-cap"></i> <?php echo lang("students_academic"); ?></a>
					</li>
					<li id="guardians-tab">
						<a href="#guardians" data-toggle="tab"><i class="fa fa-user"></i> <?php echo lang("students_guardians"); ?></a>
					</li>
					<li id="address-tab">
						<a href="#address" data-toggle="tab"><i class="fa fa-home"></i> <?php echo lang("students_address"); ?></a>
					</li>
					<li id="transfer-tab">
						<a href="#transfer" data-toggle="tab"><i class="fa fa-folder-open"></i> <?php echo lang("students_transfer"); ?></a>
					</li>
					<li id="job_status-tab">
						<a href="#job_status" data-toggle="tab"><i class="fa fa-user"></i> <?php echo lang("students_job_status"); ?></a>
					</li>					
				</ul>

		 		<div id="content" class="tab-content responsive hidden-xs-1 hidden-sm-1">
					<?php $this->load->view("students/includes/_personal"); ?>
					<?php $this->load->view("students/includes/_academic"); ?>
					<?php $this->load->view("students/includes/_guardians"); ?>
					<?php $this->load->view("students/includes/_address"); ?>
					<?php $this->load->view("students/includes/_documents"); ?>
					<?php $this->load->view("students/includes/_fees"); ?>
					<?php $this->load->view("students/includes/_transfer"); ?>
					<?php $this->load->view("students/includes/_job_status"); ?>
				</div>
				<div class="panel-group responsive visible-xs visible-sm" id="collapse-profileTab">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-profileTab" href="#collapse-personal" aria-expanded="true"><i class="fa fa-street-view"></i> Personal</a>
							</h4>
						</div>
						<div id="collapse-personal" class="panel-collapse collapse in" aria-expanded="true"></div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-profileTab" href="#collapse-academic"><i class="fa fa-graduation-cap"></i> Academic</a>
							</h4>
						</div>
						<div id="collapse-academic" class="panel-collapse collapse"></div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-profileTab" href="#collapse-guardians"><i class="fa fa-user"></i> Guardians</a>
							</h4>
						</div>
						<div id="collapse-guardians" class="panel-collapse collapse"></div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-profileTab" href="#collapse-address"><i class="fa fa-home"></i> Address</a></h4>
						</div>
						<div id="collapse-address" class="panel-collapse collapse"></div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-profileTab" href="#collapse-documents"><i class="fa fa-file-text"></i> Documents</a></h4>
						</div>
						<div id="collapse-documents" class="panel-collapse collapse"></div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-profileTab" href="#collapse-job_status"><i class="fa fa-user"></i> job_status</a></h4>
						</div>
						<div id="collapse-job_status" class="panel-collapse collapse"></div>
					</div>
				</div>
			</div>
     	</div>
	</section>
	<!--  POP UP Window for Photo Upload/Update -->
	<div class="modal fade col-xs-12 col-lg-12" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="photoup">
	  	<div class="modal-dialog">
	    	<div class="modal-content row" style="padding-bottom: 10px">
	    	
									<div class="col-lg-12 profile-data edusec-user-profile">
										<ul class="nav nav-tabs responsive" id="profileTab">
											<li class="active" id="choose-tab">
												<a href="#choose" data-toggle="tab"> Choose Photo</a>
											</li>
											<li id="snap-tab">
												<a href="#snap" data-toggle="tab"> Capture</a>
											</li>
										</ul>

										<div id="content" class="tab-content responsive">
											<?php $this->load->view("students/includes/_choose"); ?>
											<?php $this->load->view("students/includes/_snap"); ?>
										</div>										
									</div>								
								
	  	</div>
	</div>

	<!--  POP UP Window for Guardian -->

	<div id="guardModal" class="fade modal" role="dialog" tabindex="-1">
		<div class="modal-dialog ">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h3>Update Guardian</h3>
				</div>
				<div class="modal-body">

				</div>

			</div>
		</div>
	</div>
	
<script>
/***
  * Start Update Gardian Jquery
***/
function updateGuard(stu_guard_id, sid, tab) {
// 	$.ajax({
// 	  type:'GET',
// 	  url:'/EduSec/index.php?r=student%2Fstu-master%2Fupdate',
// 	  data: { stu_guard_id : stu_guard_id, sid : sid, tab : tab },
// 	  success: function(data)
// 		   {
// 		       $(".modal-content").addClass("row");
// 		       $('.modal-body').html(data);
// 		       $('#guardModal').modal();

// 		   }
// 	});
// }
</script>
    </section>

