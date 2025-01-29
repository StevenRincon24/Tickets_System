<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioIncidenciasTable extends Migration
{
    public function up()
    {
        Schema::create('comentario_incidencias', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->foreignId('incidencia_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comentario_incidencias');
    }
}
