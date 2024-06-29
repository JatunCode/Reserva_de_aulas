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
                    <span class="text-primary">
                        <i class="bi bi-info-circle"></i>
                    </span>
                    <div id="reglas" style="display: none">
                        <strong>*Debe seleccionar una materia antes de seleccionar el docente</strong>
                        <br>
                        <strong>*Presione cualquier vocal para ver la lista de docentes</strong>
                        <br>
                        <strong>*Solo se podra realizar reservas dos horas antes de la hora actual</strong>
                        <br>
                        <strong>*Las solicitudes que se realicen los Sabados luego de las 12:45 seran canceladas de inmediato</strong>
                        <br>
                        <strong>*Las solicitudes que sean menores de 5 horas seran atedidas por el administrador</strong>
                        <br>
                        <strong>*Las solicitudes que sean menores a un minuto de la hora actual y sigan pendientes se cancelaran</strong>
                        <br>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
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
<style>
    #lista-docentes {
        position: absolute;
        z-index: 1000;
        background-color: white;
        width: calc(100% - 2px);
        border: 1px solid #ccc;
        border-radius: 4px;
        max-height: 200px;
        overflow-y: auto;
    }

    #listaGrupos {
        display: none;
        position: absolute;
        border: 1px solid #ccc;
        background-color: white;
        z-index: 1000;
        max-height: 150px;
        overflow-y: auto;
    }
    .list-group-item {
        padding: 10px;
        cursor: pointer;
    }
    .list-group-item:hover {
        background-color: #f0f0f0;
    }
