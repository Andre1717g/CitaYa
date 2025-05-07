@extends('layouts.app')

@section('title', 'Detalles del Médico')

@section('navbar')
    @include('partials.navbar-paciente')
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
                    <p><strong>Enlace Google Maps:</strong> 
                        <a href="{{ $doctor->enlace_google_maps }}" target="_blank" class="text-primary">Ver ubicación</a>
                    </p>
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
                @auth
                    <!-- Botón para abrir el modal -->
                    <button class="btn btn-success btn-lg px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#agendarCitaModal">
                        Agendar Cita
                    </button>
                @else
                    <!-- Si el usuario no está autenticado, puedes mostrar un mensaje o botón para iniciar sesión. -->
                @endauth

                <a href="{{ url('/paciente/medico') }}" class="btn btn-secondary btn-lg px-4 py-2 shadow-sm">
                    Volver a la lista de médicos
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agendar cita -->
<div class="modal fade" id="agendarCitaModal" tabindex="-1" aria-labelledby="agendarCitaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agendarCitaModalLabel">Agendar Cita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('citas.store') }}" method="POST">
          @csrf
          <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
          <!-- Campo de selección de fecha -->
          <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de Cita</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
          </div>
          
          <!-- Campo de selección de hora -->
          <div class="mb-3">
            <label for="hora" class="form-label">Hora de Cita</label>
            <select class="form-control" id="hora" name="hora" required>
              @foreach($horarios as $horario)
                @php
                    $start_time = \Carbon\Carbon::parse($horario->hora_inicio);
                    $end_time = \Carbon\Carbon::parse($horario->hora_fin);
                    $interval = $start_time->copy();
                @endphp
                @while($interval->lt($end_time))
                    <option value="{{ $interval->format('H:i') }}">
                        {{ $interval->format('h:i A') }}
                    </option>
                    @php
                        $interval->addMinutes(30); // Esto asume un intervalo de 30 minutos entre citas
                    @endphp
                @endwhile
              @endforeach
            </select>
          </div>
          
          <!-- Campo de mensaje adicional -->
          <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje Adicional</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="3"></textarea>
          </div>

          <!-- Botón de submit -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success">Agendar Cita</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection 