<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Aquí puedes incluir tu CSS y otros recursos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('images/Cita bl.png') }}" type="image/x-icon">
</head>
<body>
    @include('partials.navbar') <!-- Si tienes una barra de navegación -->
    @yield('content') <!-- Aquí se insertará el contenido de la vista -->
    <!-- Aquí puedes incluir tu footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>
</html>
