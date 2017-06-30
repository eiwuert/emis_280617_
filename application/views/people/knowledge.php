
<legend class="page-header text-info"> &nbsp; &nbsp; <?php echo lang("employees_knowledge"); ?></legend>
    
    <div class="form-group">

        <?php echo form_label(lang('employees_dept') . ':', 'Department Type', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>  
        <div class="col-sm-9 col-md-9 col-lg-5">
            <?php
                echo form_dropdown('department_type', $emp_departments_type,$person_info->department_type, 'class="form-control"');
            ?>
        </div>
    </div>
    <div class="form-group">  
        <?php echo form_label(lang('employees_teach_major') . ':', 'majors', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
        <div class="col-sm-9 col-md-9 col-lg-5">
            <?php
                echo form_dropdown('majors[]', $major, $edit_major, 'class="selectpicker form-control" id="sl_major" multiple data-selected-text-format="count > 3"');
                echo form_hidden('teach_major');
            ?>
        </div>
    </div>

    <div class="form-group">  
        <?php echo form_label(lang('employees') . ':', 'professors', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
        <div class="col-sm-9 col-md-9 col-lg-5">
            <?php echo form_checkbox('as_employee_id', '1',(($person_info->as_employee_id == 1)? 'checked': ''))?>
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
                            $("#sl_major").html('');
                            $.each(get_data,function(key,val){
                                var opt = $('<option />', {
                                    value: val.skill_id,
                                    text: val.skill_name
                                });
                                $("#sl_major").append(opt);
                            });
                            $("#sl_major").selectpicker('refresh');
                        },
                    });
            });
        });
    </script>

