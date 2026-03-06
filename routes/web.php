<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalCampaigns = \App\Models\Campaign::count();
    $totalSent      = \App\Models\Recipient::whereNotNull('sent_at')->count();
    $totalClicked   = \App\Models\Recipient::whereNotNull('clicked_at')->count();
    $clickRate      = $totalSent > 0 ? round(($totalClicked / $totalSent) * 100) : 0;
    $recentCampaigns = \App\Models\Campaign::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalCampaigns',
        'totalSent',
        'totalClicked',
        'clickRate',
        'recentCampaigns'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function(){
    Route::resource('campaigns', \App\Http\Controllers\CampaignController::class);
    Route::post('/campaigns/{campaign}/send', [App\Http\Controllers\CampaignController::class, 'send'])->name('campaigns.send');
    Route::post('/campaigns/{campaign}/recipients', [App\Http\Controllers\RecipientController::class, 'store'])->name('recipients.store');
    Route::delete('/recipients/{recipient}', [App\Http\Controllers\RecipientController::class, 'destroy'])->name('recipients.destroy');
    Route::get('/reports', function () {
        $campaigns = \App\Models\Campaign::with('recipients')->latest()->get();
        return view('reports', compact('campaigns'));
    })->name('reports');
});

Route::get('/track/{token}', [App\Http\Controllers\TrackingController::class, 'track'])->name('track');

require __DIR__.'/auth.php';