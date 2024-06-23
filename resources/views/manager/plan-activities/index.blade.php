<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan Activities') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Plan Activities
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- Form for planning activities -->
                        <form method="POST" action="{{ route('activities.store') }}">
                            @csrf
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="event_name" class="block text-sm font-medium text-gray-700">Event Name</label>
                                    <input type="text" name="event_name" id="event_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                                
                                <div>
                                    <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
                                    <input type="text" name="venue" id="venue" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                                
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                                
                                <div>
                                    <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <input type="time" name="time" id="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-200 active:bg-indigo-600 disabled:opacity-25 transition">Plan Activity</button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-8 text-2xl">
                        Activities List
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- List of planned activities -->
                        <ul>
                            @foreach ($activities as $activity)
                                <li class="mt-4">
                                    <div class="text-lg font-semibold">{{ $activity->event_name }}</div>
                                    <div class="text-sm">Venue: {{ $activity->venue }}</div>
                                    <div class="text-sm">Date: {{ $activity->date }}</div>
                                    <div class="text-sm">Time: {{ $activity->time }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
