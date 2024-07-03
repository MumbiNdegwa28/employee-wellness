<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">User: {{ $user->fname }} {{ $user->lname }}</h3>

                <form action="{{ route('admin.manageUserPermissions.update', ['user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="fname" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" id="fname" name="fname" value="{{ old('fname', $user->fname) }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="lname" class="block text-sm font-medium text-gray-700">Last Name:</label>
                        <input type="text" id="lname" name="lname" value="{{ old('lname', $user->lname) }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" value="{{ old('dob') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>


                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                        <select id="gender" name="gender" class="form-input rounded-md shadow-sm mt-1 block w-full">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="rather not say" {{ old('gender', $user->gender) == 'rather not say' ? 'selected' : '' }}>Rather not say</option>
                        </select>
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

                <form action="{{ route('admin.users.edit', ['user' => $user->id]) }}" method="GET" class="mt-4">
                    <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Edit User
                    </button>
                </form>

                <form action="{{ route('admin.manageUserPermissions.create') }}" method="GET" class="mt-4">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Create User
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>