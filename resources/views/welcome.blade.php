@extends('layouts.user.index')

<!-- Titulo específicos de la vista específica -->
@section('title', 'Home')
<!-- CSS específicos de la vista específica -->
@section('css')
<link rel="stylesheet" href="#">
<style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .bg-image {
            background-image: url('https://via.placeholder.com/1920x1080'); /* URL de tu imagen de fondo */
            background-size: cover;
            background-position: center;
            height: 100%;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.6); /* Ajusta la opacidad del overlay */
        }
        .text-white {
            color: white;
        }
    </style>
@stop
<!-- Contenido específicos de la vista específica -->

<!-- //* Simple comentario
// ! Comentario importante

//? Pregunta: ¿Este código es necesario?
// TODO: Tarea pendiente para completar
-->

@section('content')
<section class="hero bg-success text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4">Reserva de Ambientes</h1>
                <p class="lead">Reserva tus ambientes de manera fácil y rápida.</p>
                <a href="/login" class="btn btn-light btn-lg">Ver Disponibilidad</a>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('image/calen-ap.jpg') }}" class="img-fluid" alt="Imagen de Reserva de Ambientes">
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="main-content py-5">
    <div class="container">
        <h2 class="text-center mb-5">Nuestros Ambientes</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('image/aula1.jpg') }}" class="img-fluid rounded-top w-100 h-100" alt="Ambiente 1">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('image/aula2.jpg') }}" class="img-fluid rounded-top w-100 h-100" alt="Ambiente 2">
            </div>
            <div class="col-md-4">
                <img src="{{ asset('image/aula3.jpg') }}" class="img-fluid rounded-top w-100 h-100" alt="Ambiente 3">
            </div>
        </div>
    </div>
</section>






@endsection

@section('scripts')
<!-- Scripts específicos de la vista específica -->

@endsection
