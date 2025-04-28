@extends('layouts.app')

@section('title', 'Mis Citas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-primary">Mis Citas</h1>
            </div>

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Listado de citas</h5>
                    <button class="btn btn-outline-light btn-sm">
                        <i class="fas fa-plus me-2"></i> Nueva Cita
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Paciente</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Motivo</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Juan Pérez</td>
                                    <td>28/04/2025</td>
                                    <td>10:30 AM</td>
                                    <td>Consulta general</td>
                                    <td><span class="badge bg-success">Confirmada</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="#" class="btn btn-sm btn-info">
                                            <i class="fas fa-clipboard-check"></i> Finalizar
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>María López</td>
                                    <td>29/04/2025</td>
                                    <td>02:00 PM</td>
                                    <td>Chequeo anual</td>
                                    <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="#" class="btn btn-sm btn-success">
                                            <i class="fas fa-check-circle"></i> Confirmar
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger">
                                            <i class="fas fa-times-circle"></i> Cancelar
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Carlos Sánchez</td>
                                    <td>30/04/2025</td>
                                    <td>11:00 AM</td>
                                    <td>Chequeo general</td>
                                    <td><span class="badge bg-danger">Cancelada</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Ver
                                        </a>
                                        <a href="#" class="btn btn-sm btn-warning">
                                            <i class="fas fa-sync-alt"></i> Reprogramar
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<style>
    .card {
        background-color: #ffffff;
        border: none;
    }
    .card-header {
        font-size: 1.25rem;
    }
    .table-hover tbody tr:hover {
        background-color: #f0f2f5;
    }
</style>
@endsection
