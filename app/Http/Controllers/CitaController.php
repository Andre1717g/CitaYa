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

        $citas = Cita::with(['doctor', 'paciente'])
            ->where('doctor_id', $doctorId)
            ->when($request->paciente_id, fn($q) => $q->where('paciente_id', $request->paciente_id))
            ->get();

        $pacientes = Paciente::whereHas('citas', function ($query) use ($doctorId) {
            $query->where('doctor_id', $doctorId);
        })->get();

        return view('doctor.citas', compact('citas', 'pacientes'));
    }

    public function historial()
    {
        $doctorId = auth('doctor')->user()->id;

        $citasFinalizadas = Cita::with(['doctor', 'paciente'])
            ->where('doctor_id', $doctorId)
            ->where('estado', 'Finalizada')
            ->get();

        return view('doctor.historial', compact('citasFinalizadas'));
    }

    public function store(Request $request)
    {
        if (auth('paciente')->check()) {
            $request->validate([
                'fecha' => 'required|date',
                'hora' => 'required',
                'doctor_id' => 'required|exists:doctor,id',
                'mensaje' => 'nullable|string',
            ]);

            Cita::create([
                'paciente_id' => auth('paciente')->id(),
                'doctor_id' => $request->doctor_id,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'motivo' => $request->mensaje,
                'estado' => 'Pendiente',
            ]);

            return redirect()->route('paciente.citas')->with('success', 'Cita agendada correctamente.');
        }

        if (auth('doctor')->check()) {
            $request->validate([
                'paciente_id' => 'required|exists:paciente,id',
                'fecha' => 'required|date',
                'hora' => 'required',
                'motivo' => 'nullable|string'
            ]);

            Cita::create([
                'doctor_id' => auth('doctor')->id(),
                'paciente_id' => $request->paciente_id,
                'fecha' => $request->fecha,
                'hora' => $request->hora,
                'motivo' => $request->motivo,
                'estado' => 'Pendiente'
            ]);

            return redirect()->route('doctor.citas')->with('success', 'Cita creada exitosamente.');
        }

        return back()->with('error', 'No autorizado.');
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
        $cita->estado = 'Pendiente';
        $cita->save();

        return redirect()->route('doctor.citas')->with('success', 'Cita reprogramada correctamente.');
    }

    public function indexPaciente()
    {
        $pacienteId = auth('paciente')->id();

        $citas = Cita::with('doctor')
            ->where('paciente_id', $pacienteId)
            ->orderBy('fecha', 'asc')
            ->get();

        return view('paciente.citas', compact('citas'));
    }
}
