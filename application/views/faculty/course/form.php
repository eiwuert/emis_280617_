<?php $this->load->view("partial/header"); ?>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
        <?php
        if (!$course_info->course_id) {
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
                                    <?php echo lang("course_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php echo form_open($controller_name.'/save/' . $course_info->course_id, array('id' => 'course_form', 'class' => 'form-horizontal'));?>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_code') . ':', 'course_code', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'course_code',
                                                'id' => 'course_code',
                                                'class' => 'form-control',
                                                'value' => $course_info->course_code));
                                            echo form_hidden('original_course_code', $course_info->course_code);
                                            ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_year') . ':', 'course_code', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php echo form_dropdown('course_schedule_year', $year, $course_info->course_schedule_year,'class="form-control" id="course_schedule_year"'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_name') . ':', 'course_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'course_name',
                                                'id' => 'course_name',
                                                'class' => 'form-control',
                                                'value' => $course_info->course_name));
                                            ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_semester') . ':', 'course_schedule_semester', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php echo form_dropdown('course_schedule_semester', $semester, $course_info->course_schedule_semester,'class="form-control" id="course_schedule_semester"'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_name_kh') . ':', 'course_name_kh', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'course_name_kh',
                                                'id' => 'course_name_kh',
                                                'class' => 'form-control',
                                                'value' => $course_info->course_name_kh));
                                            ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_promote') . ':', 'course_schedule_promote', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php echo form_dropdown('course_schedule_promote', $batch, $course_info->course_schedule_promote,'class="form-control" id="course_schedule_promote"'); ?>
                                        </div> 
                                    </div>

                                
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_faculty') . ':', 'faculty', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_dropdown(
                                                'faculty',
                                                $faculty,
                                                $course_info->university_id,                                                
                                                'class="form-control" id="faculty"'
                                            ); ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_date_today') . ':', 'course_schedule_date_today', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="course_schedule_date_today" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $course_info->course_schedule_date_today?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_major') . ':', 'course_major', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_dropdown('major',$major, $course_info->skill_major_id,'class="form-control" id="major"'
                                            ); ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_adjust_date') . ':', 'course_schedule_adjust_date', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="course_schedule_adjust_date" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $course_info->course_schedule_adjust_date?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_degree') . ':', 'degree', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_dropdown(
                                                'degree',
                                                $degree,
                                                $course_info->level_id,
                                                'class="form-control" id="degree"'
                                            ); ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_midterm') . ':', 'course_schedule_midterm', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="course_schedule_midterm" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $course_info->course_schedule_midterm?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_credit') . ':', 'credit', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'credit',
                                                'id' => 'credit',
                                                'class' => 'form-control',
                                                'value' => $course_info->credit));
                                            ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_enddate') . ':', 'course_schedule_enddate', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="course_schedule_enddate" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $course_info->course_schedule_enddate?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_coordinator') . ':', 'course_coordinator', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_dropdown(
                                                'course_coordinator',
                                                $coordinators,
                                                $course_info->course_coordinator_id,
                                                'class="form-control" id="course_coordinator"'
                                            ); ?>
                                        </div>

                                        <?php echo form_label(lang('course_schedule_final_from') . ':', 'course_schedule_final_from', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="course_schedule_final_from" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $course_info->course_schedule_final_from?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_academic_year') . ':', 'academic_year', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_dropdown(
                                                'academic_year',
                                                $academic_year,
                                                $course_info->academic_year_id,
                                                'class="form-control" id="academic_year"'
                                            ); ?>
                                        </div>


                                        <?php echo form_label(lang('course_schedule_final_to') . ':', 'course_schedule_final_to', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="course_schedule_final_to" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $course_info->course_schedule_final_to?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('course_duration') . ':', 'duration', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'duration',
                                                'id' => 'duration',
                                                'class' => 'form-control',
                                                'readonly' => true,
                                                'value' => $course_info->duration));
                                            ?>
                                        </div>

                                        <?php echo form_label(lang('course_faculty_date') . ':', 'course_faculty_date', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="course_faculty_date" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $course_info->course_faculty_date?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label('Room:', 'Room', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                           <?php echo form_dropdown('room', $room, $course_info->room_id,'class="form-control" id="room"'); ?>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="<?php echo lang('common_save'); ?>" id="submit" class="btn btn-primary pull-right">
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){   
            initDatePicker("input[name='course_schedule_date_today']");   
            initDatePicker("input[name='course_schedule_adjust_date']"); 
            initDatePicker("input[name='course_schedule_midterm']"); 
            initDatePicker("input[name='course_schedule_enddate']"); 
            initDatePicker("input[name='course_schedule_final_from']"); 
            initDatePicker("input[name='course_schedule_final_to']"); 
            initDatePicker("input[name='course_faculty_date']"); 
    });

    $(function(){
         $('#faculty').change(function(){
            var id = $(this).val();           
            var url_title_major = "<?php echo site_url("course_management/suggest_major")?>";
            var dataFaculty = { faculty_id: id};
            
                $.ajax({
                    type: "POST",
                    url: url_title_major, 
                    data:dataFaculty,
                    dataType:"json",
                    success: function(get_data){
                        $('#major').html('<option> -- -- </option>');
                        $.each(get_data,function(key,val){
                            var opt = $('<option />'); 
                            opt.val(val.skill_id);
                            opt.text(val.skill_name + '('+val.skill_name_kh+')');
                            $('#major').append(opt);
                        });
                    },
                });
        });
    });


    $(document).ready(function()
    {

        $('body').on('change', '#degree', function(e) {
            e.preventDefault();
            var val = $(this).val(),
            url = "<?php echo site_url('degree_management/get_degree_info')?>";
            $.ajax({
                url: url,
                type: 'POST',
                data: {degree_id: val},
                dataType: 'json',
                success: function(result) {
                    $('#duration').val(result.degree_info.level_duration);
                }
                ,error: function(res){console.log(res.responseText)}
            });
        });

        setTimeout(function(){$(":input:visible:first", "#course_form").focus(); }, 100);
        $('#course_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("$controller_name/check_duplicate"); ?>', {term: $('#course_code').val()}, function(data) {
        <?php if (!$course_info->course_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('course_code_duplicate_exists')); ?>))
                    {
                        doCourseSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doCourseSubmit(form);
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
                course_code:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url("$controller_name/code_exists"); ?>",
                            type: 'post',
                        },
                        depends: function(course_code) {
                            return ($(course_code).val() != $('input[name="original_course_code"]').val());
                        }
                    },
                    required:true,
                },
                course_name: "required",
                course_name_kh: "required",
                major: "required",
                degree: "required",
                course_coordinator: "required",
                academic_year: "required",
                faculty: "required",
                room: "required"
            },
            messages:
            {
                course_code:
                {
                    remote: <?php echo json_encode(lang('course_duplicate_exists')); ?>,
                    required: <?php echo json_encode(lang('course_code_required')); ?>,
                },
                course_name: <?php echo json_encode(lang('course_name_required')); ?>,
                course_name_kh: <?php echo json_encode(lang('course_name_kh_required')); ?>,
                major: <?php echo json_encode(lang('course_major_required')); ?>,
                degree: <?php echo json_encode(lang('course_degree_required')); ?>,
                course_coordinator: <?php echo json_encode(lang('course_coordinator_required')); ?>,
                academic_year: <?php echo json_encode(lang('course_academic_required')); ?>,
                faculty: <?php echo json_encode(lang('course_faculty_required')); ?>,
                room: <?php echo json_encode(lang('course_room_required')); ?>,
            }
        });

        $('.room_input').autocomplete({
            minLength: 1,
            source: function(req, response){
                $.ajax({
                    url: "<?php echo site_url('course_management/autocomplete_room'); ?>",
                    type: 'POST',
                    data: {"term" : req.term},
                    dataType: "json",
                    success: function(data){
                        if (data.success) {     // Manipulate data in Controller
                            response(data.record);
                        };
                    }
                });
            },
            select: function(event, ui){
                event.preventDefault()
                $(this).val(ui.item.label);
            }
        });
    });
    
    var submitting = false;
    function doCourseSubmit(form)
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
                    window.location.href = '<?php echo site_url("$controller_name/form"); ?>/'+response.course_id;
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