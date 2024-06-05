<!DOCTYPE html>
<html>
<head>
    <title>Notificación</title>
</head>
<body>
    <h1>¡Hola!</h1>
    <p>Su {{ $tipo_mensaje }} ha sido completada con éxito.</p>
    <p>Los datos de su {{ $tipo_mensaje }} son:</p>
    <p>{{ $cuerpo }}</p>
    <p>En caso de haber un error, puede cancelar su {{ $tipo_mensaje }} en el siguiente enlace:</p>
    <a href="{{ $cancelar_url }}">Cancelar solicitud</a>
    <p>Otras acciones:</p>
    <a href="{{ $accion1_url }}">Opción 1</a>
    <a href="{{ $accion2_url }}">Opción 2</a>
    <p>Gracias por usar la aplicación de reservas!</p>
</body>
</html>