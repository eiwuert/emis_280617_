<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php if (!$letter_info_by_id->id){
                echo lang('letter_in_new');
            } else {
                echo lang('letter_in_update');
        }?>
    </h1>
</div>
    <div class="page-content">       
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <!-- Start -->
                    <div class="widget-content nopadding table_holder table-responsive" >
                        <?php echo $manage_table; ?>         
                    </div>     
                        <div class="col-xs-12">
                        Fields in red are required    
                        <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h5 class="widget-title">
                                        <span class="icon">
                                            <i class="fa fa-align-justify"></i>
                                        </span>
                                        <?php echo lang("letter_in_information"); ?>
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php echo form_open($controller_name.'/save/'.(!isset($is_clone) ? $letter_info_by_id->id : ''), array('id' => 'letter_in_form', 'class' => 'form-horizontal'));?>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <?php echo form_label('Received Date'.':','received_date', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                    <input type="text" id="received_date" class="form-control hasDatepicker" name="received_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $received_date = $letter_info_by_id->received_date != "" ? date('d-m-Y', strtotime($letter_info_by_id->received_date)) : ""; ?>">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group required" style="margin-bottom: 10px;">
                                            <?php echo form_label(lang('send_from').':','send_from', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="send_from" type="text" value="<?php echo ($letter_info_by_id->send_from)? $letter_info_by_id->send_from : '' ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group required" style="margin-bottom: 10px;">
                                            <?php echo form_label(lang('orginazation').':','orginazation', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="orginazation" type="text" value="<?php echo ($letter_info_by_id->orginazation)? $letter_info_by_id->orginazation : '' ?>" />
                                            </div>
                                        </div>  
                                        <div class="form-group required" style="margin-bottom: 10px;">
                                            <?php echo form_label(lang('purpose').':','purpose', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="purpose" type="text" value="<?php echo ($letter_info_by_id->purpose)? $letter_info_by_id->purpose : '' ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group required" style="margin-bottom: 10px;">
                                            <?php echo form_label(lang('received_by').':','received_by', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <?php echo form_dropdown('received_by', $employee, $letter_info_by_id->received_by, 'class="form-control"'); ?>
                                            </div>
                                        </div>

                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="<?php echo lang('common_save'); ?>" id="submit" class="btn btn-primary pull-right">
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                                </div>
                    <!-- End -->
                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<script type='text/javascript'>

    var initDatePicker = function(elem)
    {
        $(elem).ionDatePicker();
    }
    $(document).ready(function()
    {
        initDatePicker("input[name='received_date']");
        setTimeout(function(){$(":input:visible:first", "#letter_in_form").focus(); }, 100);
        $('#letter_in_form').validate({
            submitHandler:function(form)
            {
                doLetterInSubmit(form);
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
                received_date: "required",
                send_from: "required",
                orginazation: "required",                
                purpose: "required",
                received_by: "required",
            },
            messages:
            {
                received_date: <?php echo json_encode(lang('received_date_required')); ?>,
                send_from: <?php echo json_encode(lang('send_from_required')); ?>,
                orginazation: <?php echo json_encode(lang('orginazation_required')); ?>,                
                purpose: <?php echo json_encode(lang('purpose_required')); ?>,
                received_by: <?php echo json_encode(lang('received_by_required')); ?>,
            }
            
        });
    });
    //submit faile
    var submitting = false;
    function doLetterInSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.letter_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            <?php if (!$letter_info_by_id->id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>