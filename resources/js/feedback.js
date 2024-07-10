document.addEventListener('DOMContentLoaded', function() {
    const userId = window.USER_ID;
    const feedbackId = window.FEEDBACK_ID;

    if (feedbackId) {
        Echo.private('feedback.' + feedbackId)
            .listen('FeedbackMessageSent', (e) => {
                appendMessage(e.message, e.user);
            })
            .listen('FeedbackReplySent', (e) => {
                appendReply(e.reply, e.user);
            });

        fetchMessages();
    }

    document.getElementById('sendMessageButton').addEventListener('click', sendMessage);

    function fetchMessages() {
        axios.get(`/feedback/${feedbackId}/messages`)
            .then(response => {
                const messages = response.data;
                messages.forEach(message => {
                    appendMessage(message, message.user);
                });
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
    }

    function appendMessage(message, user) {
        const messagesDiv = document.getElementById('messages');
        const messageDiv = document.createElement('div');
        messageDiv.classList.add(user.id === userId ? 'my-message' : 'other-message');
        messageDiv.innerText = `${user.name}: ${message.message}`;
        messagesDiv.appendChild(messageDiv);

        // Append replies if any
        if (message.replies) {
            message.replies.forEach(reply => {
                appendReply(reply, reply.user);
            });
        }

        // Scroll to bottom
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function appendReply(reply, user) {
        const messagesDiv = document.getElementById('messages');
        const replyDiv = document.createElement('div');
        replyDiv.classList.add(user.id === userId ? 'my-reply' : 'other-reply');
        replyDiv.innerText = `${user.name}: ${reply.message}`;
        messagesDiv.appendChild(replyDiv);

        // Scroll to bottom
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    function sendMessage() {
        const message = document.getElementById('newMessage').value.trim();
        if (message === '') {
            console.log('Message is empty');
            return;
        }
        axios.post(`/feedback/${feedbackId}/messages`, { message })
            .then(response => {
                document.getElementById('newMessage').value = '';
                appendMessage(response.data.message, response.data.user);
            })
            .catch(error => {
                console.error('Error sending message:', error);
            });
    }
});
