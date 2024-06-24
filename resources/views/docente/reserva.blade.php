@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Visualizar reservas de docente</h1>
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
                    <option value="NORMAL">Normal</option>
                    <option value="URGENTE">Urgente</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 align-self-center">
                <label for="selectStatus" class="mr-2">Estado:</label>
                <select class="form-control" id="selectStatus">
                    <option value="Todos" selected>Todos</option>
                    <option value="ACEPTADO">Reservado</option>
                    <option value="PENDIENTE">Solicitando</option>
                    <option value="CANCELADO">Cancelado</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 ml-auto align-self-center">
                <label for="selectMode" class="mr-2"></label>
                <button type="button" id="btnBuscar" class="btn btn-primary w-100" style="background-color: green">Buscar</button>
    
            </div>
        </form>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">Fecha solicitud</th>
                    <th>Aula</th>
                    <th>Horario</th>
                    <th>Fecha reserva</th>
                    <th>Materia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id='tablaReservas'>
                @foreach($solis_no_reser as $solicitud)
                <tr>
                    <td>{{ $solicitud['FECHA_HORASOLI'] }}</td>
                    <td>{{ $solicitud['AMBIENTE'] }}</td>
                    <td>{{ $solicitud['HORARIO'] }}</td>
                    <td>{{ $solicitud['FECHA_RESERVA'] }}</td>
                    <td>{{ $solicitud['MATERIA'] }}</td>
                    <td>
                        <button class="btn btn-sm btn-info solicitar-btn" type="button"
                            data-id="{{ $solicitud['ID'] }}" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                            value="{{ $solicitud['ID'] }}">
                            VER INFORMACION
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


@include('docente.components.formularioReserva')



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
    const soli_pend = @json($solis_no_reser);
    let soli_aten = null;
    console.log('Solicitudes: ', soli_pend);
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener los botones de solicitud
        var solicitarButtons = document.querySelectorAll(".solicitar-btn");
        // Agregar un event listener a cada botón
        solicitarButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                const id = event.target.value;
                const canva = document.getElementById('offcanvasRight');
                canva.style.setProperty('width', '500px');
                soli_aten = soli_pend.find(elemento => elemento['ID'] == id);
                console.log('Solicitud: ', soli_aten);
                if(soli_aten){
                    const docentes = document.getElementById('docentes');
                    const fechasoli = document.querySelector('[name="fechasoli"]');
                    const fechares = document.querySelector('[name="fechares"]');
                    const capacidad = document.querySelector('[name="capacidad"]');
                    const grupos = document.querySelector('[name="grupos"]');
                    const materia = document.querySelector('[name="materia"]');
                    const ambiente = document.querySelector('[name="ambiente"]');
                    const horario = document.querySelector('[name="horario"]');
                    const motivo = document.querySelector('[name="motivo"]');
                    const modo = document.querySelector('[name="modo"]');
                    const div = document.getElementById('desc-modo');;
                    docentes.innerHTML = '';
                    soli_aten['NOMBRE_DOCENTES'].forEach(element => {
                        docentes.innerHTML +=`<input type="text" class="form-control" value="${element['Nombre_docente']}" readonly>`
                    });
                    fechasoli.value = soli_aten['FECHA_HORASOLI'];
                    fechares.value = soli_aten['FECHA_RESERVA'];
                    capacidad.value = soli_aten['CANTIDAD'];
                    grupos.value = soli_aten['GRUPOS'];
                    materia.value = soli_aten['MATERIA'];
                    ambiente.value = soli_aten['AMBIENTE'];
                    horario.value = soli_aten['HORARIO'];
                    motivo.value = soli_aten['MOTIVO'];
                    modo.value = soli_aten['MODO'];
                }else{
                    console.log("Fallo al obtener los datos alv no puede ser >:VVVVVVVV");
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnBuscar").addEventListener('click', function() {
            const input_busqueda = document.getElementById('inputSearch')
            const input_modo = document.getElementById('selectMode')
            const input_estado = document.getElementById('selectStatus')
            console.log('Input modo: ', input_modo)
            const materia = input_busqueda.options[input_busqueda.selectedIndex].value
            const modo_value = input_modo.options[input_modo.selectedIndex].value
            const estado_value = input_estado.options[input_estado.selectedIndex].value

            console.log('Dato busqueda: ', input_busqueda)
            console.log('Dato modo: ', modo_value)

            const filtroSolis = soli_pend.filter(solicitud => {
                                const materiaMatch = (materia === 'TODAS LAS MATERIAS' || solicitud.MATERIA == materia.toUpperCase())
                                const modoMatch = (modo_value === 'Todos' || solicitud.MODO === modo_value.toUpperCase())
                                const estadoMatch = (estado_value === 'Todos' || solicitud.ESTADO == estado_value.toUpperCase())
                                return materiaMatch && modoMatch && estadoMatch
                                })
            const tabla = document.getElementById('tablaReservas')
            console.log('Arreglo ambientes: ', filtroSolis)
            agregarTabla(filtroSolis, tabla)
        });
    });

    function agregarTabla(data, tabla) {
        // Eliminar los elementos existentes en el cuerpo de la tabla
        tabla.innerHTML = '';
        let contador = 1;
        // Iterar sobre los nuevos datos y agregar cada solicitud como una fila en la tabla
        data.forEach(solicitud => {
            // Crear una nueva fila
            var row = document.createElement('tr');
            
            // Agregar las celdas con los datos de la solicitud a la fila
            row.innerHTML = `
                
                <td>${solicitud['FECHA_HORASOLI']}</td>
                <td>${solicitud['AMBIENTE']}</td>
                <td>${solicitud['HORARIO']}</td>
                <td>${solicitud['FECHA_RESERVA']}</td>
                <td>${solicitud['MATERIA']}</td>
                <td >
                    <span class="btn  btn-sm btn-block" style="background-color: ${solicitud['MODO'] === 'NORMAL' ? '#198754' : '#dc3545'};color: white">
                        ${(isObject(solicitud['MODO']) || solicitud['MODO'].includes('URGENTE'))? 'URGENTE': 'NORMAL'}
                    </span>
                </td>

                <td style="width: 40px"><button class="btn btn-sm btn-info solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                    data-id="${solicitud['ID']}" value="${solicitud['ID']}">Atender</button>
                </td>
            `;
            
            // Agregar la fila al cuerpo de la tabla
            tabla.appendChild(row);
        });
    }

    function isObject(params) {
        return typeof params === "object" && params !== null
    }
</script>

{{-- 

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
</script> --}}

@stop