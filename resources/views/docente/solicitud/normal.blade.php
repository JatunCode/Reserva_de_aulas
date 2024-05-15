@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registrar una Solicitud</h1>
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
    <label for="filtroFecha">Fecha:</label>
    <input type="date" class="form-control" id="filtroFecha" min="{{ date('Y-m-d') }}"required>
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
                        </tbody>
                    </table>
                </div>

                <!-- <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div> -->
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
document.addEventListener('DOMContentLoaded', function() {
    const filtroFechaInput = document.getElementById('filtroFecha');
    const modoInput = document.getElementById('modo');
    const campoRazon = document.getElementById('campoRazon');

    filtroFechaInput.addEventListener('change', function() {
        const fechaSeleccionada = new Date(this.value);
        const fechaActual = new Date();
        fechaActual.setDate(fechaActual.getDate() + 1);

        if (fechaSeleccionada > fechaActual) {
            // Si la fecha seleccionada es mayor a la fecha actual + 2 días, establecer modo como "Normal"
            modoInput.value = 'Normal';
            // Ocultar el campo de razón
            campoRazon.style.display = 'none';
        } else {
            // Si la fecha seleccionada está dentro de los 2 días próximos, establecer modo como "Urgente"
            modoInput.value = 'Urgente';
            // Mostrar el campo de razón
            campoRazon.style.display = 'block';
        }
    });
});
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
        // Evitar que el formulario se envíe automáticamente
        event.preventDefault();

        // Verificar si hay campos vacíos
        const inputs = this.querySelectorAll('input, select, textarea');
        let isValid = true;
        inputs.forEach(input => {
            // Verificar si el campo está vacío y es requerido
            if (input.required && input.value.trim() === '') {
                // Marcar el campo en rojo
                input.style.borderColor = 'red';
                isValid = false;
            } else {
                // Restablecer el color del borde si el campo está lleno
                input.style.borderColor = '';
            }
        });

        // Si hay campos vacíos, detener el envío y mostrar un mensaje
        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, Selecciona una fecha.',
            });
            return;
        }

        // Asignar un valor predeterminado al campo "modo"
        document.getElementById('modo').value = 'Normal';

        // Obtener los datos del formulario y convertirlos en un objeto
        const formData = new FormData(this);
        const formDataObject = {};
        formData.forEach((value, key) => {
            if (key !== '_token') {
                formDataObject[key] = value;
            }
        });

        // Verificar si el modo seleccionado es urgente
        const modo = formData.get('modo');
        if (modo !== 'Urgente') {
            // Eliminar la razón del objeto de datos si el modo no es urgente
            delete formDataObject.razon;
        }

        // Generar el contenido del modal con los datos del formulario
        const modalContent = Object.entries(formDataObject).map(([key, value]) => {
            return `<p><strong>${key}:</strong> ${value}</p>`;
        }).join('');

        // Mostrar el modal de confirmación con los datos del formulario
        Swal.fire({
            icon: 'info',
            title: 'Confirmación de envío',
            html: modalContent,
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario si se confirma la acción
                sendForm(formData);
            }
        });
    });
});

function sendForm(formData) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(document.getElementById('solicitudForm').action, {
        method: 'POST',
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
}
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const grupoInput = document.getElementById('grupo');

    grupoInput.addEventListener('keydown', function(event) {
        let inputValue = grupoInput.value;

        // Convertir todo el texto a mayúsculas
        inputValue = inputValue.toUpperCase();

        // Mantener solo números, letras y comas
        inputValue = inputValue.replace(/[^0-9A-Z,]/g, '');

        // Si la tecla presionada es espacio (código 32), agregar una coma
        if (event.keyCode === 32) {
            // Obtener la última parte de la cadena después de la última coma
            const lastPart = inputValue.split(',').pop().trim();

            // Si la última parte no está vacía, agregar una coma
            if (lastPart !== '') {
                inputValue += ',';
            }
        }

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
