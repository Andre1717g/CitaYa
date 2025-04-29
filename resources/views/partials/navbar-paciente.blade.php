<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="http://127.0.0.1:8000/paciente/inicio">
            <img src="{{ asset('images/Cita bl.png') }}" alt="CitaYa" style="height:100px;width:auto;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <!-- Inicio -->
                <li class="nav-item mx-2"><a class="nav-link text-white" href="http://127.0.0.1:8000/paciente/inicio">Inicio</a></li>


                <!-- Médicos -->
                <li class="nav-item mx-2"><a class="nav-link text-white" href="#">Médicos</a></li>

                <!-- Citas -->
                <li class="nav-item mx-2"><a class="nav-link text-white" href="#">Citas</a></li>

                <!-- Perfil -->
                <li class="nav-item mx-2">
                    <a class="nav-link text-white" href="{{ route('paciente.perfil') }}">Perfil</a>
                </li>


                <!-- Cerrar sesión -->
                <li class="nav-item mx-2">
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="nav-link text-white bg-transparent border-0 p-0">
                            Cerrar sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Mantener todos los items perfectamente alineados en la misma línea */
.navbar-nav .nav-link {
    line-height: 1.4rem;          /* altura igual para todos */
    display: flex;
    align-items: center;
}

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
