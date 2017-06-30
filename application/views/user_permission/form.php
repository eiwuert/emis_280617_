<?php echo $this->load->view('partial/header'); ?>
<div class=" alert alert-info" id='top'>
    <?php echo create_breadcrumb(); ?>
</div>
<div class="page-header" id='page-header'>
    <h1 ><i class="fa fa-pencil"></i> <?php
        if (!$person_info->person_id) {
            echo lang('employees_new');
        } else {
            echo lang('employees_update');
        }
        ?>
    </h1>
</div>
<div class="col-xs-12">
<?php echo lang('common_fields_required_message'); ?>
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>
                </span>
                <?php echo lang("employees_basic_information"); ?>
            </h5>
        </div>

        <div class="widget-body" style="margin-left: 13px;">
            <br>
            <?php
            $current_employee_editing_self = $this->Employee->get_logged_in_employee_info()->person_id == $person_info->person_id;
            ?>
            <?php
            echo form_open('user_permission/save/' . $person_info->person_id, array('id' => 'employee_form', 'class' => 'form-horizontal'));
            ?>
            <legend class="page-header text-info"> &nbsp; &nbsp; <?php echo lang("employees_login_info"); ?></legend>
            <div class="form-group required" style="margin-bottom: 10px;">	
                <?php echo form_label(lang('employees_username') . ':', 'username', array('class' => 'col-sm-3 col-md-3 col-lg-2 required control-label')); ?>
                <div class="col-sm-9 col-md-9 col-lg-5">
                    <?php
                    echo form_input(array(
                        'name' => 'username',
                        'id' => 'username',
                        'class' => 'form-control',
                        'value' => $person_info->username));
                    ?>
                </div>
                <?php echo form_hidden("original_username", $person_info->username); ?>
            </div>
            <div class="form-group required" style="margin-bottom: 10px;">	
                <?php echo form_label(lang('employees_password') . ':', 'password', array('class' => 'col-sm-3 col-md-3 col-lg-2 required control-label')); ?>
                <div class="col-sm-9 col-md-9 col-lg-5">
                    <?php
                    $pwd_placeholder = "Enter Password";
                    if ($person_info->person_id && $person_info->username) {
                        $pwd_placeholder = "********";
                    }
                    echo form_password(array(
                        'name' => 'password',
                        'id' => 'password',
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                        'placeholder' => $pwd_placeholder
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group required" style="margin-bottom: 10px;">    
                <?php echo form_label(lang('employees_repeat_password') . ':', 'repeat_password', array('class' => 'col-sm-3 col-md-3 col-lg-2 required control-label')); ?>
                <div class="col-sm-9 col-md-9 col-lg-5">
                    <?php
                    $repwd_placeholder = "Repeat Password";
                    if ($person_info->person_id && $person_info->username) {
                        $repwd_placeholder = "********";
                    }
                    echo form_password(array(
                        'name' => 'repeat_password',
                        'id' => 'repeat_password',
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                        'placeholder' => $repwd_placeholder
                    ));
                    ?>
                </div>
            </div>
            <div class="form-group required">   
                <?php echo form_label(lang('employees_user_type') . ':', 'user_type', array('class' => 'required col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                <div class="col-sm-9 col-md-9 col-lg-5">
                <?php
                $utypes = array("" => lang("common_select"));
                foreach($user_types as $row)
                { 
                    $utypes[$row->user_type_id] = $row->user_type;
                }
                echo form_dropdown('user_type', $utypes, $person_info->user_type_id, 'class="form-control form-inps"');
                ?>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 10px;">	
                <?php if (count($locations) == 1) { ?>
                <?php echo form_hidden('locations[]', current(array_keys($locations))); ?>
                <?php } else { ?>
                    <div class="form-group" style="margin-bottom: 10px;">	
                        <?php echo form_label(lang('employees_locations') . ':', 'location', array('class' => 'col-sm-3 col-md-3 col-lg-2 col-sm-3 col-md-3 col-lg-2 required')); ?>
                        <div class="col-sm-9 col-md-9 col-lg-5">
                            <ul id="locations_list" class="list-inline">
                                <?php
                                foreach ($locations as $location_id => $location) {
                                    $checkbox_options = array(
                                        'name' => 'locations[]',
                                        'value' => $location_id,
                                        'checked' => $location['has_access'],
                                    );

                                    if (!$location['can_assign_access']) {
                                        $checkbox_options['disabled'] = 'disabled';

                                        //Only send permission if checked
                                        if ($checkbox_options['checked']) {
                                            echo form_hidden('locations[]', $location_id);
                                        }
                                    }

                                    echo '<li>' . form_checkbox($checkbox_options) . ' ' . $location['name'] . '</li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-sm-9 col-md-9 col-lg-12">
                    <legend class="page-header text-info"> &nbsp; &nbsp; <?php echo lang("employees_permission_info"); ?></legend>
                    <div class="col-lg-9">
                        <p><?php echo lang("employees_permission_desc"); ?></p>
                        <ul id="permission_list" class="list-unstyled col-xs-12">
                            <?php
                            foreach ($all_modules->result() as $module) {
                                if($module->sub_module == '') { 
                                // if($module->sub_module == NULL) { 
                                    $checkbox_options = array(
                                        'name' => 'permissions[]',
                                        'value' => $module->module_id,
                                        'checked' => $this->Employee->has_module_permission($module->module_id, $person_info->person_id),
                                        'class' => 'module_checkboxes '
                                    );

                                    if ($logged_in_employee_id != 1) {
                                        if (($current_employee_editing_self && $checkbox_options['checked']) || !$this->Employee->has_module_permission($module->module_id, $logged_in_employee_id)) {
                                            $checkbox_options['disabled'] = 'disabled';

                                            //Only send permission if checked
                                            if ($checkbox_options['checked']) {
                                                echo form_hidden('permissions[]', $module->module_id);
                                            }
                                        }
                                    }
                                    ?>
                                <li>    
                                    <?php echo form_checkbox($checkbox_options); ?>
                                    <span class="text-danger purple"><?php echo $this->lang->line('module_' . $module->module_id); ?>:</span>
                                    <span class="text-warning"><?php echo $this->lang->line('module_' . $module->module_id . '_desc'); ?></span>
                                    <ul>
                                        <?php
                                        foreach ($this->Module_action->get_module_actions($module->module_id)->result() as $module_action) {
                                            $checkbox_options = array(
                                                'name' => 'permissions_actions[]',
                                                'value' => $module_action->module_id . "|" . $module_action->action_id,
                                                'checked' => $this->Employee->has_module_action_permission($module->module_id, $module_action->action_id, $person_info->person_id)
                                            );

                                            if ($logged_in_employee_id != 1) {
                                                if (($current_employee_editing_self && $checkbox_options['checked']) || (!$this->Employee->has_module_action_permission($module->module_id, $module_action->action_id, $logged_in_employee_id))) {
                                                    $checkbox_options['disabled'] = 'disabled';

                                                    //Only send permission if checked
                                                    if ($checkbox_options['checked']) {
                                                        echo form_hidden('permissions_actions[]', $module_action->module_id . "|" . $module_action->action_id);
                                                    }
                                                }
                                            }
                                            ?>
                                            <li>
                                            <?php echo form_checkbox($checkbox_options); ?>
                                                <span class="text-info"><?php echo $this->lang->line($module_action->action_name_key); ?></span>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                    <ul>
                                    <?php $is_sub = $this->Module->get_sub_module($module->module_id, $user_info->person_id); ?>
                                        <?php foreach ($is_sub->result() as $sub_module) {  // Each of sub module 1
                                        if ($sub_module->sub_module == $module->module_id && $sub_module->sub2_module == '') {
                                                $checkbox_options = array(
                                                    'name' => 'permissions[]',
                                                    'value' => $sub_module->module_id,
                                                    'checked' => $this->Employee->has_module_permission($sub_module->module_id, $person_info->person_id),
                                                    'class' => 'module_checkboxes '
                                                );

                                                if ($logged_in_employee_id != 1) {
                                                    if (($current_employee_editing_self && $checkbox_options['checked']) || !$this->Employee->has_module_permission($sub_module->module_id, $logged_in_employee_id)) {
                                                        $checkbox_options['disabled'] = 'disabled';

                                                        //Only send permission if checked
                                                        if ($checkbox_options['checked']) {
                                                            echo form_hidden('permissions[]', $sub_module->module_id);
                                                        }
                                                    }
                                                }
                                            ?>
                                            <li>    
                                            <?php echo form_checkbox($checkbox_options); ?>
                                                <span class="text-success"><?php echo $this->lang->line('module_' . $sub_module->module_id); ?>:</span>
                                                <span class="text-warning"><?php echo $this->lang->line('module_' . $sub_module->module_id . '_desc'); ?></span>


                                                <ul>
                                                <?php $is_sub2 = $this->Module->get_sub_module($module->module_id, $user_info->person_id); ?>
                                                <?php foreach ($is_sub2->result() as $sub_module2) {  // Each of sub module 2
                                                if ($sub_module2->sub_module == $module->module_id && $sub_module2->sub2_module == $sub_module->module_id) {
                                                        $checkbox_options = array(
                                                            'name' => 'permissions[]',
                                                            'value' => $sub_module2->module_id,
                                                            'checked' => $this->Employee->has_module_permission($sub_module2->module_id, $person_info->person_id),
                                                            'class' => 'module_checkboxes '
                                                        );

                                                        if ($logged_in_employee_id != 1) {
                                                            if (($current_employee_editing_self && $checkbox_options['checked']) || !$this->Employee->has_module_permission($sub_module2->module_id, $logged_in_employee_id)) {
                                                                $checkbox_options['disabled'] = 'disabled';

                                                                //Only send permission if checked
                                                                if ($checkbox_options['checked']) {
                                                                    echo form_hidden('permissions[]', $sub_module2->module_id);
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    <li>    
                                                    <?php echo form_checkbox($checkbox_options); ?>
                                                        <span class="text-success pink"><?php echo $this->lang->line('module_' . $sub_module2->module_id); ?>:</span>
                                                        <span class="text-warning"><?php echo $this->lang->line('module_' . $sub_module2->module_id . '_desc'); ?></span>

                                                        <ul>
                                                            <?php
                                                            foreach ($this->Module_action->get_module_actions($sub_module2->module_id)->result() as $sub_module_action) {
                                                                $checkbox_options = array(
                                                                    'name' => 'permissions_actions[]',
                                                                    'value' => $sub_module_action->module_id . "|" . $sub_module_action->action_id,
                                                                    'checked' => $this->Employee->has_module_action_permission($sub_module2->module_id, $sub_module_action->action_id, $person_info->person_id)
                                                                );

                                                                if ($logged_in_employee_id != 1) {
                                                                    if (($current_employee_editing_self && $checkbox_options['checked']) || (!$this->Employee->has_module_action_permission($sub_module2->module_id, $sub_module_action->action_id, $logged_in_employee_id))) {
                                                                        $checkbox_options['disabled'] = 'disabled';

                                                                        //Only send permission if checked
                                                                        if ($checkbox_options['checked']) {
                                                                            echo form_hidden('permissions_actions[]', $sub_module_action->module_id . "|" . $sub_module_action->action_id);
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <li>
                                                                <?php echo form_checkbox($checkbox_options); ?>
                                                                    <span class="text-info"><?php echo $this->lang->line($sub_module_action->action_name_key); ?></span>
                                                                </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                                <?php } // End if ?>
                                            <?php } // End each sub module 2 ?>
                                                </ul>


                                                <ul>
                                                    <?php
                                                    foreach ($this->Module_action->get_module_actions($sub_module->module_id)->result() as $sub_module_action) {
                                                        $checkbox_options = array(
                                                            'name' => 'permissions_actions[]',
                                                            'value' => $sub_module_action->module_id . "|" . $sub_module_action->action_id,
                                                            'checked' => $this->Employee->has_module_action_permission($sub_module->module_id, $sub_module_action->action_id, $person_info->person_id)
                                                        );

                                                        if ($logged_in_employee_id != 1) {
                                                            if (($current_employee_editing_self && $checkbox_options['checked']) || (!$this->Employee->has_module_action_permission($sub_module->module_id, $sub_module_action->action_id, $logged_in_employee_id))) {
                                                                $checkbox_options['disabled'] = 'disabled';

                                                                //Only send permission if checked
                                                                if ($checkbox_options['checked']) {
                                                                    echo form_hidden('permissions_actions[]', $sub_module_action->module_id . "|" . $sub_module_action->action_id);
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <li>
                                                        <?php echo form_checkbox($checkbox_options); ?>
                                                            <span class="text-info"><?php echo $this->lang->line($sub_module_action->action_name_key); ?></span>
                                                        </li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        <?php } // End if ?>
                                    <?php } // End each sub module 1 ?>
                                    </ul>
                                </li>
                                <?php
                            }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <?php echo form_hidden('redirect_code', $redirect_code); ?>
            </div>
            <div class="form-actions">
                <div>
                    <?php
                        echo form_submit(array(
                            'name' => 'submitf',
                            'id' => 'submitf',
                            'value' => lang('common_submit'),
                            'class' => 'btn btn-primary pull-right')
                        );
                    ?>
                </div>
            </div>
            <?php
            echo form_close();
            ?>
        </div><!-- /.widget-box -->
    </div><!-- /.col -->
</div><!-- /.col -->

<script type='text/javascript'>
var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }

    function check_permissions(checked_parent) {
        $(".module_checkboxes").each(function(obj) {
            var $cobj = $(this)
            $cobj.prop('checked', checked_parent)
            if ($cobj.prop('checked'))
            {
                $cobj.parent().find('input[type=checkbox]').not(':disabled').prop('checked', true);
            }
            else
            {
                $cobj.parent().find('input[type=checkbox]').not(':disabled').prop('checked', false);
            }
        })
    }
    $('body').on('change', 'select[name="user_type"]', function() {
        var $this = $(this)
        var user_type_id = $this.val()
        if (user_type_id == 1) {
            check_permissions(true)
        } else {
            check_permissions(false)
        }
    })

    $('#image_id').imagePreview({ selector : '#avatar' }); // Custom preview container

    //validation and submit handling
    $(document).ready(function()
    {
        initDatePicker("input[name='emp_dob']")
        initDatePicker("input[name='expired_date']")
        initDatePicker("input[name='joined_date']")

        setTimeout(function(){$(":input:visible:first", "#employee_form").focus(); }, 100);
                $(".module_checkboxes").change(function()
        {
            if ($(this).prop('checked'))
            {
                $(this).parent().find('input[type=checkbox]').not(':disabled').prop('checked', true);
            }
            else
            {
                $(this).parent().find('input[type=checkbox]').not(':disabled').prop('checked', false);
            }
        });
        $('#employee_form').validate({
            submitHandler:function(form)
            {
                doEmployeeSubmit(form);
            },
            errorClass: "text-danger",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            },
            rules:
            {
                user_type: "required",
                // PID: "required",
                username:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('employees/employee_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(username) {
                            return ($(username).val() != $('input[name="original_username"]').val());
                        }
                    },
                    required:true,
                    minlength: 5
                },
                password:
                {
                <?php
                if ($person_info->person_id == "") {
                ?>
                    required: 
                    {
                        depends: function(username) {
                            return $("#username").val() != "" ? true : false;
                        },
                    },
                <?php
                }
                ?>
                    minlength: function() {
                        return $("#username").val() != "" ? 8 : 0;
                    },
                },
                repeat_password:
                {
                equalTo: "#password"
                },
                "locations[]": "required"
            },
            messages:
            {
                user_type: <?php echo json_encode(lang('common_user_type_required')); ?>,
                username:
                {
                    <?php if (!$person_info->person_id) { ?>
                        remote: <?php echo json_encode(lang('employees_username_exists')); ?>,
                    <?php } ?>
                    required: <?php echo json_encode(lang('employees_username_required')); ?>,
                    minlength: <?php echo json_encode(lang('employees_username_minlength')); ?>
                },
                password:
                {
                <?php
                if ($person_info->person_id == "") {
                    ?>
                        required:<?php echo json_encode(lang('employees_password_required')); ?>,
                    <?php
                }
                ?>
                    minlength: <?php echo json_encode(lang('employees_password_minlength')); ?>
                },
                repeat_password:
                {
                equalTo: <?php echo json_encode(lang('employees_password_must_match')); ?>
                },
                "locations[]": <?php echo json_encode(lang('employees_one_location_required')); ?>
            }
        });
    });
    var submitting = false;
    function doEmployeeSubmit(form)
    {
        $("#form").mask(<?php echo json_encode(lang('common_wait')); ?>);
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                $("#form").unmask();
                submitting = false;
                if (response.redirect_code == 1 && response.success)
                {
                    if (response.success) {
                        $.notify(response.message, "success")
                    } else {
                        $.notify(response.message, "error")
                    }
                } else if (response.redirect_code == 2 && response.success) {
                    $.notify('Successfully saved', 'success')
                    window.location.href = '<?php echo site_url('user_permission'); ?>'
                } else if (response.success) {
                    $.notify('Successfully saved', 'success')
                     window.location.href = '<?php echo site_url('user_permission'); ?>'
                } else {
                    gritter(<?php echo json_encode(lang('common_error')); ?>, response.message, 'gritter-item-error', false, false);
                }
            },
            error: function(response) {
                console.log(response.responseText)
            },
        <?php if (!$person_info->person_id) { ?>
                resetForm: true,
        <?php } ?>
            dataType:'json'
        });
    }
</script>

<?php echo $this->load->view('partial/footer'); ?>