<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    ANC Visits
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Track antenatal care visits, monitor progress, and review visit history for each mother.
                </p>
            </div>

            <a href="{{ route('anc-visits.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                + Record ANC Visit
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-xl overflow-hidden border border-gray-100">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Visit Records</h3>
                        <p class="text-sm text-gray-500">All recorded antenatal visits.</p>
                    </div>
                </div>

                @if($visits->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-pink-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Mother
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Visit Date
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Gestation (Weeks)
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Weight (kg)
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Blood Pressure
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach($visits as $visit)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900">
                                                {{ $visit->mother->full_name ?? $visit->mother->name ?? 'N/A' }}
                                            </div>
                                            @if(!empty($visit->mother->hospital_number))
                                                <div class="text-xs text-gray-500 mt-1">
                                                    Hosp No: {{ $visit->mother->hospital_number }}
                                                </div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $visit->gestation_weeks ?? '—' }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $visit->weight ?? '—' }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-700">
                                            {{ $visit->blood_pressure ?? '—' }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('anc-visits.show', $visit) }}"
                                                   class="inline-flex items-center rounded-md bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 hover:bg-blue-100 transition">
                                                    View
                                                </a>

                                                <a href="{{ route('anc-visits.edit', $visit) }}"
                                                   class="inline-flex items-center rounded-md bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 hover:bg-amber-100 transition">
                                                    Edit
                                                </a>

                                                <form action="{{ route('anc-visits.destroy', $visit) }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this ANC visit record?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="inline-flex items-center rounded-md bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-100 transition">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $visits->links() }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-pink-100">
                            <span class="text-2xl">🩺</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">No ANC visits recorded yet</h3>
                        <p class="mt-2 text-sm text-gray-500">
                            Start by recording the first antenatal visit for a mother.
                        </p>

                        <a href="{{ route('anc-visits.create') }}"
                           class="mt-5 inline-flex items-center justify-center rounded-lg bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                            + Record First ANC Visit
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>