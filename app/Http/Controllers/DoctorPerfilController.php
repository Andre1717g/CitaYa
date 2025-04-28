<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorPerfilController extends Controller
{
    public function edit()
    {
        $doctor = Auth::user(); // asumimos que ya el doctor está autenticado
        return view('doctor.editar-perfil', compact('doctor'));
    }

    public function update(Request $request)
    {
        $doctor = Auth::user(); // mismo doctor logueado

        $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'descripcion_especialidad' => 'required|string|max:255',
            'direccion_consultorio' => 'required|string|max:255',
            'enlace_google_maps' => 'nullable|url',
            'correo_electronico' => 'required|email|max:255',
            'foto_rostro' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->descripcion_especialidad = $request->descripcion_especialidad;
        $doctor->direccion_consultorio = $request->direccion_consultorio;
        $doctor->enlace_google_maps = $request->enlace_google_maps;
        $doctor->correo_electronico = $request->correo_electronico;

        if ($request->hasFile('foto_rostro')) {
            $image = $request->file('foto_rostro');
            $base64Image = base64_encode(file_get_contents($image->getRealPath()));
            $doctor->foto_rostro = $base64Image;
        }

        $doctor->save();

        return redirect()->route('doctor.perfil.editar')->with('success', 'Perfil actualizado correctamente.');
    }
}
