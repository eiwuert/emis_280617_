<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php
        if (!$mou_info_by_id->id) {
            echo lang('mou_new');
        } else {
            echo lang('mou_update');
        }
        ?>
    </h1>
</div>

    <div class="page-content">

        
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                        <div class="col-xs-12">
                        <?php echo lang('common_fields_required_message'); ?>
                        <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h5 class="widget-title">
                                        <span class="icon">
                                            <i class="fa fa-align-justify"></i>
                                        </span>
                                        <?php echo lang("mou_information"); ?>
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php echo form_open($controller_name.'/save/'.(!isset($is_clone) ? $mou_info_by_id->id : ''), array('id' => 'mou_form', 'class' => 'form-horizontal'));?>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <?php echo form_label('Sign Date'.':','sign_date', array('class' => 'col-sm-3 col-md-3 col-lg-2')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                    <input type="text" id="sign_date" class="form-control hasDatepicker" name="sign_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $sign_date = $mou_info_by_id->sign_date != "" ? date('d-m-Y', strtotime($mou_info_by_id->sign_date)) : ""; ?>">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('purpose')?>:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="purpose" type="text" value="<?php echo ($mou_info_by_id->purpose)? $mou_info_by_id->purpose : '' ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('orginazation')?>:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="orginazation" type="text" value="<?php echo ($mou_info_by_id->orginazation)? $mou_info_by_id->orginazation : '' ?>" />
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <?php echo form_label(lang('valid_date_from_mou').':','valid_date_from', array('class' => 'col-sm-3 col-md-3 col-lg-2')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                    <input type="text" id="valid_date_from" class="form-control hasDatepicker" name="valid_date_from" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $valid_date_from = $mou_info_by_id->valid_date_from != "" ? date('d-m-Y', strtotime($mou_info_by_id->valid_date_from)) : ""; ?>">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <?php echo form_label(lang('valid_date_to_mou').':','valid_date_to', array('class' => 'col-sm-3 col-md-3 col-lg-2')); ?>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                    <input type="text" id="valid_date_to" class="form-control hasDatepicker" name="valid_date_to" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $valid_date_to = $mou_info_by_id->valid_date_to != "" ? date('d-m-Y', strtotime($mou_info_by_id->valid_date_to)) : ""; ?>">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>  

                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('response_by_mou'); ?>:</label>
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <?php echo form_dropdown('response_by', $employee,$mou_info_by_id->response_by, 'class="form-control"'); ?>
                                            </div>
                                        </div>

                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="<?php echo lang('common_submit'); ?>" id="submit" class="btn btn-primary pull-right">
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
        initDatePicker("input[name='sign_date']");
        initDatePicker("input[name='valid_date_from']");
        initDatePicker("input[name='valid_date_to']");

        setTimeout(function(){$(":input:visible:first", "#mou_form").focus(); }, 3000);

        $('#mou_form').validate({
            submitHandler:function(form)
            {
                doMouSubmit(form);
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
                sign_date: "required",
                orginazation: "required",
                purpose: "required",
                valid_date_from: "required",
                valid_date_to: "required",
                response_by: "required",
            },
            messages:
            {
                sign_date: <?php echo json_encode(lang('sign_date_required')); ?>,
                orginazation: <?php echo json_encode(lang('orginazation_required')); ?>,
                purpose: <?php echo json_encode(lang('purpose_required')); ?>,
                valid_date_from: <?php echo json_encode(lang('valid_date_from_required')); ?>,
                valid_date_to: <?php echo json_encode(lang('valid_date_to_required')); ?>,
                response_by: <?php echo json_encode(lang('response_by_required')); ?>,
            }
        });
    });
    //submit faile
    var submitting = false;
    function doMouSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            <?php if (!$mou_info_by_id->id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>