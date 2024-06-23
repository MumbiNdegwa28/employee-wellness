<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Welcome to your Manager Dashboard!
                    </div>
                    <div class="mt-6 text-gray-500">
                        Use the buttons below to navigate through the available options.
                    </div>
                    <div class="mt-6 flex space-x-4">
                    <a href="{{ route('evaluation.form.report') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View Evaluation Form Report
                        </a>
                        <a href="{{ route('plan.activities') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Plan Activities
                        </a>
                        <a href="{{ route('feedback') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Feedback
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>