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
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                @foreach($municipios as $municipio)
                <div class="col">
                    <div class="card">
                        
                    <h1 class="card-text">{{$municipio['nombre']}}</h1>
                    <p class="card-text">{{$municipio['comarca']}} - {{$municipio['provincia']}}</p>
                    <div class="card-body">
                    <img src="{{$municipio['foto']}}" class="card-img-top" alt="...">
                        
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $municipios->links() !!}
            </div>
        </div>
    </body>
</html>