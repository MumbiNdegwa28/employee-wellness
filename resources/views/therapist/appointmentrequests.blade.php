<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appointment Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('Your Notifications') }}
                    </div>
                    <div class="mt-6 text-gray-500">
                        @if ($notifications->isEmpty())
                            <p>{{ __('You have no notifications.') }}</p>
                        @else
                            <ul>
                                @foreach ($notifications as $notification)
                                    <li class="mt-4">
                                        <div class="p-4 bg-gray-100 rounded-lg shadow">
                                            <p>{{ $notification->data['message'] }}</p>
                                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                            <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <x-button class="ml-4">
                                                    {{ __('Mark as read') }}
                                                </x-button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    
                    <div class="mt-8 text-2xl">
                        {{ __('Send a Reply') }}
                    </div>
                    <div class="mt-6 text-gray-500">
                        <form action="{{ route('send-reply') }}" method="POST" class="mt-6">
                            @csrf
                            <div>
                                <textarea id="reply" name="reply" rows="4" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            </div>
                            <div class="mt-6">
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
</x-app-layout>
