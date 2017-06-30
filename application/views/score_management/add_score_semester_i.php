<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-clipboard"></i>
        <?php echo "Score Management (Score Semester I)"; ?>
    </h1>
</div>



    <div class="page-content">

        <div class=" pull-right">
            <div class="row">
                <div class="col-md-12 center" style="text-align: center;">                  
                    <div class=" ">
                        
                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/score_semester_ii/-1/",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-success',
                                        'title' => 'New'
                                    )
                                );
                            // }
                        ?>

                        <?php //if ($this->Employee->has_module_action_permission($controller_name, 'delete', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                            <?php
                                echo anchor(
                                    "$controller_name/delete",
                                    '<i title="' . lang('common_delete') . '" class="fa fa-trash-o tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . lang('common_delete') . '</span>',
                                    array(
                                        'id' => 'delete',
                                        'class' =>'btn btn-danger disabled delete_inactive ',
                                        'title' => $this->lang->line("common_delete")
                                    )
                                );
                            ?>
                        <?php //} ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <?php echo form_open("$controller_name/search", array('id' => 'search_form', 'autocomplete' => 'off')); ?>
            <input type="text" name ='search' id='search' value=""   placeholder="<?php echo lang('common_search'); ?>"/>
            </form>
        </div>
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
                                       	New From Score Semester I
                                    </h5>
                                </div>

                                <div class="widget-body">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">

                                    
                                    <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                                        
                                                <tr>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Information to Business:</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Credit</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Ranking</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Score</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                </tr>
                                                <tr>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Business Math:</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Credit</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Ranking</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Score</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                </tr>
                                                <tr>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Public & Office Administration:</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Credit</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Ranking</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Score</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                </tr>
                                                <tr>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Contract Law:</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Credit</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Ranking</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Score</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                </tr>
                                                <tr>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Computer Administration:</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Credit</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Ranking</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Score</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                </tr>
                                                <tr>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Business English:</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Credit</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Ranking</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                                                                    <div class="col-xs-12 col-sm-11">
                                                                        <div>
                                                                                <label class="control-label" for="">Score</label><input type="text" id="" class="form-control" name="" value=""><div class="help-block"></div>
                                                                        </div>    
                                                                    </div>

                                                                    <!-- <div class="col-xs-3 col-sm-8" style="padding-top: 25px;">
                                                                            <button type="button" class="btn btn-danger" data-html="true" data-toggle="popover" title="" data-trigger="focus" data-content="Unique Id is used as login username with <b>STU </b>prefix. </br> Example: If Unique id : 123 so, Username : STU123" data-original-title="Student Login Note"><i class="fa fa-info-circle"></i></button>
                                                                    </div> -->
                                                               </div>
                                                            </td>
                                                </tr>

                                    </table>




                        
                                                <div class="form-actions">
                                                    <div>
                                                        <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/semester_i")?>">Cancel</a>
                                                    </div>
                                                    <div>
                                                        <input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary pull-right">                
                                                    </div>
                                                </div>


                                </form> 
                                </div>  


                                       
                        
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
</script>
<?php $this->load->view("partial/footer"); ?>

