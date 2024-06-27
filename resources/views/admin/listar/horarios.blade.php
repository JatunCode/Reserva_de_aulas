@extends('adminlte::page')

@section('title', 'Horarios Facultadivo')

@section('content_header')
<h1>Horarios registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
<div class="card-header row" style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: center;">
    <div class="col-md-2" style="flex: 1;">
        <label class="form-label" for="dia">Día</label>
        <select class="form-select" name="dia">
            <option value="" selected>Todos los días</option>
            <option value="LUNES">Lunes</option>
            <option value="MARTES">Martes</option>
            <option value="MIERCOLES">Miércoles</option>
            <option value="JUEVES">Jueves</option>
            <option value="VIERNES">Viernes</option>
            <option value="SABADO">Sábado</option>
        </select>
    </div>
    
    <div class="col-md-4" id="containerDocente" style="flex: 2; position: relative;">
        <label class="form-label" for="docente">Docente</label>
        <input class="form-control" type="text" name="docente" placeholder="Buscar docente">
        <div id="lista-docentes" class="list-group" style="display: none; position: absolute; z-index: 10; background: white; width: 100%;"></div>
        <p id="messageErrorDocente" style="display: none; color: red;">*No se encontró el docente</p>
    </div>
    
    <div class="col-md-2" style="flex: 1;">
        <label class="form-label" for="blockfree">Estado del horario</label>
        <select class="form-select" name="blockfree">
            <option value="" selected>Todos los horarios</option>
            <option value="NO HABILITADO">Horarios bloqueados</option>
            <option value="HABILITADO">Horarios libres</option>
        </select>
    </div>
    
    <div class="col-md-2" style="flex: 1;">
        <button class="btn btn-primary d-inline-block w-7" style="background-color: green; margin-top: 2rem;" onclick="findHorario()">Buscar</button>
    </div>
