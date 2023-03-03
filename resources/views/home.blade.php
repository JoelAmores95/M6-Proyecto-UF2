@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php if(Auth::check())
        {
                    echo "<p>¡Has iniciado sesión!</p>
                    <br>  <a href=\"http://127.0.0.1:8000\"><b>Mostrar municipios</b></a>";
        } else {
            echo "<p>¡Necesitas iniciar sesión!</p>";
        } ?>
                    
                </div>
               
            </div>
           
        </div>
    </div>
</div>
@endsection