</style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    let solicitudes = [];
    let ambientes = [];
    let docentes = [];
    let solicitudes_actuales = [];
    let bandera = false;

    let countPendientes = 0
    let countUrgentes = 0

    let banderaMateria = false;
    let banderaDocente = false;
    let banderaGrupo = false;
    let banderaCant = false;
    let banderaMotivo = false;
    let banderaFecha = false;
    let banderaHorario = false;

    const messageMateria = document.getElementById('messageErrorMateria');
    const messageGrupo = document.getElementById('messageErrorGrupo');
    const messageDocente = document.getElementById('messageErrorDocente');
    const messageCantidad = document.getElementById('messageErrorCantidad');
    const messageMotivo = document.getElementById('messageErrorMotivo');
    const messageFecha = document.getElementById('messageErrorFecha');
    const messageHorario = document.getElementById('messageErrorHorario');
    
    fetch("http://127.0.0.1:8000/api/fetch/solicitud/count")
        .then(response => response.json())
        .then(data => {
            countPendientes = data['pendientes']
            countUrgentes = data['urgentes']
            console.log('Datos: ', data)
        })
        .catch(error => {
            console.log("Error al obtener los conteos de datos.", error)
        })

    fetch(
        'http://127.0.0.1:8000/api/fetch/ambientes'
    ).then(
        response => response.json()
    ).then(
        data => {
            ambientes = data;
        }
    ).catch(
        error => {
            console.log('Error encontrado: ', error);
        }
    )

    fetch(
        'http://127.0.0.1:8000/api/fetch/docente/materias/grupos'
    ).then(
        response => response.json()
    ).then(
        data => {
            docentes = data;
        }
    ).catch(
        error => {
            console.log('Error encontrado: ', error);
        }
    )

    fetch(
        'http://127.0.0.1:8000/api/fetch/solicitudes'
    ).then(
        response => response.json()
    ).then(
        data => {
            solicitudes_actuales = data;
        }
    ).catch(
        error => {
            console.log('Error encontrado: ', error);
        }
    )

    const input_hora = document.getElementById('horario');

    document.addEventListener('DOMContentLoaded', function() {
        const filtroFechaInput = document.getElementById('filtroFecha');
        const ambiente = document.getElementById('aula');
        const modoInput = document.getElementById('modo');
        const cantidad = document.getElementById('cantidad_estudiantes');
        const campoRazon = document.getElementById('campoRazon');
        const tabla = document.getElementById('tablaSolicitudes');
        const info = document.querySelector('span.text-primary > i.bi.bi-info-circle');
        const reglas = document.getElementById('reglas');

        cantidad.addEventListener('keydown', function(event){
            ambiente.innerHTML = '';
            let ambientes_filtro = [];
            ambientes_filtro = obtenerAmbientes(parseInt(event.target.value));
            if(event.target.value !== ''){
                ambientes_filtro.forEach(
                    element => {
                        ambiente.innerHTML += `
                            <option value="${element['NOMBRE']}">${element['NOMBRE']}</option>
                        `;
                        console.log('Ambientes en lista: ', element);
                    }
                );
            }
        });

        // cantidad.addEventListener('input', function(event) {
        //     const button = document.getElementById('add-ambientes');
        //     if(event.target.value < 1){
        //         button.disabled = true;
        //     }else{
        //         button.disabled = false;
        //     }
        // });

        filtroFechaInput.addEventListener('change', function() {
            let fechaSeleccionada = new Date(this.value);
            const fechaActual = new Date();
            
            const hora_actual = new Date(fechaActual.getTime());
            hora_actual.setHours(hora_actual.getHours()+2);
            let inicio = null;
            let fin = null;
            let hora_ini = null;
            let hora_fin = null;
            if(hora_actual.getHours() > 21 || hora_actual.getHours() < 6){
                hora_actual.setHours(6);
                hora_actual.setMinutes(45);
                inicio = formatTime(hora_actual.getHours(), hora_actual.getMinutes());
                hora_fin = new Date(hora_actual.getTime() + 1.5 * 60 * 60 * 1000);
                fin = formatTime(hora_fin.getHours(), hora_fin.getMinutes());
                input_hora.value = `${inicio} - ${fin}`;
                fechaSeleccionada.setDate(fechaSeleccionada.getDate() + 1);
                this.value = formatDate(fechaSeleccionada);
                console.log('If del time');
            }else{
                hora_ini = new Date(hora_actual.getTime() + 1.5 * 60 * 60 * 1000);
                inicio = formatTime(hora_ini.getHours(), hora_ini.getMinutes());
                hora_fin = new Date(hora_ini.getTime() + 1.5 * 60 * 60 * 1000);
                fin = formatTime(hora_fin.getHours(), hora_fin.getMinutes());
                input_hora.value = `${inicio} - ${fin}`;
                console.log('Else del time');
            }

            console.log("Fecha de reserva: ", filtroFechaInput.value);
            console.log('Fecha del input: ', fechaSeleccionada);
            fechaActual.setDate(fechaActual.getDate() + 1);

            if (fechaSeleccionada > fechaActual) {
                // Si la fecha seleccionada es mayor a la fecha actual + 2 días, establecer modo como "Normal"
                modoInput.value = 'Normal';
            } else {
                // Si la fecha seleccionada está dentro de los 2 días próximos, establecer modo como "Urgente"
                modoInput.value = 'Urgente';
            }

            actualizarTabla();
        });

        ambiente.addEventListener('change', function() {
            actualizarTabla();
        });

        input_hora.addEventListener('input', function() {
            this.value = this.value.replace(/[a-zA-Z]/g, '');
        });

        function actualizarTabla() {
            const fecha = filtroFechaInput.value;
            const aulaSeleccionada = ambiente.value;
            const cadena = 'http://127.0.0.1:8000/api/fetch/solicitudeslibres/'+ambiente.value+'/'+fecha
            console.log('Cadena fetch: ', cadena);
            if (fecha !== '' && aulaSeleccionada !== '') {
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
                                            <td>${solicitud['AMBIENTE']}</td>
                                            <td>${solicitud['HORARIO']}</td>
                                            <td>${fecha}</td>
                                            <td>
                                                <button type="button" id="btn-${solicitud['ID']}" class="btn btn-success btn-sm" onclick="agregarHorario('${solicitud['HORARIO']}')">SELECCIONAR</button>
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
                }
            }

        }

        function obtenerAmbientes(cant){
            return ambientes.filter(
                ambiente => {
                    let num_div = cant/10
                    return (ambiente['CAPACIDAD'] <= num_div*10+10 && ambiente['CAPACIDAD'] >= num_div*10-10)
                }
            )
        }

        function formatTime(hours, minutes) {
            return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        }

        function formatDate(date) {
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${year}-${month}-${day}`;
        }

        info.addEventListener('click', function(event){
            if (reglas.style.display === 'block') {
                reglas.style.display = 'none';
            } else {
                reglas.style.display = 'block';
            }
        });
    });
    function agregarHorario(horario) {
        input_hora.value = horario;
        banderaFecha = true;
    }
</script>

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
            const input_modo = this.querySelector('[name="modo"]').value;
            let prioridad = (input_modo.toUpperCase() != "NORMAL") ? {"URGENTE" : dato_motivo} : {"NORMAL" : "Normal"};
            const input_aula = this.querySelector('[name="aula"]');
            const dato_aula = (input_aula.options[input_aula.selectedIndex]) ? input_aula.options[input_aula.selectedIndex].value:'';
            const input_horario = this.querySelector('[name="horario"]').value;
            const input_horario2 = this.querySelector('[name="horario"]');
            const input_grupo = this.querySelector('[name="grupo"]');
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

            //document.getElementById('modo').value = 'Normal';
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
                'AMBIENTE':dato_aula,
                'GRUPOS':JSON.stringify(input_grupo)
            };

            verificarMateria(dato_materia);
            console.log('Bandera materia: ', banderaMateria);
            verificarDocente(input_nombre);
            console.log('Bandera nombre: ', banderaDocente);
            console.log('Bandera grupo: ', banderaGrupo);
            console.log('Bandera cantidad: ', banderaCant);
            verificarMotivo(input_motivo);
            console.log('Bandera motivo: ', banderaMotivo);
            console.log('Bandera fecha: ', banderaFecha);
            verificarHorario(input_horario2);
            console.log('Bandera horario: ', banderaHorario);
            bandera = banderaMateria && banderaDocente && banderaGrupo && banderaCant && banderaMotivo && banderaFecha && banderaHorario
            // Mostrar el modal de confirmación con los datos del formulario
            if(bandera){
                Swal.fire({
                    icon: 'info',
                    title: 'Confirmación de creacion',
                    html: modalContent,
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario si se confirma la acción
                        console.log("Formato del json: ", json_send);
                        sendForm(json_send);
                    }
                });
            }
        });
    });

    function mensaje(){
        Swal.fire({
            title: "<strong>Tiene solicitudes por atender</strong>",
            html: `<strong>Solicitudes pendientes: ${countPendientes}</strong>
                    <br>
                    <strong style="color: red">Solicitudes urgentes: ${countUrgentes}</strong>
                `,
            showCancelButton:true,
            showDenyButton:true,
            cancelButtonColor: "#ADD8E6",
            cancelButtonText: "Crear nueva solicitud",
            denyButtonColor: "#ffff00",
            denyButtonText: "Ver reservas",
            confirmButtonColor: "#7ebd5b",
            confirmButtonText: "Ver solicitudes",
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
                window.location.href = "http://127.0.0.1:8000/admin/reservas/atencion"
            }else if(result.isDenied){
                window.location.href = "http://127.0.0.1:8000/admin/reservas/cancelar"
            }else{
                window.location.reload()
            }
        })
    }

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
        console.log('Datos: ', json_send);
        fetch('http://127.0.0.1:8000/admin/solicitud/create', {
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
                sendNotificacion({
                                'TOKEN':csrfToken, 
                                'BODY': body
                            })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Error al enviar la solicitud',
                });
            }
        }).then(
            data => {
                console.log("Datos: ", data);
            }
        ).catch(error => {
            console.error('Error:', error);
            alert('Error al enviar la solicitud');
        });
    }

    function sendNotificacion(data){
        const cuerpo = JSON.stringify(data['BODY'])
        console.log('Cuerpo de la notificacion: ', cuerpo)
        Swal.fire({
            title: 'Enviando notificacion al o los docentes.',
            text: 'Por favor, espera.',
            didOpen: () => {
                Swal.showLoading();
            }
        })
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
                    Swal.close();
                    mensaje();
                    if (response.status == 200) {
                        return response;
                    } else {
                        console.log('Response: ', response);
                    }
            }
        ).catch(
            error => {
                console.log('Error del servidor: ', error);
            }
        )
    }

    function verificarMateria(text){
        if(text == 'ninguno'){
            banderaMateria = false;
            messageMateria.textContent = '*Seleccione una materia';
            messageMateria.style.display = 'block';
        }else{
            banderaMateria = true;
            messageMateria.textContent = '';
            messageMateria.style.display = 'none';
        }
    }

    function verificarDocente(inputsDocentes){
        let allFill = true;
        let encontrado = true;
        inputsDocentes.forEach(input => {
            if (input.value.trim() === '') {
                allFill = false;
            }else if(!docentes_relacionados.find(docente => docente['NOMBRE_DOCENTE'] == input.value.trim())){
                encontrado = false;
            }
        });

        console.log('Bandera allfill: ', allFill);
        console.log('Bandera encontrado: ', encontrado);
        if(allFill == false){
            banderaDocente = false;
            messageDocente.textContent = '*Debe completar los campos vacios o eliminarlos';
            messageDocente.style.display = 'block';
        }else if(encontrado == false){
            banderaDocente = false;
            messageDocente.textContent = '*El docente no es de la materia';
            messageDocente.style.display = 'block';
        }else{
            banderaDocente = true;
            messageDocente.textContent = '';
            messageDocente.style.display = 'none';
        }
    }

    function verificarGrupo(text){
        const new_text = text.value;
        if(new_text == ''){
            banderaGrupo = false;
            messageGrupo.textContent = '*Debe completar el campo';
            messageGrupo.style.display = 'block';
        }else if(!grupos_relacionados.find(grupo => grupo['GRUPO'] == new_text)){
            banderaGrupo = false;
            messageGrupo.textContent = '*El grupo no es del docente';
            messageGrupo.style.display = 'block';
        }else{
            banderaGrupo = true;
            messageGrupo.textContent = '';
            messageGrupo.style.display = 'none';
        }
    }

    function verificarCantidad(text){
        const new_text = text.value;
        if(new_text == ''){
            banderaCant = false;
            messageCantidad.textContent = '*Debe completar el campo';
            messageCantidad.style.display = 'block';
        }else if(parseInt(new_text, 10) <= 0){
            banderaCant = false;
            messageCantidad.textContent = '*La cantidad debe ser mayor a 0';
            messageCantidad.style.display = 'block';
        }else if(parseInt(new_text, 10) < 1 || parseInt(new_text, 10) > 250){
            banderaCant = false;
            messageCantidad.textContent = '*La cantidad debe ser entre 1 y 250';
            messageCantidad.style.display = 'block';
        }else{
            banderaCant = true;
            messageCantidad.textContent = '';
            messageCantidad.style.display = 'none';
        }
    }

    function verificarMotivo(text){
        if(text == 'ninguno'){
            banderaMotivo = false;
            messageMotivo.style.display = 'block';
        }else{
            banderaMotivo = true;
            messageMotivo.style.display = 'none';
        }
    }

    function verificarFecha(text){
        const new_text = text.value;
        if(new_text == ''){
            banderaFecha = false;
            messageFecha.style.display = 'block';
        }else{
            banderaFecha = true;
            messageFecha.style.display = 'none';
        }
    }

    function verificarDuracion(horaInicio, horaFin, duracionMinima, duracionMaxima) {
        const duracion = horaFin - horaInicio;
        return duracion >= duracionMinima && duracion <= duracionMaxima;
    }

    function verificarRangoHorario(horaInicio, horaFin, horaMin, horaMax) {
        return horaInicio >= horaMin && horaFin <= horaMax;
    }

    function verificarHorarioPasado(horaInicio, horaActual, fecha_seleccionada) {
        const actual = new Date();
        const fecha_actual = actual.getDate();
        console.log('Fecha actual: ', fecha_actual);
        console.log('Fecha seleccionada: ', fecha_seleccionada);
        return horaInicio >= horaActual || fecha_actual !== fecha_seleccionada+1;
    }

    function showMessage(element_dom, message, estado){
        element_dom.textContent = message;
        element_dom.style.display = estado;
    }

    function parseTime(timeString) {
        if(timeString != ''){
            const [hours, minutes] = timeString.split(':').map(Number);
            const date = new Date();
            date.setHours(hours, minutes, 0, 0);
            return date;
        }
    }

    function encontrarSolicitud(hora_inicio){
        const ambiente = document.getElementById('aula').value;
        let bandera = true;
        if(solicitudes_actuales.find( 
            solicitud => solicitud['NOMBRE_AMBIENTE'] === ambiente && solicitud['HORA_INICIO'] === hora_inicio
        )){
            bandera = false;
        }
        return bandera;
    }

    function verificarHorario(text){
        fechaSeleccionada = new Date(document.getElementById('filtroFecha').value)
        const new_text = text.value;
        console.log('TExto del horario: ', new_text);
        console.log('Tipo de texto: ', typeof new_text);

        const hora = (new_text.includes('-')) ? new_text.split(' - '):[];
        const fecha_actual = new Date();
        const hora_actual = fecha_actual.getHours() * 60 + fecha_actual.getMinutes();
        const hora_inicio = (hora.length > 0 && new_text.includes(':')) ? parseTime(hora[0]):'';
        const hora_fin = (hora.length > 0 && new_text.includes(':')) ? parseTime(hora[1]):'';
        const hora_min = parseTime('06:45');
        const hora_max = parseTime('21:45');
        
        let horaInicioMinutos = (hora.length > 0) ? hora_inicio.getHours() * 60 + hora_inicio.getMinutes():0;
        let horaFinMinutos =  (hora.length > 0) ? hora_fin.getHours() * 60 + hora_fin.getMinutes():0;

        const duracionMinima = 1.5 * 60; 
        const duracionMaxima = 4.5 * 60; 

        let duracion = horaFinMinutos - horaInicioMinutos;

        if(new_text === ''){
            banderaHorario = false;
            showMessage(messageHorario,'*Debe ingresar o seleccionar un horario', 'block');
        } else if(hora_inicio >= hora_fin || hora.length == 0 || hora_inicio == '' || hora_fin == ''){
            banderaHorario = false;
            showMessage(messageHorario, '*Formato de horario incorrecto', 'block');
        } else if(verificarRangoHorario(horaInicioMinutos, horaFinMinutos, hora_min, hora_max)){
            banderaHorario = false;
            showMessage(messageHorario, '*Rango de horario: 06:45 - 21:45', 'block');
        } else if(!verificarHorarioPasado(horaInicioMinutos, hora_actual, fechaSeleccionada.getDate())){
            banderaHorario = false;
            showMessage(messageHorario, '*El horario que ingreso ya paso', 'block');
        }else if(!verificarDuracion(horaInicioMinutos, horaFinMinutos, duracionMinima, duracionMaxima)){
            banderaHorario = false;
            showMessage(messageHorario, '*El horario debe ser mayor a 1.50 horas y menor a 4.50 horas.', 'block');
        }else if(!encontrarSolicitud(hora_inicio)){
            banderaHorario = false;
            showMessage(messageHorario, '*Existe una reserva en la misma hora.', 'block');
        }else{
            banderaHorario = true;
            showMessage(messageHorario, '', 'none');
        }
    }

    function limpiar(){
        const inputs_nombres = document.querySelectorAll('.input-group.mb-2');
        const inputs_ambientes = document.querySelectorAll('.row.ambiente-add');

        inputs_nombres.forEach(
            (input, index) => {
                if (index > 0) {
                    input.remove();
                } else {
                    input.querySelector('input').value = '';
                }
            }
        );
        inputs_ambientes.forEach(
            (input, index) => {
                if (index > 0) {
                    input.remove();
                } else {
                    input.querySelector('input').value = '';
                }
            }
        );
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
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

@stop
