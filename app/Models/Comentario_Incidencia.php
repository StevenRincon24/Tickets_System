<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario_Incidencia extends Model
{
    use HasFactory;

    protected $table = 'comentario_incidencias';

    // Si los nombres de los campos no siguen la convención de Laravel, especifica los campos fillable
    protected $fillable = ['descripcion', 'incidencia_id', 'user_id'];

    /**
     * Relación: Un comentario pertenece a una incidencia.
     */
    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class);
    }

    /**
     * Relación: Un comentario pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
