<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('auth')->group(function () {

    // Dashboard with stats
    Route::get('/dashboard', function () {
        return view('dashboard', [
            'totalProperties'     => \App\Models\Property::count(),
            'availableProperties' => \App\Models\Property::where('status', 'available')->count(),
            'soldProperties'      => \App\Models\Property::where('status', 'sold')->count(),
            'totalClients'        => \App\Models\Client::count(),
            'totalTransactions'   => \App\Models\Transaction::count(),
            'recentTransactions'  => \App\Models\Transaction::with(['property', 'client'])
                                        ->latest('transaction_date')->take(5)->get(),
        ]);
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // All roles can view properties
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');

    // Admin only
    Route::middleware('role:admin')->group(function () {
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    });

    // Admin and Agent
    Route::middleware('role:admin,agent')->group(function () {
        Route::resource('clients', ClientController::class);
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
        Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    });

});

require __DIR__.'/auth.php';