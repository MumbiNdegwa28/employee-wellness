<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Create New User</h3>

                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="fname" class="block text-sm font-medium text-gray-700">First Name:</label>
                        <input type="text" id="fname" name="fname" value="{{ old('fname') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="lname" class="block text-sm font-medium text-gray-700">Last Name:</label>
                        <input type="text" id="lname" name="lname" value="{{ old('lname') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" value="{{ old('dob') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input rounded-md shadow-sm mt-1 block w-full">
                    </div>

                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender:</label>
                        <select id="gender" name="gender" class="form-input rounded-md shadow-sm mt-1 block w-full">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'rather not say' ? 'selected' : '' }}>Rather Not Say</option>
                        </select>
                    </div>


                    <div class="mb-4">
                        <h4 class="font-semibold mb-2">Select Permissions:</h4>
                        @foreach($permissions as $permission)
                        <div>
                            <input type="checkbox" id="permission{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}">
                            <label for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Create User
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>