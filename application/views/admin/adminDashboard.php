
<!-- START PAGE -->
<div id="page">
    <!-- start page title -->
    <div class="page-title">
        <div class="in">
            <div class="titlebar">	
                <h2>DASHBOARD</h2>	
                <p>This is a quick overview of some features</p>
            </div>
            <?php
            $selectedzonearr = getTimeZone();
            $selectedzone = $selectedzonearr[DBConfig::TABLE_SETTING_ATT_TIMEZONE];
            ?>
            <span style="float: right;margin-top: 10px">Set Time zone
                <select name="timezones" onchange="return changeTimeZone(this.value)">
                    <?php
                    foreach (timezonearray() as $zone => $string):
                        ?>
                        <option <?php
                    if ($zone == $selectedzone) {
                        echo 'selected="selected"';
                    }
                        ?> value="<?php echo $zone; ?>"><?php echo $string ?></option>     
                            <?php
                        endforeach;
                        ?>

                </select>
            </span>
            <div class="clear"></div>
        </div>
    </div>
    <!-- end page title -->

    <!-- START CONTENT -->
    <div class="content">
        <!-- start dashbutton -->
        <div class="grid740">
<!--            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton tips" title="Dashbutton with tipbox">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/bubbles.png" width="44" height="32" alt="icon" />
                <b>Support Center</b>	contact with support
            </a>
            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/graph.png" width="44" height="32" alt="icon" />
                <b>Daily Statistics</b>	see whats happened
            </a>
            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/image.png" width="44" height="32" alt="icon" />
                <b>Upload A Photo</b>	add a new photo
            </a>
            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/map.png" width="44" height="32" alt="icon" />
                <b>Google Maps</b>	check your location
            </a>-->
<!--            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/users.png" width="41" height="32" alt="icon" />
                <b>Users</b>	new Members
            </a>-->
            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_APPOINTMENT); ?>" class="dashbutton">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/personal-folder.png" width="44" height="32" alt="icon" />
                <b>Appointments</b>	Add New Appointment
            </a>
<!--            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/creadit-card.png" width="47" height="32" alt="icon" />
                <b>Creadit Card</b>	my credit cards
            </a>-->
            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_OPENTOK_SETTING); ?>" class="dashbutton">
                <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/settings.png" width="39" height="32" alt="icon" />
                <b>OpenTok Settings</b>	Setup your API Key, Session Id and Token
            </a>

<!--            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton">
    <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/frames.png" width="41" height="32" alt="icon" />
    <b>Widgets</b>	manage your widgets
</a>-->
<!--            <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DASHBOARD); ?>" class="dashbutton">
    <img src="<?php echo base_url(); ?>assets/admin/img/icons/dashbutton/applications.png" width="32" height="32" alt="icon" />
    <b>Applications</b>	manage your application
</a>-->
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END PAGE -->