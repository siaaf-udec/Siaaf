@extends('errors.app')

@section('content')
    <div class="row">
        <div class="col-md-12 page-500">
            <div class=" number font-red"> 404 </div>
            <div class=" details">
                <h3>¡Oops! No hay nada por aquí.</h3>
                <p> {{ __('javascript.http_status.404') }} </p>
                <p> {{ $exception->getMessage() }}
                    <br/> </p>
                <p>
                    <a href="{{ route('home') }}" class="btn red btn-outline"> Regresar al inicio </a>
                    <br> </p>
            </div>
        </div>
    </div>
@endsection
