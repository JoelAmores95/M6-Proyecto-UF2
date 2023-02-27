<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>API test</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container my-5">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($municipios as $municipio)
                <div class="col">
                    <div class="card">
                    
                    <div class="card-body">
                        <p class="card-text">{{$municipio['Municipio']}}</p>
                        <p class="card-text">{{$municipio['Comarca']}}</p>
                    </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>