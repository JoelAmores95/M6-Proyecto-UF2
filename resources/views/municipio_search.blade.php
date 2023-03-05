@extends('layouts.app')

@section('content')
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
        <br>
        @if (!(session('success')) && !(session('error')))
        <br>
        @endif

        @if (session('success'))
        <p style="color:green"><b>{{ session('success') }}</b></p>
        @endif
        @if (session('error'))
        <p style="color:red"><b>{{ session('error') }}</b></p>
        @endif
        <br>

        @if(isset($nom))
        @foreach($municipios as $municipio)
        <?php $n = 0;
        if ($municipio['nombre'] == $nom) {
            $n++; ?>
            <div class="col">
                <div class="card ">
                    <div style="padding-left: 0.5em;">
                        <h1 class="card-text">{{$municipio['nombre']}}</h1>
                        <p class="card-text">{{$municipio['comarca']}} - {{$municipio['provincia']}}</p>
                        <p class="card-text">{{$municipio['descripcion']}}</p>
                    </div>
                    <div class="card-body">
                        <img src="{{$municipio['foto']}}" class="card-img-top" alt="...">
                        <br><br>
                        <a href="{{ route("municipio.edit", ["municipio" => $municipio]) }}" class="btn btn-warning">{{ __("Editar") }}</a>
                    </div>
                </div>
            </div>
        <?php } ?>


        @endforeach
        <?php if ($n == 0) { ?>
            <p style="color:red"><b>Busca un municipio existente.</b></p>
        <?php } ?>
    </div>
    @else
    <p style="color:red"><b>Busca un municipio.</b></p>
    @endif
    </div>
</body>

</html>
@endsection