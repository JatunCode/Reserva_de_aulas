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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Aula</th>
                                <th>Horario</th>
                                <th>Fecha</th>
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
    let solicitudes = [];
    document.addEventListener('DOMContentLoaded', function() {
        const filtroFechaInput = document.getElementById('filtroFecha');
        const ambiente = document.getElementById('aula');
        const modoInput = document.getElementById('modo');
        const campoRazon = document.getElementById('campoRazon');
        const tabla = document.getElementById('tablaSolicitudes');

        filtroFechaInput.addEventListener('change', function() {
            const fechaSeleccionada = new Date(this.value);
            const fechaActual = new Date();
            console.log("Fecha de reserva: ", filtroFechaInput.value);
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
        
        ambiente.addEventListener('change', function(event){
            let fecha = filtroFechaInput.value;
            console.log("Fecha de reserva: ", fecha);
            if(fecha != ''){
                fetch(
                    'http://127.0.0.1:8000/api/fetch/solicitudeslibres/'+ambiente.value+'/'+fecha
                ).then(
                    response => response.json()
                ).then(
                    data => {
                        solicitudes = data;
                        tabla.innerHTML = '';
                        solicitudes.forEach(solicitud =>{
                            tabla.innerHTML += `
                                    <tr>
                                        <td></td>
                                        <td>${solicitud['AMBIENTE']}</td>
                                        <td>${solicitud['HORARIO']}</td>
                                        <td>${fecha}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success solicitar-btn" type="button"
                                                data-aula="${solicitud['AMBIENTE']}" data-horario="${solicitud['HORARIO']}"
                                                data-fecha="${fecha.value}">
                                                Seleccionar
                                            </button>
                                        </td>
                                    </tr>`
                        });
                    }
                ).catch(
                    error => {
                        console.log("Error encontrado: ", error);
                    }
                );
                console.log("Solicitudes libres: ", solicitudes);
                // Mostrar las filas en la tabla
                // tabla.innerHTML = tablaHTML;
            }
        });
    });
</script>
{{-- 
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
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('solicitudForm').addEventListener('submit', function(event) {
            // Evitar que el formulario se envíe automáticamente
            event.preventDefault();

            // Verificar si hay campos vacíos
            const inputs = this.querySelectorAll('input, select, textarea');
            const input_nombre = this.querySelectorAll('[name="nombre"]');
            const input_materia = this.querySelector('[name="materia"]');
            const dato_materia = input_materia.options[input_materia.selectedIndex].value;
            const input_cant = this.querySelector('[name="cantidad_estudiantes"]').value;
            const input_motivo = this.querySelector('[name="motivo"]');
            const dato_motivo = input_motivo.options[input_motivo.selectedIndex].value;
            const input_fecha = this.querySelector('[name="filtroFecha"]').value;
            const input_razon = this.querySelector('[name="razon"]').value;
            let prioridad = (input_razon != "") ? {"URGENTE" : input_razon} : {"NORMAL" : "Normal"};
            const input_aula = this.querySelector('[name="aula"]').value;
            const input_horario = this.querySelector('[name="horario"]').value;
            let arreglo_horario = input_horario.split(" - ");
            let arreglo_nombres = Array.from(input_nombre).map(element => element.value);

            let json_prioridad = JSON.stringify(prioridad);
            let json_nombres = JSON.stringify(arreglo_nombres);

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

            const json_send = {
                'NOMBRES':json_nombres,
                'CANTIDAD':parseInt(input_cant, 10),
                'FECHA_RESERVA':input_fecha+' '+arreglo_horario[0],
                'HORA_INICIO':arreglo_horario[0],
                'HORA_FIN':arreglo_horario[1],
                'PRIORIDAD':json_prioridad,
                'MOTIVO':dato_motivo,
                'MATERIA':dato_materia,
                'AMBIENTE':input_aula
            };

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
                    console.log("Formato del json: ", json_send);
                    sendForm(json_send);
                }
            });
        });
    });

    function sendForm(formData) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const body = {
            'NOMBRES': formData['NOMBRES'],
            'TIPO': 'Solicitud',
            'FECHA':formData['FECHA_RESERVA'],
            'MATERIA':formData['MATERIA'],
            'AMBIENTE':formData['AMBIENTE']
        }
        const json_send = JSON.stringify(formData)
        fetch(document.getElementById('solicitudForm').action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: json_send,
        })
        .then(response => {

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Solicitud enviada correctamente!',
                    text: 'Enviando notificacion a su correo.',
                    showConfirmButton: false,
                    timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al enviar la solicitud',
                });
            }
            return sendNotificacion({
                                'TOKEN':csrfToken, 
                                'BODY': body
                            });
        }).then(notificationResponse => {
            if (notificationResponse) {
                console.log('Notificación enviada correctamente');
            } else {
                console.error('Error al enviar la notificación: ', notificationResponse.body);
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Error al enviar la solicitud');
        });
    }

    function sendNotificacion(data){
        const cuerpo = JSON.stringify(data['BODY'])
        fetch('http://127.0.0.1:8000/api/fetch/notificacion/store',
            {
                method:'POST', 
                headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': data['TOKEN']
                },
                body:cuerpo
            }
        ).then(
            response => response.json().then(data => JSON.stringify({status: response.status, body: data}))
        ).then(
            response => {
                    if (response.status == 200) {
                        return response;
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al enviar la notificación',
                        });
                        console.log('Response: ', response);
                    }
            }
        ).catch(
            error => {
                console.log('Error del servidor: ', error)
            }
        )
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
                    <input type="text" class="form-control nombre-input" placeholder="Ingrese su nombre" name="nombre" id="nombre${nextIndex}">
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
// document.addEventListener("DOMContentLoaded", function() {
//     const ambiente = document.getElementById('aula');
//     const tablaSolicitudes = document.getElementById('tablaSolicitudes');

