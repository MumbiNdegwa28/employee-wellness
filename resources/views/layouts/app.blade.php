<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <!--  Froala Editor initialization script here -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_style.min.css">

        <!-- Therapist planner calender scripts-->
        <!-- FullCalendar Scripts -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.css">
        <!-- <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.10.1/main.min.js"></script> -->
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @if (Auth::check())
                @php
                    $roleid = Auth::user()->role_id;
                @endphp

                @if ($roleid == 1)
                    <!-- Admin Navigation Bar -->
                    @include('adminnavigation-menu')
                @elseif ($roleid == 2)
                    <!-- Manager Navigation Bar -->
                    @include('managernavigation-menu')
                @elseif ($roleid == 3)
                    <!-- Therapist Navigation Bar -->
                    @include('therapistnavigation-menu')
                @else 
                    <!-- Employee Navigation Bar -->
                    @include('employeenavigation-menu')
                @endif
            @endif
        
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('scripts')
        <!-- FullCalendar Scripts -->
        
        <!-- Froala Script -->
        <script src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new FroalaEditor('#journal-content', {
                    toolbarButtons: ['bold', 'italic', 'underline', '|', 'emoticons', '|', 'insertImage', 'insertLink', '|', 'undo', 'redo'],
                    pluginsEnabled: ['emoticons'],
                });

                // Toggle form visibility
                document.getElementById('toggleFormButton').addEventListener('click', function () {
                    var form = document.getElementById('journalForm');
                    form.style.display = form.style.display === 'none' ? 'block' : 'none';
                });
            });
        </script>

        <!-- Pusher scripts-->
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        @if(auth()->check())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
                            cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
                            encrypted: true
                        });

                // Initialize Pusher with the appropriate credentials

                var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
                cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
                encrypted: true
                });


                var userId = "{{ auth()->user()->id }}";
                var channel = pusher.subscribe('private-messages.' + userId);
                channel.bind('App\\Events\\MessageSent', function(data) {
                        alert('New message: ' + data.message);
                        // Updating the notification center with the new message
                        let notifications = document.getElementById('notifications');
                        let notificationItem = document.createElement('li');
                        notificationItem.textContent = data.message;
                        notifications.appendChild(notificationItem);
                    });
                });
            </script>
        @endif
    </body>
</html>