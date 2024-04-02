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
                    <th>Fecha </th>
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


@include('docente.components.formularioSolicitud')



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
    const modoSelect = document.getElementById('modo');
    const campoRazon = document.getElementById('campoRazon');
    const campoRazonInput = document.querySelector('.comentarios textarea');

    modoSelect.addEventListener('change', function() {
        if (modoSelect.value === 'Urgencia') {
            campoRazon.style.display = 'block';
            campoRazonInput.required = true;
        } else {
            campoRazon.style.display = 'none';
            campoRazonInput.required = false;
        }
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

        if (lastVisibleIndex < 5) {
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

@stop