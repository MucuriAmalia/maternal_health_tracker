<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    ANC Visit Details
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Review the full antenatal visit record and mother information.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('anc-visits.edit', $ancVisit) }}"
                   class="inline-flex items-center justify-center rounded-lg bg-amber-500 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-amber-600 transition">
                    Edit Visit
                </a>

                <a href="{{ route('anc-visits.index') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200 transition">
                    ← Back to ANC Visits
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-1">
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-pink-50">
                            <h3 class="text-lg font-semibold text-gray-900">Mother Summary</h3>
                            <p class="text-sm text-gray-600 mt-1">Basic mother information.</p>
                        </div>

                        <div class="p-6 space-y-4">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Name</p>
                                <p class="mt-1 text-sm font-semibold text-gray-900">
                                    {{ $ancVisit->mother->full_name ?? $ancVisit->mother->name ?? 'N/A' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Hospital Number</p>
                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $ancVisit->mother->hospital_number ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Phone Number</p>
                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $ancVisit->mother->phone ?? $ancVisit->mother->phone_number ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Age</p>
                                <p class="mt-1 text-sm text-gray-800">
                                    {{ $ancVisit->mother->age ?? '—' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-white">
                            <h3 class="text-lg font-semibold text-gray-900">Visit Record</h3>
                            <p class="text-sm text-gray-500">Clinical details captured during this ANC visit.</p>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div class="rounded-xl border border-pink-100 bg-pink-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-pink-700">Visit Date</p>
                                    <p class="mt-2 text-lg font-bold text-gray-900">
                                        {{ \Carbon\Carbon::parse($ancVisit->visit_date)->format('d M Y') }}
                                    </p>
                                </div>

                                <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">Gestation Age</p>
                                    <p class="mt-2 text-lg font-bold text-gray-900">
                                        {{ $ancVisit->gestation_weeks ? $ancVisit->gestation_weeks . ' weeks' : '—' }}
                                    </p>
                                </div>

                                <div class="rounded-xl border border-emerald-100 bg-emerald-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-emerald-700">Weight</p>
                                    <p class="mt-2 text-lg font-bold text-gray-900">
                                        {{ $ancVisit->weight ? $ancVisit->weight . ' kg' : '—' }}
                                    </p>
                                </div>

                                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-wide text-amber-700">Blood Pressure</p>
                                    <p class="mt-2 text-lg font-bold text-gray-900">
                                        {{ $ancVisit->blood_pressure ?? '—' }}
                                    </p>
                                </div>

                                <div class="md:col-span-2">
                                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-5">
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Clinical Notes</p>
                                        <div class="mt-3 text-sm leading-7 text-gray-800 whitespace-pre-line">
                                            {{ $ancVisit->notes ?: 'No clinical notes recorded for this visit.' }}
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-6 border-t border-gray-100 pt-5 text-xs text-gray-500 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <span>Recorded: {{ $ancVisit->created_at?->format('d M Y, h:i A') ?? 'N/A' }}</span>
                                <span>Last Updated: {{ $ancVisit->updated_at?->format('d M Y, h:i A') ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900">Actions</h3>
                    <p class="text-sm text-gray-500">Manage this ANC visit record.</p>
                </div>

                <div class="p-6 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('anc-visits.edit', $ancVisit) }}"
                       class="inline-flex items-center justify-center rounded-lg bg-amber-500 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-amber-600 transition">
                        Edit This Visit
                    </a>

                    <a href="{{ route('anc-visits.index') }}"
                       class="inline-flex items-center justify-center rounded-lg bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200 transition">
                        Back to List
                    </a>

                    <form action="{{ route('anc-visits.destroy', $ancVisit) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this ANC visit record?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-red-700 transition">
                            Delete Visit
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>