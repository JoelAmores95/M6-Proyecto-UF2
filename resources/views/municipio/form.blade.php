<div class="w-full">
    <div class="flex flex-wrap">
        <h1 class="mb-5">{{ $title }}</h1>
    </div>
</div>

<form method="POST" action="{{ $route }}" class="needs-validation">
    @csrf
    @isset($update)
    @method("PUT")
    @endisset

    <div class="mb-3">
        <label for="nombre" class="form-label">{{ __("Nombre") }}</label>
        <input name="nombre" type="text" class="form-control" value="{{ old("nombre") ?? $municipio->nombre }}">
        @error("nombre")
        <div class="fs-6 text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="comarca" class="form-label">{{ __("Comarca") }}</label>
        <input name="comarca" type="text" class="form-control" value="{{ old("comarca") ?? $municipio->comarca }}">
        @error("comarca")
        <div class="fs-6 text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="provincia" class="form-label">{{ __("Provincia") }}</label>
        <input name="provincia" type="text" class="form-control" value="{{ old("provincia") ?? $municipio->provincia }}">
        @error("provincia")
        <div class="fs-6 text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">{{ __("Descripcion") }}</label>
        <input name="descripcion" type="text" class="form-control" value="{{ old("descripcion") ?? $municipio->descripcion }}">
        @error("descripcion")
        <div class="fs-6 text-danger">{{ $message }}</div>
        @enderror
    </div>




    <div class="mb-3">
        <button class="btn btn-primary" type="submit">
            {{ $textButton }}
        </button>
        <a class="btn btn-primary" href="http://127.0.0.1:8000/">
            Ver municipios
        </a>
    </div>
</form>