@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('navbar')
    @include('partials.navbar-paciente')
@endsection

@section('content')
<div class="container py-4">
    <h1 class="h3 text-center text-primary mb-4">Editar Perfil</h1>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center py-3">
            <h5 class="mb-0">Actualiza tu Información</h5>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('paciente.perfil.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nombres -->
                <div class="mb-3">
                    <label for="nombres" class="form-label text-dark fw-semibold">Nombres</label>
                    <input type="text" name="nombres" id="nombres" class="form-control form-control-sm" value="{{ old('nombres', $paciente->nombres) }}" required>
                </div>

                <!-- Apellidos -->
                <div class="mb-3">
                    <label for="apellidos" class="form-label text-dark fw-semibold">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control form-control-sm" value="{{ old('apellidos', $paciente->apellidos) }}" required>
                </div>

                <!-- Fecha de Nacimiento -->
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label text-dark fw-semibold">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-sm" value="{{ old('fecha_nacimiento', $paciente->fecha_nacimiento->format('Y-m-d')) }}" required>
                </div>

                <!-- Género -->
                <div class="mb-3">
                    <label for="genero" class="form-label text-dark fw-semibold">Género</label>
                    <select name="genero" id="genero" class="form-select form-select-sm" required>
                        <option value="">Seleccione...</option>
                        <option value="Masculino" {{ old('genero', $paciente->genero) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ old('genero', $paciente->genero) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ old('genero', $paciente->genero) == 'Otro' ? 'selected' : '' }}>Otro</option>
                        <option value="Prefiero no decirlo" {{ old('genero', $paciente->genero) == 'Prefiero no decirlo' ? 'selected' : '' }}>Prefiero no decirlo</option>
                    </select>
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="telefono" class="form-label text-dark fw-semibold">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control form-control-sm" value="{{ old('telefono', $paciente->telefono) }}">
                </div>

                <!-- Dirección -->
                <div class="mb-3">
                    <label for="direccion" class="form-label text-dark fw-semibold">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{ old('direccion', $paciente->direccion) }}">
                </div>

                <!-- Foto de Perfil -->
                <div class="mb-3">
                    <label for="foto_rostro" class="form-label text-dark fw-semibold">Foto de Perfil</label>
                    <input type="file" name="foto_rostro" id="foto_rostro" class="form-control form-control-sm">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/paciente/perfil') }}" class="btn btn-outline-secondary btn-sm px-4 py-2">Regresar</a>
                    <button type="submit" class="btn btn-primary btn-sm px-4 py-2">Guardar Cambios</button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    .card {
        background-color: #ffffff;
        border: none;
    }

    .card-header {
        font-size: 1.25rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 10px 10px 0 0;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.9rem;
        font-size: 0.9rem;
    }

    .form-label {
        font-weight: 600;
    }

    .btn {
        border-radius: 25px;
        padding: 0.5rem 1.5rem;
        font-size: 0.9rem;
    }

    .btn-primary {
        background-color: #5cb85c;
        border-color: #5cb85c;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .form-control:focus, .form-select:focus {
        border-color: #5cb85c;
        box-shadow: 0 0 8px rgba(92, 184, 92, 0.5);
    }

    .card-body {
        padding: 1.5rem;
    }

    .alert {
        font-size: 1rem;
    }
</style>

@endsection
