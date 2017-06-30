<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
            <i class="icon fa fa-list"></i>
            <?php echo lang('iqa_view_evaluation_type'); ?>
        </h1>
    </div>

    <div class="page-content">

        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                    <div class="col-xs-12">
                        <?php echo lang('common_fields_required_message'); ?>
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat widget-header-small">
                                <h5 class="widget-title">
                                    <span class="icon">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                    <?php echo lang('iqa_view_evaluation_type'); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br />
                                <?php
                                echo form_open($controller_name.'/save/' . $iqa_info->id, array('id' => 'iqa_type_form', 'class' => 'form-horizontal'));
                                ?>

                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <label class="col-sm-4 col-md-4 col-lg-2 control-label"><?php echo lang('iqa_name'); ?>:</label>
                                        <div class="col-sm-8 col-md-8 col-lg-5">
                                            <input class="form-control" type="text" name="iqa_name" id="iqa_name" value='<?php echo $iqa_info->name_eng; ?>'/>
                                        </div>
                                    </div> 

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="col-sm-4 col-md-4 col-lg-2 control-label"><?php echo lang('iqa_name_kh'); ?>:</label>    
                                        <div class="col-sm-8 col-md-8 col-lg-5">
                                             <input class="form-control" type="text" name="iqa_name_kh" id="iqa_name_kh" value='<?php echo $iqa_info->name_kh; ?>'/>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="col-sm-4 col-md-4 col-lg-2 control-label"><?php echo lang('iqa_date'); ?>:</label>    
                                        <div class="col-sm-8 col-md-8 col-lg-5">
                                            <span class="input-group date " data-date-format="dd-mm-yyyy" data-date="">
                                                <input type="text" id="date" class="form-control hasDatepicker" name="date" size="10" placeholder="dd-mm-yyyy" data-format="DD-MM-YYYY" data-years="1990-2235" data-lang="en" value="<?php echo $date = $iqa_info->date != "" ? date('d-m-Y', strtotime($iqa_info->date)) : date('d-m-Y'); ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="col-sm-4 col-md-4 col-lg-2 control-label"><?php echo lang('common_year'); ?>:</label>
                                        <div class="col-sm-8 col-md-8 col-lg-5">
                                            <input class="form-control" type="text" name="year" id="year" value='<?php echo $iqa_info->year; ?>'/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 col-md-4 col-lg-2 control-label"><?php echo lang('iqa_evaluation_title'); ?>:</label>
                                        <table class="col-sm-7 col-md-7 col-lg-7 tablesorter table-bordered" style="line-height:33px;margin-left:10px;">
                                            <tr style="background: #D9EDF7">
                                                <th class="text-center"><?php echo lang('common_title'); ?></th>
                                                <th class="text-center" style="width:45%"><?php echo lang('iqa_title_kh'); ?></th>
                                                <th style="width:10%"></th>
                                            </tr>
                                            <tbody id="add">
                                                <?php
                                                    foreach ($iqa_titles as $key => $iqa_title) {
                                                        $input = "<input style='width:100%; text-align:center' type='text' name='evaluation_title[]' value='".$iqa_title->title_eng."' />";
                                                        $input_kh = "<input style='width:100%; text-align:center' type='text' name='evaluation_title_kh[]' value='".$iqa_title->title_kh."' />";
                                                        $tr = "<tr>".
                                                            "<td>".
                                                                "<input type='hidden' name='title_ids[]' value='".$iqa_title->id."' />".
                                                                "<div style='width:100%'>".$input."</div>".
                                                            "</td>".
                                                            "<td>".
                                                                "<div style='width:100%'>".$input_kh."</div>".
                                                            "</td>".
                                                            "<td><center><a class='remove_btn' href='javascript:void(0);'><i class='ace-icon fa fa-remove bigger-200 red'></i></a></center></td>".
                                                        "</tr>";
                                                        echo $tr;
                                                    }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr style="background:#65CCFF">
                                                    <td colspan="7" class="text-center"><a style="color:#fff" id="add_schedule" href="javascript:;"><?php echo lang('iqa_add_more_upper'); ?></a></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name")?>"><?php echo lang('common_cancel'); ?></a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="<?php echo lang('common_add'); ?>" id="submit" class="btn btn-primary pull-right">                
                                        </div>
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
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
        initDatePicker("input[name='date']");

        $('#add_schedule').click(function(){

            var input="<input style='width:100%; text-align:center' type='text' name='evaluation_title[]' value='' />";
            var input_kh="<input style='width:100%; text-align:center' type='text' name='evaluation_title_kh[]' value='' />";
            var tr = "<tr>"+
                        "<td>"+
                            "<input type='hidden' name='title_ids[]' />"+
                            "<div style='width:100%'>"+input+"</div>"+
                        "</td>"+

                        "<td>"+
                            "<div style='width:100%'>"+input_kh+"</div>"+
                        "</td>"+
                        "<td><center><a class='remove_btn' href='javascript:void(0);'><i class='ace-icon fa fa-remove bigger-200 red'></i></a></center></td>"+
                    "</tr>";

            $("#add:first").append(tr);
        });

        $('#add').delegate('.remove_btn', 'click', function () {
            if(confirm('Are you sure you want to delete this row?')){
                var tr = $(this).parent().parent().parent();
                tr.remove();
            }
        });

        setTimeout(function(){$(":input:visible:first", "#iqa_type_form").focus(); }, 100);
        $('#iqa_type_form').validate({
            submitHandler:function(form)
            {
                doIQATypeSubmit(form);
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
    function doIQATypeSubmit(form)
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
                    window.location.href = '<?php echo site_url("$controller_name/view"); ?>/'+response.id;
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