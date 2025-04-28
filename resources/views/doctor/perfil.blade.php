@extends('layouts.app')

@section('title', 'Perfil del Doctor')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-primary">Mi Perfil</h1>
                <a href="{{ url('/doctor/perfil/editar') }}" class="btn btn-outline-primary">
                    <i class="fas fa-edit me-2"></i> Actualizar Información
                </a>
            </div>

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Información del Doctor</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <p><strong>Nombre:</strong> {{ $doctor->nombres }} {{ $doctor->apellidos }}</p>
                            <p><strong>Especialidad:</strong> {{ $doctor->area_salud }}</p>
                            <p><strong>Descripcion:</strong> {{ $doctor->descripcion_especialidad }}</p>
                            <p><strong>Consultorio:</strong> {{ $doctor->direccion_consultorio }}</p>
                            <p><strong>Google Maps:</strong> 
                                <a href="{{ $doctor->enlace_google_maps }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">Ver Mapa</a>
                            </p>
                            <p><strong>Email:</strong> {{ $doctor->correo_electronico }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="{{ asset('data:image/jpeg;base64,' . $doctor->foto_rostro) }}" alt="Foto de perfil" class="img-thumbnail rounded-circle" style="width: 180px; height: 180px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    .card {
        background-color: #ffffff;
        border: none;
    }
    .card-header {
        font-size: 1.25rem;
    }
</style>
@endsection
