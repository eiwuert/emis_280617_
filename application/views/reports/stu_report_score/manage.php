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
                    
                        <div class="col-xs-12 col-sm-3 col-lg-3" id="faculty">
                            <div class="form-group required">
                                <label class="control-label" for="date_to"><?php echo lang('faculty_name'); ?></label>
                                <?php echo form_dropdown('faculty',$select_faculty,($post['faculty'])? $post['faculty']:'','class="form-control faculty"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3" id="major">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('major'); ?></label>
                                <?php echo form_dropdown('major',$select_major, ($post['major'])? $post['major']:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('batch'); ?></label>
                                <?php echo form_dropdown('batch',$select_batch, ($post['batch'])? $post['batch']:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('degree'); ?></label>
                                <?php echo form_dropdown('degree',$select_degree, ($post['degree'])? $post['degree']:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('semester'); ?></label>
                                <?php echo form_dropdown('semester',$selection_semester, ($post['semester'])? $post['semester']:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('grade'); ?></label>
                                <?php echo form_dropdown('grade',$selection_grade, ($post['grade'])? $post['grade']:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('academic_year'); ?></label>
                                <?php echo form_dropdown('section',$selection_section, ($post['section'])? $post['section']:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('school_class'); ?></label>
                                <?php echo form_dropdown('class',$selection_class, ($post['class'])? $post['class']:'','class="form-control"')?>
                            </div>   
                        </div>

                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('room'); ?></label>
                                <?php echo form_dropdown('room',$selection_room, ($post['room'])? $post['room']:'','class="form-control"')?>
                            </div>   
                        </div>
                        <div class="col-xs-12 col-sm-3 col-lg-3">
                            <div class="form-group required">
                                <label class="control-label"><?php echo lang('subject'); ?></label>
                                <?php echo form_dropdown('subject',$selection_subject, ($post['subject'])? $post['subject']:'','class="form-control subject"')?>
                            </div>   
                        </div>

                        <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                            <div class="row col-xs-12">
                                <a href="<?php echo site_url("student_report_score/clear_state")?>" style="margin-left:15px" class="btn btn-active pull-left">Clear</a> 
                                <input type="submit" name="submit" value="Search" style="margin-left:15px" id="submit" class="btn btn-primary"> 
                                <input type="submit" name="submit" value="Print Excel" style="margin-left:15px" id="submit" class="btn btn-primary"> 
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
        $('.ui-autocomplete').css('overflow','auto');
        $('.ui-autocomplete').css('overflow-x','hidden');
        $('.ui-autocomplete').css('max-height','400px');
    })
</script>
<script type="text/javascript">
    $(function(){   
        $('select[name="faculty"]').change(function(){         
            var id = $(this).val();
            $.post( "<?php echo site_url("student_report_score/suggest_major")?>", { id: id}, function( get_data ) {
                $('select[name="major"]').html('<option> -- -- </option>');
                $.each(get_data,function(key,val){                    
                    var opt = $('<option />'); 
                    opt.val(val.skill_id);
                    opt.text(val.skill_name + '('+val.skill_name_kh+')');
                    $('select[name="major"]').append(opt);
                });
            },"json"); 
            chanageSubject();          
        });
        $('select[name="major"]').change(function(){            
            var id = $(this).val();
            $.post( "<?php echo site_url("student_report_score/suggest_faculty")?>", { id: id}, function( get_data ) {
                result = parseInt(get_data);
                $('select[name="faculty"]').val(result);
            });            
            chanageSubject(); 
        });
        $('select[name="grade"]').change(function(){
            chanageSubject(); 
        });        
        $('select[name="semester"]').change(function(){
            chanageSubject(); 
        });
    });
    function chanageSubject(){
        var major = $('select[name="major"]').val();
        var grade = $('select[name="grade"]').val();
        var semester = $('select[name="semester"]').val();

        $.post( "<?php echo site_url("student_report_score/suggest_subject")?>", { major: major, grade: grade, semester: semester}, function( get_data ) {
            $('.subject').html('<option> -- -- </option>');
            $.each(get_data,function(key,val){                    
                var opt = $('<option />'); 
                    opt.val(val.sub_id);
                    opt.text(val.subject_name + '('+val.subject_name_kh+')');
                    $('.subject').append(opt);
            });
        },"json");
    }

</script>
<?php $this->load->view("partial/footer"); ?>