@extends('adminlte::page')

@section('title', 'Ambientes de la facultad')

@section('content_header')
<h1>Ambientes registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header row">
        <div class="col-md-3" id="containerMateria">
            <label class="form-label" for="materia">Materia</label>
            <input class="form-control" type="text" name="materia" placeholder="Buscar materia">
            <p id="messageErrorMateria" style="display: none; color: red">*No se encontro la materia</p>
        </div>
        <div class="col-md-2">
            <label class="form-label" for="dia">Dia</label>
            <select class="form-select" name="dia">
                <option value="TODOS">Todos los dias</option>
                <option value="LUNES">Lunes</option>
                <option value="MARTES">Martes</option>
                <option value="MIERCOLES">Miercoles</option>
                <option value="JUEVES">Jueves</option>
                <option value="VIERNES">Viernes</option>
                <option value="SABADO">Sabado</option>
            </select>
        </div>
        <div class="col-md-2" id="containerAmbiente">
            <label class="form-label" for="ambiente">Ambiente</label>
            <input class="form-control" type="text" name="ambiente" placeholder="Buscar ambiente">
            <p id="messageErrorAmbiente" style="display: none; color: red">*No se encontro el ambiente</p>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="blockfree">
                <option value="TODOS">Todos los ambientes</option>
                <option value="NO HABILITADO">Ambientes bloqueados</option>
                <option value="HABILITADO" selected>Ambientes libres</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary d-inline-block w-7" style="background-color:green" onclick="findAmbiente()">Buscar</button>
        </div>
    </div>

    <div class="card-header">
        <h3 class="card-title">Ambientes registrados</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 35px">Nombre de ambiente</th>
                    <th style="width: 35px">Tipo de ambiente</th>
                    <th>Referencias</th>
                    <th style="width: 20px">Capacidad</th>
                    <th style="width: 20px">Data</th>
                    <th style="width: 40px">Estado</th>
                </tr>
            </thead>
            <tbody id="tableAmbientes">
                @foreach($ambientes as $ambiente)
                    <tr>
                        <td style="width: 35px">{{ $ambiente->NOMBRE }}</td>
                        <td style="width: 35px">{{ $ambiente->TIPO }}</td>
                        <td style="width: 150px">{{ $ambiente->REFERENCIAS }}</td>
                        <td style="width: 20px">{{ $ambiente->CAPACIDAD }}</td>
                        <td style="width: 20px">{{ $ambiente->DATA }}</td>
                        <td style="width: 40px">{{ $ambiente->ESTADO }}</td>
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
    ambientes = []
    materias = []
    ambientesfiltro = []

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

    document.querySelector('[name="ambiente"]').addEventListener('change', 
        function(event){
            let text =  event.target.value
            const message = document.getElementById("messageErrorAmbiente")
            const content = document.getElementById("containerAmbiente")
            const lista = document.createElement('ul')
            ambientes.forEach(ambiente => {
                lista.innerHTML += `<li>${ambiente['NOMBRE']}</li>`
            });
            if(ambientes.find((ambiente) => ambiente['NOMBRE'].includes(text.toUpperCase()))){
                message.style.display = "none"
                console.log("Cadena del input: ", text)
            }else{
                message.style.display = "block"
                console.log("Cadena del input no encontrada: ", text)
            }
        }
    )

    document.querySelector('[name="materia"]').addEventListener('change', 
        function(event){
            let text =  event.target.value
            const message = document.getElementById("messageErrorMateria")
            const content = document.getElementById("containerMateria")
            const lista = document.createElement('ul')
            materias.forEach(materia => {
                lista.innerHTML += `<li>${materia['NOMBRE']}</li>`
            });
            if(materias.find((materia) => materia['NOMBRE'].includes(text.toUpperCase()))){
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
                <td style="width: 35px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['NOMBRE']}</td>
                <td style="width: 35px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['TIPO']}</td>
                <td style="width: 150px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['REFERENCIAS']}</td>
                <td style="width: 20px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['CAPACIDAD']}</td>
                <td style="width: 20px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['DATA']}</td>
                <td style="width: 40px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['ESTADO']}</td>
            </tr>`
            console.log('Ingresando al inner')
        })
    }

    function findAmbiente(){
        tipo = ""
        tabla  =  document.getElementById('tableAmbientes')

        input_materia = document.querySelector('[name="materia"]').value
        input_ambiente = document.querySelector('[name="ambiente"]').value

        input_dia = document.querySelector('[name="dia"]')
        dia_select = input_dia.options[input_dia.selectedIndex].value

        input_libres_ocupados = document.querySelector('[name="blockfree"]')
        blockfree_select = input_libres_ocupados.options[input_libres_ocupados.selectedIndex].value

        cadena_fetch = 'http://127.0.0.1:8000/api/fetch/ambientes'
        //Agregar combinacion de todos los dias y todos los estados del ambiente
        if(input_materia == "" && input_ambiente != "" && input_dia != "" && input_libres_ocupados != ""){
            //Solo con el input materia vacio
            cadena_fetch += `/${input_ambiente.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
            console.log('Cadena de ambiente', cadena_fetch)
        }else if(input_materia != "" && input_ambiente == "" && input_dia != "" && input_libres_ocupados != ""){
            //Solo con el input ambiente vacio
            cadena_fetch += `materia/${input_materia.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
            console.log('Cadena de materia', cadena_fetch)
        }else if(input_materia == "" && input_ambiente != "" && input_dia == "" && input_libres_ocupados != ""){
            //Con el input materia y dia vacios
        }else if(input_materia != "" && input_ambiente == "" && input_dia == "" && input_libres_ocupados != ""){
            //Con el input ambiente y dia vacio
            cadena_fetch += `materia/${input_materia.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
            console.log('Cadena de materia', cadena_fetch)
        }else if(input_materia == "" && input_ambiente == "" && input_dia == "" && input_libres_ocupados != ""){
            //Con el input materia, ambiente y dia vacios
            cadena_fetch += `todo/${input_ambiente.toUpperCase()}/${input_materia.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
            console.log('Cadena de todo', cadena_fetch)
        }else if(input_materia == "" && input_ambiente == "" && input_dia != "" && input_libres_ocupados == ""){
            //Con el input materia, ambiente y libres vacios
            cadena_fetch += `materia/${input_materia.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
            console.log('Cadena de materia', cadena_fetch)
        }else if(input_materia != "" && input_ambiente != "" && input_dia != "" && input_libres_ocupados != ""){
            //Con trodos los input llenos
            cadena_fetch += `todo/${input_ambiente.toUpperCase()}/${input_materia.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
            console.log('Cadena de todo', cadena_fetch)
        }

        fetch(
            cadena_fetch
        ).then(
            response => response.json()
        ).then(
            data => {
                ambientesfiltro = data
                while(tabla.rows.length > 0){
                    tabla.deleteRow(0)
                }
                try{
                    agregarTabla(ambientesfiltro, tabla)
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


