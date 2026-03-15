<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Delivery Outcomes Report</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Review recorded deliveries and their outcomes.
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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total Deliveries</p>
                    <h3 class="mt-2 text-3xl font-bold text-purple-700">
                        {{ $deliveries->count() }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Live Births</p>
                    <h3 class="mt-2 text-3xl font-bold text-emerald-700">
                        {{ $deliveries->filter(fn($delivery) => strtolower($delivery->outcome ?? '') === 'live birth')->count() }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Still Births</p>
                    <h3 class="mt-2 text-3xl font-bold text-red-700">
                        {{ $deliveries->filter(fn($delivery) => strtolower($delivery->outcome ?? '') === 'still birth')->count() }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Multiple Births</p>
                    <h3 class="mt-2 text-3xl font-bold text-amber-700">
                        {{ $deliveries->filter(fn($delivery) => (int) ($delivery->number_of_babies ?? 1) > 1)->count() }}
                    </h3>
                </div>
            </div>

            {{-- Report Table --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Delivery Records</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Detailed delivery outcome records captured in the system.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-purple-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    #
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Mother
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Delivery Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Delivery Method
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Outcome
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Babies
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-700">
                                    Birth Weight
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($deliveries as $index => $delivery)
                                <tr class="hover:bg-purple-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $delivery->mother->full_name ?? $delivery->mother->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $delivery->delivery_date ? \Carbon\Carbon::parse($delivery->delivery_date)->format('d M Y') : 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $delivery->delivery_method ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm">
                                        @php
                                            $outcome = strtolower($delivery->outcome ?? '');
                                        @endphp

                                        @if($outcome === 'live birth')
                                            <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                                Live Birth
                                            </span>
                                        @elseif($outcome === 'still birth')
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Still Birth
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                                {{ $delivery->outcome ?? 'N/A' }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $delivery->number_of_babies ?? 1 }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $delivery->birth_weight ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-sm text-gray-500">
                                        No delivery records found.
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