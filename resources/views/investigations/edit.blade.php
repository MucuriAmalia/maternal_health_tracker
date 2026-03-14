<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">Edit Investigation</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-xl p-6">
                <form action="{{ route('investigations.update', $investigation) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ANC Visit</label>
                            <select name="anc_visit_id" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm" required>
                                <option value="">Select ANC Visit</option>
                                @foreach($ancVisits as $visit)
                                    <option value="{{ $visit->id }}"
                                        {{ old('anc_visit_id', $investigation->anc_visit_id) == $visit->id ? 'selected' : '' }}>
                                        {{ $visit->mother->full_name ?? 'Unknown Mother' }} - {{ $visit->visit_date }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Investigation Type</label>
                            <select name="investigation_type" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm" required>
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}"
                                        {{ old('investigation_type', $investigation->investigation_type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Result</label>
                            <input type="text" name="result"
                                   value="{{ old('result', $investigation->result) }}"
                                   class="mt-1 w-full rounded-lg border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm" required>
                                <option value="pending" {{ old('status', $investigation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="done" {{ old('status', $investigation->status) == 'done' ? 'selected' : '' }}>Done</option>
                                <option value="reviewed" {{ old('status', $investigation->status) == 'reviewed' ? 'selected' : '' }}>Reviewed</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Investigation Date</label>
                            <input type="date" name="investigation_date"
                                   value="{{ old('investigation_date', $investigation->investigation_date) }}"
                                   class="mt-1 w-full rounded-lg border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes</label>
                        <textarea name="notes" rows="4"
                                  class="mt-1 w-full rounded-lg border-gray-300 shadow-sm">{{ old('notes', $investigation->notes) }}</textarea>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition">
                            Update Investigation
                        </button>

                        <a href="{{ route('investigations.index') }}"
                           class="inline-flex items-center justify-center rounded-lg bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
