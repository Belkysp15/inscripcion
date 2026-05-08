<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscripcionController;

// Muestra el formulario
Route::get('/', function () {
    return view('welcome');
});

// Procesa el formulario
Route::post('/inscribir', [InscripcionController::class, 'store'])->name('inscribir');

// ESTO ES SOLO PARA CREAR EL USUARIO UNA VEZ
Route::get('/crear-admin', function () {
    \App\Models\User::create([
        'name' => 'Belkys',
        'email' => 'belkys@admin.com', // Puedes cambiarlo
        'password' => Hash::make('admin1234'), // Esta será tu clave
    ]);
    return "Usuario Creado Exitosamente";
});
