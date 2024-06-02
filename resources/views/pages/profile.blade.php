@extends('layouts.app')

@section('title')
    My Settings
@endsection

@section('content')
    <div class="w-75 mx-auto py-4 px-2">
        <div class="w-full">
            <ol class="breadcrumb w-full ps-2 py-1 inline-flex items-start gap-2">
                <li class="breadcrumb-item"><i class="fa fa-home"></i> <a class="no-underline text-orange-100" href="{{ route('dashboard.index') }}" wire:navigate>Dashboard</a></li>
                <li class="ps-0 breadcrumb-item">Settings</li>
            </ol>
        </div>

        <livewire:profile.update-profile-information-form />

        <livewire:profile.update-password-form />

        <livewire:profile.delete-user-form />
    </div>
@endsection
