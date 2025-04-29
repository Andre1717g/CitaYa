<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    // Mostrar formulario de registro
    public function create()
    {
        return view('auth.patient-registration', [
            'paciente' => new Paciente()
        ]);
    }

    // Guardar un nuevo paciente en la base de datos
    public function store(Request $request)
    {
        // ✅ Validamos los campos
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

        // ✅ Procesamos la imagen de rostro si la subió
        if ($request->hasFile('foto_rostro')) {
            $image = $request->file('foto_rostro');
            $validated['foto_rostro'] = base64_encode(file_get_contents($image->getRealPath()));
        }

        // ✅ Ajustamos el array para la base de datos
        $validated['contraseña'] = $validated['password'];
        unset($validated['password']);
        unset($validated['password_confirmation']);

        // ✅ Creamos al paciente
        $paciente = Paciente::create($validated);

        // ✅ Autenticamos al paciente
        Auth::guard('paciente')->login($paciente);
        $request->session()->regenerate();

        // ✅ Redireccionamos a la página principal
        return redirect()->route('home')->with('success', '¡Registro exitoso!');
    }

    // Mostrar perfil del paciente logueado
    public function perfil()
    {
        $paciente = Auth::guard('paciente')->user(); // obtener paciente autenticado
        return view('paciente.perfil', compact('paciente'));
    }

    // Mostrar formulario para editar perfil
    public function edit()
    {
        $paciente = Auth::guard('paciente')->user(); // obtener paciente autenticado
        return view('paciente.perfil-editar', compact('paciente'));
    }

    // Actualizar los datos del paciente
    public function update(Request $request)
    {
        $paciente = Auth::guard('paciente')->user(); // obtener paciente autenticado

        // Validación
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro,Prefiero no decirlo',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'foto_rostro' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Si hay una nueva foto de rostro, la procesamos
        if ($request->hasFile('foto_rostro')) {
            $validated['foto_rostro'] = base64_encode(file_get_contents($request->file('foto_rostro')->getRealPath()));
        }

        // Actualizamos los datos
        $paciente->update($validated);

        // Redirigimos con mensaje de éxito
        return redirect()->route('paciente.perfil.editar')->with('success', '¡Perfil actualizado correctamente!');
    }
}
