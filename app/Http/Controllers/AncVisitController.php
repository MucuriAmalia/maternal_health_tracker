<?php

namespace App\Http\Controllers;

use App\Models\Mother;
use App\Models\AncVisit;
use Illuminate\Http\Request;

class AncVisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $visits = AncVisit::with('mother')->latest()->paginate(10);

    return view('anc_visits.index', compact('visits'));
}

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    $mothers = Mother::orderBy('full_name')->pluck('full_name', 'id');

    return view('anc_visits.create', compact('mothers'));
}

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $data = $request->validate([
        'mother_id' => 'required|exists:mothers,id',
        'visit_date' => 'required|date',
        'gestation_weeks' => 'nullable|integer',
        'weight' => 'nullable|numeric',
        'blood_pressure' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

    AncVisit::create($data);

    return redirect()->route('anc-visits.index')
        ->with('success','ANC Visit recorded successfully');
}

    /**
     * Display the specified resource.
     */
public function show(AncVisit $ancVisit)
{
    $ancVisit->load([
        'mother',
        'investigations' => function ($query) {
            $query->latest();
        }
    ]);

    return view('anc_visits.show', compact('ancVisit'));
}


    /**
     * Show the form for editing the specified resource.
     */
public function edit(AncVisit $ancVisit)
{
$mothers = Mother::orderBy('full_name')->pluck('full_name', 'id');
    return view('anc_visits.edit', compact('ancVisit', 'mothers'));
}

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, AncVisit $ancVisit)
{
    $data = $request->validate([
        'mother_id' => 'required|exists:mothers,id',
        'visit_date' => 'required|date',
        'gestation_weeks' => 'nullable|integer',
        'weight' => 'nullable|numeric',
        'blood_pressure' => 'nullable|string',
        'notes' => 'nullable|string',
    ]);

    $ancVisit->update($data);

    return redirect()->route('anc-visits.show', $ancVisit)
        ->with('success', 'ANC visit updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(AncVisit $ancVisit)
{
    $ancVisit->delete();

    return redirect()->route('anc-visits.index')
        ->with('success', 'ANC visit deleted successfully.');
}
}
