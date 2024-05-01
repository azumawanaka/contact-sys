<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('contact.index');
    }
    return view('auth.login');
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.index');
    Route::get('/contacts/fetch', [App\Http\Controllers\ContactController::class, 'fetchContacts'])->name('contacts.fetch');

    Route::get('/contact/new', [App\Http\Controllers\ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact/{contact}', [App\Http\Controllers\ContactController::class, 'edit'])->name('contact.edit');
    Route::put('/contact/{contact}', [App\Http\Controllers\ContactController::class, 'update'])->name('contact.update');
    Route::delete('/contact/{contact}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contact.destroy');
});

