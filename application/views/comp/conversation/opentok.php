<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/opentok/api.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/opentok/theme.css"/>
<title><?php echo $title; ?></title>
<?php
//echo date("Y-m-d H:i:s", $tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]);
//echo getCurrentDateTime();
//debugPrint($tokenDetails);

$appTime = $tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE];
$currentTime = time();
$timehours = ($appTime - $currentTime) / 3600;
$timeminutes = ($appTime - $currentTime) / 60;

//$futureappTime = $tokenDetails['futureAppointment'][DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE];
//$futurecurrentTime = time();
//$futuretimehours = ($futureappTime - $futurecurrentTime) / 3600;
//$futuretimeminutes = ($futureappTime - $futurecurrentTime) / 60;
//echo floor($futuretimeminutes);
//if (floor($timeminutes) < 16 && $tokenDetails['status'] == '1' && floor($futuretimeminutes) > 0) {
?>
<script type='text/javascript'>
    
    var isclockStart = false;
    var isConversationStart = false;
    $(document).ready(function(){
        //isAdminConnected();
        //$('#clock1').stopwatch();
        setInterval(function(){
            checkStatus();
        },5000) ;
        //        
        //        setInterval(function(){
        //                                
        //            clockStart();
        //        },6000) 
        
<?php
if ($tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED] != '1') {
    ?>
                setInterval(function(){
                                                                                                                                                                    
                    isAdminConnected();
                },3000)                   
    <?php
} else {
    ?>
                updateStatus();
                $("input[id=connectLink]").trigger("click");   
                                                                                                                            
                                                                                                                                     
    <?php
}
?>
    })
