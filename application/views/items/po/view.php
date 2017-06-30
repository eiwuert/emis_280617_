<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Add PO"; ?>
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
                                        New Purchase Order
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">



                                                    <div class="form-group" style="margin-bottom: 10px;">
                                                        <label class="required col-sm-2 col-md-2 col-lg-2">Items Name:</label>    
                                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                                            <input class="filter form-control" name="item_name" type="text" value="Search Item auto complete" />
                                                        </div>
                                                        <label class="required col-sm-2 col-md-2 col-lg-2 align-right">Code:</label>    
                                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                                            <input class="filter form-control" name="code" type="text" value="code auto from item" readonly="" />
                                                        </div>
                                                    </div>



                                                    <div class="form-group" style="margin-bottom: 10px;">
                                                        <label class="required col-sm-3 col-md-3 col-lg-2 ">Amount Dollar:</label>    
                                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                                            <input class="filter form-control" name="amount_dollar" type="text" value="" placeholder='Dollar'/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 10px;">
                                                        <label class="required col-sm-3 col-md-3 col-lg-2 ">Amount Riel:</label>    
                                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                                            <input class="filter form-control" name="amount_riel" type="text" value="" placeholder='Riel'/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" style="margin-bottom: 10px;">
                                                        <label class="required col-sm-3 col-md-3 col-lg-2 ">Amount Baht:</label>    
                                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                                            <input class="filter form-control" name="amount_baht" type="text" value="" placeholder='Baht'/>
                                                        </div>
                                                    </div>
                                     
                                                   <div class="form-group" style="margin-bottom: 10px;">
                                                        <label class="col-sm-3 col-md-3 col-lg-2">Total Item:</label>    
                                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                                            <input class="filter form-control" name="total_item" type="text" value="" />
                                                        </div>
                                                    </div>                                                    
                                     
                                                    <div class="form-group" style="margin-bottom: 10px;">
                                                        <label class="col-sm-3 col-md-3 col-lg-2">Supplier:</label>    
                                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                                            <?php echo form_dropdown('supplier', $supplier,'', 'class="form-control"'); ?>
                                                        </div>
                                                    </div>                        

                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
                                                    </div>
                                                    <div>
                                                        <input type="submit" name="submit" value="Add" id="submit" class="btn btn-primary pull-right">                
                                                    </div>
                                                </div>

                                                <table class="table">
                                                    <tr>
                                                        <th>code</th>
                                                        <th>Name</th>
                                                        <th>Dollar</th>
                                                        <th>Riel</th>
                                                        <th>Baht</th>
                                                        <th>Quentity</th>
                                                        <th>Supplier</th>
                                                        <th></th>
                                                    </tr>

                                                    <tr>
                                                        <td>0012</td>
                                                        <td>Pencil</td>
                                                        <td>$0.50</td>
                                                        <td>R1999.95</td>
                                                        <td>B17.46</td>
                                                        <td>6</td>
                                                        <td>Supplier_name</td>
                                                        <td>
                                                            <a href="#" class="detail-student" title="Detail">
                                                                <i class="ace-icon fa fa-trush bigger-180"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>0012</td>
                                                        <td>pen</td>
                                                        <td>$0.50</td>
                                                        <td>R1999.95</td>
                                                        <td>B17.46</td>
                                                        <td>6</td>
                                                        <td>Supplier_name</td>
                                                        <td>
                                                            <a href="#" class="detail-student" title="Detail">
                                                                <i class="ace-icon fa fa-trush bigger-180"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>0012</td>
                                                        <td>Chair</td>
                                                        <td>$0.50</td>
                                                        <td>R1999.95</td>
                                                        <td>B17.46</td>
                                                        <td>4</td>
                                                        <td>Supplier_name</td>
                                                        <td>
                                                            <a href="#" class="detail-student" title="Detail">
                                                                <i class="ace-icon fa fa-trush bigger-180"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <tr style="background:#F1F1F1">
                                                        <td colspan="2"><label>Total</label></td>
                                                        <td>$1.5</td>
                                                        <td>R5999.85</td>
                                                        <td>B52.38</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <a href="#" class="detail-student" title="Detail">
                                                                <i class="ace-icon fa fa-trush bigger-180"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
                                                    </div>
                                                    <div>
                                                        <input type="submit" name="submit" value="Add" id="submit" class="btn btn-primary pull-right">                
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