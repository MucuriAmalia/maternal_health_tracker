<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Delivery Records
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    View and manage all recorded delivery cases.
                </p>
            </div>

            <a href="{{ route('deliveries.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                + New Delivery
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="rounded-2xl bg-white p-5 shadow border border-gray-100">
                    <p class="text-sm font-medium text-gray-500">Total Records</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalDeliveries }}</p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow border border-green-100">
                    <p class="text-sm font-medium text-green-600">Alive Outcomes</p>
                    <p class="mt-2 text-3xl font-bold text-green-700">
                        {{ $aliveCount }}
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow border border-red-100">
                    <p class="text-sm font-medium text-red-600">Stillbirth Outcomes</p>
                    <p class="mt-2 text-3xl font-bold text-red-700">
                        {{ $stillbirthCount }}
                    </p>
                </div>

                <div class="rounded-2xl bg-white p-5 shadow border border-blue-100">
                    <p class="text-sm font-medium text-blue-600">This Page</p>
                    <p class="mt-2 text-3xl font-bold text-blue-700">{{ $deliveries->count() }}</p>
                </div>
            </div>

            <div class="bg-white shadow rounded-2xl overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">All Deliveries</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Mother
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Delivery Date
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Type
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Baby Gender
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Weight
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Outcome
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($deliveries as $delivery)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900">
                                            {{ $delivery->mother->full_name ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            ID: {{ $delivery->id }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        <div>{{ $delivery->delivery_date }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ $delivery->delivery_time ?: 'Time not recorded' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $delivery->delivery_type }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $delivery->baby_gender }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $delivery->baby_weight ? $delivery->baby_weight . ' kg' : 'Not recorded' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                            {{ $delivery->delivery_outcome === 'Alive'
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700' }}">
                                            {{ $delivery->delivery_outcome }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            <a href="{{ route('deliveries.show', $delivery) }}"
                                               class="inline-flex items-center justify-center rounded-lg bg-slate-600 px-3 py-2 text-xs font-semibold text-white shadow hover:bg-slate-700 transition">
                                                View
                                            </a>

                                            <a href="{{ route('deliveries.edit', $delivery) }}"
                                               class="inline-flex items-center justify-center rounded-lg bg-amber-500 px-3 py-2 text-xs font-semibold text-white shadow hover:bg-amber-600 transition">
                                                Edit
                                            </a>

                                            <form action="{{ route('deliveries.destroy', $delivery) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this delivery record?')"
                                                  class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="inline-flex items-center justify-center rounded-lg bg-red-600 px-3 py-2 text-xs font-semibold text-white shadow hover:bg-red-700 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center">
                                        <div class="text-lg font-semibold text-gray-700">No delivery records found</div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Start by creating the first delivery record.
                                        </p>

                                        <a href="{{ route('deliveries.create') }}"
                                           class="mt-4 inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                                            + Add Delivery
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                {{ $deliveries->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
