<?php echo $this->load->view("partial/header"); ?>
<div class="main-content-inner">
	<div class=" alert alert-info" id='top'>
		<?php echo create_breadcrumb(); ?>
	</div>
	<div class="page-header" id='page-header'>
		<h1><i class="fa fa-pencil"></i> <?php
		if (!$section_info->section_id) {
			echo lang('academic_year_new');
		} else {
			echo lang('academic_year_update');
		}
		?>
		</h1>
	</div>

	<div class="page-content">
		<div class="row">
			<div class="col-xs-30">
				<div class="widget-box" id="widgets">
					<div class="col-xs-12">
					<?php echo lang('common_fields_required_message'); ?> 
						<div class="widget-box">
							<div class="widget-header widget-header-flat widget-header-small">
								<h5 class="widget-title">
									<span class="icon">
										<i class="fa fa-align-justify"></i>
									</span>
									<?php echo lang("academic_year_basic_information"); ?>
								</h5>
							</div>

							<div class="widget-body" style="margin-left: 13px;">
								<br>
								<?php
								echo form_open($controller_name.'/save/' . $section_info->section_id, array('id' => 'academic_year_form', 'class' => 'form-horizontal'));
								?>
									<div class="form-group required">  
										<?php echo form_label(lang('academic_year_name') . ':', 'section_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
										<div class="col-sm-9 col-md-9 col-lg-5">
											<?php
											echo form_input(array(
												'name' => 'section_name',
												'id' => 'section_name',
												'class' => 'form-control',
												'value' => $section_info->section_name));
											echo form_hidden('original_section_name', $section_info->section_name);
											?>
										</div>
									</div>
									<div class="form-actions">
										<div>
											<a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
										</div>
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.page-content -->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setTimeout(function(){$(":input:visible:first", "#academic_year_form").focus(); }, 100);
        $('#academic_year_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("academic_year/check_duplicate"); ?>', {term: $('#section_name').val()}, function(data) {
        <?php if (!$section_info->section_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('academic_year_duplicate_exists')); ?>))
                    {
                        doAcademicYearSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doAcademicYearSubmit(form);
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
                section_name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('academic_year/section_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(section_name) {
                            return ($(section_name).val() != $('input[name="original_section_name"]').val());
                        }
                    },
                    required:true,
                },
                
            },
            messages:
            {
                section_name:
                {
                    remote: <?php echo json_encode(lang('academic_year_exists')); ?>,
                    required: <?php echo json_encode(lang('academic_year_section_name_required')); ?>,
                },
            }
        });
	});
	var submitting = false;
    function doAcademicYearSubmit(form)
    {
        if (submitting) return;
        submitting = true;

        $.ajax({
            url: $(form).attr("action"),
            type: "post",
            dataType: "json",
            data: $(form).serialize(),
            success: function(response) {
                submitting = false;
                if (response.success)
                {
                    $.notify(response.message, "success");
                    window.location.href = '<?php echo site_url('academic_year'); ?>';
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
        });
    }
</script>
<?php echo $this->load->view("partial/footer"); ?>