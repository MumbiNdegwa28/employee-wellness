<!-- resources/views/manager/feedback.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Employee
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Feedback
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $feedback->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $feedback->employee->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $feedback->message }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('manager.feedback.show', $feedback->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Chat Component -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">
                <div id="app">
                    <chat-component :user="{{ auth()->user() }}"></chat-component>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
