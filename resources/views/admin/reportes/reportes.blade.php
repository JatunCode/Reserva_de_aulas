@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1>Reporte Ambientes</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">
    <div class="card-header">
        <form class="row" id="filtroForm">
        <div class="form-group col-lg-4 col-md-3 align-self-center">
    <label for="inputSearch" class="mr-2">Nombre del Ambiente:</label>
    <input type="text" class="form-control w-100" id="inputSearch" name="ambiente" placeholder="Ingrese nombre del ambiente">
    <div id="suggestionsContainer" class="suggestions-container"></div>
</div>
            <div class="form-group col-lg-2 col-md-3 align-self-center">
                <label for="selectMode" class="mr-2">Estado:</label>
                <select class="form-control" id="selectMode" name="estado">
                    <option value="Todos" selected>Todos</option>
                    <option value="Habilitado">Habilitado</option>
                    <option value="No Habilitado">No Habilitado</option>
                </select>
            </div>
            <div class="form-group col-lg-2 col-md-3 align-self-center">
    <label for="selectStatus" class="mr-2">Capacidad:</label>
    <input type="number" class="form-control" id="selectStatus" name="capacidad" placeholder="Ingrese capacidad">
</div>
<div class="form-group col-lg-2 col-md-3 ml-auto align-self-center">
    <label for="selectMode" class="mr-2"></label>
    <button type="button" id="btnExportar" class="btn btn-primary w-100" onclick="exportarPDF()">Exportar PDF</button>
</div>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody id="resultadosTabla">
                <!-- Los resultados se agregarán aquí mediante JavaScript -->
            </tbody>
        </table>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin/home.css">
<!-- CSS de Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
@stop

@section('js')
<script>// Obtener el campo de capacidad
var capacidadInput = document.getElementById("selectStatus");

// Agregar un listener para el evento "input"
capacidadInput.addEventListener("input", function(event) {
    // Obtener el valor actual del campo
    var valor = event.target.value;

    // Limpiar el valor eliminando caracteres no permitidos
    var valorLimpio = valor.replace(/[^\d]/g, '');

    // Actualizar el valor del campo con el valor limpio
    event.target.value = valorLimpio;
});

</script>
<script>
function filtrarAmbientes() {
    var nombre = document.getElementById("inputSearch").value;
    var estado = document.getElementById("selectMode").value;
    var capacidad = document.getElementById("selectStatus").value;
    console.log("Nombre:", nombre);
    console.log("Estado:", estado);
    console.log("Capacidad:", capacidad);
    
    // Enviar solicitud al servidor
    const url = `{{ route("admin.reportes.filtrar.datos_filtro") }}?nombre=${nombre}&estado=${estado}&capacidad=${capacidad}`;
console.log("URL enviada al servidor:", url);
fetch(url)
        .then(response => response.json())
        .then(data => {
            // Actualizar la tabla con los nuevos datos
            console.log(data);
            if (Array.isArray(data)) {
                actualizarTabla(data);
            } else {
                console.error('Los datos recibidos no son un array:', data);
            }
        })
        .catch(error => {
            console.error('Error al buscar datos:', error);
        });
}

function actualizarTabla(data) {
    // Obtener referencia al cuerpo de la tabla
    var tbody = document.querySelector('#resultadosTabla');
    
    // Eliminar los elementos existentes en el cuerpo de la tabla
    tbody.innerHTML = '';
    let contador = 1;
    
    // Iterar sobre los nuevos datos y agregar cada ambiente como una fila en la tabla
    data.forEach(ambiente => {
        // Crear una nueva fila para el ambiente
        var rowAmbiente = document.createElement('tr');
        
        // Agregar las celdas con los datos del ambiente a la fila
        rowAmbiente.innerHTML = `
            <td>${contador++}</td>
            <td>${ambiente.TIPO}</td>
            <td>${ambiente.NOMBRE}</td>
            <td>${ambiente.CAPACIDAD}</td>
            <td>${ambiente.ESTADO}</td>
        `;
        
        // Agregar la fila del ambiente al cuerpo de la tabla
        tbody.appendChild(rowAmbiente);

        // Crear una fila para las solicitudes con una tabla secundaria
        var rowSolicitudes = document.createElement('tr');
        var cellSolicitudes = document.createElement('td');
        cellSolicitudes.colSpan = "5"; // Colspan para que ocupe toda la fila
        var tablaSolicitudes = document.createElement('table');
        var thead = document.createElement('thead');
        var tbodySolicitudes = document.createElement('tbody');

        // Crear encabezados de columna para la tabla de solicitudes
        var encabezados = ['Fecha', 'Docente', 'Motivo', 'Estado'];
        var encabezadosRow = document.createElement('tr');
        encabezados.forEach(header => {
            var th = document.createElement('th');
            th.innerText = header;
            encabezadosRow.appendChild(th);
        });
        thead.appendChild(encabezadosRow);

        // Iterar sobre las solicitudes y agregarlas como filas en la tabla de solicitudes
        ambiente.solicitudes.forEach(solicitud => {
            var solicitudRow = document.createElement('tr');
            var fechaCell = document.createElement('td');
            fechaCell.innerText = solicitud.fecha;
            var docenteCell = document.createElement('td');
            docenteCell.innerText = solicitud.nombre;
            var motivoCell = document.createElement('td');
            motivoCell.innerText = solicitud.motivo;
            var estadoCell = document.createElement('td');
            estadoCell.innerText = solicitud.estado; // Asumiendo que tienes el estado de la solicitud
            solicitudRow.appendChild(fechaCell);
            solicitudRow.appendChild(docenteCell);
            solicitudRow.appendChild(motivoCell);
            solicitudRow.appendChild(estadoCell);
            tbodySolicitudes.appendChild(solicitudRow);
        });

        // Agregar el encabezado y el cuerpo de la tabla de solicitudes a la tabla secundaria
        tablaSolicitudes.appendChild(thead);
        tablaSolicitudes.appendChild(tbodySolicitudes);

        // Agregar la tabla secundaria al cuerpo de la celda
        cellSolicitudes.appendChild(tablaSolicitudes);

        // Agregar la celda al cuerpo de la fila de solicitudes
        rowSolicitudes.appendChild(cellSolicitudes);

        // Agregar la fila de solicitudes al cuerpo de la tabla
        tbody.appendChild(rowSolicitudes);
    });
}

