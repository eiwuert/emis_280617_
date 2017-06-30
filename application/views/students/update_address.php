<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
	<?php echo create_breadcrumb(); ?>                                      
</div>
 
<?php $this->load->view("students/_update_address"); ?>

<script type='text/javascript'>
    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#address_form").focus(); }, 100);
        var submitting = false;
        $('#address_form').validate({
            submitHandler:function(form)
            {
                doAddressSubmit(form);
            },
            rules:
            {
                stu_cadd:
                {
                    required: true
                },
                stu_padd: "required",
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
                stu_cadd:
                {
                    required: "Required Field",
                },
                stu_padd: "Required Field",
            }
        });
    });
    var submitting = false;
    function doAddressSubmit(form)
    {
        $("#form").mask(<?php echo json_encode(lang('common_wait')); ?>);
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                $("#form").unmask();
                submitting = false;
                if (response.success)
                {
                    $.notify(response.message, "success");
                    window.location.href = SITE_URL + "students/update_address/" + response.stu_info_id;
                }
                else
                {
                    $.notify(response.message, "error");
                }
            },
            dataType:'json'
        });
    }
</script>
    
<?php $this->load->view("partial/footer"); ?>
