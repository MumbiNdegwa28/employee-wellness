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
// document.addEventListener('DOMContentLoaded', function() {
//     var userId = "{{ auth()->user()->id }}"; // Ensure this part is correctly passed to JavaScript

//     // Subscribe to the private channel for the user
//     window.Echo.private('messages.' + userId)
//         .listen('MessageSent', (e) => {
//             alert('New message: ' + e.message);
//             let notifications = document.getElementById('notifications');
//             let notificationItem = document.createElement('li');
//             notificationItem.textContent = e.message;
//             notifications.appendChild(notificationItem);
//         });
// });
const userId = "{{ auth()->user()->id }}";

window.Echo.private('messages.' + userId)
    .listen('MessageSent', (e) => {
        alert('New message: ' + e.message);
    })
    .listen('ReplySent', (e) => {
        alert('New reply: ' + e.reply);
    });