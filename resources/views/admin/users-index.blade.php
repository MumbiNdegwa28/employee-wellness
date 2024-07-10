<!-- Mumbi -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Users Dashboard')}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold mb-4">Users</h3>
                    @if(session('success'))
                    <div id="success-banner" class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    @endif

                    <form action="{{ route('admin.user.create') }}" method="GET" class="inline">
                        <x-button type="submit" class="btn btn-primary mb-4">{{__('Add User')}}</x-button>
                    </form>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left tracking-wider">{{ __('First Name') }}</th>
                                    <th class="px-4 py-3 text-left tracking-wider">{{ __('Last Name') }}</th>
                                    <th class="px-4 py-3 text-left tracking-wider">{{ __('Email') }}</th>
                                    <th class="px-4 py-3 text-left tracking-wider">{{ __('Role') }}</th< /th>
                                    <th class="px-4 py-3 text-left tracking-wider">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($users as $user)
                                <tr>
                                    <td class="border px-4 py-2">{{ $user->fname }}</td>
                                    <td class="border px-4 py-2">{{ $user->lname }}</td>
                                    <td class="border px-4 py-2">{{ $user->email }}</td>
                                    <td class="border px-4 py-2">{{ $user->role->role_name }}</td>
                                    <td class="border px-4 py-2">
                                        <form action="{{ route('admin.user.edit', $user) }}" method="GET" class="inline">
                                            <x-button type="submit" class="btn btn-sm btn-warning">{{__('Edit')}}</x-button>
                                        </form>
                                        <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">{{ __('Delete') }}</x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>