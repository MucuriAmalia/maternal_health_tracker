<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mother;
use App\Models\AncVisit;
use App\Models\Delivery;
use App\Models\Investigation;
use PDF;

class ReportController extends Controller
{

    public function index()
    {
        return view('reports.index');
    }

    public function anc(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $query = AncVisit::query();

        if ($start && $end) {
            $query->whereBetween('visit_date', [$start, $end]);
        }

        $visits = $query->latest()->get();

        return view('reports.anc', compact('visits', 'start', 'end'));
    }

    public function expectedDeliveries()
    {
        $deliveries = Mother::whereNotNull('expected_delivery_date')->get();

        return view('reports.expected', compact('deliveries'));
    }

    public function highRisk()
    {
        $highRisk = Mother::where('risk_level', 'high')
            ->latest()
            ->get();

        return view('reports.highrisk', compact('highRisk'));
    }

    public function deliveryOutcomes()
    {
        $deliveries = Delivery::with('mother')
            ->latest()
            ->get();

        return view('reports.delivery', compact('deliveries'));
    }

    public function supplements()
    {
        $supplements = AncVisit::with('mother')
            ->whereNotNull('supplements_given')
            ->latest()
            ->get();

        return view('reports.supplements', compact('supplements'));
    }

    public function ancPdf(Request $request)
    {
        $start = $request->start_date;
        $end = $request->end_date;

        $query = AncVisit::with('mother');

        if ($start && $end) {
            $query->whereBetween('visit_date', [$start, $end]);
        }

        $visits = $query->latest()->get();

        $pdf = Pdf::loadView('reports.pdf.anc', compact('visits', 'start', 'end'));

        return $pdf->download('anc-attendance-report.pdf');
    }
}