<?php

namespace App\Http\Controllers;

use App\Models\HorarioDoctor;
use Illuminate\Http\Request;

class HorarioDoctorController extends Controller
{
    public function index($doctor_id)
    {
        return HorarioDoctor::where('doctor_id', $doctor_id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctor,id',
            'dia_semana' => 'required|string',
            'hora_inicio' => 'required',
            'hora_fin' => 'required'
        ]);

        return HorarioDoctor::create($request->all());
    }
}