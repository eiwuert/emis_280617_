<?php $this->load->view("partial/header"); ?>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-plus"></i>
        <?php echo "Add Fee Category"; ?>
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
                                                    <h4 class="box-title"><i class="fa fa-info-circle"></i> Add Fee Category</h4>
                                                    <div class="clearboth"></div>
                                                </div><br>

                                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Name' . ':', 'feescollectcategory-fees_collect_name', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_input(array(
                                                            'name' => 'fees_collect_name',
                                                            'id' => 'feescollectcategory-fees_collect_name',
                                                            'class' => 'form-control',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>

                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Description'. ':', 'feescollectcategory-fees_collect_details', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_textarea(array(
                                                            'name' => 'fees_collect_details',
                                                            'id' => 'feescollectcategory-fees_collect_details',
                                                            'class' => 'form-control',
                                                            'style' => 'min-height:28px;height:50px',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Start Date' . ':', 'feescollectcategory-fees_collect_start_date', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_input(array(
                                                            'name' => 'fees_collect_start_date',
                                                            'id' => 'feescollectcategory-fees_collect_start_date',
                                                            'placeholder' => 'dd-mm-yyyy',
                                                            'class' => 'form-control hasDatepicker',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>

                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'End Date'. ':', 'feescollectcategory-fees_collect_end_date', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_input(array(
                                                            'name' => 'fees_collect_end_date',
                                                            'id' => 'feescollectcategory-fees_collect_end_date',
                                                            'placeholder' => 'dd-mm-yyyy',
                                                            'class' => 'form-control hasDatepicker',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Due Date' . ':', 'feescollectcategory-fees_collect_due_date', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <?php
                                                        echo form_input(array(
                                                            'name' => 'fees_collect_due_date',
                                                            'id' => 'feescollectcategory-fees_collect_due_date',
                                                            'placeholder' => 'dd-mm-yyyy',
                                                            'class' => 'form-control hasDatepicker',
                                                            'value' => '' ));
                                                        ?>
                                                    </div>

                                                    <div class="col-sm-6 col-xs-12">
                                                        <?php echo form_label( 'Batch'. ':', 'feescollectcategory-fees_collect_batch_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                        <select id="feescollectcategory-fees_collect_batch_id" class="form-control" name="fees_collect_batch_id" placeholder="Batch">
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
                                                </div>



                                                

                                            

                                                <!-- <div class="col-xs-12 col-sm-6 col-lg-6">
                                                <div class="form-group field-feescollectcategory-fees_collect_batch_id required">
                                                    <label class="control-label" for="feescollectcategory-fees_collect_batch_id">Batch</label>
                                                    <input type="hidden" name="FeesCollectCategory[fees_collect_batch_id]" value="">
                                                    <select id="feescollectcategory-fees_collect_batch_id" class="form-control" name="FeesCollectCategory[fees_collect_batch_id][]" multiple="multiple" size="4" placeholder="Batch" style="display: none;">
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
                                                    <div>
                                                    <button type="button" class="multiselect dropdown-toggle form-control btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text">Select Batch(es)</span> <b class="caret"></b></button><ul class="multiselect-container dropdown-menu"><li class="multiselect-item filter" value="0"><div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input class="form-control multiselect-search" type="text" placeholder="Search"><span class="input-group-btn"><button class="btn btn-default multiselect-clear-filter" type="button"><i class="glyphicon glyphicon-remove-circle"></i></button></span></div></li><li class="multiselect-item multiselect-all"><a tabindex="0" class="multiselect-all"><label class="checkbox"><input type="checkbox" value="multiselect-all">  Select all</label></a></li><li class="multiselect-item multiselect-group multiselect-group-clickable"><label>MCA</label></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="1"> MCA-Batch-01</label></a></li><li class="multiselect-item multiselect-group multiselect-group-clickable"><label>BCA</label></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="2"> BCA-Batch-01</label></a></li><li class="multiselect-item multiselect-group multiselect-group-clickable"><label>M.Sc.IT</label></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="3"> MSCIT-Batch-01</label></a></li><li class="multiselect-item multiselect-group multiselect-group-clickable"><label>B.Sc.IT</label></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="4"> BSCIT-Batch-01</label></a></li><li class="multiselect-item multiselect-group multiselect-group-clickable"><label>MBA</label></li><li><a tabindex="0"><label class="checkbox"><input type="checkbox" value="5"> MBA-Batch-01</label></a></li></ul></div><div class="help-block"></div>
                                                </div>    
                                                </div> -->


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


<script type='text/javascript'>
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }
    $(document).ready(function()
    {
        initDatePicker("input[name='stu_dob']")
        initDatePicker("input[name='stu_admission_date']")       
    });
  

</script>



