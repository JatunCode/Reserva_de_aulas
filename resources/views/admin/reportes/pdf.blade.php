<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Ambientes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .contact-info {
            text-align: right;
        }
        .subtable {
            margin-top: 10px;
            border-top: 1px solid black;
        }
    </style>
</head>
<body>
<header>
    <div class="contact-info">
        <strong>JatunCODE</strong><br>
        UMSS<br>
        JatunCODE@gmail.com
    </div>
</header>
<h1>Reporte Ambientes</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Tipo</th>
            <th>Nombre</th>
            <th>Capacidad</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php $contador = 1; ?> <!-- Inicializar el contador -->
        @foreach ($tabla as $relacion)
            <tr>
                <td>{{ $contador++ }}</td> <!-- Incrementar y mostrar el contador -->
                <td>{{ $relacion->dahm_relacion_ambiente->TIPO }}</td>
                <td>{{ $relacion->dahm_relacion_ambiente->NOMBRE }}</td>
                <td>{{ $relacion->dahm_relacion_ambiente->CAPACIDAD }}</td>
                <td>{{ $relacion->dahm_relacion_ambiente->ESTADO }}</td>
            </tr>
            @if($relacion->solicitudes->isNotEmpty())
                <tr>
                    <td colspan="5">
                        <table class="subtable">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Docente</th>
                                    <th>Motivo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($relacion->solicitudes as $solicitud)
                                    <tr>
                                        <td>{{ $solicitud->FECHAHORA_SOLI}}</td>
                                        <td>{{ $relacion->dahm_relacion_docente->NOMBRE }}</td>
                                        <td>{{ $solicitud->MOTIVO }}</td>
                                        <td>{{ $solicitud->ESTADO }}</td>
                                        <!-- Añade más columnas según sea necesario -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
<!-- <h1>Datos de la Solicitud</h1>
<pre>{{ print_r($datos, true) }}</pre> -->
</body>
</html>
