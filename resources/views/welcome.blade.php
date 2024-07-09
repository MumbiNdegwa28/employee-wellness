<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/images/image.png'); /* Update this path to your image location */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-black bg-opacity-70 p-6 rounded-lg shadow-lg">
        <div class="text-center text-white mb-4">
            <h1 class="text-2xl font-bold">{{ config('app.name', '"Employee Wellness Platform"') }}</h1>
            <p class="mt-4">Sign up or log in to continue.</p>
        </div>
        @if (Route::has('login'))
            <div class="text-center">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-200 underline">Dashboard</a>
                @else
                    <form method="GET" action="{{ route('login') }}">
                        @csrf
                        <button type="submit" class="text-sm text-gray-200 underline">Log in</button>
                    </form>
                    @if (Route::has('register'))
                        <form method="GET" action="{{ route('register') }}">
                            @csrf
                            <button type="submit" class="ml-4 text-sm text-gray-200 underline">Register</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</body>
</html>
