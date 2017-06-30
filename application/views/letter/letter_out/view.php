<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php
        if (!$letter_info_by_id->id) {
            echo lang('letter_out_new');
        } else {
            echo lang('letter_out_update');
        }
        ?>
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
                                        <?php echo lang('letter_out_information'); ?>
                                    </h5>
                                </div>
                                <div class="widget-body">
                                <br>
                                <?php echo form_open($controller_name.'/save/'.(!isset($is_clone) ? $letter_info_by_id->id : ''), array('id' => 'letter_out_form', 'class' => 'form-horizontal'));?>
                                                                                
                                        <div class="form-group required" style="margin-bottom: 10px;">                                            
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2"><?php echo lang('send_out_date')?>:</label> 
                                            <div class="col-sm-9 col-md-3 col-lg-3">
                                                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                    <input type="text" id="send_out_date" class="form-control hasDatepicker" name="send_out_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $send_out_date = $letter_info_by_id->send_out_date != "" ? date('d-m-Y', strtotime($letter_info_by_id->send_out_date)) : ""; ?>">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>

                                            <label class="control-label col-sm-3 col-md-3 col-lg-2"><?php echo lang('send_to')?>:</label>    
                                            <div class="col-sm-9 col-md-3 col-lg-3">
                                                <input class="form-control" name="send_to" type="text" value="<?php echo ($letter_info_by_id->send_to)? $letter_info_by_id->send_to : '' ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group required" style="margin-bottom: 10px;">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2"><?php echo lang('organization')?>:</label>    
                                            <div class="col-sm-9 col-md-3 col-lg-3">
                                                <input class="form-control" name="organization" type="text" value="<?php echo ($letter_info_by_id->organization)? $letter_info_by_id->organization : '' ?>" />
                                            </div>

                                            <label class="control-label col-sm-3 col-md-3 col-lg-2"><?php echo lang('purpose')?>:</label>    
                                            <div class="col-sm-9 col-md-3 col-lg-3">
                                                <input class="form-control" name="purpose" type="text" value="<?php echo ($letter_info_by_id->purpose)? $letter_info_by_id->purpose : '' ?>" />
                                            </div>
                                        </div>  

                                        <div class="form-group required" style="margin-bottom: 10px;">
                                            <label class="control-label col-sm-3 col-md-3 col-lg-2"><?php echo lang('send_by')?>:</label>    
                                            <div class="col-sm-9 col-md-3 col-lg-3">
                                                <?php echo form_dropdown('send_by', $employee, $letter_info_by_id->send_by, 'class="form-control" id="send_by"'); ?>
                                            </div>
                                        </div>

                                        <div class="form-group required" style="margin-bottom: 10px;">
                                            <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
                                            <div class="progress" style="display:none;">
                                              <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 30%;">
                                                20%
                                              </div>
                                            </div>
                                            <ul class="list-group"><ul>
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
        initDatePicker("input[name='send_out_date']");
        setTimeout(function(){$(":input:visible:first", "#letter_out_form").focus(); }, 100);
        $('#letter_out_form').validate({
            submitHandler:function(form)
            {
                doLetterOutSubmit(form);
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
                send_out_date: "required",
                send_to: "required",
                organization: "required",
                purpose: "required",
                send_by: "required",
            },
            messages:
            {
                send_out_date: <?php echo json_encode(lang('send_out_date_required')); ?>,
                send_to: <?php echo json_encode(lang('send_to_required')); ?>,
                organization: <?php echo json_encode(lang('organization_required')); ?>,
                purpose: <?php echo json_encode(lang('purpose_required')); ?>,
                send_by: <?php echo json_encode(lang('send_by_required')); ?>,
            }
            
        });
    });
    //submit faile
    var submitting = false;
    function doLetterOutSubmit(form)
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