<section class="content" style="min-height: 303px;">
    <style>
    .box .box-solid {
         background-color: #F8F8F8;
    }
    </style>
    <div class="col-xs-12">
        <div class="col-lg-8 col-sm-8 col-xs-12 no-padding">
            <h3 class="box-title"><i class="fa fa-edit"></i> <?php echo lang('students_update_address_details'); ?> :  <?php echo $full_name; ?> </h3>
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
                    echo form_open($controller_name.'/do_update_address/' . $person_info->stu_info_id, array('id' => 'address_form', 'class' => 'form-horizontal'));
                ?>
                
                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('common_current_address'); ?></h4>
                            <div class="clearboth"></div>
                        </div>

                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                	<div class="field-stuaddress-stu_cadd_house_no">
                                        <label class="control-label" for="stu_cadd_house_no"><?php echo lang('students_house_no')?></label>
                                        <input type="text" id="stu_cadd_house_no" class="form-control" name="stu_cadd_house_no" maxlength="25" value="<?php echo $person_info->stu_cadd_house_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_str_no">
                                        <label class="control-label" for="stu_cadd_str_no"><?php echo lang('common_street_no')?></label>
                                        <input type="text" id="stu_cadd_str_no" class="form-control" name="stu_cadd_str_no" maxlength="25" value="<?php echo $person_info->stu_cadd_str_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_village">
                                        <label class="control-label" for="stu_cadd_village"><?php echo lang('common_village')?></label>
                                        <input type="text" id="stu_cadd_village" class="form-control" name="stu_cadd_village" maxlength="25" value="<?php echo $person_info->stu_cadd_village?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_commune">
                                        <label class="control-label" for="stu_cadd_commune"><?php echo lang('common_commune')?></label>
                                        <input type="text" id="stu_cadd_commune" class="form-control" name="stu_cadd_commune" maxlength="25" value="<?php echo $person_info->stu_cadd_commune?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_district">
                                        <label class="control-label" for="stu_cadd_district"><?php echo lang('common_district')?></label>
                                        <input type="text" id="stu_cadd_district" class="form-control" name="stu_cadd_district" maxlength="25" value="<?php echo $person_info->stu_cadd_district?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>                                
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_province">
                                        <label class="control-label" for="stu_cadd_province"><?php echo lang('common_province'); ?></label>
                                        <?php echo form_dropdown('stu_cadd_province', $provinces, $person_info->stu_cadd_province, 'class="form-control" id="stu_cadd_province"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_phone_no">
                                        <label class="control-label" for="stu_cadd_phone_no"><?php echo lang('students_phone_no')?></label>
                                        <input type="text" id="stu_cadd_phone_no" class="form-control" name="stu_cadd_phone_no" maxlength="25" value="<?php echo $person_info->stu_cadd_phone_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-lg-8">
                                    <div class="field-stuaddress-stu_cadd_country">
                                        <label class="control-label" for="stu_cadd_country"><?php echo lang('students_country'); ?></label>
                                        <?php echo form_dropdown('stu_cadd_country', $country, $person_info->stu_cadd_country, 'class="form-control" id="stu_cadd_country"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
                            <?php echo lang('common_current_address').' '.lang('common_kh'); ?></h4>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_house_no_kh">
                                        <label class="control-label" for="stu_cadd_house_no_kh"><?php echo lang('students_house_no')?></label>
                                        <input type="text" id="stu_cadd_house_no_kh" class="form-control" name="stu_cadd_house_no_kh" maxlength="25" value="<?php echo $person_info->stu_cadd_house_no_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_str_no_kh">
                                        <label class="control-label" for="stu_cadd_str_no_kh"><?php echo lang('common_street_no')?></label>
                                        <input type="text" id="stu_cadd_str_no_kh" class="form-control" name="stu_cadd_str_no_kh" maxlength="25" value="<?php echo $person_info->stu_cadd_str_no_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_village_kh">
                                        <label class="control-label" for="stu_cadd_village_kh"><?php echo lang('common_village')?></label>
                                        <input type="text" id="stu_cadd_village_kh" class="form-control" name="stu_cadd_village_kh" maxlength="25" value="<?php echo $person_info->stu_cadd_village_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_commune_kh">
                                        <label class="control-label" for="stu_cadd_commune_kh"><?php echo lang('common_commune')?></label>
                                        <input type="text" id="stu_cadd_commune_kh" class="form-control" name="stu_cadd_commune_kh" maxlength="25" value="<?php echo $person_info->stu_cadd_commune_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_district_kh">
                                        <label class="control-label" for="stu_cadd_district_kh"><?php echo lang('common_district')?></label>
                                        <input type="text" id="stu_cadd_district_kh" class="form-control" name="stu_cadd_district_kh" maxlength="25" value="<?php echo $person_info->stu_cadd_district_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_cadd_province_kh">
                                        <label class="control-label" for="stu_cadd_province_kh"><?php echo lang('common_province'); ?></label>
                                        <?php echo form_dropdown('stu_cadd_province_kh', $provinces, $person_info->stu_cadd_province_kh, 'class="form-control" id="stu_cadd_province_kh"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>  
                            </div>
                        </div> <!--/ box-body -->
                    </div> <!--/ box -->

                    <!-- Start Birth Address Block -->
                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('common_birth_address'); ?></h4>
                            <div class="clearboth"></div>
                        </div>

                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_house_no">
                                        <label class="control-label" for="stu_badd_house_no"><?php echo lang('students_house_no')?></label>
                                        <input type="text" id="stu_badd_house_no" class="form-control" name="stu_badd_house_no" maxlength="25" value="<?php echo $person_info->stu_badd_house_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_str_no">
                                        <label class="control-label" for="stu_badd_str_no"><?php echo lang('common_street_no')?></label>
                                        <input type="text" id="stu_badd_str_no" class="form-control" name="stu_badd_str_no" maxlength="25" value="<?php echo $person_info->stu_badd_str_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_village">
                                        <label class="control-label" for="stu_badd_village"><?php echo lang('common_village')?></label>
                                        <input type="text" id="stu_badd_village" class="form-control" name="stu_badd_village" maxlength="25" value="<?php echo $person_info->stu_badd_village?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_commune">
                                        <label class="control-label" for="stu_badd_commune"><?php echo lang('common_commune')?></label>
                                        <input type="text" id="stu_badd_commune" class="form-control" name="stu_badd_commune" maxlength="25" value="<?php echo $person_info->stu_badd_commune?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_district">
                                        <label class="control-label" for="stu_badd_district"><?php echo lang('common_district')?></label>
                                        <input type="text" id="stu_badd_district" class="form-control" name="stu_badd_district" maxlength="25" value="<?php echo $person_info->stu_badd_district?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_province">
                                        <label class="control-label" for="stu_badd_province"><?php echo lang('common_province')?></label>
                                        <?php echo form_dropdown('stu_badd_province', $provinces, $person_info->stu_badd_province, 'class="form-control" id="stu_badd_province"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_country">
                                        <label class="control-label" for="stu_badd_country"><?php echo lang('students_country'); ?></label>
                                        <?php echo form_dropdown('stu_badd_country', $country, $person_info->stu_badd_country, 'class="form-control" id="stu_badd_country"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
                            <?php echo lang('common_birth_address').' '.lang('common_kh'); ?></h4>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_house_no_kh">
                                        <label class="control-label" for="stu_badd_house_no_kh"><?php echo lang('students_house_no')?></label>
                                        <input type="text" id="stu_badd_house_no_kh" class="form-control" name="stu_badd_house_no_kh" maxlength="25" value="<?php echo $person_info->stu_badd_house_no_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_str_no_kh">
                                        <label class="control-label" for="stu_badd_str_no_kh"><?php echo lang('common_street_no')?></label>
                                        <input type="text" id="stu_badd_str_no_kh" class="form-control" name="stu_badd_str_no_kh" maxlength="25" value="<?php echo $person_info->stu_badd_str_no_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_village_kh">
                                        <label class="control-label" for="stu_badd_village_kh"><?php echo lang('common_village')?></label>
                                        <input type="text" id="stu_badd_village_kh" class="form-control" name="stu_badd_village_kh" maxlength="25" value="<?php echo $person_info->stu_badd_village_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_commune_kh">
                                        <label class="control-label" for="stu_badd_commune_kh"><?php echo lang('common_commune')?></label>
                                        <input type="text" id="stu_badd_commune_kh" class="form-control" name="stu_badd_commune_kh" maxlength="25" value="<?php echo $person_info->stu_badd_commune_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_district_kh">
                                        <label class="control-label" for="stu_badd_district_kh"><?php echo lang('common_district')?></label>
                                        <input type="text" id="stu_badd_district_kh" class="form-control" name="stu_badd_district_kh" maxlength="25" value="<?php echo $person_info->stu_badd_district_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_badd_province_kh">
                                        <label class="control-label" for="stu_badd_province_kh"><?php echo lang('common_province')?></label>
                                        <?php echo form_dropdown('stu_badd_province_kh', $provinces, $person_info->stu_badd_province_kh, 'class="form-control" id="stu_badd_province_kh"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--/ box-body -->
                    </div> <!--/ box -->

                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-info-circle"></i><?php echo lang('common_permenant_address'); ?></h4>
                            <div class="clearboth"></div>
                        </div>
                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                            	    <div class="field-stuaddress-stu_padd_house_no">
                                        <label class="control-label" for="stu_padd_house_no"><?php echo lang('students_house_no')?></label>
                                        <input type="text" id="stu_padd_house_no" class="form-control" name="stu_padd_house_no" maxlength="25" value="<?php echo $person_info->stu_padd_house_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                            	    <div class="field-stuaddress-stu_padd_phone_no">
                                        <label class="control-label" for="stu_padd_phone_no"><?php echo lang('students_phone_no')?></label>
                                        <input type="text" id="stu_padd_phone_no" class="form-control" name="stu_padd_phone_no" maxlength="25" value="<?php echo $person_info->stu_padd_phone_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_str_no">
                                        <label class="control-label" for="stu_padd_str_no"><?php echo lang('common_street_no')?></label>
                                        <input type="text" id="stu_padd_str_no" class="form-control" name="stu_padd_str_no" maxlength="25" value="<?php echo $person_info->stu_padd_str_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_village">
                                        <label class="control-label" for="stu_padd_village"><?php echo lang('common_village')?></label>
                                        <input type="text" id="stu_padd_village" class="form-control" name="stu_padd_village" maxlength="25" value="<?php echo $person_info->stu_padd_village?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_commune">
                                        <label class="control-label" for="stu_padd_commune"><?php echo lang('common_commune')?></label>
                                        <input type="text" id="stu_padd_commune" class="form-control" name="stu_padd_commune" maxlength="25" value="<?php echo $person_info->stu_padd_commune?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_district">
                                        <label class="control-label" for="stu_padd_district"><?php echo lang('common_district')?></label>
                                        <input type="text" id="stu_padd_district" class="form-control" name="stu_padd_district" maxlength="25" value="<?php echo $person_info->stu_padd_district?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_province">
                                        <label class="control-label" for="stu_padd_province"><?php echo lang('common_province'); ?></label>
                                        <?php echo form_dropdown('stu_padd_province', $provinces, $person_info->stu_padd_province, 'class="form-control" id="stu_padd_province"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 col-lg-8">
                                    <div class="field-stuaddress-stu_padd_country">
                                        <label class="control-label" for="stu_padd_country"><?php echo lang('students_country')?></label>
                                            <?php echo form_dropdown('stu_padd_country', $country, $person_info->stu_padd_country, 'class="form-control" id="stu_padd_country"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">
                            <?php echo lang('common_permenant_address').' '.lang('common_kh'); ?></h4>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_house_no_kh">
                                        <label class="control-label" for="stu_padd_house_no_kh"><?php echo lang('students_house_no')?></label>
                                        <input type="text" id="stu_padd_house_no_kh" class="form-control" name="stu_padd_house_no_kh" maxlength="25" value="<?php echo $person_info->stu_padd_house_no_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_str_no_kh">
                                        <label class="control-label" for="stu_padd_str_no_kh"><?php echo lang('common_street_no')?></label>
                                        <input type="text" id="stu_padd_str_no_kh" class="form-control" name="stu_padd_str_no_kh" maxlength="25" value="<?php echo $person_info->stu_padd_str_no_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_village_kh">
                                        <label class="control-label" for="stu_padd_village_kh"><?php echo lang('common_village')?></label>
                                        <input type="text" id="stu_padd_village_kh" class="form-control" name="stu_padd_village_kh" maxlength="25" value="<?php echo $person_info->stu_padd_village_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_commune_kh">
                                        <label class="control-label" for="stu_padd_commune_kh"><?php echo lang('common_commune')?></label>
                                        <input type="text" id="stu_padd_commune_kh" class="form-control" name="stu_padd_commune_kh" maxlength="25" value="<?php echo $person_info->stu_padd_commune_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_district_kh">
                                        <label class="control-label" for="stu_padd_district_kh"><?php echo lang('common_district')?></label>
                                        <input type="text" id="stu_padd_district_kh" class="form-control" name="stu_padd_district_kh" maxlength="25" value="<?php echo $person_info->stu_padd_district_kh?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-stuaddress-stu_padd_province_kh">
                                        <label class="control-label" for="stu_padd_province_kh"><?php echo lang('common_province'); ?></label>
                                        <?php echo form_dropdown('stu_padd_province_kh', $provinces, $person_info->stu_padd_province_kh, 'class="form-control" id="stu_padd_province_kh"'); ?>
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
            	       <a class="btn btn-default btn-block" href="<?php echo site_url("students/detail/$person_info->stu_info_id"); ?>"><?php echo lang('common_cancel'); ?></a>	
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>   
    </div>
</div>

</section>