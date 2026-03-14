<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    Edit Postnatal Care Visit
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Update the postnatal follow-up details below.
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

                <form method="POST" action="{{ route('postnatal-care-visits.update', $postnatalCareVisit) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mother</label>
                            <select name="mother_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Select Mother</option>
                                @foreach($mothers as $mother)
                                    <option value="{{ $mother->id }}"
                                        {{ old('mother_id', $postnatalCareVisit->mother_id) == $mother->id ? 'selected' : '' }}>
                                        {{ $mother->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Linked Delivery</label>
                            <select name="delivery_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Optional</option>
                                @foreach($deliveries as $delivery)
                                    <option value="{{ $delivery->id }}"
                                        {{ old('delivery_id', $postnatalCareVisit->delivery_id) == $delivery->id ? 'selected' : '' }}>
                                        {{ $delivery->mother->full_name ?? 'Unknown Mother' }} - {{ $delivery->delivery_date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Visit Date</label>
                            <input type="date"
                                   name="visit_date"
                                   value="{{ old('visit_date', $postnatalCareVisit->visit_date) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Visit Time</label>
                            <input type="time"
                                   name="visit_time"
                                   value="{{ old('visit_time', $postnatalCareVisit->visit_time) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Days After Delivery</label>
                            <input type="number"
                                   min="0"
                                   name="days_after_delivery"
                                   value="{{ old('days_after_delivery', $postnatalCareVisit->days_after_delivery) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mother Condition</label>
                            <select name="mother_condition"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Select Condition</option>
                                <option value="Stable" {{ old('mother_condition', $postnatalCareVisit->mother_condition) == 'Stable' ? 'selected' : '' }}>Stable</option>
                                <option value="Needs Review" {{ old('mother_condition', $postnatalCareVisit->mother_condition) == 'Needs Review' ? 'selected' : '' }}>Needs Review</option>
                                <option value="Critical" {{ old('mother_condition', $postnatalCareVisit->mother_condition) == 'Critical' ? 'selected' : '' }}>Critical</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bleeding Status</label>
                            <select name="bleeding_status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Select Status</option>
                                <option value="Normal" {{ old('bleeding_status', $postnatalCareVisit->bleeding_status) == 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Heavy" {{ old('bleeding_status', $postnatalCareVisit->bleeding_status) == 'Heavy' ? 'selected' : '' }}>Heavy</option>
                                <option value="None" {{ old('bleeding_status', $postnatalCareVisit->bleeding_status) == 'None' ? 'selected' : '' }}>None</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Temperature</label>
                            <input type="text"
                                   name="temperature"
                                   value="{{ old('temperature', $postnatalCareVisit->temperature) }}"
                                   placeholder="e.g. 36.8°C"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Blood Pressure</label>
                            <input type="text"
                                   name="blood_pressure"
                                   value="{{ old('blood_pressure', $postnatalCareVisit->blood_pressure) }}"
                                   placeholder="e.g. 120/80"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Breastfeeding Status</label>
                            <select name="breastfeeding_status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Select Status</option>
                                <option value="Exclusive" {{ old('breastfeeding_status', $postnatalCareVisit->breastfeeding_status) == 'Exclusive' ? 'selected' : '' }}>Exclusive</option>
                                <option value="Mixed" {{ old('breastfeeding_status', $postnatalCareVisit->breastfeeding_status) == 'Mixed' ? 'selected' : '' }}>Mixed</option>
                                <option value="Not Breastfeeding" {{ old('breastfeeding_status', $postnatalCareVisit->breastfeeding_status) == 'Not Breastfeeding' ? 'selected' : '' }}>Not Breastfeeding</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Baby Condition</label>
                            <select name="baby_condition"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">
                                <option value="">Select Condition</option>
                                <option value="Stable" {{ old('baby_condition', $postnatalCareVisit->baby_condition) == 'Stable' ? 'selected' : '' }}>Stable</option>
                                <option value="Sick" {{ old('baby_condition', $postnatalCareVisit->baby_condition) == 'Sick' ? 'selected' : '' }}>Sick</option>
                                <option value="Referred" {{ old('baby_condition', $postnatalCareVisit->baby_condition) == 'Referred' ? 'selected' : '' }}>Referred</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes"
                                  rows="4"
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm">{{ old('notes', $postnatalCareVisit->notes) }}</textarea>
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-green-700 transition">
                            Update PNC Visit
                        </button>

                        <a href="{{ route('postnatal-care-visits.show', $postnatalCareVisit) }}"
                           class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-blue-700 transition">
                            View Record
                        </a>

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
