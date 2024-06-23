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
            <input class="form-control" type="text" name="busqueda" placeholder="Buscar solicitud por Materia/Aula">
            <p id="messageErrorBusqueda" style="display: none; color: red">*No se encontro resultados</p>
        </div>
        <div class="col-md-2">
            <label class="form-label" for="modo">Modo</label>
            <select class="form-select" name="modo-busqueda">
                <option value="Todos">Todos</option>
                <option value="URGENTE">Urgente</option>
                <option value="NORMAL">Normal</option>
            </select>
        </div>
        <div class="col-md-2">
            
            <button class="btn btn-primary d-inline-block w-7" name="boton" style="background-color:green" onclick="buscarSolicitud()">Buscar</button>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 40px">Fecha de solicitud</th>
                    <th style="width: 20px">Aula</th>
                    <th style="width: 75px">Materia</th>
                    <th style="width: 40px">Fecha de reserva</th>
                    <th style="width: 40px">Horario</th>
                    <th style="width: 30px">Modo</th>
                    <th style="width: 40px">Estado</th>
                    <th style="width: 40px">Detalles</th>
                </tr>
            </thead>
            <tbody id="tableAmbientes">
                @foreach($solis_no_reser as $solicitud)
                    <tr>
                        <td style="width: 35px">{{ $solicitud['FECHA_HORASOLI'] }}</td>
                        <td style="width: 35px">{{ $solicitud['AMBIENTE'] }}</td>
                        <td style="width: 150px">{{ $solicitud['MATERIA'] }}</td>
                        <td class="reserva" style="width: 35px">{{ $solicitud['FECHA_RESERVA'] }}</td>
                        <td style="width: 20px">{{ $solicitud['HORARIO'] }}</td>
                        <td class="modo">
                            <span class="btn  btn-sm btn-block
                                @if($solicitud['ESTADO'] == 'CANCELADO')
                                    background-color: #FFC0B7;btn btn-outline-secondary ;
                                @elseif($solicitud['MODO'] == 'NORMAL')
                                    ;
                                    btn-success
                                @else
                                    btn-danger
                                @endif
                                " aria-controls="offcanvasRight">
                                {{ @$retVal = (!is_object($solicitud['MODO'])) ? 'NORMAL' : 'URGENTE' ; }}
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
                        <td style="width: 40px"><button class="btn btn-success" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                            data-id="{{ $solicitud['ID'] }}" style="background-color:green" onclick="pressAtention(this)" value="{{$solicitud['ID']}}">ATENDER</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@stop

@include('admin.viewRespondSolicitud')

@section('css')
<link rel="stylesheet" href="/css/admin/home.css">
<!-- CSS de Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<style>
    @keyframes blink {
        0% { background-color: rgb(243, 73, 73); }
        25% { background-color: rgb(250, 173, 173); }
        50% { background-color: white; }
        75% { background-color: rgb(250, 173, 173); }
        100% { background-color: rgb(243, 73, 73); }
    }

    .blink {
        animation: blink 2s infinite;
    }
