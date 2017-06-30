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
                        
                            <div class="box-success box view-item col-xs-12 col-lg-12">
                                <div class="fees-collect-category-form">

                                    <form id="fees-collect-category-form" action="" method="post">

                                            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                                <div class="box-header with-border">
                                                    <h4 class="box-title"><i class="fa fa-info-circle"></i> Add Fees Category Detail</h4>
                                                    <div class="clearboth"></div>
                                                </div><br>

                                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Name' . ':', 'feescategorydetails-fees_details_name', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_input(array(
                                                            'type' => 'text',
                                                            'name' => 'fees_details_name',
                                                            'id' => 'feescategorydetails-fees_details_name',
                                                            'class' => 'form-control',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>

                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Amount'. ':', 'feescategorydetails-fees_details_amount', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_input(array(
                                                            'type' => 'text',
                                                            'name' => 'fees_details_amount',
                                                            'id' => 'feescategorydetails-fees_details_amount',
                                                            'class' => 'form-control',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                                    <div class="col-sm-12 col-xs-12">
                                                        <?php echo form_label( 'Description'. ':', 'feescategorydetails-fees_details_description', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_textarea(array(
                                                            'name' => 'fees_details_description',
                                                            'id' => 'feescategorydetails-fees_details_description',
                                                            'class' => 'form-control',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>
                                                </div>



                                                    <div class="form-group col-xs-12 col-sm-6 col-lg-4">
                                                    <div class="col-xs-6">
                                                        <button type="submit" class="btn btn-block btn-success">Save</button>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <a class="btn btn-default btn-block" href="<?php echo site_url("$controller_name/index")?>">Cancel</a> </div>
                                                    </div>

                                            </div>
                                    </form> 


                                </div>
                            </div>                                       
                        </div>
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>




