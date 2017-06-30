<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function ()
    {
        enable_select_all();
        enable_checkboxes();
        enable_delete(<?php echo json_encode(lang($controller_name . "_confirm_delete")); ?>,<?php echo json_encode(lang($controller_name . "_none_selected")); ?>);
        enable_cleanup(<?php echo json_encode(lang($controller_name . "_confirm_cleanup")); ?>);
        $('#new-person-btn, .update-person').click(function ()
        {
            $("body").mask(<?php echo json_encode(lang('common_wait')); ?>);
        });
    });
</script>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> <i class="icon fa fa-<?php echo $controller_name == "customers" ? "group" : "user"; ?>"></i>
                <?php echo lang('module_' . $controller_name); ?></h1>
</div>

    <div class="page-content">

        <div class=" pull-right">
            <div class="row">
                <div class="col-md-12 center" style="text-align: center;">					
                    <div class=" ">
                        <?php if ($this->Employee->has_module_action_permission($controller_name, 'delete', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                            <?php
                            echo anchor("$controller_name/delete_soft_file", '<i title="' . lang('common_delete') . '" class="fa fa-trash-o tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang('common_delete') . '</span>'
                                    , array('id' => 'delete', 'class' => 'btn btn-danger delete_inactive ', 'title' => $this->lang->line("common_delete")));
                            ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
           
        </div>
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="widget-title">
                        <h5><i class="fa fa-th"></i> <?php echo lang('common_list_of') . ' ' . lang('module_' . $controller_name); ?></h5>
                        <span title="<?php echo $total_rows; ?> total <?php echo lang($controller_name); ?>" class="label label-info tip-left"><?php echo $total_rows; ?></span>
                    </div>
                    <div class="widget-content nopadding table_holder table-responsive" >
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
<?php $this->load->view("partial/footer"); ?>