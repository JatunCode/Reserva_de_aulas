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
        @php
            $contador = 1; // Inicializamos el contador en 1
        @endphp
            @foreach ($tabla as $ambiente)
                <tr>
                    <td>{{ $contador++ }}</td>
                    <td>{{ $ambiente->TIPO }}</td>
                    <td>{{ $ambiente->NOMBRE }}</td>
                    <td>{{ $ambiente->CAPACIDAD }}</td>
                    <td>{{ $ambiente->ESTADO }}</td>
                </tr>
                <tr>
        <td colspan="5">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Docente</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ambiente->solicitudes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->fecha }}</td>
                        <td>{{ $solicitud->nombre }}</td>
                        <td>{{ $solicitud->motivo }}</td>
                        <td>{{ $solicitud->estado }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </td>
    </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <h1>Datos de la Solicitud</h1>
    <pre>{{ print_r($datos, true) }}</pre> -->
</body>
</html>
