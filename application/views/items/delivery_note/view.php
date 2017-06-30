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
            echo lang('delivery_new');
        } else {
            echo lang('delivery_update');
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
                                        <?php echo lang("delivery_information"); ?>
                                    </h5>
                                </div>
                                <div class="widget-body" style="margin:0px 13px;">
                                <br>
                                    <?php if($this->session->flashdata('fail_keep')):?>
                                    <div class="col-sm-12 btn btn-primery" style="background:#0286d6!important"><?php echo $this->session->flashdata('fail_keep'); ?></div>
                                    <?php endif ?>
                                        
                                <?php echo form_open('product_delivery_note/save/'.$get_edit->delivery_id, array('id' => 'item_form', 'class' => 'form-horizontal')); ?>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_exchange_riel')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="exchange_riel" type="number" value="<?php echo $get_edit->exchange_riel?>" />
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_exchange_baht')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="exchange_baht" type="number" value="<?php echo $get_edit->exchange_baht?>" />
                                            </div>
                                        </div>
                                        <table class="tablesorter table table-bordered  table-hover">
                                            <colgroup>
                                                <col style="width:15%">
                                                <col style="width:15%">
                                                <col style="width:10%">
                                                <col style="width:8%">
                                                <col style="width:10%">
                                                <col style="width:15%">
                                                <col style="width:15%">
                                                <col style="width:15%">
                                            </colgroup>
                                            <tr>
                                                <th><?php echo lang('delivery_item_name')?></th>
                                                <th><?php echo lang('delivery_unique_id')?></th>
                                                <th><?php echo lang('delivery_unit')?></th>
                                                <th><?php echo lang('delivery_amount')?></th>
                                                <th><?php echo lang('delivery_total_unit')?></th>
                                                <th><?php echo lang('delivery_total_dollar')?></th>
                                                <th><?php echo lang('delivery_total_reil')?></th>
                                                <th><?php echo lang('delivery_total_baht')?></th>
                                                <th><?php echo lang('delivery_discount')?></th>
                                                <th><a class="btn btn-sm btn-success add_pro" href="javascript:void(0);">Add More</a></th>
                                            </tr>
                                            <tbody class="sortable_table">
                                            <?php if($get_edit_pro->num_rows() > 0): ?>
                                            <?php foreach($get_edit_pro->result() as $val):?>                                                
                                                <tr class="parent_td">
                                                    <td>
                                                        <?php echo form_hidden('autoid[]',$val->id)?>
                                                        <?php echo form_hidden('deleted[]')?>
                                                        <select name="item_name_old[]" class="form-control form-inps item_name" id="item_name" placeholder="Product Name" style="height:auto">
                                                            <option value="">-- Select Items --</option>
                                                        <?php foreach($items as $key=>$row): ?>
                                                            <option value="<?php echo $row->item_id ?>" <?php echo (($val->delivery_item_id == $row->item_id)? 'selected':'')?>><?php echo $row->item_name ?></option>
                                                        <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td><?php echo form_input(array("name" => "item_unique_id_old[]","id" => "item_unique_id","class" => "form-control form-inps item_unique_id","placeholder" => "Product Code","value" => $val->item_unique_id));?></td>
                                                    <td>
                                                        <select name="item_unit_old[]" class="form-control form-inps item_unit" id="item_unit" placeholder="Unit" style="height:auto">
                                                                <option value="">-- Select Unit --</option>
                                                            <?php
                                                                $units = $this->Delivery->get_cate_unit_id($val->delivery_item_id)->result();
                                                            ?>
                                                            <?php foreach($units as $key=>$row): ?>
                                                                <option data-qty="<?php echo $row->item_qty_unit ?>" data-pri="<?php echo $row->item_set_price ?>" data-discount="<?php echo $row->item_discount ?>" value="<?php echo $row->unit_id ?>" <?php echo (($val->delivery_item_unit == $row->unit_id)? 'selected':'')?>><?php echo $row->unit_name ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <?php echo form_input('storage_unit_price_old[]',$val->delivery_price_for_sell,'class="storage_unit_price" id="storage_unit_price" readonly=""')?>
                                                        <?php echo form_hidden('storage_unit_discount_old[]',$val->delivery_price_for_sell,'class="storage_unit_discount" id="storage_unit_discount" readonly=""')?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "quantity_old[]", "type"=>"number", "id" => "quantity", "class" => "form-control form-inps quantity", 'style'=>'font-weight:bold', "placeholder" => "QTY","value" => $val->delivery_quantity));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array('name' => 'all_qty_old[]', "type"=>"number", 'id' => 'all_qty','class' => 'form-control form-inps all_qty', 'style'=>'font-weight:bold','placeholder' => 'All QTY','value' => $val->delivery_all_qty, 'readonly' => 'true'));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "total_dollar_old[]", "type"=>"number", "id" => "total_dollar", "class" => "form-control form-inps total_dollar","placeholder" => "Total Dollar","value" => $val->delivery_total_dollar, 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "total_riel_old[]", "type"=>"number", "id" => "total_riel","class" => "form-control form-inps total_riel","placeholder" => "Total Riel","value" => $val->delivery_total_riel, 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "total_baht_old[]", "type"=>"number", "id" => "total_baht","class" => "form-control form-inps total_baht","placeholder" => "Total Baht","value" => $val->delivery_total_baht, 'style'=>'font-weight:bold; color:#00bede !important', "readonly" =>"true"));?>
                                                    </td>                                                    
                                                    <td>
                                                        <?php echo form_input(array("name" => "d_each_discount_old[]", "type"=>"number", "id" => "d_each_discount","class" => "form-control form-inps d_each_discount","placeholder" => "Discount","value" => (($val->delivery_each_discount)? $val->delivery_each_discount : 0 ), 'style'=>'font-weight:bold; color:#00bede !important'));?>
                                                    </td>
                                                    <td><a class="btn btn-sm btn-danger remove" href="javascript:void(0);">Add More</a></td>
                                                </tr>
                                            <?php endforeach ?>
                                            <?php else: ?>
                                                <tr class="parent_td">
                                                    <td>
                                                        <select name="item_name[]" class="form-control form-inps item_name" id="item_name" placeholder="Product Name" style="height:auto">
                                                            <option value="">-- Select Items --</option>
                                                        <?php foreach($items as $key=>$row): ?>
                                                            <option value="<?php echo $row->item_id ?>"><?php echo $row->item_name ?></option>
                                                        <?php endforeach ?>
                                                        </select>
                                                    </td>
                                                    <td><?php echo form_input(array("name" => "item_unique_id[]","id" => "item_unique_id","class" => "form-control form-inps item_unique_id","placeholder" => "Product Code","value" => ""));?></td>
                                                    <td>
                                                        <select name="item_unit[]" class="form-control form-inps item_unit" id="item_unit" placeholder="Unit" style="height:auto">
                                                                <option value="">-- Select Unit --</option>
                                                            <?php foreach($unit_items as $key=>$row): ?>
                                                                <option value="<?php echo $row->unit_id ?>"><?php echo $row->unit_name ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <?php echo form_input('storage_unit_price[]','','class="storage_unit_price" id="storage_unit_price" readonly=""')?>
                                                        <?php echo form_hidden('storage_unit_discount[]','','class="storage_unit_discount" id="storage_unit_discount" readonly=""')?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "quantity[]", "type"=>"number", "id" => "quantity", "class" => "form-control form-inps quantity", 'style'=>'font-weight:bold', "placeholder" => "QTY","value" => ""));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array('name' => 'all_qty[]', "type"=>"number", 'id' => 'all_qty','class' => 'form-control form-inps all_qty', 'style'=>'font-weight:bold','placeholder' => 'All QTY','value' => '', 'readonly' => 'true'));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "total_dollar[]", "type"=>"number", "id" => "total_dollar", "class" => "form-control form-inps total_dollar","placeholder" => "Total Dollar","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "total_riel[]", "type"=>"number", "id" => "total_riel","class" => "form-control form-inps total_riel","placeholder" => "Total Riel","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" => "true"));?>
                                                    </td>
                                                    <td>
                                                        <?php echo form_input(array("name" => "total_baht[]", "type"=>"number", "id" => "total_baht","class" => "form-control form-inps total_baht","placeholder" => "Total Baht","value" => "", 'style'=>'font-weight:bold; color:#00bede !important', "readonly" =>"true"));?>
                                                    </td>                                                
                                                    <td>
                                                        <?php echo form_input(array("name" => "d_each_discount[]", "type"=>"number", "id" => "d_each_discount","class" => "form-control form-inps d_each_discount","placeholder" => "Discount","value" => 0, 'style'=>'font-weight:bold; color:#00bede !important'));?>
                                                    </td>
                                                    <td><a class="btn btn-sm btn-danger remove_emp" href="javascript:void(0);">Add More</a></td>
                                                </tr>
                                            <?php endif ?>
                                            </tbody>                                    
                                        </table> 

                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_discount')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input type="number" class="filter form-control" name="discount" id="discount" placeholder="Discount" type="text" value="<?php echo (($get_edit->discount)? $get_edit->discount : 0) ?>" />
                                                <?php echo form_hidden('all_discount', $get_edit->all_discount)?>
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_dollar')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="total_price_d" type="text" value="<?php echo $get_edit->total_price_d?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_riel')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="total_price_r" type="text" value="<?php echo $get_edit->total_price_r?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_baht')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="total_price_b" type="text" value="<?php echo $get_edit->total_price_b?>" readonly/>
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_receiver_type')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <?php echo form_dropdown(
                                                    'receiver_type',
                                                    $receiver_type,
                                                    $get_edit->receiver_type_id,
                                                    'class="form-control" id="receiver_type"'
                                                ); ?>
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-bottom: 10px;" id="receiver_div">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_receiver')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <?php echo form_dropdown(
                                                    'receiver',
                                                    $employee,
                                                    $get_edit->receiver_id,
                                                    'class="form-control" id="receiver"'
                                                ); ?>
                                            </div>
                                        </div>
                                                       
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_date')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input type="text" id="received_date" class="form-control hasDatepicker" name="on_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $get_edit->delivery_ondate?>" aria-required="true" aria-invalid="false">
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_purpose')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <input class="filter form-control" name="purpose" type="text" value="<?php echo $get_edit->purpose?>" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('delivery_send_by')?>:</label>    
                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                <?php echo form_dropdown(
                                                    'send_by',
                                                    $employee,
                                                    $get_edit->send_by_id,
                                                    'class="form-control" id="sendby"'
                                                ); ?>
                                            </div>
                                        </div>
                                       
                                    <div class="form-group col-sm-12">
                                        <div class="pull-right">
                                            <b><?php echo lang('po_check_result')?>: &nbsp;</b>
                                            <input type="checkbox" name="ch_total" id="ch_total" value="1" /><br>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel')?></a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="Add" id="submit" class="btn btn-primary pull-right">                
                                        </div>
                                    </div>


                                </form> 
                                </div>                                        
                        
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>

<?php echo $this->load->view('items/delivery_note/calculate_delivery')?>
<?php $this->load->view("partial/footer"); ?>