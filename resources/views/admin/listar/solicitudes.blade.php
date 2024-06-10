@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Lista de Solicitudes </h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header">
    <form class="row align-items-end">
    <div class="form-group col-lg-4 col-md-6">
        <label for="inputSearch" class="mr-2">Materia:</label>
        <select class="form-control" id="inputSearch" placeholder="Seleccione una materia">
            <option value="" disabled selected>Seleccione una materia</option>
            @foreach($materias as $materia)
                <option value="{{ $materia }}">{{ $materia }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-lg-2 col-md-6">
        <label for="selectMode" class="mr-2">Modo:</label>
        <select class="form-control" id="selectMode">
            <option value="Todos" selected>Todos</option>
            <option value="NORMAL">Normal</option>
            <option value="URGENTE">Urgente</option>
        </select>
    </div>
    <div class="form-group col-lg-2 col-md-6">
        <label for="selectStatus" class="mr-2">Estado:</label>
        <select class="form-control" id="selectStatus">
            <option value="Todos" selected>Todos</option>
            <option value="ACEPTADO">Aceptado</option>
            <option value="PENDIENTE">Pendiente</option>
            <option value="CANCELADO">Cancelado</option>
        </select>
    </div>
    <div class="form-group col-lg-2 col-md-6">
        <button type="button" id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
    </div>
</form>

    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Aula</th>
                    <th>Materia</th>
                    <th>Fecha</th>
                    <th>Modo</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 1; @endphp
                @foreach($solicitudes as $solicitud)
                    <tr style="@if($solicitud->ESTADO == 'CANCELADO') background-color: #E8E8E8; color: black; @endif">
                        <td>{{ $contador++ }}</td>
                        <td>{{ $solicitud->solicitud_relacion_ambiente->NOMBRE }}</td>
                        <td>{{ $solicitud->solicitud_relacion_materia->NOMBRE }}</td>
                        <td>{{ $solicitud->FECHA_RE }}</td>
                        <td>
                            <span class="btn btn-sm btn-block 
                                @if($solicitud->MODO == 'NORMAL') btn-success 
                                @else btn-danger @endif">
                                {{ $solicitud->MODO }}
                            </span>
                        </td>
                        <td>
                            <span class="btn btn-sm btn-block 
                                @if($solicitud->ESTADO == 'ACEPTADO') btn-success 
                                @elseif($solicitud->ESTADO == 'PENDIENTE') btn-warning 
                                @else btn-danger @endif">
                                {{ $solicitud->ESTADO }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                data-id="{{ $solicitud->ID_SOLICITUD }}" onclick="obtenerDatosSolicitud(this)">
                                <span class="text-primary">
                                    <i class="bi bi-eye"></i> <!-- Icono "eye" de Bootstrap Icons -->
                                </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



@include('admin.components.formularioReserva')

@stop

@section('css')
<link rel="stylesheet" href="/css/admin/home.css">
<!-- CSS de Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
@stop

@section('js')


<script>
    $(document).ready(function() {
        $('#inputSearch').on('input', function() {
            var inputVal = $(this).val();
            $('#materias option').each(function() {
                var optionVal = $(this).val();
                if (optionVal.toLowerCase().includes(inputVal.toLowerCase())) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>
    const solicitudes = @json($solicitudes);

    function obtenerDatosSolicitud(button) {
        var id = button.getAttribute("data-id");
        const solicitud_actual = solicitudes.find(soli => soli.ID_SOLICITUD == id);
        document.getElementById("solicitudId").value = id;
        if (solicitud_actual) {
            llenarFormulario(solicitud_actual);
        } else {
            console.error('La solicitud no está definida en los datos obtenidos:', data);
        }
    }

    function llenarFormulario(solicitud) {
        document.getElementById("materia").value = solicitud.solicitud_relacion_materia.NOMBRE;
        document.getElementById("grupo").value = solicitud.GRUPOS;
        document.getElementById("cantidad_estudiantes").value = solicitud.CANTIDAD_EST;
        document.getElementById("motivo").value = solicitud.MOTIVO;
        document.getElementById("modo").value = solicitud.MODO;
        document.getElementById("aula").value = solicitud.solicitud_relacion_ambiente.NOMBRE;
        document.getElementById("fecha").value = solicitud.FECHA_RE;
        document.getElementById("horario").value = solicitud.HORAINI + ' - ' + solicitud.HORAFIN;
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnBuscar").addEventListener('click', function() {
            var modo = document.getElementById("selectMode").value;
            var estado = document.getElementById("selectStatus").value;
            var materia = document.getElementById("inputSearch").value;
            let filtro = solicitudes.filter(solicitud => {
                const modoMatch = (modo === 'Todos' || solicitud.MODO === modo);
                const estadoMatch = (estado === 'Todos' || solicitud.ESTADO === estado);
                const materiaMatch = (materia === '' || solicitud.solicitud_relacion_materia.NOMBRE.includes(materia));
                return modoMatch && estadoMatch && materiaMatch;
            });
            actualizarTabla(filtro);
        });
    });

    function actualizarTabla(data) {
        var tbody = document.querySelector('tbody');
        tbody.innerHTML = '';
        let contador = 1;
        data.forEach(solicitud => {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${contador++}</td>
                <td>${solicitud.solicitud_relacion_ambiente.NOMBRE}</td>
                <td>${solicitud.solicitud_relacion_materia.NOMBRE}</td>
                <td>${solicitud.FECHA_RE}</td>
                <td>
                    <span class="btn btn-sm btn-block" style="background-color: ${solicitud.MODO === 'NORMAL' ? '#198754' : '#dc3545'}; color: white">
                        ${solicitud.MODO}
                    </span>
                </td>
                <td>
                    <span class="btn btn-sm btn-block" style="background-color: ${solicitud.ESTADO === 'ACEPTADO' ? '#198754' : solicitud.ESTADO === 'PENDIENTE' ? '#FFC107' : '#dc3545'}; color: ${solicitud.ESTADO === 'PENDIENTE' ? 'black' : 'white'}">
                        ${solicitud.ESTADO}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                        data-id="${solicitud.ID_SOLICITUD}" onclick="obtenerDatosSolicitud(this)">
                        <span class="text-primary">
                            <i class="bi bi-eye"></i> <!-- Icono "eye" de Bootstrap Icons -->
                        </span>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }
</script>




@stop
