<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="offcanvas-header" style="background-color: #343a40;">
        <h5 id="offcanvasLeftLabel" style="color: #ffff;">Cancelar</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

            <div class="row g-3" id="solicitudForm">

                @foreach($razon as $razon)
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="{{ $razon->id_razones }}" id="razon_{{ $razon->id_razones}}" name="razon">
                        <label class="form-check-label" for="razon_{{ $razon->id_razones }}">
                            {{ $razon->razon }}
                        </label>
                    </div>
                </div>
                @endforeach

                <div class="col-6 text-center"  style="margin-top: 5em;">
                    <button type="button" class="btn btn-success d-inline-block w-75" id="elimBtn"  data-id="{{ $solicitud->id }}">Aceptar</button>
                </div>

                <div class="col-6 text-center" style="margin-top: 5em;">
                    <button type="button" class="btn btn-danger d-inline-block w-75" data-bs-dismiss="offcanvas">Atrás</button>
                </div>

                <input type="hidden" id="solicitudId2">
            </div>
    </div>
</div>
<script>


</script>

