@extends('material.layouts.dashboard')

@section('page-title', 'Registro de personal:')
@push('styles')
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-book-open', 'title' => 'Registro de empleados mediante archivo excel:'])
        <div class="row">
            <div class="col-md-7">
                <div class="m-heading-1 border-green m-bordered">
                    <p> <strong>Instrucciones para subir un archivo:</strong><br>
                        <br><strong>1.)</strong> El archivo debe contener los mismos campos que el formulario de registro.<br>
                        <br><strong>2.)</strong> La primer fila debe contener los nombres de cada columna.<br>
                        <br><strong>3.)</strong> No afecta si los nombres de las columnas estan en mayuscula o minuscula.<br>
                        <br><strong>4.)</strong> Los nombres de las columnas deben ser nombrados de la siguiente manera:<br>
                        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombres</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apellidos</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Telefono</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Correo</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direccion</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ciudad</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Salario</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Eps</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fpensiones</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Area</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cajacompensacion</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado</strong>
                        <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rol</strong>
                        <br><strong>5.)</strong> No es necesario que las columnas sigan el orden mostrado.<br>
                        <br><strong>6.)</strong> Las columnas Eps, Fpensiones y Cajacompensacion pueden estar vacias las demas deben tener información.</p>
                </div>
            </div>
            <div class="col-md-5">
                {!! Form::open (['id'=>'form-file','method'=>'POST', 'route'=> ['talento.humano.empleado.importUsers'], 'files' => true]) !!}
                <br><br><br>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="input-group input-large">
                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                            <span class="fileinput-filename"> </span>
                        </div>
                        <span class="input-group-addon btn default btn-file">
                                                                <span class="fileinput-new"> Seleccionar </span>
                                                                <span class="fileinput-exists"> Cambiar </span>
                                                                <input type="file" name="import-file"> </span>
                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Eliminar </a>
                    </div>
                </div>
                <br><br>
                {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                {!! Form::close() !!}
            </div>
        </div>
    @endcomponent
@endsection
@push('plugins')
<script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
@endpush
@push('functions')

<script>
    jQuery(document).ready(function() {
        @if(Session::has('message'))
        var type = "{{Session::get('alert-type','info')}}"
        switch (type) {
            case 'success':
                toastr.options.closeButton = true;
                toastr.success("{{Session::get('message')}}", 'Registro exitoso:');
                break;
        }
    });
    @endif
</script>
@endpush
