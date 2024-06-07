<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    @csrf
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Atencion reserva</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-md-12" >
                <label for="docentes" class="form-label">Docentes</label>
                <div id="docentes">

                </div>
            </div>
            <div class="col-md-4">
                <label for="fechasoli" class="form-label">Fecha solicitud</label>
                <input type="text" name="fechasoli" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="fechares" class="form-label">Fecha reserva</label>
                <input type="text" name="fechares" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="text" name="capacidad" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="grupos" class="form-label">Grupos</label>
                <input type="text" name="grupos" class="form-control" readonly>
            </div>
            <div class="col-md-12">
                <label for="materia" class="form-label">Materia</label>
                <input type="text" name="materia" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="ambiente" class="form-label">Ambiente</label>
                <input type="text" name="ambiente" class="form-control" readonly>
            </div>
            <div class="col-md-5">
                <label for="horario" class="form-label">Horario</label>
                <input type="text" name="horario" class="form-control" readonly>
            </div>
            <div class="col-md-7">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" name="motivo" class="form-control" readonly>
            </div>
            <div class="col-md-4">
                <label for="modo" class="form-label">Modo</label>
                <input type="text" name="modo" class="form-control" readonly>
            </div>
            <div class="col-md-12" id="desc-modo">
                <label for="desc" class="form-label">Descripcion</label>
                <input type="textarea" name="desc" class="form-control" readonly>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-primary d-inline-block w-75" name="confirmar" style="background-color: green" onclick="cambiarEstado(this)" value="ACEPTADO">Confirmar</button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary d-inline-block w-75" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRightRa" aria-controls="offcanvasRight"
                        style="background-color:red" >Cancelar</button>
            </div>
        </div>
        <div>
            <button type="button" class="btn btn-primary d-inline-block w-75" name="atras" style="background-color:red" onclick="cerrarMain()">Atras</button>
        </div>
    </div>
</div>

@include('admin.components.formularioRazones')

<script>
    const canvas_main = document.getElementById('offcanvasRight')
    const canvas_razones = document.getElementById('offcanvasRightRa')
    const canvas_main_instance = bootstrap.Offcanvas.getInstance(canvas_main)
    const canvas_razones_instance = bootstrap.Offcanvas.getInstance(canvas_razones)

    function cambiarEstado(button){
        let text = button.value
        let actualizacion = obtainValues()
        const id_solicitud = document.getElementById('docentes')
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF

        const ob_json = JSON.stringify({
            'ID_SOLICITUD':soli_aten['ID'],
            'ESTADO':button.value,
            'ACTUALIZACIONES':actualizacion
        })

        const body = {
            'NOMBRES': soli_aten['NOMBRES'],
            'TIPO': 'Reserva',
            'ESTADO':button.value,
            'FECHA':soli_aten['FECHA_RESERVA'],
            'MATERIA':soli_aten['MATERIA'],
            'AMBIENTE':soli_aten['AMBIENTE'],
            'RAZONES':actualizacion
        }
        fetch(
            'reservas/store',
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
                        title: `¡Reserva ${(text == 'ACEPTADO') ? 'guardada' : 'cancelada' } exitosamente!`,
                        showConfirmButton: false,
                        timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                    }).then(() => {
                        // Después de cerrar la alerta, limpiar el formulario y cerrar el offcanvas
                        sendNotificacion({
                            'TOKEN':token,
                            'BODY': body
                        })
                        limpiar()
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
        fetch('http://127.0.0.1:8000/admin/notificacion/store',
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
                    window.location.reload();
                    if (response.status == 200) {
                        return response;
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

    function cerrarMain(){
        canvas_main_instance.hide()
    }
</script>