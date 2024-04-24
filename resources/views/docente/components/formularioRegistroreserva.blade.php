<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header" style="background-color: #343a40;">
        <h5 id="offcanvasRightLabel" style="color: #ffff;" >Detalles</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row g-3" id="solicitudForm">

            <div class="col-md-12">
                <label for="nombre" class="form-label">Docente(s)</label>

                <input type="text" class="form-control nombre-input" name="nombre" id="nombre" readonly>

            </div>

            <div class="col-md-6">
                <label for="ID" class="form-label">ID:</label>

                <input type="text" class="form-control nombre-input" name="ID" id="ID" readonly>
            </div>

            <div class="col-md-6">
                <label for="cantidad_estudiantes" class="form-label">N° de Estudiantes:</label>
                <input type="text" class="form-control" id="cantidad_estudiantes" name="cantidad_estudiantes" required
                    readonly>
            </div>

            <div class="col-6">
                <label for="grupo" class="form-label">Grupo(s):</label>
                <input type="text" class="form-control" id="grupo" name="grupo" required readonly>
            </div>

            <div class="col-6">
                <label for="horario" class="form-label">Horario:</label>
                <input type="text" class="form-control" id="horario" name="horario"
                    readonly>
            </div>


            <div class="col-12">
                <label for="periodo" class="form-label">Periodo:</label>
                <input type="text" class="form-control" id="periodo" name="periodo" required readonly>
            </div>

            <div class="col-12">
                <label for="razon" class="form-label">Detalles:</label>
                <input type="text" class="form-control" id="razon" name="razon" required readonly>
            </div>

            <div class="col-6 mt-3 text-center">
                <button id="aceptarBtn" class="btn btn-success d-inline-block w-75"
                    data-id="{{ $solicitud->id }}">Aceptar</button>
            </div>

            <div class="col-6 mt-3 text-center">
                <button id="cancelarBtn" class="btn btn-danger d-inline-block w-75"
                    data-id="{{ $solicitud->id }}">Atras</button>
            </div>

            <input type="hidden" id="solicitudId">


        </div>



    </div>
</div>
