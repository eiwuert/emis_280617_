<?php $this->load->view("partial/header"); ?>
<div id="breadcrumbs" class=" col-md-12 breadcrumbs">
	<?php echo create_breadcrumb(); ?>
</div>

<div class="clear"></div>
<div class="col-md-12">
    <div class="widget-title widget-box col-md-12 dd-handle">
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
                <?php echo form_label(lang('reports_fixed_range') . ': ', 'range', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label   ')); ?>

                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="radio" name="report_type" id="simple_radio" value='simple' checked='checked'/>
                    &nbsp;
                    <?php echo form_dropdown('report_date_range_simple', $report_date_range_simple, '', 'id="report_date_range_simple" class="input-large"'); ?>
                </div>
            </div>

            <div id='report_date_range_complex'>
                <div class="form-group">
                    <?php echo form_label(lang('reports_custom_range') . ' :', 'range', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>

                    <div class="col-sm-9 col-md-9 col-lg-10">

                        <input type="radio" name="report_type" id="complex_radio" value='complex' />
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
                <?php echo form_label(lang('reports_project_title') . ' :', 'reports_proposal_title_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="text" class="token-input" name="project_titles" w="project_titles" value=""/>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label(lang('reports_project_manager') . ' :', 'reports_project_manager_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="text" class="token-input" name="project_managers" w="project_managers" value=""/>
                </div>
            </div>

            <div class="form-group">
                <?php echo form_label(lang('reports_consultant') . ' :', 'reports_consultant_label', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?> 
                <div class="col-sm-9 col-md-9 col-lg-10">
                    <input type="text" class="token-input" name="consultants" w="consultants" value=""/>
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
        var project_titles = $("input[name='project_titles']").val();
        var project_managers = $("input[name='project_managers']").val();
        var consultants = $("input[name='consultants']").val();

        if (project_titles != "") {
            project_titles = project_titles.split(',').join('-')
        } else {
            project_titles = 'all'
        }
        if (project_managers != "") {
            project_managers = project_managers.split(',').join('-')
        } else {
            project_managers = 'all'
        }
        if (consultants != "") {
            consultants = consultants.split(',').join('-')
        } else {
            consultants = 'all'
        }

        var export_excel = 0;
        if ($("#export_excel_yes").prop('checked'))
        {
                export_excel = 1;
        }

        if ($("#simple_radio").prop('checked'))
        {
            window.location = window.location+'/'+$("#report_date_range_simple option:selected").val() +'/'+export_excel+'/'+project_titles+'/'+project_managers+'/'+consultants;
        }
        else
        {
            var start_date = $("#start_year").val()+'-'+$("#start_month").val()+'-'+$('#start_day').val();
            var end_date = $("#end_year").val()+'-'+$("#end_month").val()+'-'+$('#end_day').val();

            window.location = window.location+'/'+start_date + '/'+ end_date +'/'+ export_excel+'/'+project_titles+'/'+project_managers+'/'+consultants;
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