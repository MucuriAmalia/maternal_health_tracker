<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">ANC Attendance Report</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Review antenatal clinic visits by date range.
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

            {{-- Filter Card --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                <form method="GET" action="{{ route('reports.anc') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">
                                Start Date
                            </label>
                            <input type="date"
                                   name="start_date"
                                   id="start_date"
                                   value="{{ request('start_date') }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">
                                End Date
                            </label>
                            <input type="date"
                                   name="end_date"
                                   id="end_date"
                                   value="{{ request('end_date') }}"
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                                Generate Report
                            </button>
                           <a href="{{ route('reports.anc.pdf', [
                                  'start_date' => request('start_date'),
                                  'end_date' => request('end_date')
                              ]) }}"
                            class="inline-flex items-center justify-center rounded-lg bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-red-700 transition">
                              @if(request('start_date') && request('end_date'))
                                  Download PDF
                              @endif
                          </a>

                            <a href="{{ route('reports.anc') }}"
                               class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition">
                                Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Total ANC Visits</p>
                    <h3 class="mt-2 text-3xl font-bold text-blue-700">{{ $visits->count() }}</h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Report Start Date</p>
                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        {{ $start ? \Carbon\Carbon::parse($start)->format('d M Y') : 'Not selected' }}
                    </h3>
                </div>

                <div class="bg-white shadow-sm rounded-xl border border-gray-200 p-6">
                    <p class="text-sm font-medium text-gray-500">Report End Date</p>
                    <h3 class="mt-2 text-lg font-bold text-gray-900">
                        {{ $end ? \Carbon\Carbon::parse($end)->format('d M Y') : 'Not selected' }}
                    </h3>
                </div>
            </div>

            {{-- Report Table --}}
            <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">ANC Visits</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Detailed antenatal attendance records.
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
                                    Visit Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Gestation Weeks
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Blood Pressure
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-gray-600">
                                    Weight
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($visits as $index => $visit)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $index + 1 }}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $visit->mother->full_name ?? $visit->mother->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->visit_date ? \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') : 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->gestation_weeks ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->blood_pressure ?? 'N/A' }}
                                    </td>

                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $visit->weight ?? 'N/A' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                        No ANC visits found for the selected date range.
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