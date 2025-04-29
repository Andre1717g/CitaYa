<!-- resources/views/doctor/horarios.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <h1 class="mb-4 fw-bold">Mi Horario</h1>

            <div class="card shadow-sm rounded-4">
                <div class="card-body">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>Día</th>
                                <th>Hora de Inicio</th>
                                <th>Hora de Fin</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $horario)
                                <tr>
                                    <td>{{ $horario->dia }}</td>
                                    <td>{{ $horario->hora_inicio }}</td>
                                    <td>{{ $horario->hora_fin }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editarHorarioModal" data-horario-id="{{ $horario->id }}" data-dia="{{ $horario->dia }}" data-hora_inicio="{{ $horario->hora_inicio }}" data-hora_fin="{{ $horario->hora_fin }}">
                                            Editar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-end mt-4">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarHorarioModal">
                            <i class="fas fa-plus-circle me-2"></i>Agregar Horario
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal Editar Horario -->
<div class="modal fade" id="editarHorarioModal" tabindex="-1" aria-labelledby="editarHorarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editarHorarioModalLabel">Editar Horario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('doctor.horarios.update', '') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="horarioId">
                    <div class="mb-3">
                        <label for="diaEditar" class="form-label">Día</label>
                        <input type="text" class="form-control" name="dia" id="diaEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="inicioEditar" class="form-label">Hora de Inicio</label>
                        <input type="time" class="form-control" name="hora_inicio" id="inicioEditar" required>
                    </div>
                    <div class="mb-3">
                        <label for="finEditar" class="form-label">Hora de Fin</label>
                        <input type="time" class="form-control" name="hora_fin" id="finEditar" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
