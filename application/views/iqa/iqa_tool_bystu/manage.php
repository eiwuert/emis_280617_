<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Annual Leader"; ?>
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
                                    "$controller_name/view_employee/",
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
                                    "$controller_name/delete/-1/",
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
       
        <div class="row">

            <div class="form-group col-sm-12 col-xs-12" style="margin-bottom: 10px;">  
                <div class="col-sm-2 col-md-2 col-lg-2 no-padding" style="margin-top:25px">
                    <?php echo form_open("$controller_name/search", array('id' => 'search_form', 'autocomplete' => 'off')); ?>
                    <input type="text" name ='search' id='search' value=""   placeholder="<?php echo lang('common_search'); ?>"/>            
                    </form>
                </div>

                <div class="col-sm-2 col-md-2 col-lg-2 no-padding">
                    <label>From Date</label>
                    <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                        <input type="text" id="start_date" class="form-control hasDatepicker" name="from_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                </div>
   
                <div class="col-sm-2 col-md-2 col-lg-2 no-padding">
                    <label>To Date</label>
                    <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                        <input type="text" id="start_date" class="form-control hasDatepicker" name="to_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                </div>

                <div class="col-sm-4 col-md-4 col-lg-4">
                    <input class="btn btn-success" style="margin-top:25px" type="submit" name="submit" value="Search">
                </div>
            </div>
            <div class="col-xs-12">
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
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Gender</th>    
                                    <th>Total</th> 
                                    <th>Average</th> 
                                    <th>Rang</th> 
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th></th> 
                                </tr>

                                
                            </thead>
                            <tbody>

                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td>ប៉ើ អ៊ូម៉ើត</td>
                                    <td>M</td>                                    
                                    <td>498</td>
                                    <td>80</td>
                                    <td>C+</td>
                                    <td>19/03/2016</td>
                                    <td>31/03/2016</td>
                                    <td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/display")?>" target="_blank">View</a></td>
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
</script>

<?php $this->load->view("partial/footer"); ?>