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
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
        </script>
        <!--[if IE 7]>
           <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/ie7.css">
        <![endif]-->
        <!--[if IE 8]>
           <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/ie8.css">
        <![endif]-->
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/site.js"></script> 
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                  <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->

        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/ico/favicon.ico"/>
    </head>
    <body>

        <div class="popUp">
            <div id="popup">
                <div id="popframe">
                    <div class="popNotification"></div><div class="popError"></div>&nbsp; 
                    <a id="goback" href="javascript:;" onclick="hideAll()">Go Back</a></p>
                </div>
            </div>
        </div>

        <?php
        if (isset($header)) {
            print($header);
        }
        if (isset($slider)) {
            print($slider);
        }
        if (isset($bottom)) {
            print($bottom);
        }
        if (isset($conversation)) {
            print($conversation);
        }
        if (isset($footer)) {
            print($footer);
        }
        ?>


        <!-- ================================================== --> 
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
