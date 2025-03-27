<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'estado',
        'user_id',
        'dependencia_id',
        'subcategoria_id',
    ];


    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function categoria()
    {
        return $this->hasOneThrough(Categoria::class, Subcategoria::class, 'id', 'id', 'subcategoria_id', 'categoria_id');
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificaciones_Incidencia::class);
    }

    /**
     * Relación: Una incidencia tiene muchos comentarios.
     */
    public function comentarios()
    {
        return $this->hasMany(Comentario_Incidencia::class);
    }
}
