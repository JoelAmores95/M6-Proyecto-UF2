<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class ComarcaAPIController extends Controller
{
    /**
     * Retorna una lista de todas las comarcas.
     */
    public function index()
    {
        return Municipio::distinct()->pluck('comarca');
    }

    /**
     * Muestra todos los municipios de una provincia
     */
    public function show(string $comarca)
    {
        return Municipio::where('comarca', $comarca)->get();
    }

}
