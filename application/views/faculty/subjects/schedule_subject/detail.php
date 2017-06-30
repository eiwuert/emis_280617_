<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
        <?php echo "Scholarship"; ?>
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

                    <section class="content" style="min-height: 543px;">
                        <div class="col-xs-12">
                            <div class="box box-primary view-item">
                                <div class="stu-status-view">
                                    <table class="table  detail-view">
                                        <tbody>
                                        <tr>
                                            <th colspan="7">
                                                <center><h3>សាកលវិទ្យាល័យគ្រប់គ្រង និងសេដ្ឋកិច្ច</h3></center>
                                                <center><h3>UNIVERSITY OF MANAGEMENT AND ECONOMICS</h3></center>
                                                <br>
                                                <center>SCHOOL OF BUSINESS ADMINISTRATION</center>
                                                <center>Bachelor Degree Schedule, Major in Business Administration</center>
                                                <center>Year 2 Semester 1 Promotion 11 Moring Class</center>
                                                <center>Academic Year 2015-2016 <center>

                                            </th>
                                        </tr>
                                        <tr>
                                                <th><center>Subject</center></th>
                                                <th><center>Time</center></th>
                                                <th><center>Monday</center></th>
                                                <th><center>Tuesday</center></th>
                                                <th><center>Wednesday</center></th>
                                                <th><center>Thursday</center></th>
                                                <th><center>Friday</center></th>
                                        </tr>
                                        <tr>
                                            <td>History of Cambodia Law</td>
                                            <td>7: 30 AM- 9:00 AM</td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center></td>
                                            <td><center></td>
                                        </tr>
                                        <tr>
                                            <td>Consitution Law in Camparative Perspective</td>
                                            <td>7: 30 AM- 9:00 AM</td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                        </tr>
                                        <tr>
                                            <td>World legal Systems</td>
                                            <td>7: 30 AM- 9:00 AM</td>
                                            <td><center></td>
                                            <td><center></td>
                                            <td><center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                        </tr>
                                        <tr>
                                            <td>Penal Law</td>
                                            <td>7: 30 AM- 9:00 AM</td>
                                            <td><center></td>
                                            <td><center></td>
                                            <td><center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center></td>
                                        </tr>
                                        <tr>
                                            <td>Civil Procedure Code</td>
                                            <td>7: 30 AM- 9:00 AM</td>
                                            <td><center></td>
                                            <td><center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                            <td><center><span class="glyphicon glyphicon-remove"></span></center></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>

                    <?php if ($pagination) { ?>
                        <div class="pagination hidden-print alternate text-center fg-toolbar ui-toolbar" id="pagination_bottom" >
                            <?php echo $pagination; ?>
                        </div>
                    <?php } ?>
                    <!-- End -->
                </div> 
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