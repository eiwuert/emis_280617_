<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'><?php echo create_breadcrumb(); ?></div> 
    <div class="page-header" id='page-header'>
        <h1> <i class="icon fa fa-list"></i><?php echo lang('module_student_report'); ?> Report</h1>
    </div>    
    <div class="page-content"> 
        <?php echo form_open("$controller_name/search_report"); ?>
        <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('common_search'); ?></h3>
                    <div class="clearboth"></div>
                </div>
                <br>
                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                    <div class="row col-xs-12">      
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <label class="control-label"><?php echo lang('common_from'); ?></label>
                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                <input type="text" class="form-control hasDatepicker" name="from_month" size="10" placeholder="yyyy-mm" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $fromMonth != "" ? $fromMonth : ""; ?>" required>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </span>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <label class="control-label"><?php echo lang('common_to'); ?></label>
                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                <input type="text" class="form-control hasDatepicker" name="to_month" size="10" placeholder="yyyy-mm" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $toMonth != "" ? $toMonth : ""; ?>" required>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </span>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3" id="faculty">
                            <div class="form-group required">
                                <label class="control-label" for="date_to"> Selection Type</label>
                                <?php echo form_dropdown('type',$selection_type,($v_type)? $v_type:'','class="form-control"')?>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3" id="faculty">
                            <div class="form-group required">
                                <label class="control-label" for="date_to"><?php echo lang('faculty_name'); ?></label>
                                <?php echo form_dropdown('faculty',$select_faculty,($v_faculty)? $v_faculty:'','class="form-control faculty"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3" id="major">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('major'); ?></label>
                                <?php echo form_dropdown('major',$select_major, ($v_major)? $v_major:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('degree'); ?></label>
                                <?php echo form_dropdown('degree',$select_degree, ($v_degree)? $v_degree:'','class="form-control"')?>
                            </div>   
                        </div> 
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('academic_year'); ?></label>
                                <?php echo form_dropdown('section',$selection_section, ($v_section)? $v_section:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('school_class'); ?></label>
                                <?php echo form_dropdown('class',$selection_class, ($v_class)? $v_class:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('room'); ?></label>
                                <?php echo form_dropdown('room',$selection_room, ($v_room)? $v_room:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('common_scholarship'); ?></label>
                                <?php echo form_dropdown('scholarship',$selection_scholarship,($v_scholarship >= 0)? $v_scholarship : '','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('common_table_view'); ?></label>
                                <?php echo form_dropdown('table_type',$selection_table_type,($v_table_type)? $v_table_type : '','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                            <div class="row col-xs-12">
                                <a href="<?php echo site_url("student_report/clear_state")?>" style="margin-left:15px" class="btn btn-active pull-left">Clear</a> 
                                <input type="submit" name="submit" value="Search" style="margin-left:15px" id="submit" class="btn btn-primary"> 
                                <input type="submit" name="submit" value="Print" style="margin-left:15px" id="submit" class="btn btn-primary"> 
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <?php echo form_close();?>
        <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $mainTitle?></h3>
                        <div class="clearboth"></div>
                    </div>
                    <br>
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
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("input[name='from_month']").datepicker({
            format: 'yyyy-mm',
            viewMode: "months", //this
            minViewMode: "months",//and this
            //autoClose:true
        });
        $("input[name='to_month']").datepicker({
            format: 'yyyy-mm',
            viewMode: "months", //this
            minViewMode: "months",//and this
            //autoClose:true
        });
        $('.ui-autocomplete').css('overflow','auto');
        $('.ui-autocomplete').css('overflow-x','hidden');
        $('.ui-autocomplete').css('max-height','400px');
    })
</script>
<script type="text/javascript">
    $(function(){   
        $('select[name="faculty"]').change(function(){            
            var id = $(this).val();
            $.post( "<?php echo site_url("report_employee/suggest_major")?>", { id: id}, function( get_data ) {
                $('select[name="major"]').html('<option> -- -- </option>');
                $.each(get_data,function(key,val){                    
                    var opt = $('<option />'); 
                    opt.val(val.skill_id);
                    opt.text(val.skill_name + '('+val.skill_name_kh+')');
                    $('select[name="major"]').append(opt);
                });
            },"json");
        });
        $('select[name="major"]').change(function(){            
            var id = $(this).val();
            $.post( "<?php echo site_url("report_employee/suggest_faculty")?>", { id: id}, function( get_data ) {
                result = parseInt(get_data);
                $('select[name="faculty"]').val(result);
            });
        });
    });

</script>
<?php $this->load->view("partial/footer"); ?>