<div class="tab-pane" id="academic">
	<div class="row">
	  	<div class="col-xs-12">
			<h2 class="page-header academic-info">	
				<i class="fa fa-info-circle"></i> <?php echo lang('common_academic_info'); ?>	
				<div class="pull-right">
				    <a id="update-stu-academic" class="btn btn-primary btn-sm" href="<?php echo site_url("$controller_name/update_academic/$person_info->person_id"); ?>"><i class="fa fa-pencil-square-o"></i> <?php echo lang('common_edit'); ?></a>
				</div>
			</h2>
	  	</div><!-- /.col -->
	</div>

	<!---Start Skill Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
			<?php echo lang('common_background'); ?>	</h4>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-5 col-sm-5 col-xs-6 edusec-profile-label"><?php echo lang('common_degree'); ?></div>
			<div class="col-md-7 col-sm-7 col-xs-6 edusec-profile-text"><?php echo $person_info->level_name; ?></div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-5 col-sm-5 col-xs-6 edusec-profile-label"><?php echo lang('common_professional_background'); ?></div>
			<div class="col-md-7 col-sm-7 col-xs-6 edusec-profile-text"><?php echo $person_info->skill; ?></div>
		</div> 
	 </div>

	<!---Start Knowledge Teaching Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
			<?php echo lang('common_major_teach'); ?>	</h4>
	  	</div><!-- /.col -->
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang('employees_teach_major'); ?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text">
				<?php if($major_info->num_rows() > 0):?>
					<?php foreach($major_info->result() as $row=>$val){
						echo $val->skill_name.', ';
					} ?>
				<?php endif?>
				&nbsp;
			</div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang('employees_faculty'); ?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text"><?php echo $faculty_info->university_name; ?></div>
		</div>

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="col-md-3 col-sm-3 col-xs-6 edusec-profile-label"><?php echo lang('employees_course'); ?></div>
			<div class="col-md-9 col-sm-9 col-xs-6 edusec-profile-text">
				<?php if($course_info->num_rows() > 0):?>
					<?php foreach($course_info->result() as $row=>$val){
							echo $val->course_name.', ';
					}?>					
				<?php endif?>
				&nbsp;
			</div>
		</div>
	</div>	
</div>