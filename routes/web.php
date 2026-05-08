<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscripcionController;

// Muestra el formulario
Route::get('/', function () {
    return view('welcome');
});

// Procesa el formulario
Route::post('/inscribir', [InscripcionController::class, 'store'])->name('inscribir');
