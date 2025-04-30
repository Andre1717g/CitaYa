@extends('layouts.app')

@section('title', 'Mis Citas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-primary">Mis Citas</h1>
            </div>

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Listado de citas</h5>
                    <button class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalNuevaCita">
                        <i class="fas fa-plus me-2"></i> Nueva Cita
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th>Creado hace</th> 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                            <tbody>
                                @forelse($citas as $cita)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cita->paciente->nombres ?? 'N/A' }} {{ $cita->paciente->apellidos ?? '' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</td>
                                        <td>{{ $cita->motivo ?? 'N/A' }}</td>
                                        <td>
                                            @switch($cita->estado)
                                                @case('Confirmada') <span class="badge bg-success">Confirmada</span> @break
                                                @case('Pendiente') <span class="badge bg-warning text-dark">Pendiente</span> @break
                                                @case('Cancelada') <span class="badge bg-danger">Cancelada</span> @break
                                                @default <span class="badge bg-secondary">{{ $cita->estado }}</span>
                                            @endswitch
                                        </td>
                                        <td>{{ $cita->created_at->diffForHumans() }}</td> 
                                        <td>
    <!-- Botón Ver -->
    <button class="btn btn-sm btn-primary btn-ver-cita" data-bs-toggle="modal" data-bs-target="#modalVerCita" data-cita='@json($cita)'>
        <i class="fas fa-eye"></i> Ver
    </button>

    <!-- Botón Confirmar si está pendiente -->
    @if($cita->estado === 'Pendiente')
        <a href="{{ route('citas.confirmar', $cita->id) }}" class="btn btn-sm btn-success">
            <i class="fas fa-check-circle"></i> Confirmar
        </a>
        <a href="{{ route('citas.cancelar', $cita->id) }}" class="btn btn-sm btn-danger">
            <i class="fas fa-times-circle"></i> Cancelar
        </a>
    @endif

    <!-- Botón Finalizar si está confirmada -->
    @if($cita->estado === 'Confirmada')
        <a href="{{ route('citas.finalizar', $cita->id) }}" class="btn btn-sm btn-info">
            <i class="fas fa-clipboard-check"></i> Finalizar
        </a>
    @endif

    <!-- Botón Reprogramar si NO está finalizada -->
    @if($cita->estado !== 'Finalizada')
        <button class="btn btn-sm btn-warning btn-reprogramar-cita" data-bs-toggle="modal" data-bs-target="#modalReprogramarCita" data-id="{{ $cita->id }}" data-fecha="{{ $cita->fecha }}" data-hora="{{ $cita->hora }}">
            <i class="fas fa-sync-alt"></i> Reprogramar
        </button>
    @endif
</td>

                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center">No hay citas disponibles.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Modal para nueva cita -->
            <div class="modal fade" id="modalNuevaCita" tabindex="-1" aria-labelledby="modalNuevaCitaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('citas.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalNuevaCitaLabel">Crear Nueva Cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                        <label for="paciente_id" class="form-label">Paciente</label>
                        <select name="paciente_id" id="paciente_id" class="form-select" required>
                            <option value="">Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}">{{ $paciente->nombres }} {{ $paciente->apellidos }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" name="hora" id="hora" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                        <label for="motivo" class="form-label">Motivo</label>
                        <textarea name="motivo" id="motivo" rows="3" class="form-control" required></textarea>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cita</button>
                    </div>
                </div>
                </form>
            </div>
            </div>

            <!-- Modal VER CITA -->
            <div class="modal fade" id="modalVerCita" tabindex="-1" aria-labelledby="modalVerCitaLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalVerCitaLabel">Detalles de la Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Paciente:</strong> <span id="verPaciente"></span></p>
                        <p><strong>Fecha:</strong> <span id="verFecha"></span></p>
                        <p><strong>Hora:</strong> <span id="verHora"></span></p>
                        <p><strong>Motivo:</strong> <span id="verMotivo"></span></p>
                        <p><strong>Estado:</strong> <span id="verEstado"></span></p>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal REPROGRAMAR CITA -->
            <div class="modal fade" id="modalReprogramarCita" tabindex="-1" aria-labelledby="modalReprogramarLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="formReprogramar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalReprogramarLabel">Reprogramar Cita</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                            <label for="nueva_fecha" class="form-label">Nueva Fecha</label>
                            <input type="date" class="form-control" name="fecha" id="nueva_fecha" required>
                        </div>
                        <div class="mb-3">
                            <label for="nueva_hora" class="form-label">Nueva Hora</label>
                            <input type="time" class="form-control" name="hora" id="nueva_hora" required>
                        </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

             </main>
         </div>
     </div>

<script>
// Ver Cita
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-ver-cita').forEach(button => {
        button.addEventListener('click', function () {
            const cita = JSON.parse(this.getAttribute('data-cita'));

            document.getElementById('verPaciente').textContent = cita.paciente?.nombres + ' ' + cita.paciente?.apellidos;
            document.getElementById('verFecha').textContent = cita.fecha;
            document.getElementById('verHora').textContent = cita.hora;
            document.getElementById('verMotivo').textContent = cita.motivo;
            document.getElementById('verEstado').textContent = cita.estado;
        });
    });
});

// Reprogramar Cita 
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-reprogramar-cita').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const fecha = this.getAttribute('data-fecha');
            const hora = this.getAttribute('data-hora');

            document.getElementById('nueva_fecha').value = fecha;
            document.getElementById('nueva_hora').value = hora;
            document.getElementById('formReprogramar').action = `/citas/${id}/reprogramar`;
        });
    });
});
</script>


<style>
    .card {
        background-color: #ffffff;
        border: none;
    }
    .card-header {
        font-size: 1.25rem;
    }
    .table-hover tbody tr:hover {
        background-color: #f0f2f5;
    }
</style>
@endsection
