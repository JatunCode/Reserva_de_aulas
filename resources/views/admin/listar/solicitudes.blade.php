@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Lista de Solicitudes</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header">
        <form class="row">
            <div class="form-group col-lg-4 col-md-3 align-self-center">
                <label for="inputSearch" class="mr-2">Materia:</label>
                <select type="text" class="form-control w-100" id="inputSearch" list="materias" placeholder="Ingrese texto">
                    <option value="" disabled selected>Seleccione una materia</option>
                    <option value="TODAS LAS MATERIAS">TODAS LAS MATERIAS</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia['NOMBRE'] }}">{{ $materia['NOMBRE'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 align-self-center">
                <label for="selectMode" class="mr-2">Modo:</label>
                <select class="form-control" id="selectMode">
                    <option value="Todos" selected>Todos</option>
                    <option value="Normal">Normal</option>
                    <option value="Urgente">Urgente</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 align-self-center">
                <label for="selectStatus" class="mr-2">Estado:</label>
                <select class="form-control" id="selectStatus">
                    <option value="Todos" selected>Todos</option>
                    <option value="Aceptado">Reservado</option>
                    <option value="Pendiente">Solicitando</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 ml-auto align-self-center">
                <label for="selectMode" class="mr-2"></label>
                <button type="button" id="btnBuscar" class="btn btn-primary w-100" style="background-color: green">Buscar</button>
            </div>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
        <thead style="background-color: #00455c; color: white;">
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Aula</th>
                    <th>Materia</th>
                    <th>Fecha</th>
                    <th style="width: 40px">Modo</th>
                    <th style="width: 40px">Estado</th>
                    <th style="width: 10px">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @php
                $contador = 1;
                @endphp
                @foreach($solicitudes as $solicitud)
                    <tr style="@if($solicitud['ESTADO'] == 'CANCELADO') background-color: #E8E8E8; color: black; @endif">
                        <td>{{ $contador++ }}</td>
                        <td>{{ $solicitud['AMBIENTE'] }}</td>
                        <td>{{ $solicitud['MATERIA'] }}</td>
                        <td>{{ $solicitud['FECHA_SOLICITUD'] }}</td>
                        <td class="modo">
                            <span class="btn  btn-sm btn-block
                                @if($solicitud['ESTADO'] == 'CANCELADO')
                                    background-color: #FFC0B7; btn btn-outline-secondary;
                                @elseif($solicitud['MODO'] == 'NORMAL')
                                    btn-success
                                @else
                                    btn-danger
                                @endif
                                " aria-controls="offcanvasRight">
                                {{ @$retVal = (!is_object($solicitud['MODO'])) ? $solicitud['MODO'] : 'URGENTE' ; }}
                            </span>
                        </td>
                        <td>
                            <span class="btn btn-sm btn-block
                                    @if($solicitud['ESTADO'] == 'CANCELADO')
                                        background-color: #FFC0B7; btn btn-outline-secondary
                                    @elseif($solicitud['ESTADO'] == 'ACEPTADO')
                                        btn-success
                                    @elseif($solicitud['ESTADO'] == 'PENDIENTE')
                                        btn-warning
                                    @else
                                        btn-danger
                                    @endif
                                    " aria-controls="offcanvasRight">
                                <span class="text-truncate">{{ $solicitud['ESTADO'] }}</span>
                            </span>
                        </td>
                        <td class="d-flex justify-content-between">
                            <button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                                data-id="{{ $solicitud['ID'] }}" onclick="obtenerDatosSolicitud(this)">
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
@include('admin.components.formularioReserva')
@stop

