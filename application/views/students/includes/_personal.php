<div class="tab-pane active" id="personal">
	<div class="row">
	  	<div class="col-xs-12">
			<h2 class="page-header">
			<i class="fa fa-info-circle"></i> <?php echo lang('students_personal_details'); ?>
				<div class="pull-right">
					<a id="update-stu-personal" class="btn btn-primary btn-sm" href="<?php echo site_url("students/update_personal/$person_info->stu_info_id"); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo lang("common_edit"); ?></a>
				</div>
			</h2>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang("common_title"); ?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_title; ?></div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_first_name"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_last_name; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-7 col-xs-6 edusec-profile-label"><?php echo lang("common_last_name"); ?></div>
				<div class="col-lg-5 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_first_name; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">		  	
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('students_admission_category'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $category_info->stu_category_name; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-7 col-xs-6 edusec-profile-label"><?php echo lang('common_gender'); ?></div>
				<div class="col-lg-5 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_gender; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_date_of_birth'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo date(get_date_format(), strtotime($person_info->stu_dob)); ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-7 col-xs-6 edusec-profile-label"><?php echo lang("common_nationality"); ?></div>
				<div class="col-lg-5 col-xs-6 edusec-profile-text"><?php echo $nationality_info->nationality_name; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding edusec-bg-row">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_card_number"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_card_number; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-7 col-xs-6 edusec-profile-label"><?php echo lang("students_is_scholarship"); ?></div>
				<div class="col-lg-5 col-xs-6 edusec-profile-text"><?php echo $person_info->is_scholarship ? lang('students_scholarship') : lang('students_full_pay'); ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('students_high_school'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_high_school; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-7 col-xs-6 edusec-profile-label"><?php echo lang('students_high_school_exam_year'); ?></div>
				<div class="col-lg-5 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_exam_hschool; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('students_is_graduated'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->is_graduated ? lang('students_graduated') : lang('students_under_graduated'); ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-7 col-xs-7 edusec-profile-label"><?php echo lang('students_certificate_id_hschool'); ?></div>
				<div class="col-lg-5 col-xs-5 edusec-profile-text"><?php echo $person_info->stu_certificate_id_hschool; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-6 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_refer_in_from'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->refer_in_from; ?></div>
		  	</div>

			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-7 col-xs-6 edusec-profile-label"><?php echo lang("common_emergency_contact_phone"); ?></div>
				<div class="col-lg-5 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_emergency_contact; ?></div>
		  	</div>
		</div>
	</div> <!---Main Row Div-->
</div>