<form action="{{ route('horario.store') }}" method="POST" class="row g-3" id="formHorario">
    @csrf
    <div class="col-md-6">
        <label for="docente" class="form-label">Docente</label>
        <input type="text" class="form-control" name="docente" onchange="findDocente(this)" required>
        <p id="messageErrorDocente" style="display: none">*No se encontro el docente</p>
    </div>

    <div class="col-md-6">
        <label for="materia" class="form-label">Materia</label>
        <input type="text" class="form-control" name="materia" required>
    </div>
    
    <div class="col-md-12" id="container-main">
        <div class="row">
            <div class="col-md-10">
                <label for="nombre" class="form-label">Seleccione el dia de clases</label>
                <div class="input-group mb-2">
                    <select class="form-select" name="dia" required>
                        <option value="Lunes" selected>Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miercoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                        <option value="Sabado">Sabado</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button class=" btn btn-success agregar-nombre" type="button" id="ref-add">
                    <i class="bi bi-hourglass"></i>
                </button>
            </div>

            <div class="row col-md-8">
                <div class="col-md-6">
                    <label for="inicio" class="form-label">Hora de inicio</label>
                    <input type="time" class="form-control" name="inicio" value="06:45:00" min="06:45:00" max="20:15:00" step="5400" onchange="bloquearHoras(this)" required>
                </div>
                <div class="col-md-6">
                    <label for="fin" class="form-label">Hora de salida</label>
                    <input type="time" class="form-control" name="fin" value="08:15:00" min="08:15:00" max="21:45:00" step="5400" onchange="bloquearHoras(this)" required>
                </div>
                <p id="messageErrorHora" style="display: none">*No se encuentra en el rango de hora</p>
            </div>

            <div class="col-md-4">
                <label for="ambiente" class="form-label">Ambiente</label>
                <input type="text" class="form-control" name="ambiente" onchange="findAmbiente(this)" required>
                <p id="messageErrorAmbiente" style="display: none">*No se encontro el ambiente</p>
            </div>
        </div>
    </div>

    
    <div class="col-md-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary d-inline-block w-75" id="boton-sub" style="color: green">Registrar horario</button>
        <button type="reset" class="btn btn-primary d-inline-block w-75" style="color: red">Cancelar registro</button>
    </div>
</form>

