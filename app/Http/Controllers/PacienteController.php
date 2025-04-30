<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Doctor;
use App\Models\HorarioDoctor; 
use App\Models\Cita; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    // Registro de paciente
    public function create()
    {
        return view('auth.patient-registration', [
            'paciente' => new Paciente()
        ]);
    }

    // Almacenar paciente
    public function store(Request $request)
    {
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

        if ($request->hasFile('foto_rostro')) {
            $image = $request->file('foto_rostro');
            $validated['foto_rostro'] = base64_encode(file_get_contents($image->getRealPath()));
        }

        $validated['contraseña'] = $validated['password'];
        unset($validated['password'], $validated['password_confirmation']);

        $paciente = Paciente::create($validated);

        Auth::guard('paciente')->login($paciente);
        $request->session()->regenerate();

        return redirect()->route('home')->with('success', '¡Registro exitoso!');
    }

    // Ver perfil del paciente
    public function perfil()
    {
        $paciente = Auth::guard('paciente')->user();
        return view('paciente.perfil', compact('paciente'));
    }

    // Editar perfil del paciente
    public function edit()
    {
        $paciente = Auth::guard('paciente')->user();
        return view('paciente.perfil-editar', compact('paciente'));
    }

    // Actualizar perfil del paciente
    public function update(Request $request)
    {
        $paciente = Auth::guard('paciente')->user();

        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro,Prefiero no decirlo',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
            'foto_rostro' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_rostro')) {
            $validated['foto_rostro'] = base64_encode(file_get_contents($request->file('foto_rostro')->getRealPath()));
        }

        $paciente->update($validated);

        return redirect()->route('paciente.perfil.editar')->with('success', '¡Perfil actualizado correctamente!');
    }

    // Mostrar detalle del médico
    public function verDetalle($id)
    {
        $doctor = Doctor::findOrFail($id);
        $horarios = HorarioDoctor::where('doctor_id', $id)->get(); 

        return view('paciente.medico-detalle', compact('doctor', 'horarios'));
    }

    // Mostrar citas del paciente
    public function citas()
    {
        // Obtener el paciente autenticado
        $paciente = Auth::guard('paciente')->user();

        // Obtener las citas del paciente
        $citas = $paciente->citas; // Relación de citas asociadas al paciente

        return view('paciente.citas', compact('citas'));
    }
}
