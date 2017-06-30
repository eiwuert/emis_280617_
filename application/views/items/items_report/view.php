<?php $this->load->view("partial/header"); ?>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
    <h1> <i class="icon fa fa-list"></i>
        <?php echo lang('module_items_report'); ?></h1>
</div>
    <div class="page-content">
        
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="widget-title">
                        <h5><i class="fa fa-th"></i> <?php echo lang('common_list_of') . ' ' . lang('module_items_report'); ?></h5>
                        <span title="<?php echo $total_rows; ?> total <?php echo lang(items_report); ?>" class="label label-info tip-left"><?php echo $total_rows; ?></span>                        
                    </div>
                    <div class="widget-content nopadding table_holder table-responsive" >
                        <table class="table tablesorter table-bordered table-striped table-hover">
                            <tr>
                                <th>Items Process</th>
                                <th>ALL QTY</th>
                                <th>Total Dollar</th>
                                <th>Total Riel</th>
                                <th>Total Baht</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>Product Order</td>
                                <td><?php echo $po['p_qty']?></td>
                                <td><?php echo $po['p_dollar']?></td>
                                <td><?php echo $po['p_riel']?></td>
                                <td><?php echo $po['p_baht']?></td>
                            </tr>
                            <tr style="color:blue">
                                <td>Product Order Discount $</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Delivery</td>
                                <td><?php echo $cost_delivery['qty']?></td>
                                <td><?php echo $cost_delivery['dollar']?></td>
                                <td><?php echo $cost_delivery['riel']?></td>
                                <td><?php echo $cost_delivery['baht']?></td>
                            </tr>  
                            <tr style="color:blue">
                                <td>Product Order Discount $</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr> 
                            <tr style="color:red">
                                <td>Current Stock</td>
                                <td><?php echo $current_qty?></td>
                                <td><?php echo $current_dollar?></td>
                                <td><?php echo $current_riel?></td>
                                <td><?php echo $current_baht?></td>
                            </tr>
                            <tr>
                                <td>Profit</td>
                                <td></td>
                                <td><?php echo $profit_dollar?></td>
                                <td><?php echo $profit_riel?></td>
                                <td><?php echo $profit_baht?></td>
                            </tr>
                        </table>
                    </div>                    
                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<?php $this->load->view("partial/footer"); ?>