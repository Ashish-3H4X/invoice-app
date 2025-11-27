<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return redirect()->route('login');
});


// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CUSTOMER MODULE
Route::middleware(['auth'])->group(function () {
    Route::resource('customers', CustomerController::class);
});

// SERVICES MODULE
Route::middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
});

// INVOICE MODULE
Route::middleware(['auth'])->group(function () {

    // Full Resource Routes
    Route::resource('invoices', InvoiceController::class);

    // Print Invoice
    Route::get('/invoices/{id}/print', 
        [InvoiceController::class, 'print']
    )->name('invoices.print');

    // PDF Download (not implemented yet, placeholder)
    Route::get('/invoices/{id}/pdf', 
        [InvoiceController::class, 'downloadPDF']
    )->name('invoices.pdf');
});

// PAYMENTS MODULE (Placeholder so sidebar link does NOT break)
Route::middleware(['auth'])->group(function () {
    Route::get('/payments', function () {
        return view('payments.index');   // must exist
    })->name('payments.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/settings', function () {
        return view('settings.index');  // must create file
    })->name('settings.index');
});


//  mail test route


Route::get('/test-mail', function () {
    try {
        Mail::raw('Test email from Laravel Mailtrap', function ($message) {
            $message->to('test@example.com')
                    ->subject('Testing Mailtrap');
        });

        return "Sent!";
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});



require __DIR__.'/auth.php';
