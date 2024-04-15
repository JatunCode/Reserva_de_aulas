<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Formulario Horario</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('ambiente.store') }}" method="POST" class="row g-3" id="formAmbiente">
            @csrf
            <div class="col-md-10" id="container">
                <label for="nombre" class="form-label">Seleccione el tipo de ambiente</label>
                <div class="input-group mb-2">
                    <select class="form-select" name="opcion" required name="opcion">
                        <option value="Aula comun" selected>Aula comun</option>
                        <option value="Auditorio">Auditorio</option>
                    </select>
                </div>
            </div>

            <div class="col-md-10">
                <label for="nombre" class="form-label">Nombre ambiente</label>
                <input type="text" class="form-control" name="nombre" placeholder="691 A/Auditorio UMSS" required>
            </div>

            <div class="col-md-10" id="referencias">
                <label for="refers" class="form-label">Referencias</label>
                <input type="text" class="form-control" name="refers" placeholder="Bliblioteca FCyT/Area verde" required>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class=" btn btn-success agregar-nombre" type="button" id="ref-add">
                    <i class="bi bi-globe"></i>
                </button>
            </div>

            <div class="col-md-6">
                <label for="capacidad" class="form-label">Capacidad</label>
                <input type="int" class="form-control" name="capacidad" placeholder="Max de 250 estudiantes" required>
            </div>

            <div class="col-md-4">
                <label for="data" class="form-label">¿Tiene datadisplay?</label>
                <label for="data" class="form-label">SI</label>
                <input type="checkbox" name="data" required>
            </div>
            <div class="col-md-12 mt-3 text-center">
                <button type="submit" class="btn btn-primary d-inline-block w-75" id="boton-sub">Registrar ambiente</button>
                <button type="reset" class="btn btn-primary d-inline-block w-75">Cancelar registro</button>
            </div>
        </form>
    </div>
</div>




