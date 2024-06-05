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
    </style>
</head>
<body>
    <h1>Ambientes</h1>
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
            @foreach ($datos['tabla'] as $dato)
                <tr>
                    <td>{{ $dato['ID'] }}</td>
                    <td>{{ $dato['Tipo'] }}</td>
                    <td>{{ $dato['Nombre'] }}</td>
                    <td>{{ $dato['Capacidad'] }}</td>
                    <td>{{ $dato['Estado'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- <h1>Datos de la Solicitud</h1>
    <pre>{{ print_r($datos, true) }}</pre> -->
</body>
</html>
