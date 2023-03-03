@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Comarcas</h1>
    
    <!-- Formulario para buscar por comarca -->
    <form method="GET" action="{{ route('comarca.search') }}">
      <div class="form-group">
        <label for="comarca">Buscar por comarca:</label>
        <input type="text" class="form-control" id="comarca" name="comarca" placeholder="Introduce la comarca a buscar">
      </div>
      <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <hr>

    <!-- Mostrar las comarcas -->
    <div class="row">
      @foreach ($comarcas as $comarca)
        <div class="col-sm-6 col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $comarca->nombre }}</h5>
              <p class="card-text">{{ $comarca->provincia }}</p>
              <a href="{{ route('comarca.show', $comarca) }}" class="btn btn-primary">Ver comarca</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Paginación -->
    <div class="mt-4">
      {{ $comarcas->links() }}
    </div>
  </div>
@endsection
