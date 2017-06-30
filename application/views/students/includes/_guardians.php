<div class="tab-pane" id="guardians">
	<div class="row">
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<h2 class="page-header">	
			<i class="fa fa-info-circle"></i> <?php echo lang('students_guardians_details'); ?>
				<div class="pull-right">
					<a style="padding:3px 10px" id="update-guard-data" class="btn-sm btn btn-primary text-warning" href="<?php echo site_url("students/add_guardians/$person_info->stu_info_id/-1"); ?>"><i class="fa fa-user"></i> <?php echo lang('students_add_guardian'); ?></a>
				</div>
			</h2>
	  	</div><!-- /.col -->
	</div>
	
	<?php echo $manage_table_guardian ?>	
	
</div>