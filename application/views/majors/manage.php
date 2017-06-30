<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function ()
    {
        var table_columns = ["","item_id","item_unique_id",'item_name','category_id','model','unit_price','quantity'];
        enable_sorting("<?php echo site_url("$controller_name/sorting"); ?>", table_columns, <?php echo $per_page; ?>, <?php echo json_encode($order_col); ?>, <?php echo json_encode($order_dir); ?>);
        enable_select_all();
        enable_checkboxes();
        enable_row_selection();
        enable_search('<?php echo site_url("$controller_name/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_delete(<?php echo json_encode(lang($controller_name . "_confirm_delete")); ?>,<?php echo json_encode(lang($controller_name . "_none_selected")); ?>);

    });
</script>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> <i class="icon fa fa-list"></i>
        <?php echo lang('module_' . $controller_name); ?></h1>
</div>

    <div class="page-content">

        <div class=" pull-right">
            <div class="row">
                <div class="col-md-12 center" style="text-align: center;">					
                    <div class=" ">
                        <?php 
                            //if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                            <?php
                                echo anchor("$controller_name/view/-1/", '<i title="' . lang($controller_name . '_new') . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang($controller_name . '_new') . '</span>', array('id' => 'new-person-btn', 'class' => 'btn btn-success', 'title' => $this->lang->line($controller_name . '_new')));
                            //}
                        ?>

                        <?php //if ($this->Employee->has_module_action_permission($controller_name, 'delete', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                            <?php
                            echo anchor("$controller_name/delete", '<i title="' . lang('common_delete') . '" class="fa fa-trash-o tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang('common_delete') . '</span>'
                                    , array('id' => 'delete', 'class' => 'btn btn-danger disabled delete_inactive ', 'title' => $this->lang->line("common_delete")));
                            ?>
                        <?php //} ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <?php echo form_open("$controller_name/search", array('id' => 'search_form', 'autocomplete' => 'off')); ?>
                <input type="text" name ='search' id='search' value="<?php echo H($search); ?>"   placeholder="<?php echo lang('common_search'); ?> <?php echo lang('module_' . $controller_name); ?>"/>
                <?php //echo form_dropdown('category', $categories, $category, 'id="category"'); ?>
                <?php //echo form_submit('submitf', lang('common_search'),'class="btn btn-primary btn-sm"'); ?>
            <?php echo form_close(); ?>
        </div>
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="widget-title">
                        <h5>   <i class="fa fa-th"></i> <?php echo lang('common_list_of') . ' ' . lang('module_' . $controller_name); ?></h5>
                        <span title="<?php echo $total_rows; ?> total <?php echo lang($controller_name); ?>" class="label label-info tip-left"><?php echo $total_rows; ?></span>
                        <a href="<?php echo site_url($controller_name.'/clear_state'); ?>" class="clear-state pull-right"><?php echo lang('common_clear_search'); ?></a>
                    </div>
                    <div class="widget-content nopadding table_holder table-responsive" >
                        <?php //echo $manage_table; ?>

                        <table class="table tablesorter table-bordered table-striped table-hover" id="sortable_table">
                            <thead><tr><th class="leftmost"><input type="checkbox" id="select_all"></th><th>Course Name</th><th>Course Code</th><th class="header headerSortUp">Status</th><th class="rightmost">Action</th></tr></thead>
                            <tbody>
                                <tr><td width="3%"><input type="checkbox" id="item_4" value="4"></td><td width="10%">4</td><td width="13%">000002</td><td width="9%" align="right">S$11.00</td><td width="4%" class="rightmost"><a href="http://localhost/emis/items/view/4/2  " class="" title="Update Item">Edit</a></td></tr>
                                <tr><td width="3%"><input type="checkbox" id="item_4" value="4"></td><td width="10%">4</td><td width="13%">000002</td><td width="9%" align="right">S$11.00</td><td width="4%" class="rightmost"><a href="http://localhost/emis/items/view/4/2  " class="" title="Update Item">Edit</a></td></tr>
                                <tr><td width="3%"><input type="checkbox" id="item_4" value="4"></td><td width="10%">4</td><td width="13%">000002</td><td width="9%" align="right">S$11.00</td><td width="4%" class="rightmost"><a href="http://localhost/emis/items/view/4/2  " class="" title="Update Item">Edit</a></td></tr>
                                <tr><td width="3%"><input type="checkbox" id="item_4" value="4"></td><td width="10%">4</td><td width="13%">000002</td><td width="9%" align="right">S$11.00</td><td width="4%" class="rightmost"><a href="http://localhost/emis/items/view/4/2  " class="" title="Update Item">Edit</a></td></tr>
                            </tbody>
                        </table>
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
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<?php $this->load->view("partial/footer"); ?>