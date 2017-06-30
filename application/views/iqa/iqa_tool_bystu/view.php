<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div>
    <div class="page-header" id='page-header'>
        <h1>
        <i class="icon fa fa-list"></i>
            <?php echo lang('iqa_tool'); ?>
        </h1>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">
                    <!-- Start -->
                    <div class="col-xs-12">
                        <?php echo form_open($controller_name.'/save/' . $iqa_result_info->id, array('id' => 'iqa_tool_form', 'class' => 'form-horizontal'));
                        ?>
                            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-search"></i> <?php echo lang('iqa_tool'); ?></h3>
                                    <div class="clearboth"></div>
                                </div>

                                <div class="form-group col-xs-12 col-lg-12 col-lg-12">
                                    
                                    <div class="col-sm-4 col-xs-12">
                                        <?php echo form_label(lang('iqa_employee_name'). ':', 'employee_name', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                        <span class="input-group date col-sm-12 col-xs-12" data-date-format="dd-mm-yyyy" data-date="">
                                            <?php echo form_dropdown('employee', $drop_emp_and_prof, (($iqa_result_info->evaluate_to != "")? $iqa_result_info->evaluate_to : ''), 'class="form-control"');?>
                                        </span>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <?php echo form_label(lang('iqa_result_accessor'). ':', 'accessor_by:', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                        <?php
                                            $selected_accessor = explode(",", $iqa_result_info->evaluate_by);
                                            echo form_dropdown(
                                                'accessor[]',
                                                $accessor_byroom,
                                                $info_evaluate_by,
                                                'class="form-control" multiple="multiple" id="accessor"'
                                            );
                                        ?>
                                    </div>  
                                    <div class="col-sm-4 col-xs-12">
                                        <?php echo form_label(lang('iqa_type') . ':', 'iqa_type', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                        <span class="input-group date col-sm-12 col-xs-12" data-date-format="dd-mm-yyyy" data-date="">
                                            <?php echo form_dropdown('iqa_type', $iqa_types, $iqa_result_info->evaluate_type_id, 'class="form-control"'); ?>
                                        </span>
                                    </div>                                  
                                    <div class="col-sm-4 col-xs-12">
                                        <?php echo form_label(lang('iqa_date'). ':', 'date', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                        <span class="input-group date col-sm-12 col-xs-12" data-date-format="dd-mm-yyyy" data-date="">
                                            <input type="text" id="date" class="form-control hasDatepicker" name="date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="<?php echo $date = $iqa_result_info->evaluate_date != "" ? date('d-m-Y', strtotime($iqa_result_info->evaluate_date)) : date('d-m-Y'); ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <?php echo form_label(lang('iqa_date_from'). ':', 'date_from', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                        <span class="input-group date col-sm-12 col-xs-12" data-date-format="dd-mm-yyyy" data-date="">
                                            <input type="text" id="start_date" class="form-control hasDatepicker" name="start_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="<?php echo $date = $iqa_result_info->date_from != "" ? date('d-m-Y', strtotime($iqa_result_info->date_from)) : date('d-m-Y'); ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>

                                    <div class="col-sm-4 col-xs-12">
                                        <?php echo form_label(lang('iqa_date_to'). ':', 'date_to', array('class' => 'col-sm-6 col-xs-12 required no-padding')); ?>
                                        <span class="input-group date col-sm-12 col-xs-12" data-date-format="dd-mm-yyyy" data-date="">
                                            <input type="text" id="end_date" class="form-control hasDatepicker" name="end_date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="<?php echo $date = $iqa_result_info->date_to != "" ? date('d-m-Y', strtotime($iqa_result_info->date_to)) : date('d-m-Y'); ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                    
                                    <div class="col-sm-12 col-xs-12">
                                        <?php echo form_label(lang('common_desc'). ':', 'accessor_by:', array('class' => 'col-sm-6 col-xs-12 no-padding')); ?>
                                        <textarea name="description" class="form-control"><?php echo $iqa_result_info->description?></textarea>                                     
                                    </div>
                                </div>
                            </div>

                            <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                                <table class="col-sm-12 col-md-12 col-lg-12 tablesorter table-bordered" style="line-height:33px;">
                                    <colgroup>
                                        <col style="width:2%">
                                        <col style="width:15%">
                                        <col style="width:15%">
                                    </colgroup>
                                    <tr style="background: #D9EDF7">
                                        <th class="text-center"><?php echo lang('common_no'); ?></th>
                                        <th class="text-center"><?php echo lang('iqa_tool_criteria'); ?></th>
                                        <th class="text-center"><?php echo lang('iqa_score'); ?></th>
                                    </tr>
                                    <tbody id="rows">
                                        <!-- Row of Title -->
                                        <?php
                                        if ($iqa_result_info->id) {
                                            $this->load->view('iqa/iqa_tool/rows');
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-actions">
                                <div>
                                    <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
                                </div>
                                <div>
                                    <input type="submit" name="submit" value="<?php echo lang('common_add'); ?>" id="submit" class="btn btn-primary pull-right">
                                </div>
                            </div>
                        <?php echo form_close(); ?>

                    </div>
                    <!-- End -->
                </div> 
            </div> 
        </div>
    </div><!-- /.page-content -->
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        initDatePicker("input[name='start_date']");
        initDatePicker("input[name='end_date']");
        initDatePicker("input[name='date']");
        initSomuSelect('#accessor', false);

        $('body').on('change', 'select[name="iqa_type"]', function() {
            var iqa_type = $(this).val();
            $.ajax({
                url: SITE_URL + "iqa_tool/get_iqa_titles",
                type: 'POST',
                dataType: 'html',
                data: {iqa_type_id: iqa_type},
            })
            .done(function(response) {
                console.log(response)
                $('tbody#rows').html(response);
            })
            .fail(function() {
                console.log("error");
            });
        });

        $('#iqa_tool_form').validate({
            submitHandler:function(form)
            {
                doIQATooolSubmit(form);
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
                iqa_name: "required",
            },
            messages:
            {
                iqa_name: <?php echo json_encode(lang('iqa_name_is_required')); ?>,
            }
        });
    });

    var submitting = false;
    function doIQATooolSubmit(form)
    {
        var redirect = '<?php echo $redirect ?>';        
        if (submitting) return;
        submitting = true;
        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: $(form).serialize(),
        })
        .done(function(response) {
            submitting = false;
            if (response.success) {
                $.notify(response.message, "success");
                if(redirect == 1){
                    window.history.go(-2);
                }else{
                    window.location.href = '<?php echo site_url("$controller_name/view"); ?>/'+response.id;
                }
            } else {
                $.notify(response.message, "error");
            }
        })
        .fail(function(response) {
            console.log(response.responseText)
        });
    }
</script>

<?php $this->load->view("partial/footer"); ?>