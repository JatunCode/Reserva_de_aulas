<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    @csrf
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Atencion reserva</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="card">
            <div class="card-header">
                <strong>Informacion de la solicitud</strong>
            </div>
            <div class="card-body">
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
                    <div class="col-md-3">
                        <label for="grupos" class="form-label">Grupos</label>
                        <input type="text" name="grupos" class="form-control" readonly>
                    </div>
                    <div class="col-md-5">
                        <label for="horario" class="form-label">Horario</label>
                        <input type="text" name="horario" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="modo" class="form-label">Modo</label>
                        <input type="text" name="modo" class="form-control" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="materia" class="form-label">Materia</label>
                        <input type="text" name="materia" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="ambiente" class="form-label">Ambiente</label>
                        <input name="ambiente" class="form-control" readonly>
                        </input>
                    </div>
                    <div class="col-md-8">
                        <label for="motivo" class="form-label">Motivo</label>
                        <input type="text" name="motivo" class="form-control" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="col-md-6">
                <button type="button" class="btn btn-danger d-inline-block w-75" name="cancelar"  onclick="cambiarEstado(this)" value="CANCELADO">CANCELAR</button>
            </div>
        </div>
    </div>
</div>