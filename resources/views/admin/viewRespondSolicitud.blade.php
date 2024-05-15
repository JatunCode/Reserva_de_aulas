@extends('adminlte::page')

@section('title', 'Registro de horarios')

@section('content_header')
<h1>Atencion de reserva</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Atencion reserva</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-md-12">
                <label for="docente" class="form-label">Docentes</label>
                <input type="text" name="docente" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="fechasoli" class="form-label">Fecha solicitud</label>
                <input type="text" name="fechasoli" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="fechares" class="form-label">Fecha reserva</label>
                <input type="text" name="fechares" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="text" name="capacidad" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="grupos" class="form-label">Grupos</label>
                <input type="text" name="grupos" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="materia" class="form-label">Materia</label>
                <input type="text" name="materia" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="ambiente" class="form-label">Ambiente</label>
                <input type="text" name="ambiente" class="form-control">
            </div>
            <div class="col-md-8">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" name="motivo" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="modo" class="form-label">Modo</label>
                <input type="text" name="modo" class="form-control">
            </div>
        </div>

        <div>
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary d-inline-block w-75" name="confirmar" style="color: green">Confirmar<button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary d-inline-block w-75" style="color: red" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Cancelar</button>
                </div>
            </div>
            <div>
                <button class="btn btn-primary d-inline-block w-75" style="color: red" name="atras">Atras</button>
            </div>
        </div>
    </div>
</div>

@stop

