
<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function (){
        enable_codeMajor('<?php echo site_url("$controller_name/suggest_code_major"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_search('<?php echo site_url("$controller_name/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_select_all();
    });
</script>

<div class="test"></div>

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
                                           
                                <?php echo form_open('subjects/search_subjects'); ?>
                                        <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo "Search Subjects" ?></h3>
                                                <div class="clearboth"></div>
                                            </div><br>
                                               
                                            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                               
                                                
                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('code_major'). ':', 'fees_collect_major_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <input style="width: 100%;" type="text" id="search_major_code" name="major_code" value="" placeholder='Code Major' required="" />
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('major_name'). ':', 'fees_collect_major_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('major_name', $major, '', 'onchange="report(this.value)" id="search_major_id" class="form-control" required'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label('Credit:', 'credit', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <input style="width: 100%;" type="text" name="credit" value=""/>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <?php echo form_label('Semester:', 'semester', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('semester', $semester, '', 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <?php echo form_label( lang('year'). ':', 'fees_collect_year', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('grade', $grade, '', 'class="form-control"'); ?>                                                                
                                                </div>


                                                <div class="col-sm-12 col-xs-12">
                                                    <a href="<?php echo site_url("score/clear_state")?>" style="margin-left:15px" class="btn btn-active pull-left">Clear</a> 
                                                    <input type="submit" name="submit" value="Search" style="margin-left:15px" id="submit" class="btn btn-primary"> 
                                                </div>
                                            </div>
                                        </div>
                                </form>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <?php echo form_open('subjects/view_subject_print','id="submit_print"'); ?>
                                            <input id="print_pre" class="btn btn-success pull-right" name="pre" type="submit" value="Print List subject">
                                            <?php echo form_input('subj_print')?>                                        
                                        </form>
                                    </div>
                                </div>
                                <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-users"></i> Subject Details</h3>
                                            <div class="clearboth"></div>
                                        </div>
                                       <div class="box-body table-responsive no-padding">
                                            <table class="table table-striped" id="sortable_table">
                                                <tbody>
                                                    <tr>
                                                        <th><?php echo lang('common_no')?></th>
                                                        <th><?php echo lang('subjects')?></th>
                                                        <th><?php echo "credit"?></th>
                                                        <th><?php echo lang('semester')?></th>
                                                        <th><?php echo lang('year')?></th>
                                                    </tr>
                                                    <?php echo ($manage_subject_search)? $manage_subject_search : ''?>
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

<script type="text/javascript">

function report(period) {
    var ca = "<?php echo site_url('score/get')?>";
        $.post(ca,{ id : period },
        function(data){ 
            $( "#search_major_code" ).val(data);
        });
    } 
    $(document).ready(function(){   
        $("#submit_print").submit(function(){
            var row_ids = get_selected_values();
            $("input[name=subj_print]").val(row_ids);                                                     
        });        
    });  
</script>


<div class="test"></div>
<?php $this->load->view("partial/footer"); ?>