<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Evaluation Form Report') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Evaluation Form Report
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- Add a button to view the evaluation form report -->
                        <a href="{{ route('evaluation.report') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            View Evaluation Form Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
