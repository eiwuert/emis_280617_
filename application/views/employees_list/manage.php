<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Employees List"; ?>
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
                                            <label>Department</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="department" class="form-control">
                                                    <option value="Department">Department</option>
                                                </select>
                                            </div>   
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Employee Type</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="employee_type" class="form-control">
                                                    <option value="all">All</option>
                                                    <option value="employee">Employee</option>
                                                    <option value="professor">Professor</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Active</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="active" class="form-control">
                                                    <option value="active">active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>   
                                        </div>


                                        <div class="col-sm-4 col-xs-12 col-lg-4">
                                            <label>Other</label>
                                            <div class="form-group field-empdepartment-emp_department_name required has-error">
                                                <select name="other" class="form-control">
                                                    <option value="ranger">Ranger</option>
                                                    <option value="danger">Danger</option>
                                                    <option value="dead">Dead</option>
                                                </select>
                                            </div>   
                                        </div>

                                        <div class="form-group col-xs-12 col-sm-4 col-lg-4 no-padding pull-right">
                                            <div style="padding-top:8%">
                                                <div class="col-xs-6">
                                                    <button type="submit" class="btn btn-block btn-success">Search</button> 
                                                </div>
                                                <div class="col-xs-6">
                                                    <button type="reset" class="btn btn-default btn-block">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form> 

                            </div>
                        </div>
                    </div>

                    <!-- Start -->
                    <div class="col-xs-12">
                        <div class="col-lg-8 col-sm-8 col-xs-12 no-padding"><h3 class="box-title"><i class="fa fa-search"></i> Students List Detail</h3></div>
                        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
                            <div class="col-xs-4 left-padding"></div>
                            <div class="col-xs-4 "></div>
                            <div class="col-xs-4 ">                                
                                <a href="<?php echo site_url("$controller_name/pdf")?>" type="submit" class="btn btn-block btn-success">Print Excel</a> 
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="box box-primary view-item">
                            <div class="organization-view">
                                <table class="table  detail-view">
                                    <tbody>
                                        <tr>
                                            <th>Department</th><td></td>
                                            <th>Employee Type</th><td></td>
                                            <th>Active</th><td></td>
                                        </tr>
                                        <tr>                                            
                                            <th>Other</th><td></td>
                                            <th></th><td> </td>
                                            <th></th><td></td>
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
                                        <th>Name in KH</th>
                                        <th>Name in Eng</th>
                                        <th>Sex</th>
                                        <th>D.O.B</th>                                    
                                        <th>Start Date</th>                                    
                                        <th>Times</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>1</td>                                
                                        <td>បុគ្គលិក</td>                                
                                        <td>Employee</td>
                                        <td>Male</td>
                                        <td>16-03-1988</td>
                                        <td>16-03-2016</td>
                                        <td>Full Time</td>

                                    </tr>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>2</td>                                
                                        <td>បុគ្គលិក</td>                                
                                        <td>Employee</td>
                                        <td>Male</td>
                                        <td>16-03-1988</td>
                                        <td>16-03-2016</td>
                                        <td>Part Time</td>

                                    </tr>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>3</td>                                
                                        <td>បុគ្គលិក</td>                                
                                        <td>Employee</td>
                                        <td>Male</td>
                                        <td>16-03-1988</td>
                                        <td>16-03-2016</td>
                                        <td>Full Time</td>

                                    </tr>
                                    <tr style="cursor: pointer;">
                                                                           
                                        <td>4</td>                                
                                        <td>បុគ្គលិក</td>                                
                                        <td>Employee</td>
                                        <td>Male</td>
                                        <td>16-03-1988</td>
                                        <td>16-03-2016</td>
                                        <td>Part Time</td>

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