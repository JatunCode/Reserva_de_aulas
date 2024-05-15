<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Formulario Razones</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('reserva.store') }}" method="POST" class="row g-3" id="formRazon">
            @csrf
            <div class="card body">
                <ul style="list-style: none">
                    @foreach ($razones as $razon)
                        <li>
                            <input type="checkbox" name="razonli" class="form-control"><label for="razonli" class="form-label">{{ $razon['TITULO'] }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <label for="razon" class="form_label">Registrar nueva razon</label>
                <input type="text" class="form-control" name="razon" placeholder="Escriba la razon de cancelacion de reserva">
                <p id="messageErrorRazon" style="display: none; color: red">*La razon ya existe</p>
            </div>
        
            <div class="col-md-12 mt-3 text-center">
                <button type="submit" class="btn btn-primary d-inline-block w-75" id="boton-sub">Aceptar</button>
                <button type="reset" class="btn btn-primary d-inline-block w-75">Atras</button>
            </div>
        </form>
    </div>
</div>