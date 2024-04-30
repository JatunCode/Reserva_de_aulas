<form action="{{ route('solicitud.store') }}" method="POST" class="row g-3" id="solicitudForm">
    @csrf
    <div class="col-md-12" id="container">
        <label for="nombre" class="form-label">Docente(s)</label>
        <div class="input-group mb-2">
            <input type="text" class="form-control nombre-input" placeholder="Ingrese su nombre" name="nombre"
                id="nombre">
            <button class=" btn btn-success agregar-nombre" type="button">
                <i class="bi bi-person-plus"></i>
            </button>
        </div>
    </div>


    <div class="col-md-12">
        <label for="materia" class="form-label">Materia:</label>
        <select class="form-select" id="materia" aria-label="Floating label select example" required name="materia">
            <option selected disabled value=""></option>
            <option value="Introducción a la programación">Introducción a la programación</option>
            <option value="Física">Física</option>
            <option value="Elementos">Elementos</option>
        </select>
    </div>

    <div class="col-6">
        <label for="grupo" class="form-label">Grupo(s):</label>
        <input type="text" class="form-control" id="grupo" name="grupo" placeholder=" Ejm: 1,2,3" required>
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
            <option value="Examen parcial">Examen parcial</option>
            <option value="Examen de mesa">Examen de mesa</option>
            <option value="Examen final">Examen final</option>
            <option value="Examen 2da instancia">Examen 2da instancia</option>
            <option value="Evento">Evento</option>
            <option value="Clase regular">Clase regular</option>
            <option value="Otro">Otro</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="modo" class="form-label">Modo:</label>
        <select class="form-select" id="modo" required name="modo" readonly>
            <option value="Urgente" selected>Urgente</option>

        </select>
    </div>

    <div class="form-floating comentarios" id="campoRazon">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
            name="razon"></textarea>
        <label for="floatingTextarea2">Razon:</label>
    </div>
    <div class="col-6">
        <label for="aula" class="form-label">Aula:</label>
        <input type="text" class="form-control" id="aula" name="aula" placeholder="Ingrese el aula" readonly>
    </div>
    <div class="col-md-6">
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="date" class="form-control" id="fecha" name="fecha" required readonly>
    </div>
    <div class="col-12">
        <label for="horario" class="form-label">Horario:</label>
        <input type="text" class="form-control" id="horario" name="horario" placeholder="Ingrese el horario" readonly>
    </div>

    <div class="col-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary d-inline-block w-75">Solicitar</button>
    </div>
</form>
