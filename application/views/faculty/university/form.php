<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
            <i class="fa fa-pencil"></i>
            <?php  if(!$uni_info->university_id) { echo lang($controller_name.'_new'); } else { echo lang($controller_name.'_update'); } ?>
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
                            <br/>
                                <?php echo form_open_multipart($controller_name.'/save/' . $uni_info->university_id, array('id' => 'faculty_form', 'class' => 'form-horizontal')); ?>
                                <div class="form-group required" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="university_name"><?php echo lang('faculty_name'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <input class="filter form-control" name="university_name" id="university_name" type="text" value="<?php echo $uni_info->university_name; ?>" />
                                    </div>
                                </div>

                                <div class="form-group required" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="university_name_kh"><?php echo lang('faculty_name').' '.lang('common_kh'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <input class="filter form-control" name="university_name_kh" id="university_name_kh" type="text" value="<?php echo $uni_info->university_name_kh; ?>" />
                                    </div>
                                </div>

                                <div class="form-group required" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="short word">Short word:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <input class="filter form-control" name="university_name_short_word" id="university_name_short_word" type="text" value="<?php echo $uni_info->university_name_short_word; ?>" />
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="university_code"><?php echo lang('university_code'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <input class="filter form-control" name="university_code" id="university_code" type="text" maxlength="2" value="<?php echo $uni_info->university_code; ?>" />
                                    </div>
                                </div>

                                <div class="form-group required" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3" for="faculty_dean"><?php echo lang('university_faculty_dean'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <?php
                                        echo form_dropdown(
                                            'faculty_dean',
                                            $faculty_dean,
                                            $uni_info->university_dean_id,
                                            'class="form-control" id="faculty_dean"'
                                        );
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3" for="created_at"><?php echo lang('university_create_date'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                            <input type="text" id="created_at" class="form-control hasDatepicker" name="created_at" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $uni_info->created_at != "" ? date('d-m-Y', strtotime($uni_info->created_at)) : date('d-m-Y'); ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3" for="updated_at"><?php echo lang('university_modified_date'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                            <input type="text" id="updated_at" class="form-control hasDatepicker" name="updated_at" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $uni_info->updated_at != "" ? date('d-m-Y', strtotime($uni_info->updated_at)) : ""; ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group required" style="margin-bottom: 10px;">
                                    <label class="control-label col-sm-3 col-md-3 col-lg-3" for="card_color_type"><?php echo lang('card_color_type'); ?>:</label>
                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                        <?php echo form_dropdown('card_color_type',$card_color_type,$uni_info->card_color_type,'class="form-control" id="card_color_type"');
                                        ?>
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
        initDatePicker("#created_at");
        initDatePicker("#updated_at");
        setTimeout(function(){$(":input:visible:first", "#faculty_form").focus(); }, 100);
        $('#faculty_form').validate({
            submitHandler:function(form)
            {
                $.post('<?php echo site_url("$controller_name/check_duplicate"); ?>', {term: $('#university_name').val()}, function(data) {
                    <?php if (!$uni_info->university_id) { ?>
                    if (data.duplicate)
                    {
                        if (confirm(<?php echo json_encode(lang('university_duplicate_exists')); ?>))
                        {
                            doFacultySubmit(form);
                        }
                        else
                        {
                            return false;
                        }
                    }
            <?php } else  ?>
                {
                    doFacultySubmit(form);
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
                university_name: "required",
                university_code: "required",
                academic_year: "required",
                university_name_kh: "required",
                card_color_type: "required",
                university_name_short_word: "required",
            },
            messages:
            {
                university_name: <?php echo json_encode(lang('university_name_required')); ?>,
                university_name_kh: <?php echo json_encode(lang('university_name_kh_required')); ?>,
                // faculty_dean: <?php echo json_encode(lang('university_faculty_dean_required')); ?>,
                academic_year: <?php echo json_encode(lang('university_academic_year_required')); ?>,
                card_color_type: <?php echo json_encode(lang('card_color_type_required')); ?>,
                university_name_short_word: <?php echo json_encode(lang('university_short_word_required')); ?>,
                university_code: <?php echo json_encode(lang('university_code_required')); ?>,
            }
        });
    });
    var submitting = false;
    function doFacultySubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.university_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            <?php if (!$uni_info->university_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>