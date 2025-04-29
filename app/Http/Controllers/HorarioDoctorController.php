<?php

namespace App\Http\Controllers;

use App\Models\HorarioDoctor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HorarioDoctorController extends Controller
{
    // Mostrar horarios existentes
    public function index()
    {
        $doctor_id = auth()->guard('doctor')->user()->id;
        $horarios = HorarioDoctor::where('doctor_id', $doctor_id)->get();

        // Convertir a formato 12 horas
        foreach ($horarios as $horario) {
            $horario->hora_inicio = Carbon::parse($horario->hora_inicio)->format('h:i A');
            $horario->hora_fin = Carbon::parse($horario->hora_fin)->format('h:i A');
        }

        return view('doctor.horario', compact('horarios'));
    }

    // Guardar nuevo horario
    public function store(Request $request)
    {
        $request->validate([
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required'
        ]);

        $doctor_id = auth()->guard('doctor')->user()->id;
        HorarioDoctor::create([
            'doctor_id' => $doctor_id,
            'dia_semana' => $request->dia_semana,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin
        ]);

        return redirect()->route('doctor.horario')->with('success', 'Horario agregado correctamente.');
    }

    // Editar horario
    public function edit($id)
    {
        $horario = HorarioDoctor::findOrFail($id);
        return view('doctor.editar-horario', compact('horario'));
    }

    // Actualizar horario
    public function update(Request $request, $id)
    {
        $request->validate([
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required'
        ]);

        $horario = HorarioDoctor::findOrFail($id);
        $horario->update([
            'dia_semana' => $request->dia_semana,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin
        ]);

        return redirect()->route('doctor.horario')->with('success', 'Horario actualizado correctamente.');
    }

    // Eliminar horario
    public function destroy($id)
    {
        $horario = HorarioDoctor::findOrFail($id);
        $horario->delete();

        return redirect()->route('doctor.horario')->with('success', 'Horario eliminado correctamente.');
    }
}
