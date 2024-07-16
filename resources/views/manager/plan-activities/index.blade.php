<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-900 leading-tight">
            {{ __('Plan Activities') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl rounded-xl">
                <div class="p-6 sm:px-10 bg-white border-b border-blue-300">
                    <div class="mt-8 text-2xl font-bold text-center text-blue-900">
                        Activities List
                    </div>
                    <div class="mt-6 text-gray-700">
                        <!-- List of planned activities -->
                        <ul class="space-y-4">
                            @foreach ($activities as $activity)
                                <li class="p-4 bg-white rounded-md shadow-sm hover:bg-gray-100 transition">
                                    <div class="text-lg font-semibold text-blue-900">{{ $activity->event_name }}</div>
                                    <div class="text-sm">Venue: {{ $activity->venue }}</div>
                                    <div class="text-sm">Date: {{ $activity->date }}</div>
                                    <div class="text-sm">Time: {{ \Carbon\Carbon::parse($activity->time)->format('h:i A') }}</div>                         <!-- formats time in AM or PM -->
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-8 text-2xl font-bold text-center text-blue-900">
                        Plan Activities
                    </div>
                    <div class="mt-6 text-gray-700">
                        <!-- Form for planning activities -->
                        <form method="POST" action="{{ route('activities.store') }}" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="event_name" class="block text-sm font-medium text-gray-700">Event Name</label>
                                    <input type="text" name="event_name" id="event_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>

                                <div>
                                    <label for="venue" class="block text-sm font-medium text-gray-700">Venue</label>
                                    <input type="text" name="venue" id="venue" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>

                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>

                                <div>
                                    <label for="time" class="block text-sm font-medium text-gray-700">Time</label>
                                    <input type="time" name="time" id="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">Plan Activity</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>