@extends($layout)

@section('title')
    @guest
        Announcements
    @else
        @auth
            {{ $user->is_staff == 'True' ? 'Manage Announcements' : 'Announcements' }}
        @endauth
    @endguest
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        @guest
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
                    <li class="breadcrumb-item">Announcements</li>
                </ol>
            </div>
        @else
            @if ($user->is_staff == 'False')
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><i class="fa fa-home"></i> <a href="/">Home</a></li>
                    <li class="breadcrumb-item">Announcements</li>
                </ol>
            </div>
            @endif
        @endguest

        <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($announcements->count() > 0)
            <table class="table table-bordered table-responsive">
                <thead>
                    <th>ID</th>
                    <th>Username</th> <!-- Get Username from Foreign Key User -->
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    @auth
                        @if ($user->is_staff == 'True')
                            <th width="20%">Actions</th>
                        @endif
                    @endauth
                </thead>
                <tbody>
                @foreach ($announcements as $announcement)
                    <tr>
                        <td>{{ $announcement->id }}</td>
                        <td>{{ $announcement->user->username }}</td>
                        <td>{{ $announcement->title }}</td>
                        <td>{{ $announcement->description }}</td>
                        <td>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y') }}</td>
                        @auth
                            @if ($user->is_staff == 'True')
                                <td><ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa fa-eye"></i> <a href="/announcements/{{ $announcement->id }}/">View</a></li>
                                        <li class="list-inline-item"><i class="fa fa-magic"></i> <a href="/announcements/{{ $announcement->id }}/edit/">Edit</a></li>
                                        <li class="list-inline-item">
                                            <form action="/announcements/{{ $announcement->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <i class="fa fa-trash"></i> <input class="text-danger delete-announcement-button" type="submit" name="submit" value="Delete" />
                                            </form>
                                        </li>
                                </ul></td>
                            @endif
                        @endauth
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $announcements->links() }}
        @elseif ($announcements->count() == 0 && $user->is_staff == 'True')
            <p>No announcements found. <a href="{{ route('announcements.create') }}">Wanna create one now?</a></p>
        @elseif ($announcements->count() == 0 && $user->is_staff == 'False')
            <p>No announcements found.</p>
        @endif
        </div>
    </div>
</div>
@endsection
