<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Appointments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="mt-8 text-2xl">
                        Send a New Message
                    </div>
                    <div class="mt-6 text-gray-500">
                        <form action="{{ route('send-message') }}" method="POST">
                            @csrf
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

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200 mt-6">
                    <div class="mt-8 text-2xl">
                        Messages
                    </div>
                    <div class="mt-6 text-gray-500">
                        <ul id="messages">
                            @foreach ($messages as $message)
                                <li class="mb-4">
                                    <div>
                                        <strong>{{ $message->sender->fname }}:</strong> {{ $message->content }}
                                    </div>
                                    <div class="ml-4">
                                        <ul>
                                            @foreach ($message->replies as $reply)
                                                <li>
                                                    <strong>{{ $reply->user->fname }}:</strong> {{ $reply->content }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <form action="{{ route('send-reply', $message->id) }}" method="POST" class="mt-4">
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
            var channel = pusher.subscribe('private-messages.' + userId);
            channel.bind('App\\Events\\MessageSent', function(data) {
                alert('New message: ' + data.message);
                let notifications = document.getElementById('notifications');
                let notificationItem = document.createElement('li');
                notificationItem.textContent = data.message;
                notifications.appendChild(notificationItem);
            });
        });
    </script>
</x-app-layout>
