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
@section('title', '| Registro Usuario')

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
@section('page-title', 'Registro de Ingresos de Usuarios')
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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Registrar Ingreso'])
            <div class="row">
                <div class="col-md-4 col-lg-offset-9">
                    <a href="{{route('adminRegist.help.index.preguntas')}}"
                       class="btn btn-simple dark btn-icon"><i
                                class="fa fa-plus"></i>Preguntas Frecuentes</a>
                </div>
                <div class="col-md-12 col-lg-offset-1">
                    <div class="col-md-4 col-lg-offset-3">
                        <div class="alert alert-block alert-info fade in">
                            <h4 class="alert-heading">Información!</h4>
                            <p>Si no se encuentra registrado por favor presione el boton Registrarse: </p>
                            <div class="col-lg-offset-3">
                                <br>
                                <p>
                                    <a href="javascript:;"
                                       class="btn btn-simple btn-success btn-icon btn-center create"><i
                                                class="fa fa-plus"></i>Registrarse</a>
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>


                    {!! Form::open(['id' => 'form_register', 'class' => 'form-horizontal', 'url' => '/forms']) !!}

                    <div class="form-group">
                        <div class="col-md-4 col-lg-offset-3 text-left">
                            {!! Field::text('number_document', old('number_document'), ['required','max' => 13, 'min' => '5','type' => 'number','label' => 'Numero de Documento', 'autofocus', 'auto' => 'off'], ['icon' => 'fa fa-sort-numeric-asc', 'help' => 'Ingrese el Numero.']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-lg-offset-3 text-left">
                            {!! Field::select(
                            'novedad',null,
                            ['required','label' => 'Novedades' , 'autofocus', 'auto' => 'off']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-lg-offset-3 text-center">
                            {{ Form::submit('Registrar', ['class' => 'btn blue']) }}
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

            /* Configuración del Select cargado de la BD */

            var $widget_select_SelectNovedad = $('select[name="novedad"]');

            var route_Dependencia = '{{ route('adminRegist.registros.listNovedades') }}';
            $.get(route_Dependencia, function (response, status) {
                $(response.data).each(function (key, value) {
                    $widget_select_SelectNovedad.append(new Option(value.NOV_NombreNovedad, value.PK_NOV_IdNovedad));
                });
                $widget_select_SelectDependencia.val([]);
                $('#PK_NOV_IdNovedad').val(1);
            });

            var $form = $('#form_register');

            var form_rules = {
                number_document: {
                    minlength: 5, number: true, maxlength: 13, required: true
                },
                novedad: {required: true}

            };
            var messages = {};

            var register = function () {
                return {
                    init: function () {
                        var route = '{{ route('adminRegist.registros.registro') }}';
                        var type = 'POST';
                        var async = async || false;

                        var formData = new FormData();
                        formData.append('number_document', $('input[name="number_document"]').val());
                        formData.append('novedad', $('select[name="novedad"]').val());

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
                                    if (response.title === 'false') {
                                        UIToastr.init('error', '¡Lo sentimos!', 'El usuario no se encuentra registrado.');
                                        App.unblockUI('.portlet-form');
                                    } else {
                                        $('#form_register')[0].reset(); //Limpiar formulario
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
                                        UIToastr.init(xhr, response.title, response.message);
                                        App.unblockUI('.portlet-form');
                                        //var route = ' //route('administrative.user.index.ajax') }}';
                                        //$(".content-ajax").load(route);
                                    }

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

            $(".create").on('click', function (e) {
                e.preventDefault();
                var route_create = '{{ route('adminRegist.users.create') }}';
                $(".content-ajax").load(route_create);
            });

            FormValidationMd.init($form, form_rules, messages, register());
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