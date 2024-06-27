<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Messages</h3>
                    <ul id="notifications">
                        @foreach($notifications as $notification)
                            <li>
                                <p>{{ $notification->data['message'] }}</p>
                                <!-- Reply form -->
                                <form action="{{ route('send-reply', $notification->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <div>
                                        <textarea id="reply" name="reply" rows="2" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                                    </div>
                                    <div class="mt-2">
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
</x-app-layout>