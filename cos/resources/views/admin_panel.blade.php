@extends('layouts.app')

@section('title')
Admin Panel - Home
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Left Side -->
        <div class="col-md-9">
            <h1>Welcome to the Admin Panel, {{ $user->username }}!</h1>
            <p>Use the navigational links on the right to browse through different administrator tasks such as viewing all employees, users, adding employees etc.</p>
            <h1>Admin Logs</h1>
            @if ($admin_logs->count() > 0)
                <table class="table table-bordered table-responsive">
                    <thead>
                        <th>Log ID</th>
                        <th>Username</th> <!-- Get Username from Foreign Key User -->
                        <th>Description</th>
                        <th>Timestamp</th>
                    </thead>
                    <tbody>
                        @foreach ($admin_logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->user->username }}</td>
                            <td>{{ $log->description }}</td>
                            <td>{{ $log->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            {{ $employees->links() }}
            @else
                <p>There are no logs at the moment.</p>
            @endif
        </div>
        <!-- Right Side / Navigation -->
        @if ($user->is_staff == 'True')
            <div class="col-md-3">
                @include('layouts.admin_panel_right_nav')
            </div>
        @endif
    </div>
</div>
@endsection
