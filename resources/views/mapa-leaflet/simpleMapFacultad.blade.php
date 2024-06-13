@extends('adminlte::page')

@section('title', 'Mapa de la facultad')

@section('content_header')
<h1>Mapa</h1>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin/home.css">
<!-- CSS de Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <style>
        #map{
            height: 450px;
            
        }
     </style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col md 12">
            <div class="card">
                <div class="card-header">Mapa simple</div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop


@section('js')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
    const map = L.map('map').setView([-17.39353686937597, -66.14533076307711], 19)
    //map.options.maxZoom = 19
    map.options.minZoom = 19
    map.setMaxBounds([[-17.39234013039216, -66.14733230471607], [-17.39509524428238, -66.14390782691305]])
    const matrizubi = [[-17.39353686937, -66.14533076307],[-17.39353686936, -66.14533076308]]
    
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 30,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map)

    // matrizubi.forEach(element => {
    //     const marker = L.marker(element[0], element[1]).addTo(map)
    //     .bindPopup('<b>Esta es el aula</b><br />Aula tantos.').openPopup();
    // });
    const marker = L.marker([-17.39353686937597, -66.14533076307711]).addTo(map)
        .bindPopup('<b>Esta es el aula</b><br />Aula tantos.').openPopup()

    //Ejemplo poligono
    const polygon = L.polygon([
        [51.509, -0.08],
        [51.503, -0.06],
        [51.51, -0.047],
        [51.51, -0.047]
    ]).addTo(map).bindPopup('I am a polygon.')

    const popup = L.popup()
        .setLatLng([-17.39353686937597, -66.14533076307711])
        .setContent('Centro de UMSS.')
        .openOn(map)

    function onMapClick(e) {
        popup
            .setLatLng(e.latlng)
            .setContent(`You clicked the map at ${e.latlng.toString()}`)
            .openOn(map)
    }

    map.on('click', onMapClick)
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js">
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js">
</script>
@endsection



