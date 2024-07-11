<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Journaling') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- List of Journal Entries -->
            <div class="md:col-span-1 list-group space-y-4">
                @foreach($journals as $journal)
                    <div class="list-group-item bg-gray-100 p-4 rounded-lg shadow-md">
                        <div class="prose">{!! $journal->content !!}</div>
                        <small class="block text-gray-500 mt-2">Created at: {{ $journal->created_at }}</small>
                    </div>
                @endforeach
            </div>

            <!-- Journal Entry Form -->
            <div class="md:col-span-2" >
                <h2 class="mb-2 text-l">{{__('Create New Entry')}}</h2>

                <div id="journalForm" class="bg-gray-100 p-4 rounded-lg shadow-md ">
                    <form action="{{ route('journals.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <x-label for="content" value="{{ __('Content') }}" class="block text-gray-700 text-sm font-bold mb-2" />
                            <textarea id="journal-content" name="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="5"></textarea>
                        </div>
                        <x-button type="submit" class="bg-peach-500 hover:bg-peach-700 text-white font-bold py-2 px-4 rounded">Save Entry</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleFormButton').addEventListener('click', function() {
            var form = document.getElementById('journalForm');
            form.classList.toggle('hidden');
        });
    </script>
</x-app-layout>
