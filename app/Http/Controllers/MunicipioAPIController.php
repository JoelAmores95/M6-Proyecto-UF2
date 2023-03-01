<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioAPIController extends Controller
{
    /**
     * Muestra TODOS los municipios
     */
    public function index()
    {
        return Municipio::all();
    }

    /**
     * Muestra el municipio especificado
     */
    public function show(string $nombre)
    {
        return Municipio::where('nombre', $nombre)->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
