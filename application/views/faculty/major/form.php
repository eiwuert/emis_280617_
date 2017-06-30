<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
    <h1 ><i class="fa fa-pencil"></i> <?php
        if (!$stu_status_info->stu_status_id) {
            echo lang('majors_new');
        } else {
            echo lang('major_update');
        }
        ?>  </h1>
    </div>

    <div class="page-content">
        
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                        <div class="col-xs-12">
                        Fields in red are required    <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h5 class="widget-title">
                                        <span class="icon">
                                            <i class="fa fa-align-justify"></i>                                 
                                        </span>
                                        <?php echo lang("major_basic_information"); ?>
                                    </h5>
                                </div>

                                <div class="widget-body" style="margin-left: 13px;">
                                <br>

                                <?php
                                    echo form_open($controller_name.'/save/' . $major_info->skill_id, array('id' => 'major_form', 'class' => 'form-horizontal'));
                                ?>
                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 "><?php echo lang('major_code')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="major_code" id="major_code" type="text" value="<?php echo $major_info->skill_major_code?>" />
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 "><?php echo lang('major_name')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="major_name" type="text" id="skill_name" value="<?php echo $major_info->skill_name?>" />
                                                        <?php echo form_hidden('original_skill_name', $major_info->skill_name);?>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 "><?php echo lang('major_name_kh')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="major_name_kh" type="text" value="<?php echo $major_info->skill_name_kh?>" />
                                                    </div>
                                                </div> 

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 ">Major Short Word:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="major_short_word" type="text" value="<?php echo $major_info->skill_short_word?>" />
                                                    </div>
                                                </div> 

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('major_faculty')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <?php echo form_dropdown('faculty', $faculty,$major_info->faculty_id, 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('major_degree')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <?php echo form_dropdown('levels', $levels,$major_info->degree_id, 'class="form-control" id="levels"'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 "><?php echo lang('major_duration')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="duration" type="text" value="<?php echo $major_info->duration?>" placeholder='auto' id="duration" readonly=''/>
                                                    </div>
                                                </div>  -->   

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="col-sm-3 col-md-3 col-lg-2"><?php echo lang('major_coordinator')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <?php echo form_dropdown('major_coordinator', $major_coordinator, $major_info->coordinator_id, 'class="form-control"'); ?>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="required col-sm-3 col-md-3 col-lg-2 "><?php echo lang('major_academic_year')?>:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <input class="filter form-control" name="academic_year" type="text" value="<?php echo $major_info->skill_academic_year?>" placeholder='auto'/>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="col-sm-3 col-md-3 col-lg-2">Create Date:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                            <input type="text" id="stu_dob" class="form-control hasDatepicker" name="created_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $person_info->stu_dob != "" ? date('d-m-Y', strtotime($person_info->stu_dob)) : ""; ?>">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="margin-bottom: 10px;">
                                                    <label class="col-sm-3 col-md-3 col-lg-2">Modify Date:</label>    
                                                    <div class="col-sm-9 col-md-9 col-lg-5">
                                                        <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                            <input type="text" id="stu_dob" class="form-control hasDatepicker" name="modify_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $person_info->stu_dob != "" ? date('d-m-Y', strtotime($person_info->stu_dob)) : ""; ?>">
                                                            <span class="input-group-addon">
                                                                <i class="fa fa-calendar"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div> -->        

                                               
                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
                                                    </div>
                                                    <div>
                                                        <input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary pull-right">                
                                                    </div>
                                                </div>

                                </form> 
                                </div>
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
        initDatePicker("input[name='created_date']");
        initDatePicker("input[name='modify_date']");
    });


    $(document).ready(function()
    {
        setTimeout(function(){$(":input:visible:first", "#major_form").focus(); }, 100);
        $('#major_form').validate({
            submitHandler:function(form)
            {
                $.post('<?php echo site_url("$controller_name/check_duplicate"); ?>', {term: $('#major_code').val()}, function(data) {
                    <?php if (!$major_info->skill_id) { ?>
                            if (data.duplicate)
                            {
                                alert('duplicate');
                                end();
                                if (confirm(<?php echo json_encode(lang('major_duplicate_exists')); ?>))
                                {
                                    doMajorSubmit(form);
                                }
                                else
                                {
                                    return false;
                                }
                            }
                    <?php } else  ?>
                {
                    doMajorSubmit(form);
                }}, "json")
                .error(function() {
                });
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
                major_code: "required",
                major_name: "required",
                major_name_kh: "required",
                faculty: "required",
                levels: "required",
                duration: "required",
                major_coordinator: "required",
                academic_year: "required",
                major_short_word: "required",
            },
            messages:
            {
                major_code: <?php echo json_encode(lang('major_code_required')); ?>,
                major_name: <?php echo json_encode(lang('major_namerequired')); ?>,
                major_name_kh: <?php echo json_encode(lang('major_name_khrequired')); ?>,
                faculty: <?php echo json_encode(lang('faculty_required')); ?>,
                levels: <?php echo json_encode(lang('levels_required')); ?>,
                duration: <?php echo json_encode(lang('duration_required')); ?>,
                major_coordinator: <?php echo json_encode(lang('major_coordinator_required')); ?>,
                academic_year: <?php echo json_encode(lang('academic_yearrequired')); ?>,
                major_short_word: <?php echo json_encode('Required Short Word'); ?>,
            }
        });
    });
    var submitting = false;    

    function doMajorSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.skill_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            <?php if (!$major_info->skill_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }

    $(function(){
        $('body').on('change', '#levels', function(e) {
            e.preventDefault();
            var val = $(this).val(),
            url = SITE_URL + "major/get_degree_info";
            $.ajax({
                url: url,
                type: 'POST',
                data: {degree_id: val},
                dataType: 'json',
                success: function(result) {
                    $('#duration').val(result.degree_info.level_duration);
                }
                ,error: function(res){console.log(res.responseText)}
            });
        });     

            return false;
    });
</script>
<?php $this->load->view("partial/footer"); ?>