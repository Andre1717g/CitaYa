@extends('layouts.app')
@section('title', 'Gestionar Horarios de Atención')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <h1 class="h2">Gestionar Horarios de Atención</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('doctor.horario.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="dia_semana" class="form-label">Día de la Semana</label>
                        <select name="dia_semana" id="dia_semana" class="form-select" required>
                            <option value="lunes">Lunes</option>
                            <option value="martes">Martes</option>
                            <option value="miércoles">Miércoles</option>
                            <option value="jueves">Jueves</option>
                            <option value="viernes">Viernes</option>
                            <option value="sábado">Sábado</option>
                            <option value="domingo">Domingo</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="hora_fin" class="form-label">Hora de Fin</label>
                        <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Horario</button>
            </form>

            <h2 class="mt-5">Horarios de Atención</h2>

            @if($horarios->count() > 0)
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Día de la Semana</th>
                            <th>Hora de Inicio</th>
                            <th>Hora de Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horarios as $horario)
                            <tr>
                                <td>{{ ucfirst($horario->dia_semana) }}</td>
                                <td>{{ $horario->hora_inicio }}</td>
                                <td>{{ $horario->hora_fin }}</td>
                                <td>
                                    <a href="{{ route('doctor.horarios.edit', $horario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('doctor.horarios.destroy', $horario->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No tienes horarios registrados.</p>
            @endif
        </main>
    </div>
</div>
@endsection
