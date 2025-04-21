@extends('layouts.app')

@section('title', 'Registro de Doctor')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-lg">
                <div class="card-header bg-success bg-opacity-10 py-3 border-0">
                    <h2 class="text-center fw-bold text-success mb-0">
                        <i class="fas fa-user-md me-2"></i>Registro de Doctor
                    </h2>
                </div>
                <div class="card-body p-4 p-md-5">
                    <p class="text-muted text-center mb-4">Complete los siguientes datos para registrarse como doctor en nuestra plataforma</p>

                    <form method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Nombres -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" 
                                           id="nombres" name="nombres" placeholder="Nombres" required>
                                    <label for="nombres">Nombres</label>
                                </div>
                            </div>
                            
                            <!-- Apellidos -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" 
                                           id="apellidos" name="apellidos" placeholder="Apellidos" required>
                                    <label for="apellidos">Apellidos</label>
                                </div>
                            </div>
                            
                            <!-- Área de Salud -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" 
                                            id="area_salud" name="area_salud" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="medicina_general">Medicina General</option>
                                        <option value="cardiologia">Cardiología</option>
                                        <option value="dermatologia">Dermatología</option>
                                        <option value="ginecologia">Ginecología</option>
                                        <option value="pediatria">Pediatría</option>
                                        <option value="psiquiatria">Psiquiatría</option>
                                        <option value="oftalmologia">Oftalmología</option>
                                        <option value="neurologia">Neurología</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                    <label for="area_salud">Área de Salud</label>
                                </div>
                            </div>
                            
                            <!-- Descripción de la Especialidad -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" 
                                              id="descripcion_especialidad" name="descripcion_especialidad" 
                                              placeholder="Descripción de su especialidad" 
                                              style="height: 100px" required></textarea>
                                    <label for="descripcion_especialidad">Descripción de su especialidad</label>
                                    <small class="text-muted">Describa su formación, experiencia y enfoque en esta especialidad.</small>
                                </div>
                            </div>
                            
                            <!-- Ubicación Consultorio -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" 
                                           id="ubicacion_consultorio" name="ubicacion_consultorio" 
                                           placeholder="Dirección física del consultorio" required>
                                    <label for="ubicacion_consultorio">Dirección física del consultorio</label>
                                </div>
                            </div>
                            
                            <!-- Enlace Google Maps -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="url" class="form-control" 
                                           id="google_maps" name="google_maps" 
                                           placeholder="Enlace de Google Maps" required>
                                    <label for="google_maps">Enlace de Google Maps</label>
                                    <small class="text-muted">Copie y pegue el enlace de Google Maps de la ubicación de su consultorio.</small>
                                </div>
                            </div>
                            
                            <!-- Correo Electrónico -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" 
                                           id="email" name="email" placeholder="Correo Electrónico" required>
                                    <label for="email">Correo Electrónico</label>
                                </div>
                            </div>
                            
                            <!-- Contraseña -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" 
                                           id="password" name="password" placeholder="Contraseña" required>
                                    <label for="password">Contraseña</label>
                                </div>
                            </div>
                            
                            <!-- Confirmar Contraseña -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" 
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="Confirmar Contraseña" required>
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                </div>
                            </div>
                            
                            <!-- Foto de Rostro -->
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="foto_rostro" class="form-label fw-bold">Foto de Rostro</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" 
                                               id="foto_rostro" name="foto_rostro" accept="image/*" required>
                                        <label class="input-group-text" for="foto_rostro">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    <div id="previsualizacion" class="text-center mt-3 d-none">
                                        <img src="" alt="Vista previa" id="preview-image" class="img-thumbnail rounded-circle" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Términos y Condiciones -->
                            <div class="col-12">
                                <div class="form-check mb-4">
                                    <input class="form-check-input" 
                                           type="checkbox" id="terms" name="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Acepto los <a href="#" target="_blank">Términos y Condiciones</a> y la <a href="#" target="_blank">Política de Privacidad</a>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Botón de Registro -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill">
                                    Registrarme como Doctor <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-transparent text-center py-3">
                    <p class="mb-0">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-success fw-bold">Iniciar Sesión</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fotoInput = document.getElementById('foto_rostro');
        const previewContainer = document.getElementById('previsualizacion');
        const previewImage = document.getElementById('preview-image');
        
        fotoInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewContainer.classList.add('d-none');
            }
        });
    });
</script>
@endpush
@endsection