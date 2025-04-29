<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function perfil()
    {
        if (auth()->guard('doctor')->check()) {
            $doctor = auth()->guard('doctor')->user();
            return view('doctor.perfil', compact('doctor'));
        } else {
            return redirect()->route('login');
        }
    }

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

    // ✅ MÉTODO AGREGADO PARA MOSTRAR LA VISTA DE HORARIO
    public function horario()
    {
        if (auth()->guard('doctor')->check()) {
            return view('doctor.horario');
        } else {
            return redirect()->route('login');
        }
    }
}
