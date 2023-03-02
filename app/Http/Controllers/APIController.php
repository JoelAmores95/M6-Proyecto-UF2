<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;


class APIController extends Controller
{

    function guardarMunicipiosJSONenBD()
    {
        // Seguro para evitar errores
        ini_set('max_execution_time', 1800);

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

            // Peticion API para foto
            $response = HTTP::get("https://en.wikipedia.org/w/api.php?action=query&formatversion=2&pilimit=3&piprop=thumbnail&prop=pageimages%7Cpageterms&redirects=&titles=" . urlencode($municipioJSON['Municipio']) . "&wbptterms=description&format=json");
            $pages = $response['query']['pages'];
            $page = reset($pages);

            // En algunos casos no existe thumbnail
            if (array_key_exists('thumbnail', $page)) {
                $municipioBD->foto = $page['thumbnail']['source'];
            } else {
                // Foto de error
                $municipioBD->foto = "https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg";
            }

            $municipioBD->save();

            // Aumento la calidad de las fotos
            DB::statement("UPDATE municipios SET foto = REPLACE(foto, '50px', '500px')");
        }

        return 'Los municipios del JSON se han guardado correctamente en la base de datos.';
    }

    function mostrarMunicipios()
    {

        $municipios = Municipio::paginate(12);
        return view("municipios", compact("municipios"));
    }

    function mostrarMunicipio (Request $request)
    {
        //dd($request->all());
        $nom = $request->input('q');
        $municipios = Municipio::all();

        $data=array('nom'=>$nom, 'municipios'=>$municipios);
        return view("municipio", compact("nom", "municipios"));
    }

    function mostrarComarca (Request $request)
    {
        //dd($request->all());
        $comarca = $request->input('a');
        $municipios = Municipio::all();

        $data=array('comarca'=>$comarca, 'municipios'=>$municipios);
        return view("comarca", compact("comarca", "municipios"));
    }

    function mostrarProvincia (Request $request)
    {
        //dd($request->all());
        $provincia = $request->input('x');
        $municipios = Municipio::all();

        $data=array('provincia'=>$provincia, 'municipios'=>$municipios);
        return view("provincia", compact("provincia", "municipios"));
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
