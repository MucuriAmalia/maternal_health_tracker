<?php

namespace App\Http\Controllers;

use App\Models\AncVisit;
use App\Models\Investigation;
use Illuminate\Http\Request;

class InvestigationController extends Controller
{
    public function index()
    {
        $investigations = Investigation::with(['ancVisit.mother'])
            ->latest()
            ->paginate(10);

        return view('investigations.index', compact('investigations'));
    }

 public function create(Request $request)
{
    $ancVisits = AncVisit::with('mother')->latest()->get();
    $selectedAncVisitId = $request->get('anc_visit_id');

    $types = [
        'Urinalysis',
        'Hemoglobin',
        'Blood Group',
        'VDRL',
        'HIV Test',
        'Blood Sugar',
        'Malaria Test',
        'Stool Analysis',
        'Ultrasound',
        'Other',
    ];

    return view('investigations.create', compact('ancVisits', 'types', 'selectedAncVisitId'));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'anc_visit_id' => ['required', 'exists:anc_visits,id'],
            'investigation_type' => ['required', 'string', 'max:255'],
            'result' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:pending,done,reviewed'],
            'investigation_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        Investigation::create($validated);

        return redirect()
            ->route('investigations.index')
            ->with('success', 'Investigation created successfully.');
    }

    public function show(Investigation $investigation)
    {
        $investigation->load(['ancVisit.mother']);

        return view('investigations.show', compact('investigation'));
    }

    public function edit(Investigation $investigation)
    {
        $ancVisits = AncVisit::with('mother')->latest()->get();

        $types = [
            'Urinalysis',
            'Hemoglobin',
            'Blood Group',
            'VDRL',
            'HIV Test',
            'Blood Sugar',
            'Malaria Test',
            'Stool Analysis',
            'Ultrasound',
            'Other',
        ];

        return view('investigations.edit', compact('investigation', 'ancVisits', 'types'));
    }

    public function update(Request $request, Investigation $investigation)
    {
        $validated = $request->validate([
            'anc_visit_id' => ['required', 'exists:anc_visits,id'],
            'investigation_type' => ['required', 'string', 'max:255'],
            'result' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:pending,done,reviewed'],
            'investigation_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $investigation->update($validated);

        return redirect()
            ->route('investigations.index')
            ->with('success', 'Investigation updated successfully.');
    }

    public function destroy(Investigation $investigation)
    {
        $investigation->delete();

        return redirect()
            ->route('investigations.index')
            ->with('success', 'Investigation deleted successfully.');
    }
}
