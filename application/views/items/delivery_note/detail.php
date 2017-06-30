<?php $this->load->view("partial/header"); ?>

<script type="text/javascript">
    $(document).ready(function (){
        // var table_columns = ["","id","received_date","send_from","orginazation","purpose","received_by"];
        // enable_sorting("<?php echo site_url("$controller_name/sorting"); ?>", table_columns, <?php echo $per_page; ?>, <?php echo json_encode($order_col); ?>, <?php echo json_encode($order_dir); ?>);
        // enable_select_all();
        // enable_checkboxes();
        // enable_row_selection();
        // enable_search('<?php echo site_url("$controller_name/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        // enable_delete(<?php echo json_encode(lang($controller_name . "_confirm_delete")); ?>,<?php echo json_encode(lang($controller_name . "_none_selected")); ?>);
      
    });
</script>


<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Delivery Note"; ?>
    </h1>
</div>

    <div class="page-content">

        <div class=" pull-right">
            <div class="row">
                <div class="col-md-12 center" style="text-align: center;">                  
                    <div class=" ">                        
                        
                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/view/-1/",
                                    '<i class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-success',
                                        'title' => 'Course Form'
                                    )
                                );
                            // }
                        ?>
                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/form/-1/",
                                    '<i class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'Delete' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-danger',
                                        'title' => 'Delete'
                                    )
                                );
                            // }
                        ?>
                        

                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <?php echo form_open("$controller_name/search", array('id' => 'search_form', 'autocomplete' => 'off')); ?>
            <input type="text" name ='search' id='search' value=""   placeholder="<?php echo lang('common_search'); ?>"/>
            </form>
        </div>
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                    <!-- <div class="widget-content nopadding table_holder table-responsive" > -->
                        <?php // echo $manage_table; ?>         
                    <!-- </div>      -->

                    <div class="widget-content nopadding table_holder table-responsive">
                        <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                            <thead>
                                <tr>
                                    <th class="leftmost">
                                        <input type="checkbox" id="select_all">
                                    </th>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Item Name kh</th>
                                    <th>Date Out</th> 
                                    <th>Total Item</th> 
                                    <th>Amount Dollar</th> 
                                    <th>Amount Riel</th> 
                                    <th>Amount Baht</th> 
                                    <th>Expenses</th>                                                                
                                    <th class="rightmost header headerSortDown">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    
                                    <td>12</td>                                    
                                    <td>Pen</td>                                    
                                    <td>ប៊ិច</td>                                    
                                    <td>12-03-2016</td>                                
                                    <td>5</td>
                                    <td>$ 2.5</td>
                                    <td>R 9999.75</td>
                                    <td>B 87.28</td>
                                    <td>class</td>    
                                    <td class="action-buttons">
                                        <a href="<?=site_url("$controller_name/view")?>" title="view" class="gray">
                                                <i class="ace-icon fa fa-search-plus bigger-180"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>
                                    </td>

                                </tr>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    
                                    <td>14</td>                                    
                                    <td>Pencil</td>                                    
                                    <td>ខ្មៅដៃ</td>                                    
                                    <td>12-03-2016</td>                                
                                    <td>5</td>
                                    <td>$ 2.5</td>
                                    <td>R 9999.75</td>
                                    <td>B 87.28</td>
                                    <td>class</td> 
                                    <td class="action-buttons">
                                        <a href="<?=site_url("$controller_name/view")?>" title="view" class="gray">
                                                <i class="ace-icon fa fa-search-plus bigger-180"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>            
                    </div>
                    
                    <?php if ($pagination) { ?>
                        <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                            <?php echo $pagination; ?>
                        </div>
                    <?php } ?>
                    <!-- End -->


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