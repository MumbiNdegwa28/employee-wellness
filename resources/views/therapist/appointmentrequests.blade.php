<!-- resources/views/therapist/chats.blade.php -->
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
                    Communicate with your clients in real-time using this chat interface.
                    </div>
                    <!-- <div class="mt-6 text-gray-500">
                        Communicate with your clients in real-time using this chat interface.
                    </div> -->
                </div>
                <form action="{{ route('send-message') }}" method="POST" class="mt-6">
                        @csrf
                        <div>
                            <textarea id="message" name="message" rows="4" class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <div class="mt-6">
                            <x-button>
                                {{ __('Send') }}
                            </x-button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</x-app-layout>
