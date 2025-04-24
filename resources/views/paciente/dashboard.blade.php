{{-- ejemplo: resources/views/paciente/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'paciente')

@section('navbar')
    @include('partials.navbar-paciente')
@endsection

@section('content')
    <div class="container">
        <h1>¡Bienvenido al Dashboard del Paciente!</h1>
        <p>Esta es tu página de inicio. Todo está funcionando correctamente.</p>
    </div>
@endsection
