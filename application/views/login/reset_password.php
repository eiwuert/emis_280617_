<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>CODINGATE | LOAN & PAWN</title>
        <link rel="icon" href="<?php echo base_url();?>codingate.ico" type="image/x-icon"/>
        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>font-awesome/4.2.0/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo base_url();?>fonts/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo base_url();?>css/ace.min.css" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="<?php echo base_url();?>css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo base_url();?>css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo base_url();?>css/ace-ie.min.css" />
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="<?php echo base_url();?>js/html5shiv.min.js"></script>
        <script src="<?php echo base_url();?>js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <?php if ($ie_browser_warning) { ?>
                                <div class="alert alert-danger">
                                    <?php
                                    echo lang('login_unsupported_browser');
                                    ?>
                                </div>
                                <?php }
                            ?>
                            <div class="center">
                                <h1>
                                    <?php echo img(
                                        array(
                                            'src' => $this->Appconfig->get_logo_image()?$this->Appconfig->get_logo_image():base_url().'img/emis-logo.png',
                                            )); ?>
                                </h1>
                                <h4 class="blue" id="id-company-text"><?php echo lang('common_software_name')?></h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h5 class="header text-center blue lighter bigger">
                                                 <i class="ace-icon fa fa-key"></i> <?php echo lang('login_reset_passwords'); ?>
                                            </h5>

                                            <div class="space-6"></div>

             <?php echo form_open('login/do_reset_password_notify', array('class' => 'form login-form')); ?>
                                            <span id="reset" class="form-group"><?php echo lang('login_reset_password_byemail'); ?></span>
                                            <br>
                <center>
                    <table id="tb">
                    <tr>
                        <td> <span><?php echo lang('login_email')?></span> </td>
                        <td> : </td>
                        <td> 
                    
                            <?php
                            echo form_input(array(
                                'name' => 'username_or_email',
                                'class' => 'form-control',
                                'placeholder' => lang('login_username'),
                                'size' => '20'));
                            ?>
                </td>
                    </tr>
                </table>
                </center>
                <div class="form-actions">
                   
                    <div class="pull-right" id="submit_reset"><input type="submit" class="btn btn-success" value="<?php echo lang('submit_reset_password'); ?>" /></div>
                </div>
                </form>
                                        </div><!-- /.widget-main -->

                                        <div class="toolbar clearfix">
                                            <div>
                                                <a href="<?php echo base_url().'login';?>" class="forgot-password-link">
                                                    <i class="ace-icon fa fa-arrow-left"></i>
                                                    <?php echo lang('back_to_login');?>
                                                </a>
                                                
                                            </div>
                                        </div>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->

                            </div><!-- /.position-relative -->

                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="<?php echo base_url();?>js/jquery.2.1.1.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="<?php echo base_url();?>js/jquery.1.11.1.min.js"></script>
<![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url();?>js/jquery.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php echo base_url();?>js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>

    </body>
</html>
