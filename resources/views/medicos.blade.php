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
                        
                        <form class="row g-3">
                            <!-- Especialidad -->
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Especialidad médica</label>
                                <select class="form-select form-select-lg shadow-sm">
                                    <option selected>Especialidades</option>
                                    <option>Cardiología</option>
                                    <option>Pediatría</option>
                                    <option>Dermatología</option>
                                    <option>Ginecología</option>
                                    <option>Medicina General</option>
                                    <option>Ortopedia</option>
                                </select>
                            </div>
                            
                            <!-- Departamento -->
                            <div class="col-md-3">
                                <label class="form-label small text-muted">Departamento</label>
                                <select name="departamento" class="form-select form-select-lg shadow-sm">
                                    <option selected>Todo El Salvador</option>
                                    <option>San Salvador</option>
                                    <option>Santa Ana</option>
                                    <option>San Miguel</option>
                                    <option>La Libertad</option>
                                    <option>Sonsonate</option>
                                    <option>La Paz</option>
                                    <option>Chalatenango</option>
                                    <!-- Agrega todos los departamentos -->
                                </select>
                            </div>
                            
                            <!-- Municipio -->
                            <div class="col-md-5">
                                <label class="form-label small text-muted">Municipio</label>
                                <select name="municipio" class="form-select form-select-lg shadow-sm" disabled>
                                    <option selected>Primero seleccione departamento</option>
                                </select>
                            </div>
                            
                            <!-- Botón de búsqueda -->
                            <div class="col-md-1 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill shadow">
                                    <i class="fas fa-search"></i>
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
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all">
                    <div class="card-img-top bg-light" style="height: 200px; background-image: url('https://images.unsplash.com/photo-1559839734-2b71ea197ec2'); background-size: cover;"></div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="h5 mb-1">Dr. Carlos Mendoza</h3>
                                <span class="text-muted small">Cardiólogo</span>
                            </div>
                            <span class="badge bg-success">Disponible hoy</span>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-map-marker-alt text-muted me-2"></i>
                                <span class="small">Clínica San Felipe, Lima</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-star text-warning me-2"></i>
                                <span class="small">4.8 (120 opiniones)</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-money-bill-wave text-muted me-2"></i>
                                <span class="small">Desde S/120 por consulta</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pt-0">
                        <a href="#" class="btn btn-outline-primary w-100">Ver detalle</a>
                    </div>
                </div>
            </div>
            
            <!-- Más cards de médicos pueden agregarse aquí -->
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