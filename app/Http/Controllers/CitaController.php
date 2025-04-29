<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        // Puede filtrar por doctor o paciente si se envía el ID
        return Cita::with(['doctor', 'paciente'])->when($request->doctor_id, function ($query, $doctor_id) {
            return $query->where('doctor_id', $doctor_id);
        })->when($request->paciente_id, function ($query, $paciente_id) {
            return $query->where('paciente_id', $paciente_id);
        })->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctor,id',
            'paciente_id' => 'required|exists:paciente,id',
            'fecha' => 'required|date',
            'hora' => 'required',
        ]);

        return Cita::create([
            ...$request->all(),
            'estado' => 'Pendiente'
        ]);
    }

    public function confirmar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'Confirmada';
        $cita->save();
        return $cita;
    }

    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'Cancelada';
        $cita->save();
        return $cita;
    }

    public function finalizar($id, Request $request)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'Finalizada';
        $cita->observaciones = $request->observaciones;
        $cita->save();
        return $cita;
    }
}