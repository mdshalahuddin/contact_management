<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/create', [ContactController::class, 'create'])->name('create');
    Route::post('/', [ContactController::class, 'store'])->name('store')->middleware('throttle:30,1');
    Route::get('/{id}', [ContactController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ContactController::class, 'update'])->name('update');
    Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
});
