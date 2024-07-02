<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-lilac">
            {{ __('Employee Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12 min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('employeedashboard.jpeg') }}')">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
            </div>
        </div>
    </div>
</x-app-layout>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
        }
        .content {
            display: none;
        }
        .content.active {
            display: block;
        }
        .container_1 {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #666;
        }
        .questionnaire {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .questionnaire th, .questionnaire td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .questionnaire th {
            background-color: #f9f9f9;
        }
        .questionnaire td input {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="buttons">
            <button onclick="showContent('evaluation')">Evaluation Form</button>
            <button onclick="showContent('resources')">Resources</button>
            <button onclick="showContent('journal')">Journal</button>
            <button onclick="showContent('appointment')">Appointment</button>
            <button onclick="showContent('chats')">Chats</button>
        </div>
        <div id="evaluation" class="content active">
            @yield('content')
        </div>
        <div id="resources" class="content">
            <h2>Resources</h2>
            <p>This is the Resources content.</p>
        </div>
        <div id="journal" class="content">
            <h2>Journal</h2>
            <p>This is the Journal content.</p>
        </div>
        <div id="appointment" class="content">
            <h2>Appointment</h2>
            <p>This is the Appointment content.</p>
        </div>
        <div id="chats" class="content">
            <h2>Chats</h2>
            <p>This is the Chats content.</p>
        </div>
    </div>
    <script>
        function showContent(id) {
            // Hide all content divs
            var contents = document.querySelectorAll('.content');
            contents.forEach(function(content) {
                content.classList.remove('active');
            });
            // Show the selected content
            document.getElementById(id).classList.add('active');
        }
    </script>
</body>
</html> -->
