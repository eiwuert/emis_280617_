<section class="content" style="min-height: 303px;">
        <style>
.box .box-solid {
     background-color: #F8F8F8;
}
</style>
<script>
$(function () {
  $('[data-toggle="popover"]').popover({placement: function() { return $(window).width() < 768 ? 'bottom' : 'right'; }})
})
</script>

<div class="col-xs-12">
  <div class="col-lg-8 col-sm-8 col-xs-12 no-padding">
    <h3 class="box-title"><i class="fa fa-edit"></i> <?php echo lang('students_update_personal_details'); ?> :  <?php echo $full_name; ?> </h3>
    <div class="clearboth"></div>
  </div>
  <div class="col-xs-4"></div>
  <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
	<div class="col-xs-4"></div>
	<div class="col-xs-4"></div>
	<div class="col-xs-4 left-padding">
	<a class="btn btn-block btn-back" href="<?php echo site_url("students/detail/$person_info->stu_info_id"); ?>"><?php echo lang('common_back') ?></a>	</div>
  </div>
</div>

<div class="col-xs-12 col-lg-12">
  <div class="box-info box view-item col-xs-12 col-lg-12">
   <div class="stu-master-update">

    <form id="stu-master-update" action="<?php echo site_url("students/save_personal/$person_info->stu_info_id"); ?>" method="post">
    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
        <div class="box-header with-border">
            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('students_personal_details'); ?></h4>
            <div class="clearboth"></div>
        </div>
        <div class="box-body">

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-9 col-sm-4">
            	<div class="form-group field-stuinfo-stu_unique_id required">
                    <label class="control-label" for="stu_unique_id"><?php echo lang('students_student_id_by_written'); ?></label>
                    <input type="text" id="stu_unique_id" class="form-control" name="stu_unique_id" value="<?php echo $person_info->stu_unique_id; ?>"><div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-9 col-sm-4">
                <div class="field-stuinfo-stu_unique_id required">
                    <label class="control-label" for="stu_unique_id_written"><?php echo lang('students_student_id'); ?></label>
                    <input type="text" id="stu_unique_id_written" class="form-control" name="stu_unique_id_written" value="<?php echo $person_info->stu_unique_id_written; ?>" readonly/>
                    <div class="help-block"></div>                                 
                </div>    
            </div>
       </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
        	   <div class="form-group field-stuinfo-stu_title">
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
                        'checked' => $person_info->is_refer_in != 0 ? true : false,
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
                <div class="form-group field-stuinfo-stu_last_name required">
                    <label class="control-label" for="stu_last_name"><?php echo lang('common_first_name'); ?></label>
                    <input type="text" id="stu_last_name" class="form-control" name="stu_last_name" value="<?php echo $person_info->stu_last_name; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>            
            <div class="col-xs-12 col-sm-4 col-lg-4">
            	<div class="form-group field-stuinfo-stu_first_name required">
                    <label class="control-label" for="stu_first_name"><?php echo lang('common_given_name'); ?></label>
                    <input type="text" id="stu_first_name" class="form-control" name="stu_first_name" value="<?php echo $person_info->stu_first_name; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_email_id">
                    <label class="control-label" for="stu_email_id"><?php echo lang('common_email'); ?></label>
                    <input type="text" id="stu_email_id" class="form-control" name="stu_email_id" maxlength="60" value="<?php echo $person_info->stu_email_id; ?>">
                    <div class="text-danger" id="chExistsEmail"></div>
                    <div class="help-block"></div>
                </div>  
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_last_name required">
                    <label class="control-label" for="stu_last_name_kh"><?php echo lang('common_first_name_kh').' ('. lang('common_khmer') .')'; ?></label>
                    <input type="text" id="stu_last_name_kh" class="form-control" name="stu_last_name_kh" value="<?php echo $person_info->stu_last_name_kh; ?>">
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_first_name required">
                    <label class="control-label" for="stu_first_name_kh"><?php echo lang('common_given_name').' ('. lang('common_khmer') .')' ?></label>
                    <input type="text" id="stu_first_name_kh" class="form-control" name="stu_first_name_kh" value="<?php echo $person_info->stu_first_name_kh; ?>">
                    <div class="help-block"></div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_mobile_no">
                    <label class="control-label" for="stuinfo-stu_mobile_no"><?php echo lang('common_mobile_no'); ?></label>
                    <input type="text" id="stuinfo-stu_mobile_no" class="form-control" name="stu_mobile_no" maxlength="120" value="<?php echo $person_info->stu_mobile_no; ?>">
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_card_number">
                    <label class="control-label" for="stu_card_number"><?php echo lang('common_card_number'); ?></label>
                    <input type="text" id="stu_card_number" class="form-control" name="stu_card_number" value="<?php echo $person_info->stu_card_number; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_emergency_contact">
                    <label class="control-label" for="stu_emergency_contact"><?php echo lang('common_emergency_contact_phone'); ?></label>
                    <input type="text" id="stu_emergency_contact" class="form-control" name="stu_emergency_contact" value="<?php echo $person_info->stu_emergency_contact; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_gender">
                    <label class="control-label" for="stu_gender"><?php echo lang('common_gender'); ?></label>
                    <?php echo form_dropdown('stu_gender', $genders, $person_info->stu_gender, 'class="form-control" id="stu_gender"'); ?>
                    <div class="help-block"></div>
                </div>  
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
        	    <div class="form-group field-stuinfo-stu_dob required">
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
                <div class="form-group field-stumaster-stu_category_id">
                    <label class="control-label" for="stu_category_id"><?php echo lang('students_admission_category'); ?></label>
                    <?php 
                    echo form_dropdown('stu_category_id', $admission_categories, $person_info->stu_category_id, 'class="form-control" id="stu_category_id"');
                    ?>
                    <div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stumaster-stu_nationality_id">
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
        	   <div class="form-group field-stuinfo-stu_high_school">
                    <label class="control-label" for="stu_high_school"><?php echo lang('students_high_school'); ?></label>
                    <input type="text" id="stu_high_school" class="form-control" name="stu_high_school" value="<?php echo $person_info->stu_high_school; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_bloodgroup">
                    <label class="control-label" for="stu_bloodgroup"><?php echo lang('students_high_school_exam_year'); ?></label>
                    <input type="text" id="stu_exam_hschool" class="form-control" name="stu_exam_hschool" value="<?php echo $person_info->stu_exam_hschool; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-stu_certificate_id_hschool">
                    <label class="control-label" for="stu_certificate_id_hschool"><?php echo lang('students_certificate_id_hschool'); ?></label>
                    <input type="text" id="stu_certificate_id_hschool" class="form-control" name="stu_certificate_id_hschool" value="<?php echo $person_info->stu_certificate_id_hschool; ?>" maxlength="50">
                    <div class="help-block"></div>
                </div>    
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-stuinfo-health_status">
                    <label class="control-label" for="health_status"><?php echo lang('students_health_status'); ?></label>
                    <?php echo form_dropdown('health_status', $health_status, $person_info->health_status, 'class="form-control" id="health_status"'); ?>
                    <div class="help-block"></div>
                </div>
            </div>                                       
        </div>        
        </div>
    </div>                    

    <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
    	<div class="col-xs-6">
            <button type="submit" class="btn btn-block btn-info" id="submit"><?php echo lang('common_update'); ?></button>	
        </div>
    	<div class="col-xs-6">
    	    <a class="btn btn-default btn-block" href="<?php echo site_url("students/detail/$person_info->stu_info_id"); ?>"><?php echo lang('common_cancel'); ?></a>	
        </div>
    </div>
	</form>   
    </div>
  </div>
</div>
    </section>