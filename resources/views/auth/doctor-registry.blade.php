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

                    <form method="POST" action="{{ route('doctor.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row g-3">
                            <!-- Nombres -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                           id="nombres" name="nombres" 
                                           value="{{ old('nombres') }}" 
                                           placeholder="Nombres" required>
                                    <label for="nombres">Nombres</label>
                                    @error('nombres')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Apellidos -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                           id="apellidos" name="apellidos" 
                                           value="{{ old('apellidos') }}" 
                                           placeholder="Apellidos" required>
                                    <label for="apellidos">Apellidos</label>
                                    @error('apellidos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Área de Salud -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('area_salud') is-invalid @enderror" 
                                            id="area_salud" name="area_salud" required>
                                        <option value="" selected disabled>Seleccione una opción</option>
                                        <option value="Medicina General" {{ old('area_salud') == 'Medicina General' ? 'selected' : '' }}>Medicina General</option>
                                        <option value="Cardiología" {{ old('area_salud') == 'Cardiología' ? 'selected' : '' }}>Cardiología</option>
                                        <option value="Dermatología" {{ old('area_salud') == 'Dermatología' ? 'selected' : '' }}>Dermatología</option>
                                        <option value="Ginecología" {{ old('area_salud') == 'Ginecología' ? 'selected' : '' }}>Ginecología</option>
                                        <option value="Pediatría" {{ old('area_salud') == 'Pediatría' ? 'selected' : '' }}>Pediatría</option>
                                        <option value="Psiquiatría" {{ old('area_salud') == 'Psiquiatría' ? 'selected' : '' }}>Psiquiatría</option>
                                        <option value="Oftalmología" {{ old('area_salud') == 'Oftalmología' ? 'selected' : '' }}>Oftalmología</option>
                                        <option value="Neurología" {{ old('area_salud') == 'Neurología' ? 'selected' : '' }}>Neurología</option>
                                        <option value="Otro" {{ old('area_salud') == 'Otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    <label for="area_salud">Área de Salud</label>
                                    @error('area_salud')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Descripción de la Especialidad -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control @error('descripcion_especialidad') is-invalid @enderror" 
                                              id="descripcion_especialidad" name="descripcion_especialidad" 
                                              placeholder="Descripción de su especialidad" 
                                              style="height: 100px" required>{{ old('descripcion_especialidad') }}</textarea>
                                    <label for="descripcion_especialidad">Descripción de su especialidad</label>
                                    @error('descripcion_especialidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Describa su formación, experiencia y enfoque en esta especialidad.</small>
                                </div>
                            </div>
                            
                            <!-- Ubicación Consultorio -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('ubicacion_consultorio') is-invalid @enderror" 
                                           id="ubicacion_consultorio" name="ubicacion_consultorio" 
                                           value="{{ old('ubicacion_consultorio') }}"
                                           placeholder="Dirección física del consultorio" required>
                                    <label for="ubicacion_consultorio">Dirección física del consultorio</label>
                                    @error('ubicacion_consultorio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Enlace Google Maps -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="url" class="form-control @error('google_maps') is-invalid @enderror" 
                                           id="google_maps" name="google_maps" 
                                           value="{{ old('google_maps') }}"
                                           placeholder="Enlace de Google Maps" required>
                                    <label for="google_maps">Enlace de Google Maps</label>
                                    @error('google_maps')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Copie y pegue el enlace de Google Maps de la ubicación de su consultorio.</small>
                                </div>
                            </div>
                            
                            <!-- Correo Electrónico -->
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" 
                                           value="{{ old('email') }}" 
                                           placeholder="Correo Electrónico" required>
                                    <label for="email">Correo Electrónico</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Contraseña -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                           id="password" name="password" 
                                           placeholder="Contraseña" required>
                                    <label for="password">Contraseña</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Confirmar Contraseña -->
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                                           id="password_confirmation" name="password_confirmation" 
                                           placeholder="Confirmar Contraseña" required>
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <!-- Foto de Rostro -->
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label for="foto_rostro" class="form-label fw-bold">Foto de Rostro</label>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control @error('foto_rostro') is-invalid @enderror" 
                                               id="foto_rostro" name="foto_rostro" 
                                               accept="image/*" required>
                                        <label class="input-group-text" for="foto_rostro">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                    </div>
                                    @error('foto_rostro')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="previsualizacion" class="text-center mt-3 d-none">
                                        <img src="" alt="Vista previa" id="preview-image" class="img-thumbnail rounded-circle" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Términos y Condiciones -->
                            <div class="col-12">
                                <div class="form-check mb-4">
                                    <input class="form-check-input @error('terms') is-invalid @enderror" 
                                           type="checkbox" id="terms" name="terms" 
                                           required {{ old('terms') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="terms">
                                        Acepto los <a href="#" target="_blank">Términos y Condiciones</a> y la <a href="#" target="_blank">Política de Privacidad</a>
                                    </label>
                                    @error('terms')
                                        <div class="invalid-feedback">Debe aceptar los términos y condiciones</div>
                                    @enderror
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