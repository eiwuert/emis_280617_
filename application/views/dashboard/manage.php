<?php $this->load->view("partial/header"); ?>



<style type="text/css">
        .panel-green {
            border-color: #5cb85c;
        }
        .panel-green .panel-heading {
            border-color: #5cb85c;
            color: #fff;
            background-color: #5cb85c;
        }
        .panel-red {
            border-color: #d9534f;
        }
        .panel-red .panel-heading {
            border-color: #d9534f;
            color: #fff;
            background-color: #d9534f;
        }
        .panel-purple {
            background-color: #9C27B0;
            color: white;
        }
        .panel-purple {
            background-color: #9C27B0;
            color: white;
        }
        .panel-primary {
            border-color: #337ab7;
        }
        .panel-primary>.panel-heading {
            color: #fff;
            background-color: #337ab7;
            border-color: #337ab7;
        }
            .panel-yellow {
            border-color: #f0ad4e;
        }
        .panel-yellow .panel-heading {
            border-color: #f0ad4e;
            color: #fff;
            background-color: #f0ad4e;
        }

        .current-div {
            background-color: #256F6C;
            color: white;
        }   
</style>


<div class="main-content-inner">
    <div class=" alert alert-info" id='top'>
        <?php echo create_breadcrumb(); ?>                                      
     </div> 
    <div class="page-header" id='page-header'>
     <h1> 
     <i class="icon fa fa-list"></i>
        <?php echo "Dashboard"; ?>
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

                        <div class="col-md-4 ">

                            <div class="panel">
                            <div class="panel-body">

                                    <div class="panel panel-green parents-envelope">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-envelope fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div><h4>Massage Of The Day</h4></div>
                                                    <div><h6>Status: Active</h6></div>
                                                    <div><h5>&nbsp;</h5></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?=site_url("$controller_name/message")?>" id="profit-and-loss">
                                            <div class="panel-footer">
                                                <span class="pull-left"><b><i class="menu-icon fa fa-table"></i> Create New</b></span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>                                
                                            
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4 ">

                            <div class="panel">
                            <div class="panel-body">

                                    <div class="panel panel-green parents-clipboard">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-clipboard fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div><h4>NOTICE</h4></div>
                                                    <div><h4>5</h4></div>
                                                    <div><small>Manage Student/Employee Dashboard Notice</small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?=site_url("$controller_name/notice")?>" id="profit-and-loss">
                                            <div class="panel-footer">
                                                <span class="pull-left"><b><i class="menu-icon fa fa-table"></i> Create New</b></span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>                                
                                            
                            </div>
                            </div>
                        </div>

                        <div class="col-md-4 ">

                            <div class="panel">
                            <div class="panel-body">

                                    <div class="panel panel-green parents-calendar">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <i class="fa fa-calendar fa-5x"></i>
                                                </div>
                                                <div class="col-xs-9 text-right">
                                                    <div><h4>EVENT</h4></div>
                                                    <div><h4></h4></div>
                                                    <div><small></small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="<?=site_url("$controller_name/event")?>" id="profit-and-loss">
                                            <div class="panel-footer">
                                                <span class="pull-left"><b><i class="menu-icon fa fa-table"></i> Create New</b></span>
                                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                <div class="clearfix"></div>
                                            </div>
                                        </a>
                                    </div>                                
                                            
                            </div>
                            </div>
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