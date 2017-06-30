<div class="form-group required"  style="margin-bottom: 10px;">
    <?php
    $required = "required";
    echo form_label(lang('common_first_name') . ':', 'first_name', array('class' => $required . ' col-sm-3 col-md-3 col-lg-2 control-label'));
    ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'first_name',
            'id' => 'first_name',
            'class' => 'filter form-control',
            'value' => $person_info->first_name)
        );
        ?>
    </div>
</div>

<div class="form-group required" style="margin-bottom: 10px;">
    <?php
    echo form_label(
        lang('common_last_name') . ':', 'last_name',
        array('class' => $required . ' col-sm-3 col-md-3 col-lg-2 control-label')
    );
    ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
             'class' => 'form-control',
             'name' => 'last_name',
            'id' => 'last_name',
            'class' => 'filter form-control',
            'value' => $person_info->last_name)
        );
        ?>
    </div>
</div>
<div class="form-group required" style="margin-bottom: 10px;">
    <?php
    $required = "required";
    echo form_label(
        lang('common_first_name').lang('common_kh') . ':', 'first_name_kh',
        array('class' => $required . ' col-sm-3 col-md-3 col-lg-2 control-label')
    );
    ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
             'class' => 'form-control',
             'name' => 'first_name_kh',
            'id' => 'first_name_kh',
            'class' => 'filter form-control',
            'value' => $person_info->first_name_kh)
        );
        ?>
    </div>
</div>
<div class="form-group required" style="margin-bottom: 10px;">
    <?php
    echo form_label(lang('common_last_name') .lang('common_kh') . ':', 'last_name_kh', array('class' => $required . ' col-sm-3 col-md-3 col-lg-2 control-label'));
    ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
             'class' => 'form-control',
             'name' => 'last_name_kh',
            'id' => 'last_name_kh',
            'class' => 'filter form-control',
            'value' => $person_info->last_name_kh)
        );
        ?>
    </div>
</div>
<div class="form-group required" style="margin-bottom: 10px;">
    <?php echo form_label(lang('common_email') . ':', 'email', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label ' . ($controller_name == 'employees' ? 'required' : 'not_required'))); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'email',
            'id' => 'email',
            'class' => 'width-100',
            'value' => $person_info->email)
        );
        ?>
    </div>
    <?php echo form_hidden("original_email", $person_info->email); ?>
