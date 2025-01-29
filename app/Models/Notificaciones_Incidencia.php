<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificaciones_Incidencia extends Model
{
    /** @use HasFactory<\Database\Factories\NotificacionesIncidenciaFactory> */
    use HasFactory;

    protected $table = 'notificaciones_incidencias';

    protected $fillable = [
        'incidencia_id',
        'user_id',
        'dependencia_id',
        'leido',
    ];

    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class);
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
