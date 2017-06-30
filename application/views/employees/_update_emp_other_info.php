<section class="content" style="min-height: 303px;">
        <style>
.box .box-solid {
     background-color: #F8F8F8;
}
</style>
<div class="col-xs-12">
      <div class="col-lg-8 col-sm-8 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-edit"></i> <?php echo lang('employees_info'); ?> :  <?php echo $person_other_info->last_name .' '.$person_other_info->first_name; ?> </h3>
      </div>
      <div class="col-xs-4"></div>
      <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
            <div class="col-xs-4"></div>
            <div class="col-xs-4"></div>
            <div class="col-xs-4 left-padding">
               <a class="btn btn-block btn-back" href="<?php echo site_url("$controller_name/detail/$person_other_info->person_id"); ?>" onclick="js:history.go(-1);return false;"><?php echo lang('common_back') ?></a>
          </div>
      </div>
</div>

<div class="col-xs-12 col-lg-12">
    <div class="box-info box view-item col-xs-12 col-lg-12">
        <div class="emp-master-update">   

            <?php
                echo form_open($controller_name.'/do_update_other_info/'.$person_other_info->emp_info_id, array('id' => 'employee_form', 'class' => 'form-horizontal'));
            ?>
            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                <div class="box-header with-border">
                    <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('employees_info'); ?></h4>
                    <div class="clearboth"></div>
                </div>

                <div class="box-body">

                    <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                        <div class="col-sm-6 col-xs-12">
                            <?php echo form_label(lang('employees_attendance_card_id') . ':', 'emp_attendance_card_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_attendance_card_id',
                                'id' => 'emp_attendance_card_id',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_attendance_card_id));
                            echo form_hidden('original_emp_attendance_card_id', $person_other_info->emp_attendance_card_id);
                            ?>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <?php echo form_label(lang('employees_bank_account_no') . ':', 'emp_bankaccount_no', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_bankaccount_no',
                                'id' => 'emp_bankaccount_no',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_bankaccount_no));
                            ?>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                        <div class="col-sm-6 col-xs-12">
                            <?php echo form_label(lang('employees_mother_name') . ':', 'emp_mother_name', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_mother_name',
                                'id' => 'emp_mother_name',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_mother_name));
                            ?>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <?php echo form_label(lang('employees_reference') . ':', 'emp_reference', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_reference',
                                'id' => 'emp_reference',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_reference));
                            ?>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                        <div class="col-sm-6 col-xs-12">
                            <?php echo form_label(lang('employees_father_name') . ':', 'emp_father_name', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_father_name',
                                'id' => 'emp_father_name',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_father_name));
                            ?>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <?php echo form_label(lang('employees_reference') . ':', 'emp_reference', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_reference_father',
                                'id' => 'emp_reference_father',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_reference_father));
                            ?>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                        <div class="col-sm-12 col-xs-12">
                            <?php echo form_label(lang("employees_specialization") . ':', 'emp_specialization', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_specialization',
                                'id' => 'emp_specialization',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_specialization));
                            ?>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                        <div class="col-sm-12 col-xs-12">
                            <?php echo form_label(lang('common_languages') . ':', 'emp_languages', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_languages',
                                'id' => 'emp_hobbies',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_languages));
                            ?>
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                        <div class="col-sm-12 col-xs-12">
                            <?php echo form_label(lang('common_hobbies') . ':', 'emp_hobbies', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                            <?php
                            echo form_input(array(
                                'name' => 'emp_hobbies',
                                'id' => 'emp_hobbies',
                                'class' => 'form-control',
                                'value' => $person_other_info->emp_hobbies));
                            ?>
                        </div>
                    </div>

                </div><!--./end box-body-->
            </div><!--/end box-->
 
            <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-block btn-info"><?php echo lang('common_update'); ?></button>  
                </div>
                <div class="col-xs-6">
                   <a class="btn btn-default btn-block" href="<?php echo site_url("$controller_name/detail/$person_other_info->person_id"); ?>"><?php echo lang('common_cancel'); ?></a>   
                </div>
            </div>   
        <?php echo form_close(); ?>  
        </div>
    </div>
</div>
</section>

