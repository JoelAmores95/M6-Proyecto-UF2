<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Municipios de Cataluña</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
    <div class="container my-5">

<h1>Cerca un municipi</h1>

        <form action="/municipio" id="#form" method="post" name="#form">
            @csrf
    <input type="text" name="q" placeholder="Busca!">
    <input id='btn' name="submit" type='submit' value='Cerca!'>
    </form>
    <br>
    <h1>Cerca una comarca</h1>

        <form action="/comarca" id="#form" method="post" name="#form">
            @csrf
    <input type="text" name="a" placeholder="Cerca!">
    <input id='btn' name="submit" type='submit' value='Cerca!'>
    </form>
    <br>
    <h1>Cerca una provincia</h1>

        <form action="/provincia" id="#form" method="post" name="#form">
            @csrf
    <input type="text" name="x" placeholder="Cerca!">
    <input id='btn' name="submit" type='submit' value='Cerca!'>
    </form>

    <a class="d-flex justify-content-center" style="text-align: centre; font-weight: bold;" href="http://127.0.0.1:8000/">
            Mostra tost els municipis
        </a>

@if(isset($comarca))
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                @foreach($municipios as $municipio)
               <?php if ($municipio['comarca'] == $comarca) {?>
                <div class="col">
                    <div class="card">
                        
                    <h1 class="card-text">{{$municipio['nombre']}}</h1>
                    <p class="card-text">{{$municipio['comarca']}} - {{$municipio['provincia']}}</p>
                    <p class="card-text">{{$municipio['descripcion']}}</p>
                    
                    <div class="card-body">
                    <img src="{{$municipio['foto']}}" class="card-img-top" alt="...">
                        
                    </div>
                    </div>
                </div>
                <?php }?>
                
                
                @endforeach
            </div>
            @endif
               </div>
               </body>
               </html>