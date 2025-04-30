<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HorarioDoctor; 
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Método para el perfil del doctor
    public function perfil()
    {
        if (auth()->guard('doctor')->check()) {
            $doctor = auth()->guard('doctor')->user();
            return view('doctor.perfil', compact('doctor'));
        } else {
            return redirect()->route('login');
        }
    }

    // Método para registrar un nuevo doctor
    public function create()
    {
        return view('auth.doctor-registry', [
            'doctor' => new Doctor()
        ]);
    }

    // Método para almacenar los datos del doctor
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

        $doctorData = [
            'nombres' => $validated['nombres'],
            'apellidos' => $validated['apellidos'],
            'area_salud' => $validated['area_salud'],
            'descripcion_especialidad' => $validated['descripcion_especialidad'],
            'direccion_consultorio' => $validated['ubicacion_consultorio'],
            'enlace_google_maps' => $validated['google_maps'],
            'correo_electronico' => $validated['email'],
            'contraseña' => $validated['password']
        ];

        if ($request->hasFile('foto_rostro')) {
            $image = $request->file('foto_rostro');
            $doctorData['foto_rostro'] = base64_encode(file_get_contents($image->getRealPath()));
        }

        Doctor::create($doctorData);

        return redirect()->route('home')->with([
            'success' => '¡Registro como doctor completado exitosamente!'
        ]);
    }

    // Método para mostrar todos los doctores (búsqueda)
    public function index(Request $request)
    {
        $query = Doctor::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%$search%")
                  ->orWhere('apellidos', 'like', "%$search%");
            });
        }

        if ($request->filled('especialidad') && $request->especialidad !== '') {
            $query->where('area_salud', $request->especialidad);
        }

        if ($request->filled('direccion')) {
            $direccion = $request->direccion;
            $query->where('direccion_consultorio', 'like', "%$direccion%");
        }

        $doctores = $query->get();
        $especialidades = Doctor::select('area_salud')->distinct()->orderBy('area_salud')->pluck('area_salud');

        return view('medicos', compact('doctores', 'especialidades'));
    }

    // Método para ver los detalles del doctor
    public function detalle($id)
    {
        // Obtener el doctor por el ID
        $doctor = Doctor::findOrFail($id);

        // Obtener los horarios de atención del doctor
        $horarios = HorarioDoctor::where('doctor_id', $id)->get();

        // Retornar la vista con los datos del doctor y sus horarios
        return view('detalle', compact('doctor', 'horarios'));
    }

    // Método para la página de horarios (para el doctor)
    public function horario()
    {
        if (auth()->guard('doctor')->check()) {
            return view('doctor.horario');
        } else {
            return redirect()->route('login');
        }
    }

    // Método para mostrar médicos para pacientes (con filtros)
    public function mostrarParaPaciente(Request $request)
    {
        $query = Doctor::query();

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%$search%")
                  ->orWhere('apellidos', 'like', "%$search%");
            });
        }

        if ($request->filled('especialidad') && $request->especialidad !== '') {
            $query->where('area_salud', $request->especialidad);
        }

        if ($request->filled('direccion')) {
            $direccion = $request->direccion;
            $query->where('direccion_consultorio', 'like', "%$direccion%");
        }

        $doctores = $query->get();
        $especialidades = Doctor::select('area_salud')->distinct()->orderBy('area_salud')->pluck('area_salud');

        return view('paciente.medico', compact('doctores', 'especialidades'));
    }
}
