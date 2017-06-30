<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
</div>
 
 <?php $this->load->view("students/_update_personal"); ?>
    
<script type='text/javascript'>
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }

    // $('#image_id').imagePreview({ selector : '#avatar' }); // Custom preview container
    //validation and submit handling
    $(document).ready(function()
    {
        initDatePicker("input[name='stu_dob']")
        initDatePicker("input[name='stu_admission_date']")        
        setTimeout(function(){$(":input:visible:first", "#stu-master-update").focus(); }, 100);

        $( "#stu_email_id" ).on('change',function(){
            var dinput = this.value;
            var getUrl = "<?php echo site_url("students/stu_mail_exists"); ?>";
            $.post(getUrl, {mail: dinput }, function(data) {
                if(data == 'false'){
                    $('#chExistsEmail').text('This email have already exists.');
                    $('#submit').prop("disabled",true);
                }else if(data == 'true'){
                    $('#chExistsEmail').text('');
                    $('#submit').prop("disabled",false);
                }
            }); 
        });

        var submitting = false;
        $('#stu-master-update').validate({
            submitHandler:function(form)
            {
                $.post('<?php echo site_url("students/check_duplicate"); ?>', {term: $('#stu_unique_id').val() }, function(data) {
                <?php if (!$person_info->stu_master_id) { ?>
                    if (data.duplicate)
                    {
                    if (confirm(<?php echo json_encode(lang('customers_duplicate_exists')); ?>))
                        {
                            doStudentSubmit(form);
                        }
                        else
                        {
                        return false;
                        }
                    }
                <?php } else  ?>
                {
                    doStudentSubmit(form);
                }}, "json")
                .error(function() {
                });
            },
            rules:
            {
                stu_unique_id:
                {
                    required: true
                },
                stu_last_name: "required",
                stu_first_name: "required",
                stu_last_name_kh: "required",
                stu_first_name_kh: "required",
                stu_email_id: {
                    email: true
                },
                stu_dob: "required",
                stu_admission_date: "required",
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
                stu_unique_id:
                {
                    remote: <?php echo json_encode(lang('common_account_number_exists')); ?>,
                    required: "Required Field",
                },
                stu_last_name: "Required Field",
                stu_first_name: "Required Field",
                stu_last_name_kh: "Required Field",
                stu_first_name_kh: "Required Field",
                stu_email_id: {
                    // email: true
                },
                stu_dob: "Required Field",
                stu_admission_date: "Required Field",
            }
        });

        $('body').on('change', 'select#has_work', function(){
            var value = $(this).val();
            $('div#dhas_work').addClass('hide');
            if (value == 1) {
                $('div#dhas_work').removeClass('hide');
            }
        });
        $('body').on('change', 'input#is_refer_in', function() {
            if ($(this).prop('checked')) {
                $('input#refer_in_from').removeAttr('readonly');
            } else {
                $('input#refer_in_from').attr('readonly', true);
            }
        });
    });
    var submitting = false;
    function doStudentSubmit(form)
    {
        $("#form").mask(<?php echo json_encode(lang('common_wait')); ?>);
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                $("#form").unmask();
                submitting = false;
                <?php if (!$person_info->stu_master_id) { ?>
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
            <?php if (!$person_info->stu_master_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }

</script>
<?php $this->load->view("partial/footer"); ?>
