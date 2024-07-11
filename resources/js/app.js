import Echo from "laravel-echo";
import './bootstrap';
import 'flowbite';
require('./bootstrap');
window.Pusher = require('pusher-js');
//require('./bootstrap');

//Vue.component('chat-messages', require('./components/ChatMessages.vue'));
//Vue.component('chat-form', require('./ChatForm.vue'));


app.mount('#app');
const app = createApp({
    data() {
        return {
            messages: [],
            feedbackReplies: []
        };
    },

    created() {
        this.fetchMessages();
        this.listenForMessages();
        this.listenForFeedbackMessages();
        this.listenForFeedbackReplies();
        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });

    },

    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        },
        listenForMessages() {
            Echo.private('chat')
                .listen('MessageSent', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                });
        },
        listenForFeedbackMessages() {
            Echo.private('feedback')
                .listen('FeedbackMessageSent', (e) => {
                    this.messages.push({
                        message: e.message.message,
                        user: e.message.user
                    });
                });
        },
        listenForFeedbackReplies() {
            Echo.private('feedback')
                .listen('FeedbackReplySent', (e) => {
                    this.feedbackReplies.push({
                        reply: e.reply.message,
                        user: e.reply.user
                    });
                });
        } 

    }
});
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true
});
