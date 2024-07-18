<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    

    // user details &billing
    Route::get('/details/index',[UserDetailsController::class, 'index'])->name('details.index');
    Route::get('/details/create',[UserDetailsController::class, 'create'])->name('details.create');
    Route::get('/details/edit',[UserDetailsController::class, 'edit'])->name('details.edit');
    Route::post('/details/create',[UserDetailsController::class, 'store'])->name('details.store');
    Route::post('/details/update',[UserDetailsController::class, 'update'])->name('details.update');
    Route::delete('/details/delete/{user_details}/{billing}', [UserDetailsController::class, 'destroy'])->name('details.destroy');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
