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
    <!-- toastr Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css') }}" rel="stylesheet"
          type="text/css"/>

    <link href="{{ asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>

    <!-- File Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet"
          type="text/css"/>

    <!-- Modal Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>

    <!-- Date Styles -->
    <link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}"
          rel="stylesheet" type="text/css"/>

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
@section('title', '| Usuarios UDEC')

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
@section('page-title', 'Administración de Usuarios')
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

@section('page-description', 'SIAAF')

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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Crear Usuario'])
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
            <div class="row">
                <div class="col-md-12">

                    {!! Form::open(['id' => 'form_create_user', 'class' => 'form-horizontal', 'url' => '/forms']) !!}
                    <div class="form-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::text('username', old('username'), ['required', 'max' => 20, 'label' => 'Nombre', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-user', 'help' => 'Ingrese el Nombre.']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::text('lastname', old('lastname'), ['required', 'max' => 20, 'label' => 'Apellido', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-user', 'help' => 'Ingrese el Apellido.']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::text('number_document', old('number_document'), ['required', 'max' => 12,'label' => 'Numero de Documento', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese el Numero.']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::select(
                                    'type_user',
                                    ['Estudiante' => 'Estudiante', 'Docente' => 'Docente', 'Externo' => 'Externo'],null,
                                    ['label' => 'Tipo de Usuario' , 'autofocus', 'auto' => 'off']) !!}
                                </div>
                            </div>
                            <div class="form-group divcode">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::text('code', old('code'), [ 'max' => 12,'label' => 'Codigo Instucional', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese el Numero.']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group divcompany">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::text('company', old('company'), ['max' => 25, 'label' => 'Empresa', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-building', 'help' => 'Ingrese la Empresa.']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::select(
                                    'place',
                                    ['Fusagasugá' => 'Fusagasugá', 'Girardot' => 'Girardot', 'Ubaté' => 'Ubaté', 'Chia' => 'Chia', 'Chocontá' => 'Chocontá', 'Facatativá' => 'Facatativá', 'Soacha' => 'Soacha', 'Zipaquirá' => 'Zipaquirá', 'Ninguna' => 'Ninguna'],null,
                                    ['label' => 'Sede' , 'autofocus', 'auto' => 'off']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::text('number_phone', old('number_phone'), ['required', 'max' => 15,'label' => 'Numero de Celular', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese el Numero de Celular.']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-lg-offset-3 text-left">
                                    {!! Field::email('email', old('email'), ['required', 'max' => 80, 'label' => 'E-mail', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-envelope-o', 'help' => 'Ingrese el correo electrónico.']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-lg-offset-3 text-center">
                                {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
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
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
    </script>

    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"
            type="text/javascript"></script>

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
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript"></script>
    {-- bootstrap-toastr Scripts --}
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            var $form = $('#form_create_user');

            var form_rules = {
                username: {minlength: 3, required: true},
                lastname: {required: true, minlength: 3},
                number_document: {
                    minlength: 5, number: true, maxlength: 12, required: true, remote: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{ route('usersUdec.check.document') }}',
                        type: "POST"
                    }
                },
                code: {
                    minlength: 4, number: true, maxlength: 10, remote: {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url: '{{ route('usersUdec.check.code') }}',
                        type: "POST"
                    }
                },
                company: {maxlength: 25},
                number_phone: {minlength: 5, maxlength: 15, required: true},
                email: {email: true, required: true},
                type_user: {required: true},
                place: {required: true}

            };
            var messages = {
                number_document: {
                    remote: "El número de documento ya ha sido registrado."
                },
                code: {
                    remote: "El código ya ha sido registrado."
                }
            };
            $('.divcode').hide();
            $('.divcompany').hide();

            $("#type_user").on('change', function () {
                var tipo = $('select[name="type_user"]').val();
                if (tipo == 'Estudiante') {
                    $('.divcode').show();
                    $('.divcompany').hide();
                }
                if (tipo == 'Externo') {
                    $('.divcode').hide();
                    $('.divcompany').show();
                }
                if (tipo == 'Docente') {
                    $('.divcode').hide();
                    $('.divcompany').hide();
                }
            });

            var createUsers = function () {
                return {
                    init: function () {
                        var route = '{{ route('usersUdec.store') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('username', $('input[name="username"]').val());
                        formData.append('lastname', $('input[name="lastname"]').val());
                        formData.append('number_document', $('input[name="number_document"]').val());
                        formData.append('code', $('input[name="code"]').val());
                        formData.append('company', $('input[name="company"]').val());
                        formData.append('number_phone', $('input[name="number_phone"]').val());
                        formData.append('email', $('input[name="email"]').val());
                        formData.append('type_user', $('select[name="type_user"]').val());
                        formData.append('place', $('select[name="place"]').val());
                        $.ajax({
                            url: route,
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            cache: false,
                            type: type,
                            contentType: false,
                            data: formData,
                            processData: false,
                            async: async,
                            beforeSend: function () {
                                App.blockUI({target: '.portlet-form', animate: true});
                            },
                            success: function (response, xhr, request) {
                                console.log(response);
                                if (request.status === 200 && xhr === 'success') {
                                    $('#form_create_user')[0].reset(); //Limpiar formulario
                                    $(".pmd-select2").select2({
                                        placeholder: "Selecccionar",
                                        allowClear: true,
                                        width: 'auto',
                                        escapeMarkup: function (m) {
                                            return m;
                                        }
                                    });
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                    $('.divcode').hide();
                                    $('.divcompany').hide();
                                }
                            },
                            error: function (response, xhr, request) {
                                if (request.status === 422 && xhr === 'error') {
                                    UIToastr.init(xhr, response.title, response.message);
                                    App.unblockUI('.portlet-form');
                                }
                            }
                        });
                    }
                }
            };

            FormValidationMd.init($form, form_rules, messages, createUsers());
            /*Configuracion de Select*/
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Selecccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });

            /*Configuracion de Select*/
            $.fn.select2.defaults.set("theme", "bootstrap");
            $(".pmd-select2").select2({
                placeholder: "Selecccionar",
                allowClear: true,
                width: 'auto',
                escapeMarkup: function (m) {
                    return m;
                }
            });

            //Aplicar la validación en select2 cambio de valor desplegable, esto sólo es necesario para la integración de lista desplegable elegido.
            $('.pmd-select2', $form).change(function () {
                $form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        });
    </script>
@endpush