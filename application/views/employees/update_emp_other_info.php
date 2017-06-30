<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
</div>
 
<?php $this->load->view("employees/_update_emp_other_info"); ?>

<script type='text/javascript'>
	$(document).ready(function()
    {
    	setTimeout(function(){$(":input:visible:first", "#employee_form").focus(); }, 100);
    	var submitting = false;
    	$('#employee_form').validate({
    	 		submitHandler:function(form)
	            {
	                doAddressSubmit(form);
	            },
	             rules:
	            {
	        		emp_attendance_card_id: {
	        			required: true
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
	                emp_attendance_card_id:
	                {
	                    required: "Required Field",
	                },
	            }
    	});

    	var submitting = false;
    	function doAddressSubmit(form){
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