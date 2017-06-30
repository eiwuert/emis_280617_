<section class="content" style="min-height: 303px;">
    <style>
    .box .box-solid {
         background-color: #F8F8F8;
    }
    </style>
    <div class="col-xs-12">
        <div class="col-lg-8 col-sm-8 col-xs-12 no-padding">
            <h3 class="box-title"><i class="fa fa-edit"></i> <?php echo lang('employees_update_address_details'); ?> :  <?php echo $person_info->last_name.' '.$person_info->first_name; ?> </h3>
        </div>
        <div class="col-xs-4"></div>
        <div class="col-lg-4 col-sm-4 col-xs-12 no-padding" style="padding-top: 20px !important;">
    	   <div class="col-xs-4"></div>
    	   <div class="col-xs-4"></div>
    	   <div class="col-xs-4 left-padding">
    	       <a class="btn btn-block btn-back" href="<?php echo site_url("$controller_name/detail/$person_info->person_id"); ?>" onclick="js:history.go(-1);return false;"><?php echo lang('common_back') ?></a>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-lg-12">
        <div class="box-info box view-item col-xs-12 col-lg-12">
            <div class="stu-master-update">
                <?php
                    echo form_open($controller_name.'/do_update_academic/' . $person_info->person_id, array('id' => 'academic_form', 'class' => 'form-horizontal'));
                ?>
                    
                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('common_background'); ?></h4>
                            <div class="clearboth"></div>
                        </div>

                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-6 col-lg-6">	
                            	    <div class="field-empaddress-degree_level">
                                        <label class="control-label" for="degree_level"><?php echo lang('common_degree'); ?></label>
                                        <?php echo form_dropdown("degree_level", $degree, $person_info->degree_level, 'class="form-control" id="degree_level"');?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                               	    <div class="field-empaddress-skill">
                                        <label class="control-label" for="skill"><?php echo lang('common_professional_background')?></label>
                                        <input type="text" id="skill" class="form-control" name="skill" value="<?php echo $person_info->skill; ?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--/ box-body -->
                    </div> <!--/ box -->

                    <div class="box box-solid box-info col-xs-12 col-lg-12 no-padding">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-info-circle"></i> <?php echo lang('common_major_teach'); ?></h4>
                            <div class="clearboth"></div>
                        </div>

                        <div class="box-body">
                            <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                <div class="col-xs-12 col-sm-6 col-lg-6">
                                	<div class="field-empaddress-majors">
                                        <label class="control-label" for="majors"><?php echo lang('employees_teach_major')?></label>
                                            <?php
                                            $selected_majors = explode(",", $person_info->teach_major);
                                            echo form_dropdown('majors', $major, $selected_majors, 'class="form-control" id="majors" multiple="multiple"');
                                            echo form_hidden('teach_major');
                                            ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-lg-6">   
                                    <div class="field-empaddress-faculty">
                                        <label class="control-label" for="faculty"><?php echo lang('employees_teach_faculty'); ?></label>
                                        <?php echo form_dropdown("teach_faculty", $faculty, $person_info->teach_faculty, 'class="form-control" id="faculty"');?>
                                    </div>
                                </div>
                            	<div class="col-xs-12 col-sm-6 col-lg-6">
                            	    <div class="field-empaddress-course_ids">
                                        <label class="control-label" for="course_ids"><?php echo lang('common_course')?></label>
                                                <?php
                                                $selected_courses = explode(",", $person_info->teach_course_ids);
                                                echo form_dropdown('course_ids', $courses, $selected_courses, 'class="form-control" id="course_ids" multiple="multiple"');
                                                echo form_hidden('teach_course_ids');
                                                ?>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div> <!--/ box-body -->
                    </div> <!--/ box -->

                    <div class="form-group col-xs-12 col-sm-6 col-lg-4 no-padding">
                	   <div class="col-xs-6">
                            <button type="submit" class="btn btn-block btn-info"><?php echo lang('common_update'); ?></button>
                        </div>
                	   <div class="col-xs-6">
                	       <a class="btn btn-default btn-block" href="<?php echo site_url("$controller_name/detail/$person_info->person_id"); ?>"><?php echo lang('common_cancel'); ?></a>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>   
        </div>
    </div>

</section>

<script type="text/javascript">
    $(function(){
        $('#majors').change(fucntion(){
            alert();
        });
    });
</script>