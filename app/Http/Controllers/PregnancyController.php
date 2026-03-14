<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Edit Mother</h2>
            <p class="text-sm text-gray-500 mt-1">
                Update details for {{ $mother->full_name }}.
            </p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">

                <form method="POST" action="{{ route('mothers.update', $mother) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Hospital Number
                            </label>
                            <input type="text"
                                   name="hospital_number"
                                   value="{{ old('hospital_number', $mother->hospital_number) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('hospital_number')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Full Name
                            </label>
                            <input type="text"
                                   name="full_name"
                                   value="{{ old('full_name', $mother->full_name) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('full_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Phone
                            </label>
                            <input type="text"
                                   name="phone"
                                   value="{{ old('phone', $mother->phone) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                ID Number
                            </label>
                            <input type="text"
                                   name="id_number"
                                   value="{{ old('id_number', $mother->id_number) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('id_number')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Date of Birth
                            </label>
                            <input type="date"
                                   name="date_of_birth"
                                   value="{{ old('date_of_birth', optional($mother->date_of_birth)->format('Y-m-d')) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('date_of_birth')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Age
                            </label>
                            <input type="number"
                                   name="age"
                                   value="{{ old('age', $mother->age) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('age')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Marital Status
                            </label>

                            <select name="marital_status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                                <option value="">Select status</option>

                                <option value="Single"
                                    {{ old('marital_status', $mother->marital_status) == 'Single' ? 'selected' : '' }}>
                                    Single
                                </option>

                                <option value="Married"
                                    {{ old('marital_status', $mother->marital_status) == 'Married' ? 'selected' : '' }}>
                                    Married
                                </option>

                                <option value="Separated"
                                    {{ old('marital_status', $mother->marital_status) == 'Separated' ? 'selected' : '' }}>
                                    Separated
                                </option>

                                <option value="Widowed"
                                    {{ old('marital_status', $mother->marital_status) == 'Widowed' ? 'selected' : '' }}>
                                    Widowed
                                </option>

                            </select>

                            @error('marital_status')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Occupation
                            </label>
                            <input type="text"
                                   name="occupation"
                                   value="{{ old('occupation', $mother->occupation) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('occupation')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Residence
                            </label>
                            <input type="text"
                                   name="residence"
                                   value="{{ old('residence', $mother->residence) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('residence')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Next of Kin Name
                            </label>
                            <input type="text"
                                   name="next_of_kin_name"
                                   value="{{ old('next_of_kin_name', $mother->next_of_kin_name) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('next_of_kin_name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Next of Kin Phone
                            </label>
                            <input type="text"
                                   name="next_of_kin_phone"
                                   value="{{ old('next_of_kin_phone', $mother->next_of_kin_phone) }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">

                            @error('next_of_kin_phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Notes
                            </label>

                            <textarea name="notes"
                                      rows="4"
                                      class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('notes', $mother->notes) }}</textarea>

                            @error('notes')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="md:col-span-2 flex items-center gap-3">
                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $mother->is_active) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500">

                            <span class="text-sm text-gray-700">
                                Mother record is active
                            </span>
                        </div>

                    </div>


                    <div class="flex items-center gap-3 pt-4">

                        <button type="submit"
                            class="px-6 py-3 rounded-lg bg-pink-600 text-white font-semibold hover:bg-pink-700 transition shadow">
                            Update Mother
                        </button>

                        <a href="{{ route('mothers.show', $mother) }}"
                           class="px-6 py-3 rounded-lg bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>