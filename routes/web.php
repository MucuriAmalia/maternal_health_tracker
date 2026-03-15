<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\PregnancyController;
use App\Http\Controllers\AncVisitController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PostnatalCareVisitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('mothers', MotherController::class);
    Route::resource('pregnancies', PregnancyController::class);
    Route::resource('anc-visits', AncVisitController::class);
    Route::resource('investigations', InvestigationController::class);
    Route::resource('deliveries', DeliveryController::class);
    Route::resource('postnatal-care-visits', PostnatalCareVisitController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/anc', [ReportController::class, 'anc'])->name('reports.anc');
    Route::get('/reports/anc/pdf', [ReportController::class, 'ancPdf'])->name('reports.anc.pdf');
    Route::get('/reports/expected-deliveries', [ReportController::class, 'expectedDeliveries'])->name('reports.expected');
    Route::get('/reports/high-risk', [ReportController::class, 'highRisk'])->name('reports.highrisk');
    Route::get('/reports/delivery-outcomes', [ReportController::class, 'deliveryOutcomes'])->name('reports.delivery');
    Route::get(
    '/postnatal-care-visits/{postnatalCareVisit}/pdf',
    [PostnatalCareVisitController::class, 'pdf']
)->name('postnatal-care-visits.pdf');
    Route::get('/reports/supplements', [ReportController::class, 'supplements'])->name('reports.supplements');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';