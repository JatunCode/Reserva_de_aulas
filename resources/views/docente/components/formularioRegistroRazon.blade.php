<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header" style="background-color: #343a40;">
        <h5 id="offcanvasRightLabel" style="color: #ffff;">Añadir Razón</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('razones.guardar') }}" method="POST" id="razonForm">
            @csrf
            <div class="row g-3" id="solicitudForm">

                <div class="col-12 ">
                    <label for="razon" class="form-label " style="margin-top: 1.2em;">Descripción</label>
                    <input type="text" class="form-control text-center"   style="margin-top: 7.5em; margin-bottom: 7.5em;" id="razon" name="razon" style="width: 80%; margin: auto;" required>
                </div>

                <div class="col-6  text-center">
                    <button type="submit" class="btn btn-success d-inline-block w-75">Aceptar</button>
                </div>

                <div class="col-6 text-center">
                    <button type="button" class="btn btn-danger d-inline-block w-75" data-bs-dismiss="offcanvas">Atrás</button>
                </div>

            </div>
        </form>
    </div>
</div>
