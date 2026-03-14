<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Pregnancy Record</h2>
                <p class="text-sm text-gray-500 mt-1">Booking and monitoring details for this pregnancy.</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('pregnancies.edit', $pregnancy) }}"
                   class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-yellow-600 transition">
                    Edit
                </a>

                <a href="{{ route('mothers.show', $pregnancy->mother) }}"
                   class="inline-flex items-center rounded-lg bg-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition">
                    Back to Mother
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="rounded-lg bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1 bg-white shadow rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Mother Details</h3>

                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="font-semibold text-gray-600">Hospital Number</dt>
                            <dd class="text-gray-900">{{ $pregnancy->mother->hospital_number }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Mother Name</dt>
                            <dd class="text-gray-900">{{ $pregnancy->mother->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Phone</dt>
                            <dd class="text-gray-900">{{ $pregnancy->mother->phone ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Residence</dt>
                            <dd class="text-gray-900">{{ $pregnancy->mother->residence ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="lg:col-span-2 bg-white shadow rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Pregnancy Details</h3>

                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="font-semibold text-gray-600">Pregnancy Number</dt>
                            <dd class="text-gray-900">{{ $pregnancy->pregnancy_number }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Booking Date</dt>
                            <dd class="text-gray-900">{{ optional($pregnancy->booking_date)->format('d M Y') ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">LMP</dt>
                            <dd class="text-gray-900">{{ optional($pregnancy->lmp)->format('d M Y') ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">EDD</dt>
                            <dd class="text-gray-900">{{ optional($pregnancy->edd)->format('d M Y') ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Gravida</dt>
                            <dd class="text-gray-900">{{ $pregnancy->gravida ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Para</dt>
                            <dd class="text-gray-900">{{ $pregnancy->para ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Gestational Age at Booking</dt>
                            <dd class="text-gray-900">{{ $pregnancy->gestational_age_at_booking ? $pregnancy->gestational_age_at_booking . ' weeks' : '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Risk Level</dt>
                            <dd class="text-gray-900 capitalize">{{ $pregnancy->risk_level }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Status</dt>
                            <dd class="text-gray-900 capitalize">{{ str_replace('_', ' ', $pregnancy->status) }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">ANC Profile Completed</dt>
                            <dd class="text-gray-900">{{ $pregnancy->anc_profile_completed ? 'Yes' : 'No' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="font-semibold text-gray-600">Referral Source</dt>
                            <dd class="text-gray-900">{{ $pregnancy->referral_source ?? '-' }}</dd>
                        </div>
                        <div class="md:col-span-2">
                            <dt class="font-semibold text-gray-600">Notes</dt>
                            <dd class="text-gray-900">{{ $pregnancy->notes ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>