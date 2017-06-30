<?php echo $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1><i class="fa fa-pencil"></i> <?php
            if (!$grade_info->grade_id) {
                echo lang('grade_new');
            } else {
                echo lang('grade_update');
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
                                   	<?php echo lang("grade_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                echo form_open($controller_name.'/save/' . $grade_info->grade_id, array('id' => 'grade_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required">  
                                        <?php echo form_label(lang('grade_name') . ':', 'grade_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'grade_name',
                                                'id' => 'grade_name',
                                                'class' => 'form-control',
                                                'value' => $grade_info->grade_name));
                                            echo form_hidden('original_grade_name', $grade_info->grade_name);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <?php echo form_label(lang('grade_note') . ':', 'grade_note', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_textarea(array(
                                                'name' => 'grade_note',
                                                'id' => 'grade_note',
                                                'class' => 'form-control',
                                                'value' => $grade_info->grade_note));
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
        setTimeout(function(){$(":input:visible:first", "#grade_form").focus(); }, 100);
        $('#grade_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("grade/check_duplicate"); ?>', {term: $('#grade_name').val()}, function(data) {
        <?php if (!$grade_info->grade_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('grade_duplicate_exists')); ?>))
                    {
                        doroomSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doroomSubmit(form);
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
                grade_name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('grade/grade_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(grade_name) {
                            return ($(grade_name).val() != $('input[name="original_grade_name"]').val());
                        }
                    },
                    required:true,
                },
                
            },
            messages:
            {
                grade_name:
                {
                    remote: <?php echo json_encode(lang('grade_duplicate_exists')); ?>,
                    required: <?php echo json_encode(lang('grade_grade_name_required')); ?>,
                },
            }
        });
    });
    var submitting = false;
    function doroomSubmit(form)
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
                    window.location.href = '<?php echo site_url('grade'); ?>';
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