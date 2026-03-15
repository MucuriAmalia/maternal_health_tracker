<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Expected Deliveries Report</h2>
                <p class="text-sm text-gray-500 mt-1">
                    View mothers with recorded expected delivery dates.
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
                    <p class="text-sm font-medium text-gray-500">Total Expected Deliveries</p>
                    <h3 class="mt-2 text-3xl font-bold text-emerald-700">
                        {{ $deliveries->count() }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Nearest Expected Delivery</p>
                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        @php
                            $nearestDelivery = $deliveries
                                ->filter(fn($mother) => !empty($mother->expected_delivery_date))
                                ->sortBy('expected_delivery_date')
                                ->first();
                        @endphp

                        {{ $nearestDelivery && $nearestDelivery->expected_delivery_date
                            ? \Carbon\Carbon::parse($nearestDelivery->expected_delivery_date)->format('d M Y')
                            : 'N/A' }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Latest Expected Delivery</p>
                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        @php
                            $latestDelivery = $deliveries
                                ->filter(fn($mother) => !empty($mother->expected_delivery_date))
                                ->sortByDesc('expected_delivery_date')
                                ->first();
                        @endphp

                        {{ $latestDelivery && $latestDelivery->expected_delivery_date
                            ? \Carbon\Carbon::parse($latestDelivery->expected_delivery_date)->format('d M Y')
                            : 'N/A' }}
                    </h3>
                </div>
            </div>

            {{-- Report Table --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Expected Deliveries List</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Mothers with upcoming or recorded expected delivery dates.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    #
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Mother
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Hospital Number
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Phone
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Expected Delivery Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Days Remaining
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($deliveries as $index => $mother)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $mother->full_name ?? $mother->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $mother->hospital_number ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $mother->phone ?? $mother->phone_number ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $mother->expected_delivery_date
                                            ? \Carbon\Carbon::parse($mother->expected_delivery_date)->format('d M Y')
                                            : 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        @if($mother->expected_delivery_date)
                                            @php
                                                $edd = \Carbon\Carbon::parse($mother->expected_delivery_date)->startOfDay();
                                                $today = now()->startOfDay();
                                                $daysRemaining = $today->diffInDays($edd, false);
                                            @endphp

                                            @if($daysRemaining > 0)
                                                {{ $daysRemaining }} days
                                            @elseif($daysRemaining === 0)
                                                Today
                                            @else
                                                Overdue by {{ abs($daysRemaining) }} days
                                            @endif
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                        No expected deliveries found.
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