</div>
<div class="form-group" style="margin-bottom: 10px;">   
    <?php echo form_label(lang('common_phone_number') . ':', 'phone_number', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'phone_number',
            'id' => 'phone_number',
            'class' => 'width-100',
            'value' => $person_info->phone_number));
        ?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
    <?php echo form_label(lang('common_dob') . ':', 'emp_dob', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
            <input type="text" id="emp_dob" class="form-control hasDatepicker" name="emp_dob" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $dob = $person_info->dob != "" ? date('d-m-Y', strtotime($person_info->dob)) : ""; ?>">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </span>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
    <?php echo form_label(lang('common_gender') . ':', 'gender', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        $genders = array("" => lang("common_select"), "F" => lang("common_female"), "M" => lang("common_male"));
        echo form_dropdown("gender", $genders, $person_info->gender, 'class="form-control"');
        ?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
    <?php echo form_label(lang('common_expired_date') . ':', 'expired_date', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
            <input type="text" id="expired_date" class="form-control hasDatepicker" name="expired_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $expired_date = $person_info->expired_date != "" ? date('d-m-Y', strtotime($person_info->expired_date)) : ""; ?>">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </span>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
    <?php echo form_label(lang('common_joined_date') . ':', 'joined_date', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
            <input type="text" id="joined_date" class="form-control hasDatepicker" name="joined_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $joined_date = $person_info->joined_date != "" ? date('d-m-Y', strtotime($person_info->joined_date)) : ""; ?>">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </span>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;"> 
    <?php echo form_label(lang('common_degree') . ':', 'degree_level', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php echo form_dropdown("degree_level", $degree, $person_info->degree_level, 'class="form-control"');?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;"> 
    <?php echo form_label(lang('common_professional_background') . ':', 'skill', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
            'class' => 'form-control',
            'name' => 'skill',
            'id' => 'skill',
            'class' => 'width-100',
            'value' => $person_info->skill
        ));
        ?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
    <?php echo form_label(lang('employees_photo') . ':', 'photo', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
</div>

<div class="cod-md-11">
    <label class="col-sm-3 col-md-3 col-lg-2  ">&nbsp;</label>
    <div class="col-sm-9 col-md-9 col-lg-0">
        <ul class="list-unstyled text-center" style="display: inline-block;">
            <li>
                <div id="avatar" style="border:solid 1px #ccc">
                    <div class="">                        
                        <?php if($profile): ?>
                            <img class="file-input-thumb" width="150" src="<?php echo base_url("assets/professor/$profile") ?>">
                        <?php endif ?>
                    </div>
                </div>
            </li>
            <li>
            <?//php echo form_open_multipart('upload/do_upload');?>
            <input type="file" name="image_id" size="20" id="image_id" value="" />
            <!-- $person_info->image_id -->            
            </li>
        </ul>
    </div>
</div>

            <div class="form-group" style="margin-bottom: 10px;">
                <?php echo form_label(lang('common_cv') . ':', 'document', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
            </div>
            <div class="cod-md-11">
                <label class="col-sm-3 col-md-3 col-lg-2">&nbsp;</label>
                <div class="col-sm-9 col-md-9 col-lg-0">
                    <ul class="list-unstyled text-center">
                        <li >
                            <div id="avatar">
                                <div class="col-sm-9 col-md-9 col-lg-5">
                                </div>
                            </div>
                            <br /><br />
                        </li>
                        <li>
                            <input type="file" name="filename[]" size="20" id="document" value="" multiple/>
                        </li>
                    </ul>
                </div>
            </div>

<?php if ($person_info->image_id) { ?>
<!--     <div class="form-group" style="margin-bottom: 10px;">
        <?php echo form_label(lang('items_del_image') . ':', 'del_image', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
        <div class="col-sm-9 col-md-9 col-lg-5">
            <?php
            echo form_checkbox(array(
                'name' => 'del_image',
                'id' => 'del_image',
                'class' => 'form-control delete-checkbox',
                'value' => 1
            ));
            ?>
        </div>
    </div> -->
<?php } ?>

                            <!-- <div class="form-group" style="margin-bottom: 10px;">
                                <?php echo form_label(lang('common_address') . ':', 'address', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-5">
                                    <?php
                                    echo form_input(array(
                                        'class' => 'form-control form-inps',
                                        'name' => 'address',
                                        'id' => 'address',
                                        'value' => $person_info->address_1));
                                    ?>
                                </div>
                            </div> -->

<div class="form-group" style="margin-bottom: 10px;">
    <?php echo form_label(lang('common_home_no') . ':', 'home_no', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
            'class' => 'form-control form-inps',
            'name' => 'home_no',
            'id' => 'home_no',
            'value' => $person_info->home_no));
        ?>
    </div>
</div>

<div class="form-group" style="margin-bottom: 10px;">
        <?php echo form_label(lang('common_street_no') . ':', 'street_no', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
<?php
echo form_input(array(
    'class' => 'form-control form-inps',
    'name' => 'street_no',
    'id' => 'street_no',
    'value' => $person_info->street_no));
?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
        <?php echo form_label(lang('common_district') . ':', 'district', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
<?php
echo form_input(array(
    'class' => 'form-control form-inps',
    'name' => 'district',
    'id' => 'district',
    'value' => $person_info->district));
?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
        <?php echo form_label(lang('common_commune') . ':', 'commune', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
<?php
echo form_input(array(
    'class' => 'form-control form-inps',
    'name' => 'commune',
    'id' => 'commune',
    'value' => $person_info->commune));
?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
        <?php echo form_label(lang('common_province') . ':', 'province', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
            echo form_dropdown("province", $province, $person_info->province, 'class="form-control"');
        ?>
    </div>
</div>
<div class="form-group" style="margin-bottom: 10px;">
    <?php echo form_label(lang('common_zip') . ':', 'zip', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        echo form_input(array(
            'class' => 'form-control form-inps',
            'name' => 'zip',
            'id' => 'zip',
            'value' => $person_info->zip));
        ?>
    </div>
</div>

<!-- <div class="form-group" style="margin-bottom: 10px;">
<?php echo form_label(lang('common_country') . ':', 'country', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
<?php
echo form_input(array(
    'class' => 'form-control form-inps',
    'name' => 'country',
    'id' => 'country',
    'value' => $person_info->country));
?>
    </div>
</div> -->