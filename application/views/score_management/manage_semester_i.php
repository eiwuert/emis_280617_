<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-user"></i>
        <?php echo "Score Management (Semester I)"; ?>
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
                                    "$controller_name/index",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'Score Management' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-info',
                                        'title' => 'Score Management'
                                    )
                                );
                            // }
                        ?>

                       

                        <?php 
                            // if ($this->Employee->has_module_action_permission($controller_name, 'add_update', $this->Employee->get_logged_in_employee_info()->person_id)) {
                                echo anchor(
                                    "$controller_name/form_semester_i/-1/",
                                    '<i title="' . 'New' . '" class="fa fa-pencil tip-bottom hidden-lg fa fa-2x"></i><span class="visible-lg">' . 'New' . '</span>',
                                    array(
                                        'id' => 'new-person-btn',
                                        'class' => 'btn btn-success',
                                        'title' => 'New'
                                    )
                                );
                            // }
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <div>
        <div class="row">

            <div class="form-inline">
                  <div class="form-group">
                    <label for="year">Year: </label>
                    <select name="year" id="year" class="form-control">
                        <option value="yi">Year I</option>
                        <option value="yii">Year II</option>
                        <option value="yiii">Year III</option>
                        <option value="yiv">Year IV</option>
                    </select>
                  </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-30">
                <div class="widget-box" id="widgets">

                    <!-- Start -->
                    <!-- <div class="widget-content nopadding table_holder table-responsive" > -->
                        <?php // echo $manage_table; ?>         
                    <!-- </div>      -->

                    <div class="widget-content nopadding table_holder table-responsive">
                        <table class="tablesorter table table-bordered  table-hover" id="sortable_table">
                            <thead>
                                <tr>
                                    <th class="leftmost">
                                        <input type="checkbox" id="select_all">
                                    </th>
                                    <th>ID</th>
                                    <th>Studen ID</th>
                                    <th>Department ID</th>
                                    <th>IB</th>
                                    <th>BM</th>
                                    <th>POA</th>
                                    <th>CL</th>
                                    <th>CA</th>
                                    <th>BE</th>
                                    <th>Total Score</th>
                                    <th>Credit</th>
                                    <th>Ranking</th>
                                    <th>Other</th>
                                    <th class="rightmost header headerSortDown">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>1</td>
                                    <td>STU00001A</td>
                                    <td>Dep-002</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Other</td>
                                    <td class="action-buttons">
                                        <a href="<?=site_url("$controller_name/score_semester_i")?>" title="add_score" class="gray">
                                                <i class="ace-icon fa fa-edit bigger-150"></i>
                                        </a>

                                        <a href="#" title="view" class="gray">
                                                <i class="ace-icon fa fa-list bigger-150"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>


                                        <a href="#" title="delete" class="red">
                                                <i class="ace-icon fa fa-trash bigger-150"></i>
                                        </a>
                                    </td>
                                </tr>

                                <tr style="cursor: pointer;"><td><input type="checkbox" id="person_1" value="1"></td>
                                    <td>2</td>
                                    <td>STU00001A</td>
                                    <td>Dep-002</td>
                                    <td>78</td>
                                    <td>90</td>
                                    <td>90</td>
                                    <td>90</td>
                                    <td>90</td>
                                    <td>90</td>
                                    <td>223</td>
                                    <td>60%</td>
                                    <td>F</td>
                                    <td>Other</td>
                                    <td class="action-buttons">
                                        <a href="<?=site_url("$controller_name/score_semester_i")?>" title="add_score" class="gray">
                                                <i class="ace-icon fa fa-edit bigger-150"></i>
                                        </a>

                                        <a href="#" title="view" class="gray">
                                                <i class="ace-icon fa fa-list bigger-150"></i>
                                        </a>

                                        <a href="#" title="edit" class="green">
                                                <i class="ace-icon fa fa-pencil bigger-150"></i>
                                        </a>


                                        <a href="#" title="delete" class="red">
                                                <i class="ace-icon fa fa-trash bigger-150"></i>
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>            
                    </div>

                    <!-- note -->
                    <code>
                        btn Score Management = list all score (semester i ii & final exam) <br>
                        new = follow each table name (add new studen)<br>
                        icon-edit = add score management <br>

                    </code>
                    <!-- note -->

                    
                    <?php if ($pagination) { ?>
                        <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                            <?php echo $pagination; ?>
                        </div>
                    <?php } ?>
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