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
        if (Auth::check()) {
            $municipios = Municipio::paginate(12);
            return view("municipios", compact("municipios"));
        } else {
            return view('/home');
        }
    }


    //NO USAR mostrarMunicipio
    //
    //
    //
    //
    //
    //
    function mostrarMunicipio(Request $request)
    {
        //dd($request->all());
        if (Auth::check()) {
            if ($request != null) {
                $nom = $request->input('q');
                $municipios = Municipio::all();

                $data = array('nom' => $nom, 'municipios' => $municipios);
                return view("municipio", compact("nom", "municipios"));
            }
        } else {
            return view('/home');
        }
    }
    //
    //
    //
    //
    //





    function mostrarMunicipio_search(Request $request)
    {
        //dd($request->all());
        if (Auth::check()) {
            if ($request != null) {
                $nom = $request->input('q');
                $municipios = Municipio::all();

                $data = array('nom' => $nom, 'municipios' => $municipios);
                return view("municipio_search", compact("nom", "municipios"));
            }
        } else {
            return view('/home');
        }
    }

    function mostrarComarca(Request $request)
    {
        //dd($request->all());
        if (Auth::check()) {
            if ($request != null) {
                $comarca = $request->input('a');
                $municipios = Municipio::all();

                $data = array('comarca' => $comarca, 'municipios' => $municipios);
                return view("comarca", compact("comarca", "municipios"));
            }
        } else {
            return view('/home');
        }
    }

    function mostrarProvincia(Request $request)
    {
        //dd($request->all());
        if (Auth::check()) {
            if ($request != null) {
                $provincia = $request->input('x');
                $municipios = Municipio::all();

                $data = array('provincia' => $provincia, 'municipios' => $municipios);
                return view("provincia", compact("provincia", "municipios"));
            }
        } else {
            return view('/home');
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
                $textButton = __("Actualitar");
                $route = route("municipio.update", ["municipio" => $municipio]);
                return view("municipio.edit", compact("municipio", "update", "title", "textButton", "route"));
            } else {
                return back()
                    ->with("error", __("Sólo el usuario «admin» puede editar municipios. Tu usuario se ha de llamar admin."));
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
                $municipios = Municipio::paginate(12);
                $municipio->update($request->all());
                return to_route('/', compact("municipios"))
                    ->with("success", __("¡El municipio " . $request->nombre . " ha sido actualizado!"));
            }
        } else {
            return back()
                ->with("error", __("Sólo el usuario «admin» puede editar municipios. Tu usuario se ha de llamar admin."));
        }
    }
}
