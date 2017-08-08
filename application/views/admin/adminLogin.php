<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Tuvits Administrator Login</title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/reset.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/root.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/grid.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/typography.css" /> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/jquery-plugin-base.css" />

        <!--[if IE 7]>	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/admin/style/ie7-style.css" />	<![endif]-->
    </head>
    <body>



        <div class="loginform">
            <div class="title"> <img src="<?php echo base_url(); ?>assets/admin/img/logo.png" width="112" height="35" /></div>
            <div class="body">
                <form id="form1" name="form1" method="post" action="<?php echo site_url('administrator/login'); ?>">

                    <?php
                    if ($this->session->userdata('errorLogin')) {
                        ?>
                        <label class="log-lab" style="color: red;">Invalid Username and/or Password</label>
                        <?php
                    }
                    $data['errorLogin'] = FALSE;
                    $this->session->unset_userdata($data);
                    ?>

                    <label class="log-lab">Username</label>
                    <input name="<?php echo DBConfig::TABLE_ADMIN_ATT_USERNAME; ?>" type="text" class="login-input-user" id="textfield" placeholder="Username"/>
                    <label class="log-lab">Password</label>
                    <input name="<?php echo DBConfig::TABLE_ADMIN_ATT_PASSWORD; ?>" type="password" class="login-input-pass" id="textfield" placeholder="Password"/>
                    <input type="submit" name="login" id="button" value="Login" class="button"/>
                </form>
            </div>
        </div>

        </div>
    </body>
</html>
