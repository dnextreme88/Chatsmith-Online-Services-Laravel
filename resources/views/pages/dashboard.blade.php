@extends('layouts.app')

@section('title')
    My Dashboard
@endsection

@push('styles')
    <link href="{{ asset('css/Components/Dashboard/index.css') }}" rel="stylesheet">
@endpush

@section('content')
    <livewire:Dashboard />
@endsection
