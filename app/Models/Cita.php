<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'cita';

    protected $fillable = [
        'doctor_id',
        'paciente_id',
        'fecha',
        'hora',
        'motivo',
        'estado',
        'observaciones',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function historial()
    {
        return $this->hasOne(HistorialMedico::class);
    }
}