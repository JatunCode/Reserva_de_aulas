<form action="{{ route('reserva.store') }}" method="POST" class="row g-3" id="formRazon">
    @csrf
    <div class="card-header">
        <h3>Razones actuales</h3>
    </div>
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
        <input type="text" class="form-control" name="razon" onchange="findRazon(this)" placeholder="Escriba la razon de cancelacion de reserva">
        <p id="messageErrorDocente" style="display: none">*La razon ya existe</p>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary d-inline-block w-75" id="boton-sub">Aceptar</button>
        <button type="reset" class="btn btn-primary d-inline-block w-75">Atras</button>
    </div>
</form>

