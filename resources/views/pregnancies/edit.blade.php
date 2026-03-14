<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Edit Pregnancy Record</h2>
            <p class="text-sm text-gray-500 mt-1">Update pregnancy booking details.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form method="POST" action="{{ route('pregnancies.update', $pregnancy) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="mother_id" class="block text-sm font-medium text-gray-700">Mother</label>
                            <select name="mother_id" id="mother_id"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="">Select mother</option>
                                @foreach($mothers as $mother)
                                    <option value="{{ $mother->id }}"
                                        {{ old('mother_id', $pregnancy->mother_id) == $mother->id ? 'selected' : '' }}>
                                        {{ $mother->hospital_number }} - {{ $mother->full_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mother_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="booking_date" class="block text-sm font-medium text-gray-700">Booking Date</label>
                            <input type="date" name="booking_date" id="booking_date"
                                   value="{{ old('booking_date', optional($pregnancy->booking_date)->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('booking_date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="lmp" class="block text-sm font-medium text-gray-700">LMP</label>
                            <input type="date" name="lmp" id="lmp"
                                   value="{{ old('lmp', optional($pregnancy->lmp)->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('lmp') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="edd" class="block text-sm font-medium text-gray-700">EDD</label>
                            <input type="date" name="edd" id="edd"
                                   value="{{ old('edd', optional($pregnancy->edd)->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('edd') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="gestational_age_at_booking" class="block text-sm font-medium text-gray-700">Gestational Age at Booking (weeks)</label>
                            <input type="number" name="gestational_age_at_booking" id="gestational_age_at_booking"
                                   value="{{ old('gestational_age_at_booking', $pregnancy->gestational_age_at_booking) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('gestational_age_at_booking') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="gravida" class="block text-sm font-medium text-gray-700">Gravida</label>
                            <input type="number" name="gravida" id="gravida"
                                   value="{{ old('gravida', $pregnancy->gravida) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('gravida') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="para" class="block text-sm font-medium text-gray-700">Para</label>
                            <input type="number" name="para" id="para"
                                   value="{{ old('para', $pregnancy->para) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('para') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="risk_level" class="block text-sm font-medium text-gray-700">Risk Level</label>
                            <select name="risk_level" id="risk_level"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="low" {{ old('risk_level', $pregnancy->risk_level) === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="moderate" {{ old('risk_level', $pregnancy->risk_level) === 'moderate' ? 'selected' : '' }}>Moderate</option>
                                <option value="high" {{ old('risk_level', $pregnancy->risk_level) === 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            @error('risk_level') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="active" {{ old('status', $pregnancy->status) === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="delivered" {{ old('status', $pregnancy->status) === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="referred" {{ old('status', $pregnancy->status) === 'referred' ? 'selected' : '' }}>Referred</option>
                                <option value="lost_follow_up" {{ old('status', $pregnancy->status) === 'lost_follow_up' ? 'selected' : '' }}>Lost Follow Up</option>
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="referral_source" class="block text-sm font-medium text-gray-700">Referral Source</label>
                            <input type="text" name="referral_source" id="referral_source"
                                   value="{{ old('referral_source', $pregnancy->referral_source) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('referral_source') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2 flex items-center gap-3">
                            <input type="checkbox" name="anc_profile_completed" id="anc_profile_completed" value="1"
                                   {{ old('anc_profile_completed', $pregnancy->anc_profile_completed) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500">
                            <label for="anc_profile_completed" class="text-sm text-gray-700">ANC profile completed</label>
                        </div>

                        <div class="md:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="4"
                                      class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('notes', $pregnancy->notes) }}</textarea>
                            @error('notes') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                                class="inline-flex items-center rounded-lg bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                            Update Pregnancy
                        </button>

                        <a href="{{ route('pregnancies.show', $pregnancy) }}"
                           class="inline-flex items-center rounded-lg bg-gray-200 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>