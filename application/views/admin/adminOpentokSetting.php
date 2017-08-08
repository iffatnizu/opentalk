<div id="page">
    <!-- start page title -->
    <div class="page-title">
        <div class="in">
            <div class="titlebar">	
                <h2>OpenTok Settings</h2>	
                <p>Setup your API Key, Session Id and Token</p></div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- end page title -->

    <!-- START CONTENT -->
    <div class="content">
        <!-- START SIMPLE FORM -->
        <div class="simplebox grid740">

            <div class="titleh">
                <h3>OpenTok Information 
                    <?php
                    if ($this->session->userdata('_success')) {
                        echo '[<font style="color:green">Opentok setting successfully updated</font>]';
                    }
                    $s['_success'] = false;
                    $this->session->unset_userdata($s);
                    ?>
                </h3>
            </div>
            <div class="body">
                <form id="form2" name="form2" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_OPENTOK_SETTING); ?>">
                    <div class="st-form-line">
                        <span class="st-labeltext">Api Key : </span>	
                        <input type="text" name="apiKey" value="<?php echo $setting[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_API_KEY] ?>"/> <?php echo form_error('apiKey') ?>
                        <div class="clear"></div>
                    </div>         

                    <div class="st-form-line">
                        <span class="st-labeltext">Session Id : </span>	
                        <textarea name="sessionId" class="st-forminput" id="textfield11" style="width:700px;color: #333333;"  rows="2" cols="47"><?php echo $setting[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_SESSION_ID] ?></textarea> <?php echo form_error('sessionId') ?>
                        <div class="clear"></div>
                    </div>    

                    <div class="st-form-line">
                        <span class="st-labeltext">Token : </span>	
                        <textarea name="token" class="st-forminput" id="textfield11" style="width:700px;color: #333333;"  rows="5" cols="47"><?php echo $setting[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_TOKEN] ?></textarea> <?php echo form_error('token') ?>
                        <div class="clear"></div>
                    </div> 


                    <div class="button-box">
                        <input type="submit" name="submit" id="button" value="Update Settings" class="st-button"/>
                    </div>

                </form>

            </div>
        </div>
        <!-- END SIMPLE FORM -->

        <div class="clear"></div>
        <!-- START TABLE -->

        <!-- START TABLE -->

    </div>
    <!-- END CONTENT -->
</div>