@section('css')
<link rel="stylesheet" href="/css/admin/home.css">
<!-- CSS de Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<style>
    thead.table-dark th {
        background-color: #343a40;
        color: white;
    }
    .table-hover tbody tr:hover {
        background-color: #f5f5f5;
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
</style>
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
<script>

    const solicitudes = @json($solicitudes);
    let countPendientes = 0;
    let countUrgentes = 0;
    fetch("http://127.0.0.1:8000/api/fetch/solicitud/count")
        .then(response => response.json())
        .then(data => {
            countPendientes = data['pendientes'];
            countUrgentes = data['urgentes'];
            console.log('Datos: ', data);
        })
        .catch(error => {
            console.log("Error al obtener los conteos de datos.", error);
        })
    fetch('http://127.0.0.1:8000/api/fetch/docentes').then(
        response => response.json()
    ).then(
        data => {
            docentes = data;
            mensaje();
        }
    ).catch(
        error => {
            console.log("Error encontrado: ", error);
        }
    )
    function mensaje(){
        Swal.fire({
            title: "<strong>Tiene solicitudes por atender</strong>",
            html: `<strong>Solicitudes pendientes: ${countPendientes}</strong>
                    <br>
                    <strong style="color: red">Solicitudes urgentes: ${countUrgentes}</strong>
                `,
            icon: "info",
            showCancelButton:true,
            cancelButtonColor: "",
            cancelButtonText: "Seguir en la paigna",
            confirmButtonColor: "#7ebd5b",
            confirmButtonText: "Atender solicitudes",
            showClass: {
                popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
                `,
            },
            hideClass: {
                popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
                `,
            },
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "http://127.0.0.1:8000/admin/reservas/atencion";
            }
        });
    }
    function obtenerDatosSolicitud(button) {
        var id = button.getAttribute("data-id");
        const solicitud_actual = solicitudes.find(soli => soli['ID'] == id);
        if (solicitud_actual) {
            llenarFormulario(solicitud_actual);
        } else {
            console.error('La solicitud no está definida en los datos obtenidos:', data);
        }
    }

    function llenarFormulario(solicitud) {
        // Llenar los campos del formulario con los datos de la solicitud
        document.querySelector('[name="materia"]').value = solicitud['MATERIA'];
        document.querySelector('[name="grupos"]').value = solicitud['GRUPOS'];
        document.querySelector('[name="capacidad"]').value = solicitud['CANTIDAD'];
        document.querySelector('[name="motivo"]').value = solicitud['MOTIVO'];
        document.querySelector('[name="modo"]').value = solicitud['MODO'];
        document.querySelector('[name="ambiente"]').value = solicitud['AMBIENTE'];
        document.querySelector('[name="fechares"]').value = solicitud['FECHA_RESERVA'];
        document.querySelector('[name="fechasoli"]').value = solicitud['FECHA_SOLICITUD']
        document.querySelector('[name="horario"]').value = solicitud['HORARIO'];
        nombres.innerHTML = '';
        solicitud['NOMBRES_DOCENTES'].forEach((nombre) => {
            nombres.innerHTML +=
            `<input type="text" class="form-control nombre-input" name="nombre" value="${nombre['Nombre_docente']}" readonly>`
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnBuscar").addEventListener('click', function() {
            var modo = document.getElementById("selectMode").value;
            var estado = document.getElementById("selectStatus").value;
            var materia = document.getElementById("inputSearch").value;
            let filtro = solicitudes.filter(solicitud => {
                            console.log("Solicitud:", solicitud);
                            const modoMatch = (modo === 'Todos' || solicitud.MODO === modo.toUpperCase());
                            const estadoMatch = (estado === 'Todos' || solicitud.ESTADO === estado.toUpperCase());
                            const materiaMatch = (materia === 'TODAS LAS MATERIAS' || solicitud.MATERIA.includes(materia));

                            console.log("modoMatch:", modoMatch);
                            console.log("estadoMatch:", estadoMatch);
                            console.log("materiaMatch:", materiaMatch);

                            return modoMatch && estadoMatch && materiaMatch;
                            });
            actualizarTabla(filtro);
            console.log('Filtrado: ', filtro);
            console.log("Modo:", modo);
            console.log("Estado:", estado);
            console.log("materia:", materia);
        });
    });

    function actualizarTabla(data) {
        // Obtener referencia al cuerpo de la tabla
        var tbody = document.querySelector('tbody');
        
        // Eliminar los elementos existentes en el cuerpo de la tabla
        tbody.innerHTML = '';
        let contador = 1;
        // Iterar sobre los nuevos datos y agregar cada solicitud como una fila en la tabla
        data.forEach(solicitud => {
            // Crear una nueva fila
            var row = document.createElement('tr');
            
            // Agregar las celdas con los datos de la solicitud a la fila
            row.innerHTML = `
                <td>${contador++}</td>
                <td>${solicitud['AMBIENTE']}</td>
                <td>${solicitud['MATERIA']}</td>
                <td>${solicitud['FECHA_RESERVA']}</td>
                <td >
                    <span class="btn  btn-sm btn-block" style="background-color: ${solicitud['MODO'] === 'NORMAL' ? '#198754' : '#dc3545'}; color: white">
                        ${(isObject(solicitud['MODO']) || solicitud['MODO'].includes('URGENTE')) ? 'URGENTE' : 'NORMAL'}
                    </span>
                </td>
                <td>
                    <span class="btn btn-sm btn-block" style="background-color: ${solicitud['ESTADO'] === 'ACEPTADO' ? '#198754' : solicitud['ESTADO'] === 'PENDIENTE' ? '#FFC107' : '#dc3545'}; color: ${solicitud['ESTADO'] === 'PENDIENTE' ? 'black' : 'white'}">
                        ${solicitud['ESTADO']}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                        data-id="${solicitud['ID']}" onclick="obtenerDatosSolicitud(this)">
                        <span class="text-primary">
                            <i class="bi bi-eye"></i> <!-- Icono "eye" de Bootstrap Icons -->
                        </span>
                    </button>
                </td>
            `;
            
            // Agregar la fila al cuerpo de la tabla
            tbody.appendChild(row);
        });
    }

    function isObject(params) {
        return typeof params === "object" && params !== null
    }
</script>
@stop
