@extends('adminlte::page')

@section('title', 'Notificaciones enviadas')

@section('content_header')
<h1>MailBox</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong>Notificaciones</strong>
                    <input class="form-control" type="text" name="docente" placeholder="Buscar docente">
                    <p id="messageErrorDocente" style="display: none; color: red">*No se encontro el ambiente</p>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="notification-list">
                        @foreach($notificationes as $notification)
                            @php
                                $class = '';
                                if (strpos($notification['CUERPO'], 'ACEPTADO') !== false) {
                                    $class = 'bg-success';
                                } elseif (strpos($notification['CUERPO'], 'CANCELADO') !== false) {
                                    $class = 'bg-danger';
                                }

                                $tipo = '';
                                $modo = '';
                                $buttonClass = '';
                                $buttonClassMode = '';
                                if (strpos($notification['CUERPO'], 'reserva') !== false) {
                                    $tipo = 'Reserva';
                                    $buttonClass = 'btn-primary';
                                } elseif (strpos($notification['CUERPO'], 'ACEPTADO') !== false) {
                                    $tipo = 'SOLICITUD';
                                    $buttonClass = 'btn-success';
                                } elseif (strpos($notification['CUERPO'], 'CANCELADO') !== false) {
                                    $tipo = 'SOLICITUD';
                                    $buttonClass = 'btn-danger';
                                } else {
                                    $tipo = 'SOLICITUD';
                                    $buttonClass = 'btn-warning';
                                }

                                if(strpos($notification['CUERPO'], 'URGENTE')){
                                    $modo = 'URGENTE';
                                    $buttonClassMode = 'btn-danger';
                                }else{
                                    $modo= 'NORMAL';
                                    $buttonClassMode = 'btn-success';
                                }
                            @endphp
                            <li class="list-group-item notification-item" data-id="{{ $notification['ID'] }}">
                                <strong>{{ $notification['NOMBRE_DOCENTE'] }}</strong>
                                <p>{{ Str::limit($notification['CUERPO'], 50) }}</p>
                                <div class="notification-type row">
                                    <button class="btn {{ $buttonClass }} btn-sm">{{ $tipo }}</button>
                                    <button class="btn {{ $buttonClassMode }} btn-sm">{{ $modo }}</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Contenido del Mensaje</strong>
                        </div>
                        {{-- <div class="col-md-6">
                            <button class="btn btn-info" name="enviar" style="color: white">Redactar mensaje</button>
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div id="notification-content">
                        <p>Seleccione un mensaje para ver el contenido.</p>
                    </div>
                </div>
                <div id="cuerpo">

                </div>
            </div>
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
<style>
    .notification-item {
        cursor: pointer;
    }

    .notification-item:hover {
        background-color: #f8f9fa;
    }

    .notification-type {
        margin-top: 10px;
    }
    .notification-type .btn {
        width: 100px;
    }

</style>
@endsection

@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    const notificaciones = @json($notificationes)

    document.addEventListener('DOMContentLoaded', function () {
        const notificationItems = document.querySelectorAll('.notification-item')
        const notificationContent = document.getElementById('notification-content')

        notificationItems.forEach(item => {
            item.addEventListener('click', function () {
                const id = this.getAttribute('data-id')
                
                const notify_found = notificaciones.find(notify => notify['ID'] === id)
                const message_parts = descMessage(notify_found['CUERPO'])
                let buttonClass = ''
                let buttonClassMode = ''
                const tipo = notify_found.CUERPO.toLowerCase().includes('reserva') ? 'Reserva' : 'SOLICITUD'
                const estado = !notify_found.CUERPO.toLowerCase().includes('PENDIENTE') ? 'PENDIENTE' : 'ACEPTADO'
                const modo = notify_found.CUERPO.toLowerCase().includes('URGENTE') ? 'URGENTE' : 'NORMAL'
                let color = ''

                if (notify_found.CUERPO.includes('ACEPTADO')) {
                    buttonClass = 'btn-success'
                    color = '#d9ead3'
                } else if (notify_found.CUERPO.includes('CANCELADO')) {
                    buttonClass = 'btn-danger'
                    color = '#f2dede'
                } else {
                    buttonClass = 'btn-warning'
                    color = '#fff2cc'
                }

                if(notify_found.CUERPO.includes('URGENTE')){
                    buttonClassMode = 'btn-danger'
                }else{
                    buttonClassMode = 'btn-success'
                }

                if (notify_found) {
                    document.getElementById('notification-content').innerHTML = `
                        <div class="card">
                            <div class="card-header" style="background-color: ${color}">
                                <strong>${notify_found['NOMBRE_DOCENTE']}</strong>
                                <br>
                                <strong>${notify_found['EMAIL']}</strong>
                                <br>
                                <button class="btn ${buttonClass} btn-sm">${estado}</button>
                                <button class="btn btn-success btn-sm">${tipo}</button>
                                <button class="btn ${buttonClassMode} btn-sm">${modo}</button>
                                <button class="btn btn-sm btn-success" type="button">
                                    <a href="http://127.0.0.1:8000/admin/reservas/atencion" style="color: white;display: block;">
                                        ATENDER SOLICITUD
                                    </a>
                                </button>
                            </div>
                            <div class="card-body">
                                ${message_parts.map( 
                                        message => `<p>${message}</p>`
                                    ).join('')}
                            </div>
                            
                        </div>
                    `
                }
            })
        })
    })

    document.querySelector('[name="docente"]').addEventListener('keydown', (event) => {
        const valor = event.target.value
        const lista = document.getElementById('notification-list')
        const message = document.getElementById('messageErrorDocente')
        const lista_filtrada = notificaciones.filter( notify => notify['NOMBRE_DOCENTE'].includes(valor.toUpperCase()))

        if(lista_filtrada.length > 0){
            actualizarLista(lista, lista_filtrada)
            message.style.display = 'none'
        }else{
            actualizarLista(notificaciones, lista_filtrada)
            message.style.display = 'block'
        }
    })

    function actualizarLista(lista, lista_filtro){

        lista.innerHTML = ''
        lista_filtro.forEach(item => {
            lista.innerHTML += `
                <li class="list-group-item notification-item" data-id="${item['ID']}">
                    <strong>${item['NOMBRE_DOCENTE']}</strong>
                    <p>${strLimit(item['CUERPO'], 50)}</p>
                    <div class="notification-type">
                        <button class="btn ${item.CUERPO.includes('ACEPTADO') ? 'btn-success' : item.CUERPO.includes('CANCELADO') ? 'btn-danger' : 'btn-warning'} btn-sm">${item.CUERPO.toLowerCase().includes('reserva') ? 'Reserva' : 'Solicitud'}</button>
                    </div>
                </li>
            `
        })

        document.querySelectorAll('.notification-item').forEach(item => {
            item.addEventListener('click', function () {
                const id = this.getAttribute('data-id')
                
                const notify_found = notificaciones.find(notify => notify['ID'] === id)
                const message_parts = descMessage(notify_found['CUERPO'])
                let buttonClass = ''
                let buttonClassMode = ''
                const tipo = notify_found.CUERPO.toLowerCase().includes('reserva') ? 'Reserva' : 'SOLICITUD'
                const estado = notify_found.CUERPO.toLowerCase().includes('PENDIENTE') ? 'PENDIENTE' : 'ACEPTADO'
                const modo = notify_found.CUERPO.toLowerCase().includes('URGENTE') ? 'URGENTE' : 'NORMAL'
                let color = ''

                if (notify_found.CUERPO.includes('ACEPTADO')) {
                    buttonClass = 'btn-success'
                    color = '#d9ead3'
                } else if (notify_found.CUERPO.includes('CANCELADO')) {
                    buttonClass = 'btn-danger'
                    color = '#f2dede'
                } else {
                    buttonClass = 'btn-warning'
                    color = '#fff2cc'
                }

                if(notify_found.CUERPO.includes('URGENTE')){
                    buttonClassMode = 'btn-danger'
                    color = '#f2dede'
                }else{
                    buttonClassMode = 'btn-success'
                    color = '#d9ead3'
                }

                if (notify_found) {
                    document.getElementById('notification-content').innerHTML = `
                        <div class="card">
                            <div class="card-header" style="background-color: ${color}">
                                <strong>${notify_found['NOMBRE_DOCENTE']}</strong>
                                <br>
                                <strong>${notify_found['EMAIL']}</strong>
                                <br>
                                <button class="btn ${buttonClass} btn-sm">${estado}</button>
                                <button class="btn btn-success btn-sm">${tipo}</button>
                                <button class="btn ${buttonClassMode} btn-sm">${modo}</button>
                                <button class="btn btn-sm btn-success" type="button">
                                    <a href="http://127.0.0.1:8000/admin/reservas/atencion" style="color: white;display: block;">
                                        ATENDER SOLICITUD
                                    </a>
                                </button>
                            </div>
                            <div class="card-body">
                                ${message_parts.map( 
                                        message => `<p>${message}</p>`
                                    ).join('')}
                            </div>
                            
                        </div>
                    `
                }
            })
        })
    }

    function strLimit(string, limit) {
        if (string.length > limit) {
            return string.substring(0, limit) + '...'
        } else {
            return string
        }
    }

    function descMessage(message){
        return message.split(',')
    }

    // document.addEventListener('DOMContentLoaded', function() {
    //     const enviarMensajeBtn = document.querySelector('button[name="enviar"]');
    //     const cuerpoDiv = document.getElementById('cuerpo');

    //     enviarMensajeBtn.addEventListener('click', function() {
    //         cuerpoDiv.innerHTML = `
    //             <form id="formulario-mensaje">
    //                 <div class="form-group">
    //                     <label for="mensaje">Mensaje:</label>
    //                     <textarea class="form-control" id="mensaje" rows="3"></textarea>
    //                 </div>
    //                 <div class="form-group">
    //                     <label for="docentes" class="label-control">Enviar a:</label>
    //                     <input name="docentes" class="form-control"></input>
    //                 </div>
    //                 <button type="submit" class="btn btn-primary">Enviar</button>
    //             </form>
    //         `;

    //         const formularioMensaje = document.getElementById('formulario-mensaje');
    //         formularioMensaje.addEventListener('submit', function(event) {
    //             event.preventDefault();
    //             const mensaje = document.getElementById('mensaje').value;
    //             const docentesSeleccionados = Array.from(document.querySelectorAll('#docentes option:checked')).map(option => option.value);
    //             console.log('Mensaje:', mensaje);
    //             console.log('Docentes seleccionados:', docentesSeleccionados);
    //         });
    //     });
    // });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@endsection



