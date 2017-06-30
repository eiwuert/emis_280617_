<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function ()
    {
        var table_columns = ["","item_unique_id",'item_name','item_name_kh','category_id','model','unit_price','','','','','','','',''];
        enable_sorting("<?php echo site_url("items_report/sorting"); ?>", table_columns, <?php echo $per_page; ?>, <?php echo json_encode($order_col); ?>, <?php echo json_encode($order_dir); ?>);
        enable_select_all();
        enable_checkboxes();
        enable_row_selection();
        enable_search('<?php echo site_url("items_report/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_delete(<?php echo json_encode(lang("items_report_confirm_delete")); ?>,<?php echo json_encode(lang("items_report_none_selected")); ?>);
    });
</script>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'><?php echo create_breadcrumb(); ?></div> 
    <div class="page-header" id='page-header'>
        <h1> <i class="icon fa fa-list"></i> <?php echo lang('module_items_report'); ?></h1>
    </div>    
    <div class="page-content"> 
        <?php echo form_open("$controller_name/search_report"); ?>   
        <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('common_search'); ?></h3>
                    <div class="clearboth"></div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                    <div class="row col-xs-12">
                        
                        <div class="col-xs-12 col-sm-4 col-lg-4">
                            <div class="form-group field-stuinfo-date_from required">
                                <label class="control-label" for="date_from"><?php echo lang('common_from'); ?></label>
                                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                    <input type="text" id="date_from" class="form-control hasDatepicker" name="date_from" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo ($dateFrom)? $dateFrom: ''?>">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                                <div class="help-block"></div>
                            </div>   
                        </div>

                        <div class="col-xs-12 col-sm-4 col-lg-4">
                            <div class="form-group field-stuinfo-date_to required">
                                <label class="control-label" for="date_to"><?php echo lang('common_to'); ?></label>
                                <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                    <input type="text" id="date_to" class="form-control hasDatepicker" name="date_to" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo ($dateTo)? $dateTo: ''?>">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                                <div class="help-block"></div>
                            </div>   
                        </div>

                        <div class="col-xs-12 col-sm-4 col-lg-4">
                            <div class="form-group field-stuinfo-date_to required">
                                <label class="control-label" for="date_to"><?php echo lang('common_selection_type'); ?></label>
                                <?php echo form_dropdown('selection_type',$selection_type,'','class="form-control"')?>
                            </div>   
                        </div>

                    </div>
                </div>
                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                    <div class="row col-xs-12">
                        <a href="<?php echo site_url("items_report/clear_state")?>" style="margin-left:15px" class="btn btn-active pull-left">Clear</a> 
                        <input type="submit" name="submit" value="Search" style="margin-left:15px" id="submit" class="btn btn-primary"> 
                        <input type="submit" name="submit" value="Print" style="margin-left:15px" id="submit" class="btn btn-primary"> 
                    </div>
                </div>
        </div>
        <?php echo form_close();?>
        <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    
                    <div class="widget-content nopadding table_holder table-responsive" >
                        <div class="box-header with-border">
                            <h3 class="box-title" style="text-transform: capitalize;"><i class="fa fa-search"></i> <?php echo $mainTitle?></h3>
                        </div>
                        <br>  
                        <?php echo $manage_table; ?>
                    </div>
                    <?php if ($pagination) { ?>
                        <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                            <?php echo $pagination; ?>
                        </div>
                    <?php } ?>
                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        initDatePicker("input[name='date_from']");
        initDatePicker("input[name='date_to']");

        $('.ui-autocomplete').css('overflow','auto');
        $('.ui-autocomplete').css('overflow-x','hidden');
        $('.ui-autocomplete').css('max-height','400px');
    })
</script>
<?php $this->load->view("partial/footer"); ?>