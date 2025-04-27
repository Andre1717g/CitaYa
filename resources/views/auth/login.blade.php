@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
@include('partials.navbar')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <!-- Tarjeta principal -->
            <div class="card border-0 shadow-lg">
                <!-- Encabezado con icono médico -->
                <div class="card-header bg-primary text-white py-4 border-0">
                    <div class="text-center">
                        <i class="fas fa-user-shield fa-3x mb-3"></i>
                        <h2 class="h3 mb-0">Acceso al Sistema</h2>
                    </div>
                </div>

                <!-- Cuerpo del formulario -->
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login.submit') }}">
                        @csrf

                        <!-- Selector de tipo de usuario (añade value) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">¿Cómo deseas ingresar?</label>
                            <div class="btn-group w-100 shadow-sm" role="group">
                                <!-- Opción Paciente -->
                                <input type="radio" class="btn-check" name="user_type" id="patient" value="patient" checked>
                                <label class="btn btn-outline-primary py-3" for="patient">
                                    <i class="fas fa-user-injured me-2"></i> Paciente
                                </label>

                                <!-- Opción Doctor -->
                                <input type="radio" class="btn-check" name="user_type" id="doctor" value="doctor">
                                <label class="btn btn-outline-primary py-3" for="doctor">
                                    <i class="fas fa-user-md me-2"></i> Médico
                                </label>
                            </div>
                        </div>

                        <!-- Email (añade name y manejo de errores) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary bg-opacity-10">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                    value="{{ old('email') }}" placeholder="ejemplo@correo.com" required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contraseña (añade name) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary bg-opacity-10">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                    placeholder="••••••••" required>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Botón de acción (cambia a type="submit") -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                                <i class="fas fa-sign-in-alt me-2"></i> Ingresar
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Pie de tarjeta -->
                <div class="card-footer bg-white text-center py-3 border-0">
                    <p class="mb-0 text-muted">¿No tienes cuenta? 
                        <a href="{{ route('register.type') }}" class="text-primary fw-bold text-decoration-none">
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados -->
<style>
    .btn-group .btn {
        transition: all 0.3s ease;
    }
    .btn-group .btn:hover {
        transform: translateY(-2px);
    }
    .btn-check:checked + .btn {
        background-color: #0d6efd;
        color: white !important;
    }
    .is-invalid {
        border-color: #dc3545;
    }
    .text-danger {
        color: #dc3545;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Maneja el cambio entre paciente/doctor
    const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
    
    userTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Solo para feedback visual (tu diseño ya lo maneja)
            console.log('Tipo de usuario seleccionado:', this.value);
        });
    });

    // Verificar si la página se cargó desde la caché del navegador y recargar
    if (performance.navigation.type === 2) { // Verifica si la página fue cargada desde el cache
        window.location.reload(true); // Recarga la página
    }
});
</script>
@endsection
