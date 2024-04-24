@extends('adminlte::page')

@section('title', 'Horarios Facultadivo')

@section('content_header')
<h1>Horarios registrados</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Horarios existentes
        </h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 100px">Dia</th>
                    <th style="width: 40px">Hora Entrada</th>
                    <th style="width: 40px">Hora Salida</th>
                    <th style="width: 100px">Materia</th>
                    <th style="width: 40px">Ambiente</th>
                    <th style="width: 40px">Docente</th>
                    <th style="width: 100px">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($horarios as $horario)
                    <tr>
                        <td>{{ $horario->DIA }}</td>
                        <td>{{ $horario->INICIO }}</td>
                        <td>{{ $horario->FIN }}</td>
                        <td>{{ $horario['relacion_materia_horario']['dahm_relacion_materia']['NOMBRE'] ?? '' }}</td>
                        <td>{{ $horario['relacion_materia_horario']['dahm_relacion_ambiente']['NOMBRE'] ?? '' }}</td>
                        <td>{{ $horario['relacion_materia_horario']['dahm_relacion_docente']['NOMBRE'] ?? ''}}</td>
                        
                    </tr>
                @endforeach
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@stop



