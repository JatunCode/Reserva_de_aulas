@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<h1></h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="row">
    <div class="col-lg-4 col-4">

        <div class="small-box bg-danger">
            <div class="inner">
            <h3>{{ $pendientesCount }}</h3>
                <p>Solicitudes Canceladas</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            {{-- <a href="{{ route('docente.solicitud.filtrar.datos_cancelar') }}" class="small-box-footer">Ver  <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>

    <div class="col-lg-4 col-4">

        <div class="small-box bg-warning">
            <div class="inner">
            <h3>{{ $urgentesCount }}</h3>
                <p>Solicitudes Pendientes</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            {{-- <a href="{{ route('docente.solicitud.filtrar.datos_solicitando') }}" class="small-box-footer">Ver  <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>

    <div class="col-lg-4 col-4">

        <div class="small-box bg-success">
            <div class="inner">
            <h3>{{ $reservadasCount }}</h3>
                <p>Solicitudes Reservadas</p>
                
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            {{-- <a href="{{ route('docente.solicitud.filtrar.datos_reservado') }}" class="small-box-footer">Ver <i class="fas fa-arrow-circle-right"></i></a> --}}
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div id='calendar'></div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin/home.css">
<!-- CSS de Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-<HASH>" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
@stop

@section('js')
<script src="https://kit.fontawesome.com/08cfafb55f.js" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    console.log(@json($eventos_json));
    
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                start: 'prev,next today',
                center: 'title',
                end: 'dayGridMonth,timeGridWeek,timeGridDay' // Opciones de vista: Mes, Semana, Día
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día'
            },
            allDayText: '',

            events: {!! $eventos_json !!},
            dayMaxEvents: 2,
            moreLinkText: function(num) {
                return num + ' más'; // Texto para mostrar cuando hay más eventos
            },
            eventDidMount: function(info) {
                // Establecer el color de fondo del evento
                info.el.style.backgroundColor = info.event.extendedProps.eventBackgroundColor;
                
            },
            
       
            dateClick: function(info) {
                calendar.changeView('timeGridDay', info.dateStr); // Cambia a la vista de día cuando se hace clic en un día
            },
            
        eventClick: function(info) {
            // Redirigir a la vista de día con el evento seleccionado
            calendar.gotoDate(info.event.start);
            calendar.changeView('timeGridDay');
        },
    //     eventContent: function(arg) {
    // // Verificar la vista actual del calendario
    
    //             // Verificar la vista actual del calendario
    //             if (arg.view.type === 'timeGridWeek' || arg.view.type === 'timeGridDay') {
    //                 // Crear el contenido del evento con fondo amarillo y texto blanco
    //                 var content = `
    //                     <div class="evento text-center" style="color: white; background-color: yellow !important;">
    //                         ${arg.event.title} <!-- Título del evento -->
    //                     </div>`;
    //                 return { html: content };
    //             } else {
    //                 // Usar el contenido predeterminado para la vista de mes
    //                 return null;
    //             }
    //         }

        });
        
        calendar.render();
    });
</script>







@stop
