<!-- resources/views/therapist/chats.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        This is the Chats page.
                    </div>
                    <div class="mt-6 text-gray-500">
                        Communicate with your clients in real-time using this chat interface.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
