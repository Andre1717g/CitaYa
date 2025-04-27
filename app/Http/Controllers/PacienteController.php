<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
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
        // ✅ Validamos usando 'password' y 'password_confirmation'
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro,Prefiero no decirlo',
            'correo_electronico' => 'required|email|unique:paciente,correo_electronico',
            'password' => 'required|min:8|confirmed',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string',
            'foto_rostro' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'terms' => 'required|accepted'
        ]);

        // ✅ Procesamos la imagen de rostro
        if ($request->hasFile('foto_rostro')) {
            $image = $request->file('foto_rostro');
            $validated['foto_rostro'] = base64_encode(file_get_contents($image->getRealPath()));
        }

        // ✅ Ajustamos el array para que coincida con la tabla (cambiar 'password' por 'contraseña')
        $validated['contraseña'] = $validated['password'];
        unset($validated['password']);
        unset($validated['password_confirmation']);

        // ✅ Creamos el paciente
        $paciente = Paciente::create($validated);

        // ✅ Autenticamos y regeneramos la sesión para seguridad
        Auth::guard('paciente')->login($paciente);
        $request->session()->regenerate();

        // ✅ Redireccionamos con mensaje
        return redirect()->route('home')->with('success', '¡Registro exitoso!');
    }
}
