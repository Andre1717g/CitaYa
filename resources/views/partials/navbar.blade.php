<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/Cita bl.png') }}" alt="CitaYa" style="height:100px; width:auto;">
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item position-relative mx-2">
                    <a class="nav-link text-white {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Inicio
                    </a>
                </li>
                <li class="nav-item position-relative mx-2">
                    <a class="nav-link text-white {{ request()->routeIs('medicos') ? 'active' : '' }}" href="{{ route('medicos') }}">
                        Médicos
                    </a>
                </li>
                <li class="nav-item position-relative mx-2">
                    <a href="{{ route('login') }}" class="nav-link text-white position-relative {{ request()->routeIs('login') ? 'active' : '' }}">
                        <i class="fas fa-sign-in-alt me-1"></i> Ingresar
                    </a>
                </li>
                <li class="nav-item position-relative mx-2">
                    <a class="nav-link text-white {{ request()->routeIs('register.type') ? 'active' : '' }}" href="{{ route('register.type') }}">
                        Registrar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Línea blanca al estar activo */
.nav-item .nav-link.active::after {
    content: '';
    position: absolute;
    left: 15%;
    bottom: 5px;
    width: 70%;
    height: 2px;
    background-color: white;
    transition: all 0.3s ease;
}

/* Línea blanca al hacer hover */
.nav-item .nav-link:hover::after {
    content: '';
    position: absolute;
    left: 15%;
    bottom: 5px;
    width: 70%;
    height: 2px;
    background-color: white;
    transition: all 0.3s ease;
}

/* Ajustes generales */
.navbar {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.nav-link {
    padding: 0.5rem 1rem !important;
    position: relative;
    display: inline-block;
}

.nav-item {
    margin: 0 0.5rem;
}

/* Efecto hover para elevar ligeramente */
.nav-link:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

/* Responsive para línea inferior en pantallas pequeñas */
@media (max-width: 991.98px) {
    .nav-item .nav-link.active::after,
    .nav-item .nav-link:hover::after {
        left: 10%;
        width: 80%;
    }
}
</style>
