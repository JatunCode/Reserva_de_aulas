<form action="{{ route('solicitud.store') }}" method="POST" class="row g-3" id="solicitudForm">
    @csrf
    <div class="col-md-12">
        <label for="materia" class="form-label">Materia:</label>
        <select class="form-select" id="materia" aria-label="Floating label select example" required name="materia">
            <option selected disabled value="">Selecciona una materia</option>
            @foreach($materias as $materia)
                <option value="{{ $materia['NOMBRE'] }}">{{ $materia['NOMBRE'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12" id="container">
        <label for="nombre" class="form-label">Docente(s)</label>
        <div class="input-group mb-2">
        <input type="text" class="form-control nombre-input" placeholder="Ingrese su nombre" name="nombre" id="nombre" @if (!empty($docente)) readonly value="{{$docente}}" @endif >

            <button class=" btn btn-success agregar-nombre" type="button">
                <i class="bi bi-person-plus"></i>
            </button>
        </div>
        <div id="lista-docentes" class="list-group" style="display: none; position: absolute;"></div>
        <p id="messageErrorDocente" style="display: none; color: red">*El docente no existe</p>
    </div>

    <div class="col-6">
        <label for="grupo" class="form-label">Grupo(s):</label>
        <input type="text" class="form-control" id="grupo" name="grupo" placeholder=" Ejm: 1,2,3" required >
        <p id="messageErrorGrupo" style="display: none ;color: red">*El grupo no existe</p>
    </div>




    <div class="col-md-6">
        <label for="cantidad_estudiantes" class="form-label">N° de Estudiantes:</label>
        <input type="number" class="form-control" id="cantidad_estudiantes" name="cantidad_estudiantes"
            placeholder="Ingrese la cantidad de estudiantes" required>
    </div>
    <div class="col-md-12">
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
        <label for="filtroFecha">Fecha:</label>
        <input type="date" class="form-control" id="filtroFecha" name="filtroFecha" min="{{ date('Y-m-d') }}"required>
        <!-- Campo oculto para enviar el valor de "modo" -->
        <!-- <input type="hidden" id="modo" name="modo"> -->
    </div>
    
    <div class="col-md-6">
        <label for="modo" class="form-label">Modo:</label>
        <input type="text" class="form-control" id="modo" name="modo" readonly required>
        <!-- Campo oculto para enviar el valor de "modo" -->
        <!-- <input type="hidden" id="modo" name="modo"> -->
    </div>

    <div class="form-floating comentarios" id="campoRazon" style="display: none">
        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="razon"></textarea>
        <label for="floatingTextarea2">Razon:</label>
    </div>

    <div class="col-6">
        <label for="aula" class="form-label">Aula:</label>
        <select class="form-control" id="aula" name="aula">
        </select>
    </div>
    <div class="col-6">
        <label for="horario" class="form-label">Horario:</label>
        <input type="text" class="form-control" id="horario" name="horario" placeholder="Ingrese el horario" required>
    </div>

    <div class="col-12 mt-3 text-center">
        <button type="submit" class="btn btn-primary d-inline-block w-75">Solicitar</button>
    </div>
</form>

<script>
    let materias = @json($materias);
    let docentes_relacionados = [];
    let grupos_relacionados = [];

    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('container');
        const listaDocentes = document.getElementById('lista-docentes');
        const message = document.getElementById('messageErrorDocente');
        const selectMateria = document.getElementById('materia');

        selectMateria.addEventListener('change', (event) => {
            docentes_relacionados = [];
            const idMateriaSeleccionada = event.target.value;
            extra_materias = materias;
            grupos_relacionados = extra_materias.find(materia => materia['NOMBRE'] === idMateriaSeleccionada);
            grupos_relacionados = [...new Set(grupos_relacionados['GRUPOS'])];
            
            for (let i = 0; i < docentes.length; i++) {
                const docente = docentes[i];
                for (let j = 0; j < docente['MATERIAS'].length; j++) {
                    const materia = docente['MATERIAS'][j];
                    if (materia['NOMBRE'] === idMateriaSeleccionada) {
                        docentes_relacionados.push(docente);
                        break;
                    }
                }
            }
            console.log('Grupos: ', grupos_relacionados);
            console.log('Materias: ', materias);
            console.log('Docentes: ', docentes_relacionados);
        });

        container.addEventListener('keydown', (event) => {
            if (event.target && event.target.matches('input[name="nombre"]')) {
                const inputNombre = event.target;

                listaDocentes.innerHTML = '';
                listaDocentes.style.width = `${inputNombre.offsetWidth}px`;
                listaDocentes.style.left = `${inputNombre.offsetLeft}px`;
                listaDocentes.style.top = `${inputNombre.offsetTop + inputNombre.offsetHeight}px`;

                if (inputNombre.value.toUpperCase()) {
                    let filtro_lista = docentes_relacionados.filter(docente => 
                        docente['NOMBRE_DOCENTE'].includes(inputNombre.value.toUpperCase())
                    );
                    if (filtro_lista.length > 0) {
                        message.style.display = 'none';
                        listaDocentes.style.display = 'block';
                        filtro_lista.forEach(docente => {
                            const item = document.createElement('a');
                            item.className = 'list-group-item list-group-item-action';
                            item.textContent = docente['NOMBRE_DOCENTE'];
                            item.addEventListener('click', () => {
                                inputNombre.value = docente['NOMBRE_DOCENTE'];
                                listaDocentes.style.display = 'none';
                            });
                            listaDocentes.appendChild(item);
                        });
                    } else {
                        listaDocentes.style.display = 'none';
                        message.style.display = 'block';
                    }
                } else {
                    listaDocentes.style.display = 'none';
                }
            }
        });

        document.addEventListener('click', (event) => {
            if (!event.target.closest('#container') && !event.target.closest('#lista-docentes')) {
                listaDocentes.style.display = 'none';
            }
        });
    });

    document.getElementById('grupo').addEventListener('keydown', (event) => {
        const message = document.getElementById('messageErrorGrupo');
        const valor = event.target.value.trim();

        if(valor.length > 0){
            if(grupos_relacionados.find(grupo => grupo['GRUPO'] == valor)){
                console.log('Ingresando al find');
                message.style.display = 'none';
            }else if (grupos_relacionados.some(grupo => valor.includes(grupo['GRUPO']))) {
                console.log('Ingresando al some');
                message.style.display = 'none';
            }else{
                console.log('Expulsado del some');
                message.style.display = 'block';
            }
        }else{  
            message.style.display = 'block';
        }
    });
</script>