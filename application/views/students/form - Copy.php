<?php $this->load->view("partial/header"); ?>
<div class=" alert alert-info" id='top'>
<?php echo create_breadcrumb(); ?>
</div>
<div class="page-header" id='page-header'>
    <h1> <i class="fa fa-pencil"></i> <?php  if(!$person_info->stu_master_id) { echo lang($controller_name.'_new'); } else { echo lang($controller_name.'_update'); } ?>    
    </h1>
</div>

<div class="widget-box" id="widgets">
    
    </div><!-- /.widget-body -->
    <div class="col-sm-12">
    <?php echo lang('common_fields_required_message'); ?>
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
                    <?php $this->load->view("students/basic_info"); ?>
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

    $(function(){
        $('#stu_master_skill_id').change(function(){
            var id = $(this).val();           
            var url_title_major = "<?php echo site_url("students/suggest_faculty")?>";
            var dataFaculty = { major_id: id};  
            $.ajax({
                type: "POST",
                url: url_title_major, 
                data:dataFaculty,
                dataType:"json",
                success: function(get_data){
                    $.each(get_data,function(key,val){
                        $('#stu_master_university_id').val(val.university_id);
                    });
                },
            });         
            var url_title_course = "<?php echo site_url("students/suggest_course")?>";
            var dataCourse = { major_id: id};
            $.ajax({
                type: "POST",
                url: url_title_course, 
                data:dataCourse,
                dataType:"json",
                success: function(get_data_row){
                    $('#stu_master_course_id').html('<option> Select Courses </option>');
                    $.each(get_data_row,function(key_row,val_row){                        
                        
                        var opt_row = $('<option />'); 
                        opt_row.val(val_row.course_id);
                        opt_row.text(val_row.course_name);
                        $('#stu_master_course_id').append(opt_row);
                    });
                },
            });   
        });

        $('#stu_master_university_id').change(function(){
            var id = $(this).val();           
            var url_title_faculty = "<?php echo site_url("students/suggest_major")?>";
            var dataFaculty = { faculty_id: id};  
            $.ajax({
                type: "POST",
                url: url_title_faculty, 
                data:dataFaculty,
                dataType:"json",
                success: function(get_data){
                    $('#stu_master_skill_id').html('<option> -- -- </option>');
                    $.each(get_data,function(key,val){
                        var opt = $('<option />'); 
                        opt.val(val.skill_id);
                        opt.text(val.skill_name);
                        $('#stu_master_skill_id').append(opt);
                    });
                },
            });            
        });
    });

    // $('#image_id').imagePreview({ selector : '#avatar' }); // Custom preview container
    //validation and submit handling
    $(document).ready(function()
    {
        $('[data-toggle="popover"]').popover({placement: function() { return $(window).width() < 768 ? 'bottom' : 'right'; }})
        initDatePicker("input[name='stu_dob']")
        initDatePicker("input[name='stu_admission_date']")
        setTimeout(function(){$(":input:visible:first", "#student_form").focus(); }, 100);
        var submitting = false;
        $('#student_form').validate({
            submitHandler:function(form)
            {   
                var wid = $('#stu_unique_id_written').val();
                $.post('<?php echo site_url("students/stu_unique_id_written_exists"); ?>', {term: wid }, function(data) {
                    if (data.duplicate == wid){
                        $('#stu_unique_id_written').val('');
                    }
                });

                $.post('<?php echo site_url("students/check_duplicate"); ?>', {term: $('#stu_unique_id').val() }, function(data) {
                <?php if (!$person_info->stu_master_id) { ?>
                    if (data.duplicate)
                    {
                    if (confirm(<?php echo json_encode(lang('customers_duplicate_exists')); ?>))
                        {
                            doStudentSubmit(form);
                        }
                        else
                        {
                        return false;
                        }
                    }
                <?php } else  ?>
                {
                    doStudentSubmit(form);
                }}, "json")
                .error(function() {
                });
            },
            rules:
            {
                // // stu_unique_id:
                // // {
                // //     /*remote:
                // //         {
                // //         url: "<?php echo site_url('students/account_number_exists'); ?>",
                // //             type: "post"
                // //         },*/
                // //     required: true
                // // },
                // stu_unique_id: "required",
                // stu_unique_id_written: "required",
                // stu_last_name: "required",
                // stu_first_name: "required",
                // stu_last_name_kh: "required",
                // stu_first_name_kh: "required",
                // stu_email_id: {
                //     email: true
                // },
                // stu_dob: "required",
                // stu_master_university_id: "required",
                // stu_master_skill_id: "required",
                // stu_master_course_id: "required",
                // stu_master_batch_id: "required",
                // stu_master_section_id: "required",
                // stu_admission_date: "required",
                // stu_master_category_id: "required",
                // stu_master_nationality_id: "required",
                // stu_master_stu_room: "required",
                // stu_master_stu_class: "required",
                // students_grade: "required",
                // stu_master_stu_schedule: "required",
            },
            errorClass: "text-danger",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error').addClass('has-success');
            },
            messages:
            {
                // // stu_unique_id:
                // // {
                // //     remote: <?php echo json_encode(lang('common_account_number_exists')); ?>,
                // //     required: "Required Field",
                // // },
                // 'stu_unique_id': "required",
                // 'stu_unique_id_written':"Required Field",
                // stu_last_name: "Required Field",
                // stu_first_name: "Required Field",
                // stu_last_name_kh: "Required Field",
                // stu_first_name_kh: "Required Field",
                // stu_email_id: {
                //     email: true
                // },
                // stu_unique_id: "requried field",
                // stu_unique_id_written: {
                //     stu_unique_id_written: true
                // },
                // stu_dob: "Required Field",
                // stu_master_university_id: "Required Field",
                // stu_master_skill_id: "Required Field",
                // stu_master_course_id: "Required Field",
                // stu_master_batch_id: "Required Field",
                // stu_master_section_id: "Required Field",
                // stu_admission_date: "Required Field",
                // stu_master_stu_room: "Required Field",
                // stu_master_stu_class: "Required Field",
                // students_grade: "Required Field",
                // stu_master_stu_schedule: "Required Field",
            }
        });

        $('body').on('change', 'input#is_refer_in', function() {
            if ($(this).prop('checked')) {
                $('input#refer_in_from').removeAttr('readonly');
            } else {
                $('input#refer_in_from').attr('readonly', true);
            }
        });
    });
    var submitting = false;
    function doStudentSubmit(form)
    {
        if (submitting) return;
        submitting = true;

        $.ajax({
            url: $(form).attr("action"),
            type: "post",
            dataType: "json",
            data: $(form).serialize(),
            success: function(response) {
                console.log(response)
                submitting = false;
                if (response.success)
                {
                    $.notify(response.message, "success");
                    window.location.href = '<?php echo site_url('students'); ?>';
                }
                else
                {
                    $.notify(response.message, "error");
                }
            },
            error: function(error) {
                console.log(error.responseText)
            }
        });

    }

</script>
<?php $this->load->view("partial/footer"); ?>
