<?php $this->load->view("partial/header"); ?>

<div id="breadcrumbs" class=" col-md-12 breadcrumbs">
	<?php echo create_breadcrumb(); ?>
</div>

<div class="clear"></div>
<div class="col-md-12">
    <div class="text-center"><h2><?php echo lang("reports_proposal_report"); ?></h2></div>
    <div class="widget-title widget-box dd-handle">
        <span class="icon">
            <i class="fa fa-align-justify"></i> <?php echo form_label(lang('reports_date_range'), 'report_date_range_label', array('class' => 'required')); ?>
        </span>

    </div>
    <div class="">
        <?php
        if (isset($error)) {
            echo "<div class='error_message'>" . $error . "</div>";
        }
        ?>
        <form  class="form-horizontal form-horizontal-mobiles">

            <div class="form-group">
            <?php echo form_label(lang('reports_date_range'), 'report_date_range_label', array('class'=>'col-sm-3 col-md-3 col-lg-2 control-label   ')); ?>
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="radio" name="report_type" id="simple_radio" value='simple' checked='checked'/>
                    &nbsp;
                    <!-- <div class="mobile_break">&nbsp;</div> -->
                    <?php echo form_dropdown('report_date_range_simple',$report_date_range_simple, '', 'id="report_date_range_simple" class="input-large"'); ?>
                </div>
            </div>

            <div id='report_date_range_complex'>
                <div class="form-group">
                    <?php echo form_label(lang('reports_custom_range') . ' :', 'range', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>

                    <div class="col-sm-9 col-md-9 col-lg-10">

                        <input type="radio" name="report_type" id="complex_radio" value='complex'/>
                        &nbsp;
                        <?php echo form_dropdown('start_month', $months, $selected_month, 'id="start_month" class=""'); ?>
                        <?php echo form_dropdown('start_day', $days, $selected_day, 'id="start_day" class=""'); ?>
                        <?php echo form_dropdown('start_year', $years, $selected_year, 'id="start_year" class=""'); ?>
                       <span class="forms_to">-</span>
                        <?php echo form_dropdown('end_month', $months, $selected_month, 'id="end_month" class=""'); ?>
                        <?php echo form_dropdown('end_day', $days, $selected_day, 'id="end_day" class=""'); ?>
                        <?php echo form_dropdown('end_year', $years, $selected_year, 'id="end_year" class=""'); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label(lang('reports_proposal_status') . ' :', 'reports_proposal_status_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label  ')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <?php echo form_dropdown('proposal_status', array('all' => lang('reports_all'), 'pending' => lang('reports_pending'), 'completed' => lang('reports_completed'), 'rejected' => lang('reports_rejected')), 'all', 'id="proposal_status" class="input-medium"'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php 
                $gm_approval = array(
                    'all' => lang('reports_all'),
                    '0' => lang('proposal_not_yet_approve'),
                    '1' => lang('proposal_approved'),
                    '2' => lang('proposal_awaiting')
                );
                ?>
                <?php echo form_label(lang('reports_proposal_approval') . ' :', 'reports_proposal_approval_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <?php echo form_dropdown('proposal_approval', $gm_approval, 'all', 'id="proposal_approval" class="input-medium"'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label(lang('reports_proposal_title') . ' :', 'reports_proposal_title_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="text" class="token-input" name="proposal_titles" w="proposals" value=""/>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label(lang('reports_project_responsible_person') . ' :', 'reports_responsible_person_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="text" class="token-input" name="responsible_person" w="responsible_person" value=""/>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label(lang('reports_client') . ' :', 'reports_client_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="text" class="token-input" name="clients" w="clients" value=""/>
                </div>
            </div>

            <!-- <div class="form-group">
                <?php // echo form_label(lang('reports_export_to_excel') . ' :', 'reports_export_to_excel', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label  ')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="radio" name="export_excel" id="export_excel_yes" value='1' /> <?php // echo lang('common_yes'); ?>  &nbsp;&nbsp;
                    <input type="radio" name="export_excel" id="export_excel_no" value='0' checked='checked' /> <?php // echo lang('common_no'); ?>
                </div>
            </div> -->

            <div class="form-actions">
                <?php
                echo form_button(array(
                    'name' => 'generate_report',
                    'id' => 'generate_report',
                    'content' => lang('reports_submit'),
                    'class' => 'btn btn-primary submit_button btn-large')
                );
                ?>
            </div>
        </form>
    </div>
</div>

</div>

<?php $this->load->view("partial/footer"); ?>

<script type="text/javascript" language="javascript">

    $("input.token-input").tokenInput('<?php echo site_url("reports/sales_generator"); ?>?act=autocomplete',
    {
        theme: "facebook",
        queryParam: "term",
        extraParam: "w",
        hintText: <?php echo json_encode(lang("reports_sales_generator_autocomplete_hintText"));?>,
        noResultsText: <?php echo json_encode(lang("reports_sales_generator_autocomplete_noResultsText"));?>,
        searchingText: <?php echo json_encode(lang("reports_sales_generator_autocomplete_searchingText"));?>,
        preventDuplicates: true,
    });
    
    $("#generate_report").click(function()
    {
        var proposal_status = $("#proposal_status").val();
        var proposal_approval = $("#proposal_approval").val();
        var proposal_titles = $("input[name='proposal_titles']").val();
        var responsible_person = $("input[name='responsible_person']").val();
        var clients = $("input[name='clients']").val();

        if (proposal_titles != "") {
            proposal_titles = proposal_titles.split(',').join('-')
        } else {
            proposal_titles = 'all'
        }
        if (responsible_person != "") {
            responsible_person = responsible_person.split(',').join('-')
        } else {
            responsible_person = 'all'
        }
        if (clients != "") {
            clients = clients.split(',').join('-')
        } else {
            clients = 'all'
        }

        var export_excel = 0;
        if ($("#export_excel_yes").prop('checked'))
        {
        export_excel = 1;
        }

        if ($("#simple_radio").prop('checked'))
        {
            window.location = window.location+'/'+$("#report_date_range_simple option:selected").val() + '/'+proposal_status+'/'+ proposal_approval + '/' + export_excel + '/'+proposal_titles+'/'+responsible_person+'/'+clients;
        }
        else
        {
            var start_date = $("#start_year").val()+'-'+$("#start_month").val()+'-'+$('#start_day').val();
            var end_date = $("#end_year").val()+'-'+$("#end_month").val()+'-'+$('#end_day').val();

            window.location = window.location+'/'+start_date + '/'+ end_date + '/'+proposal_status+'/'+proposal_approval+'/'+ export_excel + '/'+proposal_titles+'/'+responsible_person+'/'+clients;
        }
    });



    $("#start_month, #start_day, #start_year, #end_month, #end_day, #end_year").change(function()
    {
        $("#complex_radio").prop('checked', true);
    });

    $("#report_date_range_simple").change(function()
    {
        $("#simple_radio").prop('checked', true);
    });
</script>