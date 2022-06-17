window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.Pusher = require('pusher-js');
import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '466f0b07696907f000b2',
    cluster: 'us2',
    forceTLS: true,
    encrypted: true,
    disableStats: true,
});

// console.log(Echo)
// console.log(window.Echo)


window.Echo.channel('orders')
    .listen('.ExemploUm', (e) => {
        console.log(e);
    });