</script>
<?php
if ($tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_IS_ADMIN_CONNECTED] == '1') {
    ?>
    <script src="http://static.opentok.com/v1.1/js/TB.min.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
        //                   
        //      
        //        var apiKey = "29025882"; // OpenTok sample code key. Replace with your own API key. See https://dashboard.tokbox.com/projects
        //        var sessionId = "2_MX4yOTAyNTg4Mn4xMjcuMC4wLjF-U3VuIE1heSAxMiAyMzoyNzowMSBQRFQgMjAxM34wLjc0NzQzMTM0fg"; // Replace with your session ID. See https://dashboard.tokbox.com/projects 
        //        var token = "T1==cGFydG5lcl9pZD0yOTAyNTg4MiZzZGtfdmVyc2lvbj10YnJ1YnktdGJyYi12MC45MS4yMDExLTAyLTE3JnNpZz01YjA2ZWVhZjNiNjhlNDg4NjU2OWZlMTZmNzRjZmFkMWIwNzVlOTY5OnJvbGU9bW9kZXJhdG9yJnNlc3Npb25faWQ9Ml9NWDR5T1RBeU5UZzRNbjR4TWpjdU1DNHdMakYtVTNWdUlFMWhlU0F4TWlBeU16b3lOem93TVNCUVJGUWdNakF4TTM0d0xqYzBOelF6TVRNMGZnJmNyZWF0ZV90aW1lPTEzNjg0MjcyNjkmbm9uY2U9MC41NzQ4MzYwODIwMTQyNTYxJmV4cGlyZV90aW1lPTEzNzEwMTkyNjkmY29ubmVjdGlvbl9kYXRhPQ=="; // Replace with a generated token that has been assigned the moderator role.
        //        // See https://dashboard.tokbox.com/projects
        //        var session;
        //        var publisher;
        //
        //        var subscribers = {};
        //
        //        var PUBLISHER_WIDTH = 160;
        //        var PUBLISHER_HEIGHT = 150;
        //
        //        var subscriber_width = [120, 160, 220];
        //        var subscriber_height = [90, 120, 165];
        //
        //        // Un-comment either of the following to set automatic logging and exception handling.
        //        // See the exceptionHandler() method below.
        //        // TB.setLogLevel(TB.DEBUG);
        //        TB.addEventListener("exception", exceptionHandler);
        //
        //        if (TB.checkSystemRequirements() != TB.HAS_REQUIREMENTS) {
        //            alert("You don't have the minimum requirements to run this application."
        //                + "Please upgrade to the latest version of Flash.");
        //        } else {
        //            session = TB.initSession(sessionId);
        //
        //            // Add event listeners to the session
        //            session.addEventListener("sessionConnected", sessionConnectedHandler);
        //            session.addEventListener("sessionDisconnected", sessionDisconnectedHandler);
        //            session.addEventListener("streamCreated", streamCreatedHandler);
        //            session.addEventListener("streamDestroyed", streamDestroyedHandler);
        //            session.addEventListener("signalReceived", signalReceivedHandler);
        //        }
        //
        //        //--------------------------------------
        //        //  OPENTOK EVENT HANDLERS
        //        //--------------------------------------
        //
        //        function sessionConnectedHandler(event) {
        //            for (var i = 0;
        //            i < event.streams.length;
        //            i++) {
        //                addStream(event.streams[i]);
        //            }
        //
        //            hide("connectLink");
        //            show("disconnectLink");
        //            show("publishLink");
        //            show("signalLink");
        //            document.getElementById("myCamera").innerHTML = "";
        //        }
        //
        //        function sessionDisconnectedHandler(event) {
        //            event.preventDefault(); // Prevent the default cleanup because we do it ourselves
        //            // Remove the publisher
        //            if (publisher) {
        //                stopPublishing();
        //            }
        //
        //            // Remove all subscribers
        //            for (var streamId in subscribers) {
        //                removeStream(streamId);
        //            }
        //
        //            if (event.reason == "forceDisconnected") {
        //                alert("A moderator has disconnected you from the session.");
        //            }
        //
        //            show("connectLink");
        //            hide("disconnectLink");
        //            hide("publishLink");
        //            hide("unpublishLink");
        //            hide("signalLink");
        //        }
        //
        //        function streamCreatedHandler(event) {
        //            for (var i = 0;
        //            i < event.streams.length;
        //            i++) {
        //                addStream(event.streams[i]);
        //            }
        //        }
        //
        //        function streamDestroyedHandler(event) {
        //
        //            for (var i = 0;
        //            i < event.streams.length;
        //            i++) {
        //                removeStream(event.streams[i].streamId);
        //                if (event.streams[i].connection.connectionId == session.connection.connectionId &&
        //                    event.reason == "forceUnpublished") {
        //                    alert("A moderator has stopped publication of your stream.");
        //                    hide("unpublishLink");
        //                    show("publishLink");
        //                    publisher = null;
        //                } else {
        //                    removeStream(event.streams[i].streamId);
        //                }
        //            }
        //        }
        //
        //        function signalReceivedHandler(event) {
        //            alert("Received a signal from connection " + event.fromConnection.connectionId);
        //        }
        //
        //        /*
        //             If you un-comment the call to TB.addEventListener("exception", exceptionHandler) above, OpenTok calls the
        //             exceptionHandler() method when exception events occur. You can modify this method to further process exception events.
        //             If you un-comment the call to TB.setLogLevel(), above, OpenTok automatically displays exception event messages.
        //         */
        //        function exceptionHandler(event) {
        //            //alert("Exception: " + event.code + "::" + event.message);
        //        }
        //
        //        //--------------------------------------
        //        //  LINK CLICK HANDLERS
        //        //--------------------------------------
        //
        //        /*
        //             If testing the app from the desktop, be sure to check the Flash Player Global Security setting
        //             to allow the page from communicating with SWF content loaded from the web. For more information,
        //             see http://www.tokbox.com/opentok/docs/js/tutorials/helloworld.html#localTest
        //         */
        //        function connect() {
        //            //alert("a");
        //            session.connect(apiKey, token);
        //                                                                                                
        //        }
        //
        //        function disconnect() {
        //            session.disconnect();
        //        }
        //
        //        // Called when user wants to start publishing to the session
        //        function startPublishing() {
        //            if (!publisher) {
        //                var parentDiv = document.getElementById("myCamera");
        //                var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
        //                publisherDiv.setAttribute('id', 'opentok_publisher');
        //                parentDiv.appendChild(publisherDiv);
        //                publisher = TB.initPublisher(apiKey, 'opentok_publisher'); // Pass the replacement div id
        //                session.publish(publisher);
        //                hide('publishLink');
        //                $("input[class=start]").trigger("click");
        //                $("div[class=msg]").hide();
        //            }
        //        }
        //
        //        function stopPublishing() {
        //            if (publisher) {
        //                session.unpublish(publisher);
        //                hide("unpublishLink");
        //                show("publishLink");
        //                $("input[class=stop]").trigger("click");
        //            }
        //
        //            publisher = null;
        //        }
        //
        //        function signal() {
        //            session.signal();
        //        }
        //
        //        function forceDisconnectStream(streamId) {
        //            session.forceDisconnect(subscribers[streamId].stream.connection.connectionId);
        //        }
        //
        //        function forceUnpublishStream(streamId) {
        //            session.forceUnpublish(subscribers[streamId].stream);
        //        }
        //
        //        //--------------------------------------
        //        //  HELPER METHODS
        //        //--------------------------------------
        //
        //        function addStream(stream) {
        //            if (stream.connection.connectionId == session.connection.connectionId) {
        //                show("unpublishLink");
        //                return;
        //            }
        //            // Create the container for the subscriber
        //            var container = document.createElement('div');
        //            container.className = "subscriberContainer";
        //            var containerId = "container_" + stream.streamId;
        //            container.setAttribute("id", containerId);
        //            document.getElementById("subscribers").appendChild(container);
        //
        //            // Create the div that will be replaced by the subscriber
        //            var div = document.createElement('div');
        //            var divId = stream.streamId;
        //            div.setAttribute('id', divId);
        //            div.style.cssFloat = "top";
        //            container.appendChild(div);
        //
        //            // Create a div for the force disconnect link
        //            var moderationControls = document.createElement('div');
        //            moderationControls.style.cssFloat = "bottom";
        //            //moderationControls.innerHTML =
        //            //    '<a href="#" onclick="javascript:forceDisconnectStream(\'' + stream.streamId + '\')">Force Disconnect<\/a><br>'
        //            //    + '<a href="#" onclick="javascript:forceUnpublishStream(\'' + stream.streamId + '\')">Force Unpublish<\/a>';
        //            container.appendChild(moderationControls);
        //
        //            subscribers[stream.streamId] = session.subscribe(stream, divId);
        //        }
        //
        //        function removeStream(streamId) {
        //            var subscriber = subscribers[streamId];
        //            if (subscriber) {
        //                var container = document.getElementById(subscriber.id).parentNode;
        //
        //                session.unsubscribe(subscriber);
        //                delete subscribers[streamId];
        //
        //                // Clean up the subscriber container
        //                document.getElementById("subscribers").removeChild(container);
        //            }
        //        }
        //
        //        function show(id) {
        //            document.getElementById(id).style.display = 'block';
        //        }
        //
        //        function hide(id) {
        //            document.getElementById(id).style.display = 'none';
        //        }
        //                                  
        //        

        function clockStart(){

            if(isclockStart==false){
                $.ajax({
                    type:"GET",
                    url:"<?php echo base_url() . SiteConfig::CONTROLLER_CONVERSATION . SiteConfig::METHOD_CONVERSATION_CHECK_STATUS; ?>",
                    data:{
                        "check":"1"
                    },
                    success:function(res){
                        if(res=='1'){
                            isclockStart = true;
                            $("input[class=start]").trigger("click");
                        }
                    }
                })
            }
        }
                                                                                                                    
        function updateStatus(){
            $.ajax({
                type:"GET",
                url:"<?php echo base_url() . SiteConfig::CONTROLLER_CONVERSATION . SiteConfig::METHOD_CONVERSATION_UPDATE_STATUS; ?>",
                data:{
                    "check":"1"
                }
            })
        }
    </script>

    <script type="text/javascript">
        // Initialize API key, session, and token...
        // Think of a session as a room, and a token as the key to get in to the room
        // Sessions and tokens are generated on your server and passed down to the client
        // Initialize API key, session, and token...
        // Think of a session as a room, and a token as the key to get in to the room
        // Sessions and tokens are generated on your server and passed down to the client
        var apiKey = "<?php echo $setting[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_API_KEY] ?>"; // OpenTok sample code key. Replace with your own API key. See https://dashboard.tokbox.com/projects
        var sessionId = "<?php echo $setting[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_SESSION_ID] ?>"; // Replace with your session ID. See https://dashboard.tokbox.com/projects 
        var token = "<?php echo $setting[DBConfig::TABLE_OPENTOK_SETTINGS_ATT_TOKEN] ?>"; // Replace with a generated token that has been assigned the moderator role.


        // Enable console logs for debugging
        TB.setLogLevel(TB.DEBUG);

        // Initialize session, set up event listeners, and connect
        var session = TB.initSession(sessionId);
        session.addEventListener('sessionConnected', sessionConnectedHandler);
        session.addEventListener('streamCreated', streamCreatedHandler);
        session.connect(apiKey, token);
        function sessionConnectedHandler(event) {
            var parentDiv = document.getElementById("myCamera");
            var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
            publisherDiv.setAttribute('id', 'opentok_publisher');
            parentDiv.appendChild(publisherDiv);
            publisher = TB.initPublisher(apiKey, 'opentok_publisher'); // Pass the replacement div id
            session.publish(publisher);

            // Subscribe to streams that were in the session when we connected
            subscribeToStreams(event.streams);
        }

        function streamCreatedHandler(event) {
            // Subscribe to any new streams that are created
            subscribeToStreams(event.streams);
        }

        function subscribeToStreams(streams) {
            for (var i = 0; i < streams.length; i++) {
                // Make sure we don't subscribe to ourself
                if (streams[i].connection.connectionId == session.connection.connectionId) {
                    return;
                }

                // Create the div to put the subscriber element in to
                var container = document.createElement('div');
                container.className = "subscriberContainer";
                var containerId = "container_" + streams.streamId;
                container.setAttribute("id", containerId);
                document.getElementById("subscribers").appendChild(container);

                // Create the div that will be replaced by the subscriber
                var div = document.createElement('div');
                var divId = streams.streamId;
                div.setAttribute('id', divId);
                div.style.cssFloat = "top";
                container.appendChild(div);

                // Subscribe to the stream
                session.subscribe(streams[i], div.id);
            }
        }
    </script>
    <?php
}
?>
<script type="text/javascript">
    function checkStatus(){
        $.ajax({
            type:"GET",
            url:"<?php echo base_url() . SiteConfig::CONTROLLER_CONVERSATION . SiteConfig::METHOD_CONVERSATION_CHECK_STATUS; ?>",
            data:{
                "check":"1"
            },
            success:function(res){
                var arr = res.split("|");
                if(arr[0]=='0' && arr[1]=='0'){
                    var text = 'Doctor is not available now.please come back later'
                    $("div[class=msg]").html(text);
                }
                else if(arr[0]=='0' && arr[1]=='1'){
                    var text = 'Doctor is buzy now.please wait..'
                    $("div[class=msg]").html(text);
                }
                else if(arr[0]=='3'){
                    location.href = base_url;
                }
                else{
                    //$("div[class=msg]").html("");
                    $("div[class=msg]").hide();
                }
            }
        })
    }
    
    

    function isAdminConnected()
    {
        $.ajax({
            type:"GET",
            url:"<?php echo base_url() . SiteConfig::CONTROLLER_CONVERSATION . SiteConfig::METHOD_CONVERSATION_CHECK_ADMIN_CONNECT_STATUS; ?>",
            data:{
                "check":"1"
            },
            success:function(res){
                if(res=='1'){
                    location.reload();
                }
            }
        })

    }
