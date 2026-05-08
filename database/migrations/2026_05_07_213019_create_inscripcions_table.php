<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('inscripcions', function (Blueprint $table) {
        $table->id();
        $table->string('cedula')->unique();
        $table->string('nombre_apellido');
        // Esta línea es la que suele fallar si 'materias' no existe
        $table->foreignId('materia_id')->constrained('materias')->onDelete('cascade'); 
        $table->timestamps();
    });
}


};

