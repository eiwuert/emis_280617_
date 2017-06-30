<div class="tab-pane" id="address">
	<div class="row">
	  	<div class="col-xs-12">
			<h2 class="page-header address-info">	
				<i class="fa fa-info-circle"></i> <?php echo lang('students_address_info'); ?>	
				<div class="pull-right">
				    <a id="update-stu-address" class="btn btn-primary btn-sm" href="<?php echo site_url("students/update_address/$person_info->stu_info_id"); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo lang('common_edit'); ?></a>
				</div>
			</h2>
	  	</div><!-- /.col -->
	</div>

	<!---Start Current Address Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
			<?php echo lang('common_current_address'); ?></h4>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12  col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_house_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_house_no; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_street_no')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_str_no; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_village')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_village; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_commune')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_commune; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_district')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_district; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_province')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->province_name_cadd; ?></div>
		  	</div>
		</div>

		<div class="col-md-12  col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_country'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $cadd_country_info->country_name?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_phone_number'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_phone_no; ?></div>
		  	</div>
		</div> 
	</div>
	<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
		<?php echo lang('common_current_address').' '.lang('common_kh'); ?></h4>
	<div class="row">
		<div class="col-md-12  col-xs-12">
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_house_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_house_no_kh; ?></div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_street_no')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_str_no_kh; ?></div>
			</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_village')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_village_kh; ?></div>
			</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_commune')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_commune_kh; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_district')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_cadd_district_kh; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_province')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->province_name_kh_cadd; ?></div>
		  	</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang('common_country')?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $cadd_country_info->country_name_kh; ?></div>
		</div>
	</div>

	<!---Start Birth Address Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
			<?php echo lang('common_birth_address'); ?></h4>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_house_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_house_no; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_street_no')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_str_no; ?></div>
		  	</div>
		</div>
		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_village')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_village; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_commune')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_commune; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_district')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_district; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_province')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->province_name_badd; ?></div>
		  	</div>
		</div>
	</div>
	<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
		<?php echo lang('common_birth_address').' '.lang('common_kh'); ?></h4>
	<div class="row">
		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('common_house_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_house_no_kh; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_street_no')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_str_no_kh; ?></div>
		  	</div>
		</div>
		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_village')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_village_kh; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_commune')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_commune_kh; ?></div>
		  	</div>
		</div>
		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_district')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_badd_district_kh; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_province')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->province_name_kh_badd; ?></div>
		  	</div>
		</div>
	</div>
	<!---End Birth Address Block-->

	<!---Start Permenant Address Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
			<?php echo lang('common_permenant_address'); ?>	</h4>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12  col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_house_no"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_house_no; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_street_no')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_str_no; ?></div>
		  	</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_village')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_village; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_commune')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_commune; ?></div>
			</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_district')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_district; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_province')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->province_name_padd; ?></div>
		  	</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang('common_country')?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $padd_country_info->country_name; ?></div>
		</div>
	</div>
	<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
		<?php echo lang('common_permenant_address').' '.lang('common_kh'); ?></h4>
	<div class="row">
		<div class="col-md-12  col-xs-12">
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("common_house_no"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_house_no_kh; ?></div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_street_no')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_str_no_kh; ?></div>
			</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_village')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_village_kh; ?></div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('common_commune')?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_commune_kh; ?></div>
			</div>
		</div>

		<div class="col-md-12 col-xs-12 col-sm-12">
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_district')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->stu_padd_district_kh; ?></div>
			</div>
			<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('common_province')?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $person_info->province_name_kh_padd; ?></div>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang('common_country')?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $padd_country_info->country_name_kh; ?></div>
		</div>
	</div>
</div>