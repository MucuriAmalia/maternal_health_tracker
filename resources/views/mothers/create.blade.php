<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Register Mother</h2>
            <p class="text-sm text-gray-500 mt-1">Capture mother biodata and contact information.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form method="POST" action="{{ route('mothers.store') }}" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="md:col-span-2">
                            <div class="rounded-lg border border-pink-200 bg-pink-50 px-4 py-3 text-sm text-pink-700">
                                Hospital number will be generated automatically after saving. Age will be calculated automatically from date of birth.
                            </div>
                        </div>

                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text"
                                   name="full_name"
                                   id="full_name"
                                   value="{{ old('full_name') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('full_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                            <input type="text"
                                   name="phone"
                                   id="phone"
                                   value="{{ old('phone') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="id_number" class="block text-sm font-medium text-gray-700">ID Number</label>
                            <input type="text"
                                   name="id_number"
                                   id="id_number"
                                   value="{{ old('id_number') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('id_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date"
                                   name="date_of_birth"
                                   id="date_of_birth"
                                   value="{{ old('date_of_birth') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('date_of_birth')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="marital_status" class="block text-sm font-medium text-gray-700">Marital Status</label>
                            <select name="marital_status"
                                    id="marital_status"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                <option value="">Select status</option>
                                <option value="Single" @selected(old('marital_status') === 'Single')>Single</option>
                                <option value="Married" @selected(old('marital_status') === 'Married')>Married</option>
                                <option value="Separated" @selected(old('marital_status') === 'Separated')>Separated</option>
                                <option value="Widowed" @selected(old('marital_status') === 'Widowed')>Widowed</option>
                            </select>
                            @error('marital_status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="occupation" class="block text-sm font-medium text-gray-700">Occupation</label>
                            <input type="text"
                                   name="occupation"
                                   id="occupation"
                                   value="{{ old('occupation') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('occupation')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="residence" class="block text-sm font-medium text-gray-700">Residence</label>
                            <input type="text"
                                   name="residence"
                                   id="residence"
                                   value="{{ old('residence') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('residence')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="next_of_kin_name" class="block text-sm font-medium text-gray-700">Next of Kin Name</label>
                            <input type="text"
                                   name="next_of_kin_name"
                                   id="next_of_kin_name"
                                   value="{{ old('next_of_kin_name') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('next_of_kin_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="next_of_kin_phone" class="block text-sm font-medium text-gray-700">Next of Kin Phone</label>
                            <input type="text"
                                   name="next_of_kin_phone"
                                   id="next_of_kin_phone"
                                   value="{{ old('next_of_kin_phone') }}"
                                   class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @error('next_of_kin_phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes"
                                      id="notes"
                                      rows="4"
                                      class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                                class="inline-flex items-center rounded-lg bg-pink-600 px-6 py-3 text-sm font-semibold text-white shadow hover:bg-pink-700 transition">
                            Save Mother
                        </button>

                        <a href="{{ route('mothers.index') }}"
                           class="inline-flex items-center rounded-lg bg-gray-200 px-6 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-300 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>