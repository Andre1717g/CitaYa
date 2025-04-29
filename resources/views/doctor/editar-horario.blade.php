@extends('layouts.app')
@section('title', 'Editar Horario de Atención')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')

        <main class="col-md-10 ms-sm-auto px-md-4 py-4">
            <h1 class="h2">Editar Horario de Atención</h1>

            <!-- Mostrar errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario para editar el horario -->
            <form action="{{ route('doctor.horarios.update', $horario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="dia_semana" class="form-label">Día de la Semana</label>
                        <select name="dia_semana" id="dia_semana" class="form-select" required>
                            @foreach (['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'] as $dia)
                                <option value="{{ $dia }}" {{ $horario->dia_semana == $dia ? 'selected' : '' }}>
                                    {{ ucfirst($dia) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="hora_inicio" class="form-label">Hora de Inicio</label>
                        <input type="time" name="hora_inicio" id="hora_inicio" class="form-control"
                               value="{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('H:i') }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="hora_fin" class="form-label">Hora de Fin</label>
                        <input type="time" name="hora_fin" id="hora_fin" class="form-control"
                               value="{{ \Carbon\Carbon::parse($horario->hora_fin)->format('H:i') }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="{{ route('doctor.horario') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </main>
    </div>
</div>
@endsection
