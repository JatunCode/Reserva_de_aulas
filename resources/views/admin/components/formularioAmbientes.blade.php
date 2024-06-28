<form action="{{ route('ambiente.store') }}" method="POST" class="row g-3" id="formAmbiente">
    @csrf
    <div class="col-md-10" id="container">
        <label for="nombre" class="form-label">Seleccione el tipo de ambiente</label>
        <div class="input-group mb-2">
            <select class="form-select" name="opcion">
                <option value="Aula comun" selected>Aula comun</option>
                <option value="Auditorio">Auditorio</option>
            </select>
        </div>
    </div>

    <div class="col-md-10">
        <label for="nombre" class="form-label">Nombre ambiente</label>
        <input type="text" class="form-control" name="nombre" placeholder="691 A/Auditorio UMSS" onchange="findAmbiente(this)">
        <p id="messageErrorAmbiente" style="display: none; color: red"></p>
    </div>

    <div class="col-md-10">
        <div id="referencias">
            <label for="refers" class="form-label">Referencias</label>
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="refers" placeholder="Bliblioteca FCyT/Area verde" onchange="caracterReferencia(this)">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class=" btn btn-success agregar-nombre" type="button" id="ref-add">
                        <i class="bi bi-globe"></i>
                    </button>
                </div>
            </div>
        </div>
        <p id="messageErrorReferencias" style="display: none; color: red"></p>
    </div>

    <div class="col-md-6">
        <label for="capacidad" class="form-label">Capacidad</label>
        <input type="int" class="form-control" name="capacidad" placeholder="Max de 250 estudiantes" onchange="checkCapacidad(this)">
        <p id="messageErrorCapacidad" style="display: none; color: red"></p>
    </div>

    <div class="col-md-4">
        <label for="data" class="form-label">¿Tiene datadisplay?</label>
        <label for="data" class="form-label">SI</label>
        <input type="checkbox" name="data">
    </div>
    <div class="col-md-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary d-inline-block w-75" id="boton-sub" style="background-color: green">Registrar ambiente</button>
        <button type="reset" class="btn btn-primary d-inline-block w-75" style="background-color: red">Cancelar registro</button>
    </div>
</form>




