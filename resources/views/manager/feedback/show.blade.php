<!-- resources/views/manager/feedback/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Feedback from {{ $feedback->employee->name }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ $feedback->message }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8 text-2xl">
                            Messages
                        </div>
                        <div class="mt-6 text-gray-500">
                            <ul id="messages">
                                <!-- Messages will be dynamically appended here -->
                            </ul>
                        </div>
                        <div class="mt-4">
                            <textarea id="newMessage" rows="2" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Type your message here"></textarea>
                        </div>
                        <div class="mt-4">
                            <x-button onclick="sendMessage()">
                                {{ __('Send Message') }}
                            </x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
         const userId = {{ auth()->id() }};
    const feedbackId = {{ $feedback->id }};
    console.log("User ID:", userId);
    console.log("Feedback ID:", feedbackId);

        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.private('feedback.' + feedbackId)
                .listen('FeedbackMessageSent', (e) => {
                    appendMessage(e.message);
                });

            fetchMessages();
        });

        function fetchMessages() {
            axios.get(`/feedback/${feedbackId}/messages`).then(response => {
                const messages = response.data;
                messages.forEach(message => {
                    appendMessage(message);
                });
            });
        }

        function appendMessage(message) {
            const messagesDiv = document.getElementById('messages');
            const messageDiv = document.createElement('div');
            messageDiv.classList.add(message.user.id === userId ? 'my-message' : 'other-message');
            messageDiv.innerText = message.message;
            messagesDiv.appendChild(messageDiv);
        }

        function sendMessage() {
            const message = document.getElementById('newMessage').value;
            axios.post(`/feedback/${feedbackId}/messages`, { message: message }).then(response => {
                document.getElementById('newMessage').value = '';
            });
        }
    </script>
</x-app-layout>
