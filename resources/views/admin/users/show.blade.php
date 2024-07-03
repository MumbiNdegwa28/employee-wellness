<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .container h3 {
            font-size: 1.25rem;
            margin-bottom: 10px;
            color: #333;
        }
        .container .detail-item {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #eaeaea;
        }
        .container .detail-item:last-child {
            border-bottom: none;
        }
    </style>

    <div class="py-12">
        <div class="container">
            <div class="detail-item">
                <h3>ID: {{ $user->id }}</h3>
            </div>
            <div class="detail-item">
                <h3>Name: {{ $user->fname }} {{ $user->lname }}</h3>
            </div>
            <div class="detail-item">
                <h3>Email: {{ $user->email }}</h3>
            </div>
            <!-- Add more user details as needed -->
        </div>
    </div>
</x-app-layout>
