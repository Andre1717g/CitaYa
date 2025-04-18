@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center mb-5">
            <h1 class="display-5 fw-bold text-primary">Regístrate como...</h1>
            <p class="lead text-muted">Selecciona tu tipo de perfil</p>
        </div>

        {{-- Componente Livewire INLINE --}}
        @php
        $selected = null; // Variable para simular estado de Livewire
        @endphp

        <div class="row g-4 justify-content-center">
            {{-- Tarjeta PACIENTE --}}
            <div class="col-md-5" 
                 wire:click="$set('selected', 'patient')" 
                 onclick="this.classList.toggle('border-primary'); document.getElementById('clinic-card').classList.remove('border-primary')">
                <div class="card h-100 border-3 {{ $selected == 'patient' ? 'border-primary shadow-lg' : 'border-transparent' }} transition-all">
                    <div class="card-header bg-primary bg-opacity-10 py-4">
                        <div class="text-center">
                            <i class="fas fa-user-injured fa-3x text-primary mb-3"></i>
                            <h3 class="h2 fw-bold text-primary">Paciente</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Acceso 100% gratuito</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Agenda citas en minutos</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Historial médico digital</li>
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-3">
                        <a href="{{ route('patient.register') }}" class="btn btn-primary btn-lg w-100 rounded-pill">
                            Registrarme <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Tarjeta CLÍNICA --}}
            <div class="col-md-5" 
                 id="clinic-card"
                 wire:click="$set('selected', 'clinic')" 
                 onclick="this.classList.toggle('border-success'); document.querySelector('.col-md-5:first-child').classList.remove('border-primary')">
                <div class="card h-100 border-3 {{ $selected == 'clinic' ? 'border-success shadow-lg' : 'border-transparent' }} transition-all">
                    <div class="card-header bg-success bg-opacity-10 py-4">
                        <div class="text-center">
                            <i class="fas fa-hospital-alt fa-3x text-success mb-3"></i>
                            <h3 class="h2 fw-bold text-success">Clínica</h3>
                            <span class="badge bg-warning text-dark mt-2">Planes profesionales</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Gestión de consultorio</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Citas automatizadas</li>
                            <li class="mb-3"><i class="fas fa-check-circle text-success me-2"></i> Dashboard profesional</li>
                        </ul>
                    </div>
                    <div class="card-footer bg-transparent border-0 py-3">
                        <a href="{{ route('clinics.register') }}" class="btn btn-success btn-lg w-100 rounded-pill">
                            Comenzar <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Simulación de Livewire para el efecto de selección
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.col-md-5');
    cards.forEach(card => {
        card.addEventListener('click', function() {
            cards.forEach(c => c.querySelector('.card').classList.remove('border-primary', 'border-success'));
            const isClinic = this.id === 'clinic-card';
            this.querySelector('.card').classList.add(isClinic ? 'border-success' : 'border-primary');
        });
    });
});
</script>
@endpush

<style>
.transition-all {
    transition: all 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
}
.card {
    border-radius: 1rem !important;
    cursor: pointer;
}
.card-header {
    border-top-left-radius: 1rem !important;
    border-top-right-radius: 1rem !important;
}
.list-unstyled li {
    font-size: 1.05rem;
    padding: 0.5rem 0;
}
</style>
@endsection