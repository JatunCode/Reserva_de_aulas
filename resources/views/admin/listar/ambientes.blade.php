@extends('adminlte::page')

@section('title', 'Ambientes de la facultad')

@section('content_header')
<h1>Ambientes registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header row">
        <div class="col-md-2" id="containerAmbiente">
            <label class="form-label" for="ambiente">Ambiente</label>
            <input class="form-control" type="text" name="ambiente" placeholder="Buscar ambiente">
            <p id="messageErrorAmbiente" style="display: none; color: red">*No se encontro el ambiente</p>
        </div>
        <div class="col-md-3">
            <select class="form-select" name="blockfree">
                <option value="Todos">Todos los ambientes</option>
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
                    <th style="width: 30px">Referencias</th>
                    <th style="width: 20px">Capacidad</th>
                    <th style="width: 20px">Data</th>
                    <th style="width: 40px">Estado</th>
                </tr>
            </thead>
            <tbody id="tableAmbientes">
                @foreach($ambientes as $ambiente)
                    <tr>
                        <td style="width: 35px">{{ $ambiente['NOMBRE'] }}</td>
                        <td style="width: 35px">{{ $ambiente['TIPO'] }}</td>
                        <td style="width: 30px">{{ $ambiente['REFERENCIAS'] }}</td>
                        <td style="width: 20px">{{ $ambiente['CAPACIDAD'] }}</td>
                        <td style="width: 20px">{{ $ambiente['DATA'] }}</td>
                        <td style="width: 40px">{{ $ambiente['ESTADO'] }}</td>
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
        lista.forEach(elemento => {
            tabla.innerHTML += 
            `<tr>
                <td style="width: 35px">${elemento['NOMBRE']}</td>
                <td style="width: 35px">${elemento['TIPO']}</td>
                <td style="width: 30px">${elemento['REFERENCIAS']}</td>
                <td style="width: 20px">${elemento['CAPACIDAD']}</td>
                <td style="width: 20px">${elemento['DATA']}</td>
                <td style="width: 40px">${elemento['ESTADO']}</td>
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


