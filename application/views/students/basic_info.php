<div class="col-xs-12 col-lg-12">
    <div class="box-success box view-item col-xs-12 col-lg-12">
        <div class="stu-master-form">
            <p class="note">Fields with <span class="required"> <b style="color:red;">*</b></span> are required.</p>
            <?php echo form_open("$controller_name/save/" . $person_info->stu_info_id, array('id' => 'student_form', 'class' => 'form-horizontal')); ?>
          
                <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                    <div class="box-header with-border col-xs-12">
                        <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('students_personal_details'); ?></h4>
                    </div>
                    <div class="box-body col-xs-12">

                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-9 col-sm-4">
                                <div class="field-stuinfo-stu_unique_id required">
                                    <label class="control-label" for="stu_unique_id"><?php echo lang('students_student_id_by_written'); ?></label>
                                    <input type="text" id="stu_unique_id" class="form-control" name="stu_unique_id" value="<?php echo $person_info->stu_unique_id; ?>" required>
                                    <div class="text-danger" id="chExistsUniqueId"></div>
                                    <div class="help-block"></div>
                                </div>    
                            </div>
                            <div class="col-xs-9 col-sm-4">
                                <div class="field-stuinfo-stu_unique_id required">
                                    <label class="control-label" for="stu_unique_id_written"><?php echo lang('students_student_id'); ?></label>
                                    <input type="text" id="stu_unique_id_written" class="form-control" name="stu_unique_id_written" value="<?php echo $person_info->stu_unique_id_written ?>" readonly/>
                                    <div class="help-block"></div> 
                                    <?php echo form_hidden('stu_auto_unique_id',$stu_unique_id)?>
                                </div>    
                            </div>
                            <div class="col-xs-3 col-sm-4" style="padding-top: 25px;">
                                <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note">
                                <i class="fa fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                         
                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_title">
                                    <label class="control-label" for="stu_title"><?php echo lang('common_title'); ?></label>
                                    <?php echo form_dropdown('stu_title', $titles, $person_info->stu_title, 'class="form-control" id="stu_title"'); ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-is_refer_in">
                                    <label class="control-label" for="is_refer_in"><?php echo lang('common_refer_in'); ?></label>
                                    <?php
                                    $checkbox_options = array(
                                        'name' => 'is_refer_in',
                                        'value' => 1,
                                        'checked' => $person_info->is_refer_in != "" ? true : false,
                                        'class' => 'form-control',
                                        'id' => 'is_refer_in'
                                    );
                                    echo form_checkbox($checkbox_options);
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-refer_in_from">
                                    <label class="control-label" for="refer_in_from"><?php echo lang('common_refer_in_from'); ?></label>
                                    <?php
                                    $input_options = array(
                                        'name' => 'refer_in_from',
                                        'value' => $person_info->refer_in_from,
                                        'class' => 'form-control',
                                        'id' => 'refer_in_from'
                                    );
                                    if ($person_info->is_refer_in == 0) {
                                        $input_options['readonly'] = 'readonly';
                                    }
                                    echo form_input($input_options);
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_last_name required">
                                    <label class="control-label" for="stu_last_name"><?php echo lang('common_first_name'); ?></label>
                                    <input type="text" id="stu_last_name" class="form-control" name="stu_last_name" value="<?php echo $person_info->stu_last_name; ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_first_name required">
                                    <label class="control-label" for="stu_first_name"><?php echo lang('common_given_name'); ?></label>
                                    <input type="text" id="stu_first_name" class="form-control" name="stu_first_name" value="<?php echo $person_info->stu_first_name; ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_last_name required">
                                    <label class="control-label" for="stu_last_name_kh"><?php echo lang('common_first_name_kh').' ('. lang('common_khmer') .')'; ?></label>
                                    <input type="text" id="stu_last_name_kh" class="form-control" name="stu_last_name_kh" value="<?php echo $person_info->stu_last_name_kh; ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_first_name required">
                                    <label class="control-label" for="stu_first_name_kh"><?php echo lang('common_given_name').' ('. lang('common_khmer') .')' ?></label>
                                    <input type="text" id="stu_first_name_kh" class="form-control" name="stu_first_name_kh" value="<?php echo $person_info->stu_first_name_kh; ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_gender">
                                    <label class="control-label" for="stu_gender"><?php echo lang('common_gender'); ?></label>
                                    <?php echo form_dropdown('stu_gender', $genders, $person_info->stu_gender, 'class="form-control" id="stu_gender"'); ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_email_id">
                                    <label class="control-label" for="stu_email_id"><?php echo lang('common_email'); ?></label>
                                    <input type="text" id="stu_email_id" class="form-control" name="stu_email_id" maxlength="60" value="<?php echo $person_info->stu_email_id; ?>">
                                    <div class="text-danger" id="chExistsEmail"></div>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_mobile_no">
                                    <label class="control-label" for="stuinfo-stu_mobile_no"><?php echo lang('common_mobile_no'); ?></label>
                                    <input type="text" id="stuinfo-stu_mobile_no" class="form-control" name="stu_mobile_no" maxlength="120" value="<?php echo $person_info->stu_mobile_no; ?>">
                                    <div class="help-block"></div>
                                </div>    
                            </div>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_dob required">
                                    <label class="control-label" for="stu_dob"><?php echo lang('common_date_of_birth'); ?></label>
                                    <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                        <input type="text" id="stu_dob" class="form-control hasDatepicker" name="stu_dob" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $person_info->stu_dob != "" ? date('d-m-Y', strtotime($person_info->stu_dob)) : ""; ?>">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                    <div class="help-block"></div>
                                </div>   
                            </div> 
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_category_id required">
                                    <label class="control-label" for="stu_category_id"><?php echo lang('students_admission_category'); ?></label>
                                    <?php 
                                    echo form_dropdown('stu_category_id', $admission_categories, $person_info->stu_category_id, 'class="form-control" id="stu_category_id"');
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div> 
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_nationality_id required">
                                    <label class="control-label" for="stu_nationality_id"><?php echo lang('common_nationality'); ?></label>
                                    <?php 
                                    echo form_dropdown('stu_nationality_id', $nationality, $person_info->stu_nationality_id, 'class="form-control" id="stu_nationality_id"');
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_high_school">
                                    <label class="control-label" for="stu_high_school"><?php echo lang('students_high_school'); ?></label>
                                     <input type="text" id="stu_high_school" class="form-control" name="stu_high_school" maxlength="60" value="<?php echo $person_info->stu_high_school; ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_exam_hschool">
                                    <label class="control-label" for="stu_exam_hschool"><?php echo lang('students_high_school_exam_year'); ?></label>
                                    <input type="text" id="stu_exam_hschool" class="form-control" name="stu_exam_hschool" maxlength="60" value="<?php echo $person_info->stu_exam_hschool; ?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_certificate_id_hschool">
                                    <label class="control-label" for="stuinfo-stu_certificate_id_hschool"><?php echo lang('students_certificate_id_hschool'); ?></label>
                                    <input type="text" id="stuinfo-stu_certificate_id_hschool" class="form-control" name="stu_certificate_id_hschool" maxlength="120" value="<?php echo $person_info->stu_certificate_id_hschool; ?>">
                                    <div class="help-block"></div>
                                </div>    
                            </div>
                        </div>

                    </div>
                    <!---./end box-body-->
                </div>
                <!---./end box-->

                <div class="box box-solid box-warning col-xs-12 col-lg-12 no-padding">
                    <div class="box-header with-border col-xs-12">
                        <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('students_academic_details'); ?></h4>
                    </div>
                    <div class="box-body col-xs-12">
                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_university_id required">
                                    <label class="control-label" for="stu_acad_university_id"><?php echo lang('students_university'); ?></label>
                                    <select name="stu_acad_university_id" id="stu_acad_university_id" class="form-control">
                                        <option value='' <?php echo (($person_info->stu_acad_batch_id)? $person_info->stu_acad_batch_id : '')?>> -- Select Batch -- </option>
                                        <?php foreach($universities as $key=> $university):?>
                                            <option data-id="<?php echo $university->university_code?>" value="<?php echo $university->university_id?>"><?php echo $university->university_name?></option>
                                        <?php endforeach ?>                                        
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_skill_id required">
                                    <label class="control-label" for="stu_acad_skill_id"><?php echo lang('students_skill'); ?></label>
                                    <?php echo form_dropdown('stu_acad_skill_id', $skills, $person_info->stu_acad_skill_id, 'id="stu_acad_skill_id" class="form-control"'); ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_course_id required">
                                    <label class="control-label" for="stu_acad_course_id"><?php echo lang('students_course'); ?></label>
                                    <?php echo form_dropdown('stu_acad_course_id', $courses, $person_info->stu_acad_course_id, 'id="stu_acad_course_id" class="form-control"');                                        
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stu_acad_batch_id required">
                                    <label class="control-label" for="stu_acad_batch_id"><?php echo lang('students_batch'); ?></label>
                                    <select name="stu_acad_batch_id" id="stu_acad_batch_id" class="form-control">
                                        <option value='' <?php echo (($person_info->stu_acad_batch_id)? $person_info->stu_acad_batch_id : '')?>> -- Select Batch -- </option>
                                        <?php foreach($batches as $key=> $batch):?>
                                            <option data-id="<?php echo $batch->batch_number?>" value="<?php echo $batch->batch_id?>"><?php echo $batch->batch_name?></option>
                                        <?php endforeach ?>                                        
                                    </select>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_section_id required">
                                    <label class="control-label" for="stu_acad_section_id"><?php echo lang('common_section'); ?></label>
                                    <?php 
                                    echo form_dropdown('stu_acad_section_id', $section, $person_info->stu_acad_section_id, 'class="form-control" id="stu_acad_section_id"');
                                    ?>
                                    <!-- <select id="stu_acad_section_id" class="form-control" name="stu_acad_section_id">
                                        <option value=""><?php echo lang('common_select_section'); ?></option>
                                    </select> -->
                                    <div class="help-block"></div>
                                </div>     
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_level_id required">
                                    <label class="control-label" for="stu_acad_level_id"><?php echo lang('students_level'); ?></label>
                                    <?php echo form_dropdown('stu_acad_level_id', $levels, $person_info->stu_acad_level_id, 'id="stu_acad_level_id" class="form-control"'); 
                                        /*onchange="
                                          $.get( "/EduSec/index.php?r=student%2Fdependent%2Fstudbatch", { id: $(this).val() } )
                                              .done(function( data ) {
                                                  $( "#stu_acad_batch_id" ).html( data );
                                              }
                                          );
                                      "*/
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stuinfo-stu_admission_date required">
                                    <label class="control-label" for="stu_admission_date"><?php echo lang('students_admission_date'); ?></label>
                                    <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                        <input type="text" id="stu_admission_date" class="form-control hasDatepicker" name="stu_admission_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="<?php echo $date = $person_info->stu_admission_date != "" ? date('d-m-Y', strtotime($person_info->stu_admission_date)) : ""; ?>">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                            
                                <div class="field-stumaster-stu_acad_stu_status_id">
                                    <label class="control-label" for="stumaster-stu_acad_stu_status_id"><?php echo lang('students_student_status'); ?></label>
                                    <?php 
                                    echo form_dropdown('stu_acad_stu_status_id', $stu_status, $person_info->stu_acad_stu_status_id, 'class="form-control" id="stu_acad_stu_status_id"');
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_stu_status_id">
                                    <label class="control-label" for="stumaster-stu_acad_grade"><?php echo lang('stu_acad_grade'); ?></label>
                                    <?php 
                                    echo form_dropdown('stu_acad_grade', $stu_grade, $person_info->stu_acad_grade, 'class="form-control" id="stu_master_stu_grade"');
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_stu_status_id">
                                    <label class="control-label" for="students_room"><?php echo lang('students_room'); ?></label>
                                    <?php 
                                    echo form_dropdown('stu_acad_stu_room', $stu_room, $person_info->stu_acad_stu_room, 'class="form-control" id="stu_acad_stu_room"');
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_stu_status_id">
                                    <label class="control-label" for="students_class"><?php echo lang('students_class'); ?></label>
                                    <?php 
                                    echo form_dropdown('stu_acad_stu_class', $stu_class, $person_info->stu_acad_stu_class, 'class="form-control" id="stu_acad_stu_class"');
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-stumaster-stu_acad_stu_status_id">
                                    <label class="control-label" for="students_class"><?php echo "Schedule"; ?></label>
                                    <?php 
                                    echo form_dropdown('stu_acad_stu_schedule', $stu_schedule, $person_info->stu_acad_stu_schedule, 'class="form-control" id="stu_acad_stu_schedule"');
                                    ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <label class="control-label" for="students_class"><?php echo "Scholarship"; ?></label>
                                <?php 
                                echo form_dropdown('stu_acad_stu_scholarship', $stu_scholarship, $person_info->stu_acad_scholarship_id, 'class="form-control" id="stu_acad_stu_scholarship"');
                                ?>
                                <div class="help-block"></div>
                            </div>
                        </div>

                    </div><!---./end box-body-->
                </div><!---./end box-->

                <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
                    <div class="col-xs-6">
                        <button type="submit" class="btn btn-block btn-success" id="submit"><?php echo lang('common_create'); ?></button> </div>
                    <div class="col-xs-6">
                        <a class="btn btn-default btn-block" href="<?php echo site_url($controller_name) ?>"><?php echo lang('common_cancel'); ?></a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#stu_acad_university_id').on('change', function(){
        var school_num = <?php echo $this->config->item('school_number');?>;
        var num_stu = $('input[name="stu_auto_unique_id"]').val();
        var num_batch = $('#stu_acad_batch_id :selected').data('id');
        var num_university = $('#stu_acad_university_id :selected').data('id');
        if(!(school_num && num_stu && num_batch && num_university) == ''){
            $('#stu_unique_id_written').val(school_num + num_university + num_batch + num_stu);
        }else{
            $('#stu_unique_id_written').val('');
        }
        
        var ucity_id = $('#stu_acad_university_id :selected').val();
        url = "<?php echo site_url('students/suggest_major')?>";
        $.ajax({
            url: url,
            type: 'POST',
            data: {faculty_id: ucity_id},
            dataType: "json",
            success: function(result) {
                $('#stu_acad_skill_id').html('');
                $.each(result,function(key,val){
                    var opt = $('<option />'); 
                    opt.val(val.skill_id);
                    opt.text(val.skill_name + '('+val.skill_name_kh+')');
                    $('#stu_acad_skill_id').append(opt);
                });
                $('#stu_acad_course_id').html('');
            }
            ,error: function(res){console.log(res.responseText)}
        });
        
    });
    $('#stu_acad_batch_id').on('change', function(){

        var school_num = <?php echo $this->config->item('school_number');?>;
        var num_stu = $('input[name="stu_auto_unique_id"]').val();
        var num_batch = $('#stu_acad_batch_id :selected').data('id');
        var num_university = $('#stu_acad_university_id :selected').data('id');
        if(!(school_num && num_stu && num_batch && num_university) == ''){
            $('#stu_unique_id_written').val(school_num + num_university + num_batch + num_stu);
        }else{
            $('#stu_unique_id_written').val('');
        }
    });
    $('#stu_acad_skill_id').on('change', function(){
        var val = $('#stu_acad_skill_id :selected').val();
        url = "<?php echo site_url('students/get_major_course')?>";
        $.ajax({
            url: url,
            type: 'POST',
            data: {major_id: val},
            dataType: 'json',
            success: function(result) {
                $('#stu_acad_course_id').html(result.courses);
                $('#stu_acad_university_id').val(result.university_id);
            }
            ,error: function(res){console.log(res.responseText)}
        });
    });


</script>