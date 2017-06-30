<?php $this->load->view("partial/header"); ?>
<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>
    </div> 
    <div class="page-header" id='page-header'>
        <h1> 
        <i class="icon fa fa-list"></i>
        <?php echo "Subject"; ?>
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
                                            <th>ID</th>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <th>Subject</th>
                                            <td>History of Cambodia Law</td>
                                        </tr>
                                        <tr>
                                            <th>មុខវិជ្ជា</th>
                                            <td>ប្រវត្តិនៃច្បាប់កម្ពុជា</td>
                                        </tr>

                                        <tr>
                                            <th>Professor</th>
                                            <td>Name Professor</td>
                                        </tr>

                                        <tr>
                                            <th>Credit</th>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <th>Ohter</th>
                                            <td>Common Courses</td>
                                        </tr>

                                        <tr>
                                            <th>Course Coordinator Name:</th>
                                            <td></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="box-header with-border" style="background:#00c0ef;padding: 1px 10px 1px 10px;color: #fff;margin-right: 10px;">
                                <h4 class="box-title"><i class="fa fa-info-circle"></i> Schdule</h4>
                                <div class="clearboth"></div>
                            </div>

                            <table class="table  detail-view">
                                <tbody>
                                    <tr>
                                        <th>Year: 2016 -2017</th>
                                        <td>Monday</td>
                                        <td>Tuesday</td>
                                        <td>Wednesday</td>
                                        <td>Thursday</td>
                                        <td>Friday</td>
                                        <td>Satursday</td>
                                        <td>Sunday</td>
                                    </tr>
                                    <tr style="border-bottom:solid 2px #ccc">
                                        <th>Subject : name subject</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Year: 2016 -2017</th>
                                        <td>Monday</td>
                                        <td>Tuesday</td>
                                        <td>Wednesday</td>
                                        <td>Thursday</td>
                                        <td>Friday</td>
                                        <td>Satursday</td>
                                        <td>Sunday</td>
                                    </tr>
                                    <tr style="border-bottom:solid 2px #ccc">
                                        <th>Subject : name subject</th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                </tbody>
                            </table>
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