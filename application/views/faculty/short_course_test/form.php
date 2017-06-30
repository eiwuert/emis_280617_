<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Add Short Course"; ?>
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
                                        New Short Course
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">

                                                

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="short_course" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Short Course Name:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="short_course" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="short_course_kh" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Short Course Name (kh):</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="short_course_kh" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">University:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <?php echo form_dropdown('university', $university,'', 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="degree" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Degree:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <?php echo form_dropdown('degree', $degree,'', 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="duration" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Duration:</label>    
                                                    <div class="col-sm-1 col-md-1 col-lg-1">
                                                        <input class="filter form-control" name="duration" type="text" value="" />
                                                    </div>

                                                    <label for="from" class="required col-sm-1 col-md-1 col-lg-1 align-right " aria-required="true">From:</label>    

                                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <input class="filter form-control" name="from" type="text" value="" />
                                                    </div>
                                                    
                                                    <label for="to" class="required col-sm-1 col-md-1 col-lg-1 align-right " aria-required="true">To:</label>    

                                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                                        <input class="filter form-control" name="to" type="text" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label for="short_course_fee" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Short Course Fee:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="short_course_fee" type="text" value="" />
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
<script type="text/javascript">

    $(document).ready(function(){
        $('#add_schedule').click(function(){
            var tr = "";
            var tr = "<div class='stu-status-view' style='margin-top:3%; border-top:solid 2px #ccc'>"+
                    "<table class='table detail-view'>"+
                        "<tbody>"+
                            "<tr>"+
                                "<th>Year</th>"+
                                "<td><input type='text' name='year' value='' style='width:100%' /></td>"+
                                "<th>Semester</th>"+
                                "<td><input type='text' name='semester' value='' style='width:100%' /></td>"+
                                "<td></td>"+
                                "<td></td>"+
                                "<td></td>"+
                                "<td></td>"+
                            "</tr>"+
                            "<tr style='background-color:#D9EDF7'>"+
                                "<th>Monday</th>"+
                                "<th>Tuesday</th>"+
                                "<th>Wednesday</th>"+
                                "<th>Thursday</th>"+
                                "<th>Friday</th>"+
                                "<th>Satursday</th>"+
                                "<th>Sunday</th>"+
                            "</tr>"+
                            "<tr>"+
                                "<th><input type='text' name='time' value='' style='width:100%' /></th>"+
                                "<th><input type='text' name='time' value='' style='width:100%' /></th>"+
                                "<th><input type='text' name='time' value='' style='width:100%' /></th>"+
                                "<th><input type='text' name='time' value='' style='width:100%' /></th>"+
                                "<th><input type='text' name='time' value='' style='width:100%' /></th>"+
                                "<th><input type='text' name='time' value='' style='width:100%' /></th>"+
                                "<th><input type='text' name='time' value='' style='width:100%' /></th>"+
                            "</tr>"+
                        "</tbody>"+
                    "</table>"+
                    "</div>";

            $("#add:first").append(tr);
            return false;

        });
    });
</script>
<?php $this->load->view("partial/footer"); ?>