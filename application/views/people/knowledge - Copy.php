<legend class="page-header text-info"> &nbsp; &nbsp; <?php echo lang("employees_knowledge"); ?></legend>

<div class="form-group">  
    <?php echo form_label(lang('employees_teach_major') . ':', 'majors', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
            echo form_dropdown('majors', $major, $selected_majors, 'class="form-control" placeholder="fdfds" disabled');
        ?>
    </div>
</div>

<!-- <div class="form-group">  
    <?php echo form_label(lang('employees_teach_major') . ':', 'majors', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        $selected_majors = explode(",", $person_info->teach_major);
        echo form_dropdown('majors', $major, $selected_majors, 'class="form-control" id="majors" multiple="multiple"');
        echo form_hidden('teach_major');
        ?>
    </div>
</div> -->

<!-- <div class="form-group">  
    <?php echo form_label(lang('common_course') . ':', 'course_ids', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
        $selected_courses = explode(",", $person_info->teach_course_ids);
        echo form_dropdown('course_ids', $courses, $selected_courses, 'class="form-control" id="course_ids" multiple="multiple"');
        echo form_hidden('teach_course_ids');
        ?>
    </div>
</div> -->

<div class="form-group">  
    <?php echo form_label(lang('common_subject') . ':', 'subject', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
    <div class="col-sm-9 col-md-9 col-lg-5">
        <?php
            $selected_subject = explode(",", $person_info->teach_course_ids);
            echo form_dropdown('subject', $subject, $selected_subject, 'class="form-control" id="subject_ids" multiple="multiple"');
            // echo form_hidden('teach_course_ids');
        ?>
    </div>
</div>


<script type="text/javascript">
    $(function(){
        $('select[name="emp_master_department_id"]').change(function(){
            var id = $(this).val();
            var url_title = "<?=site_url('professors/suggestion_major')?>";
            var dataDepartment = { id: id};                
                $.ajax({
                    type: "POST",
                    url: url_title, 
                    data: dataDepartment,
                    dataType:"json",
                    success: function(get_data){
                        $( "select[name='majors']" ).prop('disabled', false);
                        $( "select[name='majors']" ).html('<option> -- -- </option>');
                        $.each(get_data,function(key,val){
                            var opt = $('<option />'); 
                            opt.val(val.skill_id);
                            opt.text(val.skill_name);
                            $( "select[name='majors']" ).append(opt);
                        });
                    },
                });
        });

        $('select[name="majors"]').change(function(){
            var id = $(this).val();
            var url_title = "<?=site_url('professors/suggestion_subject')?>";
            var dataMajor = { id: id};                
                $.ajax({
                    type: "POST",
                    url: url_title, 
                    data: dataMajor,
                    dataType:"json",
                    success: function(get_data){
                        $( "select[name='subject']" ).html('<option> -- -- </option>');
                        // $( ".options" ).html('');
                        $.each(get_data,function(key,val){
                            $( ".options" ).append('<li class="opt"><span><i></i></span><label>History of Cambodia Law</label></li>');
                            var opt = $('<option />');
                            opt.val(val.sub_id);
                            opt.text(val.subject_name);
                            $( "select[name='subject']" ).append(opt);
                        });
                            
                    },
                });
        });
    });
</script>


<!-- ccccccccccccccccccccccccccccccc -->


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css"
        rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
        rel="stylesheet" type="text/css" />
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('#lstFruits').multiselect({
                includeSelectAllOption: true
            });
        });
    </script>
    <select id="lstFruits" multiple="multiple">
        <option value="1">Mango</option>
        <option value="2">Apple</option>
        <option value="3">Banana</option>
        <option value="4">Guava</option>
        <option value="5">Orange</option>
    </select>


<!-- ccccccccccccccccccccccccccccccc -->