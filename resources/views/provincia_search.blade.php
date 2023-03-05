@extends('layouts.app')

@section('content')
<div class="container">
    <hr>

    <div class="row">
        @forelse($municipios as $municipio)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $municipio->foto }}" class="card-img-top" alt="{{ $municipio->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $municipio->nombre }}</h5>
                    <p class="card-text">{{ $municipio->comarca }}</p>
                    <a href="{{ route('municipio.show', $municipio) }}" class="btn btn-primary">{{ __('Ver más') }}</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-md-12">
            <p>No se encontraron municipios para la provincia de {{ $provincia }}</p>
        </div>
        @endforelse
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $municipios->links() }}
        </div>
    </div>
</div>
@endsection