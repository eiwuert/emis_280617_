<div class="tab-pane" id="other_info">
	<div class="row">
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<h2 class="page-header">	
				<i class="fa fa-info-circle"></i> <?php echo lang("employees_other_info"); ?>	<div class="pull-right">
					<a id="update-emp-other-info" class="btn-sm btn btn-primary text-warning" href="<?php echo site_url("$controller_name/update_other_info/$person_info->person_id"); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo lang('common_edit'); ?></a>
				</div>
			</h2>
	  </div><!-- /.col -->
	</div>

	<div class="row">
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang('employees_attendance_card_id'); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_attendance_card_id; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang("employees_bank_account_no"); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_bankaccount_no; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang("employees_mother_name"); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_mother_name; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang('employees_reference'); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_reference; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang("employees_father_name"); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_father_name; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang('employees_reference'); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_reference_father; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang('employees_specialization'); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_specialization; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang('common_languages'); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_languages; ?></div>
	  	</div>
	  	<div class="col-xs-12 col-md-12 col-lg-12 col-md-12 col-lg-12">
			<div class="col-md-4 col-xs-4 edusec-profile-label"><?php echo lang('common_hobbies'); ?></div>
			<div class="col-md-8 col-xs-8 edusec-profile-text"><?php echo $person_info->emp_hobbies; ?></div>
	  	</div>
	</div>
</div>