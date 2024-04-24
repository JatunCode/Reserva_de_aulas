@extends('adminlte::page')

@section('title', 'Registro de horarios')

@section('content_header')
<h1>Registro de horarios</h1>
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
                @include('admin.components.formularioHorarios')
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12" id="tbhorarios">
        <div class="card h-100">
            <div class="card-header">
                <h3 class="card-title">
                    Lista de horarios habiles y existentes o inexistentes
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 40px">Ambiente</th>
                            <th style="width: 40px">Hora Entrada</th>
                            <th style="width: 40px">Hora Salida</th>
                            <th style="width: 100px">Materia</th>
                            <th style="width: 40px">Docente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($horarios as $horario)
                            <tr>
                                <td>{{ $horario['relacion_materia_horario']['dahm_relacion_ambiente']['NOMBRE'] ?? '' }}</td>   
                                <td>{{ $horario->INICIO }}</td>
                                <td>{{ $horario->FIN }}</td>
                                <td>{{ $horario['relacion_materia_horario']['dahm_relacion_materia']['NOMBRE'] ?? '' }}</td>
                                <td>{{ $horario['relacion_materia_horario']['dahm_relacion_docente']['NOMBRE'] ?? ''}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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

<script>
    var i = 1
    function agregarCampos(){
        document.getElementById('ref-add').addEventListener('click', function(){
            var container_main =  document.getElementById('container-main')

            var container = document.createElement('div')
            container.classList.add('row')

            var dia = document.createElement('div')
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

            var inicio = document.createElement('div')
            inicio.classList.add('col-md-4')
            inicio.innerHTML = '<label for="inicio" class="form-label">Hora de entrada</label><input type="time" class="form-control" name="inicio" required>'

            var fin = document.createElement('div')
            fin.classList.add('col-md-4')
            fin.innerHTML = '<label for="fin" class="form-label">Hora de salida</label><input type="time" class="form-control" name="fin" required>'

            var ambiente = document.createElement('div')
            ambiente.classList.add('col-md-4')
            ambiente.innerHTML = '<label for="ambiente" class="form-label">Ambiente</label><input type="text" class="form-control" name="ambiente" required>'
            // errordiv.innerHTML = '@error("REFERENCIAS")
            //         <div class="text-danger">{{ $message }}</div>
            //     @enderror'
            if(i < 3){
                container.appendChild(dia)
                container.appendChild(inicio)
                container.appendChild(fin)
                container.appendChild(ambiente)
                container_main.appendChild(container)
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
        var docente = document.querySelector('[name="docente"]')
        var materia = document.querySelector('[name="materia"]')
        var dias = document.querySelectorAll('[name="dia"]')
        var inicios = document.querySelectorAll('[name="inicio"]')
        var fins = document.querySelectorAll('[name="fin"]')
        var ambientes = document.querySelectorAll('[name="ambiente"]')

        console.log("Tamaño de arreglo dias: ", dias.length)
        console.log("Tamaño de arreglo inicio: ", inicios.length)
        console.log("Tamaño de arreglo fin: ", fins.length)
        console.log("Tamaño de arreglo ambiente: ", ambientes.length)

        var list_dia = []
        var list_horaini = []
        var list_horafin = []
        var list_ambiente = []

        dias.forEach(dia => {
            var index = dia.selectedIndex
            var dia_select = dia.options[index]
            list_dia.push(dia_select.value)
        });
        
        inicios.forEach(inicio => {
            list_horaini.push(inicio.value)
        });

        fins.forEach(fin => {
            list_horafin.push(fin.value)
        });

        ambientes.forEach(ambiente => {
            list_ambiente.push(ambiente.value)
        });

        var json_list = {
            'LIST_DIA': list_dia,
            'LIST_HORAINI': list_horaini,
            'LIST_HORAFIN': list_horafin,
            'LIST_AMBIENTE': list_ambiente
        }
        //Enviar datos de los campos
        var json_json = JSON.stringify(json_list)

        var form = JSON.stringify({
                    NOMBRE_DOCENTE: docente.value,
                    MATERIA: materia.value,
                    LISTAS: json_json
                })

        console.log("Formulario con datos: ",form)
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF

        fetch('horarios/store', 
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


