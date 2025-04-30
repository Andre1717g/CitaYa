<!-- Hero Section - Portada principal -->
<div class="hero-section bg-white text-dark py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-5 fw-bold mb-3">Tu salud en buenas manos</h1>
                <p class="lead mb-4">Encuentra especialistas certificados y agenda citas en minutos.</p>
                <div class="d-flex gap-2">
                    
                    <a href="{{ auth()->check() ? route('paciente.ver-medicos') : route('medicos') }}" 
                       class="btn btn-primary btn-lg px-4 rounded-pill">
                       Buscar médico
                    </a>
                    <a href="#how-it-works" class="btn btn-outline-primary btn-lg px-4 rounded-pill">Cómo funciona</a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="{{ asset('images/medicina.svg') }}" alt="Ilustración médica" class="img-fluid" style="max-height: 350px;">
            </div>
        </div>
    </div>
</div>


<!-- Presentación del sistema -->
<section id="about" class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body p-5 text-center">
                        <h2 class="h3 text-primary mb-4">Bienvenido a CitasYa</h2>
                        <p class="lead mb-4">
                            CitaYa es una plataforma diseñada para facilitar la conexión entre pacientes y médicos en El Salvador. Nuestro objetivo es brindarte una forma rápida, segura y organizada de agendar tus citas médicas desde cualquier lugar.
                        </p>
                        <p class="text-muted">
                            Explora distintas especialidades, encuentra médicos cercanos a tu ubicación, y reserva tu consulta en línea sin complicaciones. Simplificamos el proceso para que cuides de tu salud con tan solo unos clics.
                        </p>
                        <a href="{{ route('register.type') }}" class="btn btn-primary btn-lg mt-4 rounded-pill">
                            Empieza ahora
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cómo funciona -->
<section id="how-it-works" class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold text-primary">¿Cómo funciona CitasYa?</h2>
            <p class="lead text-muted">Solo necesitas seguir estos pasos para agendar tu cita médica:</p>
        </div>
        <div class="row g-4 text-center">
            @foreach([
                ['icon' => 'fa-user-plus', 'title' => 'Regístrate', 'desc' => 'Crea una cuenta como paciente o médico.'],
                ['icon' => 'fa-search', 'title' => 'Busca un médico', 'desc' => 'Filtra por especialidad o ubicación.'],
                ['icon' => 'fa-calendar-check', 'title' => 'Agenda tu cita', 'desc' => 'Selecciona día y hora disponible.'],
                ['icon' => 'fa-bell', 'title' => 'Recibe un recordatorio', 'desc' => 'Te enviaremos una notificación antes de tu cita.'],
            ] as $step)
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body">
                        <div class="text-primary mb-3">
                            <i class="fas {{ $step['icon'] }} fa-2x"></i>
                        </div>
                        <h5 class="fw-bold">{{ $step['title'] }}</h5>
                        <p class="text-muted small mb-0">{{ $step['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
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
                        <!-- <a href="#" class="btn btn-sm btn-outline-primary rounded-pill px-3">Ver médicos</a> -->
                        <a href="{{ auth()->check() ? route('paciente.ver-medicos') : route('medicos') }}" 
                            class="btn btn-sm btn-outline-primary rounded-pill px-3">
                            Ver médicos
                        </a>

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
                <a href="{{ route('register.type') }}" class="btn btn-light btn-lg rounded-pill px-4">
                    Registrar clínica
                </a>
            </div>
        </div>
    </div>
</section>
