<style type="text/css">
  textarea.form-control {
    height: 106px;
  }
</style>
<section class="content" style="min-height: 303px;">  

<div class="col-xs-12 col-sm-12">
  <h3 class="box-title">
    <i class="fa fa-<?php echo $fe_sign; ?>"></i><?php echo lang('employees_update_guardian_details')?> : <?php echo $emp_guardians->last_name .' '.$emp_guardians->first_name; ?> <div class="pull-right">
      <a class="btn btn-back" href="<?php echo site_url("$controller_name/detail/$emp_guardians->person_id"); ?>" onclick="js:history.go(-1);return false;"><?php echo lang('common_back'); ?></a></div>
  </h3> 
</div>

<div class="stu-guardians-create">
    
<div class="col-xs-12 col-lg-12">
  <div class="box-success box view-item col-xs-12 col-lg-12">
   <div class="stu-guardians-form">
    <?php
        echo form_open($controller_name.'/do_edit_guardian/'.$emp_guardians->emp_info_id, array('id' => 'guardians_form', 'class' => 'form-horizontal'));
    ?>
            <div class="box-header with-border">
                    <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('employees_info'); ?></h4>
                    <div class="clearboth"></div>
                </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('common_name'). ':', 'emp_guardian_name', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_name',
                        'id' => 'emp_guardian_name',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_name ));
                    ?>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('common_name_kh'). ':', 'emp_guardian_name_kh', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_name_kh',
                        'id' => 'emp_guardian_name_kh',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_name_kh ));
                    ?>
                </div>
            </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_relation'). ':', 'emp_guardian_relation', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_relation',
                        'id' => 'emp_guardian_relation',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_relation));
                    ?>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_relation_kh'). ':', 'emp_guardian_relation', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_relation_kh',
                        'id' => 'emp_guardian_relation_kh',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_relation_kh));
                    ?>
                </div>
            </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                <div class="col-sm-12 col-xs-12">
                    <?php echo form_label( lang('employees_qualification'). ':', 'emp_guardian_qualification', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_qualification',
                        'id' => 'emp_guardian_qualification',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_qualification));
                    ?>
                </div> 
            </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_occupation'). ':', 'emp_guardian_occupation', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_occupation',
                        'id' => 'emp_guardian_occupation',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_occupation));
                    ?>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_occupation_kh'). ':', 'emp_guardian_occupation_kh', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_occupation_kh',
                        'id' => 'emp_guardian_occupation_kh',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_occupation_kh));
                    ?>
                </div> 
            </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_income'). ':', 'emp_guardian_income', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_income',
                        'id' => 'emp_guardian_income',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_income));
                    ?>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_mobile_no'). ':', 'emp_guardian_mobile_no', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_mobile_no',
                        'id' => 'emp_guardian_mobile_no',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_mobile_no));
                    ?>
                </div>
            </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_phone_no'). ':', 'emp_guardian_phone_no', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_phone_no',
                        'id' => 'emp_guardian_phone_no',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_phone_no ));
                    ?>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_email'). ':', 'emp_guardian_email_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_input(array(
                        'name' => 'emp_guardian_email_id',
                        'id' => 'emp_guardian_email_id',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_email_id ));
                    ?>
                </div>
            </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_office_address'). ':', 'emp_guardian_officeadd', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_textarea(array(
                        'name' => 'emp_guardian_officeadd',
                        'id' => 'emp_guardian_officeadd',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_officeadd ));
                    ?>
                </div>
                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_office_address_kh'). ':', 'emp_guardian_officeadd_kh', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_textarea(array(
                        'name' => 'emp_guardian_officeadd_kh',
                        'id' => 'emp_guardian_officeadd_kh',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_officeadd_kh ));
                    ?>
                </div>
            </div>

            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  

                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_home_address'). ':', 'emp_guardian_homeadd', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_textarea(array(
                        'name' => 'emp_guardian_homeadd',
                        'id' => 'emp_guardian_homeadd',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_homeadd ));
                    ?>
                </div>

                <div class="col-sm-6 col-xs-12">
                    <?php echo form_label( lang('employees_home_address_kh'). ':', 'emp_guardian_homeadd_kh', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                    <?php
                    echo form_textarea(array(
                        'name' => 'emp_guardian_homeadd_kh',
                        'id' => 'emp_guardian_homeadd_kh',
                        'class' => 'form-control',
                        'value' => $emp_guardians->emp_guardian_homeadd_kh));
                    ?>
                </div>
            </div>

          <div class="col-xs-12 col-sm-6 col-lg-4 no-padding">
              <div class="col-xs-6">
                    <button type="submit" class="btn btn-block btn-success"><?php echo lang('common_save'); ?></button> 
              </div>
              <div class="col-xs-6">
                  <a class="btn btn-default btn-block" href="<?php echo site_url("$controller_name/detail/$emp_guardians->person_id"); ?>"><?php echo lang('common_cancel'); ?></a> 
              </div>
          </div>
    <?php echo form_close(); ?>

    </div>
  </div>
</div>
</div>
</section>