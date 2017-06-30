<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title><?PHP echo lang('common_title_site'); ?></title>
        <link rel="icon" href="<?php echo base_url();?>favicon.ico" type="image/x-icon"/>
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
        <style type="text/css">
            .light-login {
                background: #dfe0e2 url(css/images/login.jpg) repeat !important;
                /*background-size: 100% !important;*/
            }
            .login-box .toolbar {
                background: orange;
                border-top: 2px solid orange;
            }
            .login-box .forgot-password-link {
                color: #fff;
            }
        </style>
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
                                            'width' => '65%')
                                    ); ?>
                                </h1>
                                <?php
                                $welcome = lang('common_welcome_to');
                                if ($this->config->item('company')) {
                                    $company = $this->config->item('company');
                                } else {
                                    $company = lang('common_software_name');
                                }
                                if ($this->config->item('company_kh')) {
                                    $company_kh = $this->config->item('company_kh');
                                } else {
                                    $company_kh = lang('common_software_name');
                                }
                                ?>
                                <h4 class="white" id="id-company-text"><?php echo $welcome; ?></h4>
                                <h4 class="white" id="id-company-text"><?php echo $company_kh; ?></h4>
                                <h4 class="white" id="id-company-text"><?php echo $company; ?></h4>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h5 class="header text-center green lighter bigger">
                                                <i class="ace-icon fa fa-key"></i> <?php echo lang('login_press_login_to_continue'); ?>
                                            </h5>
                                            <div class="space-6"></div>
                                            <?php echo form_open('login', array('class' => 'form login-form', 'id' => 'loginform', 'autocomplete' => 'off')) ?>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <?php
                                                            echo form_input(array(
                                                                'name' => 'username',
                                                                'id' => 'username',
                                                                'value' => $username,
                                                                'class' => 'form-control',
                                                                'placeholder' => lang('login_username'),
                                                                'autofocus'   => 'autofocus',
                                                                'size' => '30'));
                                                            ?>
                                                            <i class="ace-icon fa fa-user"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                             <?php
                                                                echo form_password(array(
                                                                    'name' => 'password',
                                                                    'id' => 'password',
                                                                    'value' => $password,
                                                                    'class' => 'form-control',
                                                                    'placeholder' => lang('login_password'),
                                                                    'size' => '30'));
                                                                ?>
                                                            <i class="ace-icon fa fa-lock"></i>
                                                        </span>
                                                    </label>

                                                    <div class="space"></div>

                                                    <div class="clearfix">
                                                        <button type="submit" class="btn btn-sm width-100 btn-success">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110"><?php echo lang('login_login'); ?></span>
                                                        </button>
                                                    </div>
                                                    
                                                    <?php if (isset($subscription_cancelled_within_14_days) && $subscription_cancelled_within_14_days === true) { ?>
                                                       <br/> <span class="text-danger text-center"><?php echo lang('login_subscription_cancelled_within_7_days'); ?></span>
                                                    <?php } ?>

                                                    <?php if (validation_errors()) { ?>
                                                        <br/>
                                                        <strong><span class="text-danger text-center"><?php echo validation_errors(); ?></span></strong>
                                                    <?php } ?>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /.widget-main -->

                                        <div class="toolbar clearfix">
                                            <div>
                                                <a href="<?php echo site_url().'login/reset_password';?>" class="forgot-password-link">
                                                    <i class="ace-icon fa fa-arrow-left"></i>
                                                    <?php echo lang('login_reset_password');?>
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
        <div class="col-md-5" style="margin-top: 18px;">
                <?php echo img(
                        array(
                            'src' => base_url().'img/emis-logo.png',
                            'width' => '20%')
                    ); ?>
            <div class="clear"></div>
        </div>
        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content" id='footer-content'>
                    <span class="bigger-120" style="color: white;">
                        <?php
                            if ($this->config->item('company_address')) {
                                $company_address = $this->config->item('company_address');
                            } else {
                                $company_address = lang('common_footer_copy_right');
                            }
                        ?>
                        <?php echo $company_address; ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- basic scripts -->
        <!--[if !IE]> -->
        <script src="<?php echo base_url();?>js/jquery.2.1.1.min.js"></script>
        <!-- <![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url();?>js/jquery.min.js'>"+"<"+"/script>");
        </script>

        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url();?>js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script type="text/javascript">
        <?php if($this->uri->segment(3)){ ?>
               $verdify_code = $('input[name="verdify_email"]').val();
               if($verdify_code != ""){
                 
               }
        <?php }?>
        </script>

    </body>
</html>
