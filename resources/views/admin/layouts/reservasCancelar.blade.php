@extends('adminlte::page')

@section('title', 'Atencion de reservas')

@section('content_header')
<h1>Atencion de solicitudes</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header row">
        <div class="col-md-3" id="containerBusqueda">
            <label class="form-label" for="busqueda">Busqueda</label>
            <input class="form-control" type="text" name="busqueda" placeholder="Buscar solicitud por ...">
            <p id="messageErrorBusqueda" style="display: none; color: red">*No se encontro resultados</p>
        </div>
        <div class="col-md-2">
            <label class="form-label" for="modo">Modo</label>
            <select class="form-select" name="modo">
                <option value=" ">Todos</option>
                <option value="URGENTE">Urgente</option>
                <option value="NORMAL">Normal</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary d-inline-block w-7" style="background-color:green" onclick="findTodo()">Buscar</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 40px">Fecha de reserva</th>
                    <th style="width: 20px">Aula</th>
                    <th style="width: 75px">Materia</th>
                    <th style="width: 40px">Fecha de solicitud</th>
                    <th style="width: 40px">Horario</th>
                    <th style="width: 30px">Modo</th>
                    <th style="width: 40px">Estado</th>
                    <th style="width: 40px">Detalles</th>
                </tr>
            </thead>
            <tbody id="tableAmbientes">
                @foreach($solis_no_reser as $solicitud)
                    <tr>
                        <td style="width: 35px">{{ $solicitud['FECHA_RESERVA'] }}</td>
                        <td style="width: 35px">{{ $solicitud['AMBIENTE'] }}</td>
                        <td style="width: 150px">{{ $solicitud['MATERIA'] }}</td>
                        <td style="width: 35px">{{ $solicitud['FECHA_HORASOLI'] }}</td>
                        <td style="width: 20px">{{ $solicitud['HORARIO'] }}</td>
                        <td class="modo">
                            <span class="btn  btn-sm btn-block
                                @if($solicitud['MODO'] == 'NORMAL')
                                    ;
                                    btn-success
                                @else
                                    btn-danger
                                @endif
                                " aria-controls="offcanvasRight">
                                {{ @$retVal = (!is_object($solicitud['MODO'])) ? $solicitud['MODO'] : 'URGENTE' ; }}
                            </span>
                        </td>
                        <td>
                            <span class="btn btn-sm btn-block
                                    @if($solicitud['ESTADO'] == 'CANCELADO')
                                        background-color: #FFC0B7;btn btn-outline-secondary
                                    @elseif($solicitud['ESTADO'] == 'ACEPTADO')
                                        btn-success
                                    @elseif($solicitud['ESTADO'] == 'PENDIENTE')
                                        btn-warning
                                    @else
                                        btn-danger
                                    @endif
                                    " aria-controls="offcanvasRight">
                                <span class="text-truncate">{{ $solicitud['ESTADO'] }}</span>
                            </span>

                        </td>
                        <td style="width: 40px"><button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                            data-id="{{ $solicitud['ID'] }}" style="background-color:red" onclick="pressAtention(this)" value="{{$solicitud['ID']}}">Cancelar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@stop

