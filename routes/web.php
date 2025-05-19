<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Contact routes
    Route::resource('contacts', App\Http\Controllers\ContactController::class);

    // Contact Address routes
    Route::post('/contacts/{contact}/addresses', [App\Http\Controllers\ContactController::class, 'storeAddress'])
        ->name('contacts.addresses.store');
    Route::patch('/contacts/addresses/{address}', [App\Http\Controllers\ContactController::class, 'updateAddress'])
        ->name('contacts.addresses.update');
    Route::delete('/contacts/addresses/{address}', [App\Http\Controllers\ContactController::class, 'destroyAddress'])
        ->name('contacts.addresses.destroy');

    // Contact Methods routes
    Route::post('/contacts/{contact}/contact-methods', [App\Http\Controllers\ContactController::class, 'storeContactMethod'])
        ->name('contacts.contact-methods.store');
    Route::patch('/contacts/contact-methods/{contactMethod}', [App\Http\Controllers\ContactController::class, 'updateContactMethod'])
        ->name('contacts.contact-methods.update');
    Route::delete('/contacts/contact-methods/{contactMethod}', [App\Http\Controllers\ContactController::class, 'destroyContactMethod'])
        ->name('contacts.contact-methods.destroy');
});

require __DIR__.'/auth.php';
