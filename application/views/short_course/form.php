<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
            <?php
            if (!$courses_info->id) {
                echo lang('courses_new');
            } else {
                echo lang('courses_update');
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
                                    <?php echo lang("courses_basic_information"); ?>
                                </h5>
                            </div>
                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                    echo form_open($controller_name.'/save/' . $courses_info->id, array('id' => 'courses_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_title') . ':', 'title', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'title',
                                                'id' => 'title',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $courses_info->courses_title));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('courses_venue') . ':', 'venue', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'venue',
                                                'id' => 'venue',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $courses_info->courses_venue));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_date_from') . ':', 'date_from', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <span class="input-group date " data-date-format="dd-mm-yyyy">
                                                <input type="text" id="date_from" class="form-control hasDatepicker" name="date_from" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php  echo $date = $courses_info->courses_date_from != "" ? date('d-m-Y', strtotime($courses_info->courses_date_from)) : ""; ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                            <div class="help-block"></div>
                                        </div>   
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_date_to') . ':', 'date_to', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <span class="input-group date " data-date-format="dd-mm-yyyy">
                                                <input type="text" id="date_to" class="form-control hasDatepicker" name="date_to" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php  echo $date = $courses_info->courses_date_to != "" ? date('d-m-Y', strtotime($courses_info->courses_date_to)) : ""; ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                            <div class="help-block"></div>
                                        </div>   
                                    </div> 

                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('courses_orgainized') . ':', 'orgainized', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'orgainized',
                                                'id' => 'orgainized',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $courses_info->courses_orgainized));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('courses_male_participants') . ':', 'male_participants', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'male_participants',
                                                'id' => 'male_participants',
                                                'type' => 'number',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $courses_info->courses_male_participants));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('courses_female_participants') . ':', 'female_participants', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'female_participants',
                                                'id' => 'female_participants',
                                                'type' => 'number',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $courses_info->courses_female_participants));
                                            ?>
                                        </div>
                                    </div>
         
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?php echo site_url("$controller_name")?>"><?php echo lang('common_cancel'); ?></a>
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
        </div>
    </div><!-- /.page-content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        initDatePicker("input[name='date_from']"); 
        initDatePicker("input[name='date_to']"); 
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){$(":input:visible:first", "#courses_form").focus(); }, 100);
        $('#courses_form').validate({
            submitHandler:function(form)
            {
                doCoursesSubmit(form);
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
                title:"required",
                venue:"required", 
                date_from:"required",
                date_to:"required",
                orgainized:"required",
                male_participants:"required",
                female_participants:"required",
            },
            messages:
            {
                title:<?php echo json_encode(lang('courses_title_required')); ?>,
                venue:<?php echo json_encode(lang('courses_venue_required')); ?>, 
                date_from:<?php echo json_encode(lang('courses_date_from_required')); ?>, 
                date_to:<?php echo json_encode(lang('courses_date_to_required')); ?>,
                orgainized:<?php echo json_encode(lang('courses_orgainized_required')); ?>,
                male_participants:<?php echo json_encode(lang('courses_male_participants_required')); ?>,
                female_participants:<?php echo json_encode(lang('courses_female_participants_required')); ?>,
            }
        });
    });
    var submitting = false;
    function doCoursesSubmit(form)
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
                    window.location.href = '<?php echo site_url('short_course'); ?>';
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>