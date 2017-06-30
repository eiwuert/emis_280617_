<div class="tab-pane" id="job_status">
	<div class="row">
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<h2 class="page-header">
				<i class="fa fa-info-circle"></i>
					<?php echo lang("students_job_info"); ?>
				<div class="pull-right">
					<button type="button" class="btn btn-info btn-sm studentJobStatus" data-toggle="modal" data-target="#studentJobStatus"><i class="fa fa-plus"></i> 
						<?php echo lang('stu_job_new'); ?>
					</button>
				</div>
			</h2>
		</div><!-- /.col -->
	</div>

	<div class="row job-rows">
		<?php echo $job_info; ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="studentJobStatus" tabindex="-1" role="dialog" aria-labelledby="studentJobLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php echo form_open("$controller_name/save_stu_job_status/", array('id' => 'stu_job_status_form', 'class' => 'form-horizontal1')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="studentJobLabel"><?php echo lang('students_new_job_status'); ?></h4>
			</div>

			<div class="modal-body">
				<div class="row">					
					<div class="form-group required">
						<?php echo form_label(lang('stu_job_cate') . ':', 'job_cate_id', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('job_cate_id', $job_status, '', 'class="form-control" id="job_cate_id"');
							?>
						</div>
					</div>
					<div id="dis_job">
						<div class="form-group required">
							<?php echo form_label(lang('stu_job_position') . ':', 'job_cate_id', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
							<div class="col-sm-8 col-md-8 col-lg-5">
								<?php
									echo form_input('job_position','', 'class="form-control" id="job_position"');
								?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_label(lang('stu_job_name') . ':', 'job_name', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
							<div class="col-sm-8 col-md-8 col-lg-5">
								<?php
								echo form_input('job_name','', 'class="form-control" id="job_name"');
								echo form_hidden('stu_info_id', $person_info->stu_info_id);
								?>
							</div>
						</div>
						<div class="form-group">
							<?php echo form_label(lang('stu_job_local') . ':', 'stu_job_local', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
							<div class="col-sm-8 col-md-8 col-lg-5">
								<?php echo form_dropdown('stu_job_local', $provinces, '', 'class="form-control" id="stu_job_local"');?>
							</div>
						</div>

						<div class="form-group">
							<?php echo form_label(lang('stu_job_desc') . ':', 'stu_job_desc', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
							<div class="col-sm-8 col-md-8 col-lg-5">
								<textarea name="stu_job_desc" class="form-control" id="stu_job_desc"></textarea>
							</div>
						</div>

						<div class="form-group">
							<?php echo form_label(lang('stu_job_date') . ':', 'stu_job_date', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
							<div class="col-sm-8 col-md-8 col-lg-5">
							<span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
								<input type="text" id="stu_job_date" class="form-control hasDatepicker" name="stu_job_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
							</span>
							<div class="errorTxt"></div>
							<br/>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('common_close'); ?></button>
			    <button type="submit" class="btn btn-primary"><?php echo lang('common_save'); ?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<!-- JavaScript -->
<script type="text/javascript">
	$(document).ready(function(){
		initDatePicker("input[name='stu_job_date']");

		$('button.studentJobStatus').click(function(){
			$('form#stu_job_status_form').attr('action', "<?php echo site_url("students/save_stu_job_status")?>");
			var id = $('#job_cate_id').val();
			$('input#job_name').val('');
			$('input#job_position').val('');
			$('select#stu_job_local').val('');
			$('#stu_job_desc').val('');
			$('#stu_job_date').val('');
		});

		$('#job_cate_id').change(function(){
			var id = $(this).val();
			if(id == 1){
				$('#dis_job').hide();
			}else{
				$('#dis_job').show();
			}
		});

		setTimeout(function(){$(":input:visible:first", "#stu_job_status_form").focus(); }, 100);
		$('#stu_job_status_form').validate({
			submitHandler:function(form)
			{
				doJobSubmit(form);
			},
			errorClass: "text-danger",
			errorElement: "span",
			highlight:function(element, errorClass, validClass) {
				$(element).parents('.form-group').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.form-group').removeClass('has-error').addClass('has-success');
			},
			rules:
			{
				job_cate_id: "required",
				// job_name: "required",
				// stu_job_local: "required",
				// stu_job_desc: "required",
				// stu_job_date: "required",
			},
			messages:
			{
				job_cate_id: <?php echo json_encode(lang('stu_unique_id_is_required')); ?>,
				// job_name: <?php echo json_encode(lang('students_university_is_required')); ?>,
				// stu_job_local: <?php echo json_encode(lang('students_major_is_required')); ?>,
				// stu_job_desc: <?php echo json_encode(lang('students_course_is_required')); ?>,
				// stu_job_date: <?php echo json_encode(lang('students_batch_is_required')); ?>,
			}
		});

		$('body').on('click', 'a.update-row-job', function(e){
			e.preventDefault();
			$(this).parents('div.job-row').addClass('focused');
			var url = $(this).data('href'),
			job_id = $(this).data('job-id'),
			stu_job_stu_info_id = $(this).data('stu-job-stu-info-id'),
			stu_job_cate_id = $(this).data('stu-job-cate-id'),
			stu_job_position = $(this).data('stu-job-position'),
			stu_job_name = $(this).data('stu-job-name'),
			stu_job_local_id = $(this).data('stu-job-local-id'),
			stu_job_desc = $(this).data('stu-job-desc'),
			stu_job_date = $(this).data('stu-job-date');

			$('form#stu_job_status_form').attr('action', url);
			$('select#job_cate_id').val(stu_job_cate_id);
			$('input#job_name').val(stu_job_name);
			$('input#job_position').val(stu_job_position);
			$('select#stu_job_local').val(stu_job_local_id);
			$('#stu_job_desc').val(stu_job_desc);
			$('#stu_job_date').val(stu_job_date);	

			if(stu_job_cate_id == '1'){
				$('#dis_job').hide();
			}else{
				$('#dis_job').show();
			}
		});
	});


	var submitting = false;
	function doJobSubmit(form)
	{
		if (submitting) return;
		submitting = true;
		$(form).ajaxSubmit({
			success:function(response)
			{
				submitting = false;
				$.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.stu_job_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
				if (response.success)
				{
					if ($('div.job-row').hasClass('focused')) {
						$('div.job-row.focused').replaceWith(response.job_info);
					} else {
						$('.job-rows').html(response.job_info);
					}
					$('#studentJobStatus').modal('hide');
				}
			},
			error:function(response){console.log(response.responseText)},
			dataType:'json'
		});
	}

</script>