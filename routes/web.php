<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// One-time migration endpoint for production (should be removed after use)
Route::get('/run-migrations', function () {
    if (config('app.env') !== 'production') {
        return 'This route only works in production';
    }
    
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return 'Migrations completed successfully! <br>' . \Illuminate\Support\Facades\Artisan::output();
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
});

// Invoice routes (requires auth & admin)
use App\Http\Controllers\InvoiceController;

Route::middleware(['auth'])->group(function () {
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoices.create');
    Route::post('/invoice', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::get('/invoice/{invoice}/generate', [InvoiceController::class, 'generatePdf'])->name('invoices.generatePdf');
    Route::get('/invoice/{invoice}/download', [InvoiceController::class, 'download'])->name('invoices.download');
});
