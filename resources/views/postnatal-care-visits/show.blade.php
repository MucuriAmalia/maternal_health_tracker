<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Postnatal Care Visit Details
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Full information for this postnatal follow-up record.
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('postnatal-care-visits.edit', $postnatalCareVisit) }}"
                   class="inline-flex items-center justify-center rounded-lg bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-amber-600 transition">
                    Edit Record
                </a>

                <a href="{{ route('postnatal-care-visits.index') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-gray-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-gray-700 transition">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Visit Summary</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm font-medium text-gray-500">Mother</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">
                            {{ $postnatalCareVisit->mother->full_name ?? 'N/A' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Linked Delivery</p>
                        <p class="mt-1 text-base text-gray-900">
                            @if($postnatalCareVisit->delivery)
                                {{ $postnatalCareVisit->delivery->delivery_date }}
                            @else
                                Not linked
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Visit Date</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $postnatalCareVisit->visit_date }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Visit Time</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $postnatalCareVisit->visit_time ?: 'Not recorded' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Days After Delivery</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $postnatalCareVisit->days_after_delivery ?? 'Not recorded' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Mother Condition</p>
                        <p class="mt-1">
                            @php
                                $motherConditionClass = match($postnatalCareVisit->mother_condition) {
                                    'Stable' => 'bg-green-100 text-green-700',
                                    'Needs Review' => 'bg-amber-100 text-amber-700',
                                    'Critical' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $motherConditionClass }}">
                                {{ $postnatalCareVisit->mother_condition ?: 'Not recorded' }}
                            </span>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Bleeding Status</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $postnatalCareVisit->bleeding_status ?: 'Not recorded' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Temperature</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $postnatalCareVisit->temperature ?: 'Not recorded' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Blood Pressure</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $postnatalCareVisit->blood_pressure ?: 'Not recorded' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Breastfeeding Status</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $postnatalCareVisit->breastfeeding_status ?: 'Not recorded' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Baby Condition</p>
                        <p class="mt-1">
                            @php
                                $babyConditionClass = match($postnatalCareVisit->baby_condition) {
                                    'Stable' => 'bg-green-100 text-green-700',
                                    'Sick' => 'bg-amber-100 text-amber-700',
                                    'Referred' => 'bg-red-100 text-red-700',
                                    default => 'bg-gray-100 text-gray-700',
                                };
                            @endphp

                            <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $babyConditionClass }}">
                                {{ $postnatalCareVisit->baby_condition ?: 'Not recorded' }}
                            </span>
                        </p>
                    </div>

                </div>
            </div>

            <div class="bg-white shadow rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Clinical Notes</h3>
                </div>

                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $postnatalCareVisit->notes ?: 'No notes added for this postnatal care visit.' }}
                    </p>
                </div>
            </div>

            <div class="bg-white shadow rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Record Metadata</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Created At</p>
                        <p class="mt-1 text-base text-gray-900">{{ $postnatalCareVisit->created_at }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Last Updated</p>
                        <p class="mt-1 text-base text-gray-900">{{ $postnatalCareVisit->updated_at }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
