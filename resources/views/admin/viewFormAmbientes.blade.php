@extends('adminlte::page')

@section('title', 'Registro de ambientes')

@section('content_header')
<h1>Registro de ambientes</h1>
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
                @include('admin.components.formularioAmbientes')
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-6 col-md-12" id="tbhorarios">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">
                    Mapa de Referencias
                </h3>
            </div>
            <div class="card-body">
                {{-- Espacio para las referencias dentro del mapa --}}
            </div>
        </div>
    </div> --}}
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
    let i = 1
    let bandera = true
    function agregarCampos(){
        document.getElementById('ref-add').addEventListener('click', function(){
            let container =  document.getElementById('referencias')
            container.classList.add('col-md-10')

            let refer = document.createElement('input')
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

    function checkReferencias(referencias){
        let message = document.getElementById("messageErrorReferencias")
        let regex = /[a-z0-9\s]/i
        if(referencias.forEach((referencia) => {return (referencia.value == "") ? true : false}) == false){
            message.textContent = "*Llene o elimine la referencia vacia"
            message.style.display = "block"
            bandera = false
        }else{
            if(referencias.forEach((referencia) => {return (regex.test(referencia.value)) ? true : false})){
                message.textContent = "*No se aceptan caracteres especiales"
                message.style.display = "block"
                bandera = false
            }else{
                message.style.display = "none"
                bandera = true
            }
        }
    }

    function checkCapacidad(text){
        let capacidad = document.getElementById("messageErrorCapacidad")
        let tipo_ambiente = document.querySelector('[name="opcion"]')
        let seleccionado = tipo_ambiente.options[tipo_ambiente.selectedIndex]
        let limit = (seleccionado.value == "Aula comun") ?  150 : 300
        if(text.value != ""){
            let conver = (text.value.includes(".")) ? 0 : parseInt(text.value, 10)
            capacidad.style.color = "red"
            if(conver != 0){
                if(conver < 10){
                    capacidad.textContent = "*La capacidad debe ser mayor igual a 10"
                    capacidad.style.display = "block"
                    bandera = false
                }else{
                    if(conver > limit){
                        capacidad.textContent = `*La capacidad debe ser menor igual a ${limit}`
                        capacidad.style.display = "block"
                        bandera = false
                    }else{
                        capacidad.style.display = "none"
                        bandera = true
                    }
                }
            }else{
                capacidad.textContent = "*Solo numeros enteros"
                capacidad.style.display = "block"
                bandera = false
            }
        }else{
            capacidad.textContent = "*El campo es obligatorio"
            capacidad.style.display = "block"
            bandera = false
        }
    }

    function findAmbiente(text){
        let message = document.getElementById("messageErrorAmbiente")
        let ambientes = null
        if(text.value != ""){
            fetch('http://127.0.0.1:8000/api/ambientes').then(
                response => response.json()
            ).then(
                data => {
                    ambientes = data
                    if(ambientes.find((ambiente) => ambiente['NOMBRE'].toUpperCase() == text.value.toUpperCase())){
                        message.style.color = "red"
                        message.style.display = "block"
                        bandera = false
                    }else{
                        message.style.display = "none"
                        bandera = true
                    }
                }
            ).catch(
                error => {
                    console.log("Error encontrado: ", error)
                }
            )
        }else{
            message.style.color = "red"
            message.textContent = "*El campo es obligatorio"
            message.style.display = "block"
            bandera = false
        }
    }

    function obtainValues(){
        event.preventDefault()
        let tipo_ambiente = document.querySelector('[name="opcion"]')
        let nombre = document.querySelector('[name="nombre"]')
        let index = tipo_ambiente.selectedIndex
        let opcion_select = tipo_ambiente.options[index]
        let referencias = document.querySelectorAll('[name="refers"]')
        let json_list = []
        referencias.forEach(element => {
            json_list.push(element.value)
        })
        let capac = document.querySelector('[name="capacidad"]')
        let data = document.querySelector('[name="data"]')
        let checked = data.checked ? "SI" : "NO"

        //Enviar datos de los campos
        let json_json = JSON.stringify(json_list)
        
        let form = JSON.stringify({
                    TIPO: opcion_select.value,
                    NOMBRE: nombre.value,
                    REFERENCIAS: json_json,
                    CAPACIDAD: capac.value,
                    DATA: checked
                })

        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF
        
        checkReferencias(referencias)
        
        if(bandera == true){
            console.log("Envio de datos del formulario: ", form)
            fetch('http://127.0.0.1:8000/admin/ambientes/store', 
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


