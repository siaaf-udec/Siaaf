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
    <!-- STYLES SELECT -->
    <link href="{{ asset('assets/global/plugins/select2material/css/select2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/select2-bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/select2material/css/pmd-select2.css') }}" rel="stylesheet"
          type="text/css"/>
    {{--MODAL--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css') }}" rel="stylesheet"
          type="text/css"/>
    {{--DATEPICKER--}}
    <link href="{{ asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
          rel="stylesheet" type="text/css"/>
    {{--TOAST--}}
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Styles SREETALERT  -->
    <link href="{{asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.css')}}" rel="stylesheet"
          type="text/css"/>
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
@section('title', '|Reserva Por Kit')

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
@section('page-title', 'Prestamo Articulo')
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

@section('page-description', '')

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
        @component('themes.bootstrap.elements.portlets.portlet', ['icon' => 'icon-frame', 'title' => 'Gestion Reservas'])
        <br>
        <br>
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['id' => 'form_identificacion', 'class' => '', 'url' => '/forms']) !!}
                    <div class="col-md-5">
                        {!! Field::text('id_funcionario',
                            ['label' => 'Ingrese Identificacion:'],
                            ['help' => 'Digite Numero de identificación valido', 'icon' => 'fa fa-credit-card'])
                        !!}
                    </div>
                    <br>
                    <div class="col-md-3">
                        {!! Form::submit('Ingresar', ['class' => 'btn blue' ,'id'=>'btn_ingresar_identificacion']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                {{-- BEGIN HTML MODAL CREATE --}}
                <!-- responsive -->
                    <div class="modal fade" data-width="760" id="modal-info-funcionario" tabindex="-1">
                        <div class="modal-header modal-header-success">
                            <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            </button>
                            <h2 class="modal-title">
                                <i class="glyphicon glyphicon-user">
                                </i>
                                Informacion Funcionario
                            </h2>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['id' => 'from_info_funcionario', 'class' => '', 'url' => '/forms']) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::text('FUCNIONARIO_Nombres',
                                        ['disabled','label' => 'Nombres:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'2'],
                                        ['help' => 'Ingrese Nombres', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::email('FUCNIONARIO_Correo',
                                        ['disabled','label' => 'Correo Electronico:', 'max' => '40', 'min' => '10', 'required', 'auto' => 'off','tabindex'=>'5'],
                                        ['help' => 'Ingrese Email', 'icon' => ' fa fa-envelope-open'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::tel('FUCNIONARIO_Telefono',
                                        ['disabled','label' => 'Telefono:','required', 'auto' => 'off', 'max' => '10','tabindex'=>'6'],
                                        ['help' => 'Digita un número de teléfono.', 'icon' => 'fa fa-phone'])
                                        !!}
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <p>
                                        {!! Field::text('FUCNIONARIO_Apellidos',
                                        ['disabled','label' => 'Apellidos:', 'max' => '40', 'min' => '2', 'required', 'auto' => 'off','tabindex'=>'3'],
                                        ['help' => 'Ingrese Apellidos', 'icon' => 'fa fa-user'])
                                        !!}
                                    </p>
                                    <p>
                                        {!! Field::select('FK_FUNCIONARIO_Programa',
                                            $carrerasUdec,
                                           ['label' => 'seleccione un programa'])
                                       !!}
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            {!! Form::submit('INGRESAR PRESTAMO', ['class' => 'btn blue']) !!}
                            {!! Form::button('CANCELAR', ['class' => 'btn red', 'data-dismiss' => 'modal' ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {{-- END HTML MODAL CREATE--}}
                </div>

            </div>
        @endcomponent
        <div class="clearfix"></div>
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
    <!-- SCRIPT MODAL -->
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT SELECT -->
    <script src="{{ asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT REPEATER -->
    {{--<script src="{{ asset('assets/pages/scripts/form-repeater.min.js') }} " type="text/javascript"></script>--}}
    <script src="{{ asset('assets/global/plugins/jquery-repeater/jquery.repeater.js') }} "
            type="text/javascript"></script>
    <!-- SCRIPT DATEPICKER -->
    <script src="{{ asset('assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"
            type="text/javascript"></script>
    <!-- SCRIPT Validacion Personalizadas -->
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
            type="text/javascript">
    </script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/localization/messages_es.js') }}"
            type="text/javascript">
    </script>
    <!-- SCRIPT MENSAJES TOAST-->
    <script src="{{ asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Validacion Maxlength -->
    <script src="{{ asset('assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"
            type="text/javascript">
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
    <!-- Estandar Validacion -->
    <script src="{{ asset('assets/main/scripts/form-validation-md.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Mensajes -->
    <script src="{{ asset('assets/main/scripts/ui-toastr.js') }}" type="text/javascript">
    </script>
    <!-- SCRIPT Confirmacion Sweetalert -->
    <script src="{{ asset('assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}" type="text/javascript">
    </script>
    <!-- Estandar Datatable -->
    <script src="{{ asset('assets/main/scripts/table-datatable.js') }}" type="text/javascript">
    </script>
    <script type="text/javascript">
        var FormSelect2 = function () {
            return {
                init: function () {
                    $.fn.select2.defaults.set("theme", "bootstrap");
                    $(".pmd-select2").select2({
                        placeholder: "Selecccionar",
                        allowClear: true,
                        width: 'auto',
                        escapeMarkup: function (m) {
                            return m;
                        }
                    });
                }
            }
        }();
        var guardarPrograma = false,idFuncionarioD = null;
        jQuery(document).ready(function () {
            FormSelect2.init();
            var createPrograma = function () {
                return{
                    init: function () {
                        if( guardarPrograma == true ){
                            var route = '{{route('crearFuncionarioAdmin.storePrograma')}}';
                            var type = 'POST';
                            var async = async || false;
                            var formData = new FormData();
                            formData.append('FK_FUNCIONARIO_Programa', $('select[name="FK_FUNCIONARIO_Programa"]').val());
                            formData.append('idFuncionario', idFuncionarioD);
                            $.ajax({
                                url: route,
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                cache: false,
                                type: type,
                                contentType: false,
                                data: formData,
                                processData: false,
                                async: async,
                                beforeSend: function () {},
                                success: function (response, xhr, request) {
                                    if (request.status === 200 && xhr === 'success') {
                                        $('#modal-info-funcionario').modal('hide');
                                        $('#from_info_funcionario')[0].reset(); //Limpia formulario
                                        UIToastr.init(xhr , response.title , response.message  );
                                        var routeAjax = '{{route('opcionPrestamoAjax')}}';
                                        $(".content-ajax").load(routeAjax);
                                    }
                                },
                                error: function (response, xhr, request) {
                                    if (request.status === 422 &&  xhr === 'error') {
                                        UIToastr.init(xhr, response.title, response.message);
                                    }
                                }
                            });
                        }
                        else{
                            $('#modal-info-funcionario').modal('hide');
                            var routeAjax = '{{route('opcionPrestamoAjax')}}';
                            $(".content-ajax").load(routeAjax);
                        }
                    }
                }
            };
            var form_create = $('#from_info_funcionario');
            var rules_create = {
                FK_FUNCIONARIO_Programa:{required: true}
            };
            FormValidationMd.init(form_create,rules_create,false,createPrograma());
            var createIngreso = function () {
                return{
                    init: function () {
                        guardarPrograma=false;
                        var route = '{{ route('opcionPrestamoAjax') }}';
                        idfuncionarioD = $('#id_funcionario').val();
                        var  route_edit = '{{route('validarInformacionFuncionario')}}'+ '/'+ idfuncionarioD;
                        $.get( route_edit, function( info ) {
                            var datas=info.data;
                            idFuncionarioD=datas.id;
                            if(datas.audiovisual!=null){
                                $('#FK_FUNCIONARIO_Programa').empty();
                                $('#FK_FUNCIONARIO_Programa').attr('disabled',true);
                                $('#FK_FUNCIONARIO_Programa').append(new Option(datas.programa,datas.id_programa));
                            }
                            else{
                                $('#FK_FUNCIONARIO_Programa').empty();
                                $('#FK_FUNCIONARIO_Programa').attr('disabled',false);
                                var listarProgramas= '{{ route('listarProgramas') }}';
                                $.ajax({
                                    url: listarProgramas,
                                    type: 'GET',
                                    beforeSend: function () {
                                        App.blockUI({target: '.portlet-form', animate: true});
                                    },
                                    success: function (response, xhr, request) {
                                        if (request.status === 200 && xhr === 'success') {
                                            App.unblockUI('.portlet-form');

                                            $(response.data).each(function (key,value) {
                                                $('#FK_FUNCIONARIO_Programa').append(new Option(value.PRO_Nombre,value.id));
                                            });
                                            $('#FK_FUNCIONARIO_Programa').val([])
                                        }
                                    }
                                });
                                guardarPrograma=true;//funcionario no tiene asignado un programa
                            }
                            $('input:text[name="FUCNIONARIO_Nombres"]').val(datas.name);
                            $('#FUCNIONARIO_Correo').val(datas.email);
                            $('input:text[name="FUCNIONARIO_Apellidos"]').val(datas.lastname);
                            $('#FUCNIONARIO_Telefono').val(datas.phone);
                            $('#modal-info-funcionario').modal('toggle');
                        });
                    }
                }
            };
            $.ajaxSetup({
                headers:
                    {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    }
            });
            var from_identificacion = $('#form_identificacion');
            var rules_identificacion = {
                id_funcionario: {
                    required: true,
                    remote: {
                        url: "{{ route('identificacion.validar') }}",
                        type: "post"
                    }
                },
            };
            var messages= {
                id_funcionario: {
                    remote: 'El funcionario no existe'
                },
            };
            FormValidationMd.init(from_identificacion,rules_identificacion,messages,createIngreso());
            $("#form_identificacion").validate({
                onkeyup: false //turn off auto validate while typing-pausa  validacion despues de escribir
            });
        });
    </script>
@endpush