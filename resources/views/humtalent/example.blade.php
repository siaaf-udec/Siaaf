@extends('material.layouts.dashboard')

@section('page-title', 'Documentos Requeridos:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/fullcalendar/fullcalendar.print.css') }}" rel="stylesheet" media='print' type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins-md.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/css/components-md.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/global/css/components.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('assets/global/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />

@endpush

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Registro de empleados mediante archivo excel:'])
        <div class="row">
            <div class="col-md-6">
                <div class="m-heading-1 border-green m-bordered">
                    <p> <strong>Instrucciones para subir un archivo:</strong>
                        <br>Añadir toda la informacion que necesita el funcionario</p>
                </div>
            </div>
            <div class="col-md-5">
                {!! Form::open(['id' => 'mydropzone', 'class' => 'dropzone dropzone-file-area', 'url' => '/forms']) !!}
                <h3 class="sbold">Arrastra o da click aquí para cargar archivos</h3>
                {!! Form::close() !!}<br>
                {!! Form::submit('Registrar', ['class' => 'btn blue button-submit']) !!}
            </div>
        </div>

    @endcomponent
@endsection
@push('plugins')

<script src="{{ asset('assets/global/plugins/fullcalendar/lib/moment.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fullcalendar/fullcalendar.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/fullcalendar/lang-all.js') }}" type="text/javascript"></script>

<script src="{{asset('assets/global/plugins/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>

<script src="{{asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>

@endpush
@push('functions')
<script>
    jQuery(document).ready(function() {
        Dropzone.options.mydropzone = {
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            dictDefaultMessage : 'Arrastra los archivos aquí para subirlos',
            accept: function(file, done) {
                if (file.name == "calendario2.txt") {
                    done("Prueba");
                }
                else { done(); }
            }
        };
    });

</script>
@endpush
