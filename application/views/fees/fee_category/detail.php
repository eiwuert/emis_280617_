<?php $this->load->view("partial/header"); ?>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-plus"></i>
        <?php echo "Add Fees Category Detail"; ?>
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
                        
                            
                              <section class="content" style="min-height: 543px;">
                                  <div class="col-xs-12">
                                      <div class="page-header" id='page-header'>
                                              <h1 ><i class="fa fa-search"></i> sfdsf </h1>

                                              <div class="col-lg-5 col-sm-5 col-xs-12 no-padding pull-right" style="padding-top: 20px !important;">
                                                  <div class="col-xs-3" style="padding:0px 3px">
                                                      <a class="btn btn-block btn-back" href="<?php echo site_url("$controller_name"); ?>">BACK</a>  
                                                  </div>
                                                  <div class="col-xs-3" style="padding:0px 3px">
                                                      <a class="btn btn-block btn-green" href="<?php echo site_url("$controller_name"); ?>">Add Head</a>  
                                                  </div>
                                                  <div class="col-xs-3" style="padding:0px 3px">
                                                      <a class="btn btn-block btn-info" href="<?php echo site_url("$controller_name"); ?>">update</a>
                                                  </div>
                                                  <div class="col-xs-3" style="padding:0px 3px">
                                                      <a class="btn btn-block btn-danger btn-delete" href="<?php echo site_url("$controller_name"); ?>" data-confirm="" data-method="post">Delete</a>
                                                  </div>
                                              </div>

                                      </div>
                                  </div>



                                    <div class="col-xs-12">
                                      <div class="box box-primary view-item" style="padding-bottom:5px">
                                       <div class="fees-collect-category-view">
                                        <table class="table  detail-view"><tbody><tr><th>Name</th><td>Tuition Fees</td></tr>
                                            <tr><th>Description</th><td>Tuition Fees</td></tr>
                                            <tr><th>Batch</th><td>MBA-Batch-01</td></tr>
                                            <tr><th>Start Date</th><td>01-06-2015</td></tr>
                                            <tr><th>End Date</th><td>30-06-2015</td></tr>
                                            <tr><th>Due Date</th><td>01-07-2015</td></tr>
                                            <tr><th>Created At</th><td>27-05-2015 18:50:52</td></tr>
                                            <tr><th>Created By</th><td>admin</td></tr>
                                            <tr><th>Updated At</th><td> - </td></tr>
                                            <tr><th>Updated By</th><td> - </td></tr>
                                            <tr><th>Status</th><td><span class="label label-success"> Active </span></td></tr></tbody></table>   </div>

                                          <div class="box box-success">
                                                <div class="box-header" id="callout-input-needs-type">
                                                    <h4 class="box-title">Fees Category Details</h4>
                                                </div>
                                                <div class="box-body table-responsive">
                                                    <div id="w0" class="grid-view">
                                                    <table class="table table-striped table-bordered">
                                                      <thead>
                                                          <tr>
                                                              <th>#</th>
                                                              <th>
                                                                  <a href="/edusec/index.php?r=fees%2Ffees-collect-category%2Fview&amp;id=5&amp;sort=fees_details_name" data-sort="fees_details_name">Name</a>
                                                              </th>
                                                              <th>
                                                                  <a href="/edusec/index.php?r=fees%2Ffees-collect-category%2Fview&amp;id=5&amp;sort=fees_details_description" data-sort="fees_details_description">Description</a>
                                                              </th>
                                                              <th>
                                                                  <a href="/edusec/index.php?r=fees%2Ffees-collect-category%2Fview&amp;id=5&amp;sort=fees_details_amount" data-sort="fees_details_amount">Amount</a>
                                                              </th>
                                                              <th>&nbsp;</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                          <tr data-key="1"><td>1</td>
                                                              <td>Tuition Fees-2015</td>
                                                              <td>Academic Year 2015 Tuition Fees</td>
                                                              <td>25000</td>
                                                              <td>
                                                                  <a href="<?php echo site_url("$controller_name/view_fee/id")?>" title="Update">
                                                                      <span class="glyphicon glyphicon-edit"></span>
                                                                  </a>
                                                                  <a href="<?php echo site_url("$controller_name/delete/id")?>" title="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post">
                                                                      <span class="glyphicon glyphicon-remove"></span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                          <tr data-key="2"><td>2</td>
                                                              <td>Extra Misc Fees</td>
                                                              <td>Extra Misc Fees</td>
                                                              <td>2000</td>
                                                              <td>
                                                                  <a href="" title="Update">
                                                                      <span class="glyphicon glyphicon-edit"></span>
                                                                  </a>
                                                                  <a href="" title="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post">
                                                                    <span class="glyphicon glyphicon-remove"></span>
                                                                  </a>
                                                              </td>
                                                          </tr>
                                                      </tbody>
                                                    </table>
                                                    </div>       
                                                </div>
                                          </div>
                                      </div>
                                  </div>
                              </section>


                        </div>
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>




