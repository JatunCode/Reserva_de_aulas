@extends('adminlte::page')

@section('title', 'Ambientes de la facultad')

@section('content_header')
<h1>Ambientes registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->
<div class="card">
    <div class="card-header row d-flex align-items-center">
        <div class="col-md-3" id="containerAmbiente">
            <label class="form-label" for="ambiente">Ambiente</label>
            <input class="form-control" type="text" name="ambiente" placeholder="Buscar ambiente">
            <p id="messageErrorAmbiente" style="display: none; color: red">*No se encontró el ambiente</p>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="blockfree">Filtrar por estado</label>
            <select class="form-select" name="blockfree">
                <option value="Todos">Todos los ambientes</option>
                <option value="NO HABILITADO">Ambientes bloqueados</option>
                <option value="HABILITADO" selected>Ambientes libres</option>
            </select>
        </div>
        <div class="col-md-2 mt-4">
            <button class="btn btn-primary d-inline-block w-100" style="background-color:green" onclick="findAmbiente()">Buscar</button>
        </div>
    </div>

    <div class="card-header">
        <h3 class="card-title">Ambientes registrados</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-modern">
        <thead style="background-color: #00455c; color: white; text-align: center; vertical-align: middle;">

                <tr>
                    <th>#</th>
                    <th>Nombre de ambiente</th>
                    <th>Tipo de ambiente</th>
                    <th>Referencias</th>
                    <th>Capacidad</th>
                    <th>Data</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="tableAmbientes">
            @foreach($ambientes as $index => $ambiente)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $ambiente['NOMBRE'] }}</td>
                        <td>{{ $ambiente['TIPO'] }}</td>
                        <td>{{ $ambiente['REFERENCIAS'] }}</td>
                        <td>{{ $ambiente['CAPACIDAD'] }}</td>
                        <td>{{ $ambiente['DATA'] }}</td>
                        <td><span class="btn btn-sm btn-block
                                    @if($ambiente['ESTADO'] == 'CANCELADO')
                                        background-color: #FFC0B7; btn btn-outline-secondary
                                    @elseif($ambiente['ESTADO'] == 'HABILITADO')
                                        btn-success
                                    @elseif($ambiente['ESTADO'] == 'PENDIENTE')
                                        btn-warning
                                    @else
                                        btn-danger
                                    @endif
                                    " aria-controls="offcanvasRight">
                                <span class="text-truncate">{{ $ambiente['ESTADO'] }}</span>
                            </span></td>
                        
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

<style>
    .table-modern {
        width: 100%;
        border-collapse: collapse;
    }
    .thead-modern {
        background-color: #4CAF50;
        color: white;
    }
    .table-modern tbody tr:nth-child(odd) {
        background-color: #f2f2f2;
    }
    .table-modern tbody tr:nth-child(even) {
        background-color: #ffffff;
    }
    .table-modern th, .table-modern td {
        padding: 12px;
        text-align: left;
    }
</style>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    ambientesfiltro = []
    let ambientes = @json($ambientes)

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

    function agregarTabla(lista, tabla){
    tabla.innerHTML = ''
    lista.forEach((elemento, index) => {
        tabla.innerHTML += 
        `<tr style="background-color: ${index % 2 === 0 ? '#f2f2f2' : '#ffffff'};">
            <td>${index + 1}</td>
            <td>${elemento['NOMBRE']}</td>
            <td>${elemento['TIPO']}</td>
            <td>${elemento['REFERENCIAS']}</td>
            <td>${elemento['CAPACIDAD']}</td>
            <td>${elemento['DATA']}</td>
            <td><span class="btn btn-sm btn-block
                                    @if($ambiente['ESTADO'] == 'CANCELADO')
                                        background-color: #FFC0B7; btn btn-outline-secondary
                                    @elseif($ambiente['ESTADO'] == 'HABILITADO')
                                        btn-success
                                    @elseif($ambiente['ESTADO'] == 'PENDIENTE')
                                        btn-warning
                                    @else
                                        btn-danger
                                    @endif
                                    " aria-controls="offcanvasRight">
                                <span class="text-truncate">{{ $ambiente['ESTADO'] }}</span>
                            </span></td>
        </tr>`
        console.log('Ingresando al inner')
    })
}

    function findAmbiente(){
        tabla  =  document.getElementById('tableAmbientes')

        input_ambiente = document.querySelector('[name="ambiente"]').value

        input_libres_ocupados = document.querySelector('[name="blockfree"]')
        blockfree_select = input_libres_ocupados.options[input_libres_ocupados.selectedIndex].value

        const filtroAmbientes = ambientes.filter(ambiente => {
                            const modoMatch = (blockfree_select === 'Todos' || ambiente.ESTADO === blockfree_select.toUpperCase())
                            const nombreMatch = (input_ambiente === '' || ambiente.NOMBRE.includes(input_ambiente.toUpperCase()))
                            return modoMatch && nombreMatch
                            })
        
        console.log('Arreglo ambientes: ', filtroAmbientes)
        
        agregarTabla(filtroAmbientes, tabla)
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop
