<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    @csrf
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Cancelacion de reserva</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card body">
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
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card body">
                    <ul style="list-style: none" id="list-razones">
                        @foreach ($razones as $razon)
                            <li>
                                <input type="checkbox" name="razonli" value="{{ $razon['id_razones'] }}"><label for="razonli" class="form-label">{{ $razon['razon'] }}</label>
                            </li>
                        @endforeach
                    </ul>
                    <p id="messageErrorRazon" style="color: red; display: none">*Seleccione una razon</p>
                </div>
    
                <div class="col-md-8">
                    <label for="razon" class="form_label">Registrar nueva razon</label>
                    <input type="text" class="form-control" name="razon" placeholder="Escriba la razon de cancelacion de reserva">    
                    <p id="messageErrorRazon" style="display: none; color: red">*La razon ya existe</p>
                </div>
                
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-success" type="button" id="ref-add" onclick="agregarRazon()">
                        <i class="bi bi-clipboard-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary d-inline-block w-75" name="confirmar" style="background-color: green" onclick="cambiarEstado(this)" value="CANCELADO">Confirmar</button>
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-primary d-inline-block w-75" name="atras" style="background-color:red" onclick="cerrarMain()">Atras</button>
            </div>
        </div>
        
    </div>
</div>

<script>
    const regex = /[^0-9]/
    let bandera = false
    const message_razon = document.getElementById('messageErrorRazon')

    const razones_list = document.querySelectorAll('[name="razonli"]')

    razones_list.forEach(
        element => {
            element.addEventListener('change',
                function(event){
                    if(event.target.checked == true){
                        message_razon.style.display = 'none'
                    }
                }
            )
        }
    )

    function limpiar(){
        const razon = document.querySelector('[name="razon"]')
        const lista_razones = document.querySelectorAll('[name="razonli"]')
        lista_razones.forEach(element => {
            if(!element.value){
                console.log("Numero de id: ",parseInt(element.value, 10))
                element.closest('li').remove()
            }
            element.checked = false
            console.log('Se borro')
        });
        razon.value = ''
        console.log('Terminar funcion')
    }

    function agregarRazon(){
        let input_razon = document.querySelector('[name="razon"]').value
        const div_lista = document.getElementById('list-razones')

        if(input_razon != ''){
            const newLi = document.createElement('li')

            newLi.innerHTML = `<input type="checkbox" name="razonli" value="${input_razon}"><label for="razonli" class="form-label">${input_razon}</label>`
            div_lista.appendChild(newLi)
        }
        input_razon = ''
    }

    function isObject(object){
        return typeof object === 'object' && object !== null
    }

    function obtainValues(){
        const lista_razones = document.querySelectorAll('[name="razonli"]')

        const lista_reg = []
        const lista_no_reg = []
        lista_razones.forEach((element)=>{

            if(regex.test(parseInt(element.value, 10))){
                lista_no_reg.push(element.value)
            }else if(element.checked){
                lista_reg.push(element.value)
            }
        })
        bandera = ([...lista_razones].find(element => element.checked)) ? true : false
        return {'LISTA_NO_REG': lista_no_reg, 'LISTA_REG':lista_reg}
    }

    function cambiarEstado(button){
        let text = button.value
        let actualizacion = obtainValues()
        const id_solicitud = document.getElementById('docentes')
        
        console.log('Listas: ', actualizacion)
        const ob_json = JSON.stringify({
            'ID_SOLICITUD':soli_aten['ID'],
            'ESTADO':button.value,
            'ACTUALIZACIONES':actualizacion
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
            'ESTADO':button.value,
            'FECHA':soli_aten['FECHA_RESERVA'],
            'MATERIA':soli_aten['MATERIA'],
            'AMBIENTE':soli_aten['AMBIENTE'],
            'RAZONES':actualizacion
        }

        console.log('Objeto de envio: ', body) 
        console.log("Bandera: ", bandera)
        
        if(bandera == true){
            const modalContent =
            `<div>
                <p><strong>Nombre(s):</strong>${nombres}</p>
                <p><strong>Materia:</strong>${soli_aten['MATERIA']}</p>
                <p><strong>Modo:</strong>${soli_aten['MODO']}</p>
                <p><strong>Descripcion:</strong>${soli_aten['MODO']}</p>
                <p><strong>Ambiente:</strong>${soli_aten['AMBIENTE']}</p>
                <p><strong>Razon(es):</strong>${actualizacion}</p>
            </div>`

            Swal.fire({
                icon: 'info',
                title: 'Confirmación de modificacion',
                html: modalContent,
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario si se confirma la acción
                    console.log("Formato del json: ", ob_json)
                    sendForm(ob_json, body)
                }
            })
        }else{
            message_razon.style.display = 'block'
        }
    }

    function sendForm(ob_json, body){
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Obtener el token CSR

        fetch(
            'update',
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
                        title: `¡Reserva cancelada exitosamente!`,
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
        console.log('Datos de la notificacion: ', cuerpo)
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
            data => {
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
        const canvas = document.getElementById('offcanvasRight')
        const canvas_instance = bootstrap.Offcanvas.getInstance(canvas)
        limpiar()
        canvas_instance.hide()
    }
</script>