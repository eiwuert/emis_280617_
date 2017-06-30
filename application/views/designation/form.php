<?php echo $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
      <h1 ><i class="fa fa-pencil"></i> <?php
        if (!$designation_info->designation_id) {
            echo lang('designation_new');
        } else {
            echo lang('designation_update');
        }
        ?>  </h1>
</div>

    <div class="page-content">

        
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                    <!-- <div class="widget-content nopadding table_holder table-responsive" > -->
                        <?php // echo $manage_table; ?>         
                    <!-- </div>      -->
                        <div class="col-xs-12">
                        <?php echo lang('common_fields_required_message'); ?> 
                        <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h5 class="widget-title">
                                        <span class="icon">
                                            <i class="fa fa-align-justify"></i>                                 
                                        </span>
                                       	<?php echo lang("designation_basic_information"); ?>
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                    echo form_open($controller_name.'/save/' . $designation_info->designation_id, array('id' => 'designation_form', 'class' => 'form-horizontal'));
                                ?>

                                				
                                                <div class="form-group">  
                                                    <?php echo form_label(lang('designation_name') . ':', 'designation_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 required')); ?>
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <?php
                                                        echo form_input(array(
                                                            'name' => 'designation_name',
                                                            'id' => 'designation_name',
                                                            'class' => 'form-control',
                                                            'value' => $designation_info->designation_name));
                                                        echo form_hidden('original_designation_name', $designation_info->designation_name);
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="form-group">  
                                                    <?php echo form_label(lang('designation_alias') . ':', 'designation_alias', array('class' => 'col-sm-3 col-md-3 col-lg-2 required')); ?>
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <?php
                                                        echo form_input(array(
                                                            'name' => 'designation_alias',
                                                            'id' => 'designation_alias',
                                                            'class' => 'form-control',
                                                            'value' => $designation_info->designation_alias));
                                                        echo form_hidden('original_designation_alias', $designation_info->designation_alias);
                                                        ?>
                                                    </div>
                                                </div>

                                                
                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
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


                                </form> 
                                </div>  


                                       
                        </div>
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<script type='text/javascript'>

    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#designation_form").focus(); }, 100);
        $('#designation_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("designation/check_duplicate"); ?>', {term: $('#designation_name').val()}, function(data) {
        <?php if (!$designation_info->designation_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('designation_duplicate_exists')); ?>))
                    {
                        dodesignationSubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                dodesignationSubmit(form);
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
                designation_name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('designation/designation_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(designation_name) {
                            return ($(designation_name).val() != $('input[name="original_designation_name"]').val());
                        }
                    },
                    required:true,
                },
                
            },
            messages:
            {
                designation_name:
                {
                    remote: <?php echo json_encode(lang('designation_status_exists')); ?>,
                    required: <?php echo json_encode(lang('designation_name_required')); ?>,
                },
            }
        });
    });
    var submitting = false;
    function dodesignationSubmit(form)
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
                    window.location.href = '<?php echo site_url('designation'); ?>';
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

<?php echo $this->load->view("partial/footer"); ?>