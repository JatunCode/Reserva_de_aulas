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
            <button class="btn btn-primary d-inline-block w-75" id="boton-sub" style="background-color: green" onclick="cambiar()" value="">Cambiar Horarios</button>
            <button class="btn btn-primary d-inline-block w-75" id="boton-cancel" type="button" style="background-color:red" onclick="limpiar()" >Atras</button>
        </div>
    </div>
</div>

<script>
    let ambientes = []
    let materia = []

    function cambiar(){
        const button_cambio = document.getElementById('boton-sub')
        const button_cancelar = document.getElementById('boton-cancel')
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
        button_cancelar.textContent = 'Cancelar'
        button_cambio.value = 'UPDATE'
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

    document.getElementById('boton-sub').addEventListener('click', 
        function(event){
            if(event.target.value == "UPDATE"){
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
                console.log(json_array_update)
                event.target.textContent = 'Cambiar Horarios'
                event.target.value = ''
            }
        }
    )
</script>