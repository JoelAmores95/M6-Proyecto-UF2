@extends('layouts.app')
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
        <a class="d-flex justify-content-center" style="text-align: centre; font-weight: bold;" href="http://127.0.0.1:8000/home">
            Vista de inicio de sesión
        </a>
        <br>
        <h1>Busca un municipio</h1>

        <form action="/municipio_search" id="#form" method="post" name="#form">
            @csrf
            <input type="text" name="q" placeholder="¡Busca!">
            <input id='btn' name="submit" type='submit' value='¡Busca!'>
        </form>
        <br>
        <h1>Busca una comarca</h1>

        <form action="/comarca" id="#form" method="post" name="#form">
            @csrf
            <input type="text" name="a" placeholder="¡Busca!">
            <input id='btn' name="submit" type='submit' value='¡Busca!'>
        </form>
        <br>
        <h1>Busca una provincia</h1>

        <form action="/provincia" id="#form" method="post" name="#form">
            @csrf
            <input type="text" name="x" placeholder="¡Busca!">
            <input id='btn' name="submit" type='submit' value='¡Busca!'>
        </form>

        <br><br>
        @if (!(session('success')) && !(session('error')))
        <br>
        <br>
        @endif

        @if (session('success'))
        <p style="color:green"><b>{{ session('success') }}</b></p>
        @endif
        @if (session('error'))
        <p style="color:red"><b>{{ session('error') }}</b></p>
        @endif
        <br>


        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            @foreach($municipios as $municipio)
            <div class="col">
                <div class="card">

                    <h1 class="card-text">{{$municipio['nombre']}}</h1>
                    <p class="card-text">{{$municipio['comarca']}} - {{$municipio['provincia']}}</p>
                    <p class="card-text">{{$municipio['descripcion']}}</p>
                    <div class="card-body">
                        <img src="{{$municipio['foto']}}" class="card-img-top" alt="...">
                        <br><br>
                        <a href="{{ route("municipio.edit", ["municipio" => $municipio]) }}" class="btn btn-warning">{{ __("Editar") }}</a>

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