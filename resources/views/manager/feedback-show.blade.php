<!-- resources/views/manager/feedback_show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">{{ $feedback->employee->name }}</h3>
                <p>{{ $feedback->message }}</p>
                <a href="{{ route('manager.feedback.index') }}" class="text-indigo-600 hover:text-indigo-900 mt-4 inline-block">Back to Feedback</a>
            </div>
        </div>
    </div>
</x-app-layout>
