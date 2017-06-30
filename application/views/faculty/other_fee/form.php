<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
            <i class="icon fa fa-list"></i>
            <?php  if(!$fees_info->fees_category_id) { echo lang($controller_name.'_new'); } else { echo lang($controller_name.'_update'); } ?>
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
                                    <?php echo lang($controller_name.'_new'); ?>
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br/>
                                <?php echo form_open($controller_name.'/save/' . $fees_info->fees_category_id, array('id' => 'form_fee', 'class' => 'form-horizontal')); ?>
                                    <div class="form-group required" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="fees_collect_name">
                                            <?php echo lang('fees_name'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="filter form-control" 
                                                name="fees_collect_name" 
                                                id="fees_collect_name" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_collect_name; ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="fees_collect_name_kh">
                                            <?php echo lang('fees_name_kh'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="filter form-control" 
                                                name="fees_collect_name_kh" 
                                                id="fees_collect_name_kh" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_collect_name_kh; ?>"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="fees_degree">
                                            <?php echo lang('degree_code'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                           <?php echo form_dropdown(
                                                    'fees_degree',
                                                    $levels,
                                                    $fees_info->fees_degree,
                                                    'class="form-control" id="fees_degree"'
                                                ); ?>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="fees_major">
                                            <?php echo lang('major_name'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php echo form_dropdown(
                                                    'fees_major',
                                                    $skills,
                                                    $fees_info->fees_major,
                                                    'class="form-control" id="fees_major"'
                                                );
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="fees_academic_year">
                                            <?php echo lang('major_academic_year'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php echo form_dropdown(
                                                    'fees_academic_year',
                                                    $section,
                                                    $fees_info->fees_academic_year, 
                                                    'class="form-control" id="fees_academic_year"'
                                                );
                                            ?>
                                        </div>
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="fees_exchange_rate">
                                            <?php echo lang('fees_exchange_rate'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="filter form-control" 
                                                name="fees_exchange_rate" 
                                                id="fees_exchange_rate" 
                                                type="text" 
                                                value="<?php echo $exchange_rate = $fees_info->fees_exchange_rate != '' ? $fees_info->fees_exchange_rate : ''; ?>" 
                                                placeholder='<?php echo lang('fees_exchange_rate'); ?>'
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="scholarships">
                                            <?php echo lang('scholarship'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php                                                
                                                echo form_dropdown(
                                                    'scholarships[]',
                                                    $scholarships,
                                                    $view_scholarship,
                                                    'class="form-control search-box" id="scholarships" multiple="multiple"'
                                                );
                                                echo form_hidden('fees_scholarships', $fees_info->fees_scholarships);
                                            ?>
                                        </div>

                                        <label class="control-label col-sm-2 col-md-2 col-lg-2 " for="fees_exchange_baht">
                                            <?php echo lang('fees_exchange_baht'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="filter form-control" 
                                                name="fees_exchange_baht" 
                                                id="fees_exchange_baht" 
                                                type="text" 
                                                value="<?php echo $exchange_rate = $fees_info->fees_exchange_baht != '' ? $fees_info->fees_exchange_baht : ''; ?>" 
                                                placeholder='<?php echo lang('fees_exchange_baht'); ?>'
                                            />
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <h2 class="page-header">
                                            <i class="fa fa-info-circle"></i> <?php echo lang('fees_category'); ?>
                                        </h2>
                                    </div>
                                    <div id="payment_fee_cate">
                                            <div class="form-group" style="margin-bottom: 10px;">
                                                <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_cate_a_year">
                                                    Dollar:
                                                </label>     
                                                <div class="col-sm-3 col-md-3 col-lg-3">
                                                    <input 
                                                        class="input-dollar form-control" 
                                                        name="fees_cate_amount"
                                                        id="fees_cate_amount"
                                                        type="number"
                                                        value="<?php echo $fees_info->fees_cate_amount; ?>"
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom: 10px;">
                                                <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_cate_a_year">
                                                    Riel:
                                                </label>     
                                                <div class="col-sm-3 col-md-3 col-lg-3">
                                                    <input 
                                                        class="input-riel form-control" 
                                                        name="fees_cate_amount_riel" 
                                                        id="fees_cate_amount_riel" 
                                                        type="number"
                                                        readonly=""
                                                        value="<?php echo $fees_info->fees_cate_amount_riel; ?>" 
                                                    />
                                                </div>
                                            </div>
                                            <div class="form-group" style="margin-bottom: 10px;">
                                                <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_cate_a_year">
                                                    Baht:
                                                </label>     
                                                <div class="col-sm-3 col-md-3 col-lg-3">
                                                    <input 
                                                        class="input-baht form-control" 
                                                        name="fees_cate_amount_baht" 
                                                        id="fees_cate_amount_baht" 
                                                        type="number"
                                                        readonly=""
                                                        value="<?php echo $fees_info->fees_cate_amount_baht; ?>"
                                                    />
                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <h2 class="page-header">
                                            <i class="fa fa-info-circle"></i> <?php echo lang('fees_other_fees'); ?>
                                        </h2>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="fees_other_other_fee_usd">
                                            <?php echo lang('common_dollar'); ?>:
                                        </label>
                                        <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="fees_other_other_fee_usd">
                                            <?php echo lang('common_riel'); ?>:
                                        </label>
                                        <label class="control-label col-sm-3 col-md-3 col-lg-3 " for="fees_other_other_fee_usd">
                                            <?php echo lang('common_baht'); ?>:
                                        </label>     
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_other_other_fee_usd">
                                            <?php echo lang('fees_other_fee'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-dollar form-control" 
                                                name="fees_other_other_fee_usd" 
                                                id="fees_other_other_fee_usd" 
                                                type="number" 
                                                value="<?php echo $fees_info->fees_other_other_fee_usd; ?>" 
                                                placeholder='<?php echo lang('common_dollar'); ?>'
                                            />
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-riel form-control" 
                                                name="fees_other_other_fee_riel" 
                                                id="fees_other_other_fee_riel" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_other_fee_riel; ?>" 
                                                placeholder='<?php echo lang('common_riel'); ?>'
                                            />
                                        </div>

                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-baht form-control" 
                                                name="fees_other_other_fee_baht" 
                                                id="fees_other_other_fee_baht" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_other_fee_baht; ?>" 
                                                placeholder='<?php echo lang('common_baht'); ?>'
                                            />
                                        </div>      
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_other_pre_enter_exam_usd">
                                            <?php echo lang('fees_pre_enter_exam'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-dollar form-control" 
                                                name="fees_other_pre_enter_exam_usd" 
                                                id="fees_other_pre_enter_exam_usd" 
                                                type="number" 
                                                value="<?php echo $fees_info->fees_other_pre_enter_exam_usd; ?>" 
                                                placeholder='<?php echo lang('common_dollar'); ?>'
                                            />
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-riel form-control" 
                                                name="fees_other_pre_enter_exam_riel" 
                                                id="fees_other_pre_enter_exam_riel" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_pre_enter_exam_riel; ?>" 
                                                placeholder='<?php echo lang('common_riel'); ?>'
                                            />
                                        </div>

                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-baht form-control" 
                                                name="fees_other_pre_enter_exam_baht" 
                                                id="fees_other_pre_enter_exam_baht" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_pre_enter_exam_baht; ?>" 
                                                placeholder='<?php echo lang('common_baht'); ?>'
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_other_final_exam_usd">
                                            <?php echo lang('fees_final_exam'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-dollar form-control" 
                                                name="fees_other_final_exam_usd" 
                                                id="fees_other_final_exam_usd" 
                                                type="number" 
                                                value="<?php echo $fees_info->fees_other_final_exam_usd; ?>" 
                                                placeholder='<?php echo lang('common_dollar'); ?>'
                                            />
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-riel form-control" 
                                                name="fees_other_final_exam_riel" 
                                                id="fees_other_final_exam_riel" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_final_exam_riel; ?>" 
                                                placeholder='<?php echo lang('common_riel'); ?>'
                                            />
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-baht form-control" 
                                                name="fees_other_final_exam_baht" 
                                                id="fees_other_final_exam_baht" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_final_exam_baht; ?>" 
                                                placeholder='<?php echo lang('common_baht'); ?>'
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_other_re_exam_usd">
                                            <?php echo lang('fees_re_exam_fee'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-dollar form-control" 
                                                name="fees_other_re_exam_usd" 
                                                id="fees_other_re_exam_usd" 
                                                type="number" 
                                                value="<?php echo $fees_info->fees_other_re_exam_usd; ?>" 
                                                placeholder='<?php echo lang('common_dollar'); ?>'
                                            />
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-riel form-control" 
                                                name="fees_other_re_exam_riel" 
                                                id="fees_other_re_exam_riel" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_re_exam_riel; ?>" 
                                                placeholder='<?php echo lang('common_riel'); ?>'
                                            />
                                        </div>

                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-baht form-control" 
                                                name="fees_other_re_exam_baht" 
                                                id="fees_other_re_exam_baht" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_re_exam_baht; ?>" 
                                                placeholder='<?php echo lang('common_baht'); ?>'
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_other_thesis_usd">
                                            <?php echo lang('fees_thesis_fee'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-dollar form-control" 
                                                name="fees_other_thesis_usd" 
                                                id="fees_other_thesis_usd" 
                                                type="number" 
                                                value="<?php echo $fees_info->fees_other_thesis_usd; ?>" 
                                                placeholder='<?php echo lang('common_dollar'); ?>'
                                            />
                                        </div>   
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-riel form-control" 
                                                name="fees_other_thesis_riel" 
                                                id="fees_other_thesis_riel" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_thesis_riel; ?>" 
                                                placeholder='<?php echo lang('common_riel'); ?>'
                                            />
                                        </div>  
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-baht form-control" 
                                                name="fees_other_thesis_baht" 
                                                id="fees_other_thesis_baht" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_thesis_baht; ?>" 
                                                placeholder='<?php echo lang('common_baht'); ?>'
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label class="control-label col-sm-3 col-md-3 col-lg-2 " for="fees_other_certificate_usd">
                                            <?php echo lang('fees_certificate_fee'); ?>:
                                        </label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-dollar form-control" 
                                                name="fees_other_certificate_usd" 
                                                id="fees_other_certificate_usd" 
                                                type="number" 
                                                value="<?php echo $fees_info->fees_other_certificate_usd; ?>" 
                                                placeholder='<?php echo lang('common_dollar'); ?>'
                                            />
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-riel form-control" 
                                                name="fees_other_certificate_riel" 
                                                id="fees_other_certificate_riel" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_certificate_riel; ?>" 
                                                placeholder='<?php echo lang('common_riel'); ?>'
                                            />
                                        </div>

                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input 
                                                class="input-baht form-control" 
                                                name="fees_other_certificate_baht" 
                                                id="fees_other_certificate_baht" 
                                                type="text" 
                                                value="<?php echo $fees_info->fees_other_certificate_baht; ?>" 
                                                placeholder='<?php echo lang('common_baht'); ?>'
                                            />
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>"><?php echo lang('common_cancel'); ?></a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="<?php echo lang('common_save') ?>" id="submit" class="btn btn-primary pull-right">
                                        </div>
                                    </div>

                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </div> 
        </div><!-- /.row -->
    </div><!-- /.page-content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')

        initSomuSelect('#scholarships');
        $('.input-dollar').keyup(function(event) {
            var usd = $(this).val();
            var exchange_rate = $('#fees_exchange_rate').val();
            var exchange_baht = $('#fees_exchange_baht').val();

            if (!exchange_rate) {
                exchange_rate = 1;
            }
            if (!exchange_baht) {
                exchange_baht = 1;
            }

            riel = usd * exchange_rate;
            baht = usd * exchange_baht;
            $(this).parents('#payment_fee_cate').find('input.input-riel').val(toCurrency(riel));
            $(this).parents('.form-group').find('input.input-riel').val(toCurrency(riel));
            $('#fees_exchange_rate').val(exchange_rate);

            $(this).parents('#payment_fee_cate').find('input.input-baht').val(toCurrency(baht));
            $(this).parents('.form-group').find('input.input-baht').val(toCurrency(baht));
            $('#fees_exchange_baht').val(exchange_baht);
        });

        $('#fees_exchange_rate').keyup(function(event) {
            var exchange_rate = $(this).val();
            if (!exchange_rate) {
                exchange_rate = 1;
            }            
            usd = $('#fees_cate_amount').val();
            riel = toCurrency(usd * exchange_rate);            
            $('#payment_fee_cate').find('input.input-riel').val(riel);

            $('.input-dollar').each(function(index, el) {
                usd = $(el).val();
                riel = '';
                if (usd) {
                    riel = toCurrency(usd * exchange_rate);
                }
                $(el).parents('.form-group').find('input.input-riel').val(riel);
            });
        });

        $('#fees_exchange_baht').keyup(function(event) {
            var exchange_baht = $(this).val();
            if (!exchange_baht) {
                exchange_baht = 1;
            }            
            usd = $('#fees_cate_amount').val();
            baht = toCurrency(usd * exchange_baht);            
            $('#payment_fee_cate').find('input.input-baht').val(baht);

            $('.input-dollar').each(function(index, el) {
                usd = $(el).val();
                baht = '';
                if (usd) {
                    baht = toCurrency(usd * exchange_baht);
                }
                $(el).parents('.form-group').find('input.input-baht').val(baht);
            });
        });

        // $('#fees_exchange_rate').change(function(event) {
        //     if (!$(this).val()) {
        //         $(this).val(1);
        //     }
        // });

        setTimeout(function(){ $(":input:visible:first", "#form_fee").focus(); }, 100);
        $('#form_fee').validate({
            submitHandler:function(form)
            {
                doFeesSubmit(form);
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
                fees_collect_name: "required",
            },
            messages:
            {
                fees_collect_name: <?php echo json_encode(lang('fees_name_required')); ?>,
            }
        });
    });

    var submitting = false;
    function doFeesSubmit(form)
    {
        if (submitting) return;
        submitting = true;
        // var scholarships = getSomuSelected('#scholarships')
        // $('input[name="fees_scholarships"]').val(scholarships);
        $(form).ajaxSubmit({
            success:function(response)
            {
                submitting = false;
                $.notify(response.success ? <?php echo json_encode(lang('common_success')); ?> + ' #' + response.fee_id : <?php echo json_encode(lang('common_error')); ?>, response.message, response.success ? 'success' : 'error')
                if (response.success)
                {
                    window.location.href = '<?php echo site_url("$controller_name"); ?>'
                }
            },
            error: function(response) {console.log(response.responseText)},
            <?php if (!$fees_info->fees_category_id) { ?>
                resetForm: true,
            <?php } ?>
            dataType:'json'
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>