</div>
    <div class="card-header">
        <h3 class="card-title">Horarios registrados</h3>
    </div>
    <div class="card-body table-responsive">
        
        <table class="table table-bordered" style="width: 100%; border-collapse: collapse;">
            <thead style="background-color: #00455c; color: white; text-align: center; vertical-align: middle;">
                <tr>
                    <th style="width: 40px">#</th>
                    <th style="width: 40px">Día</th>
                    <th style="width: 100px">Materia</th>
                    <th style="width: 40px">Hora Entrada</th>
                    <th style="width: 40px">Hora Salida</th>
                    <th style="width: 100px">Docente</th>
                    <th style="width: 40px">Ambiente</th>
                </tr>
            </thead>
            <tbody id="tableHorarios">
                @foreach($horarios as $index => $horario)
                    <tr style="background-color: {{ $index % 2 == 0 ? '#f9f9f9' : '#ffffff' }};">
                        <td style="width: 40px; text-align: center;">{{ $index + 1 }}</td>
                        <td style="width: 40px; text-align: center;">{{ $horario->DIA }}</td>
                        <td style="width: 100px; text-align: center;">{{ $horario['horario_relacion_dahm']['dahm_relacion_materia']['NOMBRE'] ?? '' }}</td>
                        <td style="width: 40px; text-align: center;">{{ $horario->INICIO }}</td>
                        <td style="width: 40px; text-align: center;">{{ $horario->FIN }}</td>
                        <td style="width: 100px; text-align: center;">{{ $horario['horario_relacion_dahm']['dahm_relacion_docente']['NOMBRE'] ?? ''}}</td>
                        <td style="width: 40px; text-align: center;">{{ $horario['horario_relacion_dahm']['dahm_relacion_ambiente']['NOMBRE'] ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .card-header {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .form-label, .form-select, .form-control {
        display: block;
        width: 100%;
    }

    .table thead th {
        text-align: center;
        vertical-align: middle;
    }

    .table tbody td {
        text-align: center;
        vertical-align: middle;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
</style>

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

    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('containerDocente');
        const listaDocentes = document.getElementById('lista-docentes');
        const message = document.getElementById('messageErrorDocente');

        // selectMateria.addEventListener('change', (event) => {
        //     docentes_relacionados = [];
        //     const idMateriaSeleccionada = event.target.value;
        //     extra_materias = materias;
        //     grupos_relacionados = extra_materias.find(materia => materia['NOMBRE'] === idMateriaSeleccionada);
        //     grupos_relacionados = [...new Set(grupos_relacionados['GRUPOS'])];
            
        //     for (let i = 0; i < docentes.length; i++) {
        //         const docente = docentes[i];
        //         for (let j = 0; j < docente['MATERIAS'].length; j++) {
        //             const materia = docente['MATERIAS'][j];
        //             if (materia['NOMBRE'] === idMateriaSeleccionada) {
        //                 docentes_relacionados.push(docente);
        //                 break;
        //             }
        //         }
        //     }
        //     console.log('Grupos: ', grupos_relacionados);
        //     console.log('Materias: ', materias);
        //     console.log('Docentes: ', docentes_relacionados);
        // });

        container.addEventListener('keydown', (event) => {
            if (event.target && event.target.matches('input[name="nombre"]')) {
                const inputNombre = event.target;

                listaDocentes.innerHTML = '';
                listaDocentes.style.width = `${inputNombre.offsetWidth}px`;
                listaDocentes.style.left = `${inputNombre.offsetLeft}px`;
                listaDocentes.style.top = `${inputNombre.offsetTop + inputNombre.offsetHeight}px`;

                if (inputNombre.value.toUpperCase()) {
                    let filtro_lista = docentes.filter(docente => 
                        docente['NOMBRE'].includes(inputNombre.value.toUpperCase())
                    );
                    if (filtro_lista.length > 0) {
                        message.style.display = 'none';
                        listaDocentes.style.display = 'block';
                        filtro_lista.forEach(docente => {
                            const item = document.createElement('a');
                            item.className = 'list-group-item list-group-item-action';
                            item.textContent = docente['NOMBRE'];
                            item.addEventListener('click', () => {
                                inputNombre.value = docente['NOMBRE'];
                                listaDocentes.style.display = 'none';
                            });
                            listaDocentes.appendChild(item);
                        });
                    } else {
                        listaDocentes.style.display = 'none';
                        message.style.display = 'block';
                    }
                } else {
                    listaDocentes.style.display = 'none';
                }
            }
        });

        document.addEventListener('click', (event) => {
            if (!event.target.closest('#container') && !event.target.closest('#lista-docentes')) {
                listaDocentes.style.display = 'none';
            }
        });
    });

    document.addEventListener('click', (event) => {
        if (!event.target.closest('#container') && !event.target.closest('#lista-docentes')) {
            listaDocentes.style.display = 'none';
        }
    });

    function agregarTabla(lista, tabla){
    tabla.innerHTML = '';
    lista.forEach((elemento, index) => {
        tabla.innerHTML += 
        `<tr style="background-color: ${index % 2 === 0 ? '#f2f2f2' : '#ffffff'};">
            <td style="width: 30px;">${index + 1}</td>
            <td style="width: 35px;">${elemento['DIA']}</td>
            <td style="width: 35px;">${elemento['MATERIA']}</td>
            <td style="width: 35px;">${elemento['INICIO']}</td>
            <td style="width: 150px;">${elemento['FIN']}</td>
            <td style="width: 20px;">${elemento['DOCENTE']}</td>
            <td style="width: 20px;">${elemento['AMBIENTE']}</td>
        </tr>`;
        console.log('Ingresando al inner');
    });
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
            cadena_fetch += `/${input_docente}/ /%20`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente == "" && dia_select != "" && blockfree_select == ""){
            //Cadena para el filtro de los horarios por el dia
            cadena_fetch += `/ /${dia_select}/%20`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente == "" && dia_select == "" && blockfree_select != ""){
            //Cadena para el filtro de los horarios por el estado del ambiente
            cadena_fetch += `/ / /${blockfree_select}`
            console.log("Cadena de la peticion fetch: ", cadena_fetch)
        }else if(input_docente != "" && dia_select != "" && blockfree_select == ""){
            //Cadena para el filtro de los horarios por el nombre del docente y el dia seleccionado
            cadena_fetch += `/${input_docente}/${dia_select}/%20`
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



