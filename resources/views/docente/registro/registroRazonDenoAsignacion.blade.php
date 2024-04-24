@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Registro de razones de no asignacion de ambientes</h1>
    <button class="btn btn-primary" id="agregarBtn" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
<i class="bi bi-plus"></i> <!-- Icono "plus" de Bootstrap Icons -->
</button>
<!-- docente/components/formularioRegistroRazon.blade.php -->




</div>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
    </div>


    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th style="text-align: center">Descripción</th>

                    <th style="width: 40px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr style="@if($solicitud->estado == 'cancelado') background-color: #E8E8E8; color: black; @endif">

                    <td>{{ $solicitud->id_razones }}</td>
                    <td style="text-align: center">{{ $solicitud->razon }}</td>




                    <td class="d-flex justify-content-between">

                        <button class="btn eliminar-btn mx-1 cancelarBtn" type="button" data-id="{{ $solicitud->id_razones }}">
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

        <form id="deleteForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>


    </div>

</div>
@include('docente.components.formularioRegistroRazon')


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
        var agregarBtn = document.getElementById('agregarBtn');
        var formulario = document.getElementById('formularioRegistroRazon');

        agregarBtn.addEventListener('click', function() {
            formulario.style.display = 'block';
        });
    });



    document.addEventListener("DOMContentLoaded", function() {
    console.log("DOM cargado");
    var cancelarBtns = document.querySelectorAll('.cancelarBtn');
    console.log("Botones cancelar encontrados:", cancelarBtns.length);
    cancelarBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            console.log("Botón cancelar clickeado");
            // Resto del código de tu función aquí
        });
    });
});


//borrar datos
document.addEventListener("DOMContentLoaded", function() {
    var cancelarBtns = document.querySelectorAll('.cancelarBtn');
    cancelarBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('¿Estás seguro de querer cancelar este registro?')) {
                var id = this.getAttribute('data-id');
                var form = document.getElementById('deleteForm');
                form.action = '{{ route("razones.destroy", ["id" => ":id"]) }}'.replace(':id', id);
                form.submit();
            }
        });
    });
});




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
    // Llenar los campos del formulario con los datos de la solicitud
    console.log("EL ID ESS");
    console.log(solicitud);
    document.getElementById("ID").value = solicitud.id_razon;
    document.getElementById("grupo").value = solicitud.razon;

}




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
