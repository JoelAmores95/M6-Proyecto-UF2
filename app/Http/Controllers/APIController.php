<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Municipio;
use Illuminate\Support\Facades\Auth;


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
        // Si el usuario está autenticado, se muestran los municipios
        if (auth()->check()) {
            // Se recuperan los municipios de la base de datos y se los paginan
            $municipios = Municipio::paginate(12);
            // Se pasa la variable $municipios a la vista "municipios" mediante el método with
            return view("municipios")->with("municipios", $municipios);
        } else {
            // Si el usuario no está autenticado, se lo redirige a la vista "/home"
            return redirect('/home');
        }
    }

    function mostrarMunicipio_search(Request $request)
    {
        if (Auth::check()) {
            $nom = $request->input('q');
            $municipios = Municipio::all();
            return view("municipio_search", compact("nom", "municipios"));
        } else {
            return redirect('/home');
        }
    }

    function mostrarComarca(Request $request)
    {
        if (Auth::check()) {
            $comarca = $request->input('a');
            $municipios = Municipio::all();
            return view("comarca", compact("comarca", "municipios"));
        } else {
            return redirect('/home');
        }
    }

    function mostrarProvincia(Request $request)
    {
        if (Auth::check()) {
            $provincia = $request->input('x');
            $municipios = Municipio::all();
            return view("provincia", compact("provincia", "municipios"));
        } else {
            return redirect('/home');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function edit(Municipio $municipio)
     {
         if (Auth::check()) {
             $email = auth()->user()->email;
             if ($email == "admin@admin.com") {
                 $update = true;
                 $title = __("Editar municipio");
                 $textButton = __("Actualizar");
                 $route = route("municipio.update", ["municipio" => $municipio]);
                 return view("municipio.edit", compact("municipio", "update", "title", "textButton", "route"));
             } else {
                 return back()
                     ->with("error", __("No tienes permiso para editar municipios. Solo los usuarios con el rol de administrador pueden hacerlo."));
             }
         }
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipio $municipio)
{
    if (Auth::check()) {
        $email = auth()->user()->email;
        if ($email == "admin@admin.com") {
            $this->validate($request, [
                "nombre" => "required",
                "comarca" => "required",
                "provincia" => "required",
                "descripcion" => "required",
            ]);
            $municipio->update($request->all());
            $municipios = Municipio::paginate(12);
            return redirect('/')
                ->with("success", __("¡El municipio :nombre ha sido actualizado!", ["nombre" => $request->nombre]));
        }
    } else {
        return back()
            ->with("error", __("Sólo el usuario con el rol de administrador puede editar municipios."));
    }
}
}
