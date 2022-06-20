<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Demo Application</title>
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

	<script src="//js.pusher.com/3.1/pusher.min.js"></script>

	<script>
        const notificationsWrapper = document.querySelector('.notificao');
        const notificationsToggle = document.querySelector('a[data-toggle]');
        const notificationsCountElem = document.querySelector('i[data-count]');
        let notificationsCount = parseInt(notificationsCountElem.getAttribute('data-count'));
        const notifications = document.querySelector('ul.menu');

        const pusher = new Pusher("466f0b07696907f000b2", {
            encrypted: true,
            cluster: 'us2'
            });

        // Subscribe to the channel we specified in our Laravel Event
        const channel = pusher.subscribe('my-channel');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('my-event', function(data) {
        const existingNotifications = notifications.innerHTML;
        const avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        const newNotificationHtml = `
            <li class="notification active">
                <div class="media">
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
        notifications.innerHTML = (newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.setAttribute('data-count', notificationsCount);
        document.querySelector('.notif-count').innerHTML = (notificationsCount);
        });
	</script>
  </body>
</html>
