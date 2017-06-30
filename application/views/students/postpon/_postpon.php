<section class="content" style="min-height: 303px;">
    <style>
    .box .box-solid {
         background-color: #F8F8F8;
    }
    </style>

    <div class="col-xs-12">
        <h2 class="page-header transfer-info">  
            <i class="fa fa-info-circle"></i> <?php echo lang('students_postpon_details'); ?> 
            <div class="pull-right">
                <a class="btn btn-default btn-sm" href="<?php echo site_url("students/detail/$person_info->stu_info_id"); ?>"><i class="fa fa-arrow-left"></i> <?php echo lang('common_back'); ?></a>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#postponStudent"><i class="fa fa-plus"></i> 
                  <?php echo lang('students_new_postpon'); ?>
                </button>
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#referOut"><i class="fa fa-plus"></i> 
                  <?php echo lang('students_refer_out'); ?>
                </button>
            </div>
            <div class="clearfix"></div>
        </h2>
    </div><!-- /.col -->

    <div class="col-xs-12 col-lg-12">
        <!---Start Postpon Block-->
        <div class="row">
            <div class="col-xs-12">
                <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
                <?php echo lang('students_postpon'); ?> </h4>
            </div><!-- /.col -->
        </div>

        <div class="col-xs-12">
            <div class="row table-responsive postpon">
                <?php $this->load->view("students/postpon/postpon_table"); ?>
            </div>
        </div>

        <!---Start Postpon Same Class Block-->
        <div class="row">
            <div class="col-xs-12">
                <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
                <?php echo lang('students_postpon_same_class'); ?>  </h4>
            </div><!-- /.col -->
        </div>

        <div class="col-xs-12">
            <div class="row table-responsive postpon_same_class">
                <?php $this->load->view("students/postpon/postpon_same_class_table"); ?>
            </div>
        </div>

        <!---Start Refer Out Block-->
        <div class="row">
            <div class="col-xs-12">
                <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
                <?php echo lang('students_refer_out'); ?> </h4>
            </div><!-- /.col -->
        </div>

        <div class="col-xs-12">
            <div class="row table-responsive refer_out">
                <?php $this->load->view("students/refer/refer_out_table"); ?>
            </div>
        </div>

        <!---Start Refer In Block-->
        <div class="row">
            <div class="col-xs-12">
                <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
                <?php echo lang('students_refer_in'); ?> </h4>
            </div><!-- /.col -->
        </div>

        <div class="col-xs-12">
            <div class="row table-responsive refer_in">
                <?php $this->load->view("students/refer/refer_in_table"); ?>
            </div>
        </div>
    </div>

</section>

