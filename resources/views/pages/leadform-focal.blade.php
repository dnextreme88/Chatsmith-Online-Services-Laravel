@extends('layouts.app')

@section('title')
    Focal Leadform
@endsection

@section('content')
    <div class="w-75 mx-auto py-4 px-2">
        <x-custom.breadcrumbs :nav_links="[]">@yield('title')</x-custom.breadcrumbs>

        <div class="border flex flex-col rounded-md">
            <x-custom.card-header-title>@yield('title')</x-card-header-title>

            <livewire:productions.focal />
        </div>
    </div>
@endsection
