<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use App\Models\Paciente;

class CitaController extends Controller
{
    public function index(Request $request)
    {
        $doctorId = auth('doctor')->user()->id;
    
        // Obtener las citas del doctor actual
        $citas = Cita::with(['doctor', 'paciente'])
            ->where('doctor_id', $doctorId)
            ->when($request->paciente_id, fn($q) => $q->where('paciente_id', $request->paciente_id))
            ->get();
    
        // Obtener solo los pacientes que ya han tenido citas con este doctor
        $pacientes = Paciente::whereHas('citas', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->get();
    
        return view('doctor.citas', compact('citas', 'pacientes'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:paciente,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'motivo' => 'nullable|string'
        ]);
    
        Cita::create([
            'doctor_id' => auth('doctor')->user()->id,
            'paciente_id' => $request->paciente_id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'motivo' => $request->motivo,
            'estado' => 'Pendiente'
        ]);
    
        return redirect()->route('doctor.citas')->with('success', 'Cita creada exitosamente.');
    }
    
    public function confirmar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'Confirmada';
        $cita->save();
    
        return redirect()->route('doctor.citas')->with('success', 'Cita confirmada.');
    }
    
    public function cancelar($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado = 'Cancelada';
        $cita->save();
    
        return redirect()->route('doctor.citas')->with('success', 'Cita cancelada.');
    }
    
    public function finalizar($id)
    {
        $cita = Cita::findOrFail($id);
    
        if ($cita->estado === 'Cancelada') {
            return redirect()->route('doctor.citas')->with('error', 'No se puede finalizar una cita cancelada.');
        }
    
        if ($cita->estado === 'Finalizada') {
            return redirect()->route('doctor.citas')->with('error', 'Esta cita ya fue finalizada.');
        }
    
        $cita->estado = 'Finalizada';
        $cita->save();
    
        return redirect()->route('doctor.citas')->with('success', 'Cita finalizada.');
    }
    
    public function reprogramar($id, Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required'
        ]);
    
        $cita = Cita::findOrFail($id);
    
        if ($cita->estado === 'Finalizada') {
            return redirect()->route('doctor.citas')->with('error', 'No se puede reprogramar una cita finalizada.');
        }
    
        $cita->fecha = $request->fecha;
        $cita->hora = $request->hora;
        $cita->estado = 'Pendiente'; // importante: vuelve a pendiente
        $cita->save();
    
        return redirect()->route('doctor.citas')->with('success', 'Cita reprogramada correctamente.');
    }
    
}