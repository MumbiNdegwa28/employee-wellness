@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ __('User Logins') }}</h1>
        <p>{{ __('Number of users who have logged in: ') }}{{ $loginCount }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Last Login At') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : 'Never' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
