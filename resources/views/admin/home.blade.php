<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>

        <main>
            <div class="py-12 bg-cover bg-center bg-no-repeat bg-daily-quotes min-h-[500px]" style="background-image: url('/images/image.jpg');">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center items-center h-full">
                    <div class="text-center text-white bg-black bg-opacity-70 p-6 rounded-lg max-w-md w-full">
                        <p class="text-2xl font-bold mb-4">Some Daily Needed Motivation!</p>
                        <p class="text-lg font-semibold quote-fade" id="quote"></p>
                    </div>
                </div>
            </div>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <p class="text-xl font-semibold">Hello</p>
                        <div class="mt-4 text-gray-600">
                            <p class="text-lg quote-fade" id="quote"></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </x-app-layout>

    <script>
        const quotes = [
            "The only way to do great work is to love what you do. – Steve Jobs",
            "Success is not how high you have climbed, but how you make a positive difference to the world. – Roy T. Bennett",
            "Your time is limited, don’t waste it living someone else’s life. – Steve Jobs",
            "If you want to achieve greatness stop asking for permission. – Anonymous",
            "Things work out best for those who make the best of how things work out. – John Wooden",
            "Believe you can and you’re halfway there. – Theodore Roosevelt",
            "Strive not to be a success, but rather to be of value. – Albert Einstein",
            "The best way to predict the future is to create it. – Abraham Lincoln",
            "Life is what happens when you’re busy making other plans. – John Lennon",
            "The only limit to our realization of tomorrow will be our doubts of today. – Franklin D. Roosevelt"
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
