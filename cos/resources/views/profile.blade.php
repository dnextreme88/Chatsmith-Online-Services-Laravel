@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Timestamps</div>

                <div class="card-body">
                    {{-- list of timestamps of user --}}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Welcome, {{ $user->name }}!</div>

                <div class="card-body">
                    <ul>
                        <li><a href="/profile/{{ $user->id}}/edit">Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
