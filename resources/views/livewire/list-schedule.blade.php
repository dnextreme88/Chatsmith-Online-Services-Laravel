@push('styles')
    @vite('resources/css/fullcalendar/fullcalendar.css')
@endpush

@push('scripts')
    @vite('resources/js/fullcalendar/fullcalendar.js')
@endpush

<div x-data="{ fullCalendar: window.FullCalendar() }" x-init="fullCalendar.initializeCalendar($wire.events_to_add)">
    <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-300">Schedule</h3>

    <div class="my-6" id="fullcalendar-employee-schedule"></div>
</div>