</style>
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
    let ambientes = []
    soli_pend = @json($solis_no_reser)
    
    let array_busqueda = soli_pend.map(solicitud => {return {'UNION_SOLI':solicitud['AMBIENTE']+' '+solicitud['MATERIA']}})
    console.log('Arreglo de union: ', array_busqueda)

    fetch(
        'http://127.0.0.1:8000/api/fetch/ambientes'
    ).then(
        response => response.json()
    ).then(
        data => {
            ambientes = data
            console.log("Ambientes: ", ambientes)
        }
    ).catch(
        error => {
            console.log("Error encontrado: ", error)
        }
    )
    function obtenerAmbientes(cant){
        return ambientes.filter(
            ambiente => {
                let num_div = cant/10
                return (ambiente['CAPACIDAD'] <= num_div*10+10 && ambiente['CAPACIDAD'] >= num_div*10-10)
            }
        )
    }

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
    document.addEventListener('DOMContentLoaded', () => {
        const tableRows = document.querySelectorAll('#tableAmbientes tr');
        const hora_actual = new Date();
        const hora_mas_cinco = new Date(hora_actual);
        hora_mas_cinco.setHours(hora_actual.getHours() + 5);

        tableRows.forEach(element => {
            const text = element.querySelector('.modo span').textContent;
            const hora = element.querySelector('.reserva').textContent.split(' ')[1];
            const hora_reserva = new Date();
            hora_reserva.setHours(...hora.split(':'));
            
            if (text === 'URGENTE' && hora_reserva >= hora_actual && hora_reserva < hora_mas_cinco) {
                element.classList.add('blink');
            }
        });
    });
    function pressAtention(button){
        const id = button.value
        const canva = document.getElementById('offcanvasRight')
        soli_aten = soli_pend.find(elemento => elemento['ID'] == id)
        let ambientes_filtrado = obtenerAmbientes(soli_aten['CANTIDAD'])
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
            ambiente.innerHTML = ''
            ambiente.innerHTML +=` <option value="${soli_aten['AMBIENTE']}" selected>${soli_aten['AMBIENTE']}</option>
                    `
            ambientes_filtrado.forEach(
                nombre => {
                    ambiente.innerHTML +=`
                        <option value="${nombre['NOMBRE']}">${nombre['NOMBRE']}</option>
                    `
                }
            )
            horario.value = soli_aten['HORARIO']
            motivo.value = soli_aten['MOTIVO']
            modo.value = soli_aten['MODO']
        }else{
            console.log("Fallo al obtener los datos alv no puede ser >:VVVVVVVV")
        }
    }

    function buscarSolicitud(){
        const input_busqueda = document.querySelector('[name="busqueda"]').value
        const input_modo = document.querySelector('[name="modo-busqueda"]')
        console.log('Input modo: ', input_modo)
        const modo_value = input_modo.options[input_modo.selectedIndex].value

        console.log('Dato busqueda: ', input_busqueda)
        console.log('Dato modo: ', modo_value)

        const filtroAmbiente = soli_pend.filter(solicitud => {
                            const modoMatch = (modo_value === 'Todos' || solicitud.MODO === modo_value.toUpperCase())
                            const ambienteMatch = (input_busqueda === '' || solicitud.AMBIENTE.toUpperCase().includes(input_busqueda.toUpperCase()))
                            return modoMatch && ambienteMatch
                            })
        const filtroMateria = soli_pend.filter(solicitud => {
                            const modoMatch = (modo_value === 'Todos' || solicitud.MODO === modo_value.toUpperCase())
                            const materiaMatch = (input_busqueda === '' || solicitud.MATERIA.includes(input_busqueda.toUpperCase()))
                            return modoMatch && materiaMatch
                            })
        const tabla = document.getElementById('tableAmbientes')
        console.log('Arreglo ambientes: ', filtroAmbiente)
        console.log('Arreglo materia: ', filtroMateria)
        agregarTabla((filtroAmbiente.length > 0) ? filtroAmbiente : filtroMateria, tabla)
    }
    
    function agregarTabla(data, tabla) {
        // Eliminar los elementos existentes en el cuerpo de la tabla
        tabla.innerHTML = '';
        let contador = 1;
        // Iterar sobre los nuevos datos y agregar cada solicitud como una fila en la tabla
        data.forEach(solicitud => {
            // Crear una nueva fila
            var row = document.createElement('tr');
            
            // Agregar las celdas con los datos de la solicitud a la fila
            row.innerHTML = `
                
                <td>${solicitud['FECHA_HORASOLI']}</td>
                <td>${solicitud['AMBIENTE']}</td>
                <td>${solicitud['MATERIA']}</td>
                <td class="reserva">${solicitud['FECHA_RESERVA']}</td>
                <td>${solicitud['HORARIO']}</td>
                <td class="modo">
                    <span class="btn  btn-sm btn-block" style="background-color: ${solicitud['MODO'] === 'NORMAL' ? '#198754' : '#dc3545'};color: white">
                        ${(isObject(solicitud['MODO']) || solicitud['MODO'].includes('URGENTE'))? 'URGENTE': 'NORMAL'}
                    </span>
                </td>
                <td>
                    <span class="btn btn-sm btn-block" style="background-color: ${solicitud['ESTADO'] === 'ACEPTADO' ? '#198754' : solicitud['ESTADO'] === 'PENDIENTE' ? '#FFC107' : '#dc3545'}; color: ${solicitud['ESTADO'] === 'PENDIENTE' ? 'black' : 'white'}">
                        ${solicitud['ESTADO']}
                    </span>
                </td>

                <td style="width: 40px"><button class="btn btn-success" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                    data-id="${solicitud['ID']}" style="background-color:green" onclick="pressAtention(this)" value="${solicitud['ID']}">ATENDER</button>
                </td>
            `;
            
            // Agregar la fila al cuerpo de la tabla
            tabla.appendChild(row);
        });
    }

    function isObject(params) {
        return typeof params === "object" && params !== null
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop


