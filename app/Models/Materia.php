<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    protected $fillable = ['nombre', 'facilitador', 'horario', 'cupo_max', 'cupo_actual'];

    // AGREGA ESTO: Relación inversa
    public function inscripciones(): HasMany
    {
        return $this->hasMany(Inscripcion::class);
    }
}
