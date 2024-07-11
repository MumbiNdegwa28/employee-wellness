<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manager Dashboard</title>
    @vite('resources/css/app.css')
    @vite('resources/css/slideshow.css')
    <style>
        body {
            background-image: url('/images/slide1.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manager Dashboard') }}
            </h2>
        </x-slot>

        <main>
            <div class="py-12 min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('/images/slide1.jpg');">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center items-center">
                    <div class="text-center text-white bg-black bg-opacity-70 p-6 rounded-lg max-w-md w-full">
                        <p class="text-2xl font-bold mb-4">Motivation on Repeat!</p>
                        <p class="text-lg font-semibold quote-fade" id="quote"></p>
                    </div>
                </div>
            </div>
        </main>
    </x-app-layout>

    <script>
        const quotes = [
        "Success is not final, failure is not fatal: It is the courage to continue that counts. – Winston Churchill",
            "It does not matter how slowly you go as long as you do not stop. – Confucius",
            "Your limitation—it's only your imagination. – Unknown",
            "Push yourself, because no one else is going to do it for you. – Unknown",
            "Sometimes later becomes never. Do it now. – Unknown",
            "Great things never come from comfort zones. – Unknown",
            "Dream it. Wish it. Do it. – Unknown",
            "Success doesn’t just find you. You have to go out and get it. – Unknown",
            "The harder you work for something, the greater you’ll feel when you achieve it. – Unknown",
            "Don’t stop when you’re tired. Stop when you’re done. – Unknown"
        ];

        let quoteIndex = 0;
        const quoteElement = document.getElementById('quote');

        function showNextQuote() {
            quoteElement.classList.add('opacity-0');
            setTimeout(() => {
                quoteElement.innerText = quotes[quoteIndex];
                quoteElement.classList.remove('opacity-0');
                quoteIndex = (quoteIndex + 1) % quotes.length;
            }, 500);
        }

        setInterval(showNextQuote, 8000);
        document.addEventListener('DOMContentLoaded', showNextQuote);
    </script>
</body>
</html>
