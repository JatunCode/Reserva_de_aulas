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
    let banderaambiente = true
    let banderareferencia = true
    let banderacapacidad = true
    let regex = /^[a-z0-9\s]+$/i
    let ambientes = []
    
    function fetchAmbientes(){
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
    }

    fetchAmbientes()

    document.getElementById('ref-add').addEventListener('click', function(){
        const container =  document.getElementById('referencias')
        const new_div = document.createElement('div')
        const refer = document.createElement('input')
        new_div.classList.add('row')
        new_div.innerHTML = `
                <div class="col-md-10">
                    <input type="text" class="form-control" name="refers" placeholder="Bliblioteca FCyT/Area verde" onchange="caracterReferencia(this)">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-danger agregar-nombre" type="button" name="delete">
                        <i class="bi bi-x-circle-fill"></i>
                    </button>
                </div>`
        refer.onchange = function(){
            caracterReferencia(this)
        }
        if(i < 4){
            container.appendChild(new_div)
            const deleteButton = new_div.querySelector('button[name="delete"]');
            deleteButton.addEventListener('click', function() {
                container.removeChild(new_div);
                i -= 1
            });
            i++
        }
        console.log("Contador de inputs: ", i)
    })
    function agregarCampos(){
        
    //   const div_ambientes = document.getElementById('ambientes');
    //     function addNewDiv() {
    //         const newDiv = document.createElement('div');
    //         newDiv.classList.add('row', 'ambiente-add');
    //         newDiv.innerHTML = `
    //             <div class="col-md-8">
    //                 <select class="form-control" id="aula" name="aula"></select>
    //             </div>
    //             <div class="col-md-4">
    //                 <button class="btn btn-danger agregar-nombre" type="button" name="delete">
    //                     <i class="bi bi-x-circle-fill"></i>
    //                 </button>
    //             </div>
    //         `;
    //         div_ambientes.appendChild(newDiv);

    //         // Añadir event listener al botón de eliminar
    //         
    //         i += 1;
    //     }

    //     // Agregar un nuevo div inicialmente para demostración
    //     if(i < 2){
    //         addNewDiv();
    //     }
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

    function caracterReferencia(referencia){
        let message = document.getElementById("messageErrorReferencias")
        let esRegex = !regex.test(referencia.value)
        if(esRegex) {
            message.textContent = "*No se aceptan caracteres especiales"
            message.style.display = "block"
            banderareferencia = false
        }else{
            message.style.display = "none"
            banderareferencia = true
        }
    }

    function checkReferencias(referencias){
        let message = document.getElementById("messageErrorReferencias")
        let estaVacio = referencias.some(ref => ref === "")
        if(estaVacio){
            message.textContent = "*Llene o elimine la referencia vacia"
            message.style.display = "block"
            banderareferencia = false
        }else{
            message.style.display = "none"
            banderareferencia = true
        }
        console.log("Resultado del envio al ingresar una refeerncia: ", banderareferencia)
    }

    function checkCapacidad(text){
        let capacidad = document.getElementById("messageErrorCapacidad")
        let tipo_ambiente = document.querySelector('[name="opcion"]')
        let seleccionado = tipo_ambiente.options[tipo_ambiente.selectedIndex]
        let regexnumber = /^[0-9\s]+$/i
        let limit = (seleccionado.value == "Aula comun") ?  150 : 300
        console.log("Parcer de capacidad: ", parseInt(text.value, 10))
        if(text.value != ""){
            let conver = (text.value.includes(".")) ? 0 : parseInt(text.value, 10)
            if(conver == 0 || isNaN(conver) || !regexnumber.test(text.value)){
                capacidad.textContent = "*Solo caracteres numericos y enteros"
                capacidad.style.display = "block"
                banderacapacidad = false
            }else if(conver < 10){
                capacidad.textContent = "*La capacidad debe ser mayor igual a 10"
                capacidad.style.display = "block"
                banderacapacidad = false
            }else if(conver > limit){
                capacidad.textContent = `*La capacidad debe ser menor igual a ${limit}`
                capacidad.style.display = "block"
                banderacapacidad = false
            }else{
                capacidad.style.display = "none"
                banderacapacidad = true
            }
        }else{
            capacidad.textContent = "*El campo es obligatorio"
            capacidad.style.display = "block"
            banderacapacidad = false
        }
        console.log("Resultado del envio al ingresar la capacidad: ", banderacapacidad)
    }

    function findAmbiente(text){
        let message = document.getElementById("messageErrorAmbiente")
        if(text.value != "" && !regex.test(text.value)){
            message.textContent = "*No se permiten caracteres especiales."
            message.style.display = "block"
            banderaambiente = false
        }else if(ambientes.find((ambiente) => ambiente['NOMBRE'].toUpperCase() == text.value.toUpperCase())){
            message.textContent = "*El ambiente ya existe."
            message.style.display = "block"
            banderaambiente = false
        }else if(text.value == ""){
            message.textContent = "*El campo es obligatorio."
            message.style.display = "block"
            banderaambiente = false
        }else{
            message.style.display = "none"
            banderaambiente = true
        }
        console.log("Resultado del envio al ingresar el ambiente: ", banderaambiente)
    }

    function limpiar(){
        const form = document.getElementById('formAmbiente')
        const refs = document.querySelectorAll('[name="refers"]')
        refs.forEach((element, index) => {
            if(index > 0){
                element.remove()
            }
        });
        i = 1
        form.reset()
        fetchAmbientes()
    }

    function obtainValues(event){
        event.preventDefault()
        let tipo_ambiente = document.querySelector('[name="opcion"]')
        let nombre = document.querySelector('[name="nombre"]')
        let opcion_select = tipo_ambiente.options[tipo_ambiente.selectedIndex]
        let referencias = document.querySelectorAll('[name="refers"]')
        let json_list = Array.from(referencias).map(element => element.value)
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
        
        checkReferencias(json_list)
        checkCapacidad(capac)
        findAmbiente(nombre)

        let bandera = banderaambiente && banderacapacidad && banderareferencia

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


