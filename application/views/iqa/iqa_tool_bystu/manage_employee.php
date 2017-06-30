<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Annual Leader"; ?>
    </h1>
</div>

    <div class="page-content">        
       
        <div class="row">
            <div class="form-group col-sm-12 col-xs-12" style="margin-bottom: 10px;">  
                <div class="col-sm-2 col-md-2 col-lg-2 no-padding" style="margin-top:25px">
                    <?php echo form_open("$controller_name/search", array('id' => 'search_form', 'autocomplete' => 'off')); ?>
                    <input type="text" name ='search' id='search' value=""   placeholder="<?php echo lang('common_search'); ?>"/>            
                    </form>
                </div>                
            </div>
            <div class="col-xs-12">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                    <!-- <div class="widget-content nopadding table_holder table-responsive" > -->
                        <?php // echo $manage_table; ?>         
                    <!-- </div>      -->

                    <div class="widget-content nopadding table_holder table-responsive">
                        <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                            <thead>
                                <tr>
                                    <th class="leftmost">
                                        <input type="checkbox" id="select_all">
                                    </th>
                                    <th>No.</th>
                                    <th>Employee Name</th>
                                    <th>Employee Name kh</th>    
                                    <th>Gender</th> 
                                    <th>Position</th> 
                                    <th></th> 
                                </tr>

                                
                            </thead>
                            <tbody>

                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td></td>
                                    <td>ប៉ើ អ៊ូម៉ើត</td>
                                    <td>M</td>  
                                    <td></td>  
                                    <td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/view/-1")?>">Add Score</a></td>
                                </tr>

                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td></td>
                                    <td>ប៉ើ អ៊ូម៉ើត</td>
                                    <td>M</td>  
                                    <td></td>  
                                    <td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/view/-1")?>">Add Score</a></td>
                                </tr>

                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td></td>
                                    <td>ប៉ើ អ៊ូម៉ើត</td>
                                    <td>M</td>  
                                    <td></td>  
                                    <td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/view/-1")?>">Add Score</a></td>
                                </tr>

                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td></td>
                                    <td>ប៉ើ អ៊ូម៉ើត</td>
                                    <td>M</td>  
                                    <td></td>  
                                    <td><a class="btn btn-block btn-primary" href="<?php echo site_url("$controller_name/view/-1")?>">Add Score</a></td>
                                </tr>
                                
                                
                            </tbody>
                        </table>            
                    </div>
                    
                    <?php if ($pagination) { ?>
                        <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                            <?php echo $pagination; ?>
                        </div>
                    <?php } ?>
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }

    $(document).ready(function()
    {
        initDatePicker("input[name='from_date']");
        initDatePicker("input[name='to_date']");  

    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>

<?php $this->load->view("partial/footer"); ?>