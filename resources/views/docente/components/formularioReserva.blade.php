<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Estado de Solicitud</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row g-3" id="solicitudForm">

            <div class="col-md-12">
                <label for="nombre" class="form-label">Docente(s)</label>

                <input type="text" class="form-control nombre-input" name="nombre" id="nombre" readonly>

            </div>

            <div class="col-md-12">
                <label for="materia" class="form-label">Materia:</label>

                <input type="text" class="form-control nombre-input" name="materia" id="materia" readonly>
            </div>

            <div class="col-6">
                <label for="grupo" class="form-label">Grupo(s):</label>
                <input type="text" class="form-control" id="grupo" name="grupo" required readonly>
            </div>


            <div class="col-md-6">
                <label for="cantidad_estudiantes" class="form-label">N° de Estudiantes:</label>
                <input type="text" class="form-control" id="cantidad_estudiantes" name="cantidad_estudiantes" required
                    readonly>
            </div>
            <div class="col-md-6">
                <label for="motivo" class="form-label">Motivo:</label>
                <input class="form-control" id="motivo" required name="motivo" readonly>

                </input>
            </div>
            <div class="col-md-6">
                <label for="modo" class="form-label">Modo:</label>
                <input class="form-control" id="modo" required name="modo" readonly>
                </input>
            </div>
            <div class="form-floating comentarios">
                <textarea class="form-control" id="razon" style="height: 100px" name="razon" readonly></textarea>
                <label for="floatingTextarea2">Razon:</label>
            </div>
            <div class="col-6">
                <label for="aula" class="form-label">Aula:</label>
                <input type="text" class="form-control" id="aula" name="aula" readonly>
            </div>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required readonly>
            </div>
            <div class="col-12">
                <label for="horario" class="form-label">Horario:</label>
                <input type="text" class="form-control" id="horario" name="horario" placeholder="Ingrese el horario"
                    readonly>
            </div>

            <div class="col-12 mt-3 text-center">
                <button id="cancelarBtn" class="btn btn-danger d-inline-block w-75"
                    data-id="{{ $solicitud->id }}">Cancelar</button>
            </div>

            <input type="hidden" id="solicitudId">


        </div>



    </div>