@include('admin.viewCancelarReserva')

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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
<script>
    let razones = []
    let razonesfiltro = []
    let soli_aten = null
    soli_pend = @json($solis_no_reser)

    function razonesfetch(){
        fetch('http://127.0.0.1:8000/api/fetch/razones').then(
            response => response.json()
        ).then(
            data => {
                razones = data
            }
        ).catch(
            error => {
                console.log("Error encontrado: ", error)
            }
        )
    }
    razonesfetch()
    function pressAtention(button){
        const id = button.value
        const canva = document.getElementById('offcanvasRight')
        soli_aten = soli_pend.find(elemento => elemento['ID'] == id)
        console.log('Solicitud: ', soli_aten)
        if(soli_aten){
            const docentes = document.getElementById('docentes')
            const fechasoli = document.querySelector('[name="fechasoli"]')
            const fechares = document.querySelector('[name="fechares"]')
            const capacidad = document.querySelector('[name="capacidad"]')
            const grupos = document.querySelector('[name="grupos"]')
            const materia = document.querySelector('[name="materia"]')
            const ambiente = document.querySelector('[name="ambiente"]')
            const horario = document.querySelector('[name="horario"]')
            const motivo = document.querySelector('[name="motivo"]')
            const modo = document.querySelector('[name="modo"]')
            const desc = document.querySelector('[name="desc"]')
            const div = document.getElementById('desc-modo');
            docentes.innerHTML = ''
            soli_aten['NOMBRE_DOCENTES'].forEach(element => {
                docentes.innerHTML +=`<input type="text" class="form-control" value="${element['Nombre_docente']}" readonly>`
            });
            fechasoli.value = soli_aten['FECHA_HORASOLI']
            fechares.value = soli_aten['FECHA_RESERVA']
            capacidad.value = soli_aten['CANTIDAD']
            grupos.value = soli_aten['GRUPOS']
            materia.value = soli_aten['MATERIA']
            ambiente.value = soli_aten['AMBIENTE']
            horario.value = soli_aten['HORARIO']
            motivo.value = soli_aten['MOTIVO']
            modo.value = soli_aten['MODO']
            desc.value = soli_aten['DESC'].split(':')[1]
            div.style.display = (soli_aten['MODO'] == 'NORMAL') ? 'none':'block'
        }else{
            console.log("Fallo al obtener los datos alv no puede ser >:VVVVVVVV")
        }

    }
    
    // document.querySelector('[name="ambiente"]').addEventListener('click', 
    //     function(event){
    //         let text =  event.target.value
            
    //     }
    // )

    // document.querySelector('[name="materia"]').addEventListener('change', 
    //     function(event){
    //         let text =  event.target.value
    //         const message = document.getElementById("messageErrorMateria")
    //         const content = document.getElementById("containerMateria")
    //         const lista = document.createElement('ul')
    //         materias.forEach(materia => {
    //             lista.innerHTML += `<li>${materia['NOMBRE']}</li>`
    //         });
    //         if(materias.find((materia) => materia['NOMBRE'].includes(text.toUpperCase()))){
    //             message.style.display = "none"
    //             console.log("Cadena del input: ", text)
    //         }else{
    //             message.style.display = "block"
    //             console.log("Cadena del input no encontrada: ", text)
    //         }
    //     }
    // )

    // function agregarTabla(lista, tabla){
    //     lista.forEach(elemento => {
    //         tabla.innerHTML += 
    //         `<tr>
    //             <td style="width: 35px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['NOMBRE']}</td>
    //             <td style="width: 35px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['TIPO']}</td>
    //             <td style="width: 150px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['REFERENCIAS']}</td>
    //             <td style="width: 20px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['CAPACIDAD']}</td>
    //             <td style="width: 20px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['DATA']}</td>
    //             <td style="width: 40px">${elemento['horario_relacion_dahm']['dahm_relacion_ambiente']['ESTADO']}</td>
    //         </tr>`
    //         console.log('Ingresando al inner')
    //     })
    // }

    // function findAmbiente(){
    //     tipo = ""
    //     tabla  =  document.getElementById('tableAmbientes')

    //     input_materia = document.querySelector('[name="materia"]').value
    //     input_ambiente = document.querySelector('[name="ambiente"]').value

    //     input_dia = document.querySelector('[name="dia"]')
    //     dia_select = input_dia.options[input_dia.selectedIndex].value

    //     input_libres_ocupados = document.querySelector('[name="blockfree"]')
    //     blockfree_select = input_libres_ocupados.options[input_libres_ocupados.selectedIndex].value

    //     cadena_fetch = 'http://127.0.0.1:8000/api/fetch/ambientes'

    //     if(input_materia == "" && input_ambiente != ""){
    //         cadena_fetch += `/${input_ambiente.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
    //         console.log('Cadena de ambiente', cadena_fetch)
    //     }else{
    //         if(input_materia != "" && input_ambiente == ""){
    //             cadena_fetch += `materia/${input_materia.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
    //             console.log('Cadena de materia', cadena_fetch)
    //         }else{
    //             if(input_materia != "" && input_ambiente != ""){
    //                 cadena_fetch += `todo/${input_ambiente.toUpperCase()}/${input_materia.toUpperCase()}/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
    //                 console.log('Cadena de todo', cadena_fetch)
    //             }else{
    //                 cadena_fetch += `todosin/${dia_select.toUpperCase()}/${blockfree_select.toUpperCase()}`
    //             }
    //         }
    //     }

    //     fetch(
    //         cadena_fetch,
    //         {
    //             method: 'PUT',
    //             headers: {
    //                 'Content-Type': 'application/json'
    //             }
    //         }
    //     ).then(
    //         response => response.json()
    //     ).then(
    //         data => {
    //             ambientesfiltro = data
    //             while(tabla.rows.length > 0){
    //                 tabla.deleteRow(0)
    //             }
    //             try{
    //                 agregarTabla(ambientesfiltro, tabla)
    //             }catch(error){
    //                 console.log('Erro: ', error)
    //             }
    //         }
    //     ).catch(
    //         error => {
    //             console.log("Error encontrado: ", error)
    //         }
    //     )
    // }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop


