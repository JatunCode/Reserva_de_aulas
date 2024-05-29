<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightRa" aria-labelledby="offcanvasRightLabel">
    @csrf
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Modificar horario</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('horario.update') }}" method="PUT" class="row g-3" id="formRazon">
            @csrf
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
                <button type="submit" class="btn btn-primary d-inline-block w-75" id="boton-sub" onclick="cambiarEstado(this)" style="background-color: green" value="CANCELADO">Aceptar</button>
                <button class="btn btn-primary d-inline-block w-75" type="button" style="background-color:red" onclick="limpiar()" >Atras</button>
            </div>
        </form>
    </div>
</div>