<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
 </div>
 
 <?php $this->load->view("employees/_update_personal"); ?>
    
<script type='text/javascript'>
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }

    // $('#image_id').imagePreview({ selector : '#avatar' }); // Custom preview container
    //validation and submit handling
    $(document).ready(function()
    {
        initDatePicker("input[name='dob']")
        initDatePicker("input[name='joined_date']")
        
        setTimeout(function(){$(":input:visible:first", "#emp-master-update").focus(); }, 100);
        var submitting = false;
        $('#emp-master-update').validate({
            submitHandler:function(form)
            {
                $.post('<?php echo site_url("$controller_name/check_duplicate"); ?>', {term: $('#emp_unique_id').val() }, function(data) {
                <?php if (!$person_info->person_id) { ?>
                    if (data.duplicate)
                    {
                    if (confirm(<?php echo json_encode(lang('customers_duplicate_exists')); ?>))
                        {
                            doEmployeeSubmit(form);
                        }
                        else
                        {
                        return false;
                        }
                    }
                <?php } else  ?>
                {
                    doEmployeeSubmit(form);
                }}, "json")
                .error(function() {
                });
            },
            rules:
            {
                emp_unique_id:
                {
                    required: true
                },
                last_name: "required",
                first_name: "required",
                last_name_kh: "required",
                first_name_kh: "required",
                email: {
                    email: true
                },
            },
            errorClass: "text-danger",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            },
            messages:
            {
                emp_unique_id:
                {
                    remote: <?php echo json_encode(lang('common_account_number_exists')); ?>,
                    required: "Required Field",
                },
                last_name: "Required Field",
                first_name: "Required Field",
                last_name_kh: "Required Field",
                first_name_kh: "Required Field",
                email: {
                    // email: true
                },
            }
        });
    });
    var submitting = false;
    function doEmployeeSubmit(form)
    {
        // $("form").mask(<?php echo json_encode(lang('common_wait')); ?>);
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                // $("form").unmask();
                submitting = false;
                <?php if (!$person_info->person_id) { ?>
                    $('.form-group').removeClass('has-success');
                <?php } ?>
                if (response.success)
                {
                    $.notify(response.message, "success");
                    window.location.reload(true);
                }
                else
                {
                    $.notify(response.message, "error");
                }
            },
            <?php if (!$person_info->person_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }

</script>
<?php $this->load->view("partial/footer"); ?>
