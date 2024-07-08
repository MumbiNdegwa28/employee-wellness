<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        This is the Planner page.
                    </div>
                    <div class="mt-6 text-gray-500">
                        Use this section to manage your daily, weekly, and monthly schedules.
                    </div>
                </div>

                 <div id="calendar" class="mt-6">
                  <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                    Schedule a session
                    </div>
                    <form method="POST" action="{{ url('planner') }}">
                        @csrf
                         <div class="mb-4">
                         <label for="title" class="block text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="mb-4">
                         <label for="description" class="block text-gray-700">Description</label>
                        <textarea name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="mb-4">
                         <label for="start_date" class="block text-gray-700">Start Date</label>
                         <input type="datetime-local" name="start_date" id="start_date" class="w-full border-gray-300 rounded-md shadow-sm" required>
                         </div>
                         <div class="mb-4">
                       <label for="end_date" class="block text-gray-700">End Date</label>
                         <input type="datetime-local" name="end_date" id="end_date" class="w-full border-gray-300 rounded-md shadow-sm">
                        </div>
                         <x-button type="submit" class="btn btn-primary">Schedule Session</x-button>
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>
    

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.10.1/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@5.10.1/main.min.js"></script> 
           <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var events = <?php echo json_encode($events)?>;
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    plugins: ['dayGrid', 'interaction'],
                    initialView: 'dayGridMonth',
                    editable: true,
                    selectable: true,
                    events: events,
                    dateClick: function(info) {
                        alert('Date: ' + info.dateStr);
                    },
                    eventClick: function(info) {
                        alert('Event: ' + info.event.title);
                    }
                });
                calendar.render();
            });
        </script>
    @endpush
</x-app-layout>
