@extends('adminlte::page')

@section('title', 'Horarios Facultadivo')

@section('content_header')
<h1>Horarios registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header row">
        
        
        <div class="col-md-4" id="containerDocente">
            <label class="form-label" for="docente">Docente</label>
            <input class="form-control" type="text" name="docente-buscar" placeholder="Buscar docente">
            <p id="messageErrorDocente" style="display: none; color: red">*No se encontro el docente</p>
        </div>
    </div>
    <div class="card-header">
        <h3 class="card-title">Horarios registrados</h3>
    </div>
    <div class="card-body table-responsive">
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 40px">Docente</th>
                    <th style="width: 40px">Acciones</th>
                </tr>
            </thead>
            <tbody id="tableHorarios">
                @foreach($horarios as $horario)
                    <tr>
                        <th style="width: 40px">{{ $horario['NOMBRE'] ?? '' }}</td>
                        <th style="width: 40px"><button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                            data-id="{{ $horario['NOMBRE'] }}" style="background-color:green" onclick="pressEdicion(this)" value="{{$horario['NOMBRE']}}">Seleccionar</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</div>

@stop

@include('admin.components.formularioModificacionHorarios')

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
    let docentes = []
    let ambientes = []
    
    let docentesFiltro = []

    let horarios_estr = @json($horarios)

    let horario_actual = null

    let banderaAmbiente = true
    let banderaHora = true
    let countPendientes = 0
    let countUrgentes = 0
    fetch("http://127.0.0.1:8000/api/fetch/solicitud/count")
        .then(response => response.json())
        .then(data => {
            countPendientes = data['pendientes']
            countUrgentes = data['urgentes']
            console.log('Datos: ', data)
        })
        .catch(error => {
            console.log("Error al obtener los conteos de datos.", error)
        })
    fetch('http://127.0.0.1:8000/api/fetch/docentes').then(
        response => response.json()
    ).then(
        data => {
            docentes = data
        }
    ).catch(
        error => {
            console.log("Error encontrado: ", error)
        }
    )

    fetch('http://127.0.0.1:8000/api/fetch/ambientes').then(
        response => response.json()
    ).then(
        data => {
            ambientes = data
            mensaje()
        }
    ).catch(
        error => {
            console.log("Error encontrado: ", error)
        }
    )

    function mensaje(){
        Swal.fire({
            title: "<strong>Tiene solicitudes por atender</strong>",
            html: `<strong>Solicitudes pendientes: ${countPendientes}</strong>
                    <br>
                    <strong style="color: red">Solicitudes urgentes: ${countUrgentes}</strong>
                `,
            icon: "info",
            showCancelButton:true,
            cancelButtonColor: "",
            cancelButtonText: "Seguir en la paigna",
            confirmButtonColor: "#7ebd5b",
            confirmButtonText: "Atender solicitudes",
            showClass: {
                popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
                `,
            },
            hideClass: {
                popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
                `,
            },
        }).then((result) => {
            if(result.isConfirmed){
                window.location.href = "http://127.0.0.1:8000/admin/reservas/atencion";
            }
        })
    }

    function pressEdicion(button){
        const id = button.value
        const canva = document.getElementById('offcanvasRight')
        button_guardar.style.display = 'none'
        button_cambio.style.display = 'block'
        button_cancelar.style.display = 'none'
        button_atras.style.display = 'block'
        canva.style.setProperty('width', '600px')
        let i = 1
        let horario = horarios_estr.find(elemento => elemento['NOMBRE'] == id)
        console.log('Horario: ', horario)
        if(horario){
            const docente = document.querySelector('[name="docente"]')
            const div = document.getElementById('horarios');
            horario_actual = horario
            docente.value = horario['NOMBRE']
            div.innerHTML = ''
            horario['HORARIOS_DOCENTE'].forEach(
                element => {
                    div.innerHTML += 
                    `
                        <div class="card body">
                            <label id="materia" class="form-label">Materia: ${element['NOMBRE_MATERIA']}</label>
                            <label class="form-label">Grupo: ${element['GRUPO_MATERIA']}</label>
                        </div>
                    `
                    const div_horas = document.createElement('div')
                    element['HORARIOS_MATERIA'].forEach(
                        horario => {
                            div_horas.innerHTML += 
                            `
                            <div class="col-md-12">
                                        <div class="row" id="${horario['ID_HORARIO']}">
                                            <div class="col-md-3">
                                                <label for="dia" class="form-label">Dia</label>
                                                <input type="text" class="form-control" name="dia" value="${horario['DIA']}" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inicio" class="form-label">Inicio</label>
                                                <input type="time" class="form-control" name="inicio" value="${horario['INICIO']}" onchange="validateHoras(this)" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="fin" class="form-label">Salida</label>
                                                <input type="time" class="form-control" name="fin" value="${horario['FIN']}" onchange="validateHoras(this)" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="ambiente" class="form-label">Ambiente</label>
                                                <input type="text" class="form-control" name="ambiente" value="${horario['AMBIENTE']}" onchange="validateAmbiente(this)" readonly>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <p id="messageErrorHorario" style="display: none; color: red"></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p id="messageErrorAmbiente" style="display: none; color: red"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            `
                            i += 1
                        }
                    )
                    div.appendChild(div_horas)
                }
            )
            i = 0

        }else{
            console.log("Fallo al obtener los datos alv no puede ser >:VVVVVVVV")
        }

    }

    document.querySelector('[name="docente-buscar"]').addEventListener('keydown',
        function(event){
            //event.preventDefault()
            const tabla  =  document.getElementById('tableHorarios')
            const message = document.getElementById('messageErrorDocente')
            const docentes_encontrado = docentes.filter(docente => docente['NOMBRE'].includes(event.target.value.toUpperCase()))
            if(!docentes_encontrado){
                message.style.display = 'block'
                console.log("No encontro al docente: ", event.target.value)
                console.log("No encontro al docente: ", docentes_encontrado)
                console.log("Docentes filtro: ", docentesFiltro,"Docentes: ",docentes)
            }else if(event.target.value == ''){
                agregarTabla(docentes, tabla)
            }else{
                message.style.display = 'none'
                console.log("Encontro al docente: ", event.target.value,docentes_encontrado)
                while(tabla.rows.length > 0){
                    tabla.deleteRow(0)
                }
                try{
                    agregarTabla(docentes_encontrado, tabla)
                    console.log('Formato del objeto: ', docentes_encontrado)
                }catch(error){
                    console.log('Erro: ', error)
                }
            }
        }
    )
    
    function agregarTabla(lista, tabla){
        lista.forEach(elemento => {
            tabla.innerHTML += 
            `<tr>
                <td style="width: 35px">${elemento['NOMBRE']}</td>
                <th style="width: 40px"><button class="btn btn-sm solicitar-btn mx-1" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"
                    data-id="${elemento['NOMBRE']}" style="background-color:green" onclick="pressEdicion(this)" value="${elemento['NOMBRE']}">Atender</button></td>
            </tr>`
            console.log('Ingresando al inner')
        })
    }

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop



