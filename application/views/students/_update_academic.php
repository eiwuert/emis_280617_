<section class="content" style="min-height: 303px;">
        <style>
.box .box-solid {
     background-color: #F8F8F8;
}
</style>
<div class="col-xs-12">
      <div class="col-lg-8 col-sm-8 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-edit"></i> <?php echo lang('students_update_academic_details'); ?> :  <?php echo $full_name; ?> </h3>
      </div>
      <div class="col-xs-4"></div>
      <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
    	    <div class="col-xs-4"></div>
    	    <div class="col-xs-4"></div>
    	    <div class="col-xs-4 left-padding">
    	       <a class="btn btn-block btn-back" href="<?php echo site_url("students/detail/$person_info->stu_info_id"); ?>" onclick="js:history.go(-1);return false;"><?php echo lang('common_back') ?></a>
          </div>
      </div>
</div>

<div class="col-xs-12 col-lg-12">
    <div class="box-info box view-item col-xs-12 col-lg-12">
        <div class="stu-master-update">
        <?php
        echo form_open($controller_name.'/do_update_academic/'.$person_info->stu_info_id, array('id' => 'academic_form', 'class' => 'form-horizontal'));
                ?>
            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                <div class="box-header with-border">
                    <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('students_academic_details'); ?></h4>
                    <div class="clearboth"></div>
                </div>

                <div class="box-body">
                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                            <div class="form-group field-stumaster-stu_master_university_id required">
                                <label class="control-label" for="stumaster-stu_master_university_id"><?php echo lang('students_university')?></label>

                                <?php echo form_dropdown('stu_master_university_id', $universities, $person_info->stu_master_university_id, 'class="form-control" id="stumaster-stu_master_university_id"'); ?>
                                
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                            <div class="form-group field-stumaster-stu_master_level_id required">
                                <label class="control-label" for="stumaster-stu_master_level_id"><?php echo lang('students_level')?></label>

                                <?php echo form_dropdown('stu_master_level_id', $levels, $person_info->stu_master_level_id, 'class="form-control" id="stumaster-stu_master_level_id"'); ?>
                                
                                <div class="help-block"></div>
                            </div>    
                        </div>
                    </div>   
                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                            <div class="form-group field-stumaster-stu_master_course_id required">
                                <label class="control-label" for="stumaster-stu_master_course_id"><?php echo lang('students_course')?></label>

                                <?php echo form_dropdown('stu_master_course_id', $courses, $person_info->stu_master_course_id, 'class="form-control" id="stumaster-stu_master_course_id"'); ?>
                                
                                <div class="help-block"></div>
                            </div>    
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                    	    <div class="form-group field-stumaster-stu_master_batch_id required">
                                <label class="control-label" for="stumaster-stu_master_batch_id"><?php echo lang("students_batch"); ?></label>

                                <?php echo form_dropdown('stu_master_batch_id', $batch, $person_info->stu_master_batch_id, 'class="form-control" id="stumaster-stu_master_batch_id"'); ?>
                                <div class="help-block"></div>
                            </div>    
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                          	<div class="form-group field-stumaster-stu_master_section_id required">
                                <label class="control-label" for="stumaster-stu_master_section_id"><?php echo lang('students_section'); ?></label>

                                <?php echo form_dropdown('stu_master_section_id', $section, $person_info->stu_master_section_id, 'class="form-control" id="stumaster-stu_master_section_id"'); ?>

                                <div class="help-block"></div>
                            </div>    
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                          	<div class="form-group field-stuinfo-stu_admission_date required">
                                <label class="control-label" for="stuinfo-stu_admission_date"><?php echo lang('students_admission_date'); ?></label>
                                <input type="text" id="stuinfo-stu_admission_date" class="form-control hasDatepicker" name="stu_admission_date" value="<?php echo $person_info->stu_admission_date ? date('d-m-Y', strtotime($person_info->stu_admission_date)) : ""; ?>" size="10">
                                <?php echo form_hidden('original_stu_admission_date', $person_info->stu_admission_date ? date('d-m-Y', strtotime($person_info->stu_admission_date)) : "");?>
                                <div class="help-block"></div>
                            </div>    
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                    	<div class="col-xs-12 col-sm-6 col-lg-6">
                        	<div class="form-group field-stumaster-is_status">
                                <label class="control-label" for="stumaster-is_status"><?php echo lang('students_status'); ?></label>
                                <?php echo form_dropdown('is_status', $status, $person_info->is_status, 'class="form-control" id="stumaster-is_status"'); ?>
                                <div class="help-block"></div>
                            </div>        
                        </div>
                	    <div class="col-xs-12 col-sm-6 col-lg-6">
                			<div class="form-group field-stumaster-stu_master_stu_status_id">
                                <label class="control-label" for="stumaster-stu_master_stu_status_id"><?php echo lang('students_study_status'); ?></label>
                                <?php echo form_dropdown('stu_master_stu_status_id', $stu_status, $person_info->stu_master_stu_status_id, 'class="form-control" id="stumaster-stu_master_stu_status_id"'); ?>
                                <div class="help-block"></div>
                            </div>	
                        </div>
                    </div>
                </div> <!--/ box-body -->
            </div> <!--/ box -->

            <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
        	    <div class="col-xs-6">
                    <button type="submit" class="btn btn-block btn-info"><?php echo lang('common_update'); ?></button>	
                </div>
        	    <div class="col-xs-6">
        	       <a class="btn btn-default btn-block" href="<?php echo site_url("students/detail/-1"); ?>"><?php echo lang('common_cancel'); ?></a>	
                </div>
            </div>   
        <?php echo form_close(); ?>  
        </div>
    </div>
</div>
</section>

<script type='text/javascript'>

    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#academic_form").focus(); }, 100);
        $('#academic_form').validate({
            submitHandler:function(form){

                $.post('<?php echo site_url("students/check_duplicate_academic"); ?>', {term: $('#stuinfo-stu_admission_date').val()}, function(data) {
                    <?php if (!$person_info->stu_info_id) { ?>
                        
                            if (data.duplicate){
                                if (confirm(<?php echo json_encode(lang('designation_duplicate_exists')); ?>)){
                                    dodesignationSubmit(form);
                                }
                                else{
                                    return false;
                                }
                            }

                    <?php } else  ?>
                    {
                        dodesignationSubmit(form);
                    }
                },"json")

                .error(function() { });
            },            
            errorClass: "text-danger",
            errorElement: "span",
        });

        var submitting = false;
        function dodesignationSubmit(form){

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
                        window.location.href = '<?php echo site_url("students/detail/$person_info->stu_info_id"); ?>';
                    }
                    else
                    {
                        $.notify(response.message, "error");
                    }
                },
                error: function(error) {
                    alert('error');
                    console.log(error.responseText)
                }
            });
        }
    });


</script>