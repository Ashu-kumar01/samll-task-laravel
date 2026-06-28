<?php

use App\Http\Controllers\EvenOddController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/find_even_odd', [EvenOddController::class, 'index'])->name('find_even_odd');
Route::post('/find_even_odd', [EvenOddController::class, 'store'])->name('check.number');
