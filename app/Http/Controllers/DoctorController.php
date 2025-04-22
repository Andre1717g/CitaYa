<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function create()
    {
        return view('auth.doctor-registry', [
            'doctor' => new Doctor()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'area_salud' => 'required|string|max:100',
            'descripcion_especialidad' => 'required|string',
            'ubicacion_consultorio' => 'required|string',
            'google_maps' => 'required|url',
            'email' => 'required|email|unique:doctor,correo_electronico',
            'password' => 'required|min:8|confirmed',
            'foto_rostro' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'terms' => 'required|accepted'
        ]);

        // Preparar los datos para crear el doctor
        $doctorData = [
            'nombres' => $validated['nombres'],
            'apellidos' => $validated['apellidos'],
            'area_salud' => $validated['area_salud'],
            'descripcion_especialidad' => $validated['descripcion_especialidad'],
            'direccion_consultorio' => $validated['ubicacion_consultorio'],
            'enlace_google_maps' => $validated['google_maps'],
            'correo_electronico' => $validated['email'],
            'contraseña' => $validated['password'] // El mutador en el modelo hará el hash
        ];

        // Procesar la imagen solo si está presente
        if ($request->hasFile('foto_rostro')) {
            $image = $request->file('foto_rostro');
            $doctorData['foto_rostro'] = base64_encode(file_get_contents($image->getRealPath()));
        }

        // Crear el doctor
        Doctor::create($doctorData);

        return redirect()->route('home')->with([
            'success' => '¡Registro como doctor completado exitosamente!'
        ]);
    }
}