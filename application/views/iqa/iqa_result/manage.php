<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var table_columns = ['', 'evaluate_date', 'date_from', 'date_to'];
        enable_sorting('<?php echo site_url("$controller_name/sorting"); ?>', table_columns, <?php echo $per_page; ?>, <?php echo json_encode($order_col); ?>, <?php echo json_encode($order_dir); ?>);
        enable_select_all();
        enable_checkboxes();
        enable_row_selection();
        enable_search('<?php echo site_url("$controller_name/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        // enable_delete(<?php echo json_encode(lang($controller_name . "_confirm_delete")); ?>,<?php echo json_encode(lang($controller_name . "_none_selected")); ?>);
    });
</script>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div>

    <div class="page-header" id='page-header'>
        <h1><i class="icon fa fa-list"></i><?php echo "IQA"; ?></h1>
    </div>

    <div class="view-item col-xs-12 col-lg-12">
    <div class="box box-solid box-info col-xs-12 col-lg-12">
        <div class="box-header with-border col-xs-12">
            <h4 class="box-title"><i class="fa fa-info-circle"></i> Personal Details</h4>
        </div>
        <div class="box-body col-xs-12">
            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                <?php echo form_open("$controller_name/search", array('id' => 'search_form', 'autocomplete' => 'off')); ?>
                <div class="col-xs-3 col-sm-3">
                    <div class="field-stuinfo-stu_unique_id required" aria-required="true">
                        <label class="control-label" for="iqa">Search</label>
                        <input type="text" name ='search' id='search' class="form-control" value="" placeholder="<?php echo lang('common_search'); ?>" />
                    </div>    
                </div>  

                <div class="col-xs-3 col-sm-3">
                    <div class="field-stuinfo-stu_unique_id required" aria-required="true">
                        <label class="control-label" for="iqa">IQA</label>
                        <?php echo form_dropdown('select_iqa', $iqa_types, '', 'class="form-control"'); ?>
                    </div>    
                </div>            

                <div class="col-xs-3 col-sm-3">
                    <div class="field-stuinfo-stu_unique_id required" aria-required="true">
                        <label class="control-label" for="from_date">From Date</label>
                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                            <input type="text" id="start_date" class="form-control hasDatepicker" name="from_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="" >
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>    
                </div>  

                <div class="col-xs-3 col-sm-3">
                    <div class="field-stuinfo-stu_unique_id required" aria-required="true">
                        <label class="control-label" for="to_date">To Date</label>
                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                            <input type="text" id="start_date" class="form-control hasDatepicker" name="to_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>    
                </div>
                <div class="col-xs-12 col-sm-12">
                    <div class="field-stuinfo-stu_unique_id pull-right" aria-required="true">
                        <label class="control-label" for="iqa">&nbsp;</label>
                        <input class="btn btn-success" style="margin-top:25px" type="submit" name="submit" value="Search">
                    </div>  
                </div>           
                <?php echo form_close(); ?>
            </div>
        </div>
        <!---./end box-body-->
    </div>
    </div>
    <?php echo form_open("$controller_name/print_iqa", array('id' => 'iqa_form')); ?>
        <div class="col-xs-12 col-sm-12">
            <input class="btn btn-success pull-right" type="submit" name="print" value="Print"/>
            <?php echo form_hidden('selection_iqa_result')?>
        </div>
    </form>    
    <div class="col-xs-12">
        <div class="widget-box" id="widgets">
            <div class="widget-title">
                <h5> <i class="fa fa-th"></i> <?php echo lang('common_list_of') . ' ' . lang('module_' . $controller_name); ?></h5>
                <span title="<?php echo $total_rows; ?> total <?php echo lang($controller_name); ?>" class="label label-info tip-left"><?php echo $total_rows; ?></span>
                <a href="<?php echo site_url($controller_name.'/clear_state'); ?>" class="clear-state pull-right"><?php echo lang('common_clear_search'); ?></a>
            </div>

            <!-- Start -->
            <div class="widget-content nopadding table_holder table-responsive" >
                <?php echo $manage_table; ?>
            </div>
            
            <?php if ($pagination) { ?>
                <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                    <?php echo $pagination; ?>
                </div>
            <?php } ?>
            <!-- End -->

        </div> 
    </div> 
</div>
<script type="text/javascript">
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }

    $(document).ready(function()
    {
        initDatePicker("input[name='from_date']");
        initDatePicker("input[name='to_date']");  

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
}
</script>
<script type="text/javascript">
    $(function(){
        $("#iqa_form").submit(function(){
            var row_ids = get_selected_values();
            $("input[name=selection_iqa_result]").val(row_ids);                                           
        });
    });
</script>

<?php $this->load->view("partial/footer"); ?>