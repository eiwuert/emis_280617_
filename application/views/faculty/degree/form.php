<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
     </div> 
    <div class="page-header" id='page-header'>
        <h1> 
            <i class="fa fa-pencil"></i>
            <?php  if(!$degree_info->level_id) { echo lang($controller_name.'_new'); } else { echo lang($controller_name.'_update'); } ?>
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
                                    <?php echo lang($controller_name.'_new'); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php echo form_open_multipart($controller_name.'/save/' . $degree_info->level_id, array('id' => 'degree_form', 'class' => 'form-horizontal')); ?>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 "><?php echo lang('degree_code'); ?>:</label>    
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <input class="filter form-control" id="level_code" name="level_code" type="text" value="<?php echo $degree_info->level_code; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <label class="required control-label col-sm-3 col-md-3 col-lg-2 "><?php echo lang('degree_name'); ?>:</label>    
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <input class="filter form-control" id="level_name" name="level_name" type="text" value="<?php echo $degree_info->level_name; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="required control-label col-sm-3 col-md-3 col-lg-2 "><?php echo lang('degree_name_kh'); ?>:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <input class="filter form-control" id="level_name_kh" name="level_name_kh" type="text" value="<?php echo $degree_info->level_name_kh; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="required control-label col-sm-3 col-md-3 col-lg-2 "><?php echo lang('degree_duration'); ?>:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <input class="filter form-control" id="level_duration" name="level_duration" type="text" value="<?php echo $degree_info->level_duration; ?>" />
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="required control-label col-sm-3 col-md-3 col-lg-2 "><?php echo lang('common_duration_type'); ?>:</label>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <label class="checkbox-inline">
                                                <?php
                                                $year_check = '';
                                                if (!$degree_info->level_id) {
                                                    $year_check = 'checked="checked"';
                                                } else if ($degree_info->duration_type == 'year') {
                                                    $year_check = 'checked="checked"';
                                                }
                                                ?>
                                                <input type="radio" name="duration_type" id="inlineRadio1" value="year" <?php echo $year_check; ?>> <?php echo lang('common_year'); ?> 
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="duration_type" id="inlineRadio1" value="month" <?php echo $degree_info->duration_type == "month" ? 'checked="checked"' : ''; ?>> <?php echo lang('common_month'); ?> 
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="duration_type" id="inlineRadio1" value="week" <?php echo $degree_info->duration_type == "week" ? 'checked="checked"' : ''; ?>> <?php echo lang('common_week'); ?>
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="duration_type" id="inlineRadio1" value="day" <?php echo $degree_info->duration_type == "day" ? 'checked="checked"' : ''; ?>> <?php echo lang('common_day'); ?>
                                            </label>
                                        </div>
                                    </div>
            
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name");?>"><?php echo lang('common_cancel'); ?></a>
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
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    });
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#degree_form").focus(); }, 100);
        $('#degree_form').validate({
            submitHandler:function(form)
            {
                $.post('<?php echo site_url("$controller_name/check_duplicate"); ?>', {term: $('#level_name').val()}, function(data) {
                    <?php if (!$degree_info->level_id) { ?>
                    if (data.duplicate)
                    {
                        if (confirm(<?php echo json_encode(lang('university_duplicate_exists')); ?>))
                        {
                            doDegreeSubmit(form);
                        }
                        else
                        {
                            return false;
                        }
                    }
            <?php } else  ?>
                {
                    doDegreeSubmit(form);
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
                level_name:"required",
            },
            messages:
            {
                level_name:<?php echo json_encode(lang('degree_name_required')); ?>,
            }
        });
    });
    var submitting = false;
    function doDegreeSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.level_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            <?php if (!$degree_info->level_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>