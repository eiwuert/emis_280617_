<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Expense Management"; ?>
    </h1>
</div>

    <div class="page-content">

        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="widget-content nopadding table_holder table-responsive">
                        <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>                                   
                                    <th>Expense Type</th>                                   
                                    <th>Currency Rate</th>                                   
                                    <th>Amount(SGD)</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="cursor: pointer;">
                                    <td width="15%">
                                        <span style="float-left" class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                            <input type="text" id="expense_date" class="form-control hasDatepicker" name="expense_date" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </td>
                                    <td>                                        
                                        <input type="text" id="expense_item" class="form-control" name="expense_item" size="10">
                                    </td>
                                    <td>
                                    <input type="text" id="expense_quantity" class="form-control" name="expense_quantity" size="10">
                                    </td>
                                    <td>
                                        <div class="col-sm-12 no-padding">
                                            <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
                                                <input style="float:left" type="text" id="expense_unit_price" class="form-control" name="expense_unit_price" size="10">
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 no-padding">                                               
                                                <select style="float:left" class="form-control" name="expense_unit_price_sgd">
                                                        <option value="sgd">SGD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                                <select style="float:left" class="form-control" name="exspense_type">
                                                        <option value="">-- Please Select</option>
                                                </select>
                                    </td>
                                    <td>                                        
                                        <div class="col-sm-12 no-padding">
                                            <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
                                                <input style="float:left" type="text" id="expense_currency_rate" class="form-control" name="expense_currency_rate" size="10" placeholder='1.00'>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12 no-padding">                                               
                                                <select style="float:left" class="form-control" name="expense_currency_rate_sgd">
                                                        <option value="sgd">SGD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-sm-12 no-padding">
                                            <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
                                                <input style="float:left" type="text" id="expense_amount_sgd" class="form-control" name="expense_amount_sgd" size="10" placeholder='0'>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <a id="new-person-btn" class="btn btn-danger" title="delete" href'#'>x</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                
                                
                            </tbody>
                        </table>            
                    </div>
                    <div class="col-sm-9">
                        <a href="#" class="btn btn-primary">+ New Item</a>
                        <div class="pull-right">
                            <b>Total</b> S$ 0.00
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="pull-right">
                        <a href="#" class="btn btn-primary">Aprove</a>
                        <a href="#" class="btn btn-primary">Save</a>
                    </div>
                    
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>

<?php $this->load->view("partial/footer"); ?>


<script type="text/javascript">
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }
    $(document).ready(function()
    {
        initDatePicker("input[name='expense_date']")
        
    });

</script>