<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function create()
    {
        return view('auth.patient-registration', [
            'paciente' => new Paciente()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro,Prefiero no decirlo',
            'correo_electronico' => 'required|email|unique:paciente,correo_electronico',
            'contraseña' => 'required|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'foto_rostro' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    
        // Procesar la imagen
        if ($request->hasFile('foto_rostro')) {
            $image = $request->file('foto_rostro');
            $validated['foto_rostro'] = base64_encode(file_get_contents($image->getRealPath()));
        }
    
        // El mutador en el modelo se encargará del hashing
        $paciente = Paciente::create($validated);
    
        // Autenticar al usuario después del registro
        Auth::guard('paciente')->login($paciente);
    
        return redirect()->route('home')->with('success', '¡Registro exitoso!');
    }
}