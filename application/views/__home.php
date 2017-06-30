<?php $this->load->view("partial/header"); ?>
   <head>

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        </head>
    <div class="main-content-inner">

        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try {
                    ace.settings.check('breadcrumbs', 'fixed')
                } catch (e) {
                }
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Home</a>
                </li>
                <li class="active">Dashboard</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Dashboard
                </h1>
            </div><!-- /.page-header -->

             <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Course Management</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('course')?>">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-pink">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Configure</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('config')?>">
                            <div class="panel-footer">
                                <span class="pull-left pink"><b>View Details</b></span>
                                <span class="pull-right pink" ><i class="fa fa-arrow-circle-right" ></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-book fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Professors</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url().'professors'?>">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-table fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Reports</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url().'reports'?>">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
             <div class="row">
                                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-flag fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Score</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url().'score'?>">
                            <div class="panel-footer">
                                <span class="pull-left"><b>View Details</b></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-gray">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Employees</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('employees')?>">
                            <div class="panel-footer">
                                <span class="pull-left gray"><b>View Details</b></span>
                                <span class="pull-right gray"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-sea">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Students</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('students')?>">
                            <div class="panel-footer">
                                <span class="pull-left sea"><b>View Details</b></span>
                                <span class="pull-right sea"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-purple">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div><h4>Payment</h4></div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url('payment')?>">
                            <div class="panel-footer">
                                <span class="pull-left purple"><b>View Details</b></span>
                                <span class="pull-right purple"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>

<?php $this->load->view("partial/footer"); ?>