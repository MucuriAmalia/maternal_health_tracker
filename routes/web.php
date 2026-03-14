<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MotherController;
use App\Http\Controllers\PregnancyController;
use App\Http\Controllers\AncVisitController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\PostnatalCareVisitController;
use App\Http\Controllers\ProfileController;
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


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';