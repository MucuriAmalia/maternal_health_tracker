<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Investigations</h2>
                <p class="text-sm text-gray-500 mt-1">Manage ANC visit investigations and lab results.</p>
            </div>

            <a href="{{ route('investigations.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition">
                + New Investigation
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 border border-green-200 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Mother</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Visit Date</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Type</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Result</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-bold uppercase text-gray-500">Date</th>
                                <th class="px-4 py-3 text-right text-xs font-bold uppercase text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($investigations as $investigation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-800">
                                        {{ $investigation->ancVisit->mother->full_name ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $investigation->ancVisit->visit_date ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-800">
                                        {{ $investigation->investigation_type }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $investigation->result ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                            @if($investigation->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($investigation->status === 'done') bg-blue-100 text-blue-800
                                            @else bg-green-100 text-green-800
                                            @endif">
                                            {{ ucfirst($investigation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $investigation->investigation_date ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-right space-x-2">
                                        <a href="{{ route('investigations.show', $investigation) }}"
                                           class="inline-flex rounded-md bg-slate-100 px-3 py-2 text-slate-700 hover:bg-slate-200">
                                            View
                                        </a>

                                        <a href="{{ route('investigations.edit', $investigation) }}"
                                           class="inline-flex rounded-md bg-amber-100 px-3 py-2 text-amber-700 hover:bg-amber-200">
                                            Edit
                                        </a>

                                        <form action="{{ route('investigations.destroy', $investigation) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Delete this investigation?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex rounded-md bg-red-100 px-3 py-2 text-red-700 hover:bg-red-200">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                        No investigations found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    {{ $investigations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
