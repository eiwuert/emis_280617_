
<?php $this->load->view("partial/header"); ?>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-plus"></i>
        <?php echo "Fees Collection"; ?>
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
                        

                                    <form id="fees-collect-category-form" action="" method="post">

                                            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><i class="fa fa-user"></i><sub><i class="fa fa-info-circle"></i></sub>Student Details</h3>
                                                    <div class="clearboth"></div>
                                                </div><br>
                                                   
                                                <div class="box-body no-padding">
                                                <table class="table">
                                                    <colgroup><col class="col-sm-2">
                                                        <col class="col-sm-2">
                                                        <col class="col-sm-8">
                                                     
                                                    </colgroup>
                                                    <tbody>
                                                        <tr class="visible-xs text-center">
                                                            <td colspan="2"><img class="img-circle edusec-img-disp" src="/edusec/data/stu_images/no-photo.png" alt="No Image">
                                                            </td>
                                                        </tr>
                                                    <tr>
                                                        <td rowspan="5" class="hidden-xs"><img class="img-circle edusec-img-disp" src="/edusec/data/stu_images/no-photo.png" alt="No Image"></td>
                                                        <th>Name</th>
                                                        <td>Ankit Narthi</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Course</th>
                                                        <td>MCA</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Batch</th>
                                                        <td>MCA-Batch-01</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Section</th>
                                                        <td>MCA-Section-01</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Student Status</th>
                                                        <td>General/Default</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                               </div>
                                            </div>

                                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1	%">
												   	<div class="box-header with-border">
	                                                    <h3 class="box-title"><i class="fa fa-inr"></i><sub><i class="fa fa-info-circle"></i></sub> Fees Collection Category :  Tuition Fees</h3>
	                                                    <div class="clearboth"></div>
	                                                </div>
												    <div class="box-body table-responsive">
                                                        <table class="table table-bordered tbl-pay-fees">
                                                            <colgroup>
                                                                <col class="col-xs-1">
                                                                <col class="col-xs-9">
                                                                <col class="col-xs-2">
                                                            </colgroup>
                                                            <tbody>
                                                                <tr>
                                                                    <th class="">SI No.</th>
                                                                    <th>Fees Details</th>
                                                                    <th>Amount</th>
                                                                </tr>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Tuition Fees-2015</td>
                                                                    <td>25000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Extra Misc Fees</td>
                                                                    <td>1500</td>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="2" class="text-right col-md-9">Total Amount</th>
                                                                    <td>26500</td>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="2" class="text-right">Total Paid Fees</th>
                                                                    <td>22000</td>
                                                                </tr>
                                                                    <tr class="warning"><th colspan="2" class="text-right">Total Unpaid Fees</th>
                                                                    <td>4500</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>    

                                                        <form id="fees-collect-form" action="/edusec/index.php?r=fees%2Ffees-payment-transaction%2Fpay-fees&amp;sid=1&amp;fcid=1" method="post">
                                                            
                                                            <input type="hidden" name="_csrf" value="MzhvMGV6SlJyaypiXEISGXVSAVwhDgElZA04CFM5ZydaaDhRUS8vOQ=="> 
                                                            <div class="error-summary text-red" style="display:none">
                                                                <p>Please fix the following errors:</p>
                                                                <ul></ul>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-12 col-lg-12 no-padding chk-cash">
                                                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                                                <div class="form-group field-feespaymenttransaction-fees_pay_tran_mode required">
                                                                        <label class="control-label" for="feespaymenttransaction-fees_pay_tran_mode">Payment Mode</label>
                                                                            <select id="feespaymenttransaction-fees_pay_tran_mode" class="form-control" name="FeesPaymentTransaction[fees_pay_tran_mode]">
                                                                                <option value="1">Cash</option>
                                                                                <option value="2">Cheque</option>
                                                                        </select>
                                                                        <div class="help-block"></div>
                                                                </div>   
                                                            </div>

                                                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                                                <div class="form-group field-feespaymenttransaction-fees_pay_tran_date required">
                                                                        <label class="control-label" for="feespaymenttransaction-fees_pay_tran_date">Payment Date</label>
                                                                        <input type="text" id="feespaymenttransaction-fees_pay_tran_date" class="form-control hasDatepicker" name="FeesPaymentTransaction[fees_pay_tran_date]" placeholder="Payment Date" size="10">
                                                                        <div class="help-block"></div>
                                                                </div>    
                                                            </div>
                                                            <div class="col-xs-12 col-sm-4 col-lg-4">
                                                                <div class="form-group field-feespaymenttransaction-fees_pay_tran_amount required">
                                                                        <label class="control-label" for="feespaymenttransaction-fees_pay_tran_amount">Amount</label>
                                                                        <input type="text" id="feespaymenttransaction-fees_pay_tran_amount" class="form-control" name="FeesPaymentTransaction[fees_pay_tran_amount]" maxlength="10" placeholder="Amount">
                                                                        <div class="help-block"></div>
                                                                </div>  
                                                            </div>
                                                    </div>
                                                    <!---End box-body div---->
                                                    <div class="box-footer">
                                                        <div class="pull-right" style="padding-bottom:10px">
                                                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i>  Take Fees</button>          
                                                            <a class="btn btn-warning" href="/edusec/index.php?r=fees%2Ffees-payment-transaction%2Fprint-common-receipt&amp;sid=1&amp;fcid=1" target="_blank"><i class="fa fa-print"></i> Print receipt</a>
                                                        </div>
                                                    </div>
											</div>

                                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1	%">
												   	<div class="box-header with-border">
	                                                   <h3 class="box-title"><i class="fa fa-inr"></i><sup><i class="fa fa-clock-o"></i></sup> Payment History</h3>
	                                                    <div class="box-tools pull-right"><a style="margin: 6px 10px;" class="btn btn-sm btn-warning" href="" target="_blank" style="color:#fff" data-method="POST"><i class="fa fa-file-pdf-o"></i> Generate PDF</a></div>
	                                                    <div class="clearboth"></div>
	                                                </div>
												   
                                                    <div class="box-body table-responsive no-padding">
                                                        <div id="w0">
                                                            <div id="w1" class="grid-view">
                                                                <table class="table table-striped table-bordered">
                                                                    <thead>
                                                                            <tr>
                                                                                <th>#</th>
                                                                                <th>
                                                                                    <a class="desc" href="" data-sort="fees_pay_tran_id">Receipt No.</a>
                                                                                </th>
                                                                                <th>
                                                                                    <a href="" data-sort="fees_pay_tran_date">Payment Date</a>
                                                                                </th>
                                                                                <th>
                                                                                    <a href="" data-sort="fees_pay_tran_mode">Payment Mode</a>
                                                                                </th>
                                                                                <th>
                                                                                    <a href="" data-sort="fees_pay_tran_cheque_no">Cheque No</a>
                                                                                </th>
                                                                                <th>
                                                                                    <a href="" data-sort="fees_pay_tran_bank_id">Bank Name</a>
                                                                                </th>
                                                                                <th>
                                                                                    <a href="" data-sort="fees_pay_tran_bank_branch">Bank Branch</a>
                                                                                </th>
                                                                                <th>
                                                                                    <a href="" data-sort="fees_pay_tran_amount">Amount</a>
                                                                                </th>
                                                                                <th>&nbsp;</th>
                                                                            </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                            <tr data-key="2">
                                                                                <td>1</td>
                                                                                <td>2</td>
                                                                                <td>05-06-2015</td>
                                                                                <td>Cheque</td>
                                                                                <td>123</td>
                                                                                <td>Bank of India</td>
                                                                                <td>Ahmedabad</td>
                                                                                <td>2000</td>
                                                                                <td>
                                                                                    <a href="" title="Update" data-pjax="0">
                                                                                        <span class="glyphicon glyphicon-edit"></span>
                                                                                    </a>
                                                                                    <a href="" title="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0">
                                                                                        <span class="glyphicon glyphicon-remove"></span>
                                                                                    </a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr data-key="1">
                                                                                <td>2</td>
                                                                                <td>1</td>
                                                                                <td>05-06-2015</td>
                                                                                <td>Cash</td>
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                                <td></td>
                                                                                <td>20000</td>
                                                                                <td>
                                                                                    <a href="" title="Update" data-pjax="0"><span class="glyphicon glyphicon-edit"></span></a> 
                                                                                    <a href="" title="Delete" data-confirm="Are you sure you want to delete this item?" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-remove"></span></a></td>
                                                                            </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
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





<?php $this->load->view("partial/footer"); ?>