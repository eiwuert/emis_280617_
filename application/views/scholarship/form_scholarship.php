<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php
        if (!$info->scho_id) {
            echo lang('scholarship_new');
        } else {
            echo lang('scholarship_update');
        }
        ?>
    </h1>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <div class="col-xs-12">
                        <?php echo lang('common_fields_required_message'); ?>
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat widget-header-small">
                                <h5 class="widget-title">
                                    <span class="icon">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                   	<?php echo lang('scholarship_basic_information'); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <?php
                                echo form_open($controller_name.'/save/' . $info->scho_id, array('id' => 'scholarship_form', 'class' => 'form-horizontal'));
                                ?>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('scholarship_scholarship_from') . ':', 'scholarship_from', array('class' => 'col-sm-3 col-md-3 col-lg-3 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'scholarship_from',
                                                'id' => 'scholarship_from',
                                                'class' => 'form-control',
                                                'value' => $info->scholarship_from));
                                            echo form_hidden('original_scholarship_from', $info->scholarship_from);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('scholarship_scholarship_from_kh') . ':', 'scholarship_from_kh', array('class' => 'col-sm-3 col-md-3 col-lg-3 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            echo form_input(array(
                                                'name' => 'scholarship_from_kh',
                                                'id' => 'scholarship_from_kh',
                                                'class' => 'form-control',
                                                'value' => $info->scholarship_from_kh));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('scholarship_started_date') . ':', 'started_date', array('class' => 'col-sm-3 col-md-3 col-lg-3 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                <input type="text" id="started_date" class="form-control hasDatepicker" name="started_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1940-2235" data-lang="en" value="<?php echo $date = $info->started_date != "" ? date('d-m-Y', strtotime($info->started_date)) : date('d-m-Y'); ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('scholarship_degree') . ':', 'degree', array('class' => 'col-sm-3 col-md-3 col-lg-3 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            $selected_degree = explode(",", $info->degree);
                                            echo form_dropdown(
                                                'degree',
                                                $degree,
                                                $selected_degree,
                                                'class="form-control" multiple="multiple" id="degree"'
                                            );
                                             echo form_hidden('hide_degree','');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label(lang('common_major') . ':', 'major', array('class' => 'col-sm-3 col-md-3 col-lg-3 control-label')); ?>
                                        <div class="col-sm-9 col-md-9 col-lg-5">
                                            <?php
                                            $selected_major = explode(",", $info->major);
                                            echo form_dropdown(
                                                'major',
                                                $major,
                                                $selected_major,
                                                'class="form-control sb-major" multiple="multiple" id="major"'
                                            );
                                            echo form_hidden('hide_major');
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/scholarship")?>">Cancel</a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary pull-right">
                                        </div>
                                    </div>
                                </form>
                            </div>
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

        initDatePicker("#started_date");
        initSomuSelect('.sb-major');
        initSomuSelect('#degree');

        setTimeout(function(){$(":input:visible:first", "#scholarship_form").focus(); }, 100);
        $('#scholarship_form').validate({
            submitHandler:function(form)
            {
                doScholarshipSubmit(form);
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
                scholarship_from: "required",
                major: "required",
                degree: "required",
            },
            messages:
            {
                scholarship_from: <?php echo json_encode(lang('course_name_kh_required')); ?>,
                major: <?php echo json_encode(lang('course_major_required')); ?>,
                degree: <?php echo json_encode(lang('course_degree_required')); ?>
            }
        });
    });

    var submitting = false;
    function doScholarshipSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        var majors = getSomuSelected('.sb-major')
        $('input[name="hide_major"]').val(majors);
        var degrees = getSomuSelected('#degree')
        $('input[name="hide_degree"]').val(degrees);

        $.ajax({
            url: $(form).attr("action"),
            type: "post",
            dataType: "json",
            data: $(form).serialize(),
            success: function(response) {
                submitting = false;
                if (response.success)
                {
                    $.notify(response.message, "success");
                    window.location.href = '<?php echo site_url("$controller_name/form"); ?>/'+response.id;
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
            ,error:function(response){console.log(response.responseText)}
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>