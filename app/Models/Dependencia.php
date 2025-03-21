<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    /** @use HasFactory<\Database\Factories\DependenciaFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];

    public function incidencias()
    {
        return $this->hasMany(Incidencia::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(Notificaciones_Incidencia::class);
    }

    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
