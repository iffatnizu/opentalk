<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tuvits.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Le styles -->
        <link href="<?php echo base_url(); ?>assets/css/site.css" rel="stylesheet"/>
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.js"></script> 
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                  <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.ico"/>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <h1 class="logo"><i class="icon-stethoscope"></i> Tuvits.com</h1>

<!--                    <img class="logo" src="<?php echo base_url(); ?>assets/img/logo.gif" alt="logo"/>-->
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/nivo-slider/themes/default/default.css" type="text/css" media="screen" />

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
        <div class="container">
            <div class="slider-wrapper theme-default">
                <div class="joinAppoinment">
                    <h3><i class="icon-user-md"></i><br/>  <i>JOIN YOUR <br/> APPOINTMENT</i></h3>
                    <p>Enter The Appointment ID Provided<br/> By Your Doctor To Start</p>
                    <p><input type="text" placeholder="3456789" class="input-block-level"/></p>
                    <p><button type="submit" class="btn btn-large btn-primary">Start!</button></p>
                </div>

                <div id="slider" class="nivoSlider">
                    <img src="<?php echo base_url(); ?>assets/img/examples/slide-01.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/img/examples/slide-02.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/img/examples/slide-03.jpg" alt=""/>
                    <img src="<?php echo base_url(); ?>assets/img/examples/slide-04.jpg" alt=""/>
                </div>

            </div>
        </div>


        <!-- Carousel================================================== -->
        <!--        <div id="myCarousel" class="carousel slide">
                    
                    <div class="carousel-inner">
                        <div class="item active"> <img src="<?php echo base_url(); ?>assets/img/examples/slide-01.jpg" alt=""/> </div>
                        <div class="item"> <img src="<?php echo base_url(); ?>assets/img/examples/slide-02.jpg" alt=""/> </div>
                        <div class="item"> <img src="<?php echo base_url(); ?>assets/img/examples/slide-03.jpg" alt=""/> </div>
                        <div class="item"> <img src="<?php echo base_url(); ?>assets/img/examples/slide-04.jpg" alt=""/> </div>
                    </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a> <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a> 
                </div>-->



        <script type="text/javascript" src="<?php echo base_url(); ?>assets/nivo-slider/jquery.nivo.slider.js"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
        </script>
        <!-- /.carousel --> 

        <!-- Marketing messaging and featurettes
                ================================================== --> 
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing"> 

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="span4">
                    <h2 class="blue"><i class="icon-ok"></i> Your Success</h2><hr/>
                    <img src="<?php echo base_url() ?>assets/img/examples/front-01.jpg" alt="img"/>
                    <p class="justify">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                    <p><a class="btn btn-info" href="#">View details &raquo;</a></p>
                </div>
                <!-- /.span4 -->
                <div class="span4">
                    <h2 class="blue"><i class="icon-ok"></i> Eating Right</h2><hr/>
                    <img src="<?php echo base_url() ?>assets/img/examples/front-03.jpg" alt="img"/>
                    <p class="justify">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <p><a class="btn btn-info" href="#">View details &raquo;</a></p>
                </div>
                <!-- /.span4 -->
                <div class="span4 extend">
                    <h2 class="blue">&nbsp;</h2><hr/>
                    <img src="<?php echo base_url() ?>assets/img/examples/front-03.png" alt="img"/>
                    <p class="justify" style="padding-bottom: 10px;"><i>"Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.ut fermentum."</i></p>
                    <p>&nbsp;</p>
                </div>
                <!-- /.span4 --> 
            </div>
            <!-- /.row --> 


        </div>
        <!-- /.container --> 

        <!-- FOOTER -->
        <footer>
            <div class="container">
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; <?php echo date("Y"); ?> Tuvits.com &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </div>
        </footer>

        <!-- Le javascript
                ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 

        <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
        <script type="text/javascript">
                !function ($) {
                $(function(){
                    // carousel demo
                    $('#myCarousel').carousel({
                        interval: 7000
                    })
                })
            }(window.jQuery)
        </script> 
        <script src="<?php echo base_url(); ?>assets/js/holder.js"></script>
    </body>
</html>
