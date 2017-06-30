<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Scholarship"; ?>
    </h1>
</div>

    <div class="page-content">

        <div class=" pull-right">
            <div class="row">
                <div class="col-md-12 center" style="text-align: center;">                  
                    <div class=" ">
                        
                        
                        
                        
                        

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

                    
                    <section class="content" style="min-height: 543px;">
                            <div class="col-xs-12">
                                    <div class="col-lg-4 col-sm-4 col-xs-12 no-padding">
                                            <h3 class="box-title"><i class="fa fa-search"></i></h3>
                                    </div>
                                    <div class="col-lg-5 col-sm-5 col-xs-12"></div>
                                    <div class="col-lg-3 col-sm-3 col-xs-12" style="padding-top: 20px !important">

                                        
                                        <?php 
                                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                                echo anchor(
                                                    "$controller_name/#/-1/",
                                                    '<i title="' . 'Delete scholarship' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'Delete' . '</span>',
                                                    array(
                                                        'id' => 'new-person-btn',
                                                        'class' => ' pull-right btn btn-block​ btn-danger',
                                                        'title' => 'Delete scholarship'
                                                    )
                                                );
                                            // }
                                        ?>

                                        <?php 
                                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                                echo anchor(
                                                    "$controller_name/#/-1/",
                                                    '<i title="' . 'update scholarship' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'Update' . '</span>',
                                                    array(
                                                        'id' => 'new-person-btn',
                                                        'class' => ' pull-right btn btn-block​ btn-info',
                                                        'title' => 'Update scholarship'
                                                    )
                                                );
                                            // }
                                        ?>

                                        <?php 
                                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                                echo anchor(
                                                    "$controller_name/form_student_info/-1/",
                                                    '<i title="' . 'Student Information' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                                    array(
                                                        'id' => 'new-person-btn',
                                                        'class' => ' pull-right btn btn-block​ btn-success',
                                                        'title' => 'Student Information'
                                                    )
                                                );
                                            // }
                                        ?>
                                       
                                        
                                    </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="box box-primary view-item">
                                    <div class="stu-status-view">
                                        <table class="table  detail-view">
                                            <tbody>
                                            <tr>
                                                <th>គោត្តនាម-នាម</th>
                                                <td>កែវ</td>
                                            </tr>
                                            <tr>
                                                <th>Username:</th>
                                                <td>keo</td>
                                            </tr>
                                            <tr>
                                                <th>ភេទ</th>
                                                <td>ប្រុស</td>
                                            </tr>
                                            <tr>
                                                <th>Gender:</th>
                                                <td>Male</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth:</th>
                                                <td>12-12-2015</td>
                                            </tr>
                                            <tr>
                                                <th>ទីកន្លែងកំណើត:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>សញ្ជាតិ:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Nationality:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>ឈ្មោះឪពុក:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Father:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>មុខរបរ:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Father Job:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>ឈ្មោះម្តាយ:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Mother:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>មុខរបរ:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>អាសយដ្ឋានបច្ចុប្បន្ន:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Address:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Age:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Phone:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>Email:</th>
                                                <td>------</td>
                                            </tr>
                                            <tr>
                                                <th>id_card: (អត្តសញ្ញាណប័ណ្ណ):</th>
                                                <td>------</td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                    </section>


                    
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