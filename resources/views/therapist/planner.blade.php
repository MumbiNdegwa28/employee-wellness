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
                <div id="calendar" class="mt-6"></div>
            </div>
        </div>
    </div>

    @push('scripts')
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

