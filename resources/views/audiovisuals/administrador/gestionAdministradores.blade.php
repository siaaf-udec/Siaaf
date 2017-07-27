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
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet" type="text/css"/>
@endpush


{{--
|--------------------------------------------------------------------------
| Title
|--------------------------------------------------------------------------
|
| Inyecta el título de la página a la etiqueta
<title>
</title>
de la plantilla
| Recibe texto o variables de los controladores
| Sin embargo, también se puede usar de la siguiente forma
|
| @section('title', $miVariable)
| @section('title', 'Título')
--}}
@section('title', '| Gestion Administradores')

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
@section('page-title', 'Gestion Administradores')
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

@section('page-description', 'crear modificar y eliminar administradores')

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
    {{-- BEGIN HTML SAMPLE --}}
<div class="col-md-12">
    @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Administradores'])
    <a class="btn btn-outline dark" data-toggle="modal" href="#responsive">
        Nuevo Administrador
    </a>
    {{-- BEGIN HTML MODAL --}}
    <!-- responsive -->
    <div class="modal fade" data-width="760" id="responsive" tabindex="-1">
        <div class="modal-header modal-header-success">
            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
            </button>
            <h2 class="modal-title">
                <i class="glyphicon glyphicon-user">
                </i>
                Registrar Administrador
            </h2>
        </div>
        <div class="modal-body">
            {!! Form::open(['id' => 'from_admin_create', 'class' => '', 'url' => '/forms']) !!}
            <div class="row">
                <div class="col-md-6">
                    <p>
                        {!! Field::text('ADMIN_Cedula',
                        ['label' => 'Cedula:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Ingrese Cedula', 'icon' => 'fa fa-user'])
                        !!}
                    </p>
                    <p>
                        {!! Field::text('ADMIN_Apellidos',
                        ['label' => 'Apellidos:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Ingrese Apellidos', 'icon' => 'fa fa-user'])
                        !!}
                    </p>
                    <p>
                        {!! Field::email('ADMIN_Correo',
                        ['label' => 'Correo Electronico:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Ingrese Email', 'icon' => ' fa fa-envelope-open'])
                        !!}
                    </p>
                    <p>
                        {!! Field::text('FK_ADMIN_Estado',
                        ['label' => 'Estado:', 'placeholder'=>'Activo','disabled','value'=>'Activo'],
                        ['help' => 'Ingrese Estado "Activo","Inactivo"', 'icon' => 'fa fa-ban'])
                        !!}
                    </p>
                    <p>
                        {!! Field::password('ADMIN_Clave', 
                        ['label' => 'Contraseña:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Ingrese Contraseña', 'icon' => 'fa fa-key'])
                        !!}
                    </p>
                </div>
                <div class="col-md-6">
                    <p>
                        {!! Field::text('ADMIN_Nombres',
                        ['label' => 'Nombres:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Ingrese Nombres', 'icon' => 'fa fa-user'])
                        !!}
                    </p>
                    <p>
                        {!! Field::text('ADMIN_Direccion',
                        ['label' => 'Dirección:', 'max' => '30', 'min' => '5', 'required', 'auto' => 'off'],
                        ['help' => 'Ingrese Direccion', 'icon' => 'fa fa-map-marker'])
                        !!}
                    </p>
                    <p>
                        {!! Field::tel('ADMIN_Telefono',
                            ['label' => 'Telefono:','required', 'auto' => 'off', 'max' => '10'],
                            ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone'])
                        !!}
                    </p>
                    <p>
                        {!! Field::text('FK_ADMIN_Rol',
                        ['label' => 'Rol:', 'placeholder'=>'Administrador','disabled','value'=>'Administrador'],
                        ['help' => 'Ingrese Rol "Administrador","Docente"', 'icon' => 'fa fa-ban'])
                        !!}
                    </p>
                    <p>
                        {!! Field::password('ADMIN_RClave', 
                        ['label' => 'Repetir Contraseña:', 'max' => '15', 'min' => '2', 'required', 'auto' => 'off'],
                        ['help' => 'Ingrese Contraseña', 'icon' => 'fa fa-key'])
                        !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit('Guardar', ['class' => 'btn blue']) !!}
            {!! Form::button('Cancelar', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
        </div>
        {!! Form::close() !!}
    </div>
    {{-- END HTML MODAL --}}

    @endcomponent
</div>
{{-- END HTML SAMPLE --}}
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
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}" type="text/javascript">
</script>
<script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
</script>
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
@endpush
