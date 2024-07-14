<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Send a New Message
                    </div>
                    <div class="mt-6 text-gray-500">
                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('feedback.sendMessage') }}" method="POST">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $employee->id }}">
                            <div>
                                <textarea id="message" name="message" rows="2" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Type your message here"></textarea>
                            </div>
                            <div class="mt-4">
                                <x-button>
                                    {{ __('Send Message') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Feedback Messages
                    </div>
                    <div class="mt-6 text-gray-500">
                        <ul id="messages">
                            @foreach ($feedbacks as $feedback)
                                <li class="mb-4">
                                    <div>
                                        <strong>{{ $feedback->sender->fname }}:</strong> {{ $feedback->message }}
                                    </div>
                                    <form action="{{ route('feedback.sendReply', ['feedback' => $feedback->id]) }}" method="POST" class="mt-4">
                                        @csrf
                                        <div>
                                            <textarea id="reply" name="reply" rows="2" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Type your reply here"></textarea>
                                        </div>
                                        <div class="mt-4">
                                            <x-button>
                                                {{ __('Send Reply') }}
                                            </x-button>
                                        </div>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Pusher.logToConsole = true;

            var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
                cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
                encrypted: true
            });

            var userId = "{{ auth()->user()->id }}";
            var channel = pusher.subscribe('feedback.' + userId);
            channel.bind('App\\Events\\FeedbackMessageSent', function(data) {
                let messages = document.getElementById('messages');
                let messageItem = document.createElement('li');
                messageItem.classList.add('mb-4');
                messageItem.innerHTML = `<div><strong>${data.user.name}:</strong> ${data.message}</div>`;
                messages.appendChild(messageItem);
            });
             // Handle FeedbackReplySent event
    channel.bind('App\\Events\\FeedbackReplySent', function(data) {
        let messages = document.getElementById('messages');
        let messageItem = document.createElement('li');
        messageItem.classList.add('mb-4');
        messageItem.innerHTML = `<div><strong>${data.user.name}:</strong> ${data.message}</div>`;
                messages.appendChild(messageItem);
            }); 
        });
    </script>
</x-app-layout>