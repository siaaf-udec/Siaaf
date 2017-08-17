{{--
|--------------------------------------------------------------------------
| Extends
|--------------------------------------------------------------------------
|
| Hereda los estilos y srcipts de la de la plantilla original.
| Es la base para todas las páginas que se deseen crear.
|
--}}
@extends('material.layouts.dashboard')

{{--
|--------------------------------------------------------------------------
| Styles
|--------------------------------------------------------------------------
|
| Inyecta CSS requerido ya sea por un JS o para un elemento específico
|
| @push('styles')
|
| @endpush
--}}
@push('styles')
<link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta <title></title> de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Dashboard')

{{--
|--------------------------------------------------------------------------
| Page Title
|--------------------------------------------------------------------------
|
| Inyecta el título a la sección del contenido de página.
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-title', $miVariable)
| @section('page-title', 'Título')
|
|
--}}
@section('page-title', 'Socket')
{{--
|--------------------------------------------------------------------------
| Page Description
|--------------------------------------------------------------------------
|
| Inyecta una breve descripción a la sección del contenido de página.
| Recibe texto o variables de los controladores o se puede dejar sin datos
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('page-description', $miVariable)
| @section('page-description', 'Título')
--}}

@section('page-description', 'Breve descripción de la página')

{{--
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
|
| Inyecta el contenido HTML que se usará en la página
|
| @section('content')
|
| @endsection
--}}
@section('content')
    <div class="col-md-12">
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Redis'])

            @slot('actions', [

                'link_upload' => [
                    'link' => '',
                    'icon' => 'icon-cloud-upload',
                ],
                'link_wrench' => [
                    'link' => '',
                    'icon' => 'icon-wrench',
                ],
                'link_trash' => [
                    'link' => '',
                    'icon' => 'icon-trash',
                ],

            ])
            <div class="clearfix"> </div><br><br><br>
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['id' => 'form_redis', 'class' => '', 'url' => route('socket.redis.store')]) !!}
                    {!! Field::text(
                       'author',
                       ['label' => 'Texto para el Label', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                       ['help' => 'Texto de ayuda', 'icon' => 'fa fa-user']) !!}
                    {!! Field::textarea(
                       'content',
                       ['label' => 'Texto para el Label', 'max' => '15', 'min' => '2', 'style' => 'height:50px', 'required', 'auto' => 'off'],
                       ['help' => 'Texto de ayuda']) !!}
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                {{ Form::submit('Enviar', ['class' => 'btn green']) }}
                                {{ Form::button('Cancelar', ['class' => 'btn red']) }}
                                {{ Form::reset('Reset', ['class' => 'btn yellow-gold']) }}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="col-md-12">
                    <ul class='chat'>
                        @foreach($messages as $message)
                            <li>
                                <b>{{ $message->author }}</b>
                                <p>{{ $message->content }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endcomponent
    </div>
@endsection

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts necesarios para usar plugins
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}

@push('plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
@endpush

{{--
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| Inyecta scripts para inicializar componentes Javascript como
| > Tablas
| > Checkboxes
| > Radios
| > Mapas
| > Notificaciones
| > Validaciones de Formularios por JS
| > Entre otros
| @push('functions')
|
| @endpush
--}}
@push('functions')
<script type="text/javascript">

    jQuery(document).ready(function() {
        var socket = io(':6001'),
            channel = 'private-chat:message';

        socket.on('connect', function (error) {
            socket.emit('sub', channel)
        });

        socket.on('message', function (message) {
            console.info(message)
        });

        socket.on('error', function (error) {
            console.warn('Error', error)
        });

        socket.on(channel, function (data) {
           appendMessage(data);
        });

        var appendMessage = function (data) {
            $('.chat').append(
                $('<li>').append(
                    $('<b>').text(data.author),
                    $('<p>').text(data.content)
                )
            );
        };
    });

</script>
@endpush