// Función para formatear las solicitudes en un formato legible
function formatSolicitudes(solicitudes) {
    if (!solicitudes || solicitudes.length === 0) {
        return 'Sin solicitudes';
    }
    
    // Formatear las solicitudes en una lista de nombres de docentes
    var nombresDocentes = solicitudes.map(solicitud => solicitud.nombre).join(', ');
    return nombresDocentes;
}
function exportarPDF() {
    filtrarAmbientes(); // Primero, filtramos los ambientes para obtener los datos actualizados en la tabla
    var nombre = document.getElementById("inputSearch").value;
    var estado = document.getElementById("selectMode").value;
    var capacidad = document.getElementById("selectStatus").value;

    // Obtenemos los datos de la tabla actualizados
    var tabla = document.getElementById("resultadosTabla");
    var filas = tabla.getElementsByTagName("tr");
    

    // Construir el objeto de datos para el PDF
    var data = {
        nombre: nombre,
        estado: estado,
        capacidad: capacidad,
        
    };

    // Generar el PDF
    generarPDF(data);
}

    function generarPDF(data) {
        console.log('Datos enviados a la ruta:', data);
        // Obtener la URL de la ruta de exportación directamente en JavaScript
        var exportarURL = '{{ route("admin.exportarPDF") }}';// Reemplaza esta URL con la ruta correcta
        
        // Construir la URL con los parámetros de datos
        exportarURL += '?data=' + encodeURIComponent(JSON.stringify(data));
        
        // Hacer una solicitud al servidor para exportar los datos a PDF
        fetch(exportarURL)
        .then(response => {
            if (response.ok) {
                // Si la respuesta es exitosa, redirigir al usuario para descargar el PDF
                return response.blob();
            }
            throw new Error('Error al exportar los datos a PDF');
        })
        .then(blob => {
            // Crear un enlace para descargar el PDF y hacer clic en él automáticamente
            var url = window.URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'nombre-del-archivo.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        })
        .catch(error => {
            console.error(error);
            // Manejar el error, por ejemplo, mostrando un mensaje al usuario
        });
    }
</script>
<script>
    // Obtener referencia a los campos de entrada de búsqueda
var inputSearch = document.getElementById("inputSearch");
var selectMode = document.getElementById("selectMode");
var selectStatus = document.getElementById("selectStatus");

// Agregar un listener para el evento "input" a cada campo de búsqueda
inputSearch.addEventListener("input", function() {
    filtrarAmbientes();
});

selectMode.addEventListener("change", function() {
    filtrarAmbientes();
});

selectStatus.addEventListener("input", function() {
    filtrarAmbientes();
});

</script>
<script>
    // Obtener la lista de nombres de ambientes
    var nombresAmbientes = {!! json_encode($ambientes->pluck('NOMBRE')->toArray()) !!};

    // Obtener referencia al campo de búsqueda y al contenedor de sugerencias
    var inputSearch = document.getElementById("inputSearch");
    var suggestionsContainer = document.getElementById("suggestionsContainer");

    // Agregar un listener para el evento "input" al campo de búsqueda
    inputSearch.addEventListener("input", function() {
        var inputText = inputSearch.value.toLowerCase();
        var matches = nombresAmbientes.filter(nombre => nombre.toLowerCase().includes(inputText));
        
        // Limpiar el contenedor de sugerencias
        suggestionsContainer.innerHTML = '';

        // Mostrar las sugerencias que coincidan con el texto ingresado
        matches.slice(0, 5).forEach(match => {
            var suggestion = document.createElement("div");
            suggestion.textContent = match;
            suggestion.addEventListener("click", function() {
                // Al hacer clic en una sugerencia, llenar el campo de búsqueda con la sugerencia seleccionada
                inputSearch.value = match;
                filtrarAmbientes();
                // Limpiar el contenedor de sugerencias después de seleccionar una sugerencia
                suggestionsContainer.innerHTML = '';
            });
            suggestionsContainer.appendChild(suggestion);
        });
    });
</script>

@stop
