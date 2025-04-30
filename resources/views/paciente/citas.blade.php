@extends('layouts.app')

@section('title', 'Mis Citas')

@section('navbar')
    @include('partials.navbar-paciente')
@endsection

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-primary">Mis Citas</h2>

    @if($citas->isEmpty())
        <p class="text-center text-muted">No tienes citas programadas.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped shadow-lg rounded">
                <thead class="thead-light bg-primary text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Doctor</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</td>
                            <td>{{ $cita->doctor->nombres }} {{ $cita->doctor->apellidos }}</td>
                            <td>
                                <span class="badge
                                    @if($cita->estado == 'Pendiente')
                                        badge-warning
                                    @elseif($cita->estado == 'Confirmada')
                                        badge-success
                                    @else
                                        badge-danger
                                    @endif
                                    text-dark">
                                    {{ $cita->estado }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

@section('styles')
    <style>
        /* Estilo para la tabla */
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        /* Asegura que la tabla sea desplazable en pantallas pequeñas */
        .table-responsive {
            max-width: 100%;
            overflow-x: auto;
        }

        /* Bordes y color de las celdas */
        .table-bordered {
            border: 1px solid #dee2e6;
        }

        /* Efecto hover para las filas */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Fondo alterno para las filas */
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        /* Estilo para los badges de estado */
        .badge {
            font-size: 1rem;
            padding: 0.5em 1em;
            text-transform: capitalize;
        }

        /* Sombra y bordes redondeados para la tabla */
        .shadow-lg {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .rounded {
            border-radius: 0.5rem;
        }

        /* Estilo del encabezado de la tabla */
        .thead-light {
            background-color: #007bff;
        }

        /* Títulos y textos */
        h2 {
            font-family: 'Arial', sans-serif;
            font-weight: 700;
        }

        .table td, .table th {
            padding: 15px;
        }

        .text-muted {
            font-size: 1.1rem;
        }
    </style>
@endsection
