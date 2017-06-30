<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
            <?php
            if (!$supplier_info->id) {
                echo lang('suppliers_new');
            } else {
                echo lang('suppliers_update');
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
                                    <?php echo lang("suppliers_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                    echo form_open($controller_name.'/save/' . $supplier_info->id, array('id' => 'supplier_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('suppliers_company_name') . ':', 'company_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'company_name',
                                                'id' => 'company_name',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $supplier_info->company_name));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_last_name') . ':', 'last_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'last_name',
                                                'id' => 'last_name',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $supplier_info->last_name));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_first_name') . ':', 'first_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'first_name',
                                                'id' => 'first_name',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $supplier_info->first_name));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_phone_number') . ':', 'phone_number', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>   
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'phone_number',
                                                'id' => 'phone_number',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $supplier_info->phone_number));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_email') . ':', 'email', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'email',
                                                'id' => 'email',
                                                'class' => 'form-control',
                                                'required' => 'required',
                                                'value' => $supplier_info->email));
                                            ?>
                                        </div>
                                    </div>            
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?php echo site_url("$controller_name")?>"><?php echo lang('common_cancel'); ?></a>
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
        </div>
    </div><!-- /.page-content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){$(":input:visible:first", "#supplier_form").focus(); }, 100);
        $('#supplier_form').validate({
            submitHandler:function(form)
            {
                doSupplierSubmit(form);
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
                company_name:"required",
                first_name:"required", 
                last_name:"required", 
                phone_number:"required", 
                email: {
                    email: true
                },       
            },
            messages:
            {
                company_name:<?php echo json_encode(lang('suppliers_company_name_required')); ?>,
                first_name:<?php echo json_encode(lang('suppliers_first_name_required')); ?>, 
                last_name:<?php echo json_encode(lang('suppliers_last_name_required')); ?>, 
                phone_number:<?php echo json_encode(lang('suppliers_phone_number_required')); ?>,
                email: {
                    email: <?php echo json_encode(lang('suppliers_email_required')); ?>
                }, 
            }
        });
    });
    var submitting = false;
    function doSupplierSubmit(form)
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
                    window.location.href = '<?php echo site_url('suppliers'); ?>';
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>