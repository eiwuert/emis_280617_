<div class="tab-pane active" id="personal">
	<div class="row">
	  	<div class="col-xs-12">
			<h2 class="page-header">	
			<i class="fa fa-info-circle"></i> <?php echo lang('employees_personal_details'); ?>
				<div class="pull-right">
					<a id="update-emp-personal" class="btn btn-primary btn-sm" href="<?php echo site_url("employees/update_personal/$person_info->person_id"); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo lang("common_edit"); ?></a>
				</div>
			</h2>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_title"); ?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_title; ?></div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_first_name"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->first_name; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_last_name"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->last_name; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_gender'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo ($person_info->gender == 'F')? 'Female': 'Male' ; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_date_of_birth'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo date('j F, Y', strtotime($person_info->dob)); ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_joining_date'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo date('j F, Y', strtotime($person_info->joined_date)); ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_nationality"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $nationality_info->nationality_name; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("employees_faculty"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_department_name; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_designation'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $designation_info->designation_name; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_marital_status"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_maritalstatus; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_total_experience'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->emp_experience_year.' '.lang('common_years').' '.$person_info->emp_experience_month.' '.lang('common_months'); ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('students_admission_category'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $category_info->emp_category_name; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_dept'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->dept_title; ?></div>
		  	</div>
		</div>

	</div> <!---Main Row Div-->
</div>