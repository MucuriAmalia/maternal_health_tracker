<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Mother;
use App\Models\PostnatalCareVisit;
use Illuminate\Http\Request;

class PostnatalCareVisitController extends Controller
{
    public function index()
    {
        $postnatalCareVisits = PostnatalCareVisit::with(['mother', 'delivery'])
            ->latest('visit_date')
            ->latest()
            ->paginate(10);

        $totalVisits = PostnatalCareVisit::count();
        $stableMothers = PostnatalCareVisit::where('mother_condition', 'Stable')->count();
        $babiesReferred = PostnatalCareVisit::where('baby_condition', 'Referred')->count();

        return view('postnatal-care-visits.index', compact(
            'postnatalCareVisits',
            'totalVisits',
            'stableMothers',
            'babiesReferred'
        ));
    }

    public function create()
    {
        $mothers = Mother::orderBy('full_name')->get();
        $deliveries = Delivery::with('mother')
            ->latest('delivery_date')
            ->get();

        return view('postnatal-care-visits.create', compact('mothers', 'deliveries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mother_id' => ['required', 'exists:mothers,id'],
            'delivery_id' => ['nullable', 'exists:deliveries,id'],
            'visit_date' => ['required', 'date'],
            'visit_time' => ['nullable', 'date_format:H:i'],
            'days_after_delivery' => ['nullable', 'integer', 'min:0'],
            'mother_condition' => ['nullable', 'string', 'max:255'],
            'bleeding_status' => ['nullable', 'string', 'max:255'],
            'temperature' => ['nullable', 'string', 'max:50'],
            'blood_pressure' => ['nullable', 'string', 'max:50'],
            'breastfeeding_status' => ['nullable', 'string', 'max:255'],
            'baby_condition' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        PostnatalCareVisit::create($validated);

        return redirect()
            ->route('postnatal-care-visits.index')
            ->with('success', 'Postnatal care visit recorded successfully.');
    }

    public function show(PostnatalCareVisit $postnatalCareVisit)
    {
        $postnatalCareVisit->load(['mother', 'delivery']);

        return view('postnatal-care-visits.show', compact('postnatalCareVisit'));
    }

    public function edit(PostnatalCareVisit $postnatalCareVisit)
    {
        $mothers = Mother::orderBy('full_name')->get();
        $deliveries = Delivery::with('mother')
            ->latest('delivery_date')
            ->get();

        return view('postnatal-care-visits.edit', compact(
            'postnatalCareVisit',
            'mothers',
            'deliveries'
        ));
    }

    public function update(Request $request, PostnatalCareVisit $postnatalCareVisit)
    {
        $validated = $request->validate([
            'mother_id' => ['required', 'exists:mothers,id'],
            'delivery_id' => ['nullable', 'exists:deliveries,id'],
            'visit_date' => ['required', 'date'],
            'visit_time' => ['nullable', 'date_format:H:i'],
            'days_after_delivery' => ['nullable', 'integer', 'min:0'],
            'mother_condition' => ['nullable', 'string', 'max:255'],
            'bleeding_status' => ['nullable', 'string', 'max:255'],
            'temperature' => ['nullable', 'string', 'max:50'],
            'blood_pressure' => ['nullable', 'string', 'max:50'],
            'breastfeeding_status' => ['nullable', 'string', 'max:255'],
            'baby_condition' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $postnatalCareVisit->update($validated);

        return redirect()
            ->route('postnatal-care-visits.index')
            ->with('success', 'Postnatal care visit updated successfully.');
    }

    public function destroy(PostnatalCareVisit $postnatalCareVisit)
    {
        $postnatalCareVisit->delete();

        return redirect()
            ->route('postnatal-care-visits.index')
            ->with('success', 'Postnatal care visit deleted successfully.');
    }
}
