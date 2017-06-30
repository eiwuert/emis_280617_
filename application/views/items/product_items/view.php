<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
 </div>
<div class="page-header" id='page-header'>
    <h1><i class="fa fa-pencil"></i>
    <?php
        if (!$item_info->item_id || (isset($is_clone) && $is_clone)) {
            echo lang($controller_name . '_new');
        } else {
            echo lang($controller_name . '_update');
        }
    ?>  
    </h1>
</div>

<?php echo form_open('product_items/save/' . (!isset($is_clone) ? $item_info->item_id : ''), array('id' => 'item_form', 'class' => 'form-horizontal')); ?>
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
                                <?php echo form_label(lang('items_category') . ':', 'category_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php echo form_dropdown('category_id', $category, ($item_info->category_id)?$item_info->category_id : 0, 'class="form-control form-inps"'); ?>
                                </div>
                            </div>

                            <?php if($item_info->item_id): ?>
                                <div class="form-group required">
                                    <?php echo form_label(lang('') . 'Average Cost:', 'category_id', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label wide')); ?>
                                    <div class = 'col-sm-3 col-md-3 col-lg-2'>
                                        <span style="line-height:2"><b>$<?php echo $average_cost?></b></span>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="form-group required">                                
                                <div class="col-sm-3 col-md-3 col-lg-2 control-label wide">
                                    <a class="btn btn-primary add_items_sell" href="javascript:void(0);">Add</a>                                    
                                </div>

                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <table class="table add_tr" style="border:solid 1x #ccc">
                                            <tr>
                                                <th class="parent_td">                                
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo lang('items_unit')?> 
                                                    </div>                                 
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo lang('items_unit_qty')?> 
                                                    </div>                                 
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo lang('items_unit_forsell')?> 
                                                    </div>                                 
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo lang('items_unit_discount')?> 
                                                    </div> 
                                                </th>
                                                <th class="parent_td">
                                                        <?php echo lang('common_action')?> 
                                                </th>
                                            </tr>
                                        <?php if($sell_unit_info): ?>
                                            <?php foreach($sell_unit_info as $key=>$value):?>
                                                <?php $info_cate_id = $value->item_unit_cate_id ?>
                                            <tr>
                                                <td class="parent_td">                                                    
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>

                                                        <?php echo form_hidden('autoid[]',$value->id)?> 
                                                        <select name="sell_cate_old[]" class="form-control form-inps sell_cate_old" id="sell_cate_old" placeholder="Unit Name" style="height:auto">
                                                            <option value="">-- Select Unit Item --</option>   
                                                            <?php foreach($unit_items as $key=>$row): ?>
                                                                <option value="<?php echo $row->unit_id ?>" <?php echo (($info_cate_id == $row->unit_id)? "selected" : "")?> ><?php echo $row->unit_name ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div> 

                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo form_input(array('name' => 'sell_qty_old[]', "type"=>"number", 'id' => 'sell_qty_old','class' => 'form-control form-inps','placeholder' => 'Sell QTY','value' => $value->item_qty_unit));?>
                                                    </div> 

                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo form_input(array('name' => 'sell_price_old[]', "type"=>"number", 'id' => 'sell_price_old','class' => 'form-control form-inps','placeholder' => 'Sell Price','value' => $value->item_set_price));?>
                                                    </div>
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo form_input(array('name' => 'discount_old[]', "type"=>"number", 'id' => 'sell_price_old','class' => 'form-control form-inps','placeholder' => 'Discount Price $','value' => $value->item_discount));?>
                                                    </div>                                            
                                                    
                                                </td>
                                                <td class="first_row" colspan="2">
                                                    <a class="blue btn btn-active remove_field" href="javascript:void(0);">Remove</a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php else: ?> 
                                            <tr>
                                                <td class="parent_td">                                                    
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <select name="sell_cate[]" class="form-control form-inps sell_cate" id="sell_cate" placeholder="Unit Name" style="height:auto">
                                                                <option value="">-- Select Unit Item --</option>
                                                            <?php foreach($unit_items as $key=>$row): ?>
                                                                <option value="<?php echo $row->unit_id ?>" <?php echo (($info_items_id == $row->unit_id)? "selected" : "")?> ><?php echo $row->unit_name ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div> 

                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo form_input(array('name' => 'sell_qty[]', "type"=>"number", 'id' => 'sell_qty','class' => 'form-control form-inps','placeholder' => 'Sell QTY','value' =>''));?>
                                                    </div> 

                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo form_input(array('name' => 'sell_price[]', "type"=>"number", 'id' => 'sell_price','class' => 'form-control form-inps','placeholder' => 'Sell Price','value' =>''));?>
                                                    </div> 
                                                    <div class='col-sm-3 col-md-3 col-lg-3 col-xs-12'>
                                                        <?php echo form_input(array('name' => 'discount[]', "type"=>"number", 'id' => 'sell_price_old','class' => 'form-control form-inps','placeholder' => 'Discount Price $','value' => $value->discount));?>
                                                    </div>                                            
                                                    
                                                </td>
                                                <td class="first_row" colspan="2">
                                                    <a class="blue btn btn-active remove_field" href="javascript:void(0);">Remove</a>
                                                </td>
                                            </tr>                                   
                                        <?php endif ?>                                    
                                    </table>
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

                   <!--  <div class="item_navigation clearfix">
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
                    </div> -->

                </div>
            </div><!-- /.widget-body -->
        </div><!-- /.widget-box -->
    </div><!-- /.col -->
</div>
<?php echo $this->load->view('items/product_items/cal_item_product')?>
<script type='text/javascript'>
    //validation and submit handling
    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#item_form").focus(); }, 100);
        $('#item_form').validate({
            submitHandler:function(form)
            {
                doItemProductSubmit(form);
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
                item_name: "required",
                item_name_kh : "required",
                model : "required",
                category_id: "required",
            },
            messages:
            {
                item_name: <?php echo json_encode(lang('item_products_name_required')); ?>,
                item_name_kh: <?php echo json_encode(lang('item_products_name_kh_required')); ?>,
                model: <?php echo json_encode(lang('item_products_model_required')); ?>,                
            }
        });
    });
    var submitting = false;
    function doItemProductSubmit(form)
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
                    window.location.href = '<?php echo site_url('product_items'); ?>';
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
        });
    }
</script>




<?php $this->load->view('partial/footer'); ?>