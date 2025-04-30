@extends('layouts.app')

@section('title', 'Detalles del Médico')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Detalles del Médico</h2>

    <div class="row">
        <!-- Foto y datos del médico -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    @if($doctor->foto_rostro)
                        <img src="{{ $doctor->foto_rostro }}" class="img-fluid rounded-circle" alt="Foto del doctor" style="max-width: 200px;">
                    @else
                        <div class="bg-light text-center p-5 rounded-circle">
                            <i class="fas fa-user-md fa-5x text-muted"></i>
                        </div>
                    @endif
                    <h4 class="mt-3">{{ $doctor->nombres }} {{ $doctor->apellidos }}</h4>
                    <p class="text-muted">{{ $doctor->area_salud }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Información del Médico</h5>
                    <p><strong>Especialidad:</strong> {{ $doctor->descripcion_especialidad }}</p>
                    <p><strong>Área de Salud:</strong> {{ $doctor->area_salud }}</p>
                    <p><strong>Dirección Consultorio:</strong> {{ $doctor->direccion_consultorio }}</p>
                    <p><strong>Enlace Google Maps:</strong> <a href="{{ $doctor->enlace_google_maps }}" target="_blank" class="text-primary">Ver ubicación</a></p>
                </div>
            </div>

            <div class="mt-4">
                <h5 class="mb-3">Horarios de Atención</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Día</th>
                                <th>Horario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($horarios as $horario)
                                <tr>
                                    <td>{{ ucfirst($horario->dia_semana) }}</td> 
                                    <td>
                                    {{ \Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A') }} - 
                                    {{ \Carbon\Carbon::parse($horario->hora_fin)->format('h:i A') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <!-- Botón para agendar cita (solo si el usuario está autenticado) -->
                @auth
                    <a href="{{ route('cita.agendar', ['doctor_id' => $doctor->id]) }}" class="btn btn-success btn-lg px-4 py-2 shadow-sm">Agendar Cita</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-4 py-2 shadow-sm">Iniciar sesión para agendar cita</a>
                @endauth

                <a href="{{ url('/medicos') }}" class="btn btn-secondary btn-lg px-4 py-2 shadow-sm">Volver a la lista de médicos</a>
            </div>
        </div>
    </div>
</div>
@endsection
