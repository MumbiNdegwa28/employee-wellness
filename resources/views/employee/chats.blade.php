<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chat') }}
        </h2>
    </x-slot>
    @if (session('status'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        </div>
    @endif
    <div class="py-6"> <!-- Reduced padding from py-12 to py-6 -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Chat Messages
                    </div>
                    <div class="mt-6 text-gray-500">
                        <ul id="messages">
                                @foreach ($chats as $chat)
                                    <li class="mb-4">
                                        <div>
                                            <strong>{{ $chat->sender->fname }}:</strong> {{ $chat->message }}
                                        </div>
                                    </li>
                                @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Reply to Chat
                    </div>
                    <div class="mt-4 text-gray-500"> <!-- Reduced margin from mt-6 to mt-4 -->
                        <form id="replyForm" action="{{ route('chat.sendReply', ['chat' => 0]) }}" method="POST">
                            @csrf
                            <input type="hidden" id="replyChatId" name="chat_id" value="">
                            <div class="mt-4">
                                <textarea id="reply" name="reply" rows="2" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Type your reply here"></textarea>
                            </div>
                            <div class="mt-4">
                                <x-button>
                                    {{ __('Send Reply') }}
                                </x-button>
                            </div>
                        </form>
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
            var channel = pusher.subscribe('private-feedback.' + userId);
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
                messageItem.innerHTML = `<div><strong>${data.user.name}:</strong> ${data.reply.message}</div>`;
                messages.appendChild(messageItem);
            });
        });

        function setReplyChatId(chatId) {
            document.getElementById('replyChatId').value = chatId;
            document.getElementById('replyForm').action = "{{ url('chats') }}/" + chatId + "/reply";
        }
    </script>
</x-app-layout>