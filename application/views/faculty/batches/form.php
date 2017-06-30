<?php echo $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div>
    <div class="page-header" id='page-header'>
        <h1><i class="fa fa-pencil"></i> <?php
            if (!$school_class_info->school_class_id) {
                echo lang('batch_new');
            } else {
                echo lang('batch_update');
            }
            ?>
        </h1>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="col-xs-12">
                        <?php echo lang('common_fields_required_message'); ?>
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat widget-header-small">
                                <h5 class="widget-title">
                                    <span class="icon">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                   	<?php echo lang("batch_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                echo form_open($controller_name.'/save/' . $batch_info->batch_id, array('id' => 'batch_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required">  
                                        <?php echo form_label(lang('batch_name') . ':', 'batch_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'batch_name',
                                                'id' => 'batch_name',
                                                'class' => 'form-control',
                                                'value' => $batch_info->batch_name));
                                            echo form_hidden('original_batch_name', $batch_info->batch_name);
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group required">  
                                        <?php echo form_label(lang('batch_major') . ':', 'batch_major', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php echo form_dropdown(
                                                    'batch_major',
                                                    $major,
                                                    $batch_info->batch_major,
                                                    'class="form-control" id="batch_major"'
                                            );?>
                                        </div>
                                    </div>

                                    <div class="form-group required">  
                                        <?php echo form_label(lang('batch_faculty') . ':', 'batch_faculty', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>                                       
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php echo form_dropdown(
                                                    'batch_faculty',
                                                    $faculty,
                                                    $batch_info->batch_faculty,
                                                    'class="form-control" id="batch_faculty" '
                                            );?>
                                        </div>
                                    </div>

                                    <div class="form-group required">  
                                        <?php echo form_label(lang('batch_start_date') . ':', 'batch_start_date', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="batch_start_date" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $batch_info->start_date?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group required">  
                                        <?php echo form_label(lang('batch_end_date') . ':', 'batch_end_date', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <span class="input-group date ">
                                                <input type="text" class="form-control hasDatepicker" name="batch_end_date" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $batch_info->end_date?>"/>
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group required">  
                                        <?php echo form_label(lang('batch_number') . ':', 'batch_number', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'batch_number',
                                                'id' => 'batch_number',
                                                'class' => 'form-control',
                                                'maxlength' => '3', 
                                                'value' => $batch_info->batch_number));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
                                        </div>
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
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<script type='text/javascript'>

    
    $(function(){

        initDatePicker("input[name='batch_start_date']");   
        initDatePicker("input[name='batch_end_date']"); 

         $('#batch_major').change(function(){
            var id = $(this).val();           
            var url_title_major = "<?php echo site_url("batches/suggest_faculty")?>";
            var dataFaculty = { major_id: id};           
            $.ajax({
                type: "POST",
                url: url_title_major, 
                data:dataFaculty,
                dataType:"json",
                success: function(get_data){
                    $('#batch_faculty').html('<option> -- -- </option>');
                    $.each(get_data,function(key,val){
                        var opt = $('<option />'); 
                        opt.val(val.university_id);
                        opt.text(val.university_name + '('+val.university_name_kh+')');
                        $('#batch_faculty').append(opt);
                    });
                },
            });
                
        });
    });

    //validation and submit handling
    $(document).ready(function()
    {

        setTimeout(function(){$(":input:visible:first", "#batch_form").focus(); }, 100);
        $('#batch_form').validate({
            submitHandler:function(form)
            {
                 batch_submitting(form);                
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
                batch_name: "required",
                batch_major: "required",        
                batch_faculty: "required",        
                batch_start_date: "required",        
                batch_number: "required",        
                batch_end_date: "required"        
            },
            messages:
            {
                batch_name: <?php echo json_encode(lang('batch_name_required')); ?>,
                batch_major: <?php echo json_encode(lang('batch_major_required')); ?>,
                batch_faculty: <?php echo json_encode(lang('batch_faculty_required')); ?>,
                batch_start_date: <?php echo json_encode(lang('batch_start_date_required')); ?>,
                batch_end_date: <?php echo json_encode(lang('batch_end_date_required')); ?>,
                batch_number: <?php echo json_encode(lang('batch_number_required')); ?>,
            }
        });
    });
    var submitting = false;
    function batch_submitting(form)
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
                    window.location.href = '<?php echo site_url('batches'); ?>';
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
        });
    }
</script>


<?php echo $this->load->view("partial/footer"); ?>