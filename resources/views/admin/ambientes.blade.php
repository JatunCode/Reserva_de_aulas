@extends('adminlte::page')

@section('title', 'Ambientes de la facultad')

@section('content_header')
<h1>Ambientes registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header row">
        <div class="col-md-3">
            <label class="form-label" for="materia">Materia</label>
            <input class="form-control" type="text" name="materia" id="materia">
            <p id="messageErrorMateria" style="display: none">*No se encontro la materia</p>
        </div>
        <div class="col-md-2">
            <label class="form-label" for="dia">Dia</label>
            <select class="form-select" name="dia" id="selectDia">
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
            <input class="form-control" type="text" name="ambiente" id="ambiente">
            <p id="messageErrorAmbiente" style="display: none">*No se encontro el ambiente</p>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="blockfree" id="selectBlockFree">
                <option value="bloqueado">Ambientes bloqueados</option>
                <option value="libre">Ambientes libres</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary d-inline-block w-7" style="background-color:green" type="submit" >Buscar</button>
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
            <tbody>
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
    document.querySelector('[name="ambiente"]').addEventListener('change', 
        function(event){
            let text =  event.target.value
            const message = document.getElementById("messageErrorAmbiente")
            const content = document.getElementById("containerAmbiente")
            const lista = document.createElement('ul')
            fetch('http://127.0.0.1:8000/api/fetch/ambientes').then(
                response => response.json()
            ).then(
                data => {
                    ambientes = data
                    
                    ambientes.forEach(ambiente => {
                        
                    });
                    if(ambientes.find((ambiente) => ambiente['NOMBRE'].includes(text.toUpperCase()))){
                        lista.innerHTML += `<li>${}</li>`
                        console.log("Cadena del input: ", text)
                    }else{

                        console.log("Cadena del input no encontrada: ", text)
                    }
                }
            ).catch(
                error => {
                    console.log("Error encontrado: ", error)
                }
            )
        }
    )

    function findMateria(){

    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop


