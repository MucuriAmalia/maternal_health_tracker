<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Record ANC Visit
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Capture antenatal care details for the selected mother.
                </p>
            </div>

            <a href="{{ route('anc-visits.index') }}"
               class="inline-flex items-center justify-center rounded-lg bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200 transition">
                ← Back to ANC Visits
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-pink-50">
                    <h3 class="text-lg font-semibold text-gray-900">ANC Visit Details</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Fill in the visit information carefully before saving.
                    </p>
                </div>

                <form action="{{ route('anc-visits.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <label for="mother_id" class="block text-sm font-medium text-gray-700">
                                Mother <span class="text-red-500">*</span>
                            </label>
                            <select name="mother_id" id="mother_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="">-- Select Mother --</option>
                                @foreach($mothers as $id => $name)
                                    <option value="{{ $id }}" {{ old('mother_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mother_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="visit_date" class="block text-sm font-medium text-gray-700">
                                Visit Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                   name="visit_date"
                                   id="visit_date"
                                   value="{{ old('visit_date', now()->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('visit_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="gestation_weeks" class="block text-sm font-medium text-gray-700">
                                Gestation Age (Weeks)
                            </label>
                            <input type="number"
                                   name="gestation_weeks"
                                   id="gestation_weeks"
                                   min="1"
                                   value="{{ old('gestation_weeks') }}"
                                   placeholder="e.g. 24"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('gestation_weeks')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="weight" class="block text-sm font-medium text-gray-700">
                                Weight (kg)
                            </label>
                            <input type="number"
                                   step="0.01"
                                   name="weight"
                                   id="weight"
                                   value="{{ old('weight') }}"
                                   placeholder="e.g. 65.50"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('weight')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="blood_pressure" class="block text-sm font-medium text-gray-700">
                                Blood Pressure
                            </label>
                            <input type="text"
                                   name="blood_pressure"
                                   id="blood_pressure"
                                   value="{{ old('blood_pressure') }}"
                                   placeholder="e.g. 120/80"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('blood_pressure')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">
                                Clinical Notes
                            </label>
                            <textarea name="notes"
                                      id="notes"
                                      rows="5"
                                      placeholder="Enter observations, complaints, diagnosis, treatment, supplements given, follow-up instructions, etc."
                                      class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-100">
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                            Save ANC Visit
                        </button>

                        <a href="{{ route('anc-visits.index') }}"
                           class="inline-flex items-center justify-center rounded-lg bg-gray-100 px-6 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-200 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>