//     ambiente.addEventListener('change', function() {
//         const fechaSeleccionada = this.value;
//         const solicitudes = @json($solicitudes); // Convertir las solicitudes a un array JavaScript

//         // Filtrar las solicitudes por la fecha seleccionada
//         const solicitudesFiltradas = solicitudes.filter(solicitud => solicitud.fecha ===
//             fechaSeleccionada);

//         if (fechaSeleccionada === '') {
//             // Mostrar un mensaje cuando no hay fecha seleccionada
//             tablaSolicitudes.innerHTML = '<tr><td colspan="5">Seleccione una fecha</td></tr>';
//         } else if (solicitudesFiltradas.length === 0) {
//             // Mostrar un mensaje cuando no hay datos para la fecha seleccionada
//             tablaSolicitudes.innerHTML =
//                 '<tr><td colspan="5">No hay ambientes disponibles en esta fecha</td></tr>';
//         } else {
//             // Generar el HTML de las filas de la tabla
           
//             const tablaHTML = solicitudesFiltradas.map(solicitud => `
//                 <tr>
//                     <td></td>
//                     <td>${solicitud.aula}</td>
//                     <td>${solicitud.horario}</td>
//                     <td>${solicitud.fecha}</td>
//                     <td>
//                         <button class="btn btn-sm btn-success solicitar-btn" type="button"
//                             data-aula="${solicitud.aula}" data-horario="${solicitud.horario}"
//                             data-fecha="${solicitud.fecha}">
//                             Seleccionar
//                         </button>
//                     </td>
//                 </tr>
//             `).join('');

//             // Mostrar las filas en la tabla
//             tablaSolicitudes.innerHTML = tablaHTML;
//         }
//     });

//     // Función para escuchar eventos en botones de solicitud (si es necesario)
//     tablaSolicitudes.addEventListener('click', function(event) {
//         if (event.target.classList.contains('solicitar-btn')) {
//             const button = event.target;
//             const aula = button.getAttribute('data-aula');
//             const horario = button.getAttribute('data-horario');
//             const fecha = button.getAttribute('data-fecha');
//             console.log(aula);

//             document.getElementById("aula").value = aula;
//             document.getElementById("horario").value = horario;
//             document.getElementById("fecha").value = fecha;
//         }
//     });
// });
</script>

@stop
