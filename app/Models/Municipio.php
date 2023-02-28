<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    // Datos del Objeto Municipio
    
    protected $fillable = [
        'nombre', 
        'comarca', 
        'provincia', 
        'descripcion', 
        'foto'
    ];
}
