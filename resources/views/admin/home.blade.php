<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .quote-fade {
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin Dashboard') }}
            </h2>
        </x-slot>

            
            <main>
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
        </div>
    </x-app-layout>

    <script>
        const quotes = [
            "The only way to do great work is to love what you do. – Steve Jobs",
            "Success is not how high you have climbed, but how you make a positive difference to the world. – Roy T. Bennett",
            "Your time is limited, don’t waste it living someone else’s life. – Steve Jobs",
            "If you want to achieve greatness stop asking for permission. – Anonymous",
            "Things work out best for those who make the best of how things work out. – John Wooden"
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

        setInterval(showNextQuote, 5000);
        document.addEventListener('DOMContentLoaded', showNextQuote);
    </script>
</body>
</html>
