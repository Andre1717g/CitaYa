@extends('layouts.app')

@section('title', 'Medicos')

@section('content')
    <!-- Buscador avanzado -->
<section id="search" class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                    <div class="card-body p-4">
                        <h2 class="h4 text-center mb-4 text-primary">Encuentra al médico ideal</h2>
                        <form class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Especialidad</label>
                                <select class="form-select form-select-lg">
                                    <option selected>Todas las especialidades</option>
                                    <option>Cardiología</option>
                                    <option>Pediatría</option>
                                    <option>Dermatología</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted">Ubicación</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Ciudad o zona">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-pill">Buscar ahora</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
