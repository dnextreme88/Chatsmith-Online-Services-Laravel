@extends('layouts.app')

@section('title')
    Announcement # {{ $current_announcement->id }}
@endsection

@push('styles')
    <link href="{{ asset('css/Components/Announcements/index.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="w-9/12 mx-auto py-4 px-2">
        <x-custom.breadcrumbs :nav_links="['Announcements' => route('announcements.index')]">{{ $current_announcement->title }}</x-custom.breadcrumbs>

        <div class="p-4">
            <h1>{{ $current_announcement->title }}</h1>
            <p class="text-gray-400">Posted by <a wire:navigate href="{{ route('announcements.show_by_username', ['username' => $current_announcement->user->username]) }}" class="links">{{ $current_announcement->user->username }}</a> on <small>{{ \Carbon\Carbon::parse($current_announcement->created_at)->format('F j, Y g:i:s A') }}</small></p>
            <hr>

            <div class="text-justify announcement-description">{!! Markdown::parse($current_announcement->description) !!}</div>
        </div>

        <ul class="flex justify-center gap-2">
            @if ($previous_announcement)
                <li><a wire:navigate class="border border-gray-600 p-2 text-orange-600 hover:text-orange-400 no-underline" href="{{ route('announcements.detail', ['id' => $previous_announcement->id]) }}">&lt; &lt; Previous announcement</a></li>
            @endif

            @if ($next_announcement)
                <li><a wire:navigate class="border border-gray-600 p-2 text-orange-600 hover:text-orange-400 no-underline" href="{{ route('announcements.detail', ['id' => $next_announcement->id]) }}">Next announcement &gt; &gt;</a></li>
            @endif
        </ul>
    </div>
@endsection
