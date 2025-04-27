<!-- resources/views/partials/sidebar.blade.php -->
<nav class="col-md-2 d-none d-md-block bg-light sidebar vh-100">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link active fw-bold" aria-current="page" href="{{ url('/doctor/dashboard') }}">
                    <i class="fas fa-home me-2"></i> Inicio
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="#">
                    <i class="fas fa-calendar-check me-2"></i> Mis Citas
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ url('/doctor/perfil') }}">
                    <i class="fas fa-user-md me-2"></i> Perfil
                </a>
            </li>
            <li class="nav-item mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
