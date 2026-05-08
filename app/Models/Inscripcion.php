<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inscripcion extends Model
{
    // Campos que permitimos guardar en la base de datos
   protected $fillable = ['cedula', 'nombre_apellido', 'materia_id', 'codigo_verificacion', 'validado'];


    /**
     * Relación con la materia inscrita
     */
    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class);
    }
}
