<div class="tab-pane" id="academic">
	<div class="row">
	  	<div class="col-xs-12 col-md-12 col-lg-12">
			<h2 class="page-header">
				<i class="fa fa-info-circle"></i><?php echo lang("students_academic_details"); ?>	<div class="pull-right">
					<button type="button" class="btn btn-info btn-sm studentAcedmic" data-toggle="modal" data-target="#studentAcedmic"><i class="fa fa-plus"></i> 
						<?php echo lang('students_new_academic'); ?>
					</button>
				</div>
			</h2>
		</div><!-- /.col -->
	</div>

	<div class="row academic-rows">
		<?php echo $items_academic; ?>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="studentAcedmic" tabindex="-1" role="dialog" aria-labelledby="studentAcedmicLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<?php echo form_open("$controller_name/save_stu_academic/", array('id' => 'stu_academic_form', 'class' => 'form-horizontal1')); ?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="studentAcedmicLabel"><?php echo lang('students_new_academic'); ?></h4>
			</div>

			<?php echo ($row->stu_acad_id)? $num_acad_id_card : '' ?>

			<div class="modal-body">
				<div class="row">
					<div class="form-group required disp_num_acad_card">
						<?php echo form_label(lang('common_num_acad_card') . ':', 'num_acad_card', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_input('num_acad_card','', 'class="form-control num_acad_card" id="num_acad_card" readonly');
							?>
						</div>
					</div>
					<div class="form-group required disp_stu_unique_id">
						<?php echo form_label(lang('common_num_written') . ':', 'stu_unique_id', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_input('stu_unique_id','', 'class="form-control stu_unique_id" id="stu_unique_id"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_university') . ':', 'university', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('university', $universities, '', 'class="form-control" id="university"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_major') . ':', 'majors', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('majors', $major, '', 'class="form-control" id="majors"');
							echo form_hidden('stu_info_id', $person_info->stu_info_id);
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_course') . ':', 'course_ids', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('course_ids', $courses, '', 'class="form-control" id="course_ids"');
							?>
						</div>
					</div>

					<div class="form-group required">
						<?php echo form_label(lang('common_batch') . ':', 'batch', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('batch', $batches, '', 'class="form-control" id="batch"');
							?>
						</div>
					</div>

					<div class="form-group required">
						<?php echo form_label(lang('common_grade') . ':', 'grade', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('grade', $grade, '', 'class="form-control" id="grade"');
							?>
						</div>
					</div>

					<div class="form-group required">
						<?php echo form_label(lang('common_section') . ':', 'section', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('section', $section, '', 'class="form-control" id="section"');
							?>
						</div>
					</div>

					<div class="form-group required">
						<?php echo form_label(lang('common_degree') . ':', 'degree', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('degree', $levels, '', 'class="form-control" id="degree"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_schedule') . ':', 'schedule', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('schedule', $stu_schedule, '', 'class="form-control" id="schedule"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_status') . ':', 'acad_status', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('acad_status', $stu_status, '', 'class="form-control" id="acad_status"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_scholarship') . ':', 'acad_room', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('stu_scholarship', $stu_scholarship, '', 'class="form-control" id="scholarship"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_room') . ':', 'room', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('acad_room', $stu_room, '', 'class="form-control" id="acad_room"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('common_class') . ':', 'acad_status', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<?php
							echo form_dropdown('acad_class', $stu_class, '', 'class="form-control" id="acad_class"');
							?>
						</div>
					</div>
					<div class="form-group required">
						<?php echo form_label(lang('students_admission_date') . ':', 'admission_date', array('class' => 'control-label col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
							<span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
								<input type="text" id="admission_date" class="form-control hasDatepicker" name="admission_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
								<span class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</span>
							</span>
							<div class="errorTxt"></div>
							<br/>
						</div>
					</div>
					<div class="form-group">
						<?php echo form_label(lang('students_completion_date') . ':', 'completion_date', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
						<div class="col-sm-8 col-md-8 col-lg-5">
						<span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
							<input type="text" id="completion_date" class="form-control hasDatepicker" name="completion_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
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
		initDatePicker("input[name='admission_date']");
		initDatePicker("input[name='completion_date']");

		$('.studentAcedmic').click(function(){
			// var url = $(this).data('');
			$('#num_acad_card').val("<?php echo $num_acad_id_card?>");
			$('form#stu_academic_form').attr('action','<?php echo site_url("students/save_stu_academic")?>');
			$('input#stu_unique_id').val('');
			$('select#university').val('');
			$('select#majors').val('');
			$('select#course_ids').val('');
			$('select#batch').val('');
			$('select#grade').val('');
			$('select#section').val('');
			$('select#degree').val('');
			$('select#schedule').val('');
			$('select#acad_status').val('');
			$('select#stu_scholarship').val('');
			$('select#acad_room').val('');
			$('select#acad_class').val('');
			$('input[name="admission_date"]').val('');
			$('input[name="completion_date"]').val('');			
		});

		$('body').on('change', '#university', function() {	
			var ucity_id = $('#university :selected').val();
			url = "<?php echo site_url('students/suggest_major')?>";
			$.ajax({
				url: url,
				type: 'POST',
				data: {faculty_id: ucity_id},
				dataType: "json",
				success: function(result) {
					$('#majors').html('');
                    $.each(result,function(key,val){
                        var opt = $('<option />'); 
                        opt.val(val.skill_id);
                        opt.text(val.skill_name + '('+val.skill_name_kh+')');
                        $('#majors').append(opt);
                    });
                    $('#course_ids').html('');
				}
				,error: function(res){console.log(res.responseText)}
			});
			
		});

		$('body').on('change', '#majors', function(e) {
			e.preventDefault();
			var val = $(this).val();
			url = "<?php echo site_url('students/get_major_course')?>";

			$.ajax({
				url: url,
				type: 'POST',
				data: {major_id: val},
				dataType: 'json',
				success: function(result) {
					$('#course_ids').html(result.courses);
				}
				,error: function(res){console.log(res.responseText)}
			});
		});

		initDatePicker("#created_at");
		initDatePicker("#updated_at");
		setTimeout(function(){$(":input:visible:first", "#stu_academic_form").focus(); }, 100);
		$('#stu_academic_form').validate({
			submitHandler:function(form)
			{
				doAcademicSubmit(form);
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
				stu_unique_id: "required",
				university: "required",
				majors: "required",
				course_ids: "required",
				batch: "required",
				section: "required",
				admission_date: "required",
				degree: "required",
				schedule: "required",
				acad_status: "required",
				acad_room: "required",
				acad_class: "required",
				completion_date: "required",
			},
			messages:
			{
				stu_unique_id: <?php echo json_encode(lang('stu_unique_id_is_required')); ?>,
				university: <?php echo json_encode(lang('students_university_is_required')); ?>,
				majors: <?php echo json_encode(lang('students_major_is_required')); ?>,
				course_ids: <?php echo json_encode(lang('students_course_is_required')); ?>,
				batch: <?php echo json_encode(lang('students_batch_is_required')); ?>,
				section: <?php echo json_encode(lang('students_section_is_required')); ?>,
				admission_date: <?php echo json_encode(lang('students_addmission_date_is_required')); ?>,
				degree: <?php echo json_encode(lang('students_degree_is_required')); ?>,
				schedule: <?php echo json_encode(lang('students_schedule_is_required')); ?>,
				acad_status: <?php echo json_encode(lang('students_acad_status_is_required')); ?>,
				acad_status: <?php echo json_encode(lang('students_acad_room_is_required')); ?>,
				acad_status: <?php echo json_encode(lang('students_acad_class_is_required')); ?>,
				completion_date: <?php echo json_encode(lang('students_completion_date_is_required')); ?>,
			}
		});
		$('body').on('click', 'a.update-row-academic', function(e){
			e.preventDefault();
			$(this).parents('div.academic-row').addClass('focused');
			var url = $(this).data('href'),
			unique_card_id = $(this).data('acad-unique-id'),
			acad_card_id = $(this).data('acad-card'),
			university_id = $(this).data('university'),
			major_id = $(this).data('major'),
			course_id = $(this).data('course'),
			batch_id = $(this).data('batch'),
			grade = $(this).data('grade'),
			section_id = $(this).data('section'),
			degree_id = $(this).data('degree'),
			schedule_id = $(this).data('schedule'),
			acad_status = $(this).data('acad-status'),
			scholarship = $(this).data('scholarship'),
			acad_room = $(this).data('acad-room'),
			acad_class = $(this).data('acad-class'),
			admission_date = $(this).data('admission-date'),
			completion_date = $(this).data('completion-date');

			$('form#stu_academic_form').attr('action', url);
			$('input#stu_unique_id').val(acad_card_id);
			$('input#num_acad_card').val(unique_card_id);
			$('select#university').val(university_id);
			$('select#majors').val(major_id);
			$('select#course_ids').val(course_id);
			$('select#batch').val(batch_id);
			$('select#grade').val(grade);
			$('select#section').val(section_id);
			$('select#degree').val(degree_id);
			$('select#schedule').val(schedule_id);
			$('select#acad_status').val(acad_status);
			$('select#scholarship').val(scholarship);
			$('select#acad_room').val(acad_room);
			$('select#acad_class').val(acad_class);
			$('input[name="admission_date"]').val(admission_date);
			$('input[name="completion_date"]').val(completion_date);
		});
	});


	var submitting = false;
	function doAcademicSubmit(form)
	{
		if (submitting) return;
		submitting = true;
		$(form).ajaxSubmit({
			success:function(response)
			{


				submitting = false;
				$.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.stu_acad_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
				if (response.success)
				{
					if ($('div.academic-row').hasClass('focused')) {
						$('div.academic-row.focused').replaceWith(response.items_academic);
					} else {
						$('.academic-rows').after(response.items_academic);
					}
					$('#studentAcedmic').modal('hide');
				}
			},
			error:function(response){console.log(response.responseText)},
			dataType:'json'
		});
	}



</script>