</script>
<div id="preventReload">
<!--    <script type="text/javascript">
        window.onbeforeunload = function() {
            return "Are you sure you want to leave?";
        }
    </script>-->

</div>

<div class="container">
    <div id="main">
        <div id="support">

        </div>
        <div id="wrapper">
            <h1 style="font-size: 24px;margin-bottom: -16px;padding-left: 22px;">Appointment Time : <?php echo date("j F Y, g:i a", $tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]); ?></h1>
            <!--            <div id="header">
                            <div id="logo">           
                                <h3>Welcome</h3>
                                <p>
                                <u>Appoinment Details</u><br/>
                                Doctor : <?php echo $tokenDetails['doctorDetails'][DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME]; ?><br/> 
                                Time : <?php echo date("j F Y, g:i a", $tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_DATE]); ?><br/> 
                                Co-pay : $<?php echo $tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_FEE]; ?><br/>
                                TOKEN : <?php echo $tokenDetails[DBConfig::TABLE_APPOINTMENT_ATT_APPOINTMENT_TOKEN]; ?><br/>
                                Time Remaining : 
            <?php
            if (floor($timehours) >= 1) {
                echo floor($timehours) . ' hour\'s';
            } else if (floor($timehours) < 1 && floor($timeminutes) > 0) {
                echo floor($timeminutes) . ' minute\'s';
            } else {
                echo "00:00:00";
            }
            ?> 
            
                                </p>
                            </div>
                        </div>-->
            <div id="container">
                <div id="left">
                    <div id="userCameraWindow">
                        <div id="myCamera"> 
                        </div>
                    </div>
                    <div id="videobar" class="videobar">
                        <div id="localview">
                            <div id="links">
                                <input type="button" value="Connect" id ="connectLink" onClick="javascript:connect()" />
                                <input type="button" value="Leave" id ="disconnectLink" onClick="javascript:disconnect()" />
                                <input type="button" value="Start Publishing" id ="publishLink" onClick="javascript:startPublishing()" />
                                <input type="button" value="Stop Publishing" id ="unpublishLink" onClick="javascript:stopPublishing()" />
                                <input type="button" value="Signal" id ="signalLink" onClick="javascript:signal()" />
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.stopwatch.js"></script>
                    <!--                    <div class="displaytimer" id="clock1">
                    
                                        </div>-->

                    <ul id="nav">
                        <li class="first-child"><a href="javascript:;" onclick="getSupport()">Support</a></li>
                        <li><a target="_blank" href="mailto:<?php echo $tokenDetails['doctorDetails'][DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME]; ?>@opentok.com">E-mail <?php echo $tokenDetails['doctorDetails'][DBConfig::TABLE_DOCTOR_ATT_DOCTOR_NAME]; ?></a></li>
                        <li class="last-child"><a href="javascript:;" onclick="endAppoinment()">End Appoinment</a></li>
                    </ul>


                </div>
                <div id="right">
                    <div id="subscriberCameraWindow">
                        <div class="msg"></div>
                        <div id="subscribers">

                        </div>
                    </div>

                    <script type="text/javascript" charset="utf-8">
                        show('connectLink');
                    </script> 
                </div>
            </div>

        </div>
    </div>
</div>
<br clear="all"/>
