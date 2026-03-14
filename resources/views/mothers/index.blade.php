<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Mothers Registry</h2>
                <p class="text-sm text-gray-500 mt-1">Manage registered mothers in the maternal health tracker.</p>
            </div>

            <a href="{{ route('mothers.create') }}"
               class="inline-flex items-center rounded-lg bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                Register Mother
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
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">Registered Mothers</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Hospital No.</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Full Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Phone</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Age</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Residence</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($mothers as $mother)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $mother->hospital_number }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $mother->full_name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $mother->phone ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $mother->age ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $mother->residence ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        @if($mother->is_active)
                                            <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        <a href="{{ route('mothers.show', $mother) }}"
                                           class="text-pink-600 hover:text-pink-800 font-semibold">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">
                                        No mothers registered yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $mothers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>