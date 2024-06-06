<div class="bg-gray-800 text-white w-64 space-y-6 py-7 px-2">
    <div class="text-white flex items-center space-x-2 px-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 1a1 1 0 01.894.553l3 6a1 1 0 01-.217 1.09l-4 4a1 1 0 01-.707.293H8a1 1 0 01-1-1v-2.586l-3-3A1 1 0 015 5.414V1a1 1 0 011-1h3zM8 15h2a1 1 0 010 2H8a1 1 0 010-2z" clip-rule="evenodd" />
        </svg>
        <span class="text-2xl font-extrabold">Admin Dashboard</span>
    </div>
    
    <nav class="space-y-1">
        <a href="{{ route('admin.home') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
           Admin Dashboard
        </a>
        <a href="{{ route('admin.viewUserRecords') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            View User Records
        </a>
        <a href="{{ route('admin.manageUserPermissions') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 hover:text-white">
            Manage User Permissions
        </a>
    </nav>
</div>
