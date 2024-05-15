@extends('adminlte::page')

@section('title', 'Bandeja de entrada')

@section('content_header')
<h1>Bandeja de entrada</h1>
@stop

@section('content')

<!-- Contenido de la página -->

<x-adminlte-mailbox :messages="$notificaciones" />

@stop