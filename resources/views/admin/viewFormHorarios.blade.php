@extends('adminlte::page')

@section('title', 'Registro de horarios')

@section('content_header')
<h1>Registro de horarios</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="row">
    <div class="col-lg-6 col-md-12" id="formulario">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">Formulario</h3>
            </div>
            <div class="card-body">
                @include('admin.components.formularioHorarios')
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12" id="tbhorarios">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">
                    Lista de horarios libres
                </h3>
            </div>
            <div class="card-body">
                <div class="container mt-2" id="ambientes">

                </div>
                <div class="container mt-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" name="dia-semana" data-bs-toggle="tab" type="button" role="tab" aria-controls="contact" aria-selected="true" value="lunes" onclick="agregarTabla(this)">Lunes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" name="dia-semana" data-bs-toggle="tab" type="button" role="tab" aria-controls="contact" aria-selected="false" value="martes" onclick="agregarTabla(this)">Martes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" name="dia-semana" data-bs-toggle="tab" type="button" role="tab" aria-controls="contact" aria-selected="false" value="miercoles" onclick="agregarTabla(this)">Miercoles</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" name="dia-semana" data-bs-toggle="tab" type="button" role="tab" aria-controls="contact" aria-selected="false" value="jueves" onclick="agregarTabla(this)">Jueves</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" name="dia-semana" data-bs-toggle="tab" type="button" role="tab" aria-controls="contact" aria-selected="false" value="viernes" onclick="agregarTabla(this)">Viernes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" name="dia-semana" data-bs-toggle="tab" type="button" role="tab" aria-controls="contact" aria-selected="false" value="sabado" onclick="agregarTabla(this)">Sabado</button>
                        </li>
                    </ul>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 40px">Ambiente</th>
                            <th style="width: 40px">Entrada</th>
                            <th style="width: 40px">Salida</th>
                            <th style="width: 100px">Materia</th>
                            <th style="width: 40px">Docente</th>
                        </tr>
                    </thead>
                    <tbody id="tableHorarios">
                    </tbody>
                </table>
                <p id="messageErrorTabla" style="display: block; color: red">*Ingrese un ambiente</p>
            </div>
        </div>
    </div>
</div>

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
<script>
    import Echo from "laravel-echo";
    import Pusher from "pusher-js";

    window.Pusher = Pusher;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        cluster: process.env.MIX_PUSHER_APP_CLUSTER,
        encrypted: true
    });

    Echo.private('solicitud')
        .listen('NuevaSolicitud', (e) => {
            alert('Solicitudes pendientes: '+e.count_solis_pendientes+'\nSolicitudes urgentes'+e.count_solis_pend_urgentes);
        });
