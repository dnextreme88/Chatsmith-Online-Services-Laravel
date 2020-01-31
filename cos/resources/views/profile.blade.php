@extends('layouts.app')

@section('title')
{{ $user->name }}'s Profile
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Timestamps</div>

                <div class="card-body">
                    <!-- list of timestamps of user -->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Welcome, {{ $user->name }}!</div>

                <div class="card-body">
                    <ul>
                       <!-- Check if user is a staff, then show admin panel link -->
                        @if ($user->is_staff == 'True')
                            <li><a href="/admin/">Admin Panel</a></li>
                        @endif
                        <li><a href="/profile/{{ $user->id}}/edit">Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
