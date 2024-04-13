@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1></h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Solicitudes disponibles</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Aula</th>
                    <th>Horario</th>
                    <th>Fecha</th>
                    <th style="width: 40px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($solicitudes as $solicitud)
                <tr>
                    <td>{{ $solicitud->id }}</td>
                    <td>{{ $solicitud->aula }}</td>
                    <td>{{ $solicitud->horario }}</td>
                    <td>{{ $solicitud->fecha }}</td>
                    <td>
                        <button class="btn btn-sm btn-success solicitar-btn" type="button"
                            data-aula="{{ $solicitud->aula }}" data-horario="{{ $solicitud->horario }}"
                            data-fecha="{{ $solicitud->fecha }}" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            Solicitar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
        </ul>
    </div>
</div>

@include('admin.components.formularioSolicitud')

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

@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Obtener los botones de solicitud
    var solicitarButtons = document.querySelectorAll(".solicitar-btn");
    // Agregar un event listener a cada botón
    solicitarButtons.forEach(function(button) {
        button.addEventListener("click", function() {
            // Obtener los datos de la fila asociados al botón
            var aula = button.getAttribute("data-aula");
            var horario = button.getAttribute("data-horario");
            var fecha = button.getAttribute("data-fecha");
            console.log(fecha)
            // Rellenar el formulario con los datos de la fila
            document.getElementById("aula").value = aula;
            document.getElementById("horario").value = horario;
            document.getElementById("fecha").value = fecha;
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Por defecto, ocultar los comentarios
    var comentarios = document.querySelector(".comentarios");
    comentarios.style.display = "none";

    // Por defecto, establecer el modo "Normal"
    var modoSelect = document.getElementById("modo");
    modoSelect.value = "1";

    // Función para alternar la visibilidad de los comentarios
    function toggleComentarios() {
        if (modoSelect.value === "2") {
            comentarios.style.display = "block";
            fecha.removeAttribute("disabled");
            fecha.removeAttribute("disabled");
        } else {
            comentarios.style.display = "none";
            fecha.setAttribute("disabled", true);
        }
    }

    // Escuchar cambios en el motivo y modo, y actualizar los comentarios en consecuencia
    var motivoSelect = document.getElementById("motivo");
    motivoSelect.addEventListener("change", toggleComentarios);
    modoSelect.addEventListener("change", toggleComentarios);

    // Verificar el valor inicial del motivo y modo, y actualizar los comentarios
    toggleComentarios();
});

var contadorNombres = 1; // Inicializar el contador de nombres

function agregarCampoNombre() {
    console.log("SCRIPT AGREGAR")
    if (contadorNombres <= 5) { // Verificar si no se han agregado más de 5 nombres
        var nuevoCampoNombre = `
                    <div class="col-md-12 mb-3">
                        <label for="nombre" class="form-label">Nombre (${contadorNombres}):</label>
                        <div class="input-group">
                            <input type="text" class="form-control nombre-input" placeholder="Ingrese su nombre">
                            <button class="btn btn-danger eliminar-nombre" type="button"><i class="bi bi-x"></i></button>
                        </div>
                    </div>
                `;
        $('#nombres-container').append(nuevoCampoNombre);
        contadorNombres++; // Incrementar el contador de nombres
    } else {
        alert("Solo se permiten 5 nombres.");
    }
}

// Manejar clic en el botón de agregar nombre
$('#agregar-nombre').on('click', function() {
    agregarCampoNombre();
});

// Manejar clic en el botón de eliminar nombre (delegación de eventos)
$('#nombres-container').on('click', '.eliminar-nombre', function() {
    $(this).closest('.col-md-12').remove();
    contadorNombres--; // Decrementar el contador de nombres al eliminar un campo
});

$(document).ready(function() {
    $('#grupo').tagsinput({
        allowDuplicates: false,
        trimValue: false,
        confirmKeys: [44], // Coma (,)
    });

    $('#grupo').on('beforeItemAdd', function(event) {
        if (event.item === ',') {
            var items = $('#grupo').tagsinput('items');
            var previousNumber = items[items.length - 2];
            $('#grupo').tagsinput('remove', previousNumber);
            $('#grupo').tagsinput('refresh');
        }
    });

    $('#grupo').on('itemAdded', function(event) {
        // Añadir clase 'error' a los tags que contienen caracteres no numéricos
        var tag = $('.bootstrap-tagsinput').find('.tag').last();
        if (isNaN(event.item)) {
            tag.addClass('error');
        } else {
            tag.removeClass('error');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('solicitudForm').addEventListener('submit', function(event) {
        document.getElementById('aula').removeAttribute('disabled');
        document.getElementById('fecha').removeAttribute('disabled');
        document.getElementById('horario').removeAttribute('disabled');
        event.preventDefault(); // Evitar que el formulario se envíe automáticamente

        // Obtener los datos del formulario
        const formData = new FormData(this);

        // Convertir los datos del formulario a un objeto JSON
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });

        // Imprimir los datos del formulario en la consola
        console.log('Datos del formulario:', JSON.stringify(formDataObject));

        // Obtener el token CSRF
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Configurar la solicitud fetch
        fetch(this.action, {
                method: this.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Solicitud enviada correctamente!',
                        showConfirmButton: false,
                        timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                    }).then(() => {
                        // Después de cerrar la alerta, limpiar el formulario y cerrar el offcanvas
                        document.getElementById('solicitudForm').reset();
                        var offcanvasElement = document.getElementById('offcanvasRight');
                        var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
                        offcanvas.hide();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al enviar la solicitud',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar la solicitud');
            });
    });
});
</script>
@stop
