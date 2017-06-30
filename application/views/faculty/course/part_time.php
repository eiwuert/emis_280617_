<div class="col-xs-12">
    <h4 class="edusec-border-bottom-warning page-header edusec-profile-title-1">    
    <i class="fa fa-files-o"></i> Add / Edit</h4>
</div>

<div class="col-sm-12 col-md-12 col-xs-12">
    <!-- start -->
    <?php $getid = (!empty($get_edit->id))? $get_edit->id : '0' ?>
    <?php  echo form_open($controller_name.'/save_schedule/'.$course_id.'/'.$getid, array('id' => 'course_schedule_form', 'class' => 'form-horizontal'));?>
        <div class="panel-group year-schedule" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <div class="row-semester">
                                    
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <!-- <?php echo form_label('Times Schedule:', 'credit', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php echo form_dropdown('times_schedule', $times_schedule, $get_edit->time_schedule,'class="form-control" id="times_schedule"'
                                            ); ?>
                                        </div> -->

                                        <?php echo form_label('Time:', 'credit', array('class' => 'col-sm-3 col-md-3 col-lg-2 control-label')); ?>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <?php echo form_dropdown('time', $time, $get_edit->time_id,'class="form-control" id="time"'
                                            ); ?>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label('Satursday:', 'Satursday', array('class' => 'col-sm-2 col-md-2 control-label')); ?>
                                        <div class="col-sm-4 col-md-4">
                                            <?php
                                            echo form_dropdown(
                                                'sat_sub',
                                                $subjects,
                                                $get_edit->sat_sub,
                                                'class="form-control" id="sat_sub"'
                                            ); ?>
                                        </div>

                                        <div class="col-sm-4 col-md-4">
                                            <?php
                                            echo form_dropdown(
                                                'sat_prof',
                                                $employee,
                                                $get_edit->sat_prof,
                                                'class="form-control" id="sat_prof"'
                                            ); ?>
                                        </div>                                        
                                    </div>
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <?php echo form_label('Sunday:', 'Sunday', array('class' => 'col-sm-2 col-md-2 control-label')); ?>
                                        <div class="col-sm-4 col-md-4">
                                            <?php
                                            echo form_dropdown(
                                                'sun_sub',
                                                $subjects,
                                                $get_edit->sun_sub,
                                                'class="form-control" id="sun_sub"'
                                            ); ?>
                                        </div>

                                        <div class="col-sm-4 col-md-4">
                                            <?php
                                            echo form_dropdown(
                                                'sun_prof',
                                                $employee,
                                                $get_edit->sun_prof,
                                                'class="form-control" id="sun_prof"'
                                            ); ?>
                                        </div>                                        
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="form-actions">
        <input type="hidden" name="form_type" id="form_type" value="form2">
        <div>
            <input type="submit" name="submit" value="<?php echo lang('course_save_schedule'); ?>" id="submit" class="btn btn-primary pull-right" onClick="saveSchedule(event);">
        </div>
    </div>
    <?php echo form_close(); ?> 
    <!-- stop -->
</div>