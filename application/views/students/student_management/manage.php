<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-user"></i>
        <?php echo "Student Management"; ?>
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
                                    <th>Department ID</th>
                                    <th>Diploma level ID</th>
                                    <th>Stu ID</th>
                                    <th>Studen Info ID</th>
                                    <th>Year</th>
                                    <th>Generation</th>
                                    <th>Room</th>
                                    <th>Table</th>
                                    <th>Fee</th>
                                    <th>Scholarship ID</th>
                                    <th>Certificate ID</th>
                                    <th>Studen Status</th>

                                    <th class="rightmost header headerSortDown">Action</th>
                                </tr>
                                
                            </thead>
                            <tbody>

                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td>dep_098 (គ្រប់គ្រងពាណិជ្ជកម្ម និង ទេសចរណ៍)</td>
                                    <td>di_008(កម្រិតបរិញ្ញាបត្រ)</td>
                                    <td>stu001_(sok)</td>
                                    <td>Mr.Keo</td>
                                    <td>2</td>
                                    <td>51</td>                                    
                                    <td></td>  
                                    <td></td> 
                                    <td>250$</td>                                  
                                    <td>0003</td>                                  
                                    <td>កម្រិតបរិញ្ញាបត្ររង (001)</td>                                  
                                    <td>Stu.Status</td>                                  
                                    <td class="action-buttons">
                                        <a href="<?=site_url("$controller_name/view")?>" title="view" class="gray">
                                                <i class="ace-icon fa fa-list bigger-150"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>


                                        <a href="#" title="delete" class="red">
                                                <i class="ace-icon fa fa-trash bigger-150"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>2</td>
                                    <td>dep_098 (គ្រប់គ្រងពាណិជ្ជកម្ម និង ទេសចរណ៍)</td>
                                    <td>di_008(កម្រិតបរិញ្ញាបត្រ)</td>
                                    <td>stu001_(sok)</td>
                                    <td>Mr.Keo</td>
                                    <td>2</td>
                                    <td>51</td>                                    
                                    <td></td>  
                                    <td></td> 
                                    <td>250$</td>                                  
                                    <td>0003</td>                                  
                                    <td>កម្រិតបរិញ្ញាបត្ររង (001)</td>                                  
                                    <td>Stu.Status</td>                                  
                                    <td class="action-buttons">
                                        <a href="<?=site_url("$controller_name/view")?>" title="view" class="gray">
                                                <i class="ace-icon fa fa-list bigger-150"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>


                                        <a href="#" title="delete" class="red">
                                                <i class="ace-icon fa fa-trash bigger-150"></i>
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

                     <code>
                        *** Note:<br>
                        - add new <br>
                        - icon view
                    </code>



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