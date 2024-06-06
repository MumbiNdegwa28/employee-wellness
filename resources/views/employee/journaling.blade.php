<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Journaling') }}
        </h2>
    </x-slot>
<div class="container">
    <!-- a serious change -->
    <!-- another serious change -->
    
        <!-- Button to toggle the form -->
        <button class="btn btn-primary mb-3" id="toggleFormButton">Create New Entry</button>

        <!-- Journal Entry Form -->
        <div id="journalForm" style="display: none;">
            <form action="{{ route('journals.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="journal-content" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Entry</button>
            </form>
        </div>

        <!-- List of Journal Entries -->
        <div class="list-group mt-4">
            @foreach($journals as $journal)
                <div class="list-group-item">
                    {!! $journal->content !!}
                    <small class="d-block text-muted">Created at: {{ $journal->created_at }}</small>
                </div>
            @endforeach
        </div>
    </div>

</x-app-layout>
