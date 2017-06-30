<div class="tab-pane" id="transfer">
	<div class="row">
	  	<div class="col-xs-12">
			<h2 class="page-header transfer-info">	
				<i class="fa fa-info-circle"></i> <?php echo lang('students_transfer_info'); ?>	
				<div class="pull-right">
				    <a class="btn btn-primary btn-sm" href="<?php echo site_url("students/postpon/$person_info->stu_info_id"); ?>"><i class="fa fa-folder"></i> <?php echo lang('common_postpon'); ?></a>
				    <!-- Button trigger modal -->
					<button type="button" class="btn btn-info btn-sm transferStudent_cl" data-toggle="modal" data-target="#transferStudent"><i class="fa fa-folder-open"></i> 
					  <?php echo lang('students_transfer'); ?>
					</button>
				</div>
				<div class="clearfix"></div>
			</h2>
	  	</div><!-- /.col -->
	</div>

	<!---Start Current Address Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
			<?php echo lang('students_university_transferring'); ?>	</h4>
	  	</div><!-- /.col -->
	</div>

	<div class="col-xs-12">
		<div class="row table-responsive transfer_faculty">
			<?php $this->load->view("students/transfer/transfer_faculty_table"); ?>
		</div>
	</div>

	<!---Start Permenant Address Block-->
	<div class="row">
	  	<div class="col-xs-12">
			<h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">	
			<?php echo lang('students_major_transferring'); ?>	</h4>
	  	</div><!-- /.col -->
	</div>

	<div class="col-xs-12">
		<div class="row table-responsive transfer_major">
			<?php $this->load->view("students/transfer/transfer_major_table"); ?>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="transferStudent" tabindex="-1" role="dialog" aria-labelledby="transferStudentLabel">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	    <?php echo form_open("$controller_name/transfer/" . $person_info->stu_info_id, array('id' => 'transfer_form', 'class' => 'form-horizontal1')); ?>
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="transferStudentLabel"><?php echo lang('students_transfer'); ?></h4>
	      	</div>
	      	<div class="modal-body">
	      		<div class="row">
		        	<div class="form-group">
			            <?php echo form_label(lang('students_change') . ':', 'change', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
			            <div class="col-sm-8 col-md-8 col-lg-5">
							<div class="">
				            	<?php 
				            	echo form_radio(array(
				                    'name' => 'change',
				                    'value' => 'university',
				                    'id' => 'r_university'
				                    )
				                );
				                ?>
				                <span><?php echo lang('students_university'); ?></span>
			                </div>
			                <div class="">
				                <?php
				                echo form_radio(array(
				                    'name' => 'change',
				                    'value' => 'major',
				                    'id' => 'r_major'
				                    )
				                );
				            	?>
				            	<span><?php echo lang('common_major'); ?></span>
			            	</div>
			            	<div class="errorTxt"></div>
			            </div>
			            <div class="clearfix"></div>
			        </div>
		        	<div class="form-group hide toggle-change" id="university">
			            <?php echo form_label(lang('students_university') . ':', 'university', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
			            <div class="col-sm-8 col-md-8 col-lg-5">
			            	<?php echo form_dropdown(
			            		'university', 
			            		$universities, 
			            		$person_info->stu_master_university_id, 
			            		'class="form-control" id="university"'
			            	); 
			            	?>
			            </div>
			        </div>
		        	<div class="form-group hide toggle-change" id="major">
			            <?php echo form_label(lang('common_major') . ':', 'major', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
			            <div class="col-sm-8 col-md-8 col-lg-5">
			            	<?php echo form_dropdown(
			            		'major', 
			            		$skills, 
			            		$person_info->stu_master_skill_id,
			            		'class="form-control" id="major"'
			            	); 
			            	?>
			            </div>
			        </div>
		        	<div class="form-group">
			            <?php echo form_label(lang('students_change_date') . ':', 'change_date', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
			            <div class="col-sm-8 col-md-8 col-lg-5">
			                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
		                        <input type="text" id="change_date" class="form-control hasDatepicker" name="change_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
		                        <span class="input-group-addon">
		                            <i class="fa fa-calendar"></i>
		                        </span>
		                    </span>
			            	<div class="errorTxt"></div>
			            	<br/>
			            </div>
			        </div>
			        <div class="form-group">
			            <?php echo form_label(lang('common_remark') . ':', 'remark', array('class' => ' col-sm-4 col-md-4 col-lg-4')); ?>
			            <div class="col-sm-8 col-md-8 col-lg-5">
			                <?php
			                echo form_textarea(array(
			                    'class' => 'form-control',
			                    'name' => 'remark',
			                    'id' => 'remark',
			                    )
			                );
			                ?>
			            </div>
			        </div>
		        </div>
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('common_close'); ?></button>
	        	<button type="submit" class="btn btn-primary"><?php echo lang('common_save'); ?></button>
	      	</div>
	      	<?php echo form_close(); ?>
	    </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function()
    {
    	// Modal JavaScript Action
        $('body').on('change', 'input[name="change"][type="radio"]', function(e){
            var change_type = $(this).val();
            $('div.toggle-change').addClass('hide')
            $('div#'+change_type).removeClass('hide');
        });

        var submitting = false;
        $('#transfer_form').validate({
            submitHandler:function(form)
            {
                doStudentSubmit(form);
            },
            rules:
            {
                change: "required",
                change_date: "required",
                university:
                {
                	required: 
                    {
                        depends: function() {
                            return $("input[name='change']").val() == "university" ? true : false;
                        },
                    },
                },
                major:
                {
                	required: 
                    {
                        depends: function() {
                            return $("input[name='change']").val() == "major" ? true : false;
                        },
                    },
                }
            },
            errorLabelContainer: '.errorTxt',
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
                change:
                {
                    required: "Required Field",
                },
                change_date: "Required Field",
            }
        });
    });

	var submitting = false;
    function doStudentSubmit(form)
    {
        if (submitting) return;
        submitting = true;

        $.ajax({
            url: $(form).attr("action"),
            type: "post",
            dataType: "json",
            data: $(form).serialize(),
            success: function(response) {
                submitting = false;
                if (response.success)
                {
	              	$("#transferStudent").modal('hide');
                	if (response.change_type == 'university') {
                		$('.transfer_faculty').html(response.tbl_row);
                	} else {
                		$('.transfer_major').html(response.tbl_row);
                	}
                    $.notify(response.message, "success");
                }
                else
                {
                    $.notify(response.message, "error");
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });
    }
    $(function(){
    	$('body').on('click', 'a.update_row_transfer', function(e){  
			$('div.toggle-change').removeClass('hide')
			e.preventDefault();
			$(this).parents('div.job-row').addClass('focused');			
			var data_transfer_type = $(this).data('transfer-type'),
			data_university_id = $(this).data('transfer-university-id'),
			data_major_id = $(this).data('transfer-major-id'),
			data_changed_date = $(this).data('transfer-date'),
			data_remark = $(this).data('transfer-remark');
			var person_id = "<?php echo $person_info->stu_info_id?>";
			var data_id = $(this).data('transfer-id');	
		
			$('form#transfer_form').attr('action', "<?php echo site_url("students/transfer")?>/"+person_id+"/"+data_id);
			if(data_transfer_type == "university"){
				$('#r_university').prop("checked", true);
				$('#major').addClass('hide');
				$('select[name="university"]').val(data_university_id);	
			}else if(data_transfer_type == 'major'){
				$('#r_major').prop("checked", true);
				$('div#university').addClass('hide');
				$('select[name="major"]').val(data_major_id);	
			}else{
				$('input[name="change"]').prop("checked", false);
				$('div.toggle-change').addClass('hide')
			}
			$('#change_date').val(data_changed_date);	
			$('#remark').val(data_remark);	
		});

        $('.transferStudent_cl').click(function(){      
			$('form#transfer_form').attr('action', '<?php echo site_url("students/transfer/$person_info->stu_info_id")?>');
			$('#r_university').prop("checked", false);
			$('#r_major').prop("checked", false);
			$('#change_date').val('');
			$('#remark').val('');
        });
    });
</script>