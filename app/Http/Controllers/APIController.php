<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Municipio;


class APIController extends Controller
{

    function guardarMunicipiosJSONenBD()
    {
        // Leer JSON
        $rutaArchivoJSON = base_path('API/APICat.json');
        $contenido = file_get_contents($rutaArchivoJSON);
        $municipiosJSON = json_decode($contenido, true);

        // Recorrer cada municipio y guardar su información en la base de datos.
        foreach ($municipiosJSON as $municipioJSON) {
            $municipioBD = new Municipio;
            $municipioBD->nombre = $municipioJSON['Municipio'];
            $municipioBD->comarca = $municipioJSON['Comarca'];
            $municipioBD->provincia = $municipioJSON['Provincia'];
            $municipioBD->descripcion = "Municipio de la comarca " . $municipioJSON['Comarca'] . " de la provincia " . $municipioJSON['Provincia'];
            $municipioBD->save();
        }

        return 'Los municipios del JSON se han guardado correctamente en la base de datos.';
    }

    function mostrarMunicipios()
    {
        $municipios = Municipio::paginate(12);
        return view("municipios", compact("municipios"));
    }

    // public function index()
    // {
    //     return Municipio::all();
    // }

    // /** Mostrar municipios de provincia */
    // function mostrarPueblosProvinciaBarcelona()
    // {
    //     $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
    //     $municipios = json_decode($contenido, true);
    //     return $municipios[0]['Municipios'];
    // }
    // function mostrarPueblosProvinciaGirona()
    // {
    //     $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
    //     $municipios = json_decode($contenido, true);
    //     return $municipios[1]['Municipios'];
    // }
    // function mostrarPueblosProvinciaLleida()
    // {
    //     $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
    //     $municipios = json_decode($contenido, true);
    //     return $municipios[2]['Municipios'];
    // }
    // function mostrarPueblosProvinciaTarragona()
    // {
    //     $contenido = Storage::get('MunicipiosProvinciasAgrupado.json');
    //     $municipios = json_decode($contenido, true);
    //     return $municipios[3]['Municipios'];
    // }
}
