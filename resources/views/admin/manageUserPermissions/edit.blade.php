<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">User: {{ $user->name }}</h3>
                
                <form action="{{ route('admin.manageUserPermissions.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Select Permissions:</h4>
                        @foreach($permissions as $permission)
                            <div>
                                <input type="checkbox" id="permission{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" {{ $user->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update User
                    </button>
                </form>

                <form action="{{ route('admin.users.destroy', ['user' => $user->id]) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Delete User
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

