<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

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

    /**
     * Hashea la contraseña automáticamente
     */
    public function setContraseñaAttribute($value)
    {
        $this->attributes['contraseña'] = Hash::make($value);
    }

    /**
     * Procesa la imagen antes de guardarla
     */
    public function setFotoRostroAttribute($value)
    {
        if ($value && is_string($value) && str_starts_with($value, 'data:image')) {
            // Si es base64 directamente desde el frontend (formulario)
            $this->attributes['foto_rostro'] = preg_replace('#^data:image/\w+;base64,#i', '', $value);
        } elseif ($value && $value instanceof \Illuminate\Http\UploadedFile) {
            // Si es un archivo subido
            $this->attributes['foto_rostro'] = base64_encode(file_get_contents($value->getRealPath()));
        } else {
            // Si no se proporciona una foto, dejamos el valor nulo
            $this->attributes['foto_rostro'] = $value;
        }
    }

    /**
     * Obtiene la foto en formato base64 para visualización
     */
    public function getFotoRostroAttribute($value)
    {
        if (!$value) {
            return null;
        }

        // Verifica si el valor está en base64 y añade el prefijo adecuado
        return 'data:image/jpeg;base64,' . $value;
    }

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function horarios()
    {
        return $this->hasMany(HorarioDoctor::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}
