<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use Illuminate\Http\Request;

class HistorialMedicoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cita_id' => 'required|exists:cita,id',
            'descripcion' => 'required|string',
            'receta' => 'nullable|string'
        ]);

        return HistorialMedico::create($request->all());
    }

    public function showByPaciente($paciente_id)
    {
        return HistorialMedico::with('cita')
            ->whereHas('cita', function ($q) use ($paciente_id) {
                $q->where('paciente_id', $paciente_id);
            })
            ->get();
    }
}