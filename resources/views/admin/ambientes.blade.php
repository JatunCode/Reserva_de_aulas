@extends('adminlte::page')

@section('title', 'Horarios Facultadivo')

@section('content_header')
<h1>Ambientes registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
        <button class="btn btn-sm btn-success open-btn" 
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasRight" 
            aria-controls="offcanvasRight"
            id="showform"
            >
            Registrar ambiente
        </button>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 40px">Nombre ambiente</th>
                    <th style="width: 40px">Tipo ambiente</th>
                    <th>Referencias</th>
                    <th style="width: 40px">Capacidad</th>
                    <th style="width: 40px">Data</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ambientes as $ambiente)
                    <tr>
                        <td style="width: 40px">{{ $ambiente->NOMBRE }}</td>
                        <td style="width: 40px">{{ $ambiente->TIPO }}</td>
                        <td>{{ $ambiente->REFERENCIAS }}</td>
                        <td style="width: 40px">{{ $ambiente->CAPACIDAD }}</td>
                        <td style="width: 40px">{{ $ambiente->DATA }}</td>
                        <td>{{ $ambiente->ESTADO }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>


@include('admin.components.formularioAmbientes')

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
    var i = 1
    function agregarCampos(){
        document.getElementById('ref-add').addEventListener('click', function(){
            var container =  document.getElementById('referencias')
            container.classList.add('col-md-10')

            var refer = document.createElement('input')
            refer.classList.add('form-control')
            refer.type = 'text'
            refer.name = 'refers'
            refer.placeholder = 'Bliblioteca FCyT/Area verde'
            refer.isrequired = true
            // errordiv.innerHTML = '@error("REFERENCIAS")
            //         <div class="text-danger">{{ $message }}</div>
            //     @enderror'
            if(i < 4){
                container.appendChild(refer)
                i++
            }
            console.log("Contador de inputs: ", i)
        })
        
    }

    function eliminarCampos(){
        var string = document.getElementById('nombre').value
        var j = 0;
        if(string === ""){
            while(j < i+1){
                var campo = document.getElementById('ref'+j)
                campo.parentNode.remove()
                j++
            }
            i = 0
        }
    }
    function obtainValues(){
        //event.preventDefault()
        var tipo_ambiente = document.getElementById('opcion')
        var nombre = document.getElementById('nombre')
        var index = tipo_ambiente.selectedIndex
        var opcion_select = tipo_ambiente.options[index]
        var referencias = document.querySelectorAll('[name="refers"]')
        var json_list = []
        list.forEach(element => {
            json_list.push(element.value)
        })
        var capac = document.getElementById('capacidad')
        var data = document.getElementById('si')
        var checked = data.checked ? "SI" : "NO"

        //Enviar datos de los campos
        var json_json = JSON.stringify(json_list)
        
        console.log("Seleccionado: "+opcion_select.value)
        console.log("Nombre: "+nombre.value)
        console.log("Lista de referencias: "+json_json)
        console.log("Checked: ", checked)

        var form = JSON.stringify({
                    TIPO: opcion_select.value,
                    NOMBRE: nombre.value,
                    REFERENCIAS: json_json,
                    CAPACIDAD: capac.value,
                    DATA: checked
                })

        console.log("Formulario con datos: ",form)
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF

        fetch('/admin/ambientes/store', 
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
                console.log('Error encontrador al enviar: ', error)
            })
    }

    document.getElementById('ref-add').addEventListener('click',agregarCampos)
    document.getElementById('formAmbiente').addEventListener('submit', obtainValues)
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop


