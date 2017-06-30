<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Add Student Information"; ?>
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
                                    "$controller_name/form_student_info/-1/",
                                    '<i title="' . 'Student Information' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-success',
                                        'title' => 'Student Information'
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
                                       	New Scholarship
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">

                                				

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="username" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">គោត្តនាម-នាម:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="username" type="text" value="" />
                                                    </div>

                                                    <label for="username" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Username(en):</label>  
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="username" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="gender" class="col-sm-3 col-md-3 col-lg-2 " aria-required="true">ភេទ:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <select class="filter form-control" name="gender">
                                                            <option value="">ប្រុស</option>
                                                            <option value="">ស្រី</option>
                                                        </select>
                                                    </div>

                                                    <label for="gender_en" class="col-sm-3 col-md-3 col-lg-2 " aria-required="true">Gender(en):</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <select class="filter form-control" name="gender_en">
                                                            <option value="">Male</option>
                                                            <option value="">Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="date_of_birth" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Date of Birth:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="date_of_birth" type="date" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="place_of_birth_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">ទីកន្លែងកំណើត:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <textarea class="filter form-control" name="place_of_birth_kh"></textarea>
                                                    </div>

                                                    <label for="place_of_birth_en" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Place of Birth(en):</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <textarea class="filter form-control" name="place_of_birth_en"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="nationality_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">សញ្ជាតិ:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="nationality_kh" type="text" value="" />
                                                    </div>

                                                    <label for="nationality_en" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Nationality(en):</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="nationality_en" type="text" value="" />
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="father_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">ឈ្មោះឪពុក:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="father_kh" type="text" value="" />
                                                    </div>

                                                    <label for="father_en" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Father:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="father_en" type="text" value="" />
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="father_job_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">មុខរបរ:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="father_job_kh" type="text" value="" />
                                                    </div>

                                                    <label for="father_job_en" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Father Job:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="father_job_en" type="text" value="" />
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="mother_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">ឈ្មោះម្តាយ:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="mother_kh" type="text" value="" />
                                                    </div>

                                                    <label for="mother_en" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Mother:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="mother_en" type="text" value="" />
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="mother_job_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">មុខរបរ:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="mother_job_kh" type="text" value="" />
                                                    </div>

                                                    <label for="mother_job_en" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Mother Job:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="mother_job_en" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="address_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">អាសយដ្ឋានបច្ចុប្បន្ន:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <textarea class="filter form-control" name="address_kh"></textarea>
                                                    </div>

                                                    <label for="address_en" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Address:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <textarea class="filter form-control" name="address_en"></textarea>
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="age" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Age:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="age" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="phone" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Phone:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="phone" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="email" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Email:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="email" type="email" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="id_card" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">id_card: (អត្តសញ្ញាណប័ណ្ណ)</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="id_card" type="text" value="" />
                                                    </div>
                                                </div>



                        
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