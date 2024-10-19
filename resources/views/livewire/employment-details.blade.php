<x-form-section>
    <x-slot name="title">Employment Details</x-slot>

    <x-slot name="description">View information about your employment here.</x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-label :value="'Employee Number'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->employee_number }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Username'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->username }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Email'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->email }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Role'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->role }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Employee Type'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->employee_type }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Office Designation'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->designation }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Is a staff member?'" />
            <p class="w-full text-lg dark:text-gray-400">
                @if ($user->is_staff)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-green-600 dark:text-green-400 size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 dark:text-red-400 size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                @endif
            </p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Is an active employee?'" />
            <p class="w-full text-lg dark:text-gray-400">
                @if ($user->employee->is_active)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-green-600 dark:text-green-400 size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-600 dark:text-red-400 size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                @endif
            </p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'Date Hired'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->date_hired ? \Carbon\Carbon::parse($user->employee->date_hired)->format('F j, Y') : '-' }}</p>
        </div>

        @if ($user->employee->is_active == 0)
            <div class="col-span-6 mt-4">
                <x-label :value="'Date Resigned'" />
                <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->date_resigned ? \Carbon\Carbon::parse($user->employee->date_resigned)->format('F j, Y') : '-' }}</p>
            </div>
        @endif

        <div class="col-span-6 mt-4">
            <x-label :value="'Pag-IBIG Number'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->pag_ibig_number }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'PhilHealth Number'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->philhealth_number }}</p>
        </div>

        <div class="col-span-6 mt-4">
            <x-label :value="'SSS Number'" />
            <p class="w-full text-lg dark:text-gray-400">{{ $user->employee->sss_number }}</p>
        </div>
    </x-slot>
</x-form-section>
