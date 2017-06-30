<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
            <i class="fa fa-pencil"></i>
            <?php  if(!$dept_info->dept_id) { echo lang('dept_new'); } else { echo lang('dept_update'); } ?>
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
                                    <?php echo lang('dept_new'); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                            <br/>
                                <?php echo form_open_multipart($controller_name.'/save/' . $dept_info->dept_id, array('id' => 'dept_form', 'class' => 'form-horizontal')); ?>
                                <div class="form-group required" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="dept_title"><?php echo lang('dept_title'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <input class="filter form-control" name="dept_title" id="dept_title" type="text" value="<?php echo $dept_info->dept_title; ?>" />
                                    </div>
                                </div>

                                <div class="form-group required" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="dept_title_kh"><?php echo lang('dept_title_kh')?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <input class="filter form-control" name="dept_title_kh" id="dept_title_kh" type="text" value="<?php echo $dept_info->dept_title_kh; ?>" />
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <div>
                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name")?>"><?php echo lang('common_cancel'); ?></a>
                                    </div>
                                    <div>
                                        <input type="submit" name="submit" value="<?php echo lang('common_save'); ?>" id="submit" class="btn btn-primary pull-right">
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.page-content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    });
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#dept_form").focus(); }, 100);
        $('#dept_form').validate({
            submitHandler:function(form)
            {
                doSubmit(form);
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
                dept_title: "required",
                dept_title_kh: "required",                
            },
            messages:
            {
                dept_title: <?php echo json_encode(lang('dept_title_required')); ?>,
                dept_title_kh: <?php echo json_encode(lang('dept_title_kh_required')); ?>
            }
        });
    });
    var submitting = false;
    function doSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.dept_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            <?php if (!$dept_info->dept_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>