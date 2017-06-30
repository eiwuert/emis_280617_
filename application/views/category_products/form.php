<?php echo $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1><i class="fa fa-pencil"></i> <?php
            if (!$cate_prod_info->item_category_id) {
                echo lang('category_products_new');
            } else {
                echo lang('category_products_update');
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
                                   	<?php echo lang("category_products_basic_information"); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                echo form_open($controller_name.'/save/' . $cate_prod_info->item_category_id, array('id' => 'category_products_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required">  
                                        <?php echo form_label(lang('category_products_name') . ':', 'category_products_name', array('class' => 'col-sm-4 col-md-4 col-lg-3 control-label')); ?>
                                        <div class="col-sm-8 col-md-8 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'name',
                                                'id' => 'category_products_name',
                                                'class' => 'form-control',
                                                'value' => $cate_prod_info->name));
                                            echo form_hidden('original_category_products_name', $cate_prod_info->name);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">  
                                        <?php echo form_label(lang('category_products_note') . ':', 'category_products_note', array('class' => 'col-sm-3 col-md-3 col-lg-3 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_textarea(array(
                                                'name' => 'description',
                                                'id' => 'category_products_note',
                                                'class' => 'form-control',
                                                'value' => $cate_prod_info->description));
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
    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#category_products_form").focus(); }, 100);
        $('#category_products_form').validate({
            submitHandler:function(form)
            {
            $.post('<?php echo site_url("category_products/check_duplicate"); ?>', {term: $('#category_products_name').val()}, function(data) {
        <?php if (!$cate_prod_info->item_category_id) { ?>
                if (data.duplicate)
                {
                    if (confirm(<?php echo json_encode(lang('school_class_duplicate_exists')); ?>))
                    {
                        doItemCategorySubmit(form);
                    }
                    else
                    {
                        return false;
                    }
                }
        <?php } else  ?>
            {
                doItemCategorySubmit(form);
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
                name:
                {
                    remote:
                    {
                        param: {
                            url: "<?php echo site_url('category_products/category_products_exists'); ?>",
                            type: 'post',
                        },
                        depends: function(category_products_name) {
                            return ($(category_products_name).val() != $('input[name="original_category_products_name"]').val());
                        }
                    },
                    required:true,
                },
                
            },
            messages:
            {
                category_products_name:
                {
                    remote: <?php echo json_encode(lang('category_products_duplicate_exists')); ?>,
                    required: <?php echo json_encode(lang('category_products_category_products_name_required')); ?>,
                },
            }
        });
    });
    var submitting = false;
    function doItemCategorySubmit(form)
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
                    window.location.href = '<?php echo site_url('category_products'); ?>';
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