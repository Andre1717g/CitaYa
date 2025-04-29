<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Paciente extends Authenticatable
{
    use HasFactory;
    protected $guard = 'paciente';

    public $timestamps = false;

    protected $table = 'paciente';

    protected $fillable = [
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        'genero',
        'foto_rostro',
        'correo_electronico',
        'contraseña',
        'telefono',
        'direccion'
    ];

    protected $hidden = [
        'contraseña',
    ];

    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    protected $casts = [
        'fecha_nacimiento' => 'date',
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
        if ($value) {
            if (is_string($value) && str_starts_with($value, 'data:image')) {
                // Si viene como base64 desde el frontend
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
                $this->attributes['foto_rostro'] = $imageData;
            } elseif ($value instanceof \Illuminate\Http\UploadedFile) {
                // Si es un archivo subido
                $this->attributes['foto_rostro'] = file_get_contents($value->getRealPath());
            }
        }
    }

    /**
     * Obtiene la foto en formato base64 para visualización
     */
    public function getFotoRostroAttribute($value)
    {
        if (!$value) return null;

        // Verifica si ya es un string base64
        if (base64_encode(base64_decode($value, true)) === $value) {
            return 'data:image/jpeg;base64,' . $value;
        }

        return 'data:image/jpeg;base64,' . base64_encode($value);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}