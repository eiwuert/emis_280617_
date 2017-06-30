<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>                                      
 </div>
 <div class="page-header" id='page-header'>
    <h1> <i class="fa fa-pencil"></i>  <?php  if(!$person_info->person_id) { echo lang($controller_name.'_new'); } else { echo lang($controller_name.'_update'); } ?>    </h1>
</div>

<div class="widget-box" id="widgets">
    
    </div><!-- /.widget-body -->
    <div class="col-sm-12">
    <div class="widget-box">
        <div class="widget-header widget-header-flat widget-header-small">
            <h5 class="widget-title">
                <span class="icon">
                    <i class="fa fa-align-justify"></i>                                 
                </span>
                <?php echo lang("employees_basic_information"); ?>
            </h5>
        </div>
        <div class="widget-body">
        <div class="widget-main">
            <div id="fuelux-wizard-container">
                <div class="row">
                    <?php $this->load->view("employees/_detail"); ?>
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
        initDatePicker("input[name='stu_dob']")
        initDatePicker("input[name='stu_admission_date']")
    });
    
</script>
<?php $this->load->view("partial/footer"); ?>
