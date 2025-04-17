@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section - Portada principal -->
<div class="hero-section bg-primary text-white py-5">

    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-5 fw-bold mb-3">Tu salud en buenas manos</h1>
                <p class="lead mb-4">Encuentra especialistas certificados y agenda citas en minutos.</p>
                <div class="d-flex gap-2">
                    <!-- Asegúrate de que el enlace funcione correctamente -->
                    <a href="#search" class="btn btn-light btn-lg px-4 rounded-pill">Buscar médico</a>
                    <a href="#" class="btn btn-outline-light btn-lg px-4 rounded-pill">Cómo funciona</a>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTemv7eIBG7Wn5-y9uE2hfxcRtRisgpDZNJg&s" alt="Médico" class="img-fluid rounded-4 shadow">
            </div>
        </div>
    </div>
</div>

<!-- Buscador avanzado -->
<section id="search" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body p-4">
                        <h2 class="h4 text-center mb-4 text-primary">Encuentra al médico ideal</h2>
                        <form class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Especialidad</label>
                                <select class="form-select form-select-lg">
                                    <option selected>Todas las especialidades</option>
                                    <option>Cardiología</option>
                                    <option>Pediatría</option>
                                    <option>Dermatología</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Ubicación</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Ciudad o zona">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">Buscar ahora</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Especialidades destacadas -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3">Nuestras especialidades</h2>
            <p class="text-muted lead">Los mejores profesionales en cada área</p>
        </div>
        
        <div class="row g-4">
            @foreach([
                ['icon' => 'fa-heart-pulse', 'title' => 'Cardiología', 'desc' => 'Cuidado cardiovascular'],
                ['icon' => 'fa-baby', 'title' => 'Pediatría', 'desc' => 'Salud infantil'],
                ['icon' => 'fa-lungs', 'title' => 'Neumología', 'desc' => 'Sistema respiratorio'],
                ['icon' => 'fa-brain', 'title' => 'Neurología', 'desc' => 'Sistema nervioso']
            ] as $item)
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 h-100 shadow-sm rounded-3 hover-shadow transition-all">
                    <div class="card-body text-center p-4">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-3 d-inline-block mb-3">
                            <i class="fas {{ $item['icon'] }} fa-2x"></i>
                        </div>
                        <h3 class="h5">{{ $item['title'] }}</h3>
                        <p class="text-muted small">{{ $item['desc'] }}</p>
                        <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">Ver médicos</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Médicos -->
<section class="py-5 bg-dark text-white">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="display-6 fw-bold mb-3">¿Eres profesional de la salud?</h2>
                <p class="lead mb-0">Únete a nuestra plataforma y llega a más pacientes.</p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="#" class="btn btn-light btn-lg rounded-pill px-4">Registrar clínica</a>
            </div>
        </div>
    </div>
</section>
@endsection
