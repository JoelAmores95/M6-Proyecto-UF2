<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class ProvinciaAPIController extends Controller
{
/**
     * Retorna una lista de todas las provincias.
     */
    public function index()
    {
        return Municipio::distinct()->pluck('provincia');
    }
    /**
     * Muestra todos los municipios de una provincia
     */
    public function show(string $provincia)
    {
        return Municipio::where('provincia', $provincia)->get();
    }
}
