@extends('layouts.app')

@section('title', 'Historial de Citas Finalizadas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Contenido principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-primary">Historial de Citas Finalizadas</h1>
            </div>

            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Listado de Citas Finalizadas</h5>
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
                                <th>Creado hace</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($citasFinalizadas as $cita)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cita->paciente->nombres ?? 'N/A' }} {{ $cita->paciente->apellidos ?? '' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</td>
                                    <td>{{ $cita->motivo ?? 'N/A' }}</td>
                                    <td><span class="badge bg-success">Finalizada</span></td>
                                    <td>{{ $cita->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="text-center">No hay citas finalizadas.</td></tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