</script>
<script>

    let i = 1
    let docentes = []
    let ambientes = []
    let horarios = []
    let materias = []
    let horario_libres = []

    let banderaAmbiente = true
    let banderaDocente = true
    let banderaMateria = true
    let banderaGrupo = true
    let banderaHora = true

    let messageDocente = document.getElementById("messageErrorDocente")
    let messageAmbiente = document.getElementById("messageErrorAmbiente")
    let messageMateria = document.getElementById("messageErrorMateria")
    let messageGrupo = document.getElementById("messageErrorGrupo")

    function fetchs(){
        fetch('http://127.0.0.1:8000/api/fetch/ambientes').then(
            response => response.json()
        ).then(
            data => {
                ambientes = data
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )

        fetch('http://127.0.0.1:8000/api/fetch/docentes').then(
            response => response.json()
        ).then(
            data => {
                docentes = data
                
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )

        fetch('http://127.0.0.1:8000/api/fetch/horarios').then(
            response => response.json()
        ).then(
            data => {
                horarios = data
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )

        fetch('http://127.0.0.1:8000/api/fetch/materias').then(
            response => response.json()
        ).then(
            data => {
                materias = data
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )
    }

    fetchs()

    function agregarCampos(){
        document.getElementById('ref-add').addEventListener('click', function(){
            let container_main =  document.getElementById('container-main')

            let container = document.createElement('div')
            container.classList.add('row')

            let dia = document.createElement('div')
            dia.classList.add('col-md-10')
            dia.innerHTML = "<label for='nombre' class='form-label'>Seleccione el dia de clases</label>"
                +"<div class='input-group mb-2'>"+
                    '<select class="form-select" name="dia" required>'+
                        "<option value='Lunes' selected>Lunes</option>"+
                        "<option value='Martes'>Martes</option>"+
                        "<option value='Miercoles'>Miercoles</option>"+
                        "<option value='Jueves'>Jueves</option>"+
                        "<option value='Viernes'>Viernes</option>"+
                        "<option value='Sabado'>Sabado</option>"+
                    "</select>"+"</div>"

            let inicio = document.createElement('div')
            inicio.classList.add('col-md-4')
            inicio.innerHTML = '<label for="inicio" class="form-label">Hora de entrada</label><input type="time" class="form-control" name="inicio" value="08:15:00" min="06:45:00" max="20:15:00" step="5400" onchange="bloquearHoras(this)">'

            let fin = document.createElement('div')
            fin.classList.add('col-md-4')
            fin.innerHTML = '<label for="fin" class="form-label">Hora de salida</label><input type="time" class="form-control" name="fin" value="08:15:00" min="08:15:00" max="21:45:00" step="5400" onchange="bloquearHoras(this)">'

            let ambiente = document.createElement('div')
            ambiente.classList.add('col-md-4')
            ambiente.innerHTML = '<label for="ambiente" class="form-label">Ambiente</label><input type="text" class="form-control" name="ambiente" onchange="findAmbiente(this)">'
            
            // errordiv.innerHTML = '@error("REFERENCIAS")
            //         <div class="text-danger">{{ $message }}</div>
            //     @enderror'
            if(i < 3){
                container.appendChild(dia)
                container.appendChild(inicio)
                container.appendChild(fin)
                container.appendChild(ambiente)
                container_main.appendChild(container)
                i++
            }
            console.log("Contador de inputs: ", i)
        })
        
    }

    function agregarHorarios(text) {
        const tabla = document.getElementById("messageErrorTabla")
        horario_libres = []
        if(text){
            //Agregar horarios libres en la tabla de informacion
            tabla.style.display = 'none'
            fetch('http://127.0.0.1:8000/api/fetch/horarios/libres/'+text).then(
                response => response.json()
            ).then(
                data => {
                    data.forEach(
                        horarios => {
                            horarios.forEach(
                                horario => {
                                    horario_libres.push(horario)
                                }
                            )
                        }
                    )
                }
            ).catch(
                error => {
                    console.log("Error encontrado: ", error)
                }
            )
            console.log("Horarios libres: ", horario_libres)
        }else{
            eliminarTabla()
            tabla.style.display = 'block'
        }
    }

    function agregarTabla(button){
        const text = button.value
        const table = document.getElementById('tableHorarios')

        const horarios_filter = horario_libres.filter(
            horario => horario['DIA'] == text.toUpperCase()
        )

        table.innerHTML = ''

        horarios_filter.forEach(
            horario => {
                table.innerHTML += `<tr>
                    <td style="width: 35px">${horario['DIA']}</td>
                    <td style="width: 35px">${horario['HORA_INI']}</td>
                    <td style="width: 35px">${horario['HORA_FIN']}</td>
                </tr>`
            }
        )
    }

    function bloquearHoras(horas){
        let list = String(horas.value).split(":")
        let segundos = parseInt(list[0], 10)*3600 + parseInt(list[1], 10)*60
        let message = document.getElementById("messageErrorHora")
        if(segundos <= 24300 || segundos >= 78300){
            message.textContent = "*Esta fuera del rango de la hora"
            message.style.display = "block"
            banderaHora = false
        }else{
            banderaHora = true
            message.style.display = "none"
        }
    }

    function checkDocente(text){
        if(text.value == ""){
            messageDocente.textContent = "*El campo es obligatorio"
            messageDocente.style.display = "block" 
            banderaDocente = false
        }else{
            messageDocente.style.display = "none" 
            banderaDocente = true
        }
    }

    function checkMateria(text){
        if(text.value == ""){
            messageMateria.textContent = "*El campo es obligatorio"
            messageMateria.style.display = "block" 
            banderaMateria = false
        }else{
            messageMateria.style.display = "none" 
            banderaMateria = true
        }
    }

    function checkGrupo(text){
        if(text.value == ""){
            messageGrupo.textContent = "*El campo es obligatorio"
            messageGrupo.style.display = "block" 
            banderaGrupo = false
        }else{
            messageGrupo.style.display = "none" 
            banderaGrupo = true
        }
    }

    function findDocente(text) {     
        if(!docentes.find((docente) => docente['NOMBRE'] == text.value.toUpperCase()) &&
            text.value != ""){
            messageDocente.textContent = "*No se encontro el docente"
            messageDocente.style.display = "block" 
            banderaDocente = false
        }else{
            messageDocente.style.display = "none" 
            banderaDocente = true
        }
    }

    function checkAmbiente(text){
        if(text.value == ""){
            messageAmbiente.textContent = "*Debe llenar o eliminar el campo vacio"
            messageAmbiente.style.display = "block"
            banderaAmbiente = false
        }else{
            messageAmbiente.style.display = "none" 
            banderaAmbiente = true
        }
    }

    function findAmbiente(text){
        if(!ambientes.find((ambiente) => ambiente['NOMBRE'] == text.value.toUpperCase()) && text.value != ""){
            messageAmbiente.textContent = "*El ambiente no existe"
            messageAmbiente.style.display = "block"
            banderaAmbiente = false
        }else{
            messageAmbiente.style.display = "none"
            banderaAmbiente = true
            agregarHorarios(text.value)
        }
    }

    function eliminarCampos(){
        let string = document.getElementById('nombre').value
        let j = 0;
        if(string === ""){
            while(j < i+1){
                let campo = document.getElementById('ref'+j)
                campo.parentNode.remove()
                j++
            }
            i = 0
        }
    }

    function eliminarTabla() {
        let tabla = document.getElementById("tableHorarios")
        while (tabla.rows.length > 0) {
            tabla.deleteRow(0)
        }
    }

    function limpiar(){
        const form = document.getElementById('formHorario')
        const div = document.getElementById("container-ta")
        const divs = div.querySelectorAll('[class="col-md-4"]')
        divs.forEach((element, index) => {
            if(index > 0){
                element.remove()
            }
        })
        i = 1
        fetchs()
        form.reset()
    }

    function obtainValues(){
        event.preventDefault()
        let bandera = true
        let docente = document.querySelector('[name="docente"]')
        let materia = document.querySelector('[name="materia"]')
        let grupo = document.querySelector('[name="grupo"]')
        let dias = document.querySelectorAll('[name="dia"]')
        let inicios = document.querySelectorAll('[name="inicio"]')
        let fins = document.querySelectorAll('[name="fin"]')
        let ambientes = document.querySelectorAll('[name="ambiente"]')

        console.log("Tamaño de arreglo dias: ", dias.length)
        console.log("Tamaño de arreglo inicio: ", inicios.length)
        console.log("Tamaño de arreglo fin: ", fins.length)
        console.log("Tamaño de arreglo ambiente: ", ambientes.length)
        
        let list_dia = []
        let list_horaini = []
        let list_horafin = []
        let list_ambiente = []

        dias.forEach(dia => {
            let index = dia.selectedIndex
            let dia_select = dia.options[index]
            list_dia.push(dia_select.value)
        });
        
        inicios.forEach(inicio => {
            list_horaini.push(inicio.value)
        });

        fins.forEach(fin => {
            list_horafin.push(fin.value)
        });

        ambientes.forEach(ambiente => {
            checkAmbiente(ambiente)
            list_ambiente.push(ambiente.value)
        });

        let json_list = {
            'LIST_DIA': list_dia,
            'LIST_HORAINI': list_horaini,
            'LIST_HORAFIN': list_horafin,
            'LIST_AMBIENTE': list_ambiente,
        }
        //Enviar datos de los campos
        let json_json = JSON.stringify(json_list)

        let form = JSON.stringify({
                    NOMBRE_DOCENTE: docente.value.toUpperCase(),
                    MATERIA: materia.value.toUpperCase(),
                    GRUPO: grupo.value.toUpperCase(),
                    LISTAS: json_json
                })

        console.log("Formulario con datos: ",form)
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF

        checkDocente(docente)
        checkMateria(materia)
        checkMateria(grupo)

        bandera = banderaAmbiente && banderaDocente && banderaHora

        if(bandera == true){
            fetch('http://127.0.0.1:8000/admin/horarios/store', 
            {
                method: 'POST',
                headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': token
                },
                body: form
            })
            .then(
                response => {
                    if (!response.ok) {
                        throw new Error('La respuesta al servidor no es correcta')
                    }else{
                        Swal.fire({
                            icon: 'success',
                            title: '¡Ambiente creado exitosamente!',
                            showConfirmButton: false,
                            timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                        }).then(() => {
                            // Después de cerrar la alerta, limpiar el formulario y cerrar el offcanvas
                            limpiar();
                        })
                    }
                    return response.json()
                }
            )
            .then(data=>{
                console.log('Contendido del form guardado: ', data)
            }).catch(error => {
                console.log('Error encontrado al enviar: ', error)
            })
        }else{

        }
    }

    document.getElementById('ref-add').addEventListener('click',agregarCampos)
    document.getElementById('boton-sub').addEventListener('click', obtainValues)
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop
