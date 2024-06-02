@extends('layouts.app')

@section('title')
    My Settings
@endsection

@section('content')
    <div class="w-75 mx-auto py-4 px-2">
        <x-custom.breadcrumbs :nav_links="['Dashboard' => route('dashboard.index')]">Settings</x-custom.breadcrumbs>

        <livewire:profile.update-profile-information-form />

        <livewire:profile.update-password-form />

        <livewire:profile.delete-user-form />
    </div>
@endsection
