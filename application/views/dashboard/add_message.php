<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-envelope"></i>
        <?php echo "Message"; ?>
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
                                    "$controller_name/create_message/-1/",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-success',
                                        'title' => 'New'
                                    )
                                );
                            // }
                        ?>

                        <?php //if ($this->Employee->has_module_action_permission($controller_name, 'delete', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                            <?php
                                echo anchor(
                                    "$controller_name/delete",
                                    '<i title="' . lang('common_delete') . '" class="fa fa-trash-o tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang('common_delete') . '</span>',
                                    array(
                                        'id' => 'delete',
                                        'class' =>'btn btn-danger disabled delete_inactive ',
                                        'title' => $this->lang->line("common_delete")
                                    )
                                );
                            ?>
                        <?php //} ?>

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
                        <div class="col-xs-12">
                        Fields in red are required    <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h5 class="widget-title">
                                        <span class="icon">
                                            <i class="fa fa-align-justify"></i>                                 
                                        </span>
                                       	New Messages
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="detail_notice" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Detail:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <textarea name="detail_notice" id="detail_notice" class="filter form-control"></textarea> 
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="user_type" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">User Type:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select name="user_type" id="user_type" class="filter form-control">
                                                            <option>Student</option>
                                                            <option>Employee</option>
                                                            <option>General</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="user_type" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">User Type:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <div class="checkbox">
                                                                <label>
                                                                    <input type="radio" id="msgofday-is_status" name="MsgOfDay[is_status]" value="1">
                                                                    <b>&nbsp;Active</b>
                                                                </label>
                                                                <label>
                                                                    <input type="radio" id="msgofday-is_status" name="MsgOfDay[is_status]" value="2">
                                                                    <b>&nbsp;Suspend</b>
                                                                </label>
                                                                <p class="help-block help-block-error"></p>
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/message")?>">Cancel</a>
                                                    </div>
                                                    <div>
                                                        <input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary pull-right">                
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
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<?php $this->load->view("partial/footer"); ?>