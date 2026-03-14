<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Pregnancy Records</h2>
                <p class="text-sm text-gray-500 mt-1">Manage all pregnancy bookings and follow-up records.</p>
            </div>

            <a href="{{ route('pregnancies.create') }}"
               class="inline-flex items-center rounded-lg bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                New Pregnancy
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Pregnancy No.</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Mother</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Booking Date</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">EDD</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Risk Level</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($pregnancies as $pregnancy)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $pregnancy->pregnancy_number }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $pregnancy->mother->full_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ optional($pregnancy->booking_date)->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ optional($pregnancy->edd)->format('d M Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                            {{ $pregnancy->risk_level === 'high' ? 'bg-red-100 text-red-700' : ($pregnancy->risk_level === 'moderate' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700') }}">
                                            {{ ucfirst($pregnancy->risk_level) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700 capitalize">
                                        {{ str_replace('_', ' ', $pregnancy->status) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        <a href="{{ route('pregnancies.show', $pregnancy) }}"
                                           class="text-pink-600 hover:text-pink-800 font-semibold">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                        No pregnancy records found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $pregnancies->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>