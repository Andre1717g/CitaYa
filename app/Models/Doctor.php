<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory;

    protected $guard = 'doctor';

    public $timestamps = false;

    protected $table = 'doctor';

    protected $fillable = [
        'nombres',
        'apellidos',
        'area_salud',
        'descripcion_especialidad',
        'direccion_consultorio',
        'enlace_google_maps',
        'correo_electronico',
        'contraseña',
        'foto_rostro'
    ];

    protected $hidden = [
        'contraseña',
    ];

    public function setContraseñaAttribute($value)
    {
        $this->attributes['contraseña'] = Hash::make($value);
    }

    public function setFotoRostroAttribute($value)
    {
        if ($value && $value instanceof \Illuminate\Http\UploadedFile) {
            $this->attributes['foto_rostro'] = base64_encode(file_get_contents($value->getRealPath()));
        } else {
            $this->attributes['foto_rostro'] = $value;
        }
    }

    public function getFotoRostroAttribute($value)
    {
        if (!$value) return null;
        return 'data:image/jpeg;base64,' . $value;
    }
}