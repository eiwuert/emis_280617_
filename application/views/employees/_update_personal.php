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
	<a class="btn btn-block btn-back" href="<?php echo site_url("$controller_name/detail/$person_info->person_id"); ?>"><?php echo lang('common_back') ?></a>	</div>
  </div>
</div>

<div class="col-xs-12 col-lg-12">
  <div class="box-info box view-item col-xs-12 col-lg-12">
   <div class="emp-master-update">

    <form id="emp-master-update" action="<?php echo site_url("$controller_name/save_personal/$person_info->person_id"); ?>" method="post">
        <!-- <input type="hidden" name="_csrf" value="Y2pobi1jOTJXJh05WCxffSxeUFseFAphURIbF04CUkIRIlgHdyl4aw==">-->
    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
        <div class="box-header with-border">
            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('employees_personal_details'); ?></h4>
            <div class="clearboth"></div>
        </div>
        <div class="box-body">

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-9 col-sm-4">
            	<div class="form-group field-empinfo-emp_unique_id required">
                    <label class="control-label" for="emp_unique_id"><?php echo lang('employees_employee_id'); ?></label>
                    <input type="text" id="emp_unique_id" class="form-  ntrol" name="emp_unique_id" value="<?php echo $person_info->emp_unique_id; ?>" readonly><div class="help-block"></div>
                </div>    
            </div>
       </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
        	   <div class="form-group field-empinfo-emp_title">
                    <label class="control-label" for="emp_title"><?php echo lang('common_title'); ?></label>
                    <?php echo form_dropdown('emp_title', $titles, $person_info->emp_title, 'class="form-control" id="emp_title"'); ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
               <div class="form-group field-empinfo-emp_title">
                    <label class="control-label" for="emp_title"><?php echo lang('employees_dept'); ?></label>
                    <?php
                        echo form_dropdown('department_type', $emp_departments_type,$person_info->department_type, 'class="form-control"');
                    ?>
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empinfo-last_name required">
                    <label class="control-label" for="last_name"><?php echo lang('common_family_name'); ?></label>
                    <input type="text" id="last_name" class="form-control" name="last_name" value="<?php echo $person_info->last_name; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
            	<div class="form-group field-empinfo-first_name required">
                    <label class="control-label" for="first_name"><?php echo lang('common_given_name'); ?></label>
                    <input type="text" id="first_name" class="form-control" name="first_name" value="<?php echo $person_info->first_name; ?>">
                    <div class="help-block"></div>
                </div>    
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empinfo-last_name_kh required">
                    <label class="control-label" for="last_name_kh"><?php echo lang('common_family_name').' ('. lang('common_khmer') .')'; ?></label>
                    <input type="text" id="last_name_kh" class="form-control" name="last_name_kh" value="<?php echo $person_info->last_name_kh; ?>">
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empinfo-first_name required">
                    <label class="control-label" for="first_name_kh"><?php echo lang('common_given_name').' ('. lang('common_khmer') .')' ?></label>
                    <input type="text" id="first_name_kh" class="form-control" name="first_name_kh" value="<?php echo $person_info->first_name_kh; ?>">
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
       	        <div class="form-group field-empinfo-gender">
                    <label class="control-label" for="gender"><?php echo lang('common_gender'); ?></label>
                    <?php echo form_dropdown('gender', $genders, $person_info->gender, 'class="form-control" id="gender"'); ?>
                    <div class="help-block"></div>
                </div>  
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
        	    <div class="form-group field-empinfo-email">
                    <label class="control-label" for="email"><?php echo lang('common_email'); ?></label>
                    <input type="text" id="email" class="form-control" name="email" maxlength="60" value="<?php echo $person_info->email; ?>">
                    <div class="help-block"></div>
                </div>  
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
            	<div class="form-group field-empinfo-phone_number">
                    <label class="control-label" for="empinfo-phone_number"><?php echo lang('common_mobile_no'); ?></label>
                    <input type="text" id="empinfo-phone_number" class="form-control" name="phone_number" maxlength="120" value="<?php echo $person_info->phone_number; ?>">
                    <div class="help-block"></div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
        	    <div class="form-group field-empinfo-dob">
                    <label class="control-label" for="dob"><?php echo lang('common_date_of_birth'); ?></label>
                    <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                        <input type="text" id="dob" class="form-control hasDatepicker" name="dob" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $person_info->dob != "" ? date(get_date_format(), strtotime($person_info->dob)) : ""; ?>">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                    <div class="help-block"></div>
                </div>   
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empmaster-emp_master_category_id">
                    <label class="control-label" for="emp_master_category_id"><?php echo lang('common_category'); ?></label>
                    <?php 
                    echo form_dropdown('emp_master_category_id', $emp_categories, $person_info->emp_master_category_id, 'class="form-control" id="emp_master_category_id"');
                    ?>
                    <div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empmaster-emp_master_nationality_id">
                    <label class="control-label" for="emp_master_nationality_id"><?php echo lang('common_nationality'); ?></label>
                    <?php 
                    echo form_dropdown('emp_master_nationality_id', $nationality, $person_info->emp_master_nationality_id, 'class="form-control" id="emp_master_nationality_id"');
                    ?>
                    <div class="help-block"></div>
                </div>    
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empinfo-joined_date">
                    <label class="control-label" for="joined_date"><?php echo lang('common_joined_date'); ?></label>
                    <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                        <input type="text" id="joined_date" class="form-control hasDatepicker" name="joined_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $person_info->joined_date != "" ? date(get_date_format(), strtotime($person_info->joined_date)) : ""; ?>">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                    <div class="help-block"></div>
                </div>   
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empmaster-emp_master_department_id">
                    <label class="control-label" for="emp_master_department_id"><?php echo lang('common_department'); ?></label>
                    <?php 
                    echo form_dropdown('emp_master_department_id', $emp_departments, $person_info->emp_master_department_id, 'class="form-control" id="emp_master_department_id"');
                    ?>
                    <div class="help-block"></div>
                </div>    
            </div>
            
            <div class="col-xs-12 col-sm-4 col-lg-4"> 
                <div class="form-group">
                    <label class="control-label" for="emp_master_department_id"><?php echo lang('employees_teach_major'); ?></label>
                    <?php
                        echo form_dropdown('majors[]', $major, $edit_major, 'class="selectpicker form-control" id="sl_major" multiple data-selected-text-format="count > 3"');
                    ?>
                </div>
            </div>



        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
               <div class="form-group field-empinfo-emp_maritalstatus">
                    <label class="control-label" for="emp_maritalstatus"><?php echo lang('common_marital_status'); ?></label>
                    <?php echo form_dropdown('emp_maritalstatus', $emp_maritalstatus, $person_info->emp_maritalstatus, 'class="form-control" id="emp_maritalstatus"'); ?>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="">
                    <?php
                    echo form_label(lang('common_total_experience') . ':', 'emp_experience_year', array('class' => ''));
                    ?>
                </div>
                <div class="col-sm-6 col-xs-12 no-padding">
                    <div class="form-group field-empinfo-emp_experience_year">
                        <?php echo form_dropdown("emp_experience_year", $years, $person_info->emp_experience_year, 'class="form-control" id="emp_experience_year"'); ?>
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 no-padding">
                    <div class="form-group field-empinfo-emp_experience_month">
                        <?php echo form_dropdown("emp_experience_month", $months, $person_info->emp_experience_month, 'class="form-control" id="emp_experience_month"'); ?>
                        <div class="help-block"></div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empmaster-emp_master_designation_id">
                    <label class="control-label" for="emp_master_designation_id"><?php echo lang('common_designation'); ?></label>
                    <?php 
                    echo form_dropdown('emp_master_designation_id', $emp_designations, $person_info->emp_master_designation_id, 'class="form-control" id="emp_master_designation_id"');
                    ?>
                    <div class="help-block"></div>
                </div>    
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
            <div class="col-xs-12 col-sm-4 col-lg-4">
               <div class="form-group field-empinfo-emp_birthplace">
                    <label class="control-label" for="emp_birthplace"><?php echo lang('common_birthplace'); ?></label>
                    <input type="text" id="emp_birthplace" class="form-control" name="emp_birthplace" value="<?php echo $person_info->emp_birthplace; ?>" maxlength="45">
                    <div class="help-block"></div>
                </div>    
            </div>

            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empinfo-emp_religion">
                    <label class="control-label" for="emp_religion"><?php echo lang('common_religion'); ?></label>
                    <input type="text" id="emp_religion" class="form-control" name="emp_religion" value="<?php echo $person_info->emp_religion; ?>" maxlength="50">
                    <div class="help-block"></div>
                </div>    
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4">
                <div class="form-group field-empinfo-emp_languages">
                    <label class="control-label" for="emp_languages"><?php echo lang('common_languages'); ?></label>
                    <input type="text" id="emp_languages" class="form-control input-md" name="emp_languages" value="<?php echo $person_info->emp_languages; ?>" placeholder="">
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
    	    <a class="btn btn-default btn-block" href="<?php echo site_url("$controller_name/detail/$person_info->person_id"); ?>"><?php echo lang('common_cancel'); ?></a>	
        </div>
    </div>
	</form>   
    </div>
  </div>
</div>
    </section>
<script type="text/javascript">
    $(function(){
        $('select[name="emp_master_department_id"]').change(function(){
            var id = $(this).val();
            var url_title = "<?=site_url('professors/suggestion_major')?>";
            var dataDepartment = { id: id};                
                $.ajax({
                    type: "POST",
                    url: url_title, 
                    data: dataDepartment,
                    dataType:"json",
                    success: function(get_data){
                        $("#sl_major").html('');
                        $.each(get_data,function(key,val){
                            var opt = $('<option />', {
                                value: val.skill_id,
                                text: val.skill_name
                            });
                            $("#sl_major").append(opt);
                        });
                        $("#sl_major").selectpicker('refresh');
                    },
                });
        });
    });
</script>