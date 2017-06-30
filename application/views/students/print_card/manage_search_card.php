
<?php $this->load->view("partial/header"); ?>
<script type="text/javascript">
    $(document).ready(function (){
        enable_codeMajor('<?php echo site_url("$controller_name/suggest_code_major"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>);
        enable_search('<?php echo site_url("$controller_name/suggest"); ?>',<?php echo json_encode(lang("common_confirm_search")); ?>); 
        enable_select_all();
        enable_checkboxes();
        enable_row_selection();
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
                                           
                                <?php echo form_open('student_print_form/search_student'); ?>
                                        <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><i class="fa fa-search"></i> Search Students</h3>
                                                <div class="clearboth"></div>
                                            </div><br>
                                               
                                            <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                               
                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('code_major'). ':', 'fees_collect_major_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <input style="width: 100%;" type="text" id="search_major_code" name="major_code" value="" placeholder='Code Major' />
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('major_name'). ':', 'fees_collect_major_id', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('major_name', $major, '', 'onchange="report(this.value)" id="search_major_id" class="form-control" '); ?>
                                                    <!-- <input style="width: 100%;" type="text" name="major" value="" placeholder='Major'/> -->
                                                </div>


                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('year'). ':', 'year', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('year', $year, '', 'class="form-control" '); ?>                                                                
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('batch'). ':', 'fees_collect_degree', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('batch', $batches, '', 'class="form-control" '); ?>
                                                </div>

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('period'). ':', 'period', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('period', $period, '', 'class="form-control" '); ?>                                                                                                                        
                                                </div> 

                                                <div class="col-sm-4 col-xs-12">
                                                    <?php echo form_label( lang('degree'). ':', 'fees_collect_degree', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_dropdown('degree', $degree, '', 'class="form-control"  '); ?>
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
                                                
                                                <div class="row col-xs-12">
                                                	<a href="<?php echo site_url("student_print_form/clear_state")?>" style="margin-left:15px" class="btn btn-active pull-left">Clear</a> 
                                                	<input type="submit" name="submit" value="Search" style="margin-left:15px" id="submit" class="btn btn-primary">	
                                                </div>
                                            </div>

                                        </div>
                                </form>

                                
                                    <div class="box box-solid box-info col-xs-12 col-lg-12">                                        
                                        <div class="row box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-search"></i> Student Print Type</h3>
                                            <div class="clearboth"></div>
                                        </div><br>
                                        <div style="padding:10px" class="col-xs-12 col-lg-12 col-lg-12">  

                                                    <div>
                                                      <!-- Nav tabs -->
                                                      <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">Card</a></li>
                                                        <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">Diploma</a></li>
                                                        <li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">Teporaty Certificate</a></li>
                                                        <li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">General English Certify</a></li>
                                                        <li role="presentation"><a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab">Foundation Year</a></li>
                                                        <li role="presentation"><a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab">Academic Confirmation</a></li>
                                                        <li role="presentation"><a href="#tab7" aria-controls="tab7" role="tab" data-toggle="tab">Transcript English</a></li>
                                                      </ul>

                                                      <!-- Tab panes -->
                                                      <div class="tab-content col-sm-12 col-xs-12">
                                                        <div role="tabpanel" class="tab-pane active" id="tab1">
                                                                <?php echo form_open("$controller_name/add_card")?>
                                                                    <input type="hidden" name="id_stu" value="">
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('&nbsp;', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control btn btn-success" type="submit" value="Print Card">
                                                                    </div>
                                                                <?php echo form_close()?>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="tab2">
                                                                <?php echo form_open("$controller_name/add_diploma")?>
                                                                  <input type="hidden" name="id_stu" value="">
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Date out president:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                                            <input type="text" class="form-control hasDatepicker" name="date_out_president" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                        <div class="help-block"></div>
                                                                    </div> 
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Date out chairman of the board:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                                            <input type="text" class="form-control hasDatepicker" name="date_out_chairman_of_the_board" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                        <div class="help-block"></div>
                                                                    </div> 
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Date Aproved:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                                            <input type="text" class="form-control hasDatepicker" name="aproved_date" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                        <div class="help-block"></div>
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('ID Diploma: (Start From)', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="number" name="id_diploma" value="">
                                                                    </div>

                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('&nbsp;', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control btn btn-success" type="submit" value="Print Certificate">
                                                                    </div>
                                                                                                                                                                                                               
                                                                <?php echo form_close()?>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="tab3">
                                                                <?php echo form_open("$controller_name/teporaty_certificte")?>
                                                                  <input type="hidden" name="id_stu" value="">
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Date Exam:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                                            <input type="text" id="date_exam" class="form-control hasDatepicker" name="date_exam" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                        <div class="help-block"></div>
                                                                    </div>

                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Date Out:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date-format="dd-mm-yyyy">
                                                                            <input type="text" class="form-control hasDatepicker" name="date_out_teporaty_certificte" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                        <div class="help-block"></div>
                                                                    </div>

                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('ID Temporaty Certificate: (Start From)', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="number" name="id_temporaty_certificate" value="">
                                                                    </div>

                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('&nbsp;', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control btn btn-success" type="submit" value="Teporaty Certificte">
                                                                    </div>   
                                                                <?php echo form_close()?>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="tab4">
                                                                <?php echo form_open("$controller_name/general_english_certify")?>         
                                                                  <input type="hidden" name="id_stu" value="">

                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Year to Year:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                                            <input type="text" id="english_certify_date" class="form-control hasDatepicker" name="english_certify_date" size="10" placeholder="Date Exam" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                        <div class="help-block"></div>
                                                                    </div>

                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Year to Year:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="text" name="year_to_year" value=""/>
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Level English:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="number" name="english_level" value=""/>
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('&nbsp;', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control btn btn-success" type="submit" value="General English Certify">
                                                                    </div>   
                                                                <?php echo form_close()?>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane" id="tab5">
                                                                <?php echo form_open("$controller_name/foundation_year")?> 
                                                                    <input type="hidden" name="id_stu" value="">
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Year to Year:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class='form-control' type="text" name="year_to_year" value="" placeholder="2016-2017">
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Year to Year (KH):', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class='form-control' type="text" name="year_to_year_kh" value="" placeholder="២០១៣~២០១៤">
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('&nbsp;', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control btn btn-success" type="submit" value="Foundation Year">
                                                                    </div>                                                                  
                                                                <?php echo form_close()?>
                                                        </div>

                                                        <div role="tabpanel" class="tab-pane" id="tab6">
                                                                <?php echo form_open("$controller_name/academic_confirmation")?>
                                                                    <input type="hidden" name="id_stu" value=""> 
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Year to Year:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="text" name="year_to_year" value="" placeholder="2016-2017">
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Year to Year (KH):', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="text" name="year_to_year_kh" value="" placeholder="២០១៣~២០១៤">
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('ID Academic Confirmation: (Start From)', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="number" name="id_academic_confirm" value="">
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Date Transcript:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date="">
                                                                            <input type="text" class="form-control hasDatepicker" name="date_out_academic_confirmation" value=""/>
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                    </div>

                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('&nbsp;', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control btn btn-success" type="submit" value="Academic Confirmation">
                                                                    </div>                                                                
                                                                <?php echo form_close()?>
                                                        </div>

                                                        <div role="tabpanel" class="tab-pane" id="tab7">
                                                                <?php echo form_open("$controller_name/transcript_eng")?> 
                                                                    <input type="hidden" name="id_stu" value="">
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('ID Transcript: (Start From)', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control" type="number" name="id_transcript" value="">
                                                                    </div>
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('Date Transcript:', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                                            <input type="text" id="english_certify_date" class="form-control hasDatepicker" name="transcript_on_date" size="10" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="">
                                                                            <span class="input-group-addon">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </span>
                                                                        </span>
                                                                        <div class="help-block"></div>
                                                                    </div>  
                                                                    <div class="col-sm-4 col-xs-12">
                                                                        <?php echo form_label('&nbsp;', array('class' => 'col-sm-12 col-xs-12')); ?>
                                                                        <input class="form-control btn btn-success" type="submit" value="Foundation Year">
                                                                    </div>                                     
                                                                <?php echo form_close()?>
                                                        </div>
                                                      </div>

                                                    </div>
                                        </div>

                                    </div>



                                <br/>

                                <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"><i class="fa fa-users"></i> Student Details</h3>
                                            	                                           	
	                                                <div class="pull-right" style="padding-top:8px; padding-right:8px">
	                                                    <?php echo form_open("$controller_name/search_student", array('id' => '', 'autocomplete' => 'on')); ?>
	                                                        <input class="pull-right" type="text" name ='search' id='search' value="<?php echo H($search); ?>"   placeholder="<?php echo lang('common_search'); ?> <?php echo lang('module_' . $controller_name); ?>"/>
	                                                    <?php echo form_close(); ?>
	                                                </div>    
                                                                                                   
                                            <div class="clearboth"></div>
                                        </div>
                                       <div class="box-body table-responsive no-padding">     
                                       			<?php echo ($manage_student)? $manage_student : ''?>
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
var initDatePicker = function(elem)
    {
        $(elem).ionDatePicker();
    }
$(document).ready(function(){	
        initDatePicker("input[name='date_exam']");
        initDatePicker("input[name='transcript_on_date']");
        initDatePicker("input[name='aproved_date']");
        initDatePicker("input[name='english_certify_date']");
        initDatePicker("input[name='date_out_academic_confirmation']");
        initDatePicker("input[name='date_out_president']");
        initDatePicker("input[name='date_out_chairman_of_the_board']");
        initDatePicker("input[name='date_out_teporaty_certificte']");
	    $("form").submit(function(){
	        var row_ids = get_selected_values();
	        $("input[name=id_stu]").val(row_ids);
	        $("input[name=id_stu]").val(row_ids);                                                  
	    });
	
});

function report(period) {
    var ca = "<?php echo site_url('student_print_form/get')?>";
    $.post(ca,{ id : period },
    function(data){ 
        $( "#search_major_code" ).val(data);
    });
}
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>


<div class="test"></div>
<?php $this->load->view("partial/footer"); ?>