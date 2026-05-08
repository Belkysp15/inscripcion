<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    $materias = [
        ['nombre' => 'Esfera Urogenital', 'facilitador' => 'Gabriel Silva', 'horario' => 'Lunes 8:00am', 'cupo_max' => 25, 'cupo_actual' => 0],
        ['nombre' => 'Sistema Estomatognatico', 'facilitador' => 'Barbi Cardenas', 'horario' => 'Martes 8:00am', 'cupo_max' => 25, 'cupo_actual' => 0],
        ['nombre' => 'Intervencion Especializada II', 'facilitador' => 'Gabriel Silva', 'horario' => 'Lunes 9:30am', 'cupo_max' => 25, 'cupo_actual' => 0],
        ['nombre' => 'Accesibilidad', 'facilitador' => 'Jose Guzman', 'horario' => 'Martes 9:30am', 'cupo_max' => 25, 'cupo_actual' => 0],
        ['nombre' => 'Proteccion y Bioseguridad', 'facilitador' => 'Jose Guzman', 'horario' => 'Martes 11:00am', 'cupo_max' => 25, 'cupo_actual' => 0],
        ['nombre' => 'Evaluacion de Impacto en Salud y Discapacidad', 'facilitador' => 'Luz Pernia', 'horario' => 'Miercoles 8:00am', 'cupo_max' => 25, 'cupo_actual' => 0],
    ];

    foreach ($materias as $m) {
        \App\Models\Materia::create($m);
    }
}

}
