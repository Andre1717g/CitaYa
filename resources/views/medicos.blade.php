@extends('layouts.app')

@section('title', 'Médicos')

@section('navbar')
    @include('partials.navbar')
@endsection

@section('content')
<!-- Buscador simplificado para El Salvador -->
<section id="search" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4">
                        <h2 class="h3 text-center mb-4 text-primary fw-bold">
                            <i class="fas fa-search-plus me-2"></i> Encuentra al médico ideal
                        </h2>
                        
                        <form method="GET" action="{{ route('medicos') }}" class="row g-3">
    <!-- Buscar por nombre o apellido -->
    <div class="col-md-3">
        <label class="form-label small text-muted">Buscar por nombre o apellido</label>
        <input type="text" name="q" class="form-control form-control-lg shadow-sm" 
            placeholder="Ej: Carlos, Mendoza..." value="{{ request('q') }}">
    </div>

    <!-- Filtrar por especialidad -->
    <div class="col-md-3">
        <label class="form-label small text-muted">Especialidad médica</label>
        <select name="especialidad" class="form-select form-select-lg shadow-sm">
            <option value="">Todas las especialidades</option>
            @foreach($especialidades as $especialidad)
                <option value="{{ $especialidad }}" 
                    {{ request('especialidad') == $especialidad ? 'selected' : '' }}>
                    {{ $especialidad }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Buscar por dirección consultorio -->
    <div class="col-md-3">
        <label class="form-label small text-muted">Buscar por dirección del consultorio</label>
        <input type="text" name="direccion" class="form-control form-control-lg shadow-sm" 
            placeholder="Ej: San Salvador, Santa Ana..." value="{{ request('direccion') }}">
    </div>

    <!-- Botón de búsqueda -->
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
            <i class="fas fa-search"></i> Buscar
        </button>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Resultados de búsqueda -->
<section class="py-5">
    <div class="container">
        <div class="row">
            @forelse($doctores as $doctor)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    @if($doctor->foto_rostro)
                        <img src="{{ $doctor->foto_rostro }}" class="card-img-top" alt="Foto del Doctor" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-user-md fa-3x text-muted"></i>
                        </div>
                    @endif
                    <div class="card-body">
                            <h3 class="h5 mb-1">{{ $doctor->nombres }} {{ $doctor->apellidos }}</h3>
                            <p class="text-muted small">{{ $doctor->area_salud }}</p>
                            <div class="mt-2">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                    <span class="small">{{ $doctor->direccion_consultorio }}</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-link text-muted me-2"></i>
                                    <a href="{{ $doctor->enlace_google_maps }}" class="small text-primary" target="_blank">Ubicación</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="#" class="btn btn-outline-primary w-100">Ver Detalle</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No se encontraron médicos.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}
.hover-shadow:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1)!important;
}
.rounded-4 {
    border-radius: 1rem!important;
}
.transition-all {
    transition: all 0.3s ease;
}
</style>


<script>
// Para el filtro de rango de precios
document.addEventListener('DOMContentLoaded', function() {
    const priceRange = document.querySelector('input[type="range"]');
    if(priceRange) {
        priceRange.addEventListener('input', function() {
            // Aquí puedes agregar lógica para mostrar el valor seleccionado
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Datos completos de municipios
    const departamentos = {
        'San Salvador': ['San Salvador', 'Soyapango', 'Apopa', 'Mejicanos', 'Santa Tecla'],
        'Santa Ana': ['Santa Ana', 'Chalchuapa', 'Metapán'],
        // Agrega todos los departamentos...
    };

    // Selección SEGURA por atributo name
    const selectDepto = document.querySelector('select[name="departamento"]');
    const selectMuni = document.querySelector('select[name="municipio"]');

    // Función para cargar municipios
    function cargarMunicipios() {
        // Resetear select
        selectMuni.innerHTML = '';
        
        if (selectDepto.value && selectDepto.value !== 'Todo El Salvador') {
            // Habilitar y cargar municipios
            selectMuni.disabled = false;
            
            // Opción por defecto
            const defaultOption = new Option('Seleccione municipio', '', true);
            defaultOption.disabled = true;
            selectMuni.add(defaultOption);
            
            // Agregar municipios
            departamentos[selectDepto.value].forEach(muni => {
                selectMuni.add(new Option(muni, muni));
            });
        } else {
            // Deshabilitar y mostrar mensaje
            selectMuni.disabled = true;
            selectMuni.add(new Option('Seleccione departamento primero', '', true));
        }
    }

    // Event listeners
    selectDepto.addEventListener('change', cargarMunicipios);
    
    // Inicializar
    cargarMunicipios();
});
</script>
@endsection