<!-- Modal -->
<div class="modal fade" id="postponStudent" tabindex="-1" role="dialog" aria-labelledby="postponStudentLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <?php echo form_open("$controller_name/save_postpon/" . $person_info->stu_info_id, array('id' => 'transfer_form', 'class' => 'form-horizontal1')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="postponStudentLabel"><?php echo lang('students_postpon'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <?php echo form_label(lang('students_postpon_option') . ':', 'postpon', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <div class="">
                                <?php 
                                echo form_radio(array(
                                    'name' => 'postpon',
                                    'value' => 'postpon',
                                    'id' => 'postpon',
                                    'checked' => true
                                    )
                                );
                                ?>
                                <span><?php echo lang('students_postpon'); ?></span>
                            </div>
                            <div class="">
                                <?php
                                echo form_radio(array(
                                    'name' => 'postpon',
                                    'value' => 'postpon_same_class',
                                    'id' => 'postpon_same_class'
                                    )
                                );
                                ?>
                                <span><?php echo lang('students_postpon_same_class'); ?></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group hide toggle-postpon postpon_same_class">
                        <?php echo form_label(lang('students_duration') . ':', 'duration', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <input type="text" id="duration" class="form-control" name="duration" >
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label(lang('students_start_date') . ':', 'start_date', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                <input type="text" id="start_date" class="form-control hasDatepicker" name="start_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                            <div class="errorTxt"></div>
                            <br/>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label(lang('students_end_date') . ':', 'end_date', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                <input type="text" id="end_date" class="form-control hasDatepicker" name="end_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                            <div class="errorTxt"></div>
                            <br/>
                        </div>
                    </div>

                    <!-- <div class="form-group hide toggle-postpon postpon_same_class">
                        <?php echo form_label(lang('students_start_date') . ':', 'postpon_date', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                <input type="text" id="postpon_date" class="form-control hasDatepicker" name="postpon_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                            <div class="errorTxt"></div>
                            <br/>
                        </div>
                    </div> -->
                    <div class="form-group toggle-postpon postpon">
                        <?php echo form_label(lang('common_reason') . ':', 'reason', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php
                            echo form_textarea(array(
                                'class' => 'form-control',
                                'name' => 'reason',
                                'id' => 'reason',
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label(lang('common_remark') . ':', 'remark', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php
                            echo form_textarea(array(
                                'class' => 'form-control',
                                'name' => 'remark',
                                'id' => 'remark',
                                )
                            );
                            ?>
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

<!-- Refer Out -->
<div class="modal fade" id="referOut" tabindex="-1" role="dialog" aria-labelledby="referOutLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <?php echo form_open("$controller_name/save_refer_out/" . $person_info->stu_info_id, array('id' => 'refer_out_form', 'class' => 'form-horizontal1')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="referOutLabel"><?php echo lang('students_refer_in_out'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <?php echo form_label(lang('students_refer_option') . ':', 'referring', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <div class="">
                                <?php 
                                echo form_radio(array(
                                    'name' => 'referring',
                                    'value' => 'refer_out',
                                    'id' => 'refer_out',
                                    'checked' => true
                                    )
                                );
                                ?>
                                <span><?php echo lang('students_refer_out'); ?></span>
                            </div>
                            <div class="">
                                <?php
                                echo form_radio(array(
                                    'name' => 'referring',
                                    'value' => 'refer_in',
                                    'id' => 'refer_in'
                                    )
                                );
                                ?>
                                <span><?php echo lang('students_refer_in'); ?></span>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group toggle-refer refer_out">
                        <?php echo form_label(lang('students_refer_out_to') . ':', 'refer_out_to', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <input type="text" id="refer_out_to" class="form-control" name="refer_out_to" >
                            <div class="errorTxt"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label(lang('students_refer_date') . ':', 'refer_date', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                <input type="text" id="refer_date" class="form-control" name="refer_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </span>
                            <div class="errorTxt"></div>
                            <br/>
                        </div>
                    </div>
                    <div class="form-group hide toggle-refer refer_in">
                        <?php echo form_label(lang('students_refer_from') . ':', 'refer_in_from', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <input type="text" id="refer_in_from" class="form-control" name="refer_in_from" >
                            <div class="errorTxt"></div>
                        </div>
                    </div>
                    <div class="form-group hide toggle-refer refer_in">
                        <?php echo form_label(lang('students_university') . ':', 'refer_in_university', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php echo form_dropdown('refer_in_university', $universities, '', 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group hide toggle-refer refer_in">
                        <?php echo form_label(lang('common_major') . ':', 'refer_in_major', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php echo form_dropdown('refer_in_major', $skills, '', 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group hide toggle-refer refer_in">
                        <?php echo form_label(lang('students_course') . ':', 'refer_in_schedule', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php echo form_dropdown('refer_in_schedule', $courses, '', 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group hide toggle-refer refer_in">
                        <?php echo form_label(lang('students_batch') . ':', 'refer_in_batch', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php echo form_dropdown('refer_in_batch', $batches, '', 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group hide toggle-refer refer_in">
                        <?php echo form_label(lang('students_section') . ':', 'refer_in_year_school', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php echo form_dropdown('refer_in_year_school', $section, '', 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group hide toggle-refer refer_in">
                        <?php echo form_label(lang('students_level') . ':', 'refer_in_level', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php echo form_dropdown('refer_in_level', $levels, '', 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo form_label(lang('common_remark') . ':', 'remark', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
                        <div class="col-sm-8 col-md-8 col-lg-5">
                            <?php
                            echo form_textarea(array(
                                'class' => 'form-control',
                                'name' => 'remark',
                                'id' => 'remark',
                                )
                            );
                            ?>
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


<script type="text/javascript">
    $(document).ready(function()
    {
        initDatePicker("input[name='postpon_date']");
        initDatePicker("input[name='start_date']");
        initDatePicker("input[name='end_date']");
        initDatePicker("input[name='refer_date']");

        // Modal JavaScript Action
        $('body').on('change', 'input[name="postpon"][type="radio"]', function(e){
            var postpon_type = $(this).val();
            $('div.toggle-postpon').addClass('hide')
            $('div.'+postpon_type).removeClass('hide');
        });

        $('#transfer_form').validate({
            submitHandler:function(form)
            {
                doStudentSubmit(form);
            },
            rules:
            {
                start_date: 
                {
                    required:
                    {
                        depends: function() {
                            return $("input#postpon").prop('checked');
                        }
                    }
                },
                end_date: 
                {
                    required:
                    {
                        depends: function() {
                            return $("input#postpon").prop('checked');
                        }
                    }
                },
                /*postpon_date:
                {
                    required: 
                    {
                        depends: function() {
                            return $("input#postpon_same_class").prop('checked');
                        },
                    },
                },*/
            },
            errorLabelContainer: '.errorTxt',
            errorClass: "text-danger",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            $(element).parents('.form-group').find('.errorTxt').html("");
            },
            messages:
            {
                start_date: "Required Field",
                end_date: "Required Field",
                // postpon_date: "Required Field",
            }
        });

        $('body').on('change', 'input[name="referring"][type="radio"]', function(e){
            var refer_type = $(this).val();
            $('div.toggle-refer').addClass('hide')
            $('div.'+refer_type).removeClass('hide');
        });

        $('#refer_out_form').validate({
            submitHandler:function(form)
            {
                doStudentReferSubmit(form);
            },
            rules:
            {
                refer_out_to:
                {
                    required:
                    {
                        depends: function() {
                            return $("input[name='referring']:checked").val() == "refer_out";
                        }
                    }
                },
                refer_in_from:
                {
                    required:
                    {
                        depends: function() {
                            return $("input[name='referring']:checked").val() == "refer_in";
                        }
                    }
                },
                refer_date: 'required'
            },
            errorLabelContainer: '.errorTxt',
            errorClass: "text-danger",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            $(element).parents('.form-group').find('.errorTxt').html("");
            },
            messages:
            {
                refer_out_to: "Required Field",
                refer_in_from: "Required Field",
                refer_date: "Required Field",
            }
        });
    });

    var submitting = false;
    function doStudentSubmit(form)
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
                    $("#postponStudent").modal('hide');
                    if (response.postpon_type == 'postpon') {
                        $('.postpon > table > tbody').append(response.tbl_row);
                    } else {
                        $('.postpon_same_class > table > tbody').append(response.tbl_row);
                    }
                    $.notify(response.message, "success");
                    // window.location.reload('true');
                }
                else
                {
                    $.notify(response.message, "error");
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    }

    function doStudentReferSubmit(form) {
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
                    $("#referOut").modal('hide');
                    if (response.referring == 'refer_out') {
                        $('.refer_out > table > tbody').append(response.tbl_row);
                    } else {
                        $('.refer_in > table > tbody').append(response.tbl_row);
                    }
                    $.notify(response.message, "success");
                }
                else
                {
                    $.notify(response.message, "error");
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    }
</script>