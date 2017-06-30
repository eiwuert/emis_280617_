<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Add Major"; ?>
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
                                    "$controller_name/form_major/-1/",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-success',
                                        'title' => 'Major'
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
                                       	New Major
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="faculty_id" class="col-sm-3 col-md-3 col-lg-2 " aria-required="true">Faculty Name:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select class="filter form-control" name="faculty_id">
                                                            <option value="">គ្រប់គ្រងពាណិជ្ជកម្ម និង ទេសចរណ៍</option>
                                                            <option value="">សិល្បៈ មនុស្សសាស្រ្ត និង ភាសាបរទេស</option>
                                                            <option value="">វិទ្យាសាស្រ្ត និង បច្ចេកវិទ្យា</option>
                                                            <option value="">នីតិសាស្រ្ត និង សេដ្ឋកិច្ច</option>
                                                            <option value="">កសិកម្ម និង អភិវឌ្ឍន៍ជនបទ</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="department_id" class="col-sm-3 col-md-3 col-lg-2 " aria-required="true">Department Name:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select class="filter form-control" name="department_id">
                                                            <option value="">គ្រប់គ្រង</option>
                                                            <option value="">គណនេយ្យ និង ហិរញ្ញវត្ថុ</option>
                                                            <option value="">ធនាគារ និង ហិរញ្ញវត្ថុ</option>
                                                            <option value="">គ្រប់គ្រងម៉ាឃិតធិង</option>
                                                            <option value="">ទេសចរណ៍</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="major" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Major Name:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="major" type="text" value="" />
                                                    </div>
                                                </div>


                        
                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/major")?>">Cancel</a>
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