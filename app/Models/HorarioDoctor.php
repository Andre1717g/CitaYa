<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioDoctor extends Model
{
    use HasFactory;

    protected $table = 'horario_doctor';

    protected $fillable = [
        'doctor_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}