<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Students list by form"; ?>
    </h1>
</div>

    <div class="page-content">

        
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                    

                    <div class="col-xs-12 col-lg-12">
                        <div class="box-success box view-item col-xs-12 col-lg-12">
                            <div class="emp-department-form">
                                
                                <form id="emp-department-form" action="#" method="post" role="form">
                                    <input type="hidden" name="_csrf" value="NHVpeW1sNmUZO183KwVjPGYUODslFGQGGUMbIAUvAVZrByY3WAdREw==">
                                    <div class="col-lg-12 col-xs-12 no-padding">
                                        
                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Major</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="major" class="form-control">
                                                    <option value="all">Major</option>
                                                </select>
                                            </div>
                                        </div>                                        
                                        
                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Degree</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="degree" class="form-control">
                                                    <option value="all">Degree</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Academic Year</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="academic_year" class="form-control">
                                                    <option value="all">Academic Year</option>
                                                </select>
                                            </div>   
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Room</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="room" class="form-control">
                                                    <option value="all">Room</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Class</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="class" class="form-control">
                                                    <option value="all">Class</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Semester</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="semester" class="form-control">
                                                    <option value="all">Semester</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Payment</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="payment" class="form-control">
                                                    <option value="all">Full Paid</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Schlarship</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="scholarship" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="all">សម្ដេចហេងសំរិន</option>
                                                    <option value="all">សម្ដេចហ៊ុនសែន</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Dropped</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="scholarship" class="form-control">
                                                    <option value="#">Droppend</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Transferred</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="transferred" class="form-control">
                                                    <option value="#">Transferred</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Reffered In/Out</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="transferred" class="form-control">
                                                    <option value="in">In</option>
                                                    <option value="Out">Out</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Other</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="other" class="form-control">
                                                    <option value="dead"> Dead</option>
                                                    <option value="danger"> Danger</option>
                                                    <option value="disability"> Disability</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group col-xs-12 col-sm-4 col-lg-4 no-padding pull-right">
                                                <div class="col-xs-6">
                                                    <button type="submit" class="btn btn-block btn-success">Search</button> 
                                                </div>
                                                <div class="col-xs-6">
                                                    <button type="reset" class="btn btn-default btn-block">Reset</button>
                                                </div>
                                        </div>
                                    </div>
                                </form> 

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12">
                        <div class="col-lg-8 col-sm-8 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-search"></i> Students list by form</h3></div>
                        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
                            <div class="col-xs-4 left-padding"></div>
                            <div class="col-xs-4 "></div>
                            <div class="col-xs-4 ">                                
                                <button type="submit" class="btn btn-block btn-success">Print Excel</button> 
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="box box-primary view-item">
                            <div class="organization-view">
                                <table class="table  detail-view">
                                    <tbody>
                                        <tr>
                                            <th>Major</th><td>Management</td>
                                            <th>Degree</th><td>Master</td>
                                            <th>Academic Year</th><td>2016-2017</td>
                                        </tr>
                                        <tr>                                            
                                            <th>Room</th><td>6D</td>
                                            <th>Class</th><td>  A</td>
                                            <th>Semester</th><td>3</td>
                                        </tr> 

                                        <tr>                                            
                                            <th>Payment</th><td>Full Paid</td>
                                            <th>Scholarship</th><td> All</td>
                                            <th>Dropped</th><td>Drop</td>
                                        </tr> 


                                        <tr>                                            
                                            <th>Transferrend</th><td> In</td>
                                            <th>Reffered</th><td> </td>
                                            <th>Other</th><td> </td>
                                        </tr> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-lg-12">
                        <div class="widget-content nopadding table_holder">
                            <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Std.Name</th>
                                        <th>Std.Name Eng.</th>
                                        <th>Gender</th>
                                        <th>Birthdate</th>                                      
                                        <th>Payment Date</th>                                      
                                        <th>Amount</th>                                      
                                        <th>Scholarship</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>1</td>                                
                                        <td>មួន សៅជន</td>                                
                                        <td>MUON SAOCHOUN</td>                                
                                        <td>Female</td>                                    
                                        <td>10-02-1994</td>    
                                        <td>13-05-2007</td> 
                                        <td>1200</td>  
                                        <td>សម្ដេចហេងសំរិន</td>  

                                    </tr>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>2</td>                           
                                        <td>ហេង ភារម្យ</td> 
                                        <td>HENG PHEAROM</td>                             
                                        <td>Female</td>                             
                                        <td>10-02-1994</td>    
                                        <td>13-05-2007</td> 
                                        <td>1200</td>  
                                        <td>សម្ដេចហេងសំរិន</td>  

                                    </tr>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>3</td>                          
                                        <td>ហុន ធាន</td>  
                                        <td>HON THEAN</td>                              
                                        <td>Female</td>                              
                                        <td>10-02-1994</td>    
                                        <td>13-05-2007</td> 
                                        <td>1200</td>  
                                        <td>សម្ដេចហ៊ុនសែន</td> 

                                    </tr>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>4</td>                             
                                        <td>លេង សុក្រណៃ</td> 
                                        <td>LENG SOKNAI</td>                               
                                        <td>Female</td>                             
                                        <td>10-02-1994</td>    
                                        <td>13-05-2007</td> 
                                        <td>1200</td>  
                                        <td>សម្ដេចហ៊ុនសែន</td>    

                                    </tr>
                                </tbody>
                            </table>           
                        </div>
                    </div>
                    <?//php if ($pagination) { ?>
                        <!-- <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                            <?//php echo $pagination; ?>
                        </div> -->
                    <?//php } ?>
                    
                 
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