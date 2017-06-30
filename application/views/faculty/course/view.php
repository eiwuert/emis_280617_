<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
      <i class="ace-icon fa fa-search-plus bigger-100"></i>
        <?php echo "View Couse Detail"; ?>
    </h1>
</div>

    <div class="page-content">

        
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                    <!-- <div class="widget-content nopadding table_holder table-responsive" > -->
                        <?php // echo $manage_table; ?>         
                    <!-- </div>      -->
                        <div class="col-xs-12">
                        Fields in red are required    <div class="widget-box">
                                <div class="widget-header widget-header-flat widget-header-small">
                                    <h5 class="widget-title">
                                        <span class="icon">
                                            <i class="fa fa-align-justify"></i>                                 
                                        </span>
                                        Course Detail
                                    </h5>
                                </div>

                                <section class="content" style="min-height: 543px; overflow:auto">

                            <?php echo $this->load->view('faculty/course/table_view1')?>

                            <?php echo $this->load->view('faculty/course/full_time')?>

                    </section>   
                        
                    <!-- End -->
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
    })

    $('#course_schedule_form').validate({
            submitHandler:function(form)
            {
                 doCourseSubmit(form);
            }
    });

    var submitting = false;
    function doCourseSubmit(form)
    {
        if (submitting) return;
        submitting = true;

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
                    window.location.href = '<?php echo site_url("$controller_name/view_schedule"); ?>/'+response.course_id;
                }
                else
                {
                    $.notify(response.message, "error");
                }
            }
        });
    }
</script>
<?php $this->load->view("partial/footer"); ?>