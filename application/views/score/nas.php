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
                                    <h3 class="box-title"><i class="fa fa-search"></i> NAS</h3>
                                    <div class="clearboth"></div>
                                </div><br>
                                   
                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">  
                                   <?php $stu_id = $stu_info->row()->stu_info_id?>
                                   <?php $stu_acad_id = $stu_info->row()->stu_acad_id?>
                                   <?php $uri_add = isset($result_nas_byid->id)? $result_nas_byid->id : -1?>
                                    <?php echo form_open("score/add_nas/$stu_id/$uri_add", array('id' => 'score_final_form', 'class' => 'form-horizontal')); ?>
                                        <div class="form-group" style="margin-bottom: 10px;">

                                            

                                            <div class="col-sm-12 col-xs-12">
                                                <h2 class="page-header">    
                                                    <i class="fa fa-info-circle"></i> NAS
                                                </h2>
                                            </div>
                                            <div class="col-sm-6 col-xs-12">                                                
                                                <?php echo form_label( lang('semester'). ':', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>      
                                                <?php echo form_dropdown('semester', $semester, isset($result_nas_byid->semester)? $result_nas_byid->semester : '', 'onchange="report(this.value)" id="search_major_id" class="form-control"'); ?>
                                            </div>
                              
                                            <div class="col-sm-6 col-xs-12">
                                                <?php echo form_label('NAS:', array('class' => 'col-sm-12 col-xs-12 required no-padding')); ?>
                                                <?php echo form_input('nas', isset($result_nas_byid->nas)? $result_nas_byid->nas : '' , 'class="filter form-control" min="0" max="10"') ?>
                                            </div>

                                            <br/>
                                            <div class="form-actions" style="margin-top:0px;margin-bottom:0px;">
                                                <div>
                                                    <?php echo form_hidden('student_acad_id',$stu_acad_id)?>
                                                    <?php echo form_hidden('student_skill_id',$input_skill_id)?>
                                                    <?php echo form_hidden('student_grade',$input_grade)?>
                                                    <?php echo form_hidden('student_room',$student_room)?>
                                                </div>
                                                <div>
                                                    <input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary pull-right"/>               
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>    

                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-search"></i> Semester I</h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table table-striped table-bordered">   
                                                    <tr>
                                                        <th><label><?php echo "NAS"?></label></th>
                                                        <th></th>
                                                    </tr>
                                                    <?php echo $manage_result_sco_final1?>
                                            </table>  
                                   </div>
                                   <!--./end box-body-->
                            </div>
                            <div class="box-primary box view-item col-xs-12 col-lg-12 no-padding" style="margin-top:1   %">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><i class="fa fa-search"></i> Semester II</h3>
                                        <div class="clearboth"></div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                            <table class="table table-striped table-bordered">   
                                                    <tr>
                                                        <th><label><?php echo "NAS"?></label></th>
                                                        <th></th>
                                                    </tr>                                                    
                                                    <?php echo $manage_result_sco_final2?>
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
                semester: "required",
            },
            messages:
            {
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
                    window.location.href = '<?php echo site_url("$controller_name/nas/$stu_acad_id"); ?>'
                }
            },
            <?php if (!$result_nas_byid->id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>