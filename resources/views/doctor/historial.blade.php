@extends('layouts.app')

@section('title', 'Historial de Citas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-primary">Historial de Citas Médicas</h1>
            </div>

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Citas Anteriores</h5> <!-- Ahora está igual que "Mis Citas" -->
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
                                    <th>Especialidad</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Juan Pérez</td>
                                    <td>12/04/2025</td>
                                    <td>10:00 AM</td>
                                    <td>Cardiología</td>
                                    <td><span class="badge bg-success">Completada</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-pencil-alt"></i> Agregar Nota
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Ana Gómez</td>
                                    <td>15/04/2025</td>
                                    <td>03:00 PM</td>
                                    <td>Pediatría</td>
                                    <td><span class="badge bg-danger">Cancelada</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-phone-alt"></i> Contactar Paciente
                                        </a>
                                    </td>
                                </tr>
                                <!-- Más citas -->
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
        background-color: #ffffff;
    }

    .table-hover tbody tr:hover {
        background-color: #f0f2f5;
    }

    .btn-outline-info {
        border-radius: 8px;
        border-color: rgba(0, 123, 255, 0.3);
        color: #007bff;
        transition: all 0.3s ease;
    }

    .btn-outline-info:hover {
        background-color: #e0f7ff;
        color: #0056b3;
        border-color: #007bff;
    }

    .badge.bg-success {
        background-color: #28a745;
    }

    .badge.bg-danger {
        background-color: #dc3545;
    }
</style>
@endsection
