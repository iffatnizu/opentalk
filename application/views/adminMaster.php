<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tuvits Administrator Panel</title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/root.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/grid.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/typography.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/jquery-plugin-base.css" />

        <!--[if IE 7]>	  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/ie7-style.css" />	<![endif]-->

        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery-ui-1.8.11.custom.min.js"></script>
<!--        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery-settings.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/toogle.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.tipsy.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.tablesorter.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/raphael.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/analytics.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/popup.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/fullcalendar.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.core.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.mouse.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.widget.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.slider.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.tabs.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.accordion.js"></script>-->
<!--        <script type="text/javascript" src="https://www.google.com/jsapi"></script>-->
<!--        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.dataTables.js"></script>-->
<!--        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.ui.datepicker.js"></script>-->

        <style>#stats{display:block;}</style>          
        <script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>
    </head>
    <body>

        <div class="popUp">

        </div>

        <div class="wrapper">




            <!-- START HEADER -->
            <div id="header">


                <!-- logo -->
                <div class="logo">	
                    <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR); ?>"><img src="<?php echo base_url(); ?>assets/admin/img/logo.png" width="112" height="35" alt="logo"/></a>	
                </div>

                <!-- profile box -->
                <div id="profilebox">
                    <a href="#" class="display">
                        <!--<img src="<?php echo base_url(); ?>assets/admin/img/simple-profile-img.jpg" width="33" height="33" alt="profile"/>-->
                        <b>Logged in as</b>	<span>Administrator</span>
                    </a>
                    <div class="profilemenu">
                        <ul>
                            <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGOUT); ?>">Logout</a></li>
                        </ul>
                    </div>

                </div>

                <div class="clear"></div>
            </div>
            <!-- END HEADER -->



            <!-- START MAIN -->
            <div id="main">

                <?php
                if ($this->uri->segment('2') != 'startappointment') {
                    ?>
                    <!-- START SIDEBAR -->
                    <div id="sidebar">
                        <!-- end searchbox -->

                        <!-- start sidemenu -->
                        <div id="sidemenu">
                            <ul>
                                <li class="<?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>"><a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>"><img src="<?php echo base_url(); ?>assets/admin/img/icons/sidemenu/laptop.png" width="16" height="16" alt="icon"/>Dashboard</a></li>
                                <li class="<?php echo ($this->uri->segment(2) == 'appointment') ? 'active' : ''; ?>"><a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_APPOINTMENT); ?>"><img src="<?php echo base_url(); ?>assets/admin/img/icons/sidemenu/copy.png" width="16" height="16" alt="icon"/>Appointment</a></li>
                                <li class="<?php echo ($this->uri->segment(2) == 'opentoksetting') ? 'active' : ''; ?>"><a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_OPENTOK_SETTING); ?>"><img src="<?php echo base_url(); ?>assets/admin/img/icons/sidemenu/copy.png" width="16" height="16" alt="icon"/>OpenTok Settings</a></li>
                                <li><a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_LOGOUT); ?>"><img src="<?php echo base_url(); ?>assets/admin/img/icons/error/error.png" width="16" height="16" alt="icon"/>Logout</a></li>
                                <!-- end submenu without icon -->

                            </ul>
                        </div>
                        <!-- end sidemenu -->

                    </div>
                    <!-- END SIDEBAR -->

                    <?php
                }
                ?>
                <?php echo (isset($adminContent)) ? $adminContent : ''; ?>

                <div class="clear"></div>
            </div>
            <div class="adminConversation">
                <?php
                if (isset($conversation)) {
                    print($conversation);
                }
                ?>
            </div>
            <!-- END MAIN -->


            <!-- START FOOTER -->
            <div id="footer">
                <div class="left-column">© Copyright 2013 | Tuvits | All rights reserved.</div>
                <div class="right-column">&nbsp;</div>
            </div>
            <!-- END FOOTER -->

        </div>

    </body>
</html>