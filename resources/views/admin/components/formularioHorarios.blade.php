<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Formulario Horario</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('horario.store') }}" method="POST" class="row g-3" id="formHorario">
            @csrf
            <div class="col-md-6">
                <label for="docente" class="form-label">Docente</label>
                <input type="text" class="form-control" name="docente" required>
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
        
                    <div class="col-md-4">
                        <label for="inicio" class="form-label">Hora de inicio</label>
                        <input type="time" class="form-control" name="inicio" required>
                    </div>
        
                    <div class="col-md-4">
                        <label for="fin" class="form-label">Hora de salida</label>
                        <input type="time" class="form-control" name="fin" required>
                    </div>
        
                    <div class="col-md-4">
                        <label for="ambiente" class="form-label">Ambiente</label>
                        <input type="text" class="form-control" name="ambiente" required>
                    </div>
                </div>
            </div>

            
            <div class="col-md-12 mt-3 text-center">
                <button type="submit" class="btn btn-primary d-inline-block w-75" id="boton-sub">Registrar horario</button>
                <button type="reset" class="btn btn-primary d-inline-block w-75">Cancelar registro</button>
            </div>
        </form>
    </div>
</div>



