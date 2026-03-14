<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Edit Delivery Record
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Update the delivery details below.
                </p>
            </div>

            <a href="{{ route('deliveries.index') }}"
               class="inline-flex items-center justify-center rounded-lg bg-gray-600 px-5 py-2.5 text-sm font-semibold text-white shadow hover:bg-gray-700 transition">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-2xl p-6">

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4">
                        <div class="font-semibold text-red-800 mb-2">Please fix the following errors:</div>
                        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('deliveries.update', $delivery) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Mother --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mother</label>
                            <select name="mother_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Select Mother</option>
                                @foreach($mothers as $mother)
                                    <option value="{{ $mother->id }}"
                                        {{ old('mother_id', $delivery->mother_id) == $mother->id ? 'selected' : '' }}>
                                        {{ $mother->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ANC Visit --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ANC Visit</label>
                            <select name="anc_visit_id" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Optional</option>
                                @foreach($ancVisits as $visit)
                                    <option value="{{ $visit->id }}"
                                        {{ old('anc_visit_id', $delivery->anc_visit_id) == $visit->id ? 'selected' : '' }}>
                                        {{ $visit->mother->full_name ?? 'Unknown Mother' }} - {{ $visit->visit_date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Delivery Date --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Delivery Date</label>
                            <input type="date"
                                   name="delivery_date"
                                   value="{{ old('delivery_date', $delivery->delivery_date) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        {{-- Delivery Time --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Delivery Time</label>
                            <input type="time"
                                   name="delivery_time"
                                   value="{{ old('delivery_time', $delivery->delivery_time) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        {{-- Delivery Type --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Delivery Type</label>
                            <select name="delivery_type" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="Normal" {{ old('delivery_type', $delivery->delivery_type) == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Caesarean" {{ old('delivery_type', $delivery->delivery_type) == 'Caesarean' ? 'selected' : '' }}>Caesarean</option>
                                <option value="Assisted" {{ old('delivery_type', $delivery->delivery_type) == 'Assisted' ? 'selected' : '' }}>Assisted</option>
                            </select>
                        </div>

                        {{-- Baby Gender --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Baby Gender</label>
                            <select name="baby_gender" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="Male" {{ old('baby_gender', $delivery->baby_gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('baby_gender', $delivery->baby_gender) == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        {{-- Baby Weight --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Baby Weight (kg)</label>
                            <input type="number"
                                   step="0.01"
                                   name="baby_weight"
                                   value="{{ old('baby_weight', $delivery->baby_weight) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        {{-- Delivery Outcome --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Delivery Outcome</label>
                            <select name="delivery_outcome" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="Alive" {{ old('delivery_outcome', $delivery->delivery_outcome) == 'Alive' ? 'selected' : '' }}>Alive</option>
                                <option value="Stillbirth" {{ old('delivery_outcome', $delivery->delivery_outcome) == 'Stillbirth' ? 'selected' : '' }}>Stillbirth</option>
                            </select>
                        </div>

                    </div>

                    {{-- Notes --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes"
                                  rows="4"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">{{ old('notes', $delivery->notes) }}</textarea>
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                            Update Delivery
                        </button>

                        <a href="{{ route('deliveries.show', $delivery) }}"
                           class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                            View Record
                        </a>

                        <a href="{{ route('deliveries.index') }}"
                           class="inline-flex items-center justify-center rounded-lg bg-gray-500 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-gray-600 transition">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
