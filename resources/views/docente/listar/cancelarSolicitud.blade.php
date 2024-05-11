@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Cancelar Reservas</h1>
@stop

@section('content')

<!-- Contenido de la página -->

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
                <label for="selectMode" class="mr-2"></label>
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
                    <th style="width: 40px">Modo</th>
                    <th style="width: 40px">Estado</th>
                    <th style="width: 10px">Detalles</th>
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
                    <td class="modo">
                        <span class="btn btn-sm btn-block
@if($solicitud->estado == 'cancelado')
background-color: #FFC0B7;btn btn-outline-secondary
@elseif($solicitud->estado == 'Reservado')
    btn-success
@elseif($solicitud->estado == 'Solicitando')
    btn-warning
@else
    btn-danger
@endif
" aria-controls="offcanvasRight">
                            <span class="text-truncate">{{ $solicitud->estado }}</span>
                        </span>

                    </td>
                    <td class="d-flex justify-content-between">
                        <button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                            data-id="{{ $solicitud->id }}" onclick="obtenerDatosSolicitud(this)">
                            <span class="text-primary">
                                <i class="bi bi-eye"></i> <!-- Icono "eye" de Bootstrap Icons -->
                            </span>
                        </button>
                        <button
                            class="btn eliminar-btn mx-1 cancelarBtn"
                            type="button" data-id="{{ $solicitud->id }}">
                            <span class="text-danger">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <ul class="pagination justify-content-end">
            {{-- Previous Page Link --}}
            @if ($solicitudes->onFirstPage())
            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $solicitudes->previousPageUrl() }}"
                    rel="prev">&laquo;</a></li>
            @endif

            {{-- Pagination Elements --}}
            @for ($i = 1; $i <= $solicitudes->lastPage(); $i++)
                <li class="page-item {{ ($solicitudes->currentPage() == $i) ? 'active' : '' }}">
                    <a class="page-link" href="{{ $solicitudes->url($i) }}">{{ $i }}</a>
                </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($solicitudes->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $solicitudes->nextPageUrl() }}"
                        rel="next">&raquo;</a></li>
                @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                @endif
        </ul>

        {{-- Mostrar el número total de páginas --}}
        <div class="pagination-info">
            Página {{ $solicitudes->currentPage() }} de {{ $solicitudes->lastPage() }}
        </div>
    </div>

</div>


@include('docente.components.formularioCancelar')

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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("aceptarBtn").addEventListener('click', function() {
        var id = document.getElementById("solicitudId").value; // Obtener el ID del input hidden
        console.log("ID en cancelar:", id);
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch("{{ url('docente/solicitudes') }}/" + id + "/aceptar", {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(
                                'Error al aceptar la solicitud');
                        }
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire(
                            '¡Aceptado!',
                            'La solicitud ha sido aceptada exitosamente.',
                            'success'
                        ).then(() => {
                            // Recarga la página para reflejar los cambios en la tabla
                            location.reload();
                        });
                    })
                    .catch(error => {
                        console.error('Error al aceptar la solicitud:',
                            error);
                        // Muestra un mensaje de error al usuario
                        Swal.fire(
                            '¡Error!',
                            'Ocurrió un error al aceptar la solicitud.',
                            'error'
                        );
                    });
            }
        })
    });
});
</script>
<script>
function obtenerDatosSolicitud(button) {
    var id = button.getAttribute("data-id");
    document.getElementById("solicitudId").value = id;
    fetch('{{ route("docente.reservas.showReservas", ["id" => ":id"]) }}'.replace(':id', id))
        .then(response => response.json())
        .then(data => {
            console.log(data);
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
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("btnBuscar").addEventListener('click', function() {
        var modo = document.getElementById("selectMode").value;
        var estado = document.getElementById("selectStatus").value;
        var materia = document.getElementById("inputSearch").value;
        console.log("Modo:", modo);
        console.log("Estado:", estado);
        console.log("Materia:", materia);
        // Enviar solicitud al servidor
        fetch('{{ route("docente.solicitud.filtrar.datosfiltro") }}?modo=' + modo + '&estado=' + estado + '&materia=' + materia)
            .then(response => response.json())
            .then(data => {
                // Actualizar la tabla con los nuevos datos
                console.log(data);
                actualizarTabla(data);
            })
            .catch(error => {
                console.error('Error al buscar datos:', error);
            });
    });
    var cancelarBtns = document.querySelectorAll('.cancelarBtn');
    cancelarBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            console.log("ID:", id);
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ url('docente/solicitudes') }}/" + id + "/cancelar", {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(
                                    'Error al cancelar la solicitud');
                            }
                            return response.json();
                        })
                        .then(data => {
                            Swal.fire(
                                '¡Cancelado!',
                                'La solicitud ha sido cancelada exitosamente.',
                                'success'
                            ).then(() => {
                                // Recarga la página para reflejar los cambios en la tabla
                                location.reload();
                            });
                        })
                        .catch(error => {
                            console.error('Error al cancelar la solicitud:',
                                error);
                            // Muestra un mensaje de error al usuario
                            Swal.fire(
                                '¡Error!',
                                'Ocurrió un error al cancelar la solicitud.',
                                'error'
                            );
                        });
                }
            })
        });
    });
});
</script>


</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
<script>
// Obtener la ruta actual
const currentPath = window.location.pathname;

// Comprobar si la ruta contiene "/docente/reservas/llegada"
if (currentPath.includes("/docente/reservas/llegada")) {
    document.getElementById("porLlegada").checked = true; // Marcar el botón de radio por llegada
} else if (currentPath.includes("/docente/reservas/urgencia")) {
    document.getElementById("porUrgencia").checked = true; // Marcar el botón de radio por urgencia
}
</script>
@stop
