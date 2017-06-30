<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-clipboard"></i>
        <?php echo lang('student_score'); ?>
    </h1>
</div>

    <div class="page-content">
       
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                        <div class="col-xs-12">
                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('student_information')?></h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table">   
                                                <tbody>
                                                    <?php echo $manage_student_info?> 
                                                </tbody>
                                            </table>  
                                   </div>
                            </div>

                            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('add_score')?></h3>
                                    <div class="clearboth"></div>
                                </div><br>
                                   
                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                   <?php $stu_id = $stu_info->row()->stu_info_id?>
                                   <?php $stu_acad_id = $stu_info->row()->stu_acad_id?>
                                   <?php $uri_add = isset($result_final_byid->id)? $result_final_byid->id : -1?>
                                    <?php echo form_open("score/add_final/$stu_id/$uri_add", array('id' => 'score_final_form', 'class' => 'form-horizontal')); ?>
                                        <div class="form-group" style="margin-bottom: 10px;">

                                            <div class="col-sm-6 col-xs-12">                                                
                                                <?php echo form_label( lang('semester'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>      
                                                <?php echo form_dropdown('semester', $semester, isset($result_final_byid->semester)? $result_final_byid->semester : '', 'onchange="report(this.value)" id="search_major_id" class="form-control"'); ?>
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_label( lang('subject'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>      
                                           
                                                <?php echo form_dropdown('subject', $subjects, isset($result_final_byid->subject_id)? $result_final_byid->subject_id : '', 'onchange="report(this.value)" id="search_major_id" class="form-control" disabled'); ?>
                                            </div>

                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <h2 class="page-header">    
                                                    <i class="fa fa-info-circle"></i> Attendance
                                                </h2>
                                            </div>
                                         
                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_label( lang('attendance'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>
                                                <?php echo form_input('attendance', isset($result_final_byid->attendance_score)? $result_final_byid->attendance_score : '' , 'class="filter form-control" min="0" max="10"') ?>
                                            </div>
                              
                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <h2 class="page-header">    
                                                    <i class="fa fa-info-circle"></i> Midterm
                                                </h2>
                                            </div>

                                            <div class="col-sm-3 col-xs-12">
                                                <?php echo form_label( lang('gorup_discustion'). ':', array('class' => 'col-sm-12 col-xs-12 no-padding')); ?>
                                                <?php echo form_input('group_discusion', isset($result_final_byid->midterm_group_discussion_score)? $result_final_byid->midterm_group_discussion_score : '' , 'class="filter form-control" min="0" max="40"') ?>
                                            </div>

                                            <div class="col-sm-3 col-xs-12">
                                                <?php echo form_label( lang('quize'). ':', array('class' => 'col-sm-12 col-xs-12 no-padding')); ?>
                                                <?php echo form_input('quize', isset($result_final_byid->midterm_quiz_score)? $result_final_byid->midterm_quiz_score : '' , 'class="filter form-control" min="0" max="40" ') ?>
                                            </div>

                                            <div class="col-sm-3 col-xs-12">
                                                <?php echo form_label( lang('assignment'). ':', array('class' => 'col-sm-12 col-xs-12 no-padding')); ?>
                                                <?php echo form_input('assignment', isset($result_final_byid->midterm_assignment_score)? $result_final_byid->midterm_assignment_score : '' , 'class="filter form-control" min="0" max="40"') ?>
                                            </div>

                                            <div class="col-sm-3 col-xs-12">
                                                <?php echo form_label( lang('exam'). ':', array('class' => 'col-sm-12 col-xs-12 no-padding')); ?>
                                                <?php echo form_input('exam', isset($result_final_byid->midterm_exam_score)? $result_final_byid->midterm_exam_score : '' , 'class="filter form-control" min="0" max="40"') ?>
                                            </div>


                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <h2 class="page-header">    
                                                    <i class="fa fa-info-circle"></i> <?php echo lang('final')?>
                                                </h2>
                                            </div>

                                            <div style="width:100%;overflow:auto">
                                                <div class="col-sm-4 col-xs-12">
                                                     <?php echo form_label( lang('final'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>
                                                    <?php echo form_input('final', isset($result_final_byid->final_score)? $result_final_byid->final_score : '' , 'class="filter form-control" min="0" max="50" ') ?>
                                                </div>
                                            </div>

                                            <div class="form-actions" style="margin-top:0px;margin-bottom:0px;">
                                                <div>
                                                    <?php echo form_hidden('student_acad_id',$stu_acad_id)?>
                                                    <?php echo form_hidden('student_skill_id',$input_skill_id)?>
                                                    <?php echo form_hidden('student_grade',$input_grade)?>
                                                    <?php echo form_hidden('student_room',$student_room)?>
                                                </div>
                                                <div class="pull_right red">
                                                    <h4>Re-Exam : &nbsp;&nbsp;
                                                    <input type="checkbox" class="pull-left" style="margin-right:10px" name="re_exam" value="1" <?php echo (($result_final_byid->ch_re_exam > 0)? 'checked' : '')?> /></h4>
                                                </div>
                                                <br><br>
                                                <div class="pull_right red">
                                                    <h5>Score from other school : &nbsp;&nbsp;
                                                    <input type="checkbox" class="pull-left" style="margin-right:10px" name="score_other_school" value="1" <?php echo (($result_final_byid->ch_score_other_school > 0)? 'checked' : '')?> /></h5>
                                                </div>
                                                <br><br>
                                                <div>
                                                    <input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary pull-right">                
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>    

                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                    <div class="box-header with-border">
                                        <h3 class="box-title blue"><i class="fa fa-search"></i> Semester I</h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table table-striped table-bordered">   
                                                    <tr>
                                                        <th><label><?php echo lang('subject')?></label></th>
                                                        <th><label><?php echo lang('attendance')?></label></th>
                                                        <th><label><?php echo lang('midterm')?></label></th>
                                                        <th><label><?php echo lang('final')?></label></th>
                                                        <th><label><?php echo lang('common_total')?></label></th>
                                                        <th><label><?php echo lang('grade')?></label></th>
                                                        <th><label><?php echo lang('rang')?></label></th>
                                                        <th></th>
                                                    </tr>
                                                    <?php echo $manage_result_sco_final1?>
                                            </table>  
                                   </div>
                                   <!--./end box-body-->
                            </div>

                                    <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                            <div class="box-header with-border">
                                                <h3 class="box-title red"><i class="fa fa-search"></i> Re-Exam Semester I</h3>
                                                <div class="clearboth"></div>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                    <table class="table table-striped table-bordered">   
                                                            <tr>
                                                                <th><label><?php echo lang('subject')?></label></th>
                                                                <th><label><?php echo lang('attendance')?></label></th>
                                                                <th><label><?php echo lang('midterm')?></label></th>
                                                                <th><label><?php echo lang('final')?></label></th>
                                                                <th><label><?php echo lang('common_total')?></label></th>
                                                                <th><label><?php echo lang('grade')?></label></th>
                                                                <th><label><?php echo lang('rang')?></label></th>
                                                                <th></th>
                                                            </tr>
                                                            <?php echo $manage_result_sco_re_final1?>
                                                    </table>  
                                           </div>
                                           <!--./end box-body-->
                                    </div>

                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                    <div class="box-header with-border">
                                        <h3 class="box-title blue"><i class="fa fa-search"></i> Semester II</h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table table-striped table-bordered">   
                                                    <tr>
                                                        <th><label><?php echo lang('subject')?></label></th>
                                                        <th><label><?php echo lang('attendance')?></label></th>
                                                        <th><label><?php echo lang('midterm')?></label></th>
                                                        <th><label><?php echo lang('final')?></label></th>
                                                        <th><label><?php echo lang('common_total')?></label></th>
                                                        <th><label><?php echo lang('grade')?></label></th>
                                                        <th><label><?php echo lang('rang')?></label></th>
                                                        <th></th>
                                                    </tr>                                                    
                                                    <?php echo $manage_result_sco_final2?>
                                            </table>  
                                   </div>
                                   <!--./end box-body-->
                            </div>

                                    <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                            <div class="box-header with-border">
                                                <h3 class="box-title red"><i class="fa fa-search"></i> Re-Exam Semester II</h3>
                                                <div class="clearboth"></div>
                                            </div>
                                            <div class="box-body table-responsive no-padding">
                                                    <table class="table table-striped table-bordered">   
                                                            <tr>
                                                                <th><label><?php echo lang('subject')?></label></th>
                                                                <th><label><?php echo lang('attendance')?></label></th>
                                                                <th><label><?php echo lang('midterm')?></label></th>
                                                                <th><label><?php echo lang('final')?></label></th>
                                                                <th><label><?php echo lang('common_total')?></label></th>
                                                                <th><label><?php echo lang('grade')?></label></th>
                                                                <th><label><?php echo lang('rang')?></label></th>
                                                                <th></th>
                                                            </tr>
                                                            <?php echo $manage_result_sco_re_final2?>
                                                    </table>  
                                           </div>
                                           <!--./end box-body-->
                                    </div>

                        
                        </div>
                    <!-- End -->


                </div> 
            </div> 
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    });
    $(function(){
        $('[name="semester"]').change(function(){
            var semester_id = $(this).val();
            var skill_id = "<?php echo $skill_id?>";
            var level_yar = "<?php echo $level_year?>";
            var url_score = "<?php echo site_url("score/suggest_subject")?>";
            var dataSemester = { semester_id: semester_id, skill_id: skill_id, level_yar: level_yar};
            $('[name="subject"]').prop('disabled', false);
            $.ajax({
                type: "POST",
                url: url_score, 
                data:dataSemester,
                dataType:"json",
                success: function(get_data){
                    $('[name="subject"]').html('<option> -- Select Subject -- </option>');
                    $.each(get_data,function(key,val){
                        var opt = $('<option />'); 
                        opt.val(val.sub_id);
                        opt.text(val.subject_name);
                        $('[name="subject"]').append(opt);
                    });
                },
            });
        });
    });
</script>

<script type='text/javascript'>
    $(document).ready(function()
    {  
        setTimeout(function(){$(":input:visible:first", "#score_final_form").focus(); }, 100);
        $('#score_final_form').validate({
            submitHandler:function(form)
            {
                scoreSubmit(form);
            },
            errorClass: "text-danger",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            },
            rules:
            {
                subject: "required",
                semester: "required",
            },
            messages:
            {
                subject: <?php echo json_encode(lang('subject_required')); ?>,
                semester: <?php echo json_encode(lang('semester_required')); ?>,
            }
            
        });
    });
    //submit faile
    var submitting = false;
    function scoreSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.success : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name/form/$stu_acad_id"); ?>'
                }
            },
            <?php if (!$result_final_byid->id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>