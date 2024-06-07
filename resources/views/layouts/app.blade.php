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

        <!--therapist planner calender scripts-->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'dayGrid', 'interaction' ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay'
                },
                dateClick: function(info) {
                    var title = prompt('Enter Event Title:');
                    var description = prompt('Enter Event Description:');
                    if (title) {
                        fetch('/events', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                title: title,
                                description: description,
                                start: info.dateStr
                            })
                        })
                        .then(response => response.json())
                        .then(event => {
                            calendar.addEvent({
                                title: event.title,
                                start: event.start,
                                allDay: true,
                                description: event.description
                            });
                        });
                    }
                },
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                    alert('Description: ' + info.event.extendedProps.description);
                },
                editable: true,
                selectable: true,
                events: '/events'
            });

            calendar.render();
        });
    </script>
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
    </body>
</html>
