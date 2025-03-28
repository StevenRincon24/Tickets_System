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
        Schema::create('notificaciones_incidencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incidencia_id')->constrained()->onDelete('cascade');;
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('dependencia_id')->constrained()->onDelete('cascade');
            $table->boolean('leido')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones__incidencias');
    }
};
