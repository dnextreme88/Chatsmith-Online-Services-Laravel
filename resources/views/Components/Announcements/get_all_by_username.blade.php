@extends('layouts.app')

@section('title')
    All Announcements of {{ $user_by_username->username }}
@endsection

@push('styles')
    <link href="{{ asset('css/Components/Announcements/index.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/Announcements/index.js') }}"></script>
@endpush

@section('content')
    <div class="w-9/12 mx-auto py-4 px-2">
        <x-custom.breadcrumbs :nav_links="['Announcements' => route('announcements.index')]">{{ $user_by_username->username }}</x-custom.breadcrumbs>

        <h1 class="text-center">Showing all announcements of {{ $user_by_username->username }}</h1>

        @foreach ($announcements as $announcement)
            <div class="p-4">
                <h1><a wire:navigate href="{{ route('announcements.detail', ['id' => $announcement->id]) }}" class="links">{{ $announcement->title }}</a></h1>
                <p class="text-gray-400">Posted on <small>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y g:i:s A') }}</small></p>
                <hr>

                <p class="announcement-pane-description">
                    @include('Components.Announcements.includes.description', ['announcement_description' => $announcement->description])
                </p>
            </div>
        @endforeach

        {{ $announcements->links() }}
    </div>
@endsection
