<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">{{ __('Assign Roles to Users') }}</h3>
                
                <!-- Form for Assigning Roles -->
                <form method="POST" action="{{ route('role-management.assign') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="user" class="block text-sm font-medium text-gray-700">Select User:</label>
                        <select name="user_id" id="user" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Select User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Select Role:</label>
                        <select name="role_id" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <x-button>
                            {{ __('Assign Role') }}
                        </x-button>
                    </div>
                </form>

                <!-- Session Messages -->
                @if (session('message'))
                    <div class="mt-4 text-green-600">
                        {{ session('message') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mt-4 text-red-600">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
