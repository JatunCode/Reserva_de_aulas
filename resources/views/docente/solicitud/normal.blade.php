@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Solictud Normal</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <!-- En pantallas grandes, ocupa la mitad del ancho; en dispositivos móviles ocupa todo el ancho -->
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="card-title">Formulario</h3>
                </div>
                <div class="card-body">
                    @include('docente.components.formularioSolicitudNormal')
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <!-- En pantallas grandes, ocupa la mitad del ancho; en dispositivos móviles ocupa todo el ancho -->
            <div class="card h-100">
                <div class="card-header">
                    <h3 class="card-title">Horarios disponibles</h3>
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="filtroFecha">fecha:</label>
                        <input type="date" class="form-control" id="filtroFecha">

                    </div>
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
                        <tbody id="tablaSolicitudes">
                            <!-- Aquí se mostrarán las solicitudes según la fecha seleccionada -->
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
        </div>
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="/css/docente/reservas.css">
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
</script>



<script>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const grupoInput = document.getElementById('grupo');

    grupoInput.addEventListener('input', function(event) {
        let inputValue = grupoInput.value;

        // Mantener solo números, comas y guiones
        inputValue = inputValue.replace(/[^0-9,\-]/g, '');

        // Actualizar el valor del campo de entrada con la entrada filtrada
        grupoInput.value = inputValue;
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('container');
    const addButton = container.querySelector('.agregar-nombre');

    addButton.addEventListener('click', function() {
        const inputs = container.querySelectorAll('.nombre-input');
        let lastVisibleIndex = -1;

        inputs.forEach((input, index) => {
            if (!input.classList.contains('invisible')) {
                lastVisibleIndex = index;
            }
        });

        if (lastVisibleIndex < 4) {
            const nextIndex = lastVisibleIndex + 1;
            const newInput = document.createElement('div');
            newInput.classList.add('input-group', 'mb-2');
            newInput.innerHTML = `
                <input type="text" class="form-control nombre-input" placeholder="Ingrese su nombre" name="nombre${nextIndex}" id="nombre${nextIndex}">
                <button class="btn btn-danger eliminar-nombre" type="button">
                    <i class="bi bi-trash"></i>
                </button>
            `;
            insertAfter(newInput, inputs[lastVisibleIndex].parentNode);

            // Agregar event listener al botón de eliminar
            const deleteButton = newInput.querySelector('.eliminar-nombre');
            deleteButton.addEventListener('click', function() {
                newInput.remove();
            });
        }
    });
});

function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const filtroFechaInput = document.getElementById('filtroFecha');
    const tablaSolicitudes = document.getElementById('tablaSolicitudes');

    filtroFechaInput.addEventListener('change', function() {
        const fechaSeleccionada = this.value;
        const solicitudes = @json($solicitudes); // Convertir las solicitudes a un array JavaScript

        // Filtrar las solicitudes por la fecha seleccionada
        const solicitudesFiltradas = solicitudes.filter(solicitud => solicitud.fecha ===
            fechaSeleccionada);

        if (fechaSeleccionada === '') {
            // Mostrar un mensaje cuando no hay fecha seleccionada
            tablaSolicitudes.innerHTML = '<tr><td colspan="5">Seleccione una fecha</td></tr>';
        } else if (solicitudesFiltradas.length === 0) {
            // Mostrar un mensaje cuando no hay datos para la fecha seleccionada
            tablaSolicitudes.innerHTML =
                '<tr><td colspan="5">No hay ambientes disponibles en esta fecha</td></tr>';
        } else {
            // Generar el HTML de las filas de la tabla
            const tablaHTML = solicitudesFiltradas.map(solicitud => `
                <tr>
                    <td>${solicitud.id}</td>
                    <td>${solicitud.aula}</td>
                    <td>${solicitud.horario}</td>
                    <td>${solicitud.fecha}</td>
                    <td>
                        <button class="btn btn-sm btn-success solicitar-btn" type="button"
                            data-aula="${solicitud.aula}" data-horario="${solicitud.horario}"
                            data-fecha="${solicitud.fecha}">
                            Seleccionar
                        </button>
                    </td>
                </tr>
            `).join('');

            // Mostrar las filas en la tabla
            tablaSolicitudes.innerHTML = tablaHTML;
        }
    });

    // Función para escuchar eventos en botones de solicitud (si es necesario)
    tablaSolicitudes.addEventListener('click', function(event) {
        if (event.target.classList.contains('solicitar-btn')) {
            const button = event.target;
            const aula = button.getAttribute('data-aula');
            const horario = button.getAttribute('data-horario');
            const fecha = button.getAttribute('data-fecha');
            console.log(aula);

            document.getElementById("aula").value = aula;
            document.getElementById("horario").value = horario;
            document.getElementById("fecha").value = fecha;
        }
    });
});
</script>

@stop
