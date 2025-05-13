<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\ContactForm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact', ContactForm::class);

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/home');

    Route::get('/home', function () {
        return view('admin.index');
    })->name('index');

    Route::get('/portfolio', [AdminController::class, 'portfolio'])->name('portfolio');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
