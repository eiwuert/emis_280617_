<?php echo $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1><i class="fa fa-pencil"></i> <?php
            if (!$school_class_info->school_class_id) {
                echo lang('school_class_new');
            } else {
                echo lang('school_class_update');
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
                                   	<?php echo lang("school_class_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                echo form_open($controller_name.'/save/' . $school_class_info->school_class_id, array('id' => 'school_class_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required">  
                                        <?php echo form_label(lang('school_class_name') . ':', 'school_class_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'school_class_name',
                                                'id' => 'school_class_name',
                                                'class' => 'form-control',
                                                'value' => $school_class_info->school_class_name));
                                            echo form_hidden('original_school_class_name', $school_class_info->school_class_name);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <?php echo form_label(lang('school_class_note') . ':', 'school_class_note', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_textarea(array(
                                                'name' => 'school_class_note',
                                                'id' => 'school_class_note',
                                                'class' => 'form-control',
                                                'value' => $school_class_info->school_class_note));
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
<script type='text/javascript'>
    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#school_class_form").focus(); }, 100);
        $('#school_class_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("school_class/check_duplicate"); ?>', {term: $('#school_class_name').val()}, function(data) {
        <?php if (!$school_class_info->school_class_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('school_class_duplicate_exists')); ?>))
                    {
                        doschool_classSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doschool_classSubmit(form);
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
                school_class_name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('school_class/school_class_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(school_class_name) {
                            return ($(school_class_name).val() != $('input[name="original_school_class_name"]').val());
                        }
                    },
                    required:true,
                },
                
            },
            messages:
            {
                school_class_name:
                {
                    remote: <?php echo json_encode(lang('school_class_duplicate_exists')); ?>,
                    required: <?php echo json_encode(lang('school_class_school_class_name_required')); ?>,
                },
            }
        });
    });
    var submitting = false;
    function doschool_classSubmit(form)
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
                    window.location.href = '<?php echo site_url('school_class'); ?>';
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