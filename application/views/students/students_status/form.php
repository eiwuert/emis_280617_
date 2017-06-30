<?php echo $this->load->view('partial/header'); ?>
<div class=" alert alert-info" id='top'>
    <?php echo create_breadcrumb(); ?>                                      
</div>
<div class="page-header" id='page-header'>
    <h1 ><i class="fa fa-pencil"></i> <?php
        if (!$stu_status_info->stu_status_id) {
            echo lang('students_status_new');
        } else {
            echo lang('students_status_update');
        }
        ?>  </h1>
</div>
<div class="col-xs-12">
<?php echo lang('common_fields_required_message'); ?>
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>                                 
                </span>
                <?php echo lang("students_status_basic_information"); ?>
            </h5>
        </div>

        <div class="widget-body" style="margin-left: 13px;">
            <br>
            <?php
            echo form_open($controller_name.'/save/' . $stu_status_info->stu_status_id, array('id' => 'student_status_form', 'class' => 'form-horizontal'));
            ?>
           
            <div class="form-group">  
                <?php echo form_label(lang('students_status_name') . ':', 'stu_status_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 required')); ?>
                <div class="col-sm-9 col-md-9 col-lg-5">
                    <?php
                    echo form_input(array(
                        'name' => 'stu_status_name',
                        'id' => 'stu_status_name',
                        'class' => 'form-control',
                        'value' => $stu_status_info->stu_status_name));
                    echo form_hidden('original_stu_status_name', $stu_status_info->stu_status_name);
                    ?>
                </div>
            </div>
            <div class="form-group">  
                <?php echo form_label(lang('students_status_description') . ':', 'stu_status_description', array('class' => 'col-sm-3 col-md-3 col-lg-2 ')); ?>
                <div class="col-sm-9 col-md-9 col-lg-5">
                    <?php
                    echo form_textarea(array(
                        'name' => 'stu_status_description',
                        'id' => 'stu_status_description',
                        'class' => 'form-control',
                        'value' => $stu_status_info->stu_status_description));
                    ?>
                </div>
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

    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#student_status_form").focus(); }, 100);
        $('#student_status_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("students_status/check_duplicate"); ?>', {term: $('#stu_status_name').val()}, function(data) {
        
                alert($('#stu_status_name').val());
        <?php if (!$stu_status_info->stu_status_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('students_status_duplicate_exists')); ?>))
                    {
                        doStudentStatusSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doStudentStatusSubmit(form);
            }}, "json")
                    .error(function() {
                    });
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
                stu_status_name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('students_status/stu_status_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(stu_status_name) {
                            return ($(stu_status_name).val() != $('input[name="original_stu_status_name"]').val());
                        }
                    },
                    required:true,
                },
            },
            messages:
            {
                stu_status_name:
                {
                    remote: <?php echo json_encode(lang('students_status_status_exists')); ?>,
                    required: <?php echo json_encode(lang('students_status_name_required')); ?>,
                },
            }
        });
    });
    var submitting = false;
    function doStudentStatusSubmit(form)
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
                    $.notify(response.message, "success");
                    window.location.href = '<?php echo site_url('students_status'); ?>';
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
</script>

<?php echo $this->load->view('partial/footer'); ?>