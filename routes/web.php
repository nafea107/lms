<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return redirect(app()->getLocale());
});


Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::prefix('{locale}')->whereIn('locale', ['ar', 'ku', 'en'])->group(function () {
    require __DIR__ . '/landing.php';
    require __DIR__ . '/admin.php';
    require __DIR__ . '/auth.php';

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
