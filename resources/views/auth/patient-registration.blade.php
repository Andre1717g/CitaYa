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
                    <form class="needs-validation" novalidate>
                        <!-- Sección 1: Información Básica -->
                        <h5 class="mb-4 text-primary fw-bold">
                            <i class="fas fa-user-circle me-2"></i>Datos Personales
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="patientFirstName" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="patientFirstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="patientLastName" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="patientLastName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="patientBirthDate" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="patientBirthDate" required>
                            </div>
                            <div class="col-md-6">
                                <label for="patientGender" class="form-label">Género</label>
                                <select class="form-select" id="patientGender" required>
                                    <option value="" selected disabled>Seleccione...</option>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                    <option>Otro</option>
                                    <option>Prefiero no decir</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="patientPhoto" class="form-label">Foto de Rostro</label>
                                <input class="form-control" type="file" id="patientPhoto" accept="image/*">
                                <div class="form-text">Suba una foto clara de su rostro</div>
                            </div>
                        </div>

                        <!-- Sección 2: Contacto -->
                        <h5 class="mb-4 mt-5 text-primary fw-bold">
                            <i class="fas fa-address-book me-2"></i>Información de Contacto
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="patientEmail" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="patientEmail" required>
                            </div>
                            <div class="col-md-6">
                                <label for="patientPhone" class="form-label">Teléfono/Celular</label>
                                <input type="tel" class="form-control" id="patientPhone" required>
                            </div>
                            <div class="col-12">
                                <label for="patientAddress" class="form-label">Dirección Completa</label>
                                <textarea class="form-control" id="patientAddress" rows="2" required></textarea>
                            </div>
                        </div>

                        <!-- Sección 3: Seguridad -->
                        <h5 class="mb-4 mt-5 text-primary fw-bold">
                            <i class="fas fa-shield-alt me-2"></i>Seguridad
                        </h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="patientPassword" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="patientPassword" required minlength="8">
                                <div class="form-text">Mínimo 8 caracteres</div>
                            </div>
                            <div class="col-md-6">
                                <label for="patientConfirmPassword" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="patientConfirmPassword" required>
                            </div>
                        </div>

                        <!-- Términos y condiciones -->
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" id="patientTerms" required>
                            <label class="form-check-label" for="patientTerms">
                                Acepto los <a href="#" class="text-primary">términos y condiciones</a>
                            </label>
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
</style>
@endsection