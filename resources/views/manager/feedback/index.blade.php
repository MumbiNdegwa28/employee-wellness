<!-- resources/views/manager/feedback/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $feedback->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $feedback->employee->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $feedback->message }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('manager.feedback.show', $feedback->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Chat Area -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Messages
                    </div>
                    <div class="mt-6 text-gray-500">
                        <ul id="messages">
                            @foreach ($messages as $message)
                                <li class="mb-4">
                                    <div>
                                        <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                                    </div>
                                    <div class="ml-4">
                                        <ul>
                                            @foreach ($message->replies as $reply)
                                                <li>
                                                    <strong>{{ $reply->user->name }}:</strong> {{ $reply->message }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mt-4">
                        <textarea id="newMessage" rows="2" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Type your message here"></textarea>
                    </div>
                    <div class="mt-4">
                        <x-button id="sendMessageButton">
                            {{ __('Send Message') }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userId = {{ auth()->id() }};
            @if($feedbacks->isNotEmpty())
                const feedbackId = {{ $feedbacks->first()->id }};
            @else
                const feedbackId = null;
            @endif

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
                if (message === '') return;

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
    </script>
</x-app-layout>