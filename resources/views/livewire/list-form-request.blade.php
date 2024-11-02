<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Requests History</h2>
    </x-slot>

    {{-- TODO: TO ADD FILTERING BY request_type, request_status and viewing records with date_from / date_to fields --}}

    <div class="py-12">
        <table class="w-full border border-collapse border-gray-600 dark:border-gray-300">
            @if (count($form_requests) > 0)
                <thead class="text-gray-200 bg-gray-600 dark:bg-gray-300 dark:text-gray-800">
                    <th class="py-1">Date of Request</th>
                    <th class="py-1">Request Type</th>
                    <th class="py-1">Status</th>
                    <th class="py-1">Actions</th>
                </thead>
            @endif

            <tbody class="text-gray-600 dark:text-gray-300">
                @forelse ($form_requests as $key => $form_request)
                    @php
                        switch ($form_request->request_status) {
                            case \App\Enums\RequestStatuses::APPROVED:
                                $span_classes = 'bg-green-500';

                                break;
                            case \App\Enums\RequestStatuses::PENDING:
                                $span_classes = 'bg-orange-500';

                                break;
                            case \App\Enums\RequestStatuses::REJECTED:
                                $span_classes = 'bg-red-500';

                                break;
                        }
                    @endphp

                    <tr wire:key="{{ $key }}">
                        <td class="py-2 text-center">{{ \Carbon\Carbon::parse($form_request->created_at)->toFormattedDateString() }}</td>
                        <td class="py-2 text-center">{{ $form_request->request_type }}</td>
                        <td class="py-2 text-center">
                            <span class="text-white dark:text-gray-200 py-1 px-3 rounded-lg {{ $span_classes }}">{{ $form_request->request_status }}</span>
                        </td>
                        <td class="py-2 text-center">
                            <x-secondary-button wire:click="toggle_view_form_request_modal({{ $form_request->id }})" class="gap-2 hover:bg-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 fill-yellow-300 dark:fill-transparent dark:text-yellow-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                <span>View</span>
                            </x-secondary-button>
                        </td>
                    </tr>
                @empty
                    <p class="dark:text-white">You currently don't have a record of form requests.</p>
                @endforelse
            </tbody>
        </table>

        @if (count($form_requests) > 0)
            {{ $form_requests->links() }}
        @endif

        @if ($viewed_form_request)
            <x-modal :maxWidth="'2xl'" wire:model="view_form_request_modal">
                <div class="flex flex-col space-y-2">
                    <div class="p-4 flex justify-between border-b-2 border-gray-600 dark:border-gray-300">
                        <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-300">Request Details</h3>
                        <span wire:click="$toggle('view_form_request_modal')" class="text-3xl hover:cursor-pointer dark:text-white">&times;</span>
                    </div>

                    <div class="py-4 px-6 flex flex-col space-y-4">
                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center">
                            <span class="text-gray-800 dark:text-gray-200 md:px-2 md:py-3">Date of Request:</span>
                            <span class="text-white dark:text-gray-200 py-1 px-3 rounded-lg bg-blue-500">{{ \Carbon\Carbon::parse($viewed_form_request->created_at)->format('F j, Y h:i:s A') }}</span>
                        </div>

                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center">
                            <span class="text-gray-800 dark:text-gray-200 md:px-2 md:py-3">Request Type:</span>
                            <span class="text-white dark:text-gray-200 py-1 px-3 rounded-lg bg-blue-500">{{ $viewed_form_request->request_type }}</span>
                        </div>

                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center">
                            <span class="text-gray-800 dark:text-gray-200 md:px-2 md:py-3">Date Coverage:</span>
                            <span class="text-white dark:text-gray-200 py-1 px-3 rounded-lg bg-blue-500">
                                @if ($viewed_form_request->date_from == $viewed_form_request->date_to)
                                    {{ \Carbon\Carbon::parse($viewed_form_request->date_from)->toFormattedDateString() }}
                                @else
                                    {{ \Carbon\Carbon::parse($viewed_form_request->date_from)->toFormattedDateString(). ' ~ ' .\Carbon\Carbon::parse($viewed_form_request->date_to)->toFormattedDateString() }}
                                @endif
                            </span>
                        </div>

                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center">
                            <span class="text-gray-800 dark:text-gray-200 md:px-2 md:py-3">Status:</span>

                            @php
                                switch ($viewed_form_request->request_status) {
                                    case \App\Enums\RequestStatuses::APPROVED:
                                        $span_classes = 'bg-green-500';

                                        break;
                                    case \App\Enums\RequestStatuses::PENDING:
                                        $span_classes = 'bg-orange-500';

                                        break;
                                    case \App\Enums\RequestStatuses::REJECTED:
                                        $span_classes = 'bg-red-500';

                                        break;
                                }
                            @endphp

                            <span class="text-white dark:text-gray-200 py-1 px-3 rounded-lg {{ $span_classes }}">{{ $viewed_form_request->request_status }}</span>
                        </div>

                        @if ($viewed_form_request->checked_by_employee_id)
                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center">
                                <span class="text-gray-800 dark:text-gray-200 md:px-2 md:py-3">Updated on:</span>
                                <span class="text-white dark:text-gray-200 py-1 px-3 rounded-lg bg-blue-500">{{ \Carbon\Carbon::parse($viewed_form_request->updated_at)->format('F j, Y h:i:s A') }}</span>
                            </div>

                            <div class="flex items-center mt-2">
                                <div class="px-2 py-3 text-gray-800 dark:text-gray-200">Checked by:</div>

                                <x-custom.rounded-card>
                                    <x-slot name="card_title">
                                        <img src="{{ $viewed_form_request->checked_by_profile_photo_path }}" class="rounded-full size-12" alt="Employee avatar of the one who processed the status" title="Employee avatar of the one who processed the status" />
                                    </x-slot>

                                    <x-slot name="card_inline_title">
                                        <div>
                                            <div class="text-lg tracking-widest text-gray-900 dark:text-gray-100">{{ $viewed_form_request->checked_by_full_name }}</div>
                                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ $viewed_form_request->checked_by_role }}</div>
                                        </div>
                                    </x-slot>
                                </x-custom.rounded-card>
                            </div>
                        @endif

                        <div class="mt-2 border border-gray-600 dark:border-gray-300">
                            <div class="px-2 py-3 font-bold text-gray-200 bg-gray-600 dark:bg-gray-300 dark:text-gray-800">Reason:</div>
                            <div class="p-2 italic indent-2 dark:text-gray-300">{{ $viewed_form_request->reason }}</div>
                        </div>
                    </div>
                </div>
            </x-modal>
        @endif
    </div>
</div>
