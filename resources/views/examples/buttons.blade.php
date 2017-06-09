@extends('material.layouts.dashboard')

@section('title', '| Botones')

@section('page-title', 'Botones')

@section('page-description', 'Ejemplo de Botones que se van a usar.')

@section('content')
    <div class="col-md-12">
        {{-- BEGIN COMPONENTS SAMPLE --}}
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-layers', 'title' => 'Botones'])
            @slot('actions', [

                'link_upload' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => 'javascript:;',
                    'icon' => 'icon-trash',
                ],

            ])

            <div class="row">
                <div class="col-md-12">
                    {!! Form::submit('BLUE', ['class' => 'btn blue']) !!}
                    {!! Form::submit('GREEN', ['class' => 'btn green']) !!}
                    {!! Form::submit('GOLD', ['class' => 'btn yellow-gold']) !!}
                    {!! Form::submit('RED', ['class' => 'btn red']) !!}
                    {!! Form::submit('DEFAULT', ['class' => 'btn default']) !!}
                    {!! Form::submit('DARK', ['class' => 'btn dark']) !!}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <h4><strong>Modo de uso:</strong> </h4>
                    <p>Recibe como parámetros, texto del botón y clase del botón</p>
                </div>
                <br>
                <div class="col-md-12">
            <pre>
                <p>Tipo Submit</p>
                {<span>!!</span> Form::submit('BLUE', ['class' => 'btn blue']) <span>!!</span>}
                {<span>!!</span> Form::submit('GREEN', ['class' => 'btn green']) <span>!!</span>}
                {<span>!!</span> Form::submit('GOLD', ['class' => 'btn yellow-gold']) <span>!!</span>}
                {<span>!!</span> Form::submit('RED', ['class' => 'btn red']) <span>!!</span>}
                {<span>!!</span> Form::submit('DEFAULT', ['class' => 'btn default']) <span>!!</span>}
                {<span>!!</span> Form::submit('DARK', ['class' => 'btn dark']) <span>!!</span>}
                <p>Tipo Button</p>
                {<span>!!</span> Form::button('BLUE', ['class' => 'btn blue']) <span>!!</span>}
                {<span>!!</span> Form::button('GREEN', ['class' => 'btn green']) <span>!!</span>}
                {<span>!!</span> Form::button('GOLD', ['class' => 'btn yellow-gold']) <span>!!</span>}
                {<span>!!</span> Form::button('RED', ['class' => 'btn red']) <span>!!</span>}
                {<span>!!</span> Form::button('DEFAULT', ['class' => 'btn default']) <span>!!</span>}
                {<span>!!</span> Form::button('DARK', ['class' => 'btn dark']) <span>!!</span>}
                <p>Tipo Reset</p>
                {<span>!!</span> Form::reset('BLUE', ['class' => 'btn blue']) <span>!!</span>}
                {<span>!!</span> Form::reset('GREEN', ['class' => 'btn green']) <span>!!</span>}
                {<span>!!</span> Form::reset('GOLD', ['class' => 'btn yellow-gold']) <span>!!</span>}
                {<span>!!</span> Form::reset('RED', ['class' => 'btn red']) <span>!!</span>}
                {<span>!!</span> Form::reset('DEFAULT', ['class' => 'btn default']) <span>!!</span>}
                {<span>!!</span> Form::reset('DARK', ['class' => 'btn dark']) <span>!!</span>}
            </pre>
                </div>
            </div>
        @endcomponent
        {{-- END COMPONENTS SAMPLE --}}
    </div>
@endsection