<div class="tab-pane" id="guardians">
	<div class="row">
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<h2 class="page-header">	
			<i class="fa fa-info-circle"></i> <?php echo lang('employees_guardians_details'); ?><div class="pull-right">
					<a id="update-guard-data" class="btn-sm btn btn-primary text-warning" href="<?php echo site_url("$controller_name/edit_guardian/$person_info->person_id"); ?>"><i class="fa fa-user"></i> <?php echo lang('common_edit'); ?></a>
				</div>
			</h2>
	  	</div><!-- /.col -->
	</div>

	<?php if ($person_info->emp_guardian_name): ?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_full_name"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_name; ?></div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_qualification"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_qualification; ?></div>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12">
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_relation"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_relation; ?></div>
			  	</div>
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_occupation"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_occupation; ?></div>
			  	</div>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12">
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_total_income"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_income; ?></div>
			  	</div>
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_mobile_no"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_mobile_no; ?></div>
			  	</div>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12">
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_phone_number"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_phone_no; ?></div>
			  	</div>
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_email"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_email_id; ?></div>
			  	</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_office_address"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_officeadd; ?></div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_home_address"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_homeadd; ?></div>
			</div>
		</div>
	<?php else: ?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_full_name"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_name; ?></div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_qualification"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_qualification; ?></div>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12">
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_relation"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_relation; ?></div>
			  	</div>
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_occupation"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_occupation; ?></div>
			  	</div>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12">
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_total_income"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_income; ?></div>
			  	</div>
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_mobile_no"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_mobile_no; ?></div>
			  	</div>
			</div>

			<div class="col-md-12 col-xs-12 col-sm-12">
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_phone_number"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_phone_no; ?></div>
			  	</div>
			  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
					<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_email"); ?></div>
					<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_email_id; ?></div>
			  	</div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_office_address"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_officeadd; ?></div>
			</div>

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_home_address"); ?></div>
				<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_guardian_homeadd; ?></div>
			</div>
		</div>

		<table width="100%" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover table-responsive">
			<tbody>
				<tr>
					<th class="table-cell-title text-center" colspan="4"><?php echo lang('students_no_data_available'); ?></th>
				</tr>
			</tbody>
		</table>
	<?php endif ?>

</div>