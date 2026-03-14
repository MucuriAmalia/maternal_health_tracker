<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MotherController extends Controller
{
    public function index()
    {
        $mothers = Mother::latest()->paginate(10);

        return view('mothers.index', compact('mothers'));
    }

    public function create()
    {
        return view('mothers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'id_number' => ['nullable', 'string', 'max:50', 'unique:mothers,id_number'],
            'date_of_birth' => ['nullable', 'date'],
            'marital_status' => ['nullable', 'string', 'max:100'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'residence' => ['nullable', 'string', 'max:255'],
            'next_of_kin_name' => ['nullable', 'string', 'max:255'],
            'next_of_kin_phone' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string'],
        ]);

        if (!empty($validated['date_of_birth'])) {
            $validated['age'] = Carbon::parse($validated['date_of_birth'])->age;
        }

        $validated['is_active'] = true;

        // temporary placeholder so create() succeeds if hospital_number is required in DB
        $validated['hospital_number'] = 'TEMP-' . now()->timestamp;

        $mother = Mother::create($validated);

        $mother->update([
            'hospital_number' => 'MTH-' . str_pad($mother->id, 4, '0', STR_PAD_LEFT),
        ]);

        return redirect()
            ->route('mothers.show', $mother)
            ->with('success', 'Mother registered successfully.');
    }

    public function show(Mother $mother)
    {
        $mother->load(['pregnancies' => function ($query) {
            $query->latest();
        }]);

        return view('mothers.show', compact('mother'));
    }

    public function edit(Mother $mother)
    {
        return view('mothers.edit', compact('mother'));
    }

    public function update(Request $request, Mother $mother)
    {
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'id_number' => ['nullable', 'string', 'max:50', 'unique:mothers,id_number,' . $mother->id],
            'date_of_birth' => ['nullable', 'date'],
            'marital_status' => ['nullable', 'string', 'max:100'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'residence' => ['nullable', 'string', 'max:255'],
            'next_of_kin_name' => ['nullable', 'string', 'max:255'],
            'next_of_kin_phone' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['age'] = !empty($validated['date_of_birth'])
            ? Carbon::parse($validated['date_of_birth'])->age
            : null;

        $validated['is_active'] = $request->has('is_active');

        $mother->update($validated);

        return redirect()
            ->route('mothers.show', $mother)
            ->with('success', 'Mother details updated successfully.');
    }

    public function destroy(Mother $mother)
    {
        $mother->delete();

        return redirect()
            ->route('mothers.index')
            ->with('success', 'Mother record deleted successfully.');
    }
}