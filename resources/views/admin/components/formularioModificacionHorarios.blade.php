<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    @csrf
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Modificar horario</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label for="docente">Docente</label>
                <input type="text" class="form-control" name="docente" readonly>
            </div>
        </div>
        <div id="horarios">

        </div>
        <div class="col-md-12 mt-3 text-center">
            <button class="btn btn-primary w-100" id="boton-sub" style="background-color: green; display: none">Guardar cambios</button>
            <button class="btn btn-primary w-100" id="boton-mod" style="background-color: green" onclick="cambiar()" value="">Cambiar Horarios</button>
            <button class="btn btn-primary w-100" id="boton-atras" type="button" style="background-color:red" onclick="cerrar()" >Atras</button>
            <button class="btn btn-primary w-100" id="boton-cancel" type="button" style="background-color:red; display:none" onclick="limpiar()" >Cancelar</button>
        </div>
    </div>
</div>

<script>
    let ambientes = []
    let materia = []
    const button_guardar = document.getElementById('boton-sub')
    const button_cambio = document.getElementById('boton-mod')
    const button_cancelar = document.getElementById('boton-cancel')
    const button_atras = document.getElementById('boton-atras')

    document.getElementById('boton-sub').addEventListener('click', 
        function(event){
            if(event.target.value == "UPDATE"){
                const materia = document.getElementById('materia').textContent
                const docente = document.querySelector('[name="docente"]').value
                const divs = document.querySelectorAll('div.row[id]')
                
                const array_update = []
                divs.forEach(
                    element => {
                        const dia = element.querySelector('[name="dia"]')
                        const dia_select = dia.options[dia.selectedIndex]
                        array_update.push({
                            'ID_HORARIO': element.id,
                            'DIA':element.querySelector('[name="dia"]').value,
                            'INICIO': element.querySelector('[name="inicio"]').value,
                            'FIN': element.querySelector('[name="fin"]').value,
                            'AMBIENTE': element.querySelector('[name="ambiente"]').value
                        })
                    }
                )
                let json_array_update = JSON.stringify(array_update)
                console.log(array_update)

                let content = `
                    <p><strong>Docente</strong>${docente}</p>
                    <p><strong>Materia</strong>${materia}</p>
                    <div>
                        <p><strong>Dia</strong> <strong>Inicio</strong> <strong>Salida</strong> <strong>Ambiente</strong></p>
                    </div>`
                const modalContent = content+Object.entries(array_update).map(([key, value]) => {                    
                    return `<div>
                        <p><strong>Horario ${String(parseInt(key, 10)+1)}:</strong> ${value['DIA']} ${value['INICIO']} ${value['FIN']} ${value['AMBIENTE']}</p>
                    </div>`
                }).join('')

                Swal.fire({
                    icon: 'info',
                    title: 'Confirmación de envío',
                    html: modalContent,
                    showCancelButton: true,
                    confirmButtonText: 'Enviar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario si se confirma la acción
                        console.log("Formato del json: ", json_array_update)
                        sendForm(json_array_update)
                    }
                })
            }
        }
    )

    function sendForm(json){
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtener el token CSRF
        fetch(
            'http://127.0.0.1:8000/api/fetch/horarios/update',
            {
                method:'PUT',
                headers:{
                    'Content-type':'aplication/json',
                    'X-CSRF-TOKEN': token
                },
                body:json
            }
        ).then(
            response => {
                if(response.ok){
                    Swal.fire({
                        icon: 'success',
                        title: '¡Ambiente modificado exitosamente!',
                        showConfirmButton: false,
                        timer: 1500 // Cerrar automáticamente después de 1.5 segundos
                    }).then(() => {
                        // Después de cerrar la alerta, limpiar el formulario y cerrar el offcanvas
                        limpiar()
                        cerrar()
                    })
                }else{
                    console.log('Error del servidor')
                }
            }
        ).then(
            data => {
                console.log('Horarios modificados: ', data)
            }
        ).catch(
            error => {
                console.log(error)
            }
        )
        
    }

    function cambiar(){
        const divs = document.querySelectorAll('div > input[name="dia"]')
        const dias = document.querySelectorAll('[name="dia"]')
        const horas = document.querySelectorAll('input[type="time"]')
        const ambientes = document.querySelectorAll('[name="ambiente"]')
        const nombres_dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado']

        let i = 0
        if(button_cambio.value != 'UPDATE'){
            divs.forEach(
                element => {
                    const select = document.createElement('select')
                    select.name = 'dia'
                    select.className = 'form-control'
                    nombres_dias.forEach(
                        element => {
                            const elementUp = element.toUpperCase()
                            if(elementUp == dias[i].value){
                                select.innerHTML += `<option value="${elementUp}" selected>${element}</option>`
                            }else{
                                select.innerHTML += `<option value="${elementUp}">${element}</option>`
                            }
                        }
                    )
                    i += 1
                    element.parentNode.appendChild(select)
                    element.remove()
                    console.log("Elemento de la lsta de divs: ",element)
                }
            )
            
            horas.forEach(element => {
                element.readOnly = !element.readOnly
            });
            ambientes.forEach(element => {
                element.readOnly = !element.readOnly
            });
            button_cambio.textContent = 'Guardar Cambios'
        }
        button_atras.style.display = 'none'
        button_cambio.style.display = 'none'
        button_cancelar.style.display = 'block'
        button_guardar.style.display = 'block'
    }

    function validateHoras(){
        const inicio = document.querySelector('[name="inicio"]').value
        const fin = document.querySelector('[name="fin"]').value
        const dia = document.querySelector('[name="dia"]')
        let dia_select = dia.options[dia.selectedIndex]
        const message = document.getElementById('messageErrorHorario')
        
        if(inicio != '' && fin != ''){
            const list_ini = String(inicio).split(':')
            const list_fin = String(fin).split(':')
            const segundos_ini = parseInt(list_ini[0], 10)*3600 + parseInt(list_ini[1], 10)*60
            const segundos_fin = parseInt(list_fin[0], 10)*3600 + parseInt(list_fin[1], 10)*60
            const string_hora = dia_select.value + String(segundos_ini) + String(segundos_fin)

            if((segundos_ini <= 24300 || segundos_ini >= 78300) || (segundos_fin <= 24300 || segundos_fin >= 78300)){
                message.textContent = '*El rango debe ser entre 06:45 y 21:45'
                message.style.display = 'block'
            }else if(horas.find(element => element == string_hora)){
                message.textContent = `*El horario ya esta ocupado en el dia ${dia_select.value}`
                message.style.display = 'block'
            }
        }else{
            message.textContent = '*Debe introducir una hora'
            message.style.display = 'block'
        }
    }

    function validateAmbiente(text){
        let value = text.value
        const regexaula = /[^0-9A-z]/
        const regexaudi = /[^A-z]/
        const message = document.getElementById('messageErrorAmbiente')

        if(value != ''){
            if(regexaula.test(value) || regexaudi.text(value)){
                if(!ambientes.find( ambiente => value == ambiente['NOMBRE'])){
                    message.textContent = '*El ambiente no existe'
                    message.style.display = 'block'
                }else{
                    message.style.display = 'none'
                }
            }else{
                message.textContent = '*No se permiten caracteres especiales'
                message.style.display = 'block'
            }
        }else{
            message.textContent = '*Campo obligatorio'
            message.style.display = 'block'
        }
    }

    function limpiar(){
        const div = document.getElementById('horarios');
        div.innerHTML = ''
        horario_actual['HORARIOS_DOCENTE'].forEach(
            element => {
                div.innerHTML += 
                `
                    <div class="card body">
                        <label class="form-label">Materia: ${element['NOMBRE_MATERIA']}</label>
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
                                                <p id="messageErrorHorario" style="display: none; color: red"></p>
                                                <p id="messageErrorAmbiente" style="display: none; color: red"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        `
                    }
                )
                div.appendChild(div_horas)
            }
        )
        button_atras.style.display = 'block'
        button_cancelar.style.display = 'none'
        button_cambio.style.display = 'block'
        button_guardar.style.display = 'none'
    }

    function cerrar(){
        const canvas = document.getElementById('offcanvasRight')
        const canvas_instance = bootstrap.Offcanvas.getInstance(canvas)
        canvas_instance.hide();
    }
</script>