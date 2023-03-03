@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($municipio))
            <div class="card">
                <h1 class="card-text">{{ $municipio['nombre'] }}</h1>
                <p class="card-text">{{ $municipio['comarca'] }} - {{ $municipio['provincia'] }}</p>
                <p class="card-text">{{ $municipio['descripcion'] }}</p>
                <div class="card-body">
                    <img src="{{ $municipio['foto'] }}" class="card-img-top" alt="...">
                    <br><br>
                    <a href="{{ route("municipio.edit", ["municipio" => $municipio]) }}" class="btn btn-warning">{{ __("Editar") }}</a>
                </div>
            </div>
        @endif

        @if(isset($error))
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endif
    </div>
@endsection
