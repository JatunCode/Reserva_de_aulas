<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'JatunCode')</title>
    <!-- Enlace a los estilos de Bootstrap -->
    <link href="{{ asset('vendor/bootstrap-5.3.3/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Enlace a los css locales-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body class="d-flex flex-column">
    <!-- Navbar -->
    @include('layouts.user.components.navbar')


    <!-- Contenido -->
    <div class="flex-grow-1">
        <div class="container text-center">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.user.components.footer') </footer>

    <!-- Scripts -->
    @yield('scripts')
    <script src="{{ asset('vendor/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>