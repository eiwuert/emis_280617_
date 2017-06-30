<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title><?PHP echo lang('common_title_site');?> </title>
        <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>font-awesome/4.2.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/custom.css" />
        <link href="<?php echo base_url(); ?>css/ion.calendar.css" rel="stylesheet" type="text/css">
        
        <!-- page specific plugin styles -->
        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>fonts/fonts.googleapis.com.css" />
        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

        <?php foreach (get_css_files() as $css_file) { ?>
            <link rel="stylesheet" rev="stylesheet" href="<?php echo base_url() . $css_file['path'] . '?' . APPLICATION_VERSION; ?>" media="<?php echo $css_file['media']; ?>" />
        <?php } ?>

        <?php foreach (get_js_files() as $js_file) { ?>
            <script src="<?php echo base_url() . $js_file['path'] . '?' . APPLICATION_VERSION; ?>" type="text/javascript" language="javascript" charset="UTF-8"></script>
        <?php } ?>

        <!-- Date & Time -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-datepicker-1.4.0/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/LineControl-Editor/editor.css">
        <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url(); ?>css/jquery-ui.css"> -->
        <!-- ace settings handler -->
        <script src="<?php echo base_url(); ?>js/ace-extra.min.js"></script>
        <script type="text/javascript">
           var SITE_URL = "<?php echo site_url(); ?>";
        </script>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/c-stylesheet.css">

        <!-- Include the plugin's CSS and JS: -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-multiselect.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-multiselect.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/check_drop/sumoselect.css" />
        <script src="<?php echo base_url();?>assets/check_drop/jquery.sumoselect.js"></script>

        <!-- Initialize the plugin: -->
        <script type="text/javascript">
            $(document).ready(function() {
                window.Search = $('.search-box').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.' });
            });
        </script>
        <!-- selection -->
        <link href="<?php echo base_url();?>selection_ditecso/bootstrap-select.min.css" rel="stylesheet">
        <script src="<?php echo base_url();?>selection_ditecso/bootstrap-select.min.js"></script>
    </head>
 
    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default">
            <script type="text/javascript">
            try {
                ace.settings.check('navbar', 'fixed')
            } catch (e) {
            }
            </script>
            <div class="" id="navbar-container">

                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left col-xs-8">
                        <small>
                            <?php echo img(
                            array(
                                'src' => $this->Appconfig->get_logo_image()?$this->Appconfig->get_logo_image():base_url().'img/emis-logo.png',
                                'width' => '10%')); ?>
                        </small>
                </div>
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue" style="height:55px">
                            <a title="" href="" onclick="return false;">
                           
                            <span class="text">
				 <i class="icon fa fa-clock-o fa-2x"></i> 
                                    <?php echo date(get_time_format()); ?>
                                    <?php echo date(get_date_format()) ?>
                                </span></a>

                        </li>

                        <li class="dropdown light-blue" style="height: 55px">
                            <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">

                                <span class="user-info">
                                    <i class="glyphicon glyphicon-user fa-2x"></i>	<?php echo" <b> $user_info->first_name $user_info->last_name </b>"; ?>
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li class="user-header bg-light-blue">
                                <center>
                                    <?php
                                    if (isset($user_info->image_id)) {
                                        ?>
                                        <img src="<?php echo $user_info->image_id ? base_url() . 'app_files/view/' . $user_info->image_id : base_url() . 'img/avatar.png'; ?>" class="img-rounded" alt="User Image" width="150" height="100" />
                                        <?php
                                    } else {
                                        ?>
                                        <i class="glyphicon glyphicon-user width-50 "></i>
                                        <?php
                                    }
                                    ?>

                                </center>
                        </li>
                        <?php if ($this->Employee->has_module_permission('config', $this->Employee->get_logged_in_employee_info()->person_id)) { ?>
                            <li ><?php echo anchor("config", '<i class="icon fa fa-cog"></i><span class="text">' . lang("common_settings") . '</span>'); ?></li>
                        <?php } ?>

                        <li>
                            <a href="profile.html">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <?php
                            if ($this->config->item('track_cash') && $this->Sale->is_register_log_open()) {
                                echo anchor("sales/closeregister?continue=logout", '<i class="fa fa-power-off"></i><span class="text">' . lang("common_logout") . '</span>');
                            } else {
                                echo anchor("home/logout", '<i class="fa fa-power-off"></i><span class="text">' . lang("common_logout") . '</span>');
                            }
                            ?>
                        </li>
                    </ul>
                    </li>
                    </ul>
                </div>
            </div><!-- /.navbar-conta
                  iner -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                // $('.dropdown-toggle').dropdown()
            </script>
            <script type="text/javascript">
                try {
                    ace.settings.check('main-container', 'fixed')
                } catch (e) {
                }
            </script>


  <!--             <div id="sidebar" class="hidden-print minibar <?php echo $sidebar_class ?>">-->
            <?php if($this->session->userdata('auto_login')){

               }else{?>
            <div id="sidebar" class="sidebar  responsive">
                <ul class="nav nav-list">
                    <li <?php echo $this->uri->segment(1) == 'home' ? 'class="active"' : ''; ?>><a href="<?php echo site_url(); ?>"><i class="menu-icon icon fa fa-dashboard"></i><span class="hidden-minibar">Dashboard</span></a></li>
                    <?php $this->load->model('module');?>
                    <?php foreach ($allowed_modules->result() as $module) { ?>
                        <?php $is_sub = $this->Module->get_sub_module($module->module_id, $user_info->person_id); ?>
                        <?php if (!$module->sub_module) { ?>  
                            <li <?php echo $this->uri->segment(1) == $module->module_id  ? 'class="active opens"' : ''; ?> > 
                                <a href="<?php echo $is_sub->row() ? site_url('#') : site_url("$module->module_id"); ?> "  <?php if($is_sub->row()){ echo "class='dropdown-toggle'";}?>>
                                    <i class="menu-icon fa fa-<?php echo $module->icon; ?>"></i>
                                    <span class="active menu-text"><?php echo lang("module_" . $module->module_id) ?></span>
                                    <?php if ($is_sub->row()) {
                                        echo '<b class="arrow fa fa-angle-down"></b>';
                                    } ?>
                                </a>
                                <ul class="submenu" <?php echo $this->uri->segment(2) == $module->sub_module  ? 'class=" active open"' : ''; ?>>
                                 <?php foreach ($is_sub->result() as $sub_menu) { ?>
                                      <?php $is_sub2 = $this->Module->get_sub_sub_module($sub_menu->module_id, $user_info->person_id); ?>
                                        <?php if ($sub_menu->sub2_module == '') { ?>  
                                        <li <?php echo $this->uri->segment(1) == $sub_menu->module_id  ? 'class="active opens"' : ''; ?> > <a href="<?php echo site_url("$sub_menu->module_id")?>" <?php  if($is_sub2->row()){ echo "class='dropdown-toggle' ";}?> >
                                         <i class="fa fa-<?php echo $sub_menu->icon; ?>"></i>
                                         <?php echo lang("module_" . $sub_menu->module_id) ?>
                                           <?php if ($is_sub2->row()) {
                                        echo '<b class="arrow fa fa-angle-down"></b>';
                                    } ?>
                                            </a> 
                                            <ul class="submenu nav-show">
                                                <?php foreach ($is_sub2->result() as $sub2_menu):?>
                                                <li <?php echo $this->uri->segment(1) == $sub2_menu->module_id  ? 'class="active opens"' : ''; ?> >
                                                    <a href="<?php echo site_url("$sub2_menu->module_id")?>">
                                                        <i class="fa fa-<?php echo $sub2_menu->icon; ?>" ></i>
                                                         <?php echo lang("module_" . $sub2_menu->module_id) ?>
                                                    </a>
                                                </li>
                                                <?php endforeach;?>
                                            </ul>
                                        </li>
                                            
                                        <?php }
                                        
                                        } ?>
                            </ul>
                        </li>
                     <?php }} ?>

                </ul><!-- /.nav-list -->

                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>

            </div>
            <?php } ?>

            <div class="main-content">