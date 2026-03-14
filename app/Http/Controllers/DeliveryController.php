<?php

namespace App\Http\Controllers;

use App\Models\AncVisit;
use App\Models\Delivery;
use App\Models\Mother;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::with(['mother', 'ancVisit'])
            ->latest('delivery_date')
            ->latest()
            ->paginate(10);

        $totalDeliveries = Delivery::count();
        $aliveCount = Delivery::where('delivery_outcome', 'Alive')->count();
        $stillbirthCount = Delivery::where('delivery_outcome', 'Stillbirth')->count();

        return view('deliveries.index', compact(
            'deliveries',
            'totalDeliveries',
            'aliveCount',
            'stillbirthCount'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mothers = Mother::orderBy('full_name')->get();
        $ancVisits = AncVisit::with('mother')
            ->latest('visit_date')
            ->get();

        return view('deliveries.create', compact('mothers', 'ancVisits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mother_id' => ['required', 'exists:mothers,id'],
            'anc_visit_id' => ['nullable', 'exists:anc_visits,id'],
            'delivery_date' => ['required', 'date'],
            'delivery_time' => ['nullable', 'date_format:H:i'],
            'delivery_type' => ['required', 'string', 'max:255'],
            'baby_gender' => ['required', 'string', 'max:50'],
            'baby_weight' => ['nullable', 'numeric', 'min:0', 'max:10'],
            'delivery_outcome' => ['required', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);

        Delivery::create($validated);

        return redirect()
            ->route('deliveries.index')
            ->with('success', 'Delivery record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        $delivery->load(['mother', 'ancVisit']);

        return view('deliveries.show', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Delivery $delivery)
    {
        $mothers = Mother::orderBy('full_name')->get();
        $ancVisits = AncVisit::with('mother')
            ->latest('visit_date')
            ->get();

        return view('deliveries.edit', compact('delivery', 'mothers', 'ancVisits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Delivery $delivery)
    {
        $validated = $request->validate([
            'mother_id' => ['required', 'exists:mothers,id'],
            'anc_visit_id' => ['nullable', 'exists:anc_visits,id'],
            'delivery_date' => ['required', 'date'],
            'delivery_time' => ['nullable', 'date_format:H:i'],
            'delivery_type' => ['required', 'string', 'max:255'],
            'baby_gender' => ['required', 'string', 'max:50'],
            'baby_weight' => ['nullable', 'numeric', 'min:0', 'max:10'],
            'delivery_outcome' => ['required', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);

        $delivery->update($validated);

        return redirect()
            ->route('deliveries.index')
            ->with('success', 'Delivery record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return redirect()
            ->route('deliveries.index')
            ->with('success', 'Delivery record deleted successfully.');
    }
}
