<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>
</div>
<?php $this->load->view("employees/_update_emp_academic"); ?>

<script type='text/javascript'>
	$(document).ready(function()
	{
		initSomuSelect('#majors');
		initSomuSelect('#course_ids');
		setTimeout(function(){$(":input:visible:first", "#academic_form").focus(); }, 100);
		var submitting = false;
		$('#academic_form').validate({
			submitHandler:function(form)
			{
				doAcademicSubmit(form);
			},
			rules:
			{
				
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
				
			}
		});

		var submitting = false;
		function doAcademicSubmit(form){
			if (submitting) return;
			submitting = true;
			var majors = getSomuSelected('#majors')
			$('input[name="teach_major"]').val(majors);
			var course_ids = getSomuSelected('#course_ids')
			$('input[name="teach_course_ids"]').val(course_ids);
			$(form).ajaxSubmit({
				success:function(response)
				{
					submitting = false;
					if (response.success) {
						$.notify(response.message, "success");
						window.location.reload(true);
					} else {
						$.notify(response.message, "error");
					}
				},
				dataType:'json'
			});
			
		}
	});
</script>
<?php $this->load->view("partial/footer"); ?>