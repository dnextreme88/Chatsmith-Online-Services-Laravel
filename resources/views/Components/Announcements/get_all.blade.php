@extends('layouts.app')

@section('title')
    Announcements
@endsection

@push('styles')
	<link href="{{ asset('css/Components/Announcements/index.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="w-9/12 mx-auto py-4 px-2">
        <x-custom.breadcrumbs :nav_links="[]">Announcements</x-custom.breadcrumbs>

        <div class="p-4">
            @if ($announcements->count() > 0)
                @include('Components.Announcements.includes.list', [
                    'announcements' => $announcements,
                    'user' => $user
                ])
            {{-- TODO: CAN BE RE-USED IF WE ARE GONNA IMPLEMENT A FEATURE TO DISPLAY THE ANNOUNCEMENTS AS A TABLE OR NOT
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
            --}}
                {{ $announcements->links() }}
            @else
                <p>No announcements found.
                    @if ($announcements->count() == 0 && $user->is_staff == 'True')
                        <a href="{{ \App\Filament\Resources\AnnouncementResource::getUrl('create') }}">Wanna create one now?</a></p>
                    @endif
                </p>
            @endif
        </div>
    </div>

    {{-- Don't wrap @push('scripts') to this as it won't work, for some reason --}}
    <script src="{{ asset('js/Announcements/index.js') }}"></script>
@endsection
