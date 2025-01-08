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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titulo');
            $table->text('descripcion');
            $table->foreignId('tipo_incidencia_id')->constrained('tipo_incidencias')->onDelete('cascade');
            $table->string('criticidad'); // Nivel de criticidad
            $table->string('estado'); // Estado de la incidencia
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dependencia_id')->constrained('dependencias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};
