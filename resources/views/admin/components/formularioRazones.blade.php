<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightRa" aria-labelledby="offcanvasRightLabel">
    @csrf
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Formulario Razones</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card body">
            <ul style="list-style: none" id="list-razones">
                @foreach ($razones as $razon)
                    <li>
                        <input type="checkbox" name="razonli" value="{{ $razon['id_razones'] }}"><label for="razonli" class="form-label">{{ $razon['razon'] }}</label>
                    </li>
                @endforeach
            </ul>
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
    
        <div class="col-md-12 mt-3 text-center">
            <button class="btn btn-primary d-inline-block w-75" id="boton-sub" onclick="cambiarEstado(this)" style="background-color: green" value="CANCELADO">Aceptar</button>
            <button class="btn btn-primary d-inline-block w-75" type="button" style="background-color:red" onclick="limpiar()" >Atras</button>
        </div>
    </div>
</div>

<script>
    const regex = /[^0-9]/
    function limpiar(){
        const lista_razones = document.querySelectorAll('[name="razonli"]')
        lista_razones.forEach(element => {
            if(!element.value){
                console.log("Numero de id: ",parseInt(element.value, 10))
                element.closest('li').remove()
            }
            console.log('Se borro')
        });
        console.log('Terminar funcion')
    }

    function agregarRazon(){
        const input_razon = document.querySelector('[name="razon"]').value
        const div_lista = document.getElementById('list-razones')

        if(input_razon != ''){
            const newLi = document.createElement('li')

            newLi.innerHTML = `<input type="checkbox" name="razonli" value="${input_razon}"><label for="razonli" class="form-label">${input_razon}</label>`
            div_lista.appendChild(newLi)
        }
        input_razon = ''
    }

    function obtainValues(){
        const lista_razones = document.querySelectorAll('[name="razonli"]')

        const lista_reg = []
        const lista_no_reg = []
        lista_razones.forEach((element)=>{

            if(!regex.test(parseInt(element.value, 10))){
                lista_no_reg.push(element.value)
            }else{
                lista_reg.push(element.value)
            }
        })

        return {'LISTA_NO_REG': lista_no_reg, 'LISTA_REG':lista_reg}
    }
</script>