<!-- Mumbi -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Create User')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">Add User</h3>
                    <form action="{{ route('admin.user.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="fname" :value="__('First Name')" />
                                <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" required :value="old('fname')" required autofocus />
                                <x-input-error for="fname" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="lname" :value="__('Last Name')" />
                                <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" required :value="old('lname')" required autofocus />
                                <x-input-error for="lname" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="dob" :value="__('Date Of Birth')" />
                                <x-input id="dob" class="block mt-1 w-full" type="date" name="date" required :value="old('date')" required autofocus />
                                <x-input-error for="dob" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                <x-input-error for="email" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="gender" :value="__('Gender')" />
                                <x-radio-button-group name="gender" :options="['Male' => 'Male', 'Female' => 'Female', 'Rather Not Say' => 'Rather Not Say']" selected="{{ old('gender') ?? $user->gender ?? '' }}" />
                                <x-input-error for="gender" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="password" :value="__('Password')" />
                                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" autofocus />
                                <x-input-error for="password" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" autofocus />
                                <x-input-error for="password_confirmation" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="role_id" :value="__('Role')" />
                                <x-select class="block mt-1 w-full" id="role_id" name="role_id" :options="$roles" idField="id" fieldName="role_name" :value="old('role_id')" required autofocus></x-select>
                                <x-input-error for="role_id" class="mt-2" />
                            </div>

                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Add User') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>