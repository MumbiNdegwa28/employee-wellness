<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Journaling') }}
        </h2>
    </x-slot>
<div class="container">
   
    
        <!-- Button to toggle the form -->
        <x-button class="btn btn-primary m-4" id="toggleFormButton">Create New Entry</x-button>

        <!-- Journal Entry Form -->
        <div id="journalForm" style="display: none;">
            <form action="{{ route('journals.store') }}" method="POST">
                @csrf
                <div class="form-group mt-2">
                    <x-label class="p-6" for="content" value="{{__('Content')}}" />
                    <textarea id="journal-content" name="content"></textarea>
                </div>
                <x-button type="submit" class="btn btn-primary m-2 p-2">Save Entry</x-button>
            </form>
        </div>

        <!-- List of Journal Entries -->
        <div class="list-group mt-4 p-6">
            @foreach($journals as $journal)
                <div class="list-group-item">
                    {!! $journal->content !!}
                    <small class="d-block text-muted">Created at: {{ $journal->created_at }}</small>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
