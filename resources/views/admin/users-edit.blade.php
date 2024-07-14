<!-- Mumbi -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">Edit User</h3>
                    <form action="{{ route('admin.user.update',$user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="fname" :value="__('First Name')" />
                                <x-input id="fname" class="block mt-1 w-full" type="text" name="fname" required value="{{ old('fname',$user->fname) }}" required autofocus />
                                <x-input-error for="fname" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="lname" :value="__('Last Name')" />
                                <x-input id="lname" class="block mt-1 w-full" type="text" name="lname" required value="{{ old('lname',$user->lname) }}" required autofocus />
                                <x-input-error for="lname" class="mt-2" />
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="email" :value="__('Email')" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required autofocus />
                                <x-input-error for="email" class="mt-2" />
                            </div>

                            <div class="col-span-6 sm:col-span-4">
                                <x-label for="role_id" :value="__('Role')" />
                                <x-select name="role_id" id="role_id" class="mt-1 block w-full" :options="$roles" fieldName="role_name" idField="id" required></x-select>
                                <x-input-error for="role_id" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Update User') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>