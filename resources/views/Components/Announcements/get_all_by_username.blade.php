@extends($layout)

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
<div class="container">
    <div class="row">
        <x-custom.breadcrumbs :nav_links="['Announcements' => route('announcements.index')]">{{ $user_by_username->username }}</x-custom.breadcrumbs>

        <div class="col-md-12 text-center">
            <h1 class="text-center">Showing all announcements of {{ $user_by_username->username }}</h1>
        </div>

        @foreach ($announcements as $announcement)
            <div class="col-md-12 alert alert-info alert-block">
                <h1><a wire:navigate class="links" href="/announcements/{{ $announcement->id }}/">{{ $announcement->title }}</a></h1>
                <p>Posted on <strong>{{ \Carbon\Carbon::parse($announcement->created_at)->format('F j, Y g:i:s A') }}</strong></p>

                <p class="announcement-pane-description">
                    @include('Components.Announcements.includes.description', ['announcement_description' => $announcement->description])
                </p>
            </div>
        @endforeach
        {{ $announcements->links() }}
    </div>
</div>
@endsection
