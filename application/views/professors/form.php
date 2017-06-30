<?php echo $this->load->view('partial/header'); ?>
<div class=" alert alert-info" id='top'>
	<?php echo create_breadcrumb(); ?>
</div>
<div class="page-header" id='page-header'>
	<h1 ><i class="fa fa-pencil"></i> 
		<?php
		if (!$person_info->person_id) {
			echo lang('professors_new');
		} else {
			echo lang('professors_update');
		}?>
	</h1>
</div>
<div class="col-xs-12">
<?php echo lang('common_fields_required_message'); ?>
	<div class="widget-box">
		<div class="widget-header widget-header-flat widget-header-small">
			<h5 class="widget-title">
				<span class="icon">
					<i class="fa fa-align-justify"></i>
				</span>
				<?php echo lang("professors_basic_information"); ?>
			</h5>
		</div>

		<div class="widget-body" style="margin-left: 13px;">
			<br>
			<?php
				$current_employee_editing_self = $this->Employee->get_logged_in_employee_info()->person_id == $person_info->person_id;
			?>
			<!-- employee_form -->
			<form class="form-horizontal" id="----employee_form" enctype="multipart/form-data" action="<?php echo site_url("$controller_name/save/$person_info->person_id");?>" method="post">
			
				<div class="form-group required" style="margin-bottom: 10px;">
				<?php echo form_label(lang('professors_id') . ':', 'emp_unique_id',array('class' => $required . ' col-sm-3 col-md-3 col-lg-2 control-label'));?>
				<div class="col-sm-9 col-md-9 col-lg-5">
					<?php
					echo form_input(array(
						'class' => 'form-control',
						'name' => 'emp_unique_id',
						'id' => 'emp_unique_id',
						'class' => 'filter form-control',
						'value' => $person_info->person_id ? $person_info->emp_unique_id : $emp_unique_id,
						)
					);
					?>
				</div>
				</div>
				
				<?php $this->load->view("people/form_basic_info"); ?>

				<div class="form-group" style="margin-bottom: 10px;">
				    <?php
				    echo form_label(lang('common_title') . ':', 'emp_title', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label'));
				    ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php echo form_dropdown('emp_title', $titles, $person_info->emp_title, 'class="form-control" id="emp_title"'); ?>
				    </div>
				</div>
				<div class="form-group" style="margin-bottom: 10px;">
				    <?php
				    	echo form_label(lang('common_department') . ':', 'emp_master_department_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label'));
				    ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php
				        echo form_dropdown('emp_master_department_id', $emp_departments, $person_info->emp_master_department_id, 'class="form-control" id="emp_master_department_id" required');
				        ?>
				    </div>
				</div>
				
				<div class="form-group" style="margin-bottom: 10px;">
	                <?php
	                echo form_label(lang('common_designation') . ':', 'emp_master_designation_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label'));
	                ?>
	                <div class="col-sm-9 col-md-9 col-lg-5">
	                    <?php
	                    echo form_dropdown('emp_master_designation_id', $emp_designations, $person_info->emp_master_designation_id, 'class="form-control" id="emp_master_designation_id"');
	                    ?>
	                </div>
	            </div>
				<div class="form-group" style="margin-bottom: 10px;">
				    <?php
				    echo form_label(lang('common_category') . ':', 'emp_master_category_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label'));
				    ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php
				        echo form_dropdown('emp_master_category_id', $emp_categories, $person_info->emp_master_category_id, 'class="form-control" id="emp_master_category_id"');
				        ?>
				    </div>
				</div>
				<div class="form-group" style="margin-bottom: 10px;">
				    <?php
				    echo form_label(lang('common_marital_status') . ':', 'emp_maritalstatus', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label'));
				    ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php
				        echo form_dropdown('emp_maritalstatus', $emp_maritalstatus, $person_info->emp_maritalstatus, 'class="form-control" id="emp_maritalstatus"');
				        ?>
				    </div>
				</div>
				<div class="form-group" style="margin-bottom: 10px;">
				    <?php
				    echo form_label(lang('common_nationality') . ':', 'emp_master_nationality_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label'));
				    ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php
				        echo form_dropdown('emp_master_nationality_id', $nationality, $person_info->emp_master_nationality_id, 'class="form-control" id="emp_master_nationality_id"');
				        ?>
				    </div>
				</div>
				<div class="form-group" style="margin-bottom: 10px;">
				    <?php
				    echo form_label(lang('common_total_experience') . ':', 'emp_experience_year', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label'));
				    ?>
				    <div class="col-sm-5 col-md-5 col-lg-4">
				        <div class="field-empinfo-emp_experience_year">
				            <?php echo form_dropdown("emp_experience_year", $years, '', 'class="form-control" id="emp_experience_year"'); ?>
				            <p class="help-block help-block-error"></p>
				        </div>
				    </div>
				    <div class="col-sm-4 col-md-4 col-lg-4">
				        <div class="field-empinfo-emp_experience_month">
				            <?php echo form_dropdown("emp_experience_month", $months, '', 'class="form-control" id="emp_experience_month"'); ?>
				            <p class="help-block help-block-error"></p>
				        </div>
				    </div>
				</div>

				<legend class="page-header text-info"> &nbsp; &nbsp; <?php echo lang("employees_emergency_contact"); ?></legend>
				<div class="form-group"> 
				    <?php echo form_label(lang('employees_contact_name') . ':', 'contact_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php
				        echo form_input(array(
				            'name' => 'contact_name',
				            'id' => 'contact_name',
				            'class' => 'form-control',
				            'value' => $person_info->contact_name));
				        ?>
				    </div>
				</div>
				<div class="form-group">  
				    <?php echo form_label(lang('employees_relationship') . ':', 'relationship', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php
				        echo form_input(array(
				            'name' => 'relationship',
				            'id' => 'relationship',
				            'class' => 'form-control',
				            'value' => $person_info->relationship));
				        ?>
				    </div>
				</div>
				<div class="form-group">  
				    <?php echo form_label(lang('employees_contact_number') . ':', 'contact_number', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
				    <div class="col-sm-9 col-md-9 col-lg-5">
				        <?php
				        echo form_input(array(
				            'name' => 'contact_number',
				            'id' => 'contact_number',
				            'class' => 'form-control',
				            'value' => $person_info->contact_number));
				        ?>
				    </div>
				</div>
				<div class="form-group">
					<?php
					echo form_hidden('user_type', 10);
					?>
				</div>
				<legend class="page-header text-info"> &nbsp; &nbsp; <?php echo lang("common_bank_info"); ?></legend>
				<div class="form-group"> 
					<?php echo form_label(lang('common_bank_name') . ':', 'bank_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
					<div class="col-sm-9 col-md-9 col-lg-5">
						<?php
						echo form_input(array(
							'name' => 'bank_name',
							'id' => 'bank_name',
							'class' => 'form-control',
							'value' => $person_info->bank_name));
						?>
					</div>
				</div>
				<div class="form-group"> 
					<?php echo form_label(lang('common_bank_account_no') . ':', 'bank_number', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
					<div class="col-sm-9 col-md-9 col-lg-5">
						<?php
						echo form_input(array(
							'name' => 'bank_number',
							'id' => 'bank_number',
							'class' => 'form-control',
							'value' => $person_info->bank_number));
						?>
					</div>
				</div>
				<?php $this->load->view("people/knowledge"); ?>

				<div class="form-actions">
					<div>
						<?php
							echo form_submit(array(
								'name' => 'submitf',
								'id' => 'submitf',
								'value' => lang('common_submit'),
								'class' => 'btn btn-primary pull-right')
							);
						?>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div><!-- /.widget-box -->
    </div><!-- /.col -->
</div><!-- /.col -->


<script type='text/javascript'>
	$('#image_id').imagePreview({ selector : '#avatar' }); // Custom preview container
	//validation and submit handling
	$(document).ready(function()
	{
		initDatePicker("input[name='emp_dob']")
		initDatePicker("input[name='expired_date']")
		initDatePicker("input[name='joined_date']")

		setTimeout(function(){$(":input:visible:first", "#employee_form").focus(); }, 100);
		$(".module_checkboxes").change(function()
		{
			if ($(this).prop('checked'))
			{
				$(this).parent().find('input[type=checkbox]').not(':disabled').prop('checked', true);
			}
			else
			{
				$(this).parent().find('input[type=checkbox]').not(':disabled').prop('checked', false);
			}
		});
		$('#employee_form').validate({
			submitHandler:function(form)
			{
			$.post('<?php echo site_url("employees/check_duplicate"); ?>', {term: $('#first_name').val() + ' ' + $('#last_name').val()}, function(data) {
			<?php if (!$person_info->person_id) { ?>
				if (data.duplicate)
				{
					if (confirm(<?php echo json_encode(lang('employees_duplicate_exists')); ?>))
					{
						doEmployeeSubmit(form);
					}
					else
					{
						return false;
					}
				}
			<?php } else  ?>
			{
				doEmployeeSubmit(form);
			}}, "json")
					.error(function() {
					});
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
				emp_unique_id:
				{
					required: true
				},
				first_name: "required",
				first_name_kh: "required",
				last_name_kh: "required",
				last_name: "required",
				// majors: "required",
				// emp_master_department_id: "required",
				email:
				{
					remote:
					{
						param:
						{
							url: "<?php echo site_url('employees/exmployee_exists_email'); ?>",
							type: 'post',
						},
						depends: function(email) {
							return ($(email).val() != $('input[name="original_email"]').val());
						}
					},
					required: true,
					email: true
				},
			},
			messages:
			{
				first_name: <?php echo json_encode(lang('common_first_name_required')); ?>,
				last_name: <?php echo json_encode(lang('common_last_name_required')); ?>,
				first_name_kh: <?php echo json_encode(lang('common_first_name_kh_required')); ?>,
				last_name_kh: <?php echo json_encode(lang('common_last_name_kh_required')); ?>,
				emp_unique_id:
				{
					required: <?php echo json_encode(lang('common_ID_required')); ?>
				},
				email: 
				{
					remote: <?php echo json_encode(lang('employees_email_exists')); ?>,
					required: <?php echo json_encode(lang('employees_email_required')); ?>,
					email: <?php echo json_encode(lang('common_email_invalid_format')); ?>,
				},
			}
		});
	});
	var submitting = false;
	function doEmployeeSubmit(form)
	{
		if (submitting) return;
			submitting = true;
			var majors = getSomuSelected('#majors');
			$('input[name="teach_major"]').val(majors);
			var course_ids = getSomuSelected('#course_ids')
			$('input[name="teach_course_ids"]').val(course_ids);
			$(form).ajaxSubmit({
				success: function(response)
				{
					submitting = false;
					if (response.redirect_code == 1 && response.success) {
						if (response.success) {
							$.notify(response.message, "success")
						} else {
							$.notify(response.message, "error")
						}
					} else if (response.redirect_code == 2 && response.success) {
						$.notify('Successfully saved', 'success')
						window.location.href = '<?php echo site_url("$controller_name"); ?>'
					} else if (response.success) {
						$.notify('Successfully saved', 'success')
						window.location.href = '<?php echo site_url("$controller_name"); ?>'
					} else {
						gritter(<?php echo json_encode(lang('common_error')); ?>, response.message, 'gritter-item-error', false, false);
					}
				},
				error: function(response) {
					console.log(response.responseText)
				},
				<?php if (!$person_info->person_id) { ?>
					resetForm: true,
				<?php } ?>
				dataType:'json'
		});
	}

	$(function(){
        $('#emp_master_department_id').on('change',function(){
            $id_department = $(this).val();
           	
        });
    });
</script>

<?php echo $this->load->view('partial/footer'); ?>