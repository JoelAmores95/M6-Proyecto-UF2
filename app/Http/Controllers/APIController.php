<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Municipio;


class APIController extends Controller
{

    public function index()
    {
        // $contenido = Storage::get('APICat.json');
        // $municipios = json_decode($contenido, true);
        return Municipio::all();
    }

    /** Mostrar municipios de provincia */
    function mostrarPueblosProvinciaBarcelona()
    {
        $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
        $municipios = json_decode($contenido, true);
        return $municipios[0]['Municipios'];
    }
    function mostrarPueblosProvinciaGirona()
    {
        $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
        $municipios = json_decode($contenido, true);
        return $municipios[1]['Municipios'];
    }
    function mostrarPueblosProvinciaLleida()
    {
        $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
        $municipios = json_decode($contenido, true);
        return $municipios[2]['Municipios'];
    }
    function mostrarPueblosProvinciaTarragona()
    {
        $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
        $municipios = json_decode($contenido, true);
        return $municipios[3]['Municipios'];
    }



    function guardarMunicipiosEnBaseDatos()
    {
        $contenido = Storage::get('APICat.json');
        $municipios = json_decode($contenido, true);

        foreach ($municipios as $dato) {
            $nuevoMunicipio = new Municipio; // instancia un nuevo modelo de Eloquent
            $nuevoMunicipio->nombre = $dato['Municipio'];
            $nuevoMunicipio->comarca = $dato['Comarca'];
            $nuevoMunicipio->save();
        }
        return view('main', compact('municipios'));
    }

    function guardarMunicipiosAPI()
    {
        $jsonApi = HTTP::get('https://analisi.transparenciacatalunya.cat/resource/9aju-tpwc.json');
        $municipios = json_decode($jsonApi,true);

        foreach ($municipios as $dato) {
            $nuevoMunicipio = new Municipio; // instancia un nuevo modelo de Eloquent
            $nuevoMunicipio->nombre = $dato['nom'];
            $nuevoMunicipio->comarca = $dato['nom_comarca'];
            $nuevoMunicipio->save();
        }
        return view('main', compact('municipios'));
    }
}
