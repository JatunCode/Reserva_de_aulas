@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Cancelar Solicitud</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header">
        <form class="row">
            <div class="form-group col-lg-4 col-md-3 align-self-center">
                <label for="inputSearch" class="mr-2">Materia:</label>
                <select type="text" class="form-control w-100" id="inputSearch" list="materias" placeholder="Ingrese texto">
                    <option value="" disabled selected>Seleccione una materia</option>
                    <option value="TODAS LAS MATERIAS">TODAS LAS MATERIAS</option>
                    @foreach($materias as $materia)
                        <option value="{{ $materia['NOMBRE'] }}">{{ $materia['NOMBRE'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 align-self-center">
                <label for="selectMode" class="mr-2">Modo:</label>
                <select class="form-control" id="selectMode">
                    <option value="Todos" selected>Todos</option>
                    <option value="Normal">Normal</option>
                    <option value="Urgente">Urgente</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 align-self-center">
                <label for="selectStatus" class="mr-2">Estado:</label>
                <select class="form-control" id="selectStatus">
                    <option value="Todos" selected>Todos</option>
                    <option value="Aceptado">Reservado</option>
                    <option value="Pendiente">Solicitando</option>
                    <option value="Cancelado">Cancelado</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 ml-auto align-self-center">
                <label for="selectMode" class="mr-2"></label>
                <button type="button" id="btnBuscar" class="btn btn-primary w-100" style="background-color: green">Buscar</button>

            </div>
        </form>
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
                                {{ $solicitud['MODO'] }}
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
                        <td style="width: 40px"><button class="btn btn-info" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                            data-id="{{ $solicitud['ID'] }}" onclick="pressAtention(this)" value="{{$solicitud['ID']}}">VER INFORMACION</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    
@include('admin.components.formularioReserva')

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
    const soli_pend = @json($solis_no_reser);
    let soli_aten = null;

    function pressAtention(button){
        const id = button.value
        const canva = document.getElementById('offcanvasRight')
        canva.style.setProperty('width', '500px')
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
            ambiente.value = `${soli_aten['AMBIENTE']}`
            horario.value = soli_aten['HORARIO']
            motivo.value = soli_aten['MOTIVO']
            modo.value = soli_aten['MODO']
        }else{
            console.log("Fallo al obtener los datos alv no puede ser >:VVVVVVVV")
        }
    }
</script>
<script>
    function cambiarEstado(btn){
        text = btn.value
        const id_solicitud = document.getElementById('docentes')
        const input_select = document.querySelector('select[name="ambiente"]')
        const ob_json = JSON.stringify({
            'ID_SOLICITUD':soli_aten['ID'],
            'ESTADO':btn.value,
            'AMBIENTE':soli_aten['AMBIENTE'],
            'ACTUALIZACIONES':[]
        })

        let nombres = []

        soli_aten['NOMBRE_DOCENTES'].forEach(
            nombre => {
                nombres.push(nombre['Nombre_docente'])
                console.log('Nombre: ', nombre['Nombre_docente'])
            }
        )

        let json_nombres = JSON.stringify(nombres)

        const body = {
            'NOMBRES': json_nombres,
            'TIPO': 'Reserva',
            'ESTADO':text,
            'FECHA':soli_aten['FECHA_RESERVA'],
            'MATERIA':soli_aten['MATERIA'],
            'AMBIENTE':soli_aten['AMBIENTE'],
            'RAZONES':[]
        }

        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    sendForm(ob_json, body);
                }
            })
        });
    }

    function sendForm(ob_json, body){
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF
        console.log('Datos que se tratan de enviar: ', ob_json)
        fetch(
            'http://127.0.0.1:8000/docente/solicitud/cancelar',
            {
                method: 'PUT',
                headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                body:ob_json
            }
        ).then(
            response => {
                console.log('Datos que se tratan de enviar: ', ob_json)
                if(!response.ok){
                    throw new Error('Respuesta del servidor no valida')
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: `¡Solicitud cancelada exitosamente!`,
                        showConfirmButton: false,
                        timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                    }).then(() => {
                        // Después de cerrar la alerta, limpiar el formulario y cerrar el offcanvas
                        sendNotificacion({
                            'TOKEN':token,
                            'BODY': body
                        })
                        limpiar()
                        cerrarRazones()
                        cerrarMain()
                    })
                }
            }
        ).then(
            data => {
                console.log('Contendido de la reserva guardada: ', data)
            }
        ).catch(
            error=>{
                console.log('Error encontrado: ', error)
            }
        )
    }
    function sendNotificacion(data){
        const cuerpo = JSON.stringify(data['BODY'])
        Swal.fire({
            title: 'Enviando notificacion al o los docentes.',
            text: 'Por favor, espera.',
            didOpen: () => {
                Swal.showLoading()
            }
        })
        fetch('http://127.0.0.1:8000/docente/notificacion/store',
            {
                method:'POST', 
                headers:{
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': data['TOKEN']
                },
                body:cuerpo
            }
        ).then(
            response => response.json().then(data => JSON.stringify({status: response.status, body: data}))
        ).then(
            response => {
                    Swal.close()
                    window.location.reload()
                    if (response.status == 200) {
                        return response
                    } else {
                        console.log('Response: ', response);
                    }
            }
        ).catch(
            error => {
                console.log('Error del servidor: ', error)
            }
        )
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnBuscar").addEventListener('click', function() {
            const input_busqueda = document.getElementById('inputSearch')
            const input_modo = document.getElementById('selectMode')
            const input_estado = document.getElementById('selectStatus')
            console.log('Input modo: ', input_modo)
            const materia = input_busqueda.options[input_busqueda.selectedIndex].value
            const modo_value = input_modo.options[input_modo.selectedIndex].value
            const estado_value = input_estado.options[input_estado.selectedIndex].value

            console.log('Dato busqueda: ', input_busqueda)
            console.log('Dato modo: ', modo_value)

            const filtroSolis = soli_pend.filter(solicitud => {
                                const materiaMatch = (materia === 'TODAS LAS MATERIAS' || solicitud.AMBIENTE.toUpperCase().includes(materia.toUpperCase()))
                                const modoMatch = (modo_value === 'Todos' || solicitud.MODO === modo_value.toUpperCase())
                                const estadoMatch = (estado_value === 'Todos' || solicitud.AMBIENTE.toUpperCase().includes(estado_value.toUpperCase()))
                                return materiaMatch && modoMatch && estadoMatch
                                })
            const tabla = document.getElementById('tableAmbientes')
            console.log('Arreglo ambientes: ', filtroSolis)
            agregarTabla(filtroSolis, tabla)
        });
    });

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
                
                <td>${solicitud['FECHA_RESERVA']}</td>
                <td>${solicitud['AMBIENTE']}</td>
                <td>${solicitud['MATERIA']}</td>
                <td>${solicitud['FECHA_HORASOLI']}</td>
                <td>${solicitud['HORARIO']}</td>
                <td >
                    <span class="btn  btn-sm btn-block" style="background-color: ${solicitud['MODO'] === 'NORMAL' ? '#198754' : '#dc3545'};color: white">
                        ${(isObject(solicitud['MODO']) || solicitud['MODO'].includes('URGENTE'))? 'URGENTE': 'NORMAL'}
                    </span>
                </td>
                <td>
                    <span class="btn btn-sm btn-block" style="background-color: ${solicitud['ESTADO'] === 'ACEPTADO' ? '#198754' : solicitud['ESTADO'] === 'PENDIENTE' ? '#FFC107' : '#dc3545'}; color: ${solicitud['ESTADO'] === 'PENDIENTE' ? 'black' : 'white'}">
                        ${solicitud['ESTADO']}
                    </span>
                </td>

                <td style="width: 40px"><button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                    data-id="${solicitud['ID']}" style="background-color:green" onclick="pressAtention(this)" value="${solicitud['ID']}">Atender</button>
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
@stop
