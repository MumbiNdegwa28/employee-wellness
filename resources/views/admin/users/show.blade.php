<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">ID: {{ $user->id }}</h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Name: {{ $user->name }}</h3>
                </div>
                <div class="mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Email: {{ $user->email }}</h3>
                </div>
                <!-- Add more user details as needed -->
            </div>
        </div>
    </div>
</x-app-layout>
