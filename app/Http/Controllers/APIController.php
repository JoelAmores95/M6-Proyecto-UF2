<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class APIController extends Controller
{

    public function index()
    {
        $contenido = Storage::get('APICat.json');
        $municipios = json_decode($contenido, true);
        return view('main', compact('municipios'));
    }

    function guardarComarcasAPI()
    {
        $jsonApi = HTTP::get('https://api.idescat.cat/emex/v1/nodes.json?tipus=com&lang=es');
        $jsonDecoded = json_decode($jsonApi);

        // Guardo en array
        foreach ($jsonDecoded->fitxes->v as $comarca) {
            $comarcasGuardadas[] = $comarca;
            // $comarcasGuardadas[] = $comarca->content;
        }
        // return view('main', compact('comarcasGuardadas'));
        return $comarcasGuardadas;
    }

    function mostrarComarcasAPI()
    {
        $jsonApi = HTTP::get('https://api.idescat.cat/emex/v1/nodes.json?tipus=com&lang=es');
        $jsonDecoded = json_decode($jsonApi);

        // Guardo en array
        foreach ($jsonDecoded->fitxes->v as $comarca) {
            // $comarcasGuardadas[] = $comarca;
            $comarcasGuardadas[] = $comarca->content;
        }
        return view('main', compact('comarcasGuardadas'));
    }

    function guardarMunicipiosAPI()
    {
        $jsonApi = HTTP::get('https://analisi.transparenciacatalunya.cat/resource/9aju-tpwc.json');
        $jsonDecoded = json_decode($jsonApi);

        // Guardo en array
        foreach ($jsonDecoded as $municipio) {
            $municipiosGuardados[] = $municipio;
            // $municipiosGuardados[] = $municipio->nom;
        }
        // return view('main', compact('municipiosGuardados'));
        return $municipiosGuardados;
    }

    // function descripcionImagenApi($municipio){
    //     $respuestaApi = HTTP::get('https://en.wikipedia.org/w/api.php?action=query&formatversion=2&prop=pageimages%7Cpageterms&titles='.$municipio.'&pilimit=3&piprop=thumbnail&wbptterms=description&&format=json');
    //     $jsonDecoded = json_decode($respuestaApi);

    //     foreach ($jsonDecoded as $municipio){
    //         $fotos = $municipio->query->pages->title;
    //     }
    //     return view('main', compact('fotos'));
    // }
}
