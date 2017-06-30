<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
 </div>
<div class="page-header" id='page-header'>
  <h1> <i class="fa fa-pencil"></i>  <?php
        if (!$item_info->item_id || (isset($is_clone) && $is_clone)) {
            echo lang($controller_name . '_new');
        } else {
            echo lang($controller_name . '_update');
        }
        ?>  
</h1>
</div>


<?php echo form_open_multipart('items/save/' . (!isset($is_clone) ? $item_info->item_id : ''), array('id' => 'item_form', 'class' => 'form-horizontal')); ?>
<div class="col-sm-12">
    <?php echo lang('common_fields_required_message'); ?>
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>									
                </span>
                <?php echo lang("items_basic_information"); ?>
            </h5>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <div class="widget-content nopadding">
                    <div class="row">
                        <div class="span7 ">
                            <div class="form-group required">
                                <?php echo form_label(lang('items_unique_id') . ':', 'item_unique_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'item_unique_id',
                                        'id' => 'item_unique_id',
                                        'class' => 'form-control form-inps',
                                        'value' => $item_unique_id ? $item_unique_id : $item_info->item_unique_id)
                                    );
                                    echo form_hidden('origin_item_unique_id', $item_info->item_unique_id);
                                    ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <?php echo form_label(lang('items_name') . ':', 'item_name', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label required wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'item_name',
                                        'id' => 'item_name',
                                        'class' => 'form-control form-inps',
                                        'value' => $item_info->item_name)
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('items_name_kh') . ':', 'item_name_kh', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label required wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'item_name_kh',
                                        'id' => 'item_name_kh',
                                        'class' => 'form-control form-inps',
                                        'value' => $item_info->item_name_kh)
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('items_unit') . ':', 'unit', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label required wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'unit',
                                        'id' => 'unit',
                                        'class' => 'form-control form-inps',
                                        'value' => $item_info->unit)
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('items_quantity') . ':', 'quantity', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label required wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'quantity',
                                        'id' => 'quantity',
                                        'class' => 'form-control form-inps',
                                        'value' => $item_info->quantity)
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('items_model') . ':', 'model', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'model',
                                        'id' => 'model',
                                        'class' => 'form-control form-inps',
                                        'value' => $item_info->model)
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <?php echo form_label(lang('items_unit_price') . ':', 'unit_price', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label required wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'unit_price',
                                        'size' => '8',
                                        'id' => 'unit_price',
                                        'class' => 'form-control form-inps',
                                        'value' => $item_info->unit_price ? to_currency_no_money($item_info->unit_price, 10) : '')
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <?php echo form_label(lang('items_category') . ':', 'category_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php echo form_dropdown('category_id', $categories, $item_info->category_id, 'class="span3"'); ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <?php echo form_label(lang('items_supplier') . ':', 'supplier', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php echo form_dropdown('supplier_id', $suppliers, $item_info->supplier_id, 'class="span3"'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('items_description') . ':', 'description', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_textarea(array(
                                        'name' => 'description',
                                        'id' => 'description',
                                        'value' => $item_info->description,
                                        'class' => 'form-control  form-textarea',
                                        'rows' => '5',
                                        'cols' => '17')
                                    );
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php echo form_hidden('redirect', isset($redirect) ? $redirect : ''); ?>
                    <div class="form-actions">
                        <?php
                        echo form_submit(array(
                            'name' => 'submitf',
                            'id' => 'submitf',
                            'value' => lang('common_submit'),
                            'class' => 'submit_button btn btn-primary pull-right')
                        );
                        ?>
                    </div>
                    <?php echo form_close(); ?>

                    <div class="item_navigation clearfix">
                        <?php
                        if (isset($prev_item_id) && $prev_item_id) {
                            echo '<div class="previous_item pull-left">';
                            echo anchor('items/view/' . $prev_item_id, '&laquo; ' . lang('items_prev_item'));
                            echo '</div>';
                        }
                        ?>

                        <?php
                        if (isset($next_item_id) && $next_item_id) {
                            echo '<div class="next_item pull-right">';
                            echo anchor('items/view/' . $next_item_id, lang('items_next_item') . ' &raquo;');
                            echo '</div>';
                        }
                        ?>
                    </div>

                </div>
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div><!-- /.col -->
</div>
<script type='text/javascript'>
//validation and submit handling
    $(document).ready(function()
    {

        setTimeout(function(){$(":input:visible:first", "#item_form").focus(); }, 100);

        /*$("#model").autocomplete({
            source: "<?php echo site_url('items/suggest_category'); ?>",
                delay: 300,
                autoFocus: false,
                minLength: 0
        });*/
        $('#item_form').validate({
            submitHandler:function(form)
            {
                $.post('<?php echo site_url("items/check_duplicate"); ?>', {term: $('#item_name').val()}, function(data) {
                    <?php if (!$item_info->item_id) { ?>
                    if (data.duplicate)
                    {
                        if (confirm(<?php echo json_encode(lang('items_duplicate_exists')); ?>))
                        {
                            doItemSubmit(form);
                        }
                        else
                        {
                            return false;
                        }
                    }
            <?php } else  ?>
                {
                    doItemSubmit(form);
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
                <?php if (!$item_info->item_id) { ?>
                    item_unique_id:
                    {
                        remote:
                        {
                            url: "<?php echo site_url('items/item_unique_exists'); ?>",
                                type: "post",
                            // depends: 
                        }
                    },
                <?php } ?>
                item_name:"required",
                category_id:"required",
                supplier_id:"required",
                unit_price:
                {
                    required:true,
                    number:true
                },
                items_quantity:
                {
                    number:true
                },
            },
            messages:
            {
                <?php if (!$item_info->item_id) { ?>
                    item_unique_id:
                    {
                        remote: <?php echo json_encode(lang('items_item_unique_exists')); ?>

                    },
                <?php } ?>

                item_name:<?php echo json_encode(lang('items_name_required')); ?>,
                category_id:<?php echo json_encode(lang('items_category_required')); ?>,
                category_id:<?php echo json_encode(lang('items_supplier_required')); ?>,
                unit_price:
                {
                    required:<?php echo json_encode(lang('items_unit_price_required')); ?>,
                    number:<?php echo json_encode(lang('items_unit_price_number')); ?>
                },
            }
        });
    });
    var submitting = false;
    function doItemSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.item_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url('items'); ?>'
                }
            },
            <?php if (!$item_info->item_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }

</script>
<?php $this->load->view('partial/footer'); ?>