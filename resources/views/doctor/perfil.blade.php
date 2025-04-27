@extends('layouts.app')

@section('title', 'Perfil del Doctor')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <h1 class="h2">Mi Perfil</h1>
            <p class="lead">Aquí puedes ver y actualizar tus datos personales.</p>

            <div class="card">
                <div class="card-header">
                    Información del Doctor
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $doctor->nombres }} {{ $doctor->apellidos }}</p>
                    <p><strong>Especialidad:</strong> {{ $doctor->descripcion_especialidad }}</p>
                    <p><strong>Consultorio:</strong> {{ $doctor->direccion_consultorio }}</p>
                    <p><strong>Google Maps:</strong> <a href="{{ $doctor->enlace_google_maps }}" target="_blank">Ver Mapa</a></p>
                    <p><strong>Email:</strong> {{ $doctor->correo_electronico }}</p>
                    <p><strong>Foto de Perfil:</strong> <img src="{{ asset('data:image/jpeg;base64,' . $doctor->foto_rostro) }}" alt="Foto de perfil" width="150"></p>
                    <!-- Aquí podrías agregar un formulario para editar los datos si es necesario -->
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
