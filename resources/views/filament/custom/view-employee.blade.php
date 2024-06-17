@php
    $url_array = explode('/', url()->current());
    $employee_id = (int) $url_array[count($url_array) - 1];
    $record = \App\Models\Employee::findOrFail($employee_id);
    $user = \App\Models\User::findOrFail($record->user_id);
@endphp

@vite(['resources/css/app.css', 'resources/js/app.js'])

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/fontawesome.min.css" integrity="sha512-siarrzI1u3pCqFG2LEzi87McrBmq6Tp7juVsdmGY1Dr8Saw+ZBAzDzrGwX3vgxX1NkioYNCFOVC0GpDPss10zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.js" integrity="sha512-Ktf+fv0N8ON+ALPwyuXP9d8usxLqqPL5Ox9EHlqxehMM+h1wIU/AeVWFJwVGGFMddw/67P+KGFvFDhZofz2YEg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/fontawesome.min.js" integrity="sha512-64O4TSvYybbO2u06YzKDmZfLj/Tcr9+oorWhxzE3yDnmBRf7wvDgQweCzUf5pm2xYTgHMMyk5tW8kWU92JENng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endpush

<div class="flex flex-col gap-y-4 py-8">
    <nav class="fi-breadcrumbs mb-2 hidden sm:block">
        <ol class="fi-breadcrumbs-list flex flex-wrap items-center gap-x-2">
            <li class="fi-breadcrumbs-item flex gap-x-2">
                <a wire:navigate href="{{ \App\Filament\Resources\EmployeeResource::getUrl() }}" class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 transition duration-75 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    Employees
                </a>
            </li>

            <li class="fi-breadcrumbs-item flex gap-x-2">
                <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 rtl:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"></path>
                </svg>

                <svg class="fi-breadcrumbs-item-separator flex h-5 w-5 text-gray-400 dark:text-gray-500 ltr:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"></path>
                </svg>

                <span href="#" class="fi-breadcrumbs-item-label text-sm font-medium text-gray-500 transition duration-75 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    Detail
                </span>
            </li>
        </ol>
    </nav>

    <div class="card w-9/12 text-left mx-auto">
        <x-custom.card-header-title class="text-center text-black">Viewing Employee Number {{ $record->employee_number }}'s Profile</x-card-header-title>

        <!-- Profile Image (from User) -->
        <img src="/{{ $user->image }}" class="rounded-full mx-auto avatar-thumbnail-large" alt="Profile image of user" title="Profile image of user" />

        <div class="w-8/12 mx-auto border border-orange-500 dark:border-orange-300 mt-4 py-2 px-4 grid grid-rows-9 gap-3">
            <div class="grid grid-cols-3">
                <span>Employee ID</span>
                <span class="col-span-2">{{ $employee_id }}</span>
            </div>

            <div class="grid grid-cols-3">
                <span>Employee Number</span>
                <span class="col-span-2">{{ $record->employee_number }}</span>
            </div>

            <div class="grid grid-cols-3">
                <span>Username</span>
                <span class="col-span-2">{{ $user->username }}</span>
            </div>

            <div class="grid grid-cols-3">
                <span>Employee Name</span>
                <span class="col-span-2">{{ $user->first_name }} {{ $user->maiden_name }} {{ $user->last_name }}</span>
            </div>

            <div class="grid grid-cols-3">
                <span>Employee Type</span>
                <span class="col-span-2">{{ $record->employee_type }}</span>
            </div>

            <div class="grid grid-cols-3">
                <span>Office Designation</span>
                <span class="col-span-2">{{ $record->designation }}</span>
            </div>

            <div class="grid grid-cols-3">
                <span>Role</span>
                <span class="col-span-2">{{ $record->role }}</span>
            </div>

            <div class="grid grid-cols-3">
                <span>Date of Tenure</span>
                <span class="col-span-2">
                    {{ $record->date_tenure == '' ? '---' : \Carbon\Carbon::parse($record->date_tenure)->format('F j, Y') }}
                </span>
            </div>

            <div class="grid grid-cols-3">
                <span>Is Active Employee?</span>
                <span class="col-span-2">
                    @if ($record->is_active == 'True')
                        <i class="text-green-600 dark:text-green-400 fa fa-check-circle"></i>
                    @else
                        <i class="text-red-600 dark:text-red-400 fa fa-times-circle"></i>
                    @endif
                </span>
            </div>

            @if (\Auth::user()->is_staff == 'True')
                <div class="grid grid-cols-3">
                    <span>Actions</span>
                    <span class="col-span-2">
                        <button class="text-white bg-orange-400 hover:bg-orange-600 dark:bg-orange-700 dark:hover:bg-orange-500 py-2 px-2 rounded-lg">
                            <i class="fa fa-magic mr-1"></i>
                            <a href="{{ \App\Filament\Resources\EmployeeResource::getUrl('edit', ['record' => $employee_id]) }}">Edit Employee</a>
                        </button>
                    </span>
                </div>
            @endif
        </div>
    </div>
</div>
