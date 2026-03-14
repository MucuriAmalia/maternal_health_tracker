<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Record New Delivery
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Capture delivery details for the mother and newborn.
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

                <form method="POST" action="{{ route('deliveries.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Mother --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Mother <span class="text-red-500">*</span>
                            </label>
                            <select name="mother_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Mother</option>
                                @foreach($mothers as $mother)
                                    <option value="{{ $mother->id }}"
                                        {{ old('mother_id') == $mother->id ? 'selected' : '' }}>
                                        {{ $mother->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mother_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ANC Visit --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Linked ANC Visit
                            </label>
                            <select name="anc_visit_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Optional</option>
                                @foreach($ancVisits as $visit)
                                    <option value="{{ $visit->id }}"
                                        {{ old('anc_visit_id') == $visit->id ? 'selected' : '' }}>
                                        {{ $visit->mother->full_name ?? 'Unknown Mother' }} - {{ $visit->visit_date }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anc_visit_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Delivery Date --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Delivery Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                   name="delivery_date"
                                   value="{{ old('delivery_date') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('delivery_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Delivery Time --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Delivery Time
                            </label>
                            <input type="time"
                                   name="delivery_time"
                                   value="{{ old('delivery_time') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('delivery_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Delivery Type --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Delivery Type <span class="text-red-500">*</span>
                            </label>
                            <select name="delivery_type"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Delivery Type</option>
                                <option value="Normal" {{ old('delivery_type') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Caesarean" {{ old('delivery_type') == 'Caesarean' ? 'selected' : '' }}>Caesarean</option>
                                <option value="Assisted" {{ old('delivery_type') == 'Assisted' ? 'selected' : '' }}>Assisted</option>
                            </select>
                            @error('delivery_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Baby Gender --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Baby Gender <span class="text-red-500">*</span>
                            </label>
                            <select name="baby_gender"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('baby_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('baby_gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('baby_gender')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Baby Weight --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Baby Weight (kg)
                            </label>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="baby_weight"
                                   value="{{ old('baby_weight') }}"
                                   placeholder="e.g. 3.20"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('baby_weight')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Delivery Outcome --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Delivery Outcome <span class="text-red-500">*</span>
                            </label>
                            <select name="delivery_outcome"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Outcome</option>
                                <option value="Alive" {{ old('delivery_outcome') == 'Alive' ? 'selected' : '' }}>Alive</option>
                                <option value="Stillbirth" {{ old('delivery_outcome') == 'Stillbirth' ? 'selected' : '' }}>Stillbirth</option>
                            </select>
                            @error('delivery_outcome')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Notes --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Notes
                        </label>
                        <textarea name="notes"
                                  rows="4"
                                  placeholder="Add any relevant observations or clinical notes..."
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                            Save Delivery
                        </button>

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
