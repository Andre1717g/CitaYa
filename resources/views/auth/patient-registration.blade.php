@extends('layouts.app')

@section('title', 'Registro de Paciente')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card border-primary shadow-lg">
                <div class="card-header bg-primary text-white py-4">
                    <div class="text-center">
                        <i class="fas fa-user-injured fa-3x mb-3"></i>
                        <h2 class="mb-0">Registro de Paciente</h2>
                        <p class="mb-0 mt-2">Complete su información personal</p>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('patient.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <!-- Mostrar errores generales -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Sección 1: Información Básica -->
                        <h5 class="mb-4 text-primary fw-bold">
                            <i class="fas fa-user-circle me-2"></i>Datos Personales
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                       id="nombres" name="nombres" value="{{ old('nombres') }}" required>
                                @error('nombres')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                       id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                                @error('apellidos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                       id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" required>
                                @error('fecha_nacimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-select @error('genero') is-invalid @enderror" id="genero" name="genero" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option value="Masculino" {{ old('genero') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                                    <option value="Femenino" {{ old('genero') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                                    <option value="Otro" {{ old('genero') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    <option value="Prefiero no decirlo" {{ old('genero') == 'Prefiero no decirlo' ? 'selected' : '' }}>Prefiero no decir</option>
                                </select>
                                @error('genero')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="foto_rostro" class="form-label">Foto de Rostro</label>
                                <input class="form-control @error('foto_rostro') is-invalid @enderror" 
                                       type="file" id="foto_rostro" name="foto_rostro" accept="image/*">
                                <div class="form-text">Suba una foto clara de su rostro (Máx. 2MB)</div>
                                @error('foto_rostro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sección 2: Contacto -->
                        <h5 class="mb-4 mt-5 text-primary fw-bold">
                            <i class="fas fa-address-book me-2"></i>Información de Contacto
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control @error('correo_electronico') is-invalid @enderror" 
                                       id="correo_electronico" name="correo_electronico" value="{{ old('correo_electronico') }}" required>
                                @error('correo_electronico')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono/Celular</label>
                                <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                                       id="telefono" name="telefono" value="{{ old('telefono') }}">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="direccion" class="form-label">Dirección Completa</label>
                                <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                          id="direccion" name="direccion" rows="2">{{ old('direccion') }}</textarea>
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Sección 3: Seguridad -->
                        <h5 class="mb-4 mt-5 text-primary fw-bold">
                            <i class="fas fa-shield-alt me-2"></i>Seguridad
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="contraseña" class="form-label">Contraseña</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required minlength="8">
                                <div class="form-text">Mínimo 8 caracteres</div>
                                @error('contraseña')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="contraseña_confirmation" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <!-- Términos y condiciones -->
                        <div class="form-check mt-4">
                            <input class="form-check-input @error('terms') is-invalid @enderror" 
                                   type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                Acepto los <a href="#" class="text-primary">términos y condiciones</a>
                            </label>
                            @error('terms')
                                <div class="invalid-feedback">Debes aceptar los términos y condiciones</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <button class="btn btn-primary btn-lg py-3 fw-bold" type="submit">
                                <i class="fas fa-user-plus me-2"></i> REGISTRARSE COMO PACIENTE
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-white text-center py-3">
                    <p class="mb-0">¿Ya tienes cuenta? 
                        <a href="{{ route('login') }}" class="text-primary fw-bold">Inicia sesión aquí</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
    }
    .form-section {
        border-left: 4px solid #0d6efd;
        padding-left: 15px;
        margin-bottom: 30px;
    }
    .form-text {
        font-size: 0.85rem;
    }
    .is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
    }
</style>

<!-- Script para validación del formulario -->
<script>
    //Validación del lado del cliente
    (function() {
        'use strict';
        
        // Obtener el formulario
        const form = document.querySelector('.needs-validation');
        
        // Evitar envío si no es válido
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            form.classList.add('was-validated');
        }, false);
    })();
</script>
@endsection