
<?php $this->load->view("partial/header"); ?>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <!-- <h1> 
     <i class="icon fa fa-plus"></i>
        <?php echo "Add Fees Category Detail"; ?>
    </h1> -->
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
                        
                              


                                            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><i class="fa fa-search"></i> Select Criteria</h3>
                                                    <div class="clearboth"></div>
                                                </div><br>
                                                   
                                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Batch' . ':', 'feescollectcategory-fees_collect_due_date', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <select id="feescollectcategory-fees_collect_batch_id" class="form-control" name="fees_collect_batch_id" placeholder="Batch">
                                                            <option value="1">Select Batch</option>
                                                            <optgroup label="MCA">
                                                            <option value="1">MCA-Batch-01</option>
                                                            </optgroup>
                                                            <optgroup label="BCA">
                                                            <option value="2">BCA-Batch-01</option>
                                                            </optgroup>
                                                            <optgroup label="M.Sc.IT">
                                                            <option value="3">MSCIT-Batch-01</option>
                                                            </optgroup>
                                                            <optgroup label="B.Sc.IT">
                                                            <option value="4">BSCIT-Batch-01</option>
                                                            </optgroup>
                                                            <optgroup label="MBA">
                                                            <option value="5">MBA-Batch-01</option>
                                                            </optgroup>
                                                    	</select>
                                                    </div>

                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Fees Collect Category'. ':', 'feescollectcategory-fees_collect_batch_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <select id="feescollectcategory-fees_collect_batch_id" class="form-control" name="fees_collect_batch_id" placeholder="Batch">
                                                            
                                                            <option value="1">Select Fee Category</option>
                                                           
                                                    	</select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1	%">
												   	<div class="box-header with-border">
	                                                    <h3 class="box-title"><i class="fa fa-search"></i> Select Criteria</h3>
	                                                    <div class="clearboth"></div>
	                                                </div>
												   <div class="box-body table-responsive no-padding">
												   			<table class="table">
												   				<colgroup>
												   					<col class="col-xs-1">
												   				</colgroup>
									   							<tbody>
									   								<tr>
									   									<th class="text-center">SI No.</th>
									   									<th>Fees Details</th>
									   									<th>Description</th>
									   									<th>Amount</th></tr><tr><td class="text-center">1</td><td>Tuition Fees-2015</td><td>Tuition Fees-2015</td><td>25000</td></tr><tr><td class="text-center">2</td><td>Extra Misc Fees</td><td>Extra Misc Fees</td><td>1500</td></tr><tr><th colspan="3" class="text-right">Total Amount</th>
									   									<th>26500</th>
									   								</tr>
									   							</tbody>
												   			</table>  
												   </div>
												   <!--./end box-body-->
											</div>

                                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1	%">
												   	<div class="box-header with-border">
	                                                    <h3 class="box-title"><i class="fa fa-users"></i> Student Details</h3>
	                                                    <div class="box-tools pull-right"><a style="margin: 6px 10px;" class="btn btn-sm btn-warning" href="" target="_blank" style="color:#fff" data-method="POST"><i class="fa fa-file-pdf-o"></i> Generate PDF</a></div>
	                                                    <div class="clearboth"></div>
	                                                </div>
												   <div class="box-body table-responsive no-padding">
   														<table class="table table-striped">
   															<tbody>
   																<tr>
   																	<th class="text-center">SI No.</th>
   																	<th>Student No</th>
   																	<th>Student Name</th>
   																	<th>Total Collection</th>
   																	<th>Paid Amount</th>
   																	<th>Unpaid Amount</th>
   																	<th>Action</th>
																</tr>
																<tr>
																		<td class="text-center">1</td>
																		<td>1</td>
																		<td>Ankit Narthi</td>
																		<td>26500</td>
																		<td>22000</td>
																		<td>4500</td>
																		<td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/fee_payment_transaction")?>" target="_blank">TakeFees</a></td></tr><tr><td class="text-center">2</td>
																		<td>6</td>
																		<td>Anita Kamriya</td>
																		<td>26500</td>
																		<td>22000</td>
																		<td>4500</td>
																		<td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/fee_payment_transaction")?>" target="_blank">TakeFees</a></td></tr><tr><td class="text-center">3</td>
																		<td>7</td>
																		<td>Mehul Patel</td>
																		<td>26500</td>
																		<td>26000</td>
																		<td>500</td>
																		<td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/fee_payment_transaction")?>" target="_blank">TakeFees</a></td></tr><tr><td class="text-center">4</td>
																		<td>8</td>
																		<td>Kinjal Ruparel</td>
																		<td>26500</td>
																		<td>22000</td>
																		<td>4500</td>
																		<td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/fee_payment_transaction")?>" target="_blank">TakeFees</a></td></tr><tr><td class="text-center">5</td>
																		<td>9</td>
																		<td>Nayan Marty</td>
																		<td>26500</td>
																		<td>22000</td>
																		<td>4500</td>
																		<td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/fee_payment_transaction")?>" target="_blank">TakeFees</a></td></tr><tr class="bg-aqua"><th colspan="3" class="text-right">GRAND TOTAL</th>
	   																	<th>132500</th>
	   																	<th>114000</th>
	   																	<th>18500</th>
   																	<th>
   																	</th>
	   															</tr>
	   														</tbody>
	   													</table>
	   												</div>
											</div>
                       


                                                              
                        </div>
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>





<?php $this->load->view("partial/footer"); ?>