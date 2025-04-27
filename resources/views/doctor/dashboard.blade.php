@extends('layouts.app')

@section('title', 'Dashboard Doctor')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar') <!-- Incluir la barra de navegación -->

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <h1 class="h2">Bienvenido al Panel del Doctor</h1>
            <p class="lead">Aquí puedes gestionar tus citas, ver tus pacientes y actualizar tu perfil.</p>
        </main>
    </div>
</div>
@endsection
