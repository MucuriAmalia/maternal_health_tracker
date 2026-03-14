<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Record Postnatal Care Visit
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Capture the mother's and baby's condition after delivery.
                </p>
            </div>

            <a href="{{ route('postnatal-care-visits.index') }}"
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

                <form method="POST" action="{{ route('postnatal-care-visits.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

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

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Linked Delivery
                            </label>
                            <select name="delivery_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Optional</option>
                                @foreach($deliveries as $delivery)
                                    <option value="{{ $delivery->id }}"
                                        {{ old('delivery_id') == $delivery->id ? 'selected' : '' }}>
                                        {{ $delivery->mother->full_name ?? 'Unknown Mother' }} - {{ $delivery->delivery_date }}
                                    </option>
                                @endforeach
                            </select>
                            @error('delivery_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Visit Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                   name="visit_date"
                                   value="{{ old('visit_date') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('visit_date')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Visit Time
                            </label>
                            <input type="time"
                                   name="visit_time"
                                   value="{{ old('visit_time') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('visit_time')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Days After Delivery
                            </label>
                            <input type="number"
                                   min="0"
                                   name="days_after_delivery"
                                   value="{{ old('days_after_delivery') }}"
                                   placeholder="e.g. 7"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('days_after_delivery')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Mother Condition
                            </label>
                            <select name="mother_condition"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Condition</option>
                                <option value="Stable" {{ old('mother_condition') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                <option value="Needs Review" {{ old('mother_condition') == 'Needs Review' ? 'selected' : '' }}>Needs Review</option>
                                <option value="Critical" {{ old('mother_condition') == 'Critical' ? 'selected' : '' }}>Critical</option>
                            </select>
                            @error('mother_condition')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Bleeding Status
                            </label>
                            <select name="bleeding_status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Status</option>
                                <option value="Normal" {{ old('bleeding_status') == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Heavy" {{ old('bleeding_status') == 'Heavy' ? 'selected' : '' }}>Heavy</option>
                                <option value="None" {{ old('bleeding_status') == 'None' ? 'selected' : '' }}>None</option>
                            </select>
                            @error('bleeding_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Temperature
                            </label>
                            <input type="text"
                                   name="temperature"
                                   value="{{ old('temperature') }}"
                                   placeholder="e.g. 36.8°C"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('temperature')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Blood Pressure
                            </label>
                            <input type="text"
                                   name="blood_pressure"
                                   value="{{ old('blood_pressure') }}"
                                   placeholder="e.g. 120/80"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('blood_pressure')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Breastfeeding Status
                            </label>
                            <select name="breastfeeding_status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Status</option>
                                <option value="Exclusive" {{ old('breastfeeding_status') == 'Exclusive' ? 'selected' : '' }}>Exclusive</option>
                                <option value="Mixed" {{ old('breastfeeding_status') == 'Mixed' ? 'selected' : '' }}>Mixed</option>
                                <option value="Not Breastfeeding" {{ old('breastfeeding_status') == 'Not Breastfeeding' ? 'selected' : '' }}>Not Breastfeeding</option>
                            </select>
                            @error('breastfeeding_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Baby Condition
                            </label>
                            <select name="baby_condition"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Condition</option>
                                <option value="Stable" {{ old('baby_condition') == 'Stable' ? 'selected' : '' }}>Stable</option>
                                <option value="Sick" {{ old('baby_condition') == 'Sick' ? 'selected' : '' }}>Sick</option>
                                <option value="Referred" {{ old('baby_condition') == 'Referred' ? 'selected' : '' }}>Referred</option>
                            </select>
                            @error('baby_condition')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Notes
                        </label>
                        <textarea name="notes"
                                  rows="4"
                                  placeholder="Add any observations, follow-up instructions, or clinical notes..."
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                            Save PNC Visit
                        </button>

                        <a href="{{ route('postnatal-care-visits.index') }}"
                           class="inline-flex items-center justify-center rounded-lg bg-gray-500 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-gray-600 transition">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
