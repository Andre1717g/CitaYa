<!-- resources/views/partials/sidebar.blade.php -->
<nav class="col-md-2 d-none d-md-block sidebar vh-100 bg-white border-end shadow-sm">
    <div class="position-sticky pt-4">
        <ul class="nav flex-column px-3">
            <!-- Citas -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center fw-semibold @if(request()->is('doctor/citas')) active-link @endif" href="{{ url('/doctor/citas') }}">
                    <i class="fas fa-calendar-check me-3"></i> Citas
                </a>
            </li>

            <!-- Perfil -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center fw-semibold @if(request()->is('doctor/perfil')) active-link @endif" href="{{ url('/doctor/perfil') }}">
                    <i class="fas fa-user-md me-3"></i> Perfil
                </a>
            </li>

            <!-- Horario -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center fw-semibold @if(request()->is('doctor/horario')) active-link @endif" href="{{ url('/doctor/horario') }}">
                    <i class="fas fa-clock me-3"></i> Horario
                </a>
            </li>

            <!-- Historial -->
            <li class="nav-item mb-3">
                <a class="nav-link d-flex align-items-center fw-semibold @if(request()->is('doctor/historial')) active-link @endif" href="{{ url('/doctor/historial') }}">
                    <i class="fas fa-history me-3"></i> Historial
                </a>
            </li>

            <!-- Cerrar Sesión -->
            <li class="nav-item mt-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<style>
    .sidebar {
        background: #ffffff;
    }

    .nav-link {
        color: #6c757d;
        padding: 10px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .nav-link:hover {
        background-color: #f0f2f5;
        color: #0d6efd;
        text-decoration: none;
    }

    .active-link {
        background-color: #e9f0ff;
        color: #0d6efd !important;
        border-left: 4px solid #0d6efd;
        font-weight: bold;
    }

    .btn-outline-danger {
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
</style>
