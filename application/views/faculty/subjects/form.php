<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
            <?php
            if (!$subject_info->sub_id) {
                echo lang('subjects_new');
            } else {
                echo lang('subjects_update');
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
                                    <?php echo lang("subjects_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                    echo form_open($controller_name.'/save/' . $subject_info->sub_id, array('id' => 'subject_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('subjects_name') . ':', 'subject_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'subject_name',
                                                'id' => 'subject_name',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $subject_info->subject_name));
                                            echo form_hidden('original_subject_name', $subject_info->subject_name);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('subjects_name_kh') . ':', 'subject_name_kh', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'subject_name_kh',
                                                'id' => 'subject_name_kh',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $subject_info->subject_name_kh));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('subjects_short_name') . ':', 'subjects_short_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'subjects_short_name',
                                                'id' => 'subjects_short_name',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $subject_info->subjects_short_name));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('subjects_major') . ':', 'course_ids', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php echo form_dropdown('group_major[]', $major, $edit_major, 'class="selectpicker form-control" id="majors" multiple="multiple"');?>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('professors') . ':', 'professors_ids', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5 cl_prof">
                                            <?php echo form_dropdown('professors[]', $professors, $edit_professor, 'class="selectpicker form-control" id="professors" multiple="multiple"');?>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label('Semester:', 'semester', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-4 col-md-4 col-lg-4" style="line-height:40px">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <label>Semester 1 &nbsp;</label><input type="checkbox" name="subject_semester[]" id="subject_semester" <?php echo(!empty($re_subj_semester1))? "checked":""?> value="1" />
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <label>Semester 2 &nbsp;</label><input type="checkbox" name="subject_semester[]" id="subject_semester" <?php echo(!empty($re_subj_semester2))? "checked":""?> value="2" />                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label('Credit:', 'credit', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php echo form_input(array(
                                                'name' => 'subject_credit',
                                                'id' => 'subject_credit',
                                                'class' => 'form-control',
                                                'value' => $subject_info->subject_credit));?>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label('Year(level):', 'subject_level_year', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>                                        
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php echo form_dropdown('subject_level_year[]', $subject_level_year, $edit_level_year, 'class="selectpicker form-control" id="level_year" multiple="multiple"');?>
                                        </div>
                                    </div>


                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('subjects_other') . ':', 'subject_other', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_textarea(array(
                                                'name' => 'subject_other',
                                                'id' => 'subject_other',
                                                'class' => 'form-control',
                                                'value' => $subject_info->subject_other));
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
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<script type="text/javascript">
    $(function(){
        $('.cl_prof').click(function(){            
            var edit_major = <?php echo json_encode($edit_major)?>;
            var id_prof = $("#majors").val();
            var url_title = "<?php echo site_url('subjects/suggestion_prof')?>";
            var dataProf = { id_prof: id_prof};
            var edit_prof = "<?php echo $edit_professor ?>";

            if(String(id_prof) != String(edit_major)){
                $.post( url_title,dataProf, function(data) {
                    $("#professors").html('');
                    $.each(data,function(key,val){
                        var opt = $('<option />', {
                            value: val.person_id,
                            text: val.last_name
                        });
                        $("#professors").append(opt);
                    });
                    $("#professors").selectpicker('refresh');
                }, "json");
            }
        });
    });
    $(document).ready(function(){
        initSomuSelect('#majors');
        initSomuSelect('#level_year');
        // initSomuSelect('#professors');
        setTimeout(function(){$(":input:visible:first", "#subject_form").focus(); }, 100);
        $('#subject_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("subjects/check_duplicate"); ?>', {term: $('#subject_name').val()}, function(data) {
        <?php if (!$subject_info->sub_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('subjects_duplicate_exists')); ?>))
                    {
                        doSubjectSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doSubjectSubmit(form);
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
                subject_name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('subjects/subjects_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(subject_name) {
                            return ($(subject_name).val() != $('input[name="original_subject_name"]').val());
                        }
                    },
                    required:true,
                },
                subject_credit:"required",
                subject_level_year:"required",         
            },
            messages:
            {
                subject_name:
                {
                    remote: <?php echo json_encode(lang('subjects_duplicate_exists')); ?>,
                    subject_name: <?php echo json_encode(lang('subjects_subject_name_required')); ?>,
                    subject_credit: <?php echo json_encode(lang('subjects_subject_name_required')); ?>,
                    subject_level_year: <?php echo json_encode(lang('subjects_subject_name_required')); ?>,
                },
            }
        });
    });
    var submitting = false;
    function doSubjectSubmit(form)
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

                    window.location.href = '<?php echo site_url('subjects'); ?>';
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