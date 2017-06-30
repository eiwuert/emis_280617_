<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
      <i class="ace-icon fa fa-search-plus bigger-100"></i>
        <?php echo "School Fee Payment"; ?>
    </h1>
</div>

    <div class="page-content">

        
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
                                        School Fee Payment
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 ">Student:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <input class="filter form-control" name="fee_student" type="text" value="" placeholder='Please type student name' />
                                                    </div>
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 ">Course Detail:</label>    
                                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                                        <?php echo form_dropdown('fee_course', $course,'', 'class="form-control"'); ?>
                                                    </div>
                                                </div>


                                                <!--  -->
                                                <div class="box-header with-border" style="background:#00c0ef;padding: 1px 10px 1px 10px;color: #fff;margin-right: 10px;">
                                                    <h4 class="box-title"><i class="fa fa-info-circle"></i> Student Info.</h4>
                                                    <div class="clearboth"></div>
                                                </div>
                                                <!--  -->


                                                <table class="table">
                                                    <tr>
                                                        <td><label><b>Student Name:</b></label></td>
                                                        <td> Hem ChingChing </td>
                                                    </tr>   
                                                    <tr>
                                                        <td><label><b>Gender: </b></label></td>
                                                        <td> Female </td>
                                                    </tr>  
                                                    <tr>
                                                        <td><label><b>Date of Birth: </b></label></td>
                                                        <td> 05/05/1970 </td>
                                                    </tr>  
                                                    <tr>
                                                        <td><label><b>Faculty: </b></label></td>
                                                        <td> ICT </td>
                                                    </tr>  
                                                    <tr>
                                                        <td><label><b>Major:</b></label></td>
                                                        <td> Database & Programming </td>
                                                    </tr>  

                                                    <tr>
                                                        <td><label><b>Degree:</b></label></td>
                                                        <td> Bachelor </td>
                                                    </tr>  
                                                    <tr>
                                                        <td><label><b>Batch:</b></label></td>
                                                        <td> 5 </td>
                                                    </tr>   
                                                    <tr>
                                                        <td><label><b>Course Detail:</b></label></td>
                                                        <td> Database & Programming </td>
                                                    </tr>  
                                                </table>


                                                <!--  -->
                                                    <div class="box-header with-border" style="background:#00c0ef;padding: 1px 10px 1px 10px;color: #fff;margin-right: 10px;">
                                                        <h4 class="box-title"><i class="fa fa-info-circle"></i> Payment Info.</h4>
                                                        <div class="clearboth"></div>
                                                    </div>
                                                <!--  -->


                                                <div class="column" style="margin-top:3%">
                                                        <div class="form-group" style="margin-bottom: 10px;">
                                                            <label class="col-sm-3 col-md-3 col-lg-2">Payment Category:</label>    
                                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                                <?php echo form_dropdown('fee_payment', $payment,'', 'class="form-control"'); ?>
                                                            </div>
                                                            <label class="col-sm-4 col-md-4 col-lg-4">Note: (Self Pay, Scholarship, Exemption, Lucky Draw....)</label> 
                                                        </div>

                                                        <div class="form-group" style="margin-bottom: 10px;">
                                                            <label class="required col-sm-3 col-md-3 col-lg-2 ">Duration Pay:</label>    
                                                            <div class="col-sm-9 col-md-9 col-lg-5">
                                                                <input class="" name="duration_pay" type="radio" value="1" checked="" /> 3 Month
                                                                <input class="" name="duration_pay" type="radio" value="2" /> 6 Month
                                                                <input class="" name="duration_pay" type="radio" value="3" /> 1 Year
                                                            </div>
                                                        </div>
                                                </div>


                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 ">Payment Amount:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="payment_amount" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 ">Discount:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="discount" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 ">Depot:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="depot" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 ">Total Pay:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="total_pay" type="text" value="" />
                                                    </div>
                                                </div>





                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
                                                    </div>
                                                    <div>
                                                        <a class="btn btn-success pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/print")?>">Print</a>
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