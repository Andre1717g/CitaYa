<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    // Método para ver el perfil del doctor autenticado
    public function perfil()
    {
        // Verifica si el doctor está autenticado
        if (auth()->guard('doctor')->check()) {
            // Obtén la información del doctor autenticado
            $doctor = auth()->guard('doctor')->user(); // Usar auth()->guard('doctor') para obtener al doctor

            // Retorna la vista con los datos del doctor
            return view('doctor.perfil', compact('doctor'));
        } else {
            // Si no está autenticado, redirigir al login
            return redirect()->route('login'); // Redirige a la página de login
        }
    }

    // Método para crear un nuevo doctor (registro)
    public function create()
    {
        return view('auth.doctor-registry', [
            'doctor' => new Doctor()
        ]);
    }

    // Método para almacenar los datos del doctor
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'area_salud' => 'required|string|max:100',
            'descripcion_especialidad' => 'required|string',
            'ubicacion_consultorio' => 'required|string',
            'google_maps' => 'required|url',
            'email' => 'required|email|unique:doctors,correo_electronico', // Asegúrate de que la tabla sea `doctors`
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
            'contraseña' => Hash::make($validated['password']) // Usar Hash::make para el password
        ];

        // Procesar la imagen solo si está presente
        if ($request->hasFile('foto_rostro')) {
            // Almacenar la imagen en el directorio de almacenamiento y obtener la ruta
            $image = $request->file('foto_rostro');
            $doctorData['foto_rostro'] = file_get_contents($image->getRealPath());
        }

        // Crear el doctor en la base de datos
        Doctor::create($doctorData);

        return redirect()->route('home')->with([
            'success' => '¡Registro como doctor completado exitosamente!'
        ]);
    }

    public function index(Request $request)
    {
        $query = Doctor::query();

        // Buscar por nombre o apellido
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nombres', 'like', "%$search%")
                ->orWhere('apellidos', 'like', "%$search%");
            });
        }

        // Filtrar por especialidad
        if ($request->filled('especialidad') && $request->especialidad !== '') {
            $query->where('area_salud', $request->especialidad);
        }

        // Buscar por dirección
        if ($request->filled('direccion')) {
            $direccion = $request->direccion;
            $query->where('direccion_consultorio', 'like', "%$direccion%");
        }

        $doctores = $query->get();
        $especialidades = Doctor::select('area_salud')->distinct()->orderBy('area_salud')->pluck('area_salud');

        return view('medicos', compact('doctores', 'especialidades'));
    }

}
