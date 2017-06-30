<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function (){
        var table_columns = '';
        // enable_sorting("<?php echo site_url("$controller_name/sorting"); ?>", table_columns, <?php echo $per_page; ?>, <?php echo json_encode($order_col); ?>, <?php echo json_encode($order_dir); ?>);
        enable_codeMajor('<?php echo site_url("$controller_name/suggest_code_major"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_search('<?php echo site_url("$controller_name/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>); 
        enable_select_all();
        enable_checkboxes();
        enable_row_selection();
    });
</script>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
</div>

    <div class="page-content">
        
        <div class="row">
            <div class="col-xs-30"> 
                <div class="widget-box" id="widgets"> 
                        <div class="col-xs-12">
                            <?php echo form_open("$controller_name/search_student"); ?>

                                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('common_search')?></h3>
                                                <div class="clearboth"></div>
                                            </div><br>
                                               
                                            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('code_major'). ':', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <input style="width: 100%;" type="text" id="search_major_code" name="major_code" value="<?php echo $v_post['major_code']?>" placeholder='Code Major' />
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('major_name'). ':', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('major_name', $major, $v_post['major_name'], 'onchange="report(this.value)" id="search_major_id" class="form-control" '); ?>
                                                </div>
                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('year'). ':', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('year', $year, $v_post['year'], 'class="form-control" '); ?>                                                                
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('batch'). ':', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('batch', $batches, $v_post['batch'], 'class="form-control" '); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('period'). ':', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('period', $period, $v_post['period'], 'class="form-control" '); ?>                                                                                                                        
                                                </div> 

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('degree'). ':', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('degree', $degrees, $v_post['degree'], 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('scholarship'). ':', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('scholarship', $scholarship, $v_post['scholarship'], 'class="form-control"'); ?>
                                                </div>

                                                <div class="row col-xs-12">
                                                    <a href="<?php echo site_url("$controller_name/clear_state")?>" style="margin-left:15px" class="btn btn-active pull-left">Clear</a> 
                                                    <input type="submit" name="submit" value="Search" style="margin-left:15px" id="submit" class="btn btn-primary"> 
                                                </div>
                                            </div>
                            </form>
                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1%">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-users"></i> Student Details</h3>   
                                                <div class="pull-right" style="padding-top:8px; padding-right:8px">
                                                    <?php echo form_open("$controller_name/search", array('id' => 'search_form', 'autocomplete' => 'on')); ?>
                                                        <input class="pull-right" type="text" name ='search' id='search' value="<?php echo H($search); ?>" placeholder="<?php echo lang('common_search'); ?> <?php echo lang('module_' . $controller_name); ?>"/>
                                                    <?php echo form_close(); ?>
                                                </div>    
                                                                                               
                                        <div class="clearboth"></div>
                                    </div>


                                    <!-- Start -->
                                    <div class="widget-content nopadding table_holder table-responsive" >
                                        <?php echo $manage_table; ?>         
                                    </div>                                                      
                                    <?php if ($pagination) { ?>
                                        <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                                            <?php echo $pagination; ?>
                                        </div>
                                    <?php } ?>  
                            </div>                                                              
                        </div>
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
    function report(period) {
        var ca = "<?php echo site_url('fees_collection/get')?>";
        $.post(ca,{ id : period },
        function(data){ 
            $( "#search_major_code" ).val(data);
        });
    }
</script>

<?php $this->load->view("partial/footer"); ?>