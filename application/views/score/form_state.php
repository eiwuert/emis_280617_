<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-clipboard"></i>
        <?php echo "State Exam"; ?>
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
                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-search"></i> Student Information</h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table">   
                                                <tbody>
                                                <?php echo $manage_student_info?> 
                                                </tbody>
                                            </table>  
                                   </div>
                                   <!--./end box-body-->
                            </div>

                            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('add_score_state_exam')?></h3>
                                    <div class="clearboth"></div>
                                </div><br>
                                   
                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                    <?php $stu_id = $stu_info->stu_info_id?>
                                    <?php $stu_acad_id = $stu_info->stu_acad_id?>
                                    <?php $uri_add = isset($result_state_byid->id)? $result_state_byid->id : -1?>
                                    <?php echo form_open("score/add_subj_state_exam/$stu_id/$uri_add", array('id' => 'score_state_form', 'class' => 'form-horizontal')); ?>
                                        <div class="form-group" style="margin-bottom: 10px;">
                                            
                                            <!-- 

                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_label( lang('written'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>
                                                <?php echo form_input('written', isset($result_state_byid->thesis_written_score)? $result_state_byid->thesis_written_score : '' , 'class="filter form-control"') ?>
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_label( lang('defence'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>
                                                <span class="input-group date col-sm-12 col-xs-12" data-date-format="dd-mm-yyyy" data-date="">
                                                    <input type="text" id="end_date" class="form-control hasDatepicker" name="defence" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="<?php echo date('Y-m-d',strtotime($result_state_byid->thesis_defence_date))?>">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div> -->


                                            <div class="col-xs-12 col-md-12 col-lg-12">
                                                <h2 class="page-header">    
                                                    <i class="fa fa-info-circle"></i> <?php echo lang('state_exam')?>
                                                </h2>
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_label( lang('subject'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>      
                                                <?php echo form_dropdown('subject', $subjects, isset($result_state_byid->sub_id)? $result_state_byid->sub_id : '', 'onchange="report(this.value)" id="search_major_id" class="form-control"'); ?>
                                            </div>

                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_label( lang('score'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>
                                                <?php echo form_input('score', isset($result_state_byid->score)? $result_state_byid->score : '' , 'class="filter form-control"') ?>
                                            </div>

                                            <div class="form-actions" style="margin-top:0px;margin-bottom:0px;">
                                                <div>
                                                    <?php echo form_hidden('student_acad_id',$stu_acad_id)?>
                                                    <?php echo form_hidden('student_skill_id',$input_skill_id)?>
                                                    <?php echo form_hidden('student_grade',$input_grade)?>
                                                    <?php echo form_hidden('student_room',$student_room)?>
                                                </div>
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
                                        <h3 class="box-title"><i class="fa fa-search"></i> State-Exam</h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table table-striped table-bordered">   
                                                    <tr>
                                                        <th><label><?php echo lang('subject')?></label></th>
                                                        <th><label><?php echo lang('score')?></label></th>
                                                        <th><label><?php echo lang('grade')?></label></th>
                                                        <th><label><?php echo lang('rang')?></label></th>
                                                        <th></th>
                                                    </tr>
                                                    <?php echo $manage_result_sco_state?>
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
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }

    $(document).ready(function()
    {
        initDatePicker("input[name='defence']");  

    });
</script>
<script type='text/javascript'>

    $(document).ready(function()
    {  
        setTimeout(function(){$(":input:visible:first", "#score_state_form").focus(); }, 100);
        $('#score_state_form').validate({
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
                score: "required",
                written: "required",
                defence: "required",
            },
            messages:
            {
                subject: <?php echo json_encode(lang('subject_required')); ?>,
                score: <?php echo json_encode(lang('score_required')); ?>,
                written: <?php echo json_encode(lang('written_required')); ?>,
                defence: <?php echo json_encode(lang('defence_required')); ?>,
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
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.score : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name/state_exam/$stu_acad_id"); ?>'
                }
            },
            <?php if (!$result_state_byid->id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>