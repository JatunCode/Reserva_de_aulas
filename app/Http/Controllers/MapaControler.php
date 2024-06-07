<?php

namespace App\Http\Controllers;

use Cornford\Googlmapper\Facades\MapperFacade;
use Cornford\Googlmapper\Mapper;
use Illuminate\Http\Request;

class MapaControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MapperFacade::map(-17.387356, -66.047694, ['zoom' => 15, 'center' => false, 'marker' => false, 'type' => 'HYBRID', 'overlay' => 'TRAFFIC']);
        return view(
            'cornford.googlmapper.map', [
                'id' => 12, 
                'options' => [
                    'latitude' => -17.387356, 
                    'longitude'=> -66.047694, 
                    'tilt' => 'Mapa Facultativo',
                    'zoom' => 15,
                    'center' => false, 
                    'marker' => false, 
                    'type' => 'HYBRID', 
                    'ui' => true,
                    'scrollWheelZoom' => true,
                    'zoomControl' => true,
                    'mapTypeControl' => true,
                    'scaleControl' => true,
                    'streetViewControl' => true,
                    'rotateControl' => true,
                    'fullscreenControl' => true,
                    'gestureHandling' => true,
                    'overlay' => 'TRAFFIC']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
