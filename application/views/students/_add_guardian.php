<section class="content" style="min-height: 303px;">  

<div class="col-xs-12 col-sm-12">
	<h3 class="box-title">
		<i class="fa fa-<?php echo $fe_sign; ?>"></i> <?php echo $title_header; ?> : <?php echo $stu_full_name ? $stu_full_name : $guardian_info->guardian_name; ?>	<div class="pull-right">
			<a class="btn btn-back" href="<?php echo site_url("$controller_name/detail/$person_info->stu_info_id"); ?>" onclick="js:history.go(-1);return false;">Back</a>		</div>
	</h3> 
</div>

<div class="stu-guardians-create">
    
<div class="col-xs-12 col-lg-12">
  <div class="box-success box view-item col-xs-12 col-lg-12">
   <div class="stu-guardians-form">

    <?php
        echo form_open($controller_name.'/do_guardians/'.$form_guardian, array('id' => 'guardians_form', 'class' => 'form-horizontal'));
    ?>
           <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
              <!-- <div class="col-xs-12 col-sm-6 col-lg-6">
                  <div class="field-stuguardians-guardian_name required">
                          <label class="control-label" for="guardian_name"><?php echo lang('common_name')?></label>
                          <input type="text" id="guardian_name" class="form-control" name="guardian_name" maxlength="65" value="<?php echo $guardian_info->guardian_name?>">
                          <div class="help-block"></div>
                  </div>    
              </div>

              <div class="col-xs-12 col-sm-6 col-lg-6">
                  <div class="field-stuguardians-guardian_name_kh">
                          <label class="control-label" for="guardian_name_kh"><?php echo lang('common_name_kh')?></label>
                          <input type="text" id="guardian_name_kh" class="form-control" name="guardian_name_kh" maxlength="65" value="<?php echo $guardian_info->guardian_name_kh; ?>">
                          <div class="help-block"></div>
                  </div>    
              </div> -->
              <div class="col-xs-12 col-sm-12 col-lg-12">
                  <div class="field-stuguardians-guardian_relation">
                        <label class="control-label" for="guardian_relation_type"><?php echo lang('students_relation_id')?></label>
                        <?php echo form_dropdown('relation_id',$relation_id,$guardian_info->guardian_relation_id,'onchange="relation(this.value)" class="form-control"')?>
                        <div class="help-block"></div>
                  </div> 
              </div>  

                        <div class="dispaly_parent">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="field-stuguardians-guardian_father">
                                      <label class="control-label" for="guardian_father"><?php echo lang('students_father')?></label>
                                      <input type="text" id="guardian_father" class="form-control" name="guardian_father" maxlength="30" value="<?php echo $guardian_info->guardian_father?>">
                                      <div class="help-block"></div>
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="field-stuguardians-guardian_father_kh">
                                      <label class="control-label" for="guardian_father_kh"><?php echo lang('students_father_kh').lang('common_kh'); ?></label>
                                      <input type="text" id="guardian_father_kh" class="form-control" name="guardian_father_kh" maxlength="30" value="<?php echo $guardian_info->guardian_father_kh; ?>">
                                      <div class="help-block"></div>
                                </div>  
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="field-stuguardians-guardian_mother">
                                      <label class="control-label" for="guardian_mother"><?php echo lang('students_mother')?></label>
                                      <input type="text" id="guardian_mother" class="form-control" name="guardian_mother" maxlength="30" value="<?php echo $guardian_info->guardian_mother?>">
                                      <div class="help-block"></div>
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="field-stuguardians-guardian_mother_kh">
                                      <label class="control-label" for="guardian_mother_kh"><?php echo lang('students_mother_kh').lang('common_kh'); ?></label>
                                      <input type="text" id="guardian_mother_kh" class="form-control" name="guardian_mother_kh" maxlength="30" value="<?php echo $guardian_info->guardian_mother_kh; ?>">
                                      <div class="help-block"></div>
                                </div>  
                            </div>
                        </div>
                        <div class="dispaly_relation">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="field-stuguardians-guardian_relation">
                                      <label class="control-label" for="guardian_relation"><?php echo lang('students_relation')?></label>
                                      <input type="text" id="guardian_relation" class="form-control" name="guardian_relation" maxlength="30" value="<?php echo $guardian_info->guardian_relation?>">
                                      <div class="help-block"></div>
                                </div> 
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="field-stuguardians-guardian_relation_kh">
                                      <label class="control-label" for="guardian_relation_kh"><?php echo lang('students_relation').lang('common_kh'); ?></label>
                                      <input type="text" id="guardian_relation_kh" class="form-control" name="guardian_relation_kh" maxlength="30" value="<?php echo $guardian_info->guardian_relation_kh; ?>">
                                      <div class="help-block"></div>
                                </div>  
                            </div>
                        </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
              <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_mobile_no">
                        <label class="control-label" for="guardian_mobile_no"><?php echo lang('students_mobile_no')?></label>
                        <input type="text" id="guardian_mobile_no" class="form-control" name="guardian_mobile_no" maxlength="12" value="<?php echo $guardian_info->guardian_mobile_no?>">
                        <div class="help-block"></div>
                    </div>    
              </div>

              <div class="col-xs-12 col-sm-6 col-lg-6">
                  <div class="field-stuguardians-guardian_phone_no">
                        <label class="control-label" for="guardian_phone_no"><?php echo lang('students_phone_no')?></label>
                        <input type="text" id="guardian_phone_no" class="form-control" name="guardian_phone_no" maxlength="25" value="<?php echo $guardian_info->guardian_phone_no?>">
                        <div class="help-block"></div>
                  </div>    
              </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_occupation">
                        <label class="control-label" for="guardian_occupation"><?php echo lang('students_occupation')?></label>
                        <textarea id="guardian_occupation" class="form-control" name="guardian_occupation" maxlength="50"><?php echo $guardian_info->guardian_occupation?></textarea>
                        <div class="help-block"></div>
                    </div>    
                </div>
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_occupation_kh">
                        <label class="control-label" for="guardian_occupation_kh"><?php echo lang('students_occupation_kh')?></label>
                        <textarea id="guardian_occupation_kh" class="form-control" name="guardian_occupation_kh" maxlength="50"><?php echo $guardian_info->guardian_occupation_kh; ?></textarea>
                        <div class="help-block"></div>
                    </div>    
                </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_qualification">
                        <label class="control-label" for="guardian_qualification"><?php echo lang('students_qualification')?></label>
                        <textarea id="guardian_qualification" class="form-control" name="guardian_qualification" maxlength="50"><?php echo $guardian_info->guardian_qualification?></textarea>
                        <div class="help-block"></div>
                    </div>    
                </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
              <div class="col-xs-12 col-sm-6 col-lg-6">
                  <div class="field-stuguardians-guardian_income">
                      <label class="control-label" for="guardian_income"><?php echo lang('students_income')?></label>
                      <input type="text" id="guardian_income" class="form-control" name="guardian_income" maxlength="50" value="<?php echo $guardian_info->guardian_income?>">
                      <div class="help-block"></div>
                  </div>    
              </div>

              <div class="col-xs-12 col-sm-6 col-lg-6">
                  <div class="field-stuguardians-guardian_email">
                      <label class="control-label" for="guardian_email"><?php echo lang('students_email')?></label>
                      <input type="text" id="guardian_email" class="form-control" name="guardian_email" maxlength="65" value="<?php echo $guardian_info->guardian_email?>">
                      <div class="help-block"></div>
                  </div>    
              </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_home_address">
                        <label class="control-label" for="guardian_home_address"><?php echo lang('students_home_address')?></label>
                        <textarea id="guardian_home_address" class="form-control" name="guardian_home_address" maxlength="255"><?php echo $guardian_info->guardian_home_address?></textarea>
                        <div class="help-block"></div>
                    </div>    
                </div>

                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_office_address">
                        <label class="control-label" for="guardian_office_address"><?php echo lang('students_office_address')?></label>
                        <textarea id="guardian_office_address" class="form-control" name="guardian_office_address" maxlength="255"><?php echo $guardian_info->guardian_office_address?></textarea>
                        <div class="help-block"></div>
                    </div>    
                </div>
           </div>

           <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_home_address_kh">
                        <label class="control-label" for="guardian_home_address_kh"><?php echo lang('students_home_address').lang('common_kh'); ?></label>
                        <textarea id="guardian_home_address_kh" class="form-control" name="guardian_home_address_kh" maxlength="255"><?php echo $guardian_info->guardian_home_address_kh; ?></textarea>
                        <div class="help-block"></div>
                    </div>    
                </div>

                <div class="col-xs-12 col-sm-6 col-lg-6">
                    <div class="field-stuguardians-guardian_office_address_kh">
                        <label class="control-label" for="guardian_office_address_kh"><?php echo lang('students_office_address').lang('common_kh'); ?></label>
                        <textarea id="guardian_office_address_kh" class="form-control" name="guardian_office_address_kh" maxlength="255"><?php echo $guardian_info->guardian_office_address_kh; ?></textarea>
                        <div class="help-block"></div>
                    </div>    
                </div>
           </div>

          <div class="col-xs-12 col-sm-6 col-lg-4 no-padding">
              <div class="col-xs-6">
                    <button type="submit" class="btn btn-block btn-success"><?php echo $btn_submit; ?></button>	
              </div>
              <div class="col-xs-6">
                  <a class="btn btn-default btn-block" href="<?php echo site_url("$controller_name/detail/$person_info->stu_info_id"); ?>"><?php echo lang('common_cancel'); ?></a>	
              </div>
          </div>
    <?php echo form_close(); ?>

    </div>
  </div>
</div>
</div>
</section>

<script type="text/javascript">
  $(function(){    
    $('.dispaly_relation').hide();
  });
  function relation(relation){
      if(relation == 'Parents'){
        $('.dispaly_parent').show();        
        $('.dispaly_relation').hide();
      }else if(relation == 'Other'){
        $('.dispaly_parent').hide();        
        $('.dispaly_relation').show();
      }
  }
</script>