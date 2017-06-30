<?php $this->load->view("partial/header"); ?>

<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
        </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
        <?php echo "Add Schedule"; ?>
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
                        Fields in red are required
                        <div class="widget-box">
                            <div class="widget-header widget-header-flat widget-header-small">
                                <h5 class="widget-title">
                                    <span class="icon">
                                        <i class="fa fa-align-justify"></i>
                                    </span>
                                    New Schedule
                                </h5>
                            </div>

                            <div class="widget-body" style="margin-left: 13px;">
                                <br>
                                <form action="" method="post" accept-charset="utf-8" id="" class="form-horizontal" novalidate="novalidate">
                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="deploma" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Deploma:</label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input class="filter form-control" name="deploma" type="text" value="" placeholder='bachelor Degree'/>
                                        </div>

                                        <label for="major" class="required col-sm-3 col-md-3 col-lg-3 align-right " aria-required="true">Major:</label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input class="filter form-control" name="major" type="text" value="" placeholder='Business Administration'/>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="year" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Year:</label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input class="filter form-control" name="year" type="text" value="" placeholder='2'/>
                                        </div>

                                        <label for="semester" class="required col-sm-3 col-md-3 col-lg-3 align-right " aria-required="true">Semester:</label>    
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input class="filter form-control" name="semester" type="text" value="" placeholder='1'/>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <label for="promotion" class="required col-sm-3 col-md-3 col-lg-2 " aria-required="true">Promotion:</label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input class="filter form-control" name="promotion" type="text" value="" placeholder='11'/>
                                        </div>

                                        <label for="times" class="required col-sm-3 col-md-3 col-lg-3 align-right" aria-required="true">Times:</label>
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input class="filter form-control" name="times" type="text" value="" placeholder='Morning'/>
                                        </div>
                                    </div>

                                    <div class="form-group" style="margin-bottom: 10px;">
                                        <div class='col-xs-12'>
                                            <a id="btnadd" class="btn btn-success pull-left" href="javascript:void(0);">ADD</a>
                                        </div>
                                        <br><br>
                                        <div class='col-xs-11'>
                                            <table id='table' class="tablesorter table table-bordered  table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="leftmost"></th>
                                                        <th>Subject</th>
                                                        <th>Time</th>
                                                        <th>Monday</th>
                                                        <th>Tuesday</th>
                                                        <th>Wednesday</th>
                                                        <th>Thursday</th>
                                                        <th>Friday</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <div>
                                            <a class="btn btn-active pull-right" style="margin-left:1%" href="<?=site_url("$controller_name/index")?>">Cancel</a>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary pull-right">
                                        </div>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div><!-- /.page-content -->
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btnadd").bind('click',function(){
            var res = '<tr>'+
                            '<td><a class="remove_field" href="javascript:void(0)"><span class="glyphicon glyphicon-remove"></span></a></td>'+
                            '<td>'+
                                '<select type="text" name="subject" value="" placeholder="subjects">'+
                                    '<option>History of Cambodia Law</option>'+
                                    '<option>Consitution Law in Camparative Perspective</option>'+
                                    '<option>World legal Systems</option>'+
                                    '<option>Penal Law</option>'+
                                    '<option>Civil Procedure Code</option>'+
                                '</select>'+
                            '</td>'+
                            '<td><input type="text" name="time" value="" placeholder="7: 30 AM- 9:00 AM"></td>'+
                            '<td><center><input type="checkbox" name="mon_ch"></center></td>'+
                            '<td><center><input type="checkbox" name="tue_ch"></center></td>'+
                            '<td><center><input type="checkbox" name="wed_ch"></center></td>'+
                            '<td><center><input type="checkbox" name="thu_ch"></center></td>'+
                            '<td><center><input type="checkbox" name="fri_ch"></center></td>'+
                        '</tr>';

            $("#table tbody:last").append(res);

            return false;
        });

        $("table").delegate('.remove_field','click',function(){
            var f = $(this).parent().parent();
            if(confirm('Are you sure want to delete ? This can not undo.')){
                f.remove();
            }

        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $('.ui-autocomplete').css('overflow','auto')
        $('.ui-autocomplete').css('overflow-x','hidden')
        $('.ui-autocomplete').css('max-height','400px')
    })
</script>
<?php $this->load->view("partial/footer"); ?>