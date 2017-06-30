<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
 </div>
 <div class="page-header" id='page-header'>
    <h1><i class="fa fa-pencil"></i>  <?php  if(!$person_info->person_id) { echo lang($controller_name.'_new'); } else { echo lang($controller_name.'_update'); } ?></h1>
</div>

<div class="widget-box" id="widgets">
    
    </div><!-- /.widget-body -->
    <div class="col-sm-12">
    <?php //echo lang('common_fields_required_message'); ?>
   <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>                                 
                </span>
                <?php echo lang("students_basic_information"); ?>
            </h5>
        </div>
        <div class="widget-body">
        <div class="widget-main">
            <div id="fuelux-wizard-container">
                <div class="row">
                    <?php $this->load->view("students/_detail"); ?>
                </div>
            </div>
        </div><!-- /.widget-main -->
        <div> <!--widget-body-->
    </div><!-- /.col -->
</div>
</div>
<script type='text/javascript'>
    var initDatePicker = function(elem) {
        $(elem).ionDatePicker();
    }

    $('#image_id').imagePreview({ selector : '#avatar' }); // Custom preview container
    //validation and submit handling
    $(document).ready(function()
    {
        initDatePicker("input[name='stu_dob']");
        initDatePicker("input[name='stu_admission_date']");
        initDatePicker("input[name='change_date']");

        $('body').on('click', 'a.del-guardian', function(e){
            e.preventDefault();
            var $this = $(this), 
            id = $this.data('item'),
            method = $this.data("method"),
            confirmMessage = $this.data("confirm"),
            url = SITE_URL + "students/delete_guardian";
            if (confirm(confirmMessage)) {
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "JSON",
                    data: {id: id},
                    success: function(resp) {
                        if (resp.success) {
                            $.notify(resp.message, 'success');
                            $this.parents("div.wrap-guardian").remove()
                            // window.location.reload(true);
                        } else {
                            $.notify(resp.message, 'error');
                        }
                    }
                });
            };
        })

        $('body').on('click', 'a.del-transfer', function(e){
            e.preventDefault();
            var $this = $(this), 
            id = $this.data('item'),
            method = $this.data("method"),
            confirmMessage = $this.data("confirm"),
            url = SITE_URL + "students/delete_transfer";
            if (confirm(confirmMessage)) {
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "JSON",
                    data: {id: id},
                    success: function(resp) {
                        if (resp.success) {
                            $.notify(resp.message, 'success');
                            $this.parent().parent().remove()
                            // window.location.reload(true);
                        } else {
                            $.notify(resp.message, 'error');
                        }
                    }
                });
            };
        })
        $('body').on('click', 'a.del-job_status', function(e){
            e.preventDefault();
            var $this = $(this), 
            id = $this.data('item'),
            method = $this.data("method"),
            confirmMessage = $this.data("confirm"),
            url = SITE_URL + "students/delete_job_status";
            if (confirm(confirmMessage)) {
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "JSON",
                    data: {id: id},
                    success: function(resp) {
                        if (resp.success) {
                            $.notify(resp.message, 'success');
                            $this.parent().parent().parents('div.job-row').remove();
                            // window.location.reload(true);
                        } else {
                            $.notify(resp.message, 'error');
                        }
                    }
                });
            };
        })
        $('body').on('click', 'a.del-stu_academic', function(e){
            e.preventDefault();
            var $this = $(this), 
            id = $this.data('item'),
            method = $this.data("method"),
            confirmMessage = $this.data("confirm"),
            url = SITE_URL + "students/delete_academic";
            if (confirm(confirmMessage)) {
                $.ajax({
                    url: url,
                    type: method,
                    dataType: "JSON",
                    data: {id: id},
                    success: function(resp) {
                        if (resp.success) {
                            $.notify(resp.message, 'success');
                                $this.parent().parent().parents('div.academic-row').remove();
                            // window.location.reload(true);
                        } else {
                            $.notify(resp.message, 'error');
                        }
                    }
                });
            };
        })
    });
    
</script>
<?php $this->load->view("partial/footer"); ?>
