<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Short Course Management"; ?>
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
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-success',
                                        'title' => 'New'
                                    )
                                );
                            // }
                        ?>
                        
                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/form_diploma/-1/",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-danger',
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
                                    <th>Sc.Code</th>
                                    <th>Sc.Name</th>
                                    <th>Sc.Name(kh)</th>
                                    <th>Sc.University</th>
                                    <th>Degree</th>                                  
                                    <th>Subjects</th>                                  
                                    <th class="rightmost header headerSortDown">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>0036</td>
                                    <td>History of Cambodia Law</td>
                                    <td>ប្រវត្តិនៃច្បាប់កម្ពុជា</td>
                                    <td>Faculty of Law and Economic</td>
                                    <td></td>
                                    <td>
                                        <center><a href="<?php echo site_url("$controller_name/detail")?>" title="detail" class="gray">
                                                <i class="aace-icon fa fa-plus bigger-180"></i>
                                        </a></center>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="<?php echo site_url("$controller_name/detail")?>" title="detail" class="gray">
                                                <i class="aace-icon fa fa-search-plus bigger-180"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>0036</td>
                                    <td>History of Cambodia Law</td>
                                    <td>ប្រវត្តិនៃច្បាប់កម្ពុជា</td>
                                    <td>Faculty of Law and Economic</td>
                                    <td></td>
                                    <td>
                                        <center><a href="<?php echo site_url("$controller_name/detail")?>" title="detail" class="gray">
                                                <i class="aace-icon fa fa-plus bigger-180"></i>
                                        </a></center>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="<?php echo site_url("$controller_name/detail")?>" title="detail" class="gray">
                                                <i class="aace-icon fa fa-search-plus bigger-180"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>0036</td>
                                    <td>History of Cambodia Law</td>
                                    <td>ប្រវត្តិនៃច្បាប់កម្ពុជា</td>
                                    <td>Faculty of Law and Economic</td>
                                    <td></td>
                                    <td>
                                        <center><a href="<?php echo site_url("$controller_name/detail")?>" title="detail" class="gray">
                                                <i class="aace-icon fa fa-plus bigger-180"></i>
                                        </a></center>
                                    </td>
                                    <td class="action-buttons">
                                        <a href="<?php echo site_url("$controller_name/detail")?>" title="detail" class="gray">
                                                <i class="aace-icon fa fa-search-plus bigger-180"></i>
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