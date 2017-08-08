<?php
$mintime = getSliderTime(time());

//debugPrint($mintime);

$appId = 0;
$class = 'id="sel" style="background-color: #F0F1F3"';
?>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>script/plugins/datetime/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>script/plugins/datetime/jquery-ui-sliderAccess.js"></script>

<style type="text/css">
    /* css for timepicker */
    .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
    .ui-timepicker-div dl { text-align: left; }
    .ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
    .ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
    .ui-timepicker-div td { font-size: 90%; }
    .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

    .ui-timepicker-rtl{ direction: rtl; }
    .ui-timepicker-rtl dl { text-align: right; }
    .ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
</style>

<script>
    
    var minutes = <?php echo $mintime[4] ?>;
    var hour = <?php echo $mintime[3] ?>;

    var year = <?php echo $mintime[0] ?>;
    var month = <?php echo $mintime[1] ?>-1; // beware: January = 0; February = 1, etc.
    var day = <?php echo $mintime[2] ?>;
    
    $(document).ready(function(){
        //$("td[id=sel]").animate({ backgroundColor: "white" }, 5000);
        var date = new Date ();
        
        date.setHours ( date.getHours());

        $('#datepicker').datetimepicker({
            minDate: new Date(year, month, day, hour, minutes),
            timeFormat: "hh:mm TT"
        });
        
        $("div[id=sBox]").delay(5000).slideUp();
        
        $('#myTable').dataTable( {
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
        $('#myTable_12').dataTable( {
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
        
        

        //        var visitortime = new Date();
        //        var visitortimezone = "GMT " + -visitortime.getTimezoneOffset()/60;
        //        
        //        alert(visitortimezone);
        

    });

    

</script>

<script class="jsbin" src="<?php echo base_url(); ?>script/plugins/datatable/jquery.dataTables.nightly.js"></script>

<!-- START PAGE -->
<div id="page">
    <!-- start page title -->
    <div class="page-title">
        <div class="in">
            <div class="titlebar">	
                <h2>APPOINTMENT</h2>	
                <p>Appointment overview of some features</p></div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- end page title -->

    <!-- START CONTENT -->
    <div class="content">
        <!-- START SIMPLE FORM -->
        <div class="simplebox grid740">
            <?php if ($this->session->userdata('successMessage')) { ?>
                <div id="sBox" class="albox succesbox" style="z-index: 690;">
                    <b>Success :</b> Appointment successfully added. 
                    <a class="close tips" href="#" original-title="close">close</a>
                </div>
                <?php
                $appId = $this->session->userdata('appId');

                $data['successMessage'] = FALSE;
                $data['appId'] = FALSE;
                $this->session->unset_userdata($data);
            }
            ?>
            <div class="titleh">
                <h3>Add Appointment [Current Time : <?php echo getSiteTime(time()); ?>]</h3>
            </div>
            <div class="body">
                <form onsubmit="return appointmentValidation();" id="form2" name="form2" method="post" action="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_APPOINTMENT); ?>">
                    <div class="st-form-line">
                        <span class="st-labeltext">Name : </span>	
                        <input name="<?php echo DBConfig::TABLE_APPOINTMENT_ATT_USERNAME; ?>" type="text" class="st-forminput" id="textfield1" style="width:510px" value="" /> 
                        <p id="errorName" class="st-form-error" style="display: none;">Please Enter Name</p>
                        <div class="clear"></div>
                    </div>                    

                    <!-- This is uniform upload input -->
                    <div class="st-form-line">
                        <span class="st-labeltext">Date/Time : </span>	
                        <!-- start default date picker -->
                        <script type="text/javascript">
                            $(function() {
                                //$( "#datepicker" ).datepicker({minDate : 0, dateFormat : 'yy-mm-dd'});
                            });
                        </script>
                        <input name="<?php echo DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE; ?>" type="text" id="datepicker" class="datepicker-input" style="width:180px;" />

                        <p id="errorDate" class="st-form-error" style="display: none;">Please Select Date and Time</p>

                        <!-- end default date picker -->
                        <div class="clear"></div> 
                    </div>

                    <div class="st-form-line">
                        <span class="st-labeltext">Fee : </span>	
                        <input name="<?php echo DBConfig::TABLE_APPOINTMENT_ATT_FEE; ?>" type="text" class="st-forminput" id="textfield97" style="width:300px" />
                        <p id="errorFee" class="st-form-error" style="display: none;">Please Enter Fee</p>
                        <div class="clear"></div>
                    </div>

                    <!-- This is uniform selectbox - view this item class -->
                    <div class="st-form-line">
                        <span class="st-labeltext">Doctor : </span>	
                        <select name="<?php echo DBConfig::TABLE_APPOINTMENT_ATT_DOCTOR_ID; ?>" id="select1" class="uniform">
                            <option value="">Select Doctor ...</option>
                            <?php
                            if (!empty($doctorList)) {
                                foreach ($doctorList as $doctor) {
                                    ?>
                                    <option value="<?php echo $doctor[DBConfig::TABLE_DOCTOR_ATT_DOCTOR_ID]; ?>"><?php echo $doctor[DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME]; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <p id="errorDoctor" class="st-form-error" style="display: none;">Please Select Doctor</p>
                        <div class="clear"></div> 
                    </div>

                    <div class="button-box">
                        <input type="submit" name="button" id="button" value="Add" class="st-button"/>
                        <input type="reset" name="button" id="button2" value="Reset" class="st-clear"/>
                    </div>

                </form>

            </div>
        </div>
        <!-- END SIMPLE FORM -->

        <div class="clear"></div>
        <!-- START TABLE -->
        <div class="simplebox grid740" id="upcoming" style="padding-bottom: 0px">
            <?php if ($this->session->userdata('delSuccess')) { ?>
                <div class="albox succesbox" style="z-index: 690;">
                    <b>Success :</b> Appointment successfully Deleted. 
                    <a class="close tips" href="#" original-title="close">close</a>
                </div>
                <?php
                $data['delSuccess'] = FALSE;
                $this->session->unset_userdata($data);
            }
            ?>
            <div class="titleh">
                <h3>Upcoming Appointments</h3>
            </div>
            <table id="myTable_12" class="display"> 
                <thead> 
                    <tr>
                        <th>Name</th> 
                        <th>Appointment Token</th> 
                        <th>Fee</th> 
                        <th>Doctor</th>
                        <th>Date/Time</th> 
                        <th>Options</th> 
                    </tr> 
                </thead>
                <tbody>
                    <?php
                    if (!empty($appointmentList)) {
                        foreach ($appointmentList as $upAppointment) {
                            if ($upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] == 0 || $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] == 1) {
                                $now = time();
                                $appTime = $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE];

                                $currentTime = time();

                                $temp = $currentTime - $appTime;
                                if ($temp <= 20 * 60) {
                                    ?>
                                    <tr id="<?php echo $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID]; ?>"> 
                                        <td <?php echo ($appId == $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID]) ? $class : '' ?>><?php echo ucwords($upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_USERNAME]); ?></td> 
                                        <td <?php echo ($appId == $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID]) ? $class : '' ?>><span style="text-transform: uppercase;" ><?php echo $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN]; ?></span></td> 
                                        <td <?php echo ($appId == $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID]) ? $class : '' ?>>$<?php echo $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_FEE]; ?></td> 
                                        <td <?php echo ($appId == $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID]) ? $class : '' ?>><?php echo $upAppointment[DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME]; ?></td> 
                                        <td <?php echo ($appId == $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID]) ? $class : '' ?>><?php echo getSiteTime($upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]); ?></td> 
                                        <td <?php echo ($appId == $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID]) ? $class : '' ?>>


                                            <?php
                                            if ($temp <= 20 * 60) {
                                                ?>

                                                <a href="<?php echo site_url(SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_START_APPOINTMENT . '/' . $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN]); ?>">Start Appointment</a><br/>
                                                <?php
                                            }
                                            ?>
                                            <a href="javascript:;" onclick="return deleteAppoiment('<?php echo $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_ID] ?>','<?php echo SiteConfig::CONTROLLER_ADMINISTRATOR . SiteConfig::METHOD_ADMINISTRATOR_DELETE_APPOINTMENT ?>');">Delete Appointment</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="clear"></div>
        <!-- START TABLE -->
        <div class="simplebox grid740" id="past">

            <div class="titleh">
                <h3>Past Appointments</h3>

            </div>
            <table id="myTable" class="display"> 
                <thead> 
                    <tr>
                        <th>Name</th> 
                        <th>Appointment Token</th> 
                        <th>Fee</th> 
                        <th>Doctor</th>
                        <th>Date/Time</th> 
                        <th>Outcome</th> 
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    if (!empty($appointmentList)) {
                        foreach ($appointmentList as $ovAppointment) {
                            $appTime = $upAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE];

                            $currentTime = time();

                            $temp = $currentTime - $appTime;


                            if ($ovAppointment[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] == '3' || $temp > 20 * 60) {
                                ?>
                                <tr> 
                                    <td><?php echo ucwords($ovAppointment[DBConfig::TABLE_APPOINTMENT_ATT_USERNAME]); ?></td> 
                                    <td><span style="text-transform: uppercase;" ><?php echo $ovAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN]; ?></span></td> 
                                    <td>$<?php echo $ovAppointment[DBConfig::TABLE_APPOINTMENT_ATT_FEE]; ?></td> 
                                    <td><?php echo $ovAppointment[DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME]; ?></td> 
                                    <td><?php echo getSiteTime($ovAppointment[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]); ?></td> 
                                    <td>
                                        <?php if ($ovAppointment[DBConfig::TABLE_APPOINTMENT_ATT_STATUS] == 3) { ?>
                                            <a href="javascript:void(0)">Complete</a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)">No Show</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END CONTENT -->
</div>
<!-- END PAGE -->