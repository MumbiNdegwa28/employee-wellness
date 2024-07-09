@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Manage Roles</h2>
    <form method="POST" action="{{ route('admin.role-management.assign') }}">
        @csrf
        <div>
            <label for="user">Select User:</label>
            <select name="user_id" id="user">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label for="role">Select Role:</label>
            <select name="role_id" id="role">
                <option value="">-- Select Role --</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit">Assign Role</button>
    </form>

    @if (session('message'))
        <div>{{ session('message') }}</div>
    @endif

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif
</div>
@endsection
