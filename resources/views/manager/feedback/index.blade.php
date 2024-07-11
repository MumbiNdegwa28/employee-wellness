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
                                    {{ $feedback->sender->name }}
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
                        Feedback Messages
                    </div>
                    <div class="mt-6 text-gray-500">
                        <div id="chat-box" class="overflow-auto h-64">
                            @foreach ($feedback->replies as $message)
                                <div>
                                    <strong>{{ $message->sender_id == auth()->id() ? 'Me' : $message->sender->name }}:</strong>
                                    {{ $message->message }}
                                </div>
                            @endforeach
                        </div>
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

    <script>
        document.getElementById('sendMessageButton').addEventListener('click', function() {
            const message = document.getElementById('newMessage').value;
            if (message.trim() === '') {
                return;
            }

            fetch('{{ route("feedback.store-message", $feedback->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message: message,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    const chatBox = document.getElementById('chat-box');
                    const newMessage = document.createElement('div');
                    newMessage.innerHTML = `<strong>Me:</strong> ${message}`;
                    chatBox.appendChild(newMessage);
                    document.getElementById('newMessage').value = '';
                }
            });
        });
    </script>
</x-app-layout>
