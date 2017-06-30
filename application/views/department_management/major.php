<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Major"; ?>
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
                                    "$controller_name/college/-1/",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'College' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-primary',
                                        'title' => 'College'
                                    )
                                );
                            // }
                        ?>
                        
                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/department/-1/",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'Department' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-primary',
                                        'title' => 'Department'
                                    )
                                );
                            // }
                        ?>
                        
                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/major/-1/",
                                    '<i title="' . 'Major' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'Major' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-primary',
                                        'title' => 'Major'
                                    )
                                );
                            // }
                        ?>
                        
                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/form_major/-1/",
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
                                    <th>Faculty ID (name)</th>
                                    <th>Department ID (name)</th>
                                    <th>Major Name</th>
                                    <th class="rightmost header headerSortDown">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td>1.គ្រប់គ្រងពាណិជ្ជកម្ម និង ទេសចរណ៍</td>
                                    <td>1.គណនេយ្យ និង ហិរញ្ញវត្ថុ</td>
                                    <td>គ្រប់គ្រងទូទៅ</td>
                                    <td class="action-buttons">
                                        <a href="#" title="view" class="gray">
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
                                    <td>1.គ្រប់គ្រងពាណិជ្ជកម្ម និង ទេសចរណ៍</td>
                                    <td>1.គណនេយ្យ និង ហិរញ្ញវត្ថុ</td>
                                    <td>គ្រប់គ្រង ធនធានមនុស្ស</td>
                                    <td class="action-buttons">
                                        <a href="#" title="view" class="gray">
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
                                    <td>3</td>
                                    <td>1.គ្រប់គ្រងពាណិជ្ជកម្ម និង ទេសចរណ៍</td>
                                    <td>1.គណនេយ្យ និង ហិរញ្ញវត្ថុ</td>
                                    <td>គ្រប់គ្រងគម្រោង</td>
                                    <td class="action-buttons">
                                        <a href="#" title="view" class="gray">
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
                                    <td>4</td>
                                    <td>2.សិល្បៈ មនុស្សសាស្រ្ត និង ភាសាបរទេស</td>
                                    <td>1.ភាសាអង់គ្លេស</td>
                                    <td>ភាសាអង់គ្លេស សម្រាប់អប់រំ</td>
                                    <td class="action-buttons">
                                        <a href="#" title="view" class="gray">
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