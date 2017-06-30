<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
 </div>
 <div class="page-header" id='page-header'>
        <h1> <i class="fa fa-pencil"></i>  <?php  if(!$person_info->person_id) { echo lang($controller_name.'_new'); } else { echo lang($controller_name.'_update'); }    ?>    </h1>

</div>

<div class="widget-box" id="widgets">
    
    </div><!-- /.widget-body -->
    <div class="col-sm-12">
    <?php echo lang('common_fields_required_message'); ?>
   <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>                                 
                </span>
                <?php echo lang("customers_basic_information"); ?>
            </h5>
        </div>
        <div class="widget-body">
        <div class="widget-main">
            <div id="fuelux-wizard-container">
                <div class="row">
                    <div class="col-md-12">
                                <?php
            $current_employee_editing_self = $this->Employee->get_logged_in_employee_info()->person_id == $person_info->person_id;
            ?>
                        <?php echo form_open_multipart('customers/save/' . $person_info->person_id, array('id' => 'customer_form', 'class' => 'form-horizontal')); ?>
                        <?php $this->load->view("customers/form_basic_info"); ?>

                        <?php echo form_hidden('redirect_code', $redirect_code); ?>

                        <div class="form-actions">
                            <?php
                            echo form_submit(array(
                                'name' => 'submitf',
                                'id' => 'submitf',
                                'value' => lang('common_submit'),
                                'class' => ' btn btn-primary pull-right')
                            );
                            ?>
                        </div>
                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div><!-- /.widget-main -->
        <div> <!--widget-body-->
    </div><!-- /.col -->
</div>
</div>
<script type='text/javascript'>
    $('#image_id').imagePreview({ selector : '#avatar' }); // Custom preview container
            //validation and submit handling
            $(document).ready(function()
    {
    $("#cancel").click(cancelCustomerAddingFromSale);
            setTimeout(function(){$(":input:visible:first", "#customer_form").focus(); }, 100);
            var submitting = false;
            $('#customer_form').validate({
    submitHandler:function(form)
    {
    $.post('<?php echo site_url("customers/check_duplicate"); ?>', {term: $('#email').val() }, function(data) {
<?php if (!$person_info->person_id) { ?>
        if (data.duplicate)
        {

        if (confirm(<?php echo json_encode(lang('customers_duplicate_exists')); ?>))
        {
        doCustomerSubmit(form);
        }
        else
        {
        return false;
        }
        }
<?php } else  ?>
    {
    doCustomerSubmit(form);
    }}, "json")
            .error(function() {
            });
    },
            rules:
    {
<?php if (!$person_info->person_id) { ?>
        account_number:
        {
        remote:
        {
        url: "<?php echo site_url('customers/account_number_exists'); ?>",
                type: "post"

        }
        },
<?php } ?>
    company_name: "required",
    company_reg: "required",
    company_director: "required",
    email: {
        required: true,
        email: true
    },
    person_contact: "required",
    mobile: "required",
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
<?php if (!$person_info->person_id) { ?>
        account_number:
        {
        remote: <?php echo json_encode(lang('common_account_number_exists')); ?>
        },
<?php } ?>
    company_name: 'Please enter company name',
    company_reg: 'Please enter company Register Number',
    company_director: 'Please enter Name Director of Company',
    email: 'Please enter E-mail address',
    mobile: 'Please enter Mobile Number',
      person_contact: 'Please enter person to contact'
    }
    });
            });
            var submitting = false;
            function doCustomerSubmit(form)
                    {
                    $("#form").mask(<?php echo json_encode(lang('common_wait')); ?>);
                            if (submitting) return;
                            submitting = true;
                            $(form).ajaxSubmit({
                    success:function(response)
                    {
                    $("#form").unmask();
                            submitting = false;
                        //    gritter(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.person_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'gritter-item-success' : 'gritter-item-error', false, false);
                    $.notify('Successfully saved','success')
                    <?php if (!$person_info->person_id) { ?>
                        $('.form-group').removeClass('has-success');
                    <?php } ?>
                    if (response.redirect_code == 1 && response.success)
                    {
                    $.post('<?php echo site_url("sales/select_customer"); ?>', {customer: response.person_id}, function()
                    {
                    window.location.href = '<?php echo site_url('sales'); ?>'
                    });
                    }
                    else if (response.redirect_code == 2)
                    {
                    window.location.href = '<?php echo site_url('customers'); ?>'
                    }
                    },
<?php if (!$person_info->person_id) { ?>
                        resetForm: true,
<?php } ?>
                    dataType:'json'
                    });
                            }

            function cancelCustomerAddingFromSale()
                    {
                    if (confirm(<?php echo json_encode(lang('customers_are_you_sure_cancel')); ?>))
                    {
                    window.location = <?php echo json_encode(site_url('sales')); ?>;
                    }
                    }
</script>
<?php $this->load->view("partial/footer"); ?>
