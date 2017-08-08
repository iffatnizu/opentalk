<link rel="stylesheet" href="<?php echo base_url(); ?>assets/nivo-slider/themes/default/default.css" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
<div class="container">
    <div class="slider-wrapper theme-default">
        <div class="joinAppoinment">
            <h3><i class="icon-user-md"></i><br/>  <i>JOIN YOUR <br/> APPOINTMENT</i></h3>
            <p>Enter The Appointment ID Provided<br/> By Your Doctor To Start</p>
            <p><input maxlength="7" onkeypress="return isNumber(event)" name="appointmentID" type="text" value="3456789" class="input-block-level" onblur="if(this.value == '') { this.value='3456789'}" onfocus="if (this.value == '3456789') {this.value=''}"/></p>
            <p><button name="submitAppointmentID" type="submit" class="btn btn-large btn-primary">Start!</button></p>
        </div>

        <div id="slider" class="nivoSlider">
            <img src="<?php echo base_url(); ?>assets/img/examples/slide-01.jpg" alt=""/>
            <img src="<?php echo base_url(); ?>assets/img/examples/slide-02.jpg" alt=""/>
            <img src="<?php echo base_url(); ?>assets/img/examples/slide-03.jpg" alt=""/>
            <img src="<?php echo base_url(); ?>assets/img/examples/slide-04.jpg" alt=""/>
        </div>

    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/nivo-slider/jquery.nivo.slider.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script>