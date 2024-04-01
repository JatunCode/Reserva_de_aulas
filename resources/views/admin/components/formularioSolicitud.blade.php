<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Formulario de Solicitud</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('solicitud.store') }}" method="POST" class="row g-3" id="solicitudForm">

            @csrf



            <div class="row" id="nombres-container">
                <div class="col-md-12">
                    <label for="nombre" class="form-label">Docente(s)</label>
                    <div class="input-group">
                        <input type="text" class="form-control nombre-input" placeholder="Ingrese su nombre"
                            name="nombre">
                        <button id="agregar-nombre" class="btn btn-success" type="button">
                            <i class="bi bi-person-plus"></i>
                        </button>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <label for="materia" class="form-label">Materia:</label>
                <select class="form-select" id="materia" aria-label="Floating label select example" required
                    name="materia">
                    <option selected disabled value=""></option>
                    <option value="1">Introducción a la programación</option>
                    <option value="2">Física</option>
                    <option value="3">Elementos</option>
                </select>
            </div>

            <div class="col-6">
                <label for="grupo" class="form-label">Grupo(s):</label>
                <input type="text" class="form-control" id="grupo" name="grupo" style="width: 20%;"
                    placeholder="Ejm: 1,2,3" required>
            </div>


            <div class="col-md-6">
                <label for="cantidad_estudiantes" class="form-label">N° de Estudiantes:</label>
                <input type="number" class="form-control" id="cantidad_estudiantes" name="cantidad_estudiantes"
                    placeholder="Ingrese la cantidad de estudiantes" required>
            </div>
            <div class="col-md-6">
                <label for="motivo" class="form-label">Motivo:</label>
                <select class="form-select" id="motivo" required name="motivo">
                    <option selected disabled value=""></option>
                    <option value="1">Examen parcial</option>
                    <option value="2">Examen de mesa</option>
                    <option value="3">Examen final</option>
                    <option value="4">Examen 2da instancia</option>
                    <option value="5">Evento</option>
                    <option value="6">Clase regular</option>
                    <option value="7">Otro</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="modo" class="form-label">Modo:</label>
                <select class="form-select" id="modo" required name="modo">
                    <option value="1">Normal</option>
                    <option value="2">Urgencia</option>
                </select>
            </div>
            <div class="form-floating comentarios" style="display: none;">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                    style="height: 100px" name="razon"></textarea>
                <label for="floatingTextarea2">Razon:</label>
            </div>
            <div class="col-6">
                <label for="aula" class="form-label">Aula:</label>
                <input type="text" class="form-control" id="aula" name="aula" placeholder="Ingrese el aula" readonly>
            </div>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="col-12">
                <label for="horario" class="form-label">Horario:</label>
                <input type="text" class="form-control" id="horario" name="horario" placeholder="Ingrese el horario"
                    readonly>
            </div>

            <div class="col-12 mt-3 text-center">
                <button type="submit" class="btn btn-primary d-inline-block w-75">Solicitar</button>
            </div>
        </form>
        </ div>
    </div>
