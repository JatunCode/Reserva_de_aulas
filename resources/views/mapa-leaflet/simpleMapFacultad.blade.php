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

        .custom-popup .leaflet-popup-content-wrapper {
            background-color: lightblue;
            color: darkblue;
            white-space: nowrap;
        }

        .custom-popup .leaflet-popup-tip {
            background-color: lightblue;
        }

        .custom-popup-icon {
            display: inline-block;
            white-space: nowrap;
        }
     </style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col md 12">
            <div class="card">
                <div class="card-header row">
                    <div class="col-md-3" id="containerBusqueda">
                        <label class="form-label" for="busqueda">Busqueda</label>
                        <input class="form-control" type="text" name="busqueda" placeholder="Buscar ambiente">
                        <p id="messageErrorBusqueda" style="display: none; color: red">*No se encontro resultados</p>
                    </div>
                </div>
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
    // const marker = L.marker([-17.39353686937597, -66.14533076307711]).addTo(map)
    //     .bindPopup('<b>Esta es el aula</b><br />Aula tantos.').openPopup()

    const createCustomPopup = (latlng, content) => {
            const popupDiv = L.DomUtil.create('div', 'custom-popup');
            popupDiv.innerHTML = content;
            return L.marker(latlng, {
                icon: L.divIcon({
                    className: 'custom-popup-icon',
                    html: popupDiv.outerHTML
                })
            }).addTo(map);
        };

    createCustomPopup([-17.393443, -66.14548], 'Aula: 624')
    createCustomPopup([-17.393277, -66.145222], 'Aula: 622')
    createCustomPopup([-17.393223, -66.14555], 'Aula: 623')
    createCustomPopup([-17.394574, -66.145209], 'Auditorio: Auditorio de Ing Civil')
    createCustomPopup([-17.392842, -66.146963], 'Auditorio: Auditorio Informatica Sistemas')
    createCustomPopup([-17.394912, -66.144949], 'Aula: 691A')
    createCustomPopup([-17.394812, -66.144968], 'Aula: 691B')
    createCustomPopup([-17.394782, -66.144855], 'Aula: 691C')
    createCustomPopup([-17.394771, -66.144729], 'Aula: 691D')
    createCustomPopup([-17.394756, -66.144587], 'Aula: 691E')
    createCustomPopup([-17.394843, -66.144565], 'Aula: 691F')
    createCustomPopup([-17.393223, -66.14555], 'Aula: 623')
    createCustomPopup([-17.393443, -66.14548], 'Aula: 624')
    createCustomPopup([-17.393277, -66.145222], 'Aula: 622')
    createCustomPopup([-17.393223, -66.14555], 'Aula: 623')

    //Ejemplo poligono
    const polygon = L.polygon([
        [-17.393367, -66.145413],
        [-17.393383, -66.145507],
        [-17.393524, -66.145477],
        [-17.393507, -66.145385]
    ],{
        color: 'red',
        fillColor: 'red',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('<b>Esta es el aula: </b><br />624.')

    const popup = L.popup()
        .setLatLng([-17.393466, -66.145432])
        .setContent('Aula: 624')
        .openOn(map)

    const polygon2 = L.polygon([
        [-17.393213, -66.145251],
        [-17.39335, -66.145223],
        [-17.393336, -66.145131],
        [-17.393196, -66.145159]
    ],{
        color: 'yellow',
        fillColor: 'yellow',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('<b>Esta es el aula: </b><br />622.')

    const popup2 = L.popup()
        .setLatLng([-17.393272, -66.145182])
        .setContent('Aula: 622')
        .openOn(map)

    const polygon3 = L.polygon([
        [-17.393275, -66.14552],
        [-17.393261, -66.145431],
        [-17.393122, -66.145457],
        [-17.393138, -66.145546]
    ],{
        color: 'cyan',
        fillColor: 'cyan',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('623')
    
    const polygon4 = L.polygon([
        [-17.392878, -66.146985],
        [-17.392866, -66.146914],
        [-17.392805, -66.146926],
        [-17.392821, -66.146996]
    ],{
        color: 'green',
        fillColor: 'green',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('Auditorio Informatica Sistemas')
    
    const polygon5 = L.polygon([
        [-17.394607, -66.145235],
        [-17.394598, -66.145163],
        [-17.394542, -66.14518],
        [-17.394548, -66.145251]
    ],{
        color: 'magenta',
        fillColor: 'magenta',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('Auditorio Ing Civil')
    //+0.000065 +0.000050
    //-0.000037 +0.000071
    //-0.000054 -0.000035
    //+0.000045 -0.000051

    //-17.394912, -66.144949
    
    const polygon7 = L.polygon([
        [-17.394847, -66.144899],  // Vértice superior
        [-17.394949, -66.144878],  // Vértice derecho
        [-17.394966, -66.144984],  // Vértice inferior
        [-17.394865, -66.145000]   // Vértice izquierdo
    ],{
        color: 'orange',
        fillColor: 'orange',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('691A')
    
    // -17.394812, -66.144968
    //-0.000054 -0.000035
    //-0.000037 +0.000071
    //+0.000065 +0.000050
    //+0.000045 -0.000051
    
    const polygon6 = L.polygon([
        [-17.394865, -66.145],
        [-17.394847, -66.144899],
        [-17.394757, -66.144919],
        [-17.394774, -66.145017]
    ],{
        color: 'purple',
        fillColor: 'purple',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('691B')

    // -17.394782, -66.144855
    //+0.000065 +0.000050
    //-0.000037 +0.000071
    //-0.000054 -0.000035
    //+0.000045 -0.000051
    
    const polygon8 = L.polygon([
        [-17.39483, -66.144902],
        [-17.39481, -66.144776],
        [-17.394736, -66.144794],
        [-17.394757, -66.144918]
    ],{
        color: 'brown',
        fillColor: 'brown',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('691C')
    
    // -17.394771, -66.144729
    //+0.000065 +0.000050
    //-0.000037 +0.000071
    //-0.000054 -0.000035
    //+0.000045 -0.000051
    
    const polygon9 = L.polygon([
        [-17.39481, -66.144775],
        [-17.394789, -66.144639],
        [-17.394717, -66.144654],
        [-17.394736, -66.144791]
    ],{
        color: 'pink',
        fillColor: 'pink',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('691D')
    
    // -17.394756, -66.144587
    //+0.000065 +0.000050
    //-0.000037 +0.000071
    //-0.000054 -0.000035
    //+0.000045 -0.000051
    
    const polygon10 = L.polygon([
        [-17.394806, -66.144631],
        [-17.394788, -66.14453],
        [-17.394701, -66.144551],
        [-17.394717, -66.144652]
    ],{
        color: 'lilac',
        fillColor: 'lilac',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('691E')
    
    // -17.394843, -66.144565
    //+0.000065 +0.000050
    //-0.000037 +0.000071
    //-0.000054 -0.000035
    //+0.000045 -0.000051
    
    const polygon11 = L.polygon([
        [-17.394904, -66.144608],
        [-17.394886, -66.144509],
        [-17.394791, -66.144532],
        [-17.394808, -66.144631]
    ],{
        color: 'fuchsia',
        fillColor: 'fuchsia',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('691F')

    //+0.000065 +0.000050
    //-0.000037 +0.000071
    //-0.000054 -0.000035
    //+0.000045 -0.000051
    
    const polygon12 = L.polygon([
        [-17.393275, -66.14552],
        [-17.393261, -66.145431],
        [-17.393122, -66.145457],
        [-17.393138, -66.145546]
    ],{
        color: 'cyan',
        fillColor: 'cyan',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('623')
    //+0.000065 +0.000050
    //-0.000037 +0.000071
    //-0.000054 -0.000035
    //+0.000045 -0.000051
    
    const polygon13 = L.polygon([
        [-17.393275, -66.14552],
        [-17.393261, -66.145431],
        [-17.393122, -66.145457],
        [-17.393138, -66.145546]
    ],{
        color: 'cyan',
        fillColor: 'cyan',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('623')
    
    
    const polygon14 = L.polygon([
        [-17.393275, -66.14552],
        [-17.393261, -66.145431],
        [-17.393122, -66.145457],
        [-17.393138, -66.145546]
    ],{
        color: 'cyan',
        fillColor: 'cyan',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('623')
    
    const polygon15 = L.polygon([
        [-17.393275, -66.14552],
        [-17.393261, -66.145431],
        [-17.393122, -66.145457],
        [-17.393138, -66.145546]
    ],{
        color: 'cyan',
        fillColor: 'cyan',
        fillOpacity: 0.2
    }).addTo(map)
    //.bindPopup('623')
    
    // const popupC = L.popup()
    //     .setLatLng([-17.39353686937597, -66.14533076307711])
    //     .setContent('Centro de UMSS.')
    //     .openOn(map)


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



