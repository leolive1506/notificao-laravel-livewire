<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Demo Application</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap-notifications.min.css">
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>
  <body>
	<nav>
	  <div>
		<div>
		  <button type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
			<span>Toggle navigation</span>
			<span></span>
			<span></span>
			<span></span>
		  </button>
		  <a href="#">Demo App</a>
		</div>

		<div>
		  <ul>
			<li class="notificao">
			  <a href="#notifications-panel" data-toggle="dropdown">
				<i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
			  </a>

			  <div>
				<div>
				  <div>
					<a href="#">Mark all as read</a>
				  </div>
				  <h3>Notifications (<span class="notif-count">0</span>)</h3>
				</div>
				<ul class="menu">
				</ul>
				<div>
				  <a href="#">View All</a>
				</div>
			  </div>
			</li>
			<li><a href="#">Timeline</a></li>
			<li><a href="#">Friends</a></li>
		  </ul>
		</div>
	  </div>
	</nav>

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="//js.pusher.com/3.1/pusher.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script type="text/javascript">
	  var notificationsWrapper   = $('.notificao');
	  var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
	  var notificationsCountElem = notificationsToggle.find('i[data-count]');
	  var notificationsCount     = parseInt(notificationsCountElem.data('count'));
	  var notifications          = notificationsWrapper.find('ul.menu');

	  if (notificationsCount <= 0) {
		notificationsWrapper.hide();
	  }

	  // Enable pusher logging - don't include this in production
	  Pusher.logToConsole = true;

	  var pusher = new Pusher("466f0b07696907f000b2", {
		encrypted: true,
        cluster: 'us2'
	  });

	  // Subscribe to the channel we specified in our Laravel Event
	  var channel = pusher.subscribe('my-channel');

	  // Bind a function to a Event (the full Laravel class)
	  channel.bind('my-event', function(data) {
		var existingNotifications = notifications.html();
		var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
		var newNotificationHtml = `
		  <li class="notification active">
			  <div class="media">
				<div class="media-left">
				  <div class="media-object">
					<img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
				  </div>
				</div>
				<div class="media-body">
				  <strong class="notification-title">`+data.message+`</strong>
				  <!--p class="notification-desc">Extra description can go here</p-->
				  <div class="notification-meta">
					<small class="timestamp">about a minute ago</small>
				  </div>
				</div>
			  </div>
		  </li>
		`;
		notifications.html(newNotificationHtml + existingNotifications);

		notificationsCount += 1;
		notificationsCountElem.attr('data-count', notificationsCount);
		notificationsWrapper.find('.notif-count').text(notificationsCount);
		notificationsWrapper.show();
	  });
	</script>
  </body>
</html>
