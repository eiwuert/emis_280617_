<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-clipboard"></i>
        <?php echo "Form Add Student"; ?>
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
                                    "$controller_name/form/-1/",
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
                                       	New Form Stuent
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">




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
                                                    <label for="level_diploma" class="col-sm-3 col-md-3 col-lg-2 " aria-required="true">Level Diploma:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select class="filter form-control" name="level_diploma">
                                                            <option value="">កម្រិតបណ្ឌិត</option>
                                                            <option value="">កម្រិតអនុបណ្ឌិត</option>
                                                            <option value="">កម្រិតបរិញ្ញាបត្រ</option>
                                                            <option value="">កម្រិតបរិញ្ញាបត្ររង</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="student_info_id" class="col-sm-3 col-md-3 col-lg-2 " aria-required="true">Student Information:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select class="filter form-control" name="student_info_id">
                                                            <option value="">keo</option>
                                                            <option value="">Sok chan</option>
                                                            <option value="">chhing</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="card_id" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Card ID:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="card_id" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="year" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Year:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="year" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="generatiion" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Generation:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="generatiion" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="room" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Room:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="room" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="table" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Table:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="table" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div> 

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="fee" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Fee:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="fee" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div>                                   

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="scholarship" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Scholarship:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select name="scholarship" class="filter form-control">
                                                            <option value="male">អគ្គមហាសេនាបតី តេជោហ៊ុនសែន</option>
                                                            <option value="female">ក្រសួងអប់រំ អយក</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="certificate_id" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Certificate ID:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="certificate_id" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div>  

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="student_status" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Student Status:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="student_status" type="text" value="" placeholder=''/>
                                                    </div>
                                                </div>  





                                            <!--  -->
                        
                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
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