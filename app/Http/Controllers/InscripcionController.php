<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Materia;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class InscripcionController extends Controller
{
    /**
     * Procesa la preinscripción del estudiante.
     */
    public function store(Request $request)
    {
        // 1. Validar que los campos no estén vacíos
        $request->validate([
            'cedula' => 'required',
            'nombre_apellido' => 'required',
            'materia_id' => 'required'
        ]);

        // Convertir a mayúsculas para comparar y guardar uniformemente
        $cedulaUpper = strtoupper($request->cedula);
        $nombreUpper = strtoupper($request->nombre_apellido);

        // 2. REGLA: No inscribirse dos veces en la misma materia
        $existe = Inscripcion::where('cedula', $cedulaUpper)
                             ->where('materia_id', $request->materia_id)
                             ->exists();

        if ($existe) {
            return back()->withInput()->withErrors([
                'error' => 'EL ESTUDIANTE YA SE ENCUENTRA REGISTRADO EN ESTA UNIDAD CURRICULAR.'
            ]);
        }

        // 3. Buscar materia y validar cupo de 25
        $materia = Materia::findOrFail($request->materia_id);
        
        if ($materia->cupo_actual >= 25) {
            return back()->withInput()->withErrors([
                'error' => 'LO SENTIMOS, EL CUPO MÁXIMO (25) PARA ESTA SECCIÓN SE HA AGOTADO.'
            ]);
        }

        // 4. GENERAR CÓDIGO ÚNICO DE SEGURIDAD (Ej: UNESR-2026-A1B2)
        $codigoSeguridad = 'UNESR-' . date('Y') . '-' . strtoupper(Str::random(4));

        // 5. GUARDAR REGISTRO EN MAYÚSCULAS
        $inscripcion = Inscripcion::create([
            'cedula' => $cedulaUpper,
            'nombre_apellido' => $nombreUpper,
            'materia_id' => $request->materia_id,
            'codigo_verificacion' => $codigoSeguridad
        ]);

        // 6. Incrementar cupo actual de la materia
        $materia->increment('cupo_actual');

        // 7. Retornar vista de éxito con el comprobante
        return view('exito', compact('inscripcion'));
    }
}
