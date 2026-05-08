<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\InscripcionController;

/*

|--------------------------------------------------------------------------
| Portal del Estudiante - Formulario de Inscripción
|--------------------------------------------------------------------------
*/

// Muestra el formulario azul elegante
Route::get('/', function () {
    return view('welcome');
});

// Procesa el registro de los alumnos
Route::post('/inscribir', [InscripcionController::class, 'store'])->name('inscribir');


/*

|--------------------------------------------------------------------------
| RUTA MÁGICA DE INSTALACIÓN (Solo ejecutar una vez en Render)
|--------------------------------------------------------------------------
*/

Route::get('/instalar-todo', function () {
    try {
        // 1. Crea las tablas en la base de datos de la nube
        Artisan::call('migrate:fresh', ['--force' => true]);
        
        // 2. Carga las 6 materias del PNF Fisioterapia
        Artisan::call('db:seed', ['--force' => true]);
        
        // 3. Crea el usuario de Belkys para el panel administrativo
        \App\Models\User::create([
            'name' => 'Belkys',
            'email' => 'belkys@admin.com',
            'password' => Hash::make('admin1234'),
        ]);

        return "✅ ¡ÉXITO! Tablas creadas, materias cargadas y usuario 'Belkys' listo.";
    } catch (\Exception $e) {
        return "❌ ERROR DURANTE LA INSTALACIÓN: " . $e->getMessage();
    }
});
