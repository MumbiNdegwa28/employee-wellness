// resources/assets/js/components/ChatForm.vue

<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
    </div>
</template>

<script>
import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        mounted() {
        this.fetchMessages();

        Echo.private('chat')
            .listen('MessageSent', (e) => {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            });
    },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage
                });

                this.newMessage = ''
            }
        }    
    }
</script>

<style>
.chat-container {
    max-width: 600px;
    margin: 0 auto;
    padding: 10px;
    background: #f4f4f4;
    border-radius: 10px;
}
</style>
