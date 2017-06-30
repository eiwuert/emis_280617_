<div class="tab-pane" id="address">
	<div class="row">
	  	<div class="col-xs-12">
			<h2 class="page-header address-info">	
				<i class="fa fa-info-circle"></i> <?php echo lang('common_address_info'); ?>	
				<div class="pull-right">
				    <a id="update-emp-address" class="btn btn-primary btn-sm" href="<?php echo site_url("$controller_name/update_address/$person_info->person_id"); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo lang('common_edit'); ?></a>
				</div>
			</h2>
	  	</div><!-- /.col -->
	</div>

	<!---Start Current Address Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
			<?php echo lang('common_current_address'); ?>	</h4>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12 col-xs-12 col-sm-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_house_no'); ?></div>
				<div class="col-md-6 col-sm-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_cadd_house_no?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-md-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_street_no'); ?></div>
				<div class="col-md-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_cadd_street_no?></div>
		  	</div>
		</div>

		<div class="col-md-12  col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_district'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_cadd_district?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_commune'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_cadd_commune; ?></div>
		  	</div>
		</div>

		<div class="col-md-12  col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_province'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $cadd_province_info->row()->province_name; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_phone_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_cadd_phone_no; ?></div>
		  	</div>
		</div> 
	 </div>

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
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_house_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_padd_house_no?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_street_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_padd_street_no?></div>
		  	</div>
		</div>

		<div class="col-md-12  col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_district'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_padd_district?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang("employees_commune"); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_padd_commune; ?></div>
		  	</div>
		</div>

		<div class="col-md-12  col-xs-12">
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_province'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $padd_province_info->row()->province_name; ?></div>
		  	</div>
		  	<div class="col-lg-6 col-sm-6 col-xs-12 no-padding">
				<div class="col-lg-6 col-xs-6 edusec-profile-label"><?php echo lang('employees_phone_no'); ?></div>
				<div class="col-lg-6 col-xs-6 edusec-profile-text"><?php echo $address_info->emp_padd_phone_no; ?></div>
		  	</div>
		</div>
	</div>	
</div>