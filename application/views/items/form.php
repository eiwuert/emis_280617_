<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
    <?php echo create_breadcrumb(); ?>
</div>

<div class="page-header" id='page-header'>
    <h1><i class="fa fa-pencil"></i><?php
        if (!$po_info->po_id || (isset($is_clone) && $is_clone)) {
            echo lang($controller_name . '_new');
        } else {
            echo lang($controller_name . '_update');
        }
        ?>  
    </h1>
</div>

<?php echo form_open_multipart('items/save_po/'. (!isset($is_clone) ? $po_info->po_id : ''), array('id' => 'item_form', 'class' => 'form-horizontal')); ?>
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
                                <?php echo form_label(lang('po_supplier') . ':', 'supplier', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php echo form_dropdown('supplier', $suppliers, $po_info->po_supplier, 'class="span3"'); ?>
                                </div>
                            </div>

                            <div class="form-group required">
                                <?php echo form_label(lang('po_exchange') . ':', 'exchange', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label requiblue wide')); ?>
                                
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'exchange_dollar',
                                        'type' => 'number',
                                        'id' => 'exchange_dollar',
                                        'class' => 'form-control form-inps',
                                        'placeholder' => 'Exchange Riel',
                                        'value' => ($po_info->po_exchange_d)? $po_info->po_exchange_d : '')
                                    );
                                    ?>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'exchange_baht',
                                        'type' => 'number',
                                        'id' => 'exchange_baht',
                                        'class' => 'form-control form-inps',
                                        'placeholder' => 'Exchange Baht',
                                        'value' => ($po_info->po_exchange_b)? $po_info->po_exchange_b : '')
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group required">                                
                                <div class="col-sm-1 col-md-1 col-lg-1 control-label wide">
                                    <a class="btn btn-primary add_pro" href="javascript:void(0);">Add</a>                                    
                                </div>

                                <div class="col-sm-11 col-md-11 col-lg-11">
                                    <table class="table add_tr" style="border: none !important;">
                                        <?php if($po_items_info): ?>
                                            <?php foreach($po_items_info as $key=>$value):?>
                                                <?php $info_items_id = $value->item_id ?>
                                                <?php $info_items_unit_id = $value->item_unit_id ?>
                                                <?php $q = $this->Item->get_cate_unit_id($info_items_id)->result(); ?>     
                                             
                                            <?php echo form_hidden('autoid[]',$value->id)?>
                                            <tr class="parent_td">
                                                <td style="border:none;padding: 0px">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Select Items:</label>
                                                                <select name="item_name_old[]" class="form-control form-inps item_name" id="item_name" placeholder="Product Name" style="height:auto">
                                                                        <option value="">-- Select Items --</option>
                                                                    <?php foreach($items as $key=>$row): ?>
                                                                        <option value="<?php echo $row->item_id ?>" <?php echo (($info_items_id == $row->item_id)? "selected" : "")?> ><?php echo $row->item_name ?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Item Code:</label>
                                                                <?php echo form_input(array('name' => 'item_unique_id_old[]','id' => 'item_unique_id','class' => 'form-control form-inps item_unique_id','placeholder' => 'Product Code','value' => $value->item_unique_id));?>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Unit:</label>
                                                                <select name="item_unit_old[]" class="form-control form-inps item_unit" id="item_unit" placeholder="Unit" style="height:auto">
                                                                    <?php foreach($q as $result=>$u):?>
                                                                    <option data-qty='<?php echo $u->item_qty_unit?>' value='<?php echo $u->item_unit_cate_id?>' <?php echo (($info_items_unit_id == $u->item_unit_cate_id)? "selected" : "")?> ><?php echo $u->unit_name?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">QTY:</label>
                                                                <?php echo form_input(array('name' => 'quantity_old[]', "type"=>"number", 'id' => 'quantity','class' => 'form-control form-inps quantity', 'style'=>'font-weight:bold','placeholder' => 'QTY','value' => $value->item_qty));?>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">All QTY:</label>
                                                                <?php echo form_input(array('name' => 'all_qty_old[]', "type"=>"number", 'id' => 'all_qty','class' => 'form-control form-inps all_qty', 'style'=>'font-weight:bold','placeholder' => 'All QTY','value' => $value->item_all_qty, 'readonly' => 'true'));?>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Discount:</label>
                                                                <?php echo form_input(array('name' => 'each_discount_old[]', "type"=>"number", 'id' => 'each_discount','class' => 'form-control form-inps each_discount', 'style'=>'font-weight:bold','placeholder' => 'Discount','value' => (($value->item_each_discount)? $value->item_each_discount : 0)));?>
                                                            </td>  
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Price Dollar:</label>
                                                                <?php echo form_input(array('name' => 'd_price_old[]', "type"=>"number", 'id' => 'd_price','class' => 'form-control form-inps d_price', 'style'=>'font-weight:bold','placeholder' => 'Price Dollar','value' => $value->item_pri_d));?>
                                                            </td> 
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Total Dollar:</label>
                                                                <?php echo form_input(array('name' => 'total_dollar_old[]', "type"=>"number", 'id' => 'total_dollar', 'class' => 'form-control form-inps total_dollar','placeholder' => 'Total Dollar', 'style'=>'font-weight:bold; color:#00bede !important', 'value' => $value->item_total_d, "readonly" => "true"));?>
                                                            </td>                                        
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Total Reil:</label>
                                                                <?php echo form_input(array('name' => 'total_riel_old[]', "type"=>"number", 'id' => 'total_riel','class' => 'form-control form-inps total_riel','placeholder' => 'Total Riel', 'style'=>'font-weight:bold; color:#00bede !important', 'value' => $value->item_total_r, 'readonly' => 'true'));?>
                                                            </td>                                                                                      
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Total Baht:</label>
                                                                <?php echo form_input(array('name' => 'total_baht_old[]', "type"=>"number", 'id' => 'total_baht','class' => 'form-control form-inps total_baht','placeholder' => 'Total Baht', 'style'=>'font-weight:bold; color:#00bede !important', 'value' => $value->item_total_b, 'readonly' => 'true'));?>
                                                            </td>  
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="first_total" colspan="2">                            
                                                    <a class="blue btn btn-active remove_field_emp" href="javascript:void(0);">Remove</a>
                                                    <?php echo form_hidden('deleted[]')?>
                                                </td>  
                                            </tr>
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <tr class="parent_td">
                                                <td style="border:none;padding: 0px">
                                                    <table class="table">
                                                        <tr>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Select Items:</label>
                                                                <select name="item_name[]" class="form-control form-inps item_name" id="item_name" placeholder="Product Name" style="height:auto">
                                                                    <option value="">-- Select Items --</option>
                                                                    <?php foreach($items as $key=>$row): ?>
                                                                    <option value="<?php echo $row->item_id ?>"><?php echo $row->item_name ?></option>
                                                                    <?php endforeach ?> 
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Item Code:</label>
                                                                <?php echo form_input(array('name' => 'item_unique_id[]','id' => 'item_unique_id','class' => 'form-control form-inps item_unique_id','placeholder' => 'Product Code','value' => ''));?>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Unit:</label>
                                                                <select name="item_unit[]" class="form-control form-inps item_unit" id="item_unit" placeholder="Unit" style="height:auto">
                                                                        <option value="">-- Unit --</option>                                                            
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">QTY:</label>
                                                                <?php echo form_input(array('name' => 'quantity[]', "type"=>"number", 'id' => 'quantity','class' => 'form-control form-inps quantity', 'style'=>'font-weight:bold','placeholder' => 'QTY','value' => ''));?>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">All QTY:</label>
                                                                <?php echo form_input(array('name' => 'all_qty[]', "type"=>"number", 'id' => 'all_qty','class' => 'form-control form-inps all_qty', 'style'=>'font-weight:bold','placeholder' => 'All QTY','value' => '', 'readonly' => 'true'));?>
                                                            </td>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Discount:</label>
                                                                <?php echo form_input(array('name' => 'each_discount[]', "type"=>"number", 'id' => 'each_discount','class' => 'form-control form-inps each_discount', 'style'=>'font-weight:bold','placeholder' => 'Discount','value' => 0));?>
                                                            </td>  
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Price Dollar:</label>
                                                                <?php echo form_input(array('name' => 'd_price[]', "type"=>"number", 'id' => 'd_price','class' => 'form-control form-inps d_price', 'style'=>'font-weight:bold','placeholder' => 'Price Dollar','value' => ''));?>
                                                            </td> 
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Total Dollar:</label>
                                                                <?php echo form_input(array('name' => 'total_dollar[]', "type"=>"number", 'id' => 'total_dollar', 'class' => 'form-control form-inps total_dollar','placeholder' => 'Total Dollar', 'style'=>'font-weight:bold; color:#00bede !important', 'value' => '', "readonly" => "true"));?>
                                                            </td>                                        
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Total Reil:</label>
                                                                <?php echo form_input(array('name' => 'total_riel[]', "type"=>"number", 'id' => 'total_riel','class' => 'form-control form-inps total_riel','placeholder' => 'Total Riel', 'style'=>'font-weight:bold; color:#00bede !important', 'value' => '', 'readonly' => 'true'));?>
                                                            </td>                                                                                      
                                                            <td>
                                                                <label class="col-sm-12 col-xs-12 no-padding">Total Baht:</label>
                                                                <?php echo form_input(array('name' => 'total_baht[]', "type"=>"number", 'id' => 'total_baht','class' => 'form-control form-inps total_baht','placeholder' => 'Total Baht', 'style'=>'font-weight:bold; color:#00bede !important', 'value' => '', 'readonly' => 'true'));?>
                                                            </td>  
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td class="first_total" colspan="2">                            
                                                    <a class="blue btn btn-active remove_field_emp" href="javascript:void(0);">Remove</a>
                                                </td>  
                                            </tr>
                                        <?php endif ?>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group required">
                                <?php echo form_label(lang('po_discount') . ' $ :', 'discount', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'discount',
                                        'type'=>'number',
                                        'id' => 'discount',
                                        'class' => 'form-control form-inps',
                                        'placeholder' => 'Discount',
                                        'value' => ($po_info->po_discount)? $po_info->po_discount : '')
                                    );
                                    ?>
                                    <?php echo form_hidden('total_discount',(($po_info->po_total_discount)? $po_info->po_total_discount : 0))?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('po_total_dollar') . ':', 'dollar_total', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'dollar_total',
                                        'type'=>'number',
                                        'id' => 'dollar_total',
                                        'class' => 'form-control form-inps',
                                        'placeholder' => 'Total Dollar',
                                        'readonly' => 'true',
                                        'value' => ($po_info->po_total_d)? $po_info->po_total_d : '')
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('po_total_riel') . ':', 'reil_total', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'riel_total',
                                        'type'=>'number',
                                        'id' => 'riel_total',
                                        'class' => 'form-control form-inps',
                                        'placeholder' => 'Total Riel',
                                        'readonly' => 'true',
                                        'value' => ($po_info->po_total_r)? $po_info->po_total_r : '')
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('po_total_baht') . ':', 'baht_total', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?php
                                    echo form_input(array(
                                        'name' => 'baht_total',
                                        'type'=>'number',
                                        'id' => 'baht_total',
                                        'class' => 'form-control form-inps',
                                        'placeholder' => 'Total Baht',
                                        'readonly' => 'true',
                                        'value' => ($po_info->po_total_b)? $po_info->po_total_b : '')
                                    );
                                    ?>
                                </div>
                            </div>                           

                            <div class="form-group">
                                <?php echo form_label(lang('po_receiver') . ':', 'receiver', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?php echo form_dropdown( 'receiver', $employee, $po_info->po_receiver_id,'class="form-control" id="receiver"'); ?>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <?//php echo form_label(lang('po_send_by') . ':', 'send_by', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <?//php echo form_dropdown( 'send_by', $employee, $po_info->po_send_by_id,'class="form-control" id="sendby"'); ?>
                                </div>
                            </div> -->

                            <div class="form-group">
                                <?php echo form_label(lang('po_date') . ':', 'date', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-3 col-md-3 col-lg-3 col-xs-12">
                                    <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                        <input type="text" id="date" class="form-control hasDatepicker" name="date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $po_info->po_date != "" ? date('d-m-Y', strtotime($po_info->po_date)) : ""; ?>">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo form_label(lang('po_description') . ':', 'description', array('class' => 'col-sm-2 col-md-2 col-lg-2 control-label wide')); ?>
                                <div class="col-sm-9 col-md-9 col-lg-9">
                                    <?php
                                    echo form_textarea(array(
                                        'name' => 'description',
                                        'id' => 'description',
                                        'value' => $po_info->po_description,
                                        'class' => 'form-control  form-textarea',
                                        'rows' => '5',
                                        'cols' => '17')
                                    );
                                    ?>
                                </div>
                            </div>                            

                        </div>
                    </div>

                   
                    <div class="form-group col-sm-12">
                        <div class="pull-right">
                            <b><?php echo lang('po_check_result')?>: &nbsp;</b>
                            <input type="checkbox" name="ch_total" id="ch_total" value="1" /><br>
                        </div>
                    </div>
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

<?php echo $this->load->view('items/calculator')?>

<script type='text/javascript'>

    $(document).ready(function()
    {
        initDatePicker("input[name='date']");
        setTimeout(function(){$(":input:visible:first", "#item_form").focus(); }, 100);

        $('#item_form').validate({
            submitHandler:function(form)
            {
               doPoSubmit(form);
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
                exchange_dollar:"required",
                exchange_baht:"required",
                item_name:"required",                
                quantity:"required",                     
                date:"required",  
                ch_total:"required",         
                receiver:"required",         
                // send_by:"required",         
            },
            messages:
            {            
                exchange_dollar:<?php echo json_encode(lang('po_exchange_dollar_required')); ?>, 
                exchange_baht:<?php echo json_encode(lang('po_exchange_baht_required')); ?>, 
                item_name:<?php echo json_encode(lang('po_item_name_required')); ?>,      
                quantity:<?php echo json_encode(lang('po_quantity_required')); ?>,                     
                date:<?php echo json_encode(lang('po_date_required')); ?>, 
                ch_total:<?php echo json_encode(lang('po_ch_total_required')); ?>,                  
                receiver:<?php echo json_encode(lang('po_receiver_required')); ?>, 
                // send_by:<?php echo json_encode(lang('po_send_by_required')); ?>, 
            }
        });
    });
    var submitting = false;
    function doPoSubmit(form)
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
            <?php if (!$po_info->item_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }

</script>
<?php $this->load->view('partial/footer'); ?>