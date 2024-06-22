import Echo from 'laravel-echo';
 
import Pusher from 'pusher-js';
window.Pusher = Pusher;
 
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    encrypted: true,
});
const options = {
    broadcaster: 'pusher',
    key: 'your-pusher-channels-key'
}

var userId = "{{ auth()->user()->id }}";

window.Echo.private('messages.' + userId)
    .listen('MessageSent', (e) => {
        alert('New message: ' + e.message);
    });
 
window.Echo = new Echo({
    ...options,
    client: new Pusher(options.key, options)
});