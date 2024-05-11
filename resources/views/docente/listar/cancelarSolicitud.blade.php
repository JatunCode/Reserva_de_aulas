@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Cancelar reservas</h1>
@stop

@section('content')

<div class="card">
    <div class="card-header">
        <form class="row">
            <div class="form-group col-lg-4 col-md-3 align-self-center">
                <label for="inputSearch" class="mr-2">Materia:</label>
                <input type="text" class="form-control w-100" id="inputSearch" list="materias" placeholder="Ingrese texto">
                <datalist id="materias">
                    @foreach($materias as $materia)
                    <option value="{{ $materia }}">{{ $materia }}</option>
                    @endforeach
                </datalist>
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
                    <option value="Reservado">Reservado</option>
                    <option value="Solicitando">Solicitando</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 ml-auto align-self-center">
                <button type="button" id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
            </div>
        </form>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Fecha Reservada</th>
                    <th>Aula</th>
                    <th>Materia</th>
                    <th>Fecha Solicitada</th>
                    <th>Horario</th>
                    <th>Modo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr style="@if($solicitud->estado == 'cancelado') background-color: #E8E8E8; color: black; @endif">
                    <td>{{ $solicitud->updated_at->format('Y-m-d') }}</td>
                    <td>{{ $solicitud->aula }}</td>
                    <td>{{ $solicitud->materia }}</td>
                    <td>{{ $solicitud->fecha }}</td>
                    <td>{{ $solicitud->horario }}</td>
                    <td>{{ $solicitud->modo }}</td>
                    <td>{{ $solicitud->estado }}</td>
                    <td class="d-flex justify-content-between">
                        <button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                            data-id="{{ $solicitud->id }}" onclick="obtenerDatosSolicitud(this)">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-danger btn-sm mx-1" onclick="mostrarModalCancelar({{ $solicitud->id }})">
                            <i class="fa fa-ban"></i> Cancelar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $solicitudes->links() }}
    </div>

    @include('docente.components.formularioReserva')
</div>

<!-- Cancellation Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancelar Reserva</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="cancelForm">
                    <div class="form-group">
                        <label for="reasonSelect">Razón de cancelación:</label>
                        <select class="form-control" id="reasonSelect">
                            @foreach($razones as $razon)
                                <option value="{{ $razon->id }}">{{ $razon->razon }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="cancelSolicitudId">
                    <button type="submit" class="btn btn-danger">Confirmar Cancelación</button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin/home.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
@stop

@section('js')
<script>
function obtenerDatosSolicitud(button) {
    var id = button.getAttribute("data-id");
    document.getElementById("solicitudId").value = id;
    fetch('{{ route("docente.reservas.show", ["id" => ":id"]) }}'.replace(':id', id))
        .then(response => response.json())
        .then(data => {
            llenarFormulario(data.solicitud);
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
        });
}

function llenarFormulario(solicitud) {
    document.getElementById("nombre").value = solicitud.nombre;
    document.getElementById("materia").value = solicitud.materia;
    document.getElementById("grupo").value = solicitud.grupo;
    document.getElementById("cantidad_estudiantes").value = solicitud.cantidad_estudiantes;
    document.getElementById("motivo").value = solicitud.motivo;
    document.getElementById("modo").value = solicitud.modo;
    document.getElementById("razon").value = solicitud.razon;
    document.getElementById("aula").value = solicitud.aula;
    document.getElementById("fecha").value = solicitud.fecha;
    document.getElementById("horario").value = solicitud.horario;
}
</script>
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


document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btnBuscar").addEventListener('click', function() {
        var modo = document.getElementById("selectMode").value;
        var estado = document.getElementById("selectStatus").value;
        var materia = document.getElementById("inputSearch").value;
        fetch('{{ route("docente.solicitud.filtrar.datosfiltro") }}?modo=' + modo + '&estado=' + estado + '&materia=' + materia)
            .then(response => response.json())
            .then(data => {
                actualizarTabla(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    window.mostrarModalCancelar = function(solicitudId) {
        $('#cancelSolicitudId').val(solicitudId); // Set the hidden input value
        $('#cancelModal').modal('show'); // Show the modal
    };

    $('#cancelForm').submit(function(e) {
        e.preventDefault();
        var solicitudId = $('#cancelSolicitudId').val();
        var reasonId = $('#reasonSelect').val();

        fetch(`/path-to-cancel-api/${solicitudId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: JSON.stringify({ reasonId: reasonId })
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Something went wrong');
            }
        })
        .then(data => {
            $('#cancelModal').modal('hide');
            alert('Reserva cancelada correctamente.');
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al cancelar la reserva.');
        });
    });
});

function actualizarTabla(data) {
    var tbody = document.querySelector('tbody');
    tbody.innerHTML = '';
    data.forEach(solicitud => {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td>${new Date(solicitud.updated_at).toISOString().split('T')[0]}</td>
            <td>${solicitud.aula}</td>
            <td>${solicitud.materia}</td>
            <td>${solicitud.fecha}</td>
            <td>${solicitud.horario}</td>
            <td><span class="btn btn-sm btn-block" style="background-color: ${solicitud.modo === 'Normal' ? '#198754' : '#dc3545'}; color: white">${solicitud.modo}</span></td>
            <td><span class="btn btn-sm btn-block" style="background-color: ${solicitud.estado === 'Reservado' ? '#198754' : solicitud.estado === 'Solicitando' ? '#FFC107' : '#dc3545'}; color: ${solicitud.estado === 'Solicitando' ? 'black' : 'white'}">${solicitud.estado}</span></td>
            <td class="d-flex justify-content-between">
                <button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                    data-id="${solicitud.id}" onclick="obtenerDatosSolicitud(this)">
                    <i class="bi bi-eye"></i>
                </button>
                <button class="btn btn-danger btn-sm mx-1" onclick="mostrarModalCancelar(${solicitud.id})">
                    <i class="fa fa-ban"></i> Cancelar
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });
}
</script>
@stop
