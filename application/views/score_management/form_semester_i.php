<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-clipboard"></i>
        <?php echo "Score Management (Semester I)"; ?>
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
                                    "$controller_name/form_semester_i/-1/",
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
                                       	New From Semester I
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="year" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Year:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select name="year" id="year" class="filter form-control">
                                                            <option value="yi">Year I</option>
                                                            <option value="yii">Year II</option>
                                                            <option value="yiii">Year III</option>
                                                            <option value="yiv">Year IV</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="studen_id" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Studen ID:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select name="studen_id" id="studen_id" class="filter form-control">
                                                            <option value=""></option>
                                                            <option value="stu_1">Name 1</option>
                                                            <option value="stu_2">Name 2</option>
                                                            <option value="stu_3">Name 3</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="department_id" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Department ID:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <select name="department_id" id="department_id" class="filter form-control">
                                                            <option value=""></option>
                                                            <option value="D_1">Marketing</option>
                                                            <option value="D_2">Rule</option>
                                                            <option value="D_3">Information Technology</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                                       

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="other" class="col-sm-3 col-md-3 col-lg-2 " aria-required="true">Other:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <textarea name="other" id="other" class="filter form-control"></textarea> 
                                                    </div>
                                                </div>

                        
                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/semester_i")?>">Cancel</a>
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
    $(function(){
        $('#year').change(function(){
            var y = $(this).val();
            if(y == 'yi'){

                $('.label_subj_1').text('Information to Business:');
                $('.label_subj_2').text('Business Math:');
                $('.label_subj_3').text('Public & Office Administration:');
                $('.label_subj_4').text('Contract Law:');
                $('.label_subj_5').text('Computer Administration:');
                $('.label_subj_6').text('Business English:');

            }else if(y == 'yii'){

                $('.label_subj_1').text('Subject Field01:');
                $('.label_subj_2').text('Subject Field02:');
                $('.label_subj_3').text('Subject Field03:');
                $('.label_subj_4').text('Subject Field04:');
                $('.label_subj_5').text('Subject Field05:');
                $('.label_subj_6').text('Subject Field06:');

            }else if(y == 'yiii'){

                $('.label_subj_1').text('Subject Field011:');
                $('.label_subj_2').text('Subject Field012:');
                $('.label_subj_3').text('Subject Field013:');
                $('.label_subj_4').text('Subject Field014:');
                $('.label_subj_5').text('Subject Field015:');
                $('.label_subj_6').text('Subject Field016:');

            }else if(y == 'yiv'){

                $('.label_subj_1').text('Subject Field0111:');
                $('.label_subj_2').text('Subject Field0112:');
                $('.label_subj_3').text('Subject Field0113:');
                $('.label_subj_4').text('Subject Field0114:');
                $('.label_subj_5').text('Subject Field0115:');
                $('.label_subj_6').text('Subject Field0116:');

            }

        });
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