@include('admin.components.formularioRazones')

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
    let i = 1
    razones = []
    reservas = []

    fetch(
        'http://127.0.0.1:8000/api/fetch/razones'
    ).then(
        response = response.json()
    ).then(
        data => {
            razones = data
        }
    ).catch(
        error => {
            console.log('Error encontrado: ', error)
        }
    )

    fetch(
        'http://127.0.0.1:8000/api/fetch/reservas'
    ).then(
        response = response.json()
    ).then(
        data => {
            reservas = data
        }
    ).catch(
        error => {
            console.log('Error encontrado: ', error)
        }
    )

    document.querySelector('[name="razon"]').addEventListener('change',
        function (event) {
            let text = event.target.value
            let message = document.getElementById('messageErrorRazon')
            if(razones.find((razon) => razon['CUERPO'].toUpperCase() == text.toUpperCase())){
                message.style.display = "block"
            }else{
                message.style.display = "none"
            }
        }
    )

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
            inicio.innerHTML = '<label for="inicio" class="form-label">Hora de entrada</label><input type="time" class="form-control" name="inicio" value="08:15:00" min="06:45:00" max="20:15:00" step="5400" onchange="bloquearHoras(this)" required>'

            let fin = document.createElement('div')
            fin.classList.add('col-md-4')
            fin.innerHTML = '<label for="fin" class="form-label">Hora de salida</label><input type="time" class="form-control" name="fin" value="08:15:00" min="08:15:00" max="21:45:00" step="5400" onchange="bloquearHoras(this)" required>'
            
            let messageHora = document.createElement('p')
            messageHora.id = "messageErrorHora"
            messageHora.style.display = "none"
            messageHora.textContent = '*No se encuentra en el rango de hora'

            let ambiente = document.createElement('div')
            ambiente.classList.add('col-md-4')
            ambiente.innerHTML = '<label for="ambiente" class="form-label">Ambiente</label><input type="text" class="form-control" name="ambiente" onchange="findAmbiente(this)" required><p id="messageErrorAmbiente" style="display: none">*No se encontro el ambiente</p>'
            // errordiv.innerHTML = '@error("REFERENCIAS")
            //         <div class="text-danger">{{ $message }}</div>
            //     @enderror'
            if(i < 3){
                container.appendChild(dia)
                container.appendChild(inicio)
                container.appendChild(fin)
                container.appendChild(messageHora)
                container.appendChild(ambiente)
                container_main.appendChild(container)
                i++
            }
            console.log("Contador de inputs: ", i)
        })
        
    }

    function agregarTabla(text) {
        let tabla = document.getElementById("tableHorarios")
        
        if(text){
            //Agregar horarios ocupados en la tabla de informacion
            fetch('http://127.0.0.1:8000/api/horarios/'+text,{
                method:'PUT',
                headers:{
                    'Content-Type' : 'application/json'
                }
            }).then(
                response => response.json()
            ).then(
                data => {
                    tabla.innerHTML += `<h6 id="ocupado" style="color: red; width: 100%">Horarios ocupadas para el aula ${text} </h6>`
                    data.forEach(horario => 
                        {
                            tabla.innerHTML +=
                                        `<tr>
                                            <td> ${horario['horario_relacion_dahm']['dahm_relacion_ambiente']['NOMBRE'] ?? ''}</td>   
                                            <td> ${horario['INICIO']}</td>
                                            <td> ${horario['FIN']}</td>
                                            <td> ${horario['horario_relacion_dahm']['dahm_relacion_materia']['NOMBRE'] ?? ''}</td>
                                            <td> ${horario['horario_relacion_dahm']['dahm_relacion_docente']['NOMBRE'] ?? ''}</td>
                                        </tr>`
                        }
                    )
                }
            ).catch(
                error => {
                    console.log("Error encontrado: ", error)
                }
            )
            //Agregar horarios libres en la tabla de informacion
            fetch('http://127.0.0.1:8000/api/horarios/libres/'+text,{
                method:'PUT',
                headers:{
                    'Content-Type' : 'application/json'
                }
            }).then(
                response => response.json()
            ).then(
                data => {
                    tabla.innerHTML += `<h6 id="libre" style="color: green; width: 100%">Horarios libres para el aula ${text} </h6>`
                    data.forEach(horarios => 
                        {
                            horarios.forEach(horario =>
                                {
                                    tabla.innerHTML +=
                                    `<tr>
                                        <td> ${horario['AMBIENTE']}</td>   
                                        <td> ${horario['HORA_INI']}</td>
                                        <td> ${horario['HORA_FIN']}</td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>`
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
        }else{
            eliminarTabla()
        }
    }

    function bloquearHoras(horas){
        let list = String(horas).split(":")
        let segundos = parseInt(list[0], 10)*3600 + parseInt(list[1], 10)*60
        let message = document.getElementById("messageErrorHora")
        if(segundos <= 78300 && segundos >= 24300){
            message.style.color = "red"
            message.style.display = "block !important"
        }else{
            message.style.display = "none"
        }
    }

    function findDocente(text) {
        let message = document.getElementById("messageErrorDocente")
        let docentes = null
        fetch('http://127.0.0.1:8000/api/docentes').then(
            response => response.json()
        ).then(
            data => {
                docentes = data
                if(!docentes.find((docente) => docente['NOMBRE'] == text.value.toUpperCase()) &&
                    text.value != ""){
                    message.style.color = "red"
                    message.style.display = "block" 
                }else{
                    message.style.display = "none" 
                }
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )        
    }

    function findAmbiente(text){
        let message = document.getElementById("messageErrorAmbiente")
        let ambientes = null
        fetch('http://127.0.0.1:8000/api/ambientes').then(
            response => response.json()
        ).then(
            data => {
                ambientes = data
                if(!ambientes.find((ambiente) => ambiente['NOMBRE'] == text.value.toUpperCase()) && text.value != ""){
                    message.style.color = "red"
                    message.style.display = "block"
                }else{
                    message.style.display = "none"
                    agregarTabla(text.value)
                }
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )
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
        let divOcupado = document.getElementById("ocupado")
        let divLibre = document.getElementById("libre")
        while (tabla.rows.length > 0) {
            tabla.deleteRow(0)
        }
        tabla.removeChild(divOcupado)
        tabla.removeChild(divLibre)
    }

    function obtainValues(){
        event.preventDefault()
        let bandera = true
        let docente = document.querySelector('[name="docente"]')
        let materia = document.querySelector('[name="materia"]')
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
            bandera = (inicio.value != "")
            list_horaini.push(inicio.value)
        });

        fins.forEach(fin => {
            bandera = (fin.value != "")
            list_horafin.push(fin.value)
        });

        ambientes.forEach(ambiente => {
            bandera = (ambiente.value != "")
            list_ambiente.push(ambiente.value)
        });

        let json_list = {
            'LIST_DIA': list_dia,
            'LIST_HORAINI': list_horaini,
            'LIST_HORAFIN': list_horafin,
            'LIST_AMBIENTE': list_ambiente
        }
        //Enviar datos de los campos
        let json_json = JSON.stringify(json_list)

        let form = JSON.stringify({
                    NOMBRE_DOCENTE: docente.value,
                    MATERIA: materia.value,
                    LISTAS: json_json
                })

        console.log("Formulario con datos: ",form)
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF

        bandera = (docente.value != "" && materia.value != "")

        if(bandera == true){
            fetch('store', 
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
