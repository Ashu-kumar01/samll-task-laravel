<?php

use App\Http\Controllers\AgeCalculaterController;
use App\Http\Controllers\EvenOddController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/find_even_odd', [EvenOddController::class, 'index'])->name('find_even_odd');
Route::post('/find_even_odd', [EvenOddController::class, 'store'])->name('check.number');

Route::get('/age-calculater', [AgeCalculaterController::class, 'index'])->name('ageCalculater');
Route::post('/age-calculater', [AgeCalculaterController::class, 'store'])->name('age.store');


Route::get('/new-invoice', [InvoiceController::class, 'index'])->name('invoice');
Route::post('/new-invoice', [InvoiceController::class, 'store'])->name('invoice.store');
Route::get('/pdf', [PdfController::class, 'generate'])->name('gen.pdf');
