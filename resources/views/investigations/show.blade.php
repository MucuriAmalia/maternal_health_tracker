<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">Investigation Details</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-500">Mother</p>
                        <p class="font-semibold text-gray-900">{{ $investigation->ancVisit->mother->full_name ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">ANC Visit Date</p>
                        <p class="font-semibold text-gray-900">{{ $investigation->ancVisit->visit_date ?? 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Investigation Type</p>
                        <p class="font-semibold text-gray-900">{{ $investigation->investigation_type }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Result</p>
                        <p class="font-semibold text-gray-900">{{ $investigation->result ?? '—' }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status</p>
                        <p class="font-semibold text-gray-900">{{ ucfirst($investigation->status) }}</p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Investigation Date</p>
                        <p class="font-semibold text-gray-900">{{ $investigation->investigation_date ?? '—' }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Notes</p>
                    <p class="text-gray-900">{{ $investigation->notes ?: 'No notes added.' }}</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('investigations.edit', $investigation) }}"
                       class="rounded-lg bg-amber-100 px-5 py-3 text-sm font-semibold text-amber-700 hover:bg-amber-200 transition">
                        Edit
                    </a>

                    <a href="{{ route('investigations.index') }}"
                       class="rounded-lg bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
