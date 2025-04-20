<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Logo como imagen -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/cita.png') }}" alt="CitaYa Logo" height="40" class="d-inline-block align-top">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Médicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Citas</a>
                </li>
                <!-- Botón destacado para login de pacientes -->
                <a href="{{ route('login') }}" class="nav-link btn ">
                    <i class="fas fa-sign-in-alt me-1"></i> Ingresar
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register.type') }}">Registrar</a>
                </li>
            </ul>
        </div>
    </div>
</nav>