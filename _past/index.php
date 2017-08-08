<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="api.css" type="text/css" rel="stylesheet" >
	<link rel="stylesheet" type="text/css" href="theme.css"/>
	<title>1 to 1 video chat || CorePiler.Inc</title>
	<script src="http://static.opentok.com/v1.1/js/TB.min.js" type="text/javascript" charset="utf-8"></script>
	<script type="text/javascript">
		var apiKey = "29025882"; // OpenTok sample code key. Replace with your own API key. See https://dashboard.tokbox.com/projects
		var sessionId = "2_MX4yOTAyNTg4Mn4xMjcuMC4wLjF-U3VuIE1heSAxMiAyMzoyNzowMSBQRFQgMjAxM34wLjc0NzQzMTM0fg"; // Replace with your session ID. See https://dashboard.tokbox.com/projects 
		var token = "T1==cGFydG5lcl9pZD0yOTAyNTg4MiZzZGtfdmVyc2lvbj10YnJ1YnktdGJyYi12MC45MS4yMDExLTAyLTE3JnNpZz01YjA2ZWVhZjNiNjhlNDg4NjU2OWZlMTZmNzRjZmFkMWIwNzVlOTY5OnJvbGU9bW9kZXJhdG9yJnNlc3Npb25faWQ9Ml9NWDR5T1RBeU5UZzRNbjR4TWpjdU1DNHdMakYtVTNWdUlFMWhlU0F4TWlBeU16b3lOem93TVNCUVJGUWdNakF4TTM0d0xqYzBOelF6TVRNMGZnJmNyZWF0ZV90aW1lPTEzNjg0MjcyNjkmbm9uY2U9MC41NzQ4MzYwODIwMTQyNTYxJmV4cGlyZV90aW1lPTEzNzEwMTkyNjkmY29ubmVjdGlvbl9kYXRhPQ=="; // Replace with a generated token that has been assigned the moderator role.
						// See https://dashboard.tokbox.com/projects
		var session;
		var publisher;
		
		var subscribers = {};

		var PUBLISHER_WIDTH = 160;
		var PUBLISHER_HEIGHT = 150;
		
		var subscriber_width = [120, 160, 220];
		var subscriber_height = [90, 120, 165];

		// Un-comment either of the following to set automatic logging and exception handling.
		// See the exceptionHandler() method below.
		// TB.setLogLevel(TB.DEBUG);
		TB.addEventListener("exception", exceptionHandler);

		if (TB.checkSystemRequirements() != TB.HAS_REQUIREMENTS) {
			alert("You don't have the minimum requirements to run this application."
				  + "Please upgrade to the latest version of Flash.");
		} else {
			session = TB.initSession(sessionId);

			// Add event listeners to the session
			session.addEventListener("sessionConnected", sessionConnectedHandler);
			session.addEventListener("sessionDisconnected", sessionDisconnectedHandler);
			session.addEventListener("streamCreated", streamCreatedHandler);
			session.addEventListener("streamDestroyed", streamDestroyedHandler);
			session.addEventListener("signalReceived", signalReceivedHandler);
		}

		//--------------------------------------
		//  OPENTOK EVENT HANDLERS
		//--------------------------------------

		function sessionConnectedHandler(event) {
			for (var i = 0; i < event.streams.length; i++) {
				addStream(event.streams[i]);
			}

			hide("connectLink");
			show("disconnectLink");
			show("publishLink");
			show("signalLink");
			document.getElementById("myCamera").innerHTML = "";
		}

		function sessionDisconnectedHandler(event) {
			event.preventDefault();	// Prevent the default cleanup because we do it ourselves

			// Remove the publisher
			if (publisher) {
				stopPublishing();
			}

			// Remove all subscribers
			for (var streamId in subscribers) {
				removeStream(streamId);
			}

			if (event.reason == "forceDisconnected") {
				alert("A moderator has disconnected you from the session.");
			}

			show("connectLink");
			hide("disconnectLink");
			hide("publishLink");
			hide("unpublishLink");
			hide("signalLink");
		}

		function streamCreatedHandler(event) {
			for (var i = 0; i < event.streams.length; i++) {
				addStream(event.streams[i]);
			}
		}

		function streamDestroyedHandler(event) {

			for (var i = 0; i < event.streams.length; i++) {
				removeStream(event.streams[i].streamId);
				if (event.streams[i].connection.connectionId == session.connection.connectionId &&
								  event.reason == "forceUnpublished") {
					alert("A moderator has stopped publication of your stream.");
					hide("unpublishLink");
					show("publishLink");
					publisher = null;
				} else {
					removeStream(event.streams[i].streamId);
				}
			}
		}

		function signalReceivedHandler(event) {
			alert("Received a signal from connection " + event.fromConnection.connectionId);
		}

		/*
		If you un-comment the call to TB.addEventListener("exception", exceptionHandler) above, OpenTok calls the
		exceptionHandler() method when exception events occur. You can modify this method to further process exception events.
		If you un-comment the call to TB.setLogLevel(), above, OpenTok automatically displays exception event messages.
		*/
		function exceptionHandler(event) {
                    
			//alert("Exception: " + event.code + "::" + event.message);
		}

		//--------------------------------------
		//  LINK CLICK HANDLERS
		//--------------------------------------

		/*
		If testing the app from the desktop, be sure to check the Flash Player Global Security setting
		to allow the page from communicating with SWF content loaded from the web. For more information,
		see http://www.tokbox.com/opentok/docs/js/tutorials/helloworld.html#localTest
		*/
		function connect() {
			session.connect(apiKey, token);
		}

		function disconnect() {
			session.disconnect();
		}

		// Called when user wants to start publishing to the session
		function startPublishing() {
			if (!publisher) {
				var parentDiv = document.getElementById("myCamera");
				var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
				publisherDiv.setAttribute('id', 'opentok_publisher');
				parentDiv.appendChild(publisherDiv);
                publisher = TB.initPublisher(apiKey, 'opentok_publisher'); // Pass the replacement div id
				session.publish(publisher);
				hide('publishLink');
			}
		}

		function stopPublishing() {
			if (publisher) {
				session.unpublish(publisher);
				hide("unpublishLink");
				show("publishLink");
			}

			publisher = null;
		}

		function signal() {
			session.signal();
		}

		function forceDisconnectStream(streamId) {
			session.forceDisconnect(subscribers[streamId].stream.connection.connectionId);
		}

		function forceUnpublishStream(streamId) {
			session.forceUnpublish(subscribers[streamId].stream);
		}

		//--------------------------------------
		//  HELPER METHODS
		//--------------------------------------

		function addStream(stream) {
			if (stream.connection.connectionId == session.connection.connectionId) {
				show("unpublishLink");
				return;
			}
			// Create the container for the subscriber
			var container = document.createElement('div');
			container.className = "subscriberContainer";
			var containerId = "container_" + stream.streamId;
			container.setAttribute("id", containerId);
			document.getElementById("subscribers").appendChild(container);

			// Create the div that will be replaced by the subscriber
			var div = document.createElement('div');
			var divId = stream.streamId;
			div.setAttribute('id', divId);
			div.style.cssFloat = "top";
			container.appendChild(div);

			// Create a div for the force disconnect link
			var moderationControls = document.createElement('div');
			moderationControls.style.cssFloat = "bottom";
			moderationControls.innerHTML =
				  '<a href="#" onclick="javascript:forceDisconnectStream(\'' + stream.streamId + '\')">Force Disconnect<\/a><br>'
				+ '<a href="#" onclick="javascript:forceUnpublishStream(\'' + stream.streamId + '\')">Force Unpublish<\/a>';
			container.appendChild(moderationControls);

			subscribers[stream.streamId] = session.subscribe(stream, divId);
		}

		function removeStream(streamId) {
			var subscriber = subscribers[streamId];
			if (subscriber) {
				var container = document.getElementById(subscriber.id).parentNode;

				session.unsubscribe(subscriber);
				delete subscribers[streamId];

				// Clean up the subscriber container
				document.getElementById("subscribers").removeChild(container);
			}
		}

		function show(id) {
			document.getElementById(id).style.display = 'block';
		}

		function hide(id) {
			document.getElementById(id).style.display = 'none';
		}
	</script>
	</head>
	
	<body>
    <div id="main">
      <div id="wrapper">
        <div id="header">
          <div id="logo">
            <h1 align="center">Logo</h1>
          </div>
        </div>
        <div id="container">
          <div id="left">
            <div id="myCamera"> </div>
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
            <ul id="nav">
              <li><a href="#">Support</a></li>
              <li><a href="#">E-mail Professional</a></li>
              <li><a href="#">End Appoinment</a></li>
            </ul>
          </div>
          <div id="right">
            <div id="subscribers"></div>
            <script type="text/javascript" charset="utf-8">
				show('connectLink');
			</script> 
          </div>
        </div>
        <div id="footer">
          <p align="center"><a href="#">Terms of service</a> | <a href="#">Contact</a></p>
        </div>
      </div>
    </div>
</body>
</html>