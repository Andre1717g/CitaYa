@extends('layouts.app')

@section('title', 'Perfil del Paciente')

@section('navbar')
    @include('partials.navbar-paciente')
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
       

        <!-- Contenido principal -->
        <main class="col-12 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-primary">Mi Perfil</h1>
                <a href="{{ url('/paciente/perfil/editar') }}" class="btn btn-outline-primary">
                    <i class="fas fa-edit me-2"></i> Actualizar Información
                </a>
            </div>

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Información del Paciente</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-8">
                            <p><strong>Nombre:</strong> {{ $paciente->nombres }} {{ $paciente->apellidos }}</p>
                            <p><strong>Fecha de Nacimiento:</strong> {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->format('d/m/Y') }}</p>
                            <p><strong>Edad:</strong> {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }} años</p>
                            <p><strong>Género:</strong> {{ $paciente->genero }}</p>
                            <p><strong>Email:</strong> {{ $paciente->correo_electronico }}</p>
                            <p><strong>Teléfono:</strong> {{ $paciente->telefono ?? 'No proporcionado' }}</p>
                            <p><strong>Dirección:</strong> {{ $paciente->direccion ?? 'No proporcionada' }}</p>
                        </div>
                        <div class="col-md-4 text-center">
                            @if($paciente->foto_rostro)
                                <img src="data:image/jpeg;base64,{{ $paciente->foto_rostro }}" alt="Foto de perfil" 
                                     class="rounded-circle mx-auto d-block bg-white p-2 shadow-sm"
                                     style="width: 180px; height: 180px; object-fit: cover;">
                            @else
                                <img src="{{ asset('images/avatarpaciente.png') }}" alt="Avatar predeterminado" 
                                     class="rounded-circle mx-auto d-block bg-light p-2 shadow-sm"
                                     style="width: 180px; height: 180px; object-fit: cover;">
                            @endif
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
