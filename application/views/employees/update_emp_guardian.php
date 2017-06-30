<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
</div>
 
<?php $this->load->view("employees/_update_emp_guardian"); ?>
 
<script type='text/javascript'>
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
	        		emp_guardian_name: {
	        			required: true
	        		},
	        		emp_guardian_relation: "required",
	        		emp_guardian_email_id: {
	        			email: true
	        		}
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
	                emp_guardian_name:
	                {
	                    required: "Required Field",
	                },
	                emp_guardian_relation: "Required Field",
	                emp_guardian_email_id: {
	                }
	            }
    	});

    	var submitting = false;
    	function doGuardianSubmit(form){
    		$("#guardians_form").mask(<?php echo json_encode(lang('common_wait')); ?>);
	        if (submitting) return;
	        submitting = true;
	        $(form).ajaxSubmit({
	            success:function(response)
	            {
	                $("#guardians_form").unmask();
	                submitting = false;
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
	            dataType:'json'
	        });
    	}
    });
</script>
<?php $this->load->view("partial/footer"); ?>