@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-primary">Editar Mi Perfil</h1>
                <a href="{{ url('/doctor/perfil') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver al Perfil
                </a>
            </div>

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Actualizar Información</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/doctor/perfil/actualizar') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $doctor->nombres }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $doctor->apellidos }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion_especialidad" class="form-label">Especialidad</label>
                            <input type="text" class="form-control" id="descripcion_especialidad" name="descripcion_especialidad" value="{{ $doctor->descripcion_especialidad }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="area_salud" class="form-label">Área de Salud</label>
                            <input type="text" class="form-control" id="area_salud" name="area_salud" value="{{ $doctor->area_salud }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="direccion_consultorio" class="form-label">Dirección Consultorio</label>
                            <input type="text" class="form-control" id="direccion_consultorio" name="direccion_consultorio" value="{{ $doctor->direccion_consultorio }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="enlace_google_maps" class="form-label">Enlace Google Maps</label>
                            <input type="url" class="form-control" id="enlace_google_maps" name="enlace_google_maps" value="{{ $doctor->enlace_google_maps }}">
                        </div>

                        <div class="mb-3">
                            <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="{{ $doctor->correo_electronico }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="foto_rostro" class="form-label">Foto de Perfil</label>
                            <input type="file" class="form-control" id="foto_rostro" name="foto_rostro">
                            <small class="text-muted">*Solo si deseas actualizar tu foto.</small>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Guardar Cambios
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
