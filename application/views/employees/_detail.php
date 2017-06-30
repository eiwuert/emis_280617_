<section class="content" style="min-height: 303px;">
        
	<section class="content-header">
		<div class="col-xs-12">
		  	<div class="col-xs-12">
				<h2 class="page-header">	
						<i class="fa fa-user"></i>  <?php echo lang("employees_profile"); ?>		
					<!-- <div class="pull-right">
						<a id="export-pdf" class="btn-sm btn btn-warning" href="/EduSec/index.php?r=student%2Fexport-data%2Fstudent-profile-pdf&amp;sid=16" target="blank"><i class="fa fa-file-pdf-o"></i> Generate PDF</a>
					</div> -->
				</h2>
		  	</div><!-- /.col -->
		</div>
	</section>

	<section class="content edusec-user-profile" style="min-height: 303px;">
		<div class="col-xs-12">
			<div class="col-lg-3 table-responsive edusec-pf-border no-padding" style="margin-bottom:15px">
				<div class="col-md-12 text-center">
					<?php echo $old_prof?>
					<div class="photo-edit">
						<a class="photo-edit-icon" href="/EduSec/index.php?r=student%2Fstu-master%2Fstu-photo&amp;sid=16" title="Change Profile Picture" data-toggle="modal" data-target="#photoup"><i class="fa fa-pencil"></i></a>
					</div>
				</div>
				<table class="table table-striped">
					<tbody>
						<!-- <tr>
							<th><?php //echo lang("employees_employee_id"); ?></th>
							<td><?php //echo $person_info->emp_unique_id; ?></td>
						</tr> -->
						<tr>
							<th><?php echo lang("common_name"); ?></th>
							<td><?php echo $person_info->last_name.' '.$person_info->first_name; ?></td>
						</tr>
						<tr>
							<th><?php echo lang('common_name_kh'); ?></th>
							<td><?php echo $person_info->last_name_kh.' '.$person_info->first_name_kh; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("employees_faculty"); ?></th>
							<td><?php echo $person_info->emp_department_name; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("employees_designation"); ?></th>
							<td><?php echo $designation_info->designation_name; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_category"); ?></th>
							<td><?php echo $category_info->emp_category_name; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_email"); ?></th>
							<td><?php echo $person_info->email; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_mobile_no"); ?></th>
							<td><?php echo $person_info->phone_number; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_created_at"); ?></th>
							<td><?php echo $created_at = $person_info->created_at != "0000-00-00 00:00:00" ? date_format(date_create(date(get_date_format(), strtotime($person_info->created_at))),"j F, Y") : ""; ?></td>
						</tr>
						<tr>
							<th><?php echo lang("common_status"); ?></th>
							<td>
							<?php if ($person_info->is_status == 0) { ?>
								<span class="label label-success">
								<?php echo lang('common_active'); ?>
								</span>
							<?php } else { ?>
								<span class="label label-warning">
								<?php echo lang('common_inactive'); ?>
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
						<a href="#personal" data-toggle="tab"><i class="fa fa-street-view"></i> <?php echo lang("common_personal"); ?></a>
					</li>
					<li id="academic-tab">
						<a href="#academic" data-toggle="tab"><i class="fa fa-graduation-cap"></i> <?php echo lang("common_academic"); ?></a>
					</li>
					<li id="other-info-tab">
						<a href="#other_info" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo lang("employees_other_info"); ?></a>
					</li>
					<li id="guardians-tab">
						<a href="#guardians" data-toggle="tab"><i class="fa fa-user"></i> <?php echo lang("employees_guardians"); ?></a>
					</li>
					<li id="address-tab">
						<a href="#address" data-toggle="tab"><i class="fa fa-home"></i> <?php echo lang("common_address"); ?></a>
					</li>
					<!-- <li id="documents-tab">
						<a href="#documents" data-toggle="tab"><i class="fa fa-file-text"></i> <?php //echo lang('students_documents'); ?></a>
					</li> -->
					<!-- <li id="fees-tab">
						<a href="#fees" data-toggle="tab"><i class="fa fa-inr"></i> <?php //echo lang('students_fees'); ?></a>
					</li> -->
				</ul>
		 		<div id="content" class="tab-content responsive hidden-xs-1 hidden-sm-1">
					<?php $this->load->view("employees/includes/_personal"); ?>
					<?php $this->load->view("employees/includes/_other_info"); ?>
					<?php $this->load->view("employees/includes/_guardians"); ?>
					<?php $this->load->view("employees/includes/_address"); ?>
					<?php $this->load->view("employees/includes/_documents"); ?>
					<?php $this->load->view("employees/includes/_fees"); ?>
					<?php $this->load->view("employees/includes/_academic"); ?>
				</div>
				<!-- <div class="panel-group responsive visible-xs visible-sm" id="collapse-profileTab">
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
							<h4 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#collapse-profileTab" href="#collapse-fees"><i class="fa fa-inr"></i> Fees</a></h4>
						</div>
						<div id="collapse-fees" class="panel-collapse collapse"></div>
					</div>
				</div> -->
			</div>
     	</div> <!---End Row Div-->
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
							<?php $this->load->view("employees/includes/_choose"); ?>
							<?php $this->load->view("employees/includes/_snap"); ?>
						</div>										
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
	$.ajax({
	  type:'GET',
	  url:'/EduSec/index.php?r=student%2Fstu-master%2Fupdate',
	  data: { stu_guard_id : stu_guard_id, sid : sid, tab : tab },
	  success: function(data)
		   {
		       $(".modal-content").addClass("row");
		       $('.modal-body').html(data);
		       $('#guardModal').modal();

		   }
	});
}
</script>
    </section>