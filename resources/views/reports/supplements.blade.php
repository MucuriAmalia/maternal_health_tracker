<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Supplement Usage Report</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Review supplements issued during ANC visits.
                </p>
            </div>

            <a href="{{ route('reports.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition">
                Back to Reports
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Supplement Records</p>
                    <h3 class="mt-2 text-3xl font-bold text-amber-700">
                        {{ $supplements->count() }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Mothers Reached</p>
                    <h3 class="mt-2 text-3xl font-bold text-blue-700">
                        {{ $supplements->pluck('mother_id')->filter()->unique()->count() }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Latest Issuance Date</p>
                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        @php
                            $latestSupplement = $supplements
                                ->filter(fn($visit) => !empty($visit->visit_date))
                                ->sortByDesc('visit_date')
                                ->first();
                        @endphp

                        {{ $latestSupplement && $latestSupplement->visit_date
                            ? \Carbon\Carbon::parse($latestSupplement->visit_date)->format('d M Y')
                            : 'N/A' }}
                    </h3>
                </div>
            </div>

            {{-- Report Table --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Supplement Issuance Records</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        ANC visits where supplements were recorded as issued.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-amber-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    #
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Mother
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Visit Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Gestation Weeks
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Supplements Given
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Notes
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($supplements as $index => $visit)
                                <tr class="hover:bg-amber-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $visit->mother->full_name ?? $visit->mother->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->visit_date
                                            ? \Carbon\Carbon::parse($visit->visit_date)->format('d M Y')
                                            : 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->gestation_weeks ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->supplements_given ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->notes ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                        No supplement records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>