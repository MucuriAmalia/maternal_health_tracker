<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Mother Profile</h2>
                <p class="text-sm text-gray-500 mt-1">Detailed record for {{ $mother->full_name }}.</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('mothers.edit', $mother) }}"
                   class="inline-flex items-center rounded-lg bg-yellow-500 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-yellow-600 transition">
                    Edit
                </a>

                <a href="{{ route('pregnancies.create', ['mother_id' => $mother->id]) }}"
                   class="inline-flex items-center rounded-lg bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                    New Pregnancy
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="rounded-lg bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-1 bg-white shadow rounded-xl p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Personal Details</h3>

                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="font-semibold text-gray-600">Hospital Number</dt>
                            <dd class="text-gray-900">{{ $mother->hospital_number }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Full Name</dt>
                            <dd class="text-gray-900">{{ $mother->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Phone</dt>
                            <dd class="text-gray-900">{{ $mother->phone ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">ID Number</dt>
                            <dd class="text-gray-900">{{ $mother->id_number ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Age</dt>
                            <dd class="text-gray-900">{{ $mother->age ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Marital Status</dt>
                            <dd class="text-gray-900">{{ $mother->marital_status ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Occupation</dt>
                            <dd class="text-gray-900">{{ $mother->occupation ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Residence</dt>
                            <dd class="text-gray-900">{{ $mother->residence ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Next of Kin</dt>
                            <dd class="text-gray-900">{{ $mother->next_of_kin_name ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Next of Kin Phone</dt>
                            <dd class="text-gray-900">{{ $mother->next_of_kin_phone ?? '-' }}</dd>
                        </div>
                        <div>
                            <dt class="font-semibold text-gray-600">Notes</dt>
                            <dd class="text-gray-900">{{ $mother->notes ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="lg:col-span-2 bg-white shadow rounded-xl p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Pregnancy History</h3>
                        <span class="text-sm text-gray-500">{{ $mother->pregnancies->count() }} record(s)</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pregnancy No.</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Booking Date</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">EDD</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Risk Level</th>
                                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($mother->pregnancies as $pregnancy)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-900">{{ $pregnancy->pregnancy_number }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($pregnancy->booking_date)->format('d M Y') ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ optional($pregnancy->edd)->format('d M Y') ?? '-' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 capitalize">{{ $pregnancy->risk_level }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 capitalize">{{ str_replace('_', ' ', $pregnancy->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                                            No pregnancy records added yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>