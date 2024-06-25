@extends('layouts.user.index')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="#">
<style>
    body, html {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    .bg-image {
        background-image: url('{{ asset('image/banner.png') }}');
        background-size: cover;
        background-position: center;
        height: 45vh;
        display: flex;
        align-items: center;
        position: relative;
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
        background-color: rgba(0, 0, 0, 0.2);
    }
    .text-white {
        color: white;
    }
    .section {
        padding: 100px 0;
    }
    .wow {
        visibility: hidden;
    }
    .down-arrow {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 2rem;
        color: white;
        animation: bounce 2s infinite;
    }
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateX(-50%) translateY(0);
        }
        40% {
            transform: translateX(-50%) translateY(-10px);
        }
        60% {
            transform: translateX(-50%) translateY(-5px);
        }
    }
</style>
@stop

@section('content')

<!-- Hero Section -->
<section id="inicio" class="hero bg-image text-white">
    <div class="overlay">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 wow fadeInLeft">
                    <h1 class="display-4">Sistema de Reservas</h1>
                    <p class="lead">Gestiona tus reservas de ambientes de manera </p>
                    <p>eficiente , segura y rapida.</p>
                    <a href="#sistema" class="btn btn-light btn-lg">Ver más</a>
                </div>
                <div class="col-md-6 wow fadeInRight">
                    <!-- <img src="{{ asset('image/calendar.png') }}" class="img-fluid" alt="Imagen de Reserva de Ambientes"> -->
                </div>
            </div>
        </div>
        <a href="#sistema" class="down-arrow">&#x25BC;</a>
    </div>
</section>

<!-- Nuestros Proyectos Section -->
<section id="sistema" class="section bg-light">
    <div class="container">
        <h2 class="text-center mb-5 wow fadeInUp">Características del Sistema de Reservas</h2>
        <div class="row g-4">
            <div class="col-md-12 wow fadeInLeft">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('image/re.png') }}" class="img-fluid rounded" alt="Aula de Capacitación">
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-center mt-3">Reserva Segura y Eficiente</h3>
                        <p class="text-center">Nuestro sistema de reservas asegura una gestión eficiente y segura, permitiéndote reservar espacios según disponibilidad y preferencias con solo unos clics.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 wow fadeInRight">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="text-center mt-3">Confirmación Instantánea</h3>
                        <p class="text-center">Recibe confirmación inmediata de tus reservas, junto con notificaciones por correo electrónico para mantenerse actualizado sin esfuerzo.</p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('image/co.jpeg') }}" class="img-fluid rounded" alt="Aula de Conferencias">
                    </div>
                </div>
            </div>
            <div class="col-md-12 wow fadeInLeft">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('image/ca.png') }}" class="img-fluid rounded" alt="Sala de Reuniones">
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-center mt-3">Integración con Calendarios</h3>
                        <p class="text-center">Integra nuestras reservas con tu calendario personal o corporativo, facilitando una gestión eficaz de eventos y horarios.</p>
                    </div>
                </div>
            </div>
            <!-- Más características -->
        </div>
    </div>
</section>




<!-- Nuestro Sistema Section -->
<section  class="section bg-white">
    <div class="container">
        <h2 class="text-center mb-5 wow fadeInUp">Características del Sistema de Reservas</h2>
        <div class="row align-items-center g-4">
            <div class="col-md-6 wow fadeInLeft">
                <img src="{{ asset('image/dasboard.jpg') }}" class="img-fluid rounded w-60" alt="Nuestro Sistema de Reservas">
            </div>
            <div class="col-md-6 wow fadeInRight">
                <ul style=" padding-left: 0;">
                    <li style="text-align: left;">Funcionalidad de reserva rápida y sencilla en un solo paso</li>
                    <li style="text-align: left;">Reserva según disponibilidad y preferencias.</li>
                    <li style="text-align: left;">Confirmación instantánea y notificaciones por correo electrónico.</li>
                    <li style="text-align: left;">Integración con calendarios para gestión simplificada de eventos.</li>
                    <li style="text-align: left;">Gestión de listas de espera y prioridades de reserva.</li>
                    <li style="text-align: left;">Generación de reportes detallados y análisis de uso.</li>
                    <li style="text-align: left;">Asistencia y soporte técnico 24/7.</li>
                    <li style="text-align: left;">Acceso multicanal para reserva desde diferentes dispositivos.</li>
                    <li style="text-align: left;">Notificaciones automáticas de recordatorio y confirmación.</li>
                    <li style="text-align: left;">Funcionalidad de búsqueda avanzada de ambientes disponibles.</li>
                </ul>
            </div>
        </div>
    </div>
</section>



<section id="estadisticas" class="section bg-light">
    <div class="container">
        <h2 class="text-center mb-5 wow fadeInUp">Estadísticas del Sistema</h2>
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="stat wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    <div class="circle">
                        <div class="mask full">
                            <div class="fill"></div>
                        </div>
                        <div class="mask half">
                            <div class="fill"></div>
                        </div>
                        <h3>100+</h3>
                        <p>Reservas Realizadas</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">
                    <div class="circle">
                        <div class="mask full">
                            <div class="fill"></div>
                        </div>
                        <div class="mask half">
                            <div class="fill"></div>
                        </div>
                        <h3>50+</h3>
                        <p>Ambientes Disponibles</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.9s">
                    <div class="circle">
                        <div class="mask full">
                            <div class="fill"></div>
                        </div>
                        <div class="mask half">
                            <div class="fill"></div>
                        </div>
                        <h3>200+</h3>
                        <p>Usuarios Registrados</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat wow fadeInRight" data-wow-duration="1s" data-wow-delay="1.1s">
                    <div class="circle">
                        <div class="mask full">
                            <div class="fill"></div>
                        </div>
                        <div class="mask half">
                            <div class="fill"></div>
                        </div>
                        <h3>5+</h3>
                        <p>Años de Experiencia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/wowjs@1.1.3/dist/wow.min.js"></script>
<script>
    new WOW().init();
</script>

@endsection
