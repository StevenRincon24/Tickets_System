<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIncidencias extends Model
{
    /** @use HasFactory<\Database\Factories\TipoIncidenciaFactory> */
    use HasFactory;
    protected $fillable = ['nombre'];
}
