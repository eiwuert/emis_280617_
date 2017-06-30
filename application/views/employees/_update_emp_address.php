<section class="content" style="min-height: 303px;">
    <style>
    .box .box-solid {
         background-color: #F8F8F8;
    }
    </style>
    <div class="col-xs-12">
        <div class="col-lg-8 col-sm-8 col-xs-12 no-padding">
            <h3 class="box-title"><i class="fa fa-edit"></i> <?php echo lang('employees_update_address_details'); ?> :  <?php echo $emp_address->last_name.' '.$emp_address->first_name; ?> </h3>
        </div>
        <div class="col-xs-4"></div>
        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
    	   <div class="col-xs-4"></div>
    	   <div class="col-xs-4"></div>
    	   <div class="col-xs-4 left-padding">
    	       <a class="btn btn-block btn-back" href="<?php echo site_url("$controller_name/detail/$emp_address->person_id"); ?>" onclick="js:history.go(-1);return false;"><?php echo lang('common_back') ?></a>	
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-lg-12">
        <div class="box-info box view-item col-xs-12 col-lg-12">
    	   <div class="stu-master-update">

                <?php
                    echo form_open($controller_name.'/do_update_address/' . $emp_address->emp_address_id, array('id' => 'address_form', 'class' => 'form-horizontal'));
                ?>
                
                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('common_current_address'); ?></h4>
                            <div class="clearboth"></div>
                        </div>

                        <div class="box-body"> 
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-empaddress-emp_cadd_house_no">
                                        <label class="control-label" for="emp_cadd_house_no"><?php echo lang('employees_house_no')?></label>
                                        <input type="text" id="emp_cadd_house_no" class="form-control" name="emp_cadd_house_no" maxlength="25" value="<?php echo $emp_address->emp_cadd_house_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-empaddress-emp_cadd_street_no">
                                        <label class="control-label" for="emp_cadd_street_no"><?php echo lang('employees_street_no')?></label>
                                        <input type="text" id="emp_cadd_street_no" class="form-control" name="emp_cadd_street_no" maxlength="25" value="<?php echo $emp_address->emp_cadd_street_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-empaddress-emp_cadd_district">
                                        <label class="control-label" for="emp_cadd_district"><?php echo lang('employees_district')?></label>
                                        <input type="text" id="emp_cadd_district" class="form-control" name="emp_cadd_district" maxlength="25" value="<?php echo $emp_address->emp_cadd_district?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-empaddress-emp_cadd_commune">
                                        <label class="control-label" for="emp_cadd_commune"><?php echo lang('employees_commune')?></label>
                                        <input type="text" id="emp_cadd_commune" class="form-control" name="emp_cadd_commune" maxlength="25" value="<?php echo $emp_address->emp_cadd_commune?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-empaddress-emp_cadd_province">
                                        <label class="control-label" for="emp_cadd_province"><?php echo lang('employees_province')?></label>
                                        <?php echo form_dropdown('emp_cadd_province', $province, $emp_address->emp_cadd_province, 'class="form-control" id="emp_cadd_province"'); ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <div class="field-empaddress-emp_cadd_phone_no">
                                        <label class="control-label" for="emp_cadd_phone_no"><?php echo lang('employees_phone_no')?></label>
                                        <input type="text" id="emp_cadd_phone_no" class="form-control" name="emp_cadd_phone_no" maxlength="25" value="<?php echo $emp_address->emp_cadd_phone_no?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>   
                            <!-- <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-12 col-lg-12">
                           	        <div class="field-empaddress-emp_cadd">
                                        <label class="control-label" for="emp_cadd"><?php echo lang('employees_address'); ?></label>
                                        <textarea id="emp_cadd" class="form-control" name="emp_cadd" maxlength="255"><?php echo $emp_address->emp_cadd; ?></textarea>
                                       
                                        <div class="help-block"></div>
                                    </div>
                                </div>	
                            </div> -->

                            <!-- <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                            	    <div class="field-empaddress-emp_cadd_country">
                                        <label class="control-label" for="emp_cadd_country"><?php echo lang('employees_country'); ?></label>

                                        <?php echo form_dropdown('emp_cadd_country', $country, $emp_address->emp_cadd_country, 'class="form-control" id="emp_cadd_country"'); ?>

                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                               	    <div class="field-empaddress-emp_cadd_state">
                                        <label class="control-label" for="emp_cadd_state"><?php echo lang('employees_state')?></label>
                                        
                                        <?php echo form_dropdown('emp_cadd_state', $state, $emp_address->emp_cadd_state, 'class="form-control" id="emp_cadd_state"'); ?>

                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div> -->

                            <!-- <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                	<div class="field-empaddress-emp_cadd_city">
                                        <label class="control-label" for="emp_cadd_city"><?php echo lang('employees_city')?></label>

                                        <?php echo form_dropdown('emp_cadd_city', $city, $emp_address->emp_cadd_city, 'class="form-control" id="emp_cadd_city"'); ?>
                                    
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                	<div class="field-empaddress-emp_cadd_pincode">
                                        <label class="control-label" for="emp_cadd_pincode"><?php echo lang('employees_pincode')?></label>
                                        <input type="text" id="emp_cadd_pincode" class="form-control" name="emp_cadd_pincode" maxlength="6" value="<?php echo $emp_address->emp_cadd_pincode?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div> -->
                            

                        </div> <!--/ box-body -->
                    </div> <!--/ box -->

                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('common_permenant_address'); ?></h4>
                            <div class="clearboth"></div>
                        </div>
                        <div class="box-body">

                        <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-empaddress-emp_padd_house_no">
                                    <label class="control-label" for="emp_padd_house_no"><?php echo lang('employees_house_no')?></label>
                                    <input type="text" id="emp_padd_house_no" class="form-control" name="emp_padd_house_no" maxlength="25" value="<?php echo $emp_address->emp_padd_house_no?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-empaddress-emp_padd_street_no">
                                    <label class="control-label" for="emp_padd_street_no"><?php echo lang('employees_street_no')?></label>
                                    <input type="text" id="emp_padd_street_no" class="form-control" name="emp_padd_street_no" maxlength="25" value="<?php echo $emp_address->emp_padd_street_no?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-empaddress-emp_padd_district">
                                    <label class="control-label" for="emp_padd_district"><?php echo lang('employees_district')?></label>
                                    <input type="text" id="emp_padd_district" class="form-control" name="emp_padd_district" maxlength="25" value="<?php echo $emp_address->emp_padd_district?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-empaddress-emp_padd_commune">
                                    <label class="control-label" for="emp_padd_commune"><?php echo lang('employees_commune')?></label>
                                    <input type="text" id="emp_padd_commune" class="form-control" name="emp_padd_commune" maxlength="25" value="<?php echo $emp_address->emp_padd_commune?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-empaddress-emp_padd_province">
                                    <label class="control-label" for="emp_padd_province"><?php echo lang('employees_province')?></label>
                                    <?php echo form_dropdown('emp_padd_province', $province, $emp_address->emp_padd_province, 'class="form-control" id="emp_padd_province"'); ?>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                <div class="field-empaddress-emp_padd_phone_no">
                                    <label class="control-label" for="emp_padd_phone_no"><?php echo lang('employees_phone_no')?></label>
                                    <input type="text" id="emp_padd_phone_no" class="form-control" name="emp_padd_phone_no" maxlength="25" value="<?php echo $emp_address->emp_padd_phone_no?>">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>



                    <!-- 
                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                        	<div class="field-empaddress-emp_padd_country">
                                <label class="control-label" for="emp_padd_country"><?php echo lang('employees_country')?></label>
                                
                                    <?php echo form_dropdown('emp_padd_country', $country, $emp_address->emp_padd_country, 'class="form-control" id="emp_padd_country"'); ?>
                               
                                <div class="help-block"></div>
                            </div>
                        </div>
                    	<div class="col-xs-12 col-sm-6 col-lg-6">
                    	    <div class="field-empaddress-emp_padd_state">
                                <label class="control-label" for="emp_padd_state"><?php echo lang('employees_state')?></label>
                                        
                                        <?php echo form_dropdown('emp_padd_state', $state, $emp_address->emp_padd_state, 'class="form-control" id="emp_padd_state"'); ?>

                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                  	        <div class="field-empaddress-emp_padd_city">
                                <label class="control-label" for="emp_padd_city"><?php echo lang('employees_city')?></label>
                                
                                <?php echo form_dropdown('emp_padd_city', $city, $emp_address->emp_padd_city, 'class="form-control" id="emp_padd_city"'); ?>

                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                    	    <div class="field-empaddress-emp_padd_pincode">
                                <label class="control-label" for="emp_padd_pincode"><?php echo lang('employees_pincode')?></label>
                                <input type="text" id="emp_padd_pincode" class="form-control" name="emp_padd_pincode" maxlength="6" value="<?php echo $emp_address->emp_padd_pincode?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                    	    <div class="field-empaddress-emp_padd_house_no">
                                <label class="control-label" for="emp_padd_house_no"><?php echo lang('employees_house_no')?></label>
                                <input type="text" id="emp_padd_house_no" class="form-control" name="emp_padd_house_no" maxlength="25" value="<?php echo $emp_address->emp_padd_house_no?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-lg-6">
                    	    <div class="field-empaddress-emp_padd_phone_no">
                                <label class="control-label" for="emp_padd_phone_no"><?php echo lang('employees_phone_no')?></label>
                                <input type="text" id="emp_padd_phone_no" class="form-control" name="emp_padd_phone_no" maxlength="25" value="<?php echo $emp_address->emp_padd_phone_no?>">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>	 -->
     
    	       </div> <!--/ box-body -->
            </div> <!--/ box -->

            <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
        	   <div class="col-xs-6">
                    <button type="submit" class="btn btn-block btn-info"><?php echo lang('common_update'); ?></button>
                </div>
        	   <div class="col-xs-6">
        	       <a class="btn btn-default btn-block" href="<?php echo site_url("$controller_name/detail/$emp_address->person_id"); ?>"><?php echo lang('common_cancel'); ?></a>	
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>   
</div>
</div>

</section>