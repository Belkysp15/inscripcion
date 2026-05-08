<?php

namespace App\Filament\Widgets;

use App\Models\Materia;
use App\Models\Inscripcion;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    /**
     * Define las tarjetas de estadísticas que se verán en el Dashboard.
     */
    protected function getStats(): array
    {
        // 1. Obtener todas las materias cargadas (las 6 de Fisioterapia)
        $materias = Materia::all();
        $stats = [];

        // 2. Crear una tarjeta dinámica por cada materia
        foreach ($materias as $materia) {
            $cuposOcupados = $materia->cupo_actual;
            $estaLlena = $cuposOcupados >= 25;

            $stats[] = Stat::make($materia->nombre, $cuposOcupados . ' / 25')
                ->description($estaLlena ? 'SECCIÓN LLENA' : 'Cupos ocupados actualmente')
                ->descriptionIcon($estaLlena ? 'heroicon-m-lock-closed' : 'heroicon-m-user-group')
                ->color($estaLlena ? 'danger' : 'success') // Rojo si está llena, verde si hay cupo
                ->chart([7, 10, 5, 15, $cuposOcupados]); // Pequeña gráfica de adorno
        }

        // 3. Tarjeta de Resumen Global (Opcional, al final de la lista)
        $stats[] = Stat::make('TOTAL GENERAL PNF', Inscripcion::count())
            ->description('Estudiantes preinscritos en total')
            ->descriptionIcon('heroicon-m-academic-cap')
            ->color('info');

        return $stats;
    }
}
