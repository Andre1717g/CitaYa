<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $table = 'historial_medico';

    protected $fillable = [
        'cita_id',
        'descripcion',
        'receta',
        'fecha_registro',
    ];

    public $timestamps = false;

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}