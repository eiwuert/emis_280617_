<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
</div>
 
<?php $this->load->view("students/_add_guardian"); ?>

<script type='text/javascript'>
    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#guardians_form").focus(); }, 100);
        var submitting = false;
        $('#guardians_form').validate({
            submitHandler:function(form)
            {
                doGuardianSubmit(form);
            },
            rules:
            {
                relation_id: "required"
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
                relation_id: "Required Field"                
            }
        });
    });
    var submitting = false;
    function doGuardianSubmit(form)
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
                    window.location.href = SITE_URL + "students/add_guardians/" + response.stu_info_id + "/" + response.stu_guardian_id + "/2";
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
