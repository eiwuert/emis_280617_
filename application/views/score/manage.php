
<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function (){
        var table_columns = '';
        enable_sorting("<?php echo site_url("$controller_name/sorting"); ?>", table_columns, <?php echo $per_page; ?>, <?php echo json_encode($order_col); ?>, <?php echo json_encode($order_dir); ?>);
        enable_codeMajor('<?php echo site_url("$controller_name/suggest_code_major"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_search('<?php echo site_url("$controller_name/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_select_all();
    });
</script>

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
                        <div class="col-xs-12">

                                <?php echo form_open('score/search_student'); ?>
                                        <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-search"></i> <?php echo "Search Students "?></h3>
                                                <div class="clearboth"></div>
                                            </div><br>

                                            <div class="form-group col-xs-12 col-lg-12 col-lg-12">

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('code_major'). ':', 'fees_collect_major_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <input style="width: 100%;" type="text" id="search_major_code" name="major_code" value="" placeholder='Code Major'/>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('major_name'). ':', 'fees_collect_major_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('major_name', $major, '', 'onchange="report(this.value)" id="search_major_id" class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('year'). ':', 'fees_collect_year', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('year', $year, '', 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('batch'). ':', 'fees_collect_batch', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('batch', $batches, '', 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('period'). ':', 'fees_collect_period', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('period', $period, '', 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('degree'). ':', 'fees_collect_degree', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('degree', $degree, '', 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label(lang('semester'). ':', 'fees_collect_semester', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('semester', $semester, '', 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('schedule'). ':', 'fee_collect_schedule', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('schedule', $schedule, '', 'class="form-control"'); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label(lang('room'). ':', 'fees_collect_room', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('room', $room, '', 'class="form-control"'); ?>
                                                </div>

                                                <a href="<?php echo site_url("score/clear_state")?>" style="margin-left:15px" class="btn btn-active pull-left">Clear</a>
                                                <input type="submit" name="submit" value="Search" style="margin-left:15px" id="submit" class="btn btn-primary">

                                            </div>
                                        </div>
                                </form>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12">
                                        <?php echo form_open('score/print_list','id="submit_print"'); ?>
                                            <input id="print_pre" class="btn btn-success pull-right" name="pre" type="submit" value="Print List Score">
                                            <?php echo form_hidden('stu_print')?>
                                        </form>
                                    </div>
                                </div>
                                <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-users"></i> Student Details</h3>
                                            <!-- <div class="box-tools pull-right"><a style="margin: 6px 10px;" class="btn btn-sm btn-warning" href="" target="_blank" style="color:#fff" data-method="POST"><i class="fa fa-file-pdf-o"></i> Generate PDF</a></div> -->
                                                <div class="box-tools pull-right" style="padding-top:8px;">
                                                    <?php echo form_open("$controller_name/search_student", array('id' => '', 'autocomplete' => 'on')); ?>
                                                        <input type="text" name ='search' id='search' value="<?php echo H($search); ?>"   placeholder="<?php echo lang('common_search'); ?> <?php echo lang('module_' . $controller_name); ?>"/>
                                                    <?php echo form_close(); ?>
                                                </div>
                                            <div class="clearboth"></div>
                                        </div>

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
    var ca = "<?php echo site_url('score/get')?>";
        $.post(ca,{ id : period },
        function(data){
            $( "#search_major_code" ).val(data);
        });
    }
    $(document).ready(function(){
        $("#submit_print").submit(function(){
            var row_ids = get_selected_values();
            $("input[name=stu_print]").val(row_ids);
        });
    });
</script>

<?php $this->load->view("partial/footer"); ?>
