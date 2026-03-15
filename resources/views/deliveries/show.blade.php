<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Delivery Details
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Full information for this delivery record.
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('deliveries.pdf', $delivery) }}"
   class="inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-red-700 transition">
    Download PDF
</a>
                <a href="{{ route('deliveries.edit', $delivery) }}"
                   class="inline-flex items-center justify-center rounded-lg bg-amber-500 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-amber-600 transition">
                    Edit Record
                </a>

                <a href="{{ route('deliveries.index') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-gray-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-gray-700 transition">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Delivery Summary</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm font-medium text-gray-500">Mother</p>
                        <p class="mt-1 text-base font-semibold text-gray-900">
                            {{ $delivery->mother->full_name ?? 'N/A' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Linked ANC Visit</p>
                        <p class="mt-1 text-base text-gray-900">
                            @if($delivery->ancVisit)
                                {{ $delivery->ancVisit->visit_date }}
                            @else
                                Not linked
                            @endif
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Delivery Date</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $delivery->delivery_date }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Delivery Time</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $delivery->delivery_time ?: 'Not recorded' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Delivery Type</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $delivery->delivery_type }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Delivery Outcome</p>
                        <p class="mt-1">
                            <span class="inline-flex rounded-full px-3 py-1 text-sm font-semibold
                                {{ $delivery->delivery_outcome === 'Alive'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ $delivery->delivery_outcome }}
                            </span>
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Baby Gender</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $delivery->baby_gender }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Baby Weight</p>
                        <p class="mt-1 text-base text-gray-900">
                            {{ $delivery->baby_weight ? $delivery->baby_weight . ' kg' : 'Not recorded' }}
                        </p>
                    </div>

                </div>
            </div>

            <div class="bg-white shadow rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Clinical Notes</h3>
                </div>

                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $delivery->notes ?: 'No notes added for this delivery record.' }}
                    </p>
                </div>
            </div>

            <div class="bg-white shadow rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-900">Record Metadata</h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Created At</p>
                        <p class="mt-1 text-base text-gray-900">{{ $delivery->created_at }}</p>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">Last Updated</p>
                        <p class="mt-1 text-base text-gray-900">{{ $delivery->updated_at }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
