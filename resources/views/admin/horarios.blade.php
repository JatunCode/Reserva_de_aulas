@extends('adminlte::page')

@section('title', 'Horarios Facultadivo')

@section('content_header')
<h1>Horarios registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header row">
        <div class="col-md-2">
            <label class="form-label" for="dia">Dia</label>
            <select class="form-select" name="dia">
                <option value="" selected>Todos los dias</option>
                <option value="LUNES">Lunes</option>
                <option value="MARTES">Martes</option>
                <option value="MIERCOLES">Miercoles</option>
                <option value="JUEVES">Jueves</option>
                <option value="VIERNES">Viernes</option>
                <option value="SABADO">Sabado</option>
            </select>
        </div>
        
        <div class="col-md-4" id="containerDocente">
            <label class="form-label" for="docente">Docente</label>
            <input class="form-control" type="text" name="docente" placeholder="Buscar docente">
            <p id="messageErrorDocente" style="display: none; color: red">*No se encontro el docente</p>
        </div>
        <div class="col-md-2">
            <select class="form-select" name="blockfree">
                <option value="" selected>Todos los horarios</option>
                <option value="NO HABILITADO">Horarios bloqueados</option>
                <option value="HABILITADO">Horarios libres</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary d-inline-block w-7" style="background-color:green" onclick="findHorario()">Buscar</button>
        </div>
    </div>
    <div class="card-header">
        <h3 class="card-title">Horarios registrados</h3>
    </div>
    <div class="card-body table-responsive">
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 20px">Nº</th>
                    <th style="width: 40px">Dia</th>
                    <th style="width: 100px">Materia</th>
                    <th style="width: 40px">Hora Entrada</th>
                    <th style="width: 40px">Hora Salida</th>
                    <th style="width: 100px">Docente</th>
                    <th style="width: 40px">Ambiente</th>
                </tr>
            </thead>
            <tbody id="tableHorarios">
                @foreach($horarios as $horario)
                    <tr>
                        <th style="width: 20px"></td>
                        <th style="width: 40px">{{ $horario->DIA }}</td>
                        <th style="width: 100px">{{ $horario['horario_relacion_dahm']['dahm_relacion_materia']['NOMBRE'] ?? '' }}</td>
                        <th style="width: 40px">{{ $horario->INICIO }}</td>
                        <th style="width: 40px">{{ $horario->FIN }}</td>
                        <th style="width: 100px">{{ $horario['horario_relacion_dahm']['dahm_relacion_docente']['NOMBRE'] ?? ''}}</td>
                        <th style="width: 40px">{{ $horario['horario_relacion_dahm']['dahm_relacion_ambiente']['NOMBRE'] ?? '' }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    docentes = []
    horarios = []
    horariosFiltro = []

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

    document.querySelector('[name="docente"]').addEventListener('change', 
        function(event){
            let text =  event.target.value
            const message = document.getElementById("messageErrorDocente")
            const content = document.getElementById("containerDocente")
            const lista = document.createElement('ul')
            docentes.forEach(docente => {
                lista.innerHTML += `<li>${docente['NOMBRE']}</li>`
            });
            if(docentes.find((docente) => docente['NOMBRE'].includes(text.toUpperCase()))){
                message.style.display = "none"
                console.log("Cadena del input: ", text)
            }else{
                message.style.display = "block"
                console.log("Cadena del input no encontrada: ", text)
            }
        }
    )

    function agregarTabla(lista, tabla){
        lista.forEach(elemento => {
            tabla.innerHTML += 
            `<tr>
                <th style="width: 20px"></td>
                <td style="width: 35px">${elemento['DIA']}</td>
                <td style="width: 35px">${elemento['horario_relacion_dahm']['dahm_relacion_materia']['NOMBRE']}</td>
                <td style="width: 35px">${elemento['INICIO']}</td>
                <td style="width: 150px">${elemento['FIN']}</td>
                <td style="width: 20px">${elemento['horario_relacion_dahm']['dahm_relacion_docente']['NOMBRE']}</td>
                <td style="width: 20px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['NOMBRE']}</td>
            </tr>`
            console.log('Ingresando al inner')
        })
    }

    function findHorario(){
        tipo = ""
        tabla  =  document.getElementById('tableHorarios')

        input_docente = document.querySelector('[name="docente"]').value

        input_dia = document.querySelector('[name="dia"]')
        dia_select = input_dia.options[input_dia.selectedIndex].value

        input_libres_ocupados = document.querySelector('[name="blockfree"]')
        blockfree_select = input_libres_ocupados.options[input_libres_ocupados.selectedIndex].value

        cadena_fetch = 'http://127.0.0.1:8000/api/fetch/horariostodos'

        if(input_docente == "" && dia_select == "" && blockfree_select == ""){
            //Cadena sin filtros
            cadena_fetch += `sin/ / /%20`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente != "" && dia_select == "" && blockfree_select == ""){
            //Cadena para el filtro de los horarios por el nombre de doncente
            cadena_fetch += `/${input_docente}/ / `
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente == "" && dia_select != "" && blockfree_select == ""){
            //Cadena para el filtro de los horarios por el dia
            cadena_fetch += `/ /${dia_select}/ `
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente == "" && dia_select == "" && blockfree_select != ""){
            //Cadena para el filtro de los horarios por el estado del ambiente
            cadena_fetch += `/ / /${blockfree_select}`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente != "" && dia_select != "" && blockfree_select == ""){
            //Cadena para el filtro de los horarios por el nombre del docente y el dia seleccionado
            cadena_fetch += `/${input_docente}/${dia_select}/ `
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente == "" && dia_select != "" && blockfree_select != ""){
            //Cadena para el filtro de los horarios por el dia y estado seleccionado
            cadena_fetch += `/ /${dia_select}/${blockfree_select}`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente != "" && dia_select == "" && blockfree_select != ""){
            //Cadena para el filtro de los horarios por el nombre del docente y el estado del ambiente
            cadena_fetch += `/${input_docente}/ /${blockfree_select}`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente != "" && dia_select != "" && blockfree_select != ""){
            //Cadena para el filtro de los horarios por el dia y estado seleccionado y el nombre del docente
            cadena_fetch += `/${input_docente}/${dia_select}/${blockfree_select}`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }

        fetch(
            cadena_fetch
        ).then(
            response => response.json()
        ).then(
            data => {
                horariosFiltro = data
                while(tabla.rows.length > 0){
                    tabla.deleteRow(0)
                }
                try{
                    agregarTabla(horariosFiltro, tabla)
                    console.log('Formato del objeto: ', horariosFiltro)
                }catch(error){
                    console.log('Erro: ', error)
                }
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop



