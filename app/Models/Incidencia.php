<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    /** @use HasFactory<\Database\Factories\IncidenciaFactory> */
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo_incidencia_id',
        'criticidad',
        'estado',
        'user_id',
        'dependencia_id'
    ];

    public function tipoIncidencia()
    {
        return $this->belongsTo(TipoIncidencias::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }
}
