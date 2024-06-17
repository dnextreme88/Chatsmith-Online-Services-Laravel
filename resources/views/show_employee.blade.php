@extends('layouts.app')

@section('title')
    Employee # {{ $employee->employee_number }}
@endsection

@section('content')
    <div class="w-9/12 mx-auto py-4 px-2">
        <x-custom.card-header-title class="text-center">Viewing Employee Number {{ $employee->employee_number }}'s Profile</x-card-header-title>

        <!-- Profile Image (from User) -->
        <img src="/{{ $employee->user->image }}" class="rounded-full mx-auto avatar-thumbnail-large" alt="Profile image of user" title="Profile image of user" />

        <div class="w-8/12 mx-auto border border-orange-500 dark:border-orange-300 mt-4 py-2 px-4 grid grid-rows-9 gap-3">
            <div class="grid grid-cols-3">
                <span>Employee ID</span>
                <span class="col-span-2">{{ $employee->id }}</dd>
            </div>

            <div class="grid grid-cols-3">
                <span>User</span>
                <span class="col-span-2">{{ $employee->user->username }}</dd>
            </div>

            <div class="grid grid-cols-3">
                <span>Employee Number</span>
                <span class="col-span-2">{{ $employee->employee_number }}</dd>
            </div>

            <div class="grid grid-cols-3">
                <span>Employee Name</span>
                <span class="col-span-2">{{ $employee->user->first_name }} {{ $employee->user->maiden_name }} {{ $employee->user->last_name }}</dd>
            </div>

            <div class="grid grid-cols-3">
                <span>Employee Type</span>
                <span class="col-span-2">{{ $employee->employee_type }}</dd>
            </div>

            <div class="grid grid-cols-3">
                <span>Office Designation</span>
                <span class="col-span-2">{{ $employee->designation }}</dd>
            </div>

            <div class="grid grid-cols-3">
                <span>Role</span>
                <span class="col-span-2">{{ $employee->role }}</dd>
            </div>

            <div class="grid grid-cols-3">
                <span>Date of Tenure</span>
                <span class="col-span-2">
                    {{ $employee->date_tenure == '' ? '---' : \Carbon\Carbon::parse($employee->date_tenure)->format('F j, Y') }}
                </span>
            </div>

            <div class="grid grid-cols-3">
                <span>Is Active Employee?</span>
                <span class="col-span-2">
                    @if ($employee->is_active == 'True')
                        <i class="text-green-600 dark:text-green-400 fa fa-check-circle"></i>
                    @else
                        <i class="text-red-600 dark:text-red-400 fa fa-times-circle"></i>
                    @endif
                </span>
            </div>
        </div>
    </div>